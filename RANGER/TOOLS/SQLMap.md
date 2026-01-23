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

## SQLMap Commands (Organized)

#### **Target**

 ==`-u`== → Specify target URL (GET-based testing)

The first step is to identify a potentially vulnerable URL. Web applications that use GET parameters (for example, `http://sqlmaptesting.thm/search?cat=1`) can be tested for SQL injection. In such cases, the URL is supplied to SQLMap using the `-u` flag, which is known as HTTP GET-based testing.

![[Pasted image 20260123233141.png]]

#### **Session Handling**

==`--cookie`== → Use authenticated session cookies


**Database Enumeration**

==`--dbs`== → List database names

![[Pasted image 20260123235008.png]]

==`-D <db> --tables`== → List tables in a database

![[Pasted image 20260123235029.png]]

==`-D <db> -T <table> --columns`== → List columns in a table

![[Pasted image 20260123235044.png]]

**Data Extraction**

- `-D <db> -T <table> --dump` → Dump table records

---
## **POST-Based SQL Injection Testing**

In some cases, applications send user input in the **request body** instead of the URL. This is known as **POST-based testing** and is commonly used in Login forms , Registration forms , Search forms.

To test such cases, the POST request must first be **intercepted and saved to a text file**. SQLMap can then read and test this request directly.

```EXAMPLE
sqlmap -r intercepted_request.txt
```

---
Remember :

Sometimes we cant show the values on the GET request also for that follow these steps :


Go to the developer mode and navigate to the ==`Network`== tab =

![[Pasted image 20260124003739.png]]

Send a request and then copy the url :
![[Pasted image 20260124003816.png]]

In the storage tab we can also found the session id :
PHPSESSID : 0rtiauhibqlbt6er35nb6hkh45

![[Pasted image 20260124003652.png]]