## **1.Where are passwords stored in Linux?**

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

## **2.How to create a user in Linux and give them sudo permission?**

```

Step 1: Create a New User

sudo adduser username    OR   sudo useradd -m -s /bin/bash username 




Step 2: Set Password (if using useradd)

sudo passwd username




Step 3: Add User to Sudo Group

sudo usermod -aG sudo username   





Step 4: Verify User and Group Membership

id username




Step 5: Test 

su - username
sudo whoami


```


-------------

##  **How to revoke permissions?**

```
# Remove user from sudo group
sudo deluser username sudo

# Remove from wheel group
sudo deluser username wheel

# Lock user account
sudo passwd -l username

# Delete user account
sudo userdel -r username
```

-----------------

How to give a group (two users) full permissions and then revoke those permissions?


