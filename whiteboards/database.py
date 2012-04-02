import MySQLdb

class dbConnection:
    def __init__(self):
        self.db = MySQLdb.connect(host="localhost", # your host, usually localhost
                                  user="root", # your username
                                  passwd="ilbeal", # your password
                                  db="a5621243_staging") # name of the data base

    def query(self, query):
        cur = self.db.cursor()
        cur.execute(query)
        return cur.fetchall()

    def getAccount(self, ticket):
        result = self.query("""SELECT accountID FROM tickets
WHERE ticket=\"%s\"""" % ticket)
        print """SELECT accountID FROM tickets
WHERE ticket=\"%s\"""" % ticket
        print result
        print len(result)
        if len(result) == 1:
            return result[0][0]
        else:
            return False

    def getName(self, accountID):
        result = self.query("""SELECT firstName, lastName FROM accounts
WHERE accountID=%s""" % accountID)
        return result[0][0] + ", " + result[0][1]

    def allowedInWhiteboard(self, accountID, boardID):
        result = self.query("""SELECT 1 FROM whiteboardsAccountsMapping
WHERE accountID=%s AND whiteboardID=%s""" % (accountID, boardID))
        return len(result) == 1
