#Moses Chen - mchen37@u.rochester.edu
#Yaron Adar - yadar@u.rochester.edu

#!"C:\Python27\python.exe"

import cgitb
cgitb.enable()

import datetime
date = datetime.datetime.now()

import time

import cgi
form = cgi.FieldStorage()

netid = form['netid'].value
first = form['first'].value
last = form['last'].value

import MySQLdb
db = MySQLdb.connect(host="localhost", user="root", passwd="mysql", db="xfac")

cur = db.cursor() 

userExists = None

query1 = "SELECT (1) FROM Visitors WHERE visitor_netid = '" + netid + "' LIMIT 1"
query2 = "INSERT INTO Visitors (visitor_netid, firstname, lastname, reg_date) VALUES (%s,%s,%s,%s)"

if cur.execute(query1):
	userExists = True
else:
	cur.execute(query2, (netid, first, last, date.strftime('%Y-%m-%d %H:%M:%S')))
	db.commit()
	userExists = False
	
print "Content-Type: text/html"
print 

print "<html>"
print "<body>"

if userExists:
	print "User " + netid + " already exists."
else:
	print "User " + netid + " created."

print "</body>"
print "</html>"