import mysql.connector
from mysql.connector import Error
import json
import requests
import datetime
import pprint
import time
import os

url = "http://159.65.135.69/Ananti/sync"
# url = "http://localhost/ananti/sync"

id_pabrik = ""

# get plant_name clear
def get_plant_name():
  path = os.getcwd()
  print("Current Directory", path)
  print()

  # parent directory
  parent = os.path.dirname(path)
  print("Parent directory", parent)

  f = open(path+"\\.htaccess", "r")
  i = 0
  config_file = ""

  for x in f:
    i = i+1
    if i==6:
      y = x.split(" ")
      # print(x.split(" "))
      # print(y[6].replace("\n",""))
      config_file = ".env."+y[6].replace("\n", "")
      # print(config_file)
      pass

  i=0
  g = open(path+"\\"+config_file, "r")
  for x in g:
    i = i+1
    if i == 8:
      y = x.split("=")
      # print(x.split("="))
      # print(y[1].replace("\n", ""))
      id_pabrik = y[1].replace("\n", "")
      pass

  pass

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

# m_wo clear
def m_wo():
  main()
  # print(id_pabrik)
  print("Sync data m_wo :")
  unsync_data = -1
  while unsync_data != 0 :  
    try:
      connection = mysql.connector.connect(
          host='localhost', database='ananti', user='root', password='')

      sql_select_Query = "select DISTINCT tanggal from m_wo where id_pabrik = '" + \
          id_pabrik + "' and sync = '0'"
      cursor = connection.cursor()
      # cursor = server.cursor()
      cursor.execute(sql_select_Query)
      records = cursor.fetchall()
      print("    Total unsync data m_wo group by date is: ", cursor.rowcount)
      print("    ",end='')
      unsync_data = cursor.rowcount

      if unsync_data > 0:
        row = records[0]
        tanggal = str(row[0])

        sql_select_Query = "select * from m_wo where id_pabrik = '" + \
            id_pabrik + "' and tanggal = '"+tanggal+"';"
        cursor = connection.cursor()
        # cursor = server.cursor()
        cursor.execute(sql_select_Query)
        records = cursor.fetchall()

        myobj = {'data': json.dumps(records, default=str)}

        # print(url+"/m_wo")
        x = requests.post(url+"/m_wo/"+id_pabrik+"/"+tanggal+"/", data=myobj)

        # print(x.text)

        if(x.text == "ok"):
          for row in records:
            no_wo = row[3]
            # print(no_wo)
            sql = "UPDATE `ananti`.`m_wo` SET `sync` = '2' WHERE `m_wo`.`no_wo` = '"+no_wo+"';"
            # print(sql)
            print("#", end='')
            cursor = connection.cursor()
            cursor.execute(sql)
            connection.commit()
          # print("set status sync = 2")

        pass
    except Error as e:
      print("Error reading data from MySQL table", e)
    finally:
      if (connection.is_connected()):
        connection.close()
        cursor.close()
        print("")

    pass
    time.sleep(1)
  pass

# m_planing clear
def m_planing():
  main()
  print("Sync data m_planing :")
  unsync_data = -1
  while unsync_data != 0:
    try:
      connection = mysql.connector.connect(
          host='localhost', database='ananti', user='root', password='')

      sql_select_Query = "select DISTINCT tanggal from m_planing where id_pabrik = '" + \
          id_pabrik + "' and sync = '0'"
      cursor = connection.cursor()
      # cursor = server.cursor()
      cursor.execute(sql_select_Query)
      records = cursor.fetchall()

      # pprint.pprint(records)
      print("    Total unsync data m_planing group by date is: ", cursor.rowcount)
      print("    ", end='')

      unsync_data = cursor.rowcount

      if unsync_data > 0:
        row = records[0]
        tanggal = str(row[0])
        if tanggal == "None":
          tanggal = "0000-00-00"

        sql_select_Query = "select * from m_planing where id_pabrik = '" + \
            id_pabrik + "' and tanggal = '"+tanggal+"';"
        cursor = connection.cursor()
        # cursor = server.cursor()
        cursor.execute(sql_select_Query)
        records = cursor.fetchall()

        myobj = {'data': json.dumps(records, default=str)}

        # print(url+"/m_planing")
        x = requests.post(url+"/m_planing/"+id_pabrik+"/"+tanggal+"/", data=myobj)

        # print(x.text)

        if(x.text == "ok"):
          for row in records:
            no_wo = row[3]
            # print(no_wo)
            sql = "UPDATE `ananti`.`m_planing` SET `sync` = '2' WHERE `m_planing`.`no_wo` = '" + \
                no_wo+"' AND `m_planing`.`tanggal` = '"+tanggal+"';"
            # print(sql)
            print("#",end='')

            cursor = connection.cursor()
            cursor.execute(sql)
            connection.commit()
          # print("set status sync = 2")

        pass
    except Error as e:
      print("Error reading data from MySQL table", e)
    finally:
      if (connection.is_connected()):
        connection.close()
        cursor.close()
        print("")

    pass
    time.sleep(1)
  pass

# m_activity clear
def m_activity():
  main()
  print("Sync data m_activity :")

  unsync_data = -1
  while unsync_data != 0:
    try:
      connection = mysql.connector.connect(
          host='localhost', database='ananti', user='root', password='')

      sql_select_Query = "select DISTINCT tanggal from m_activity where id_pabrik = '" + \
          id_pabrik + "' and sync = '0'"
      cursor = connection.cursor()
      # cursor = server.cursor()
      cursor.execute(sql_select_Query)
      records = cursor.fetchall()

      # pprint.pprint(records)
      print("    Total unsync data m_activity group by date is: ", cursor.rowcount)
      print("    ",end='')

      unsync_data = cursor.rowcount

      if unsync_data > 0:
        row = records[0]
        tanggal = str(row[0])
        if tanggal == "None":
          tanggal = "0000-00-00"

        sql_select_Query = "select no_wo,perbaikan,status_perbaikan from m_activity where id_pabrik = '" + \
            id_pabrik + "' and tanggal = '"+tanggal+"';"
        cursor = connection.cursor()
        # cursor = server.cursor()
        cursor.execute(sql_select_Query)
        records = cursor.fetchall()

        myobj = {'data': json.dumps(records, default=str)}

        # print(url+"/m_activity")
        x = requests.post(url+"/m_activity/"+id_pabrik +
                          "/"+tanggal+"/", data=myobj)

        # print(x.text)

        if(x.text == "ok"):
          for row in records:
            no_wo = row[0]
            # print(no_wo)
            sql = "UPDATE `ananti`.`m_activity` SET `sync` = '2' WHERE `m_activity`.`no_wo` = '" + \
                no_wo+"' AND `m_activity`.`id_pabrik` = '"+ id_pabrik + \
                  "' AND `m_activity`.`tanggal` = '"+ tanggal +"';"
            # print(sql)
            print("#",end='')
            cursor = connection.cursor()
            cursor.execute(sql)
            connection.commit()
          # print("set status sync = 2")

        pass
    except Error as e:
      print("Error reading data from MySQL table", e)
    finally:
      if (connection.is_connected()):
        connection.close()
        cursor.close()
        print("")

    pass
    time.sleep(1)
  pass

# m_activity_detail
def m_activity_detail():
  main()
  print("Sync data m_activity_detail :")

  unsync_data = -1
  while unsync_data != 0:
    try:
      connection = mysql.connector.connect(
          host='localhost', database='ananti', user='root', password='')

      sql_select_Query = "select DISTINCT tanggal from m_activity_detail where id_pabrik = '" + \
          id_pabrik + "' and sync = '0'"
      cursor = connection.cursor()
      # cursor = server.cursor()
      cursor.execute(sql_select_Query)
      records = cursor.fetchall()

      # pprint.pprint(records)
      print("    Total unsync data m_activity_detail group by date is: ", cursor.rowcount)
      print("    ",end='')

      unsync_data = cursor.rowcount

      if unsync_data > 0:
        row = records[0]
        tanggal = str(row[0])
        if tanggal == "None":
          tanggal = "0000-00-00"

        sql_select_Query = "select no_wo,nama_teknisi,r_mulai,r_selesai,realisasi from m_activity_detail where id_pabrik = '" + \
            id_pabrik + "' and tanggal = '"+tanggal+"';"
        cursor = connection.cursor()
        # cursor = server.cursor()
        cursor.execute(sql_select_Query)
        records = cursor.fetchall()

        myobj = {'data': json.dumps(records, default=str)}

        # print(url+"/m_activity_detail")
        x = requests.post(url+"/m_activity_detail/"+id_pabrik +
                          "/"+tanggal+"/", data=myobj)

        # print(x.text)

        if(x.text == "ok"):
          for row in records:
            no_wo = row[0]
            # print(no_wo)
            sql = "UPDATE `ananti`.`m_activity_detail` SET `sync` = '2' WHERE `m_activity_detail`.`no_wo` = '" + \
                no_wo+"' AND `m_activity_detail`.`id_pabrik` = '"+ id_pabrik + \
                  "' AND `m_activity_detail`.`tanggal` = '"+ tanggal +"';"
            # print(sql)
            print("#",end='')
            cursor = connection.cursor()
            cursor.execute(sql)
            connection.commit()
          # print("set status sync = 2")

        pass
    except Error as e:
      print("Error reading data from MySQL table", e)
    finally:
      if (connection.is_connected()):
        connection.close()
        cursor.close()
        print("")

    pass
    time.sleep(1)
  pass

# m_activity_detail
def m_sparepart_usage():
  main()
  print("Sync data m_sparepart_usage :")

  unsync_data = -1
  while unsync_data != 0:
    try:
      connection = mysql.connector.connect(
          host='localhost', database='ananti', user='root', password='')

      sql_select_Query = "select DISTINCT tanggal from m_sparepart_usage where id_pabrik = '" + \
          id_pabrik + "' and sync = '0'"
      cursor = connection.cursor()
      # cursor = server.cursor()
      cursor.execute(sql_select_Query)
      records = cursor.fetchall()

      # pprint.pprint(records)
      print("    Total unsync data m_sparepart_usage group by date is: ", cursor.rowcount)
      print("    ",end='')

      unsync_data = cursor.rowcount

      if unsync_data > 0:
        row = records[0]
        tanggal = str(row[0])
        if tanggal == "None":
          tanggal = "0000-00-00"

        sql_select_Query = "select no_wo,material,spek,satuan,qty,cost from m_sparepart_usage where id_pabrik = '" + \
            id_pabrik + "' and tanggal = '"+tanggal+"';"
        cursor = connection.cursor()
        # cursor = server.cursor()
        cursor.execute(sql_select_Query)
        records = cursor.fetchall()

        myobj = {'data': json.dumps(records, default=str)}

        # print(url+"/m_sparepart_usage")
        x = requests.post(url+"/m_sparepart_usage/"+id_pabrik +
                          "/"+tanggal+"/", data=myobj)

        # print(x.text)

        if(x.text == "ok"):
          for row in records:
            no_wo = row[0]
            # print(no_wo)
            sql = "UPDATE `ananti`.`m_sparepart_usage` SET `sync` = '2' WHERE `m_sparepart_usage`.`no_wo` = '" + \
                no_wo+"' AND `m_sparepart_usage`.`id_pabrik` = '"+id_pabrik+"' AND `m_sparepart_usage`.`tanggal` = '"+tanggal+"'"

            # print(sql)
            print("#",end='')
            cursor = connection.cursor()
            cursor.execute(sql)
            connection.commit()
          # print("set status sync = 2")

        pass
    except Error as e:
      print("Error reading data from MySQL table", e)
    finally:
      if (connection.is_connected()):
        connection.close()
        cursor.close()
        print("")

    pass
    time.sleep(1)
  pass

def main():
  os.system("cls")
  print("   _   _  _   _   _  _ _____ ___ ")
  print("  /_\ | \| | /_\ | \| |_   _|_ _|")
  print(" / _ \| .` |/ _ \| .` | | |  | | ")
  print("/_/ \_\_|\_/_/ \_\_|\_| |_| |___|")
  print("")

  pass

if __name__ == '__main__':
  get_plant_name()
  m_wo()
  m_planing()
  m_activity()
  m_activity_detail()
  m_sparepart_usage()