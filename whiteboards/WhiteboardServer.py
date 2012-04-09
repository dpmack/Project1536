from whiteboardfile import WhiteboardFiles
from database import dbConnection

class WhiteboardServer:
    def __init__(self):
        self.clients = {}
        self.db = dbConnection()
        self.whiteboards = WhiteboardFiles()

    def addClient(self, client):
        self.clients[client] = {"client":client,
                                "accountID":None,
                                "name":"",
                                "whiteboard":None,
                                "page":None}
        
    def broadcastFrom(self, sentFrom, message, pageOnly=False):
        sentFromData = self.clients[sentFrom]
        for client in self.clients:
            clientData = self.clients[client]
            if sentFrom != client and clientData["accountID"] != None and \
               clientData["whiteboard"] == sentFromData["whiteboard"] and \
               (pageOnly == False or (pageOnly == True and sentFromData["page"] == clientData["page"])):
                client.sendMessage(message)

    def close(self, client, logout=True):
        self.moved(client, -1)
        
        try:
            client.dropConnection(abort = False)
        except:
            pass
        
        self.clients.pop(client)

    def joined(self, client, boardID):
        clientData = self.clients[client]
        clientData["whiteboard"] = boardID
        clientData["page"] = 1
        self.broadcastFrom(client, "JOINED %s %s %s" % (clientData["accountID"], 1, clientData["name"]))

        for person in self.clients.keys():
            personData = self.clients[person]
            if personData["accountID"] == clientData["accountID"] and person != client and personData["whiteboard"] == clientData["whiteboard"]:
                self.close(person, False)
            elif person != client and personData["accountID"] != None and clientData["whiteboard"] == personData["whiteboard"]:
                client.sendMessage("JOINED %s %s %s" % (personData["accountID"], personData["page"], personData["name"]))

    def moved(self, client, pageNum):
        self.clients[client]["page"] = pageNum
        self.broadcastFrom(client, "MOVED %s %s" % (self.clients[client]["accountID"], pageNum))

    def pageExists(self, boardID, pageNum):
        return self.whiteboards.getBoard(boardID).pageExists(pageNum)
        
    def getPages(self, boardID):
        return self.whiteboards.getBoard(boardID).getPages()

    def getPage(self, boardID, pageNum):
        return self.whiteboards.getBoard(boardID).getPage(pageNum).all()

    def createPage(self, client, boardID, title):
        pageNum = self.whiteboards.getBoard(boardID).createPage(title)
        self.broadcastFrom(client, "PAGES " + self.getPages(boardID))
        self.moved(client, pageNum)
        client.sendMessage("PAGES " + self.getPages(boardID))
        client.sendMessage("CLEAR")

    def drawPoint(self, client, shapeID, x, y):
        accountID = self.clients[client]["accountID"]
        boardID = self.clients[client]["whiteboard"]
        pageNum = self.clients[client]["page"]
        self.whiteboards.getBoard(boardID).getPage(pageNum).point(accountID, shapeID, x, y)
        self.broadcastFrom(client, "PNT %s %s %s %s" % (accountID, shapeID, x, y), True)

    def endShape(self, client, shapeID, shapeData):
        accountID = self.clients[client]["accountID"]
        boardID = self.clients[client]["whiteboard"]
        pageNum = self.clients[client]["page"]
        self.whiteboards.getBoard(boardID).getPage(pageNum).setShape(accountID, shapeID, shapeData)
        self.broadcastFrom(client, "END %s %s" % (accountID, shapeID), True)
    
    def processMessage(self, client, msg):
        #print "IN >>>", msg
        cmd, data = msg.split(" ", 1)

        if cmd == "QUIT":
            self.close(client)
        elif cmd == "LOGIN":
            accountID = self.db.getAccount(data)
            if accountID == False:
                client.sendMessage("ERR Ticket invalid")
                self.close(client)
            else:
                client.sendMessage("OK")
                self.clients[client]["accountID"] = accountID
                self.clients[client]["name"] = self.db.getName(accountID)
            
        elif cmd == "SELECT":
            boardID = int(data)
            if self.db.allowedInWhiteboard(self.clients[client]["accountID"], boardID):
                client.sendMessage("CLEAR")
                self.joined(client, boardID)
                client.sendMessage("PAGES " + self.getPages(boardID))
                client.sendMessage("UPDATE " + self.getPage(boardID, 1))
            else:
                client.sendMessage("ERR Not allowed")
                self.close(client)
        elif cmd == "CHANGE":
            pageNum = int(data)
            if self.pageExists(self.clients[client]["whiteboard"], pageNum):
                client.sendMessage("CLEAR")
                self.moved(client, pageNum)
                client.sendMessage("UPDATE " + self.getPage(self.clients[client]["whiteboard"], pageNum))
            else:
                client.sendMessage("ERR Page does not exist")
                self.close(client)
        elif cmd == "CREATE":
            self.createPage(client, self.clients[client]["whiteboard"], data)
        elif cmd == "PNT":
            shapeID, x, y = data.split(" ")
            self.drawPoint(client, shapeID, x, y)
        elif cmd == "END":
            shapeID, data = data.split(" ", 1)
            self.endShape(client, shapeID, data)
        else:
            print "Unknown command '%s'" % msg
            self.close(client)
