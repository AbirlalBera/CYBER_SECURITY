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

**2.How to create a user in Linux and give them sudo permission?**

```
Create a new user
sudo adduser username   //// 

OR with useradd (more basic)   //// 
sudo useradd -m -s /bin/bash username

Add user to sudo group (most common method)
sudo usermod -aG sudo username

Alternative: Add to wheel group (some distributions)
sudo usermod -aG wheel username
```

**Verify sudo access:**


```
Switch to the new user and test sudo
su - username
sudo whoami  # Should return "root"
```

-------------

How to revoke permissions?

-----------------

How to give a group (two users) full permissions and then revoke those permissions?


