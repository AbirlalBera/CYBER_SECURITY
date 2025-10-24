Nmap  Scan :

rustscan -a 10.201.84.152 -- -sC -sV
.----. .-. .-. .----..---.  .----. .---.   .--.  .-. .-.
| {}  }| { } |{ {__ {_   _}{ {__  /  ___} / {} \ |  `| |
| .-. \| {_} |.-._} } | |  .-._} }\     }/  /\  \| |\  |
`-' `-'`-----'`----'  `-'  `----'  `---' `-'  `-'`-' `-'
The Modern Day Port Scanner.
________________________________________
: http://discord.skerritt.blog         :
: https://github.com/RustScan/RustScan :
 --------------------------------------
Port scanning: Making networking exciting since... whenever.

[~] The config file is expected to be at "/home/kali/.rustscan.toml"
[!] File limit is lower than default batch size. Consider upping with --ulimit. May cause harm to sensitive servers
[!] Your file limit is very small, which negatively impacts RustScan's speed. Use the Docker image, or up the Ulimit with '--ulimit 5000'. 
Open 10.201.84.152:21
Open 10.201.84.152:8081
Open 10.201.84.152:8080
[~] Starting Script(s)
[>] Running script "nmap -vvv -p {{port}} -{{ipversion}} {{ip}} -sC -sV" on ip 10.201.84.152
Depending on the complexity of the script, results may take some time to appear.
[~] Starting Nmap 7.95 ( https://nmap.org ) at 2025-10-24 20:24 IST
NSE: Loaded 157 scripts for scanning.
NSE: Script Pre-scanning.
NSE: Starting runlevel 1 (of 3) scan.
Initiating NSE at 20:24
Completed NSE at 20:24, 0.00s elapsed
NSE: Starting runlevel 2 (of 3) scan.
Initiating NSE at 20:24
Completed NSE at 20:24, 0.00s elapsed
NSE: Starting runlevel 3 (of 3) scan.
Initiating NSE at 20:24
Completed NSE at 20:24, 0.00s elapsed
Initiating Ping Scan at 20:24
Scanning 10.201.84.152 [4 ports]
Completed Ping Scan at 20:24, 0.25s elapsed (1 total hosts)
Initiating SYN Stealth Scan at 20:24
Scanning magician (10.201.84.152) [3 ports]
Discovered open port 8080/tcp on 10.201.84.152
Discovered open port 8081/tcp on 10.201.84.152
Discovered open port 21/tcp on 10.201.84.152
Completed SYN Stealth Scan at 20:24, 0.26s elapsed (3 total ports)
Initiating Service scan at 20:24
Scanning 3 services on magician (10.201.84.152)
Completed Service scan at 20:24, 18.08s elapsed (3 services on 1 host)
NSE: Script scanning 10.201.84.152.
NSE: Starting runlevel 1 (of 3) scan.
Initiating NSE at 20:24
Completed NSE at 20:25, 15.90s elapsed
NSE: Starting runlevel 2 (of 3) scan.
Initiating NSE at 20:25
Completed NSE at 20:25, 2.77s elapsed
NSE: Starting runlevel 3 (of 3) scan.
Initiating NSE at 20:25
Completed NSE at 20:25, 0.00s elapsed
Nmap scan report for magician (10.201.84.152)
Host is up, received reset ttl 60 (0.23s latency).
Scanned at 2025-10-24 20:24:34 IST for 37s

PORT     STATE SERVICE REASON         VERSION
21/tcp   open  ftp     syn-ack ttl 60 vsftpd 2.0.8 or later
8080/tcp open  http    syn-ack ttl 60 Apache Tomcat (language: en)
|_http-title: Site doesn't have a title (application/json).
8081/tcp open  http    syn-ack ttl 60 nginx 1.14.0 (Ubuntu)
|_http-favicon: Unknown favicon MD5: CA4D0E532A1010F93901DFCB3A9FC682
| http-methods: 
|_  Supported Methods: GET HEAD
|_http-server-header: nginx/1.14.0 (Ubuntu)
|_http-title: magician
Service Info: OS: Linux; CPE: cpe:/o:linux:linux_kernel

NSE: Script Post-scanning.
NSE: Starting runlevel 1 (of 3) scan.
Initiating NSE at 20:25
Completed NSE at 20:25, 0.00s elapsed
NSE: Starting runlevel 2 (of 3) scan.
Initiating NSE at 20:25
Completed NSE at 20:25, 0.00s elapsed
NSE: Starting runlevel 3 (of 3) scan.
Initiating NSE at 20:25
Completed NSE at 20:25, 0.00s elapsed
Read data files from: /usr/share/nmap
Service detection performed. Please report any incorrect results at https://nmap.org/submit/ .
Nmap done: 1 IP address (1 host up) scanned in 37.69 seconds
           Raw packets sent: 7 (284B) | Rcvd: 4 (172B)

