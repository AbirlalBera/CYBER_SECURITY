
privilege escalation :  Privilege Escalation usually involves going from a lower permission account to a higher permission one. More technically, it's the exploitation of a vulnerability, design flaw, or configuration oversight in an operating system or application to gain unauthorized access to resources that are usually restricted from the users.

Privilege escalation is crucial because it lets you gain system administrator levels of access, which allows you to perform actions such as:

Resetting passwords
Bypassing access controls to compromise protected data
Editing software configuration
Enabling persistence
Changing the privilege of existing (or new) users
Execute any administrative command

-----------------------------

# COMMANDS:

hostname : The hostname command will return the hostname of the target machine.

uname -a : Will print system information giving us additional detail about the kernel used by the system. This will be useful when searching for any potential kernel vulnerabilities that could lead to privilege escalation.

/proc/version : The proc filesystem (procfs) provides information about the target system processes. You will find proc on many different Linux flavours, making it an essential tool to have in your arsenal.Looking at /proc/version may give you information on the kernel version and additional data such as whether a compiler (e.g. GCC) is installed.

/etc/issue :  Systems can also be identified by looking at the /etc/issue file. This file usually contains some information about the operating system but can easily be customized or changed. While on the subject, any file containing system information can be customized or changed. For a clearer understanding of the system, it is always good to look at all of these.

### ps Command 

The ps command is an effective way to see the running processes on a Linux system. Typing ps on your terminal will show processes for the current shell. 





