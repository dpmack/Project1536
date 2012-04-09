import os, threading, pickle, time, json

KEEP_IN_MEMORY = 60
GC_POLL = 60

class WhiteboardPage:
    def __init__(self, boardID, pageNum):
        self.boardID = boardID
        self.pageNum = pageNum
        self.path = "boards/%s/%s.json" % (self.boardID, self.pageNum)

        if os.path.exists(self.path):
            file = open(self.path, "rb")
            self.shapes = json.load(file)
            file.close()
        else:
            self.shapes = {}

        self.lastActive = time.time()

    def all(self):
        self.lastActive = time.time()
        return json.dumps(self.shapes)

    def point(self, account, shape, x, y):
        self.lastActive = time.time()
        if not(account) in self.shapes:
            self.shapes[account] = {}
        if not(shape in self.shapes[account]):
            self.shapes[account][shape] = []
        self.shapes[account][shape].append({"point":[x,y]})

    def setShape(self, account, shape, shapeData):
        self.lastActive = time.time()
        self.shapes[account][shape] = json.loads(shapeData)

    def inactive(self):
        return time.time() - self.lastActive

    def flush(self):
        file = open(self.path, "wb")
        json.dump(self.shapes, file)
        file.close()

class WhiteboardFile:
    def __init__(self, boardID):
        self.boardID = boardID
        self.path = "boards/%s/pages.json" % self.boardID

        if not(os.path.exists("boards")):
            os.mkdir("boards")

        if not(os.path.exists("boards/%s" % self.boardID)):
            os.mkdir("boards/%s" % self.boardID)

        if not(os.path.exists(self.path)):
            file = open(self.path, "wb")
            file.write('["Default"]')
            file.close()
        
        file = open(self.path, "rb")
        self.pagesData = json.load(file)
        file.close()

        self.pages = {}
        self.lastActive = time.time()

    def createPage(self, title):
        self.lastActive = time.time()
        
        self.pagesData.append(title)
        pageNum = self.pagesData.index(title) + 1
        self.pages[pageNum] = WhiteboardPage(self.boardID, pageNum)
        return pageNum

    def getPages(self):
        self.lastActive = time.time()
        return json.dumps(self.pagesData)

    def getPage(self, pageNum):
        self.lastActive = time.time()
        
        if not(pageNum in self.pages):
            self.pages[pageNum] = WhiteboardPage(self.boardID, pageNum)
        return self.pages[pageNum]

    def pageExists(self, pageNum):
        return len(self.pagesData) >= pageNum

    def inactive(self):
        return time.time() - self.lastActive

    def gc(self):
        self.flush()
        for page in self.pages.keys():
            if (self.pages[page].inactive() > KEEP_IN_MEMORY):
                self.pages.pop(page)

    def flush(self):
        file = open(self.path, "wb")
        json.dump(self.pagesData, file)
        file.close()

        for page in self.pages:
            self.pages[page].flush()

class WhiteboardFiles:
    def __init__(self):
        self.whiteboards = {}
        self.gc = threading.Thread(None, self.gcThread, None)
        self.gc.start()

    def close(self):
        self.gc.stop()
        for whiteboard in self.whiteboards:
            whiteboard.flush()
        self.whiteboards = {}

    def getBoard(self, boardID):
        if not(boardID in self.whiteboards):
            self.whiteboards[boardID] = WhiteboardFile(boardID)
        return self.whiteboards[boardID]

    def gcThread(self):
        while True:
            for whiteboard in self.whiteboards.keys():
                self.whiteboards[whiteboard].gc()
                if (self.whiteboards[whiteboard].inactive() > KEEP_IN_MEMORY):
                    self.whiteboards.pop(whiteboard)
            time.sleep(GC_POLL)
