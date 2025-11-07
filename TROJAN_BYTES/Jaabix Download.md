First choose platofrm UBUNTU

![[Pasted image 20251107180708.png]]
##### a. Become root user

Start new shell session with root privileges.

`$ sudo -s`

##### b. Install Zabbix repository

[Documentation](https://www.zabbix.com/documentation/7.4/manual/installation/install_from_packages)

`# wget https://repo.zabbix.com/zabbix/7.4/release/ubuntu/pool/main/z/zabbix-release/zabbix-release_latest_7.4+ubuntu24.04_all.deb   # dpkg -i zabbix-release_latest_7.4+ubuntu24.04_all.deb   # apt update`

##### c. Install Zabbix server, frontend, agent

`# apt install zabbix-server-mysql zabbix-frontend-php zabbix-apache-conf zabbix-sql-scripts zabbix-agent`
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
nano /etc/zabbix/zabbix_server.conf
```

```
DBPassword=jabbix
```

----------------

##### Start Zabbix server and agent processes

Start Zabbix server and agent processes and make it start at system boot.

```
systemctl restart zabbix-server zabbix-agent apache2  
systemctl enable zabbix-server zabbix-agent apache2
```

--------
#### Start Zabbix

To setup the gui search http://192.168.229.130/zabbix/setup.php  (ip/zabbix)


![[Pasted image 20251107175751.png]]

----------

#### Now login with credentials : 

#### url : http://locahost/zabbix

**username :** Admin

**Password :** zabbix





