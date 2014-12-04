import mysql.connector
import sys
import mysql

f = open('datacut.json', 'r')

def jsontodb(f):
        global getnextline
        global getosnextline
        global getcpucountnextline
        global counterofname
        #where is data domicile and what are the data laws nationally for target
        getnextline = 0
        getosnextline = 0
        getcpucountnextline = 0
        counterofname =0
        for line in f:
                

                if (getnextline == 1):
                        #print line
                        indexofthing = line.index(':')
                        cutline = line[indexofthing:]
                        #print cutline
                        indexofquotation = cutline.index('"') + 1
                        cutlinefurther = cutline[indexofquotation:]
                        indexofsecondquotation = cutlinefurther.index('"')
                        cutlinefinal = cutlinefurther[:indexofsecondquotation]
                        IP = cutlinefinal
                        getnextline = 0


                if (getosnextline == 1):
                        indexofthing = line.index(':')
                        cutline = line[indexofthing:]
                        #print cutline
                        indexofquotation = cutline.index('"') + 1
                        cutlinefurther = cutline[indexofquotation:]
                        indexofsecondquotation = cutlinefurther.index('"')
                        cutlinefinal = cutlinefurther[:indexofsecondquotation]
                        OS = cutlinefinal
                        getosnextline = 0
                if (getcpucountnextline == 1):
                        indexofthing = line.index(':')
                        cutline = line[indexofthing:]
                        #print cutline
                        indexofquotation = cutline.index('"') + 1
                        cutlinefurther = cutline[indexofquotation:]
                        indexofsecondquotation = cutlinefurther.index('"')
                        cutlinefinal = cutlinefurther[:indexofsecondquotation]
                        CPUamount = cutlinefinal
                        getcpucountnextline = 0
                
                if "Name" in line:
                        if (counterofname == 0):
                                Nameofserver = line
                                indexofthing = line.index(':')
                                cutline = line[indexofthing:]
                        #print cutline
                                indexofquotation = cutline.index('"') + 1
                                cutlinefurther = cutline[indexofquotation:]
                                indexofsecondquotation = cutlinefurther.index('"')
                                cutlinefinal = cutlinefurther[:indexofsecondquotation]
                                Name = cutlinefinal
                                counterofname = 1
                    
                
                if "Original" in line:
                        Nameofserver = line
                        indexofthing = line.index(':')
                        cutline = line[indexofthing:]
                        #print cutline
                        indexofquotation = cutline.index('"') + 1
                        cutlinefurther = cutline[indexofquotation:]
                        indexofsecondquotation = cutlinefurther.index('"')
                        cutlinefinal = cutlinefurther[:indexofsecondquotation]
                        Originalnameofserver = cutlinefinal
                if"\"Name\": \"Ip\"" in line:
         
                        getnextline = 1
                if "\"Name\": \"Os\"," in line:
     
                        getosnextline = 1
                        #print line
                if "\"Name\": \"CpuCount\"," in line:
             
                        
                        getcpucountnextline = 1
                        #print line
                if "ChildrenCount" in line:
                        indexofthing = line.index(':')
                        cutline = line[indexofthing:]
                        #print cutline
                        indexofquotation = cutline.index('"') + 1
                        cutlinefurther = cutline[indexofquotation:]
                        indexofsecondquotation = cutlinefurther.index('"')
                        cutlinefinal = cutlinefurther[:indexofsecondquotation]
                        ChildrenCount = cutlinefinal
                        #print line 
                if "HostType" in line:
                        indexofthing = line.index(':')
                        cutline = line[indexofthing:]
                        #print cutline
                        indexofquotation = cutline.index('"') + 1
                        cutlinefurther = cutline[indexofquotation:]
                        indexofsecondquotation = cutlinefurther.index('"')
                        cutlinefinal = cutlinefurther[:indexofsecondquotation]
                        HostType = cutlinefinal
                        #print line 
                if "ParentId" in line:
                        indexofthing = line.index(':')
                        cutline = line[indexofthing:]
                        #print cutline
                        indexofquotation = cutline.index('"') + 1
                        cutlinefurther = cutline[indexofquotation:]
                        indexofsecondquotation = cutlinefurther.index('"')
                        cutlinefinal = cutlinefurther[:indexofsecondquotation]
                        ParentID = cutlinefinal
                        #print line
                if "ID" in line:
                        counterofname = 0
                        cnx = mysql.connector.connect(user='root', password='hHxrqGNn', host='localhost', database='serverlist')
                        cur = cnx.cursor()
                
                        insert_stmt = (
                        "INSERT INTO serverlist (IP, OS, CPUamount, Name, OriginalName, ChildrenCount, HostType, ParentID)"
                        "VALUES (%s, %s, %s, %s, %s, %s, %s, %s)"
                        )


                        data = (IP, OS, CPUamount, Name, Originalnameofserver, ChildrenCount, HostType, ParentID)
                        cur.execute(insert_stmt, data)
                        cnx.commit()
                        cnx.close()



#if line has the word for a specific thing in it find position of it in line then count forward

jsontodb(f)




# sniffertodatabase(f)
