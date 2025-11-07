
 ---
##### Now download my sql in ubuntu and create initial database for jabbix

```
sudo apt install mysql-server 
```

```
sudo systemctl status mysql-server
```

```
service mysql start
```

**Then hit** ``` mysql ```

```
mysql>
```

## Create initial database

Make sure you have database server up and running.
Run the following on your database host.

```
mysql> create database zabbix character set utf8mb4 collate utf8mb4_bin;   
mysql> create user zabbix@localhost identified by 'password';   
mysql> grant all privileges on zabbix.* to zabbix@localhost;   
mysql> set global log_bin_trust_function_creators = 1;   
mysql> quit;`
```

The password I set is **jabbix**

On Zabbix server host import initial schema and data. You will be prompted to enter your newly created password.
```

zcat /usr/share/zabbix/sql-scripts/mysql/server.sql.gz | mysql --default-character-set=utf8mb4 -uzabbix -p zabbix

````

On Zabbix server host import initial schema and data. You will be prompted to enter your newly created password.

##### e. Configure the database for Zabbix server

Edit file
```
vi /etc/zabbix/zabbix_server.conf
```

```
DBPassword=password
```

----------------

