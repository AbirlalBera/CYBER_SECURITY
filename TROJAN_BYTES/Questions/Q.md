## 1. What is Sniffing?

**Sniffing** is the process of **capturing and analyzing network traffic**.

- An attacker or admin uses a **packet sniffer** (like Wireshark)
    
- It captures data packets traveling over a network
    
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

|Port|Service|
|---|---|
|20/21|FTP|
|22|SSH|
|23|Telnet|
|25|SMTP|
|53|DNS|
|80|HTTP|
|110|POP3|
|143|IMAP|
|443|HTTPS|
|3306|MySQL|
|3389|RDP|

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

`systemctl start apache2 systemctl stop apache2 systemctl restart apache2 systemctl status apache2`