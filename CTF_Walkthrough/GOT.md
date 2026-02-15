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

Hints :
"Everything can be TAGGED in this world, even the magic or the music" - Bronn of the Blackwater
 looking at **ID3 tags**

1. **Hint 1 (Bronn):** _"Everything can be TAGGED in this world, even the magic or the music"_

- This strongly suggests looking at **ID3 tags** (metadata) in audio files. There might be a hidden music file on the web server with clues in its tags.

2. **Hint 2 (Ellaria Sand):** _"To enter in Dorne you'll need to be a kind face"_

- This points to the first kingdom, **Dorne**. "A kind face" is a reference to the Faceless Men. This hints at some form of **masquerading or impersonation**, perhaps by modifying HTTP headers (like `User-Agent` or `Referer`) to look like a specific client or referrer.


```
http://192.168.229.135/robots.txt

User-agent: Three-eyed-raven
Allow: /the-tree/
User-agent: *
Disallow: /secret-island/
Disallow: /direct-access-to-kings-landing/
```

```
http://192.168.229.135/the-tree/
```

![[Pasted image 20260215121323.png]]



---
