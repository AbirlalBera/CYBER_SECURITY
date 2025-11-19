**1.Where are passwords stored in Linux?**

**Passwords are stored in these files:**

**/etc/passwd -** User account information (username, UID, GID, home directory, shell)

**/etc/shadow -** Encrypted passwords and password aging information (readable only by root)

**/etc/group -** Group information


bash

View password file
cat /etc/passwd

View shadow file (requires root)
sudo cat /etc/shadow

View group file
cat /etc/group