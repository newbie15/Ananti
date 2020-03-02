import mysql.connector
from mysql.connector import Error
import json
import requests

# url = "http://159.65.135.69/Ananti/sync"
url = "http://localhost/ananti/sync"




# print(x.text)    

def master_pabrik():
  unsync_data = 0
  try:
    connection = mysql.connector.connect(host='localhost',database='ananti',user='root',password='')

    sql_select_Query = "select * from master_pabrik where sync = '0'"
    cursor = connection.cursor()
    # cursor = server.cursor()
    cursor.execute(sql_select_Query)
    records = cursor.fetchall()
    print("Total unsync data is: ", cursor.rowcount)
    unsync_data = cursor.rowcount

    if unsync_data > 0:
      sql_select_Query = "select * from master_pabrik"
      cursor = connection.cursor()
      # cursor = server.cursor()
      cursor.execute(sql_select_Query)
      records = cursor.fetchall()
  
      myobj = {'data': json.dumps(records)}
      print(url+"/master_pabrik")
      x = requests.post(url+"/master_pabrik", data = myobj)

      print(x.text)


      pass


    # print(json.dumps(records))

    # print("\nUpdate each master_pabrik")
    # for row in records:
    #   print("Id = ", row[0], )
    #   print("Nama = ", row[1])
    #   print("Throughput  = ", row[2])
    #   print("Area  = ", row[3], "\n")

  except Error as e:
    print("Error reading data from MySQL table", e)
  finally:
    if (connection.is_connected()):
      connection.close()
      cursor.close()
      print("MySQL connection is closed")

  pass

def master_station():
  pass

def master_unit():
  pass

def master_sub_unit():
  pass

def master_user():
  pass

def master_karyawan():
  pass

def m_wo():
  pass

def m_planing():
  pass

def main():
  pass

if __name__ == '__main__':
  master_pabrik()
  main()