import os

print "Standardizing sql files"
print
print "Searching directory for .sql files"

for fileName in os.listdir("."):
    if ".sql" in fileName:
        f = open(fileName,'rb')
        sqlData = f.read()
        f.close()

        print "Fixing %s ..." % fileName
        output = ""

        for line in sqlData.split("\n"):
            if line[:2] == "--":
                continue
            output += line+"\n"

        output = output.replace("\r\n","\n")
        
        while "\n\n\n" in output:
            output = output.replace("\n\n\n","\n\n")
        
        f = open(fileName,'wb')
        f.write(output)
        f.close()

print "Done"
