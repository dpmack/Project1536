import sys, time, os
from daemon import Daemon
import sockServer

curDir = os.path.realpath(".")
 
sockServer.main(curDir)
