# Find the system IP

```
sudo netdiscover -f
```

![[Pasted image 20260215115159.png]]

GOT IP : 192.168.229.135

---

# Scanning 

```
rustscan -a 192.168.229.135 -- -sC -sV -O
```

![[Pasted image 20260215115511.png]]

![[Pasted image 20260215115553.png]]

### **Open Ports:**

| Port      | Service    | Notes                                                |
| --------- | ---------- | ---------------------------------------------------- |
| **21**    | FTP        | Pure-FTPd                                            |
| **22**    | SSH        | Modified dropbear (Linksys router-themed)            |
| **53**    | DNS        | Bind                                                 |
| **80**    | HTTP       | Apache - Game of Thrones CTF                         |
| **1337**  | HTTP       | nginx - "Welcome to Casterly Rock" (HTTP Basic Auth) |
| **5432**  | PostgreSQL | 9.6.x                                                |
| **10000** | HTTP       | Webmin 1.590 - "Login to Stormlands"                 |

---
### Port 80 - Main Website

![[Pasted image 20260215120513.png]]

![[Pasted image 20260215120528.png]]

There are seven kingdoms or 7 flags 
