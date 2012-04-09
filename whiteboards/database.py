import MySQLdb

class dbConnection:
    def __init__(self):
        pass
    
    def query(self, query, formats=tuple()):
        self.db = MySQLdb.connect(host="localhost", # your host, usually localhost
                                  user="root", # your username
                                  passwd="ilbeal", # your password
                                  db="a5621243_staging") # name of the data base
        cur = self.db.cursor()
        cur.execute(query, formats)
        data = cur.fetchall()
        cur.close()
        self.db.close()
        return data

    def getAccount(self, ticket):
        result = self.query("""SELECT accountID FROM tickets
WHERE ticket=%s""", (ticket,))
        if len(result) == 1:
            return result[0][0]
        else:
            return False

    def getName(self, accountID):
        result = self.query("""SELECT firstName, lastName FROM accounts
WHERE accountID=%s""", (accountID))
        return result[0][0] + ", " + result[0][1]

    def allowedInWhiteboard(self, accountID, boardID):
        result = self.query("""SELECT 1 FROM whiteboardsAccountsMapping
WHERE accountID=%s AND whiteboardID=%s""", (accountID, boardID))
        return len(result) == 1
