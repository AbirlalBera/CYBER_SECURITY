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