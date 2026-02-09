**Target Ip :** 
```
10.49.160.137
```

-----------
# Scanning using RustScan 

```
rustscan -a 10.49.160.137 -- -sC -sV 
```

We found open ports :  
```
Open 10.49.160.137:22
Open 10.49.160.137:21
Open 10.49.160.137:80
```

These are the service running on the server :
![[Pasted image 20260209215212.png]]

There was a web service running on port 80

---
Now we are trying to find the subdomains :

```
subfinder -d http://10.49.160.137
```

![[Pasted image 20260209215314.png]]

We would not find any subdomains.

---
Now we are trying to find the directories :

```
dirsearch -u "http://10.49.160.137"
```
![[Pasted image 20260209215627.png]]

**From these we found a juicy directory :**
```
http://10.49.160.137/secret/ 
```

---
We are trying to login with ftp 
![[Pasted image 20260209223506.png]]

```
ftp 10.49.160.137 
```

we found a note.txt file. Lets download it -

```
get note.txt
```

```
cat note.txt 

Anurodh told me that there is some filtering on strings being put in the command 
-- Apaar
```

Here we got  two name : 
Anurodh 

Apaar

---

