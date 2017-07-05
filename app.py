from flask import Flask
from flask import render_template
from flask_pymongo import PyMongo
from flask import request
import pymysql
import pymysql.cursors
import json
import datetime
from dateutil.parser import parse

app=Flask(__name__)
app.config['MONGO_DBNAME']='VideoAnalytics'
app.config['MONGO_URI']='mongodb://localhost:27017/VideoAnalytics'

# Creating MongoConnection Object
mongo=PyMongo(app)


# Creating MySQL Connection
# Connect to the database
connection = pymysql.connect(host='localhost',
                             user='root',
                             password='root',
                             db='VideoAnalytics',
                             charset='utf8mb4',
                             cursorclass=pymysql.cursors.DictCursor)

@app.route('/')
def index():
    PersonCount = mongo.db.PersonCount
    output=[]
    for p in PersonCount.find():
        output.append({"CameraID":p['CameraID'],'FileName':p['FileName'],'PersonCount':p['PersonCount'],'TimeStamps':p['date']})


    return render_template("index.html", result=output)

@app.route('/result',methods = ['POST'])
def result():
   if request.method == 'POST':
      result = request.form

      dt=result['datetime']

      dt=parse(dt)
      hours=dt.strftime("%H")
      minute=dt.strftime("%M")
      date=dt.date()
      print(date)
      data = []
      try:

         cur = connection.cursor()
         cur.execute("SELECT  CameraID , SUM(  `PersonCount` ) AS PersonCount FROM  `PersonCount`  WHERE HOUR(  `date` ) =09 AND MINUTE(  `date` ) =10 GROUP BY  `CameraID`")
         results = cur.fetchall()

         count = 1
         output = ""
         for row in results:
             output += "[' Camera - " + str(count) + "'," + str(row['PersonCount']) + "],"
             count += 1
         data.append([output[:-1]])
         print(data)
      finally:
          print("Finaly Executed")

      return render_template("test.html",result=data)








if __name__=="__main__":
    app.run();