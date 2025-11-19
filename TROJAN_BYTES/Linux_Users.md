**1.Where are passwords stored in Linux?**

**Passwords are stored in these files:**

**/etc/passwd -** User account information (username, UID, GID, home directory, shell)

**/etc/shadow -** Encrypted passwords and password aging information (readable only by root)

**/etc/group -** Group information


```

cat /etc/passwd   //// View password file


sudo cat /etc/shadow   //// View shadow file (requires root)


cat /etc/group   //// View group file
```

---------

How to create a user in Linux and give them sudo permission?

-------------

How to revoke permissions?

-----------------

How to give a group (two users) full permissions and then revoke those permissions?

-------------

how to connect ssh without puting your passwod every single time?
