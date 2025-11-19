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

OR

Alternative: Add to wheel group (some distributions)
sudo usermod -aG wheel username



Step 4: Verify User and Group Membership

id username




Step 5: Test 

su - username
sudo whoami


```


-------------

##  **How to revoke permissions?**

```


Step 1: Remove user from sudo group
sudo deluser username sudo

Step 2: Remove from wheel group
sudo deluser username wheel

Step 3: Lock user account
sudo passwd -l username

Step 4: Delete user account
sudo userdel -r username


```

-----------------

##  **How to give a group (two users) full permissions and then revoke those permissions? **

```
Step 1: Create a group

sudo groupadd mygroup




Step 2: Add users to group

sudo usermod -aG mygroup user1
sudo usermod -aG mygroup user2




Step 3: Give group full permissions to a directory

sudo chgrp mygroup /path/to/directory
sudo chmod 770 /path/to/directory  # rwx for owner and group




Step 4: Revoke permissions

sudo chmod 750 /path/to/directory  # Remove group write access

OR

sudo chmod 700 /path/to/directory  # Remove all group access
```

