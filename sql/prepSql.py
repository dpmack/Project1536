import os

print "Standardizing sql files"
print
print "Searching directory for .sql files"

for fileName in os.listdir("."):
    if ".sql" in fileName:
        f = open(fileName,'rb')
        sqlData = f.read()
        f.close()

        if not("CREATE DATABASE" in sqlData):
            sqlData = sqlData.split("\n")
            if "USE" in sqlData[0]:
                continue

            print "Fixing %s ..." % fileName
            output = "USE a5621243_staging\n"

            for line in sqlData:
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
