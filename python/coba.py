import mysql.connector
from mysql.connector import Error
import json
import requests

# url = "http://159.65.135.69/Ananti/sync"
url = "http://localhost/ananti/sync"

id_pabrik = "SDI1"




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
  except Error as e:
    print("Error reading data from MySQL table", e)
  finally:
    if (connection.is_connected()):
      connection.close()
      cursor.close()
      print("MySQL connection is closed")

  pass

def master_station():
  unsync_data = 0
  try:
    connection = mysql.connector.connect(host='localhost',database='ananti',user='root',password='')

    sql_select_Query = "select * from master_station where id_pabrik = '"+ id_pabrik +"' and sync = '0'"
    cursor = connection.cursor()
    # cursor = server.cursor()
    cursor.execute(sql_select_Query)
    records = cursor.fetchall()
    print("Total unsync data is: ", cursor.rowcount)
    unsync_data = cursor.rowcount

    if unsync_data > 0:
      sql_select_Query = "select * from master_station where id_pabrik = '" + \
          id_pabrik + "' and sync = '0'"
      cursor = connection.cursor()
      # cursor = server.cursor()
      cursor.execute(sql_select_Query)
      records = cursor.fetchall()
  
      for x in records:
        print(x)

      myobj = {'data': json.dumps(records)}

      print(url+"/master_station")
      x = requests.post(url+"/master_station/"+id_pabrik+"/", data = myobj)

      print(x.text)
      if x.text == "ok" :
        sql_select_Query = "update master_station set sync = '2' where id_pabrik = '" + \
            id_pabrik + "' and sync = '0'"
        cursor = connection.cursor()
        # cursor = server.cursor()
        cursor.execute(sql_select_Query)

        pass
      pass
  except Error as e:
    print("Error reading data from MySQL table", e)
  finally:
    if (connection.is_connected()):
      connection.close()
      cursor.close()
      print("MySQL connection is closed")


  pass

def master_unit():
  unsync_data = 0
  try:
    connection = mysql.connector.connect(host='localhost', database='ananti', user='root', password='')

    sql_select_Query = "select * from master_unit where sync = '0'"
    cursor = connection.cursor()
    # cursor = server.cursor()
    cursor.execute(sql_select_Query)
    records = cursor.fetchall()
    print("Total unsync data is: ", cursor.rowcount)
    unsync_data = cursor.rowcount

    if unsync_data > 0:
      sql_select_Query = "select * from master_unit where sync = '0'"
      cursor = connection.cursor()
      # cursor = server.cursor()
      cursor.execute(sql_select_Query)
      records = cursor.fetchall()

      myobj = {'data': json.dumps(records)}
      print(url+"/master_unit")
      x = requests.post(url+"/master_unit/"+id_pabrik+"/", data=myobj)

      print(x.text)

      pass
  except Error as e:
    print("Error reading data from MySQL table", e)
  finally:
    if (connection.is_connected()):
      connection.close()
      cursor.close()
      print("MySQL connection is closed")

  pass

def master_sub_unit():
  unsync_data = 0
  try:
    connection = mysql.connector.connect(host='localhost', database='ananti', user='root', password='')

    sql_select_Query = "select * from master_sub_unit where sync = '0'"
    cursor = connection.cursor()
    # cursor = server.cursor()
    cursor.execute(sql_select_Query)
    records = cursor.fetchall()
    print("Total unsync data is: ", cursor.rowcount)
    unsync_data = cursor.rowcount

    if unsync_data > 0:
      sql_select_Query = "select * from master_sub_unit where sync = '0'"
      cursor = connection.cursor()
      # cursor = server.cursor()
      cursor.execute(sql_select_Query)
      records = cursor.fetchall()

      myobj = {'data': json.dumps(records)}
      print(url+"/master_sub_unit")
      x = requests.post(url+"/master_sub_unit/"+id_pabrik+"/", data=myobj)

      print(x.text)

      pass
  except Error as e:
    print("Error reading data from MySQL table", e)
  finally:
    if (connection.is_connected()):
      connection.close()
      cursor.close()
      print("MySQL connection is closed")
  pass

def master_user():
  pass

def master_karyawan():
  unsync_data = 0
  try:
    connection = mysql.connector.connect(
        host='localhost', database='ananti', user='root', password='')

    sql_select_Query = "select * from master_karyawan where sync = '0'"
    cursor = connection.cursor()
    # cursor = server.cursor()
    cursor.execute(sql_select_Query)
    records = cursor.fetchall()
    print("Total unsync data is: ", cursor.rowcount)
    unsync_data = cursor.rowcount

    if unsync_data > 0:
      sql_select_Query = "select * from master_karyawan where sync = '0'"
      cursor = connection.cursor()
      # cursor = server.cursor()
      cursor.execute(sql_select_Query)
      records = cursor.fetchall()

      myobj = {'data': json.dumps(records)}
      print(url+"/master_karyawan")
      x = requests.post(url+"/master_karyawan/"+id_pabrik+"/", data=myobj)

      print(x.text)

      pass
  except Error as e:
    print("Error reading data from MySQL table", e)
  finally:
    if (connection.is_connected()):
      connection.close()
      cursor.close()
      print("MySQL connection is closed")

  pass

def m_wo():
  unsync_data = 0
  try:
    connection = mysql.connector.connect(
        host='localhost', database='ananti', user='root', password='')

    sql_select_Query = "select * from m_wo where sync = '0'"
    cursor = connection.cursor()
    # cursor = server.cursor()
    cursor.execute(sql_select_Query)
    records = cursor.fetchall()
    print("Total unsync data is: ", cursor.rowcount)
    unsync_data = cursor.rowcount

    if unsync_data > 0:
      sql_select_Query = "select * from m_wo where sync = '0'"
      cursor = connection.cursor()
      # cursor = server.cursor()
      cursor.execute(sql_select_Query)
      records = cursor.fetchall()

      myobj = {'data': json.dumps(records)}
      print(url+"/m_wo")
      x = requests.post(url+"/m_wo/"+id_pabrik+"/", data=myobj)

      print(x.text)

      pass
  except Error as e:
    print("Error reading data from MySQL table", e)
  finally:
    if (connection.is_connected()):
      connection.close()
      cursor.close()
      print("MySQL connection is closed")

  pass

def m_planing():
  unsync_data = 0
  try:
    connection = mysql.connector.connect(
        host='localhost', database='ananti', user='root', password='')

    sql_select_Query = "select * from m_planing where sync = '0'"
    cursor = connection.cursor()
    # cursor = server.cursor()
    cursor.execute(sql_select_Query)
    records = cursor.fetchall()
    print("Total unsync data is: ", cursor.rowcount)
    unsync_data = cursor.rowcount

    if unsync_data > 0:
      sql_select_Query = "select * from m_planing where sync = '0'"
      cursor = connection.cursor()
      # cursor = server.cursor()
      cursor.execute(sql_select_Query)
      records = cursor.fetchall()

      myobj = {'data': json.dumps(records)}
      print(url+"/m_planing")
      x = requests.post(url+"/m_planing/"+id_pabrik+"/", data=myobj)

      print(x.text)

      pass
  except Error as e:
    print("Error reading data from MySQL table", e)
  finally:
    if (connection.is_connected()):
      connection.close()
      cursor.close()
      print("MySQL connection is closed")

  pass

def main():
  pass

if __name__ == '__main__':
  # master_pabrik()
  try:
    master_station()

    pass
  except:
    print("something happens")
    pass
  main()
