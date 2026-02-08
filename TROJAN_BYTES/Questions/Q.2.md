## 1. What is Sniffing?

**Sniffing** is the process of **capturing and analyzing network traffic**.

- An attacker or admin uses a **packet sniffer** (like Wireshark)
- It captures data packets traveling over a networ
- Can be **legitimate** (troubleshooting) or **malicious** (stealing passwords)

👉 Example: Capturing usernames/passwords sent over **HTTP** (not encrypted)

---
## 2. What is an IP Address?

An **IP address** is a **unique numerical identifier** assigned to a device on a network.

### Types:

- **IPv4**: `192.168.1.1` (32-bit)
- **IPv6**: `2001:0db8::1` (128-bit)
### Categories:

- **Public IP** – used on the internet
- **Private IP** – used inside local networks

---

## 3. OWASP Top 10

The **OWASP Top 10** is a list of the **most critical web application security risks**.

### Common OWASP Top 10 (latest themes):

1. Broken Access Control
2. Cryptographic Failures
3. Injection (SQL Injection, XSS, etc.)
4. Insecure Design
5. Security Misconfiguration
6. Vulnerable & Outdated Components
7. Identification & Authentication Failures
8. Software & Data Integrity Failures
9. Security Logging & Monitoring Failures
10. Server-Side Request Forgery (SSRF)

2025

1. A01:2025 - Broken Access Control
2. A02:2025 - Security Misconfiguration
3. A03:2025 - Software Supply Chain Failures](https://owasp.org/Top10/2025/A03_2025-Software_Supply_Chain_Failures/)
4. A04:2025 - Cryptographic Failures](https://owasp.org/Top10/2025/A04_2025-Cryptographic_Failures/)
5. A05:2025 - Injection](https://owasp.org/Top10/2025/A05_2025-Injection/)
6. A06:2025 - Insecure Design](https://owasp.org/Top10/2025/A06_2025-Insecure_Design/)
7. A07:2025 - Authentication Failures](https://owasp.org/Top10/2025/A07_2025-Authentication_Failures/)
8. A08:2025 - Software or Data Integrity Failures](https://owasp.org/Top10/2025/A08_2025-Software_or_Data_Integrity_Failures/)
9. A09:2025 - Security Logging and Alerting Failures](https://owasp.org/Top10/2025/A09_2025-Security_Logging_and_Alerting_Failures/)
10. [A10:2025 - Mishandling of Exceptional Conditions](https://owasp.org/Top10/2025/A10_2025-Mishandling_of_Exceptional_Conditions/)

---

## 4. Layers in OSI Model

The **OSI model** has **7 layers** (bottom → top):

1. **Physical** – cables, signals

2. **Data Link** – MAC address, switches

3. **Network** – IP address, routers

4. **Transport** – TCP / UDP

5. **Session** – session management

6. **Presentation** – encryption, compression

7. **Application** – HTTP, FTP, SMTP

📌 Mnemonic: **Please Do Not Throw Sausage Pizza Away**

---
## 5. What is ARP Poisoning?

**ARP Poisoning (ARP Spoofing)** is a **Man-in-the-Middle attack**.

- Attacker sends fake ARP messages

- Associates attacker’s MAC address with victim’s IP

- Attacker intercepts or modifies traffic

👉 Common in local networks

---
## 6. DNS Records

**DNS records** tell the internet how to handle domain requests.

### Common DNS records:

- **A** – Maps domain → IPv4 address

- **AAAA** – Maps domain → IPv6 address

- **CNAME** – Alias of another domain

- **MX** – Mail server

- **NS** – Name server

- **TXT** – Verification, SPF, DKIM

- **PTR** – Reverse DNS lookup


---

## 7. What is SMTP & Why Multiple Protocols?

**SMTP (Simple Mail Transfer Protocol)** is used to **send emails**.

### Why multiple protocols for email?

Because **one protocol can’t do everything efficiently**:

- **SMTP** → Send mail

- **POP3** → Download mail

- **IMAP** → Sync & manage mail on server


Each protocol has a **specific role**, making email more reliable and scalable.

---

## 8. Which Port is Used by SQL?

Depends on the database:

- **MySQL** → `3306`
- **PostgreSQL** → `5432`
- **MS SQL Server** → `1433`
- **Oracle DB** → `1521`

---

## 9. All Ports? (Common Ports List)

Not literally _all_ (there are 65,535), but here are **important ones**:
## Well-Known & Basic Ports (0–1023)

| Port | Protocol | Service            |
| ---- | -------- | ------------------ |
| 20   | TCP      | ==FTP (Data)==     |
| 21   | TCP      | ==FTP (Control)==  |
| 22   | TCP      | ==SSH==            |
| 23   | TCP      | ==Telnet==         |
| 25   | TCP      | ==SMTP==           |
| 53   | TCP/UDP  | ==DNS==            |
| 67   | UDP      | ==DHCP (Server)==  |
| 68   | UDP      | ==DHCP (Client)==  |
| 69   | UDP      | ==TFTP==           |
| 80   | TCP      | ==HTTP==           |
| 110  | TCP      | ==POP3==           |
| 119  | TCP      | NNTP               |
| 123  | UDP      | NTP                |
| 137  | UDP      | NetBIOS Name       |
| 138  | UDP      | NetBIOS Datagram   |
| 139  | TCP      | NetBIOS Session    |
| 143  | TCP      | ==IMAP==           |
| 161  | UDP      | ==SNMP==           |
| 162  | UDP      | SNMP Trap          |
| 179  | TCP      | ==BGP==            |
| 194  | TCP      | IRC                |
| 389  | TCP/UDP  | ==LDAP==           |
| 443  | TCP      | ==HTTPS==          |
| 445  | TCP      | ==SMB==            |
| 465  | TCP      | ==SMTPS==          |
| 500  | UDP      | ISAKMP (IPSec)     |
| 514  | UDP      | Syslog             |
| 515  | TCP      | LPD Printing       |
| 520  | UDP      | ==RIP==            |
| 587  | TCP      | ==SMTP (TLS)==     |
| 636  | TCP      | ==LDAPS==          |
| 989  | TCP      | ==FTPS (Data)==    |
| 990  | TCP      | ==FTPS (Control)== |
| 993  | TCP      | ==IMAPS==          |
| 995  | TCP      | ==POP3S==          |
## 🔹 Registered Ports (1024–49151)

| Port | Service           |
| ---- | ----------------- |
| 1433 | ==MS SQL Server== |
| 1521 | Oracle DB         |
| 2049 | NFS               |
| 2082 | cPanel            |
| 2083 | cPanel SSL        |
| 2181 | ZooKeeper         |
| 3000 | Dev Servers       |
| 3306 | ==MySQL==         |
| 3389 | ==RDP==           |
| 3690 | Subversion        |
| 4444 | ==Metasploit==    |
| 5432 | ==PostgreSQL==    |
| 5601 | Kibana            |
| 5900 | VNC               |
| 5985 | WinRM             |
| 5986 | WinRM SSL         |
| 6379 | Redis             |
| 7001 | WebLogic          |
| 8000 | HTTP Alternate    |
| 8080 | ==HTTP Proxy==    |
| 8443 | HTTPS Alternate   |
| 9000 | PHP-FPM           |

---
## 10. Service Operations like Apache

**Apache** is a **web server service**.

### Common Apache service operations:

- **Start** – Start the web server

- **Stop** – Stop the service

- **Restart** – Apply config changes

- **Reload** – Reload config without dropping connections

- **Status** – Check if running

### Example (Linux):

```
systemctl start apache2 
systemctl stop apache2 
systemctl restart apache2 
systemctl status apache2
```
