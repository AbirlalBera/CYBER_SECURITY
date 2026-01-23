

Let’s take an example of a login page that asks you to enter your username and password to log in. Let’s provide it with the following data:

`Username: John`

`Password: Un@detectable444`

Once you enter your username and password, the website will receive it, make an SQL query with your credentials, and send it to the database. 

```php
SELECT * FROM users WHERE username = 'John' AND password = 'Un@detectable444';
```