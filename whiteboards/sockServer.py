import sys,threading

from twisted.internet import reactor
from twisted.python import log
from twisted.web.server import Site
from twisted.web.static import File

from autobahn.websocket import WebSocketServerFactory, \
                               WebSocketServerProtocol, \
                               listenWS

from WhiteboardServer import WhiteboardServer

def main():
    class WhiteboardServerProtocol(WebSocketServerProtocol):
        def onConnect(self, connectionRequest):
            whiteboard.addClient(self)
            return None

        def onMessage(self, msg, binary):
            whiteboard.processMessage(self, msg)

    #log.startLogging(sys.stdout)
    debugWS = False
    debugWhiteboard = False
    whiteboard = WhiteboardServer(debugWhiteboard)

    factory = WebSocketServerFactory("ws://localhost:9000",
                                     debug = debugWS,
                                     debugCodePaths = debugWS)

    factory.protocol = WhiteboardServerProtocol
    #factory.setProtocolOptions(allowHixie76 = True)
    listenWS(factory)

    webdir = File(".")
    web = Site(webdir)
    reactor.listenTCP(8080, web)

    #threading.Thread(None, reactor.run, None).start()
    reactor.run()
