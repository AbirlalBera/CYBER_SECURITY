# 🛡️ Nmap Scan — 192.168.229.129 (Metasploitable VM)
**Scan:** `nmap -sV -p- -O` · **Date:** 2025-10-21 00:18 IST  
**Host:** metasploitable.localdomain · **MAC:** `00:0C:29:5C:DF:B8` (VMware)

---

## Summary
> **Device:** Linux (2.6.x) — likely a Metasploitable VM.  
> **Network distance:** 1 hop.  
> **Action:** isolate and remediate high-risk services immediately.

---

## Legend
<span style="display:inline-block;padding:2px 8px;border-radius:999px;background:#e74c3c;color:white;font-weight:600">HIGH</span>
<span style="display:inline-block;padding:2px 8px;border-radius:999px;background:#f39c12;color:white;font-weight:600">MED</span>
<span style="display:inline-block;padding:2px 8px;border-radius:999px;background:#2ecc71;color:white;font-weight:600">LOW</span>

---

## Services & Recommendations

| Port | Proto | Service (detected) | Version / Details | Risk |
|---:|:---:|:---|:---|:---:|
| **21** | tcp | **ftp** | vsftpd **2.3.4** | <span style="background:#e74c3c;color:white;padding:3px 8px;border-radius:6px">HIGH</span> |
| **22** | tcp | **ssh** | OpenSSH **4.7p1** | <span style="background:#f39c12;color:white;padding:3px 8px;border-radius:6px">MED</span> |
| **23** | tcp | **telnet** | telnetd | <span style="background:#e74c3c;color:white;padding:3px 8px;border-radius:6px">HIGH</span> |
| **25** | tcp | smtp | Postfix smtpd | <span style="background:#f39c12;color:white;padding:3px 8px;border-radius:6px">MED</span> |
| **53** | tcp | domain | ISC BIND **9.4.2** | <span style="background:#f39c12;color:white;padding:3px 8px;border-radius:6px">MED</span> |
| **80** | tcp | http | Apache **2.2.8** | <span style="background:#f39c12;color:white;padding:3px 8px;border-radius:6px">MED</span> |
| **111** | tcp | rpcbind | rpcbind 2 | <span style="background:#f39c12;color:white;padding:3px 8px;border-radius:6px">MED</span> |
| **139** | tcp | netbios-ssn | Samba smbd 3.x-4.x | <span style="background:#e74c3c;color:white;padding:3px 8px;border-radius:6px">HIGH</span> |
| **445** | tcp | netbios-ssn | Samba smbd 3.x-4.x | <span style="background:#e74c3c;color:white;padding:3px 8px;border-radius:6px">HIGH</span> |
| **512** | tcp | exec | netkit-rsh rexecd | <span style="background:#e74c3c;color:white;padding:3px 8px;border-radius:6px">HIGH</span> |
| **513** | tcp | login? | rlogin-like | <span style="background:#e74c3c;color:white;padding:3px 8px;border-radius:6px">HIGH</span> |
| **514** | tcp | tcpwrapped | wrapped | <span style="background:#e74c3c;color:white;padding:3px 8px;border-radius:6px">HIGH</span> |
| **1099** | tcp | java-rmi | GNU Classpath grmiregistry | <span style="background:#e74c3c;color:white;padding:3px 8px;border-radius:6px">HIGH</span> |
| **1524** | tcp | bindshell | Metasploitable root shell | <span style="background:#c0392b;color:white;padding:3px 8px;border-radius:6px">CRITICAL</span> |
| **2049** | tcp | nfs | NFS 2-4 | <span style="background:#e74c3c;color:white;padding:3px 8px;border-radius:6px">HIGH</span> |
| **2121** | tcp | ftp | ProFTPD **1.3.1** | <span style="background:#f39c12;color:white;padding:3px 8px;border-radius:6px">MED</span> |
| **3306** | tcp | mysql | MySQL **5.0.51a** | <span style="background:#e74c3c;color:white;padding:3px 8px;border-radius:6px">HIGH</span> |
| **3632** | tcp | distccd | distccd v1 | <span style="background:#e74c3c;color:white;padding:3px 8px;border-radius:6px">HIGH</span> |
| **5432** | tcp | postgresql | PostgreSQL **8.3.x** | <span style="background:#e74c3c;color:white;padding:3px 8px;border-radius:6px">HIGH</span> |
| **5900** | tcp | vnc | VNC (3.3) | <span style="background:#e74c3c;color:white;padding:3px 8px;border-radius:6px">HIGH</span> |
| **6000** | tcp | X11 | access denied | <span style="background:#f39c12;color:white;padding:3px 8px;border-radius:6px">MED</span> |
| **6667** | tcp | irc | UnrealIRCd | <span style="background:#f39c12;color:white;padding:3px 8px;border-radius:6px">MED</span> |
| **6697** | tcp | irc (ssl) | UnrealIRCd | <span style="background:#f39c12;color:white;padding:3px 8px;border-radius:6px">MED</span> |
| **8009** | tcp | ajp13 | Apache JServ AJP | <span style="background:#e74c3c;color:white;padding:3px 8px;border-radius:6px">HIGH</span> |
| **8180** | tcp | http | Tomcat/Coyote JSP | <span style="background:#e74c3c;color:white;padding:3px 8px;border-radius:6px">HIGH</span> |
| **8787** | tcp | drb | Ruby DRb (Ruby 1.8) | <span style="background:#e74c3c;color:white;padding:3px 8px;border-radius:6px">HIGH</span> |
| **33889** | tcp | status | RPC | <span style="background:#f39c12;color:white;padding:3px 8px;border-radius:6px">MED</span> |
| **45753** | tcp | java-rmi | GNU Classpath grmiregistry | <span style="background:#e74c3c;color:white;padding:3px 8px;border-radius:6px">HIGH</span> |
| **55233** | tcp | nlockmgr | NLM 1-4 | <span style="background:#f39c12;color:white;padding:3px 8px;border-radius:6px">MED</span> |
| **59979** | tcp | mountd | mountd 1-3 | <span style="background:#e74c3c;color:white;padding:3px 8px;border-radius:6px">HIGH</span> |


