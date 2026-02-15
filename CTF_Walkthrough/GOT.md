# Find the system IP

```
sudo netdiscover -f
```

![[Pasted image 20260215115159.png]]

Target IP : 192.168.229.135

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

NOTE :
"You mUSt changE your own shape and foRm if you wAnt to GEt the right aNswer from the Three-eyed raven" - Written on the tree by somebody

```
http://192.168.229.135/secret-island/
```

![[Pasted image 20260215121440.png]]

NOTE : 
"Take this map and use it wisely. I want to be your friend" - Petyr (Littlefinger) Baelish

We found the full MAP
![[Pasted image 20260215121831.png]]

```
http://192.168.229.135/direct-access-to-kings-landing/
```

![[Pasted image 20260215121947.png]]

NOTE :
"I've heard the savages usually play music. They are not as wild as one can expect, are they?" - Sansa Stark

After changing the User-Agent: Three-eyed-raven of  http://192.168.229.135/the-tree/

![[Pasted image 20260215123615.png]]

![[Pasted image 20260215132618.png]]

NOTE :
"Music reaches where words can't. It's known even for the animals" - Catelyn Stark

NOTE :
```
<!-- 
"I will give you three hints, I can see the future so listen carefully" - The three-eyed raven Bran Stark

"To enter in Dorne you must identify as oberynmartell. You still should find the password"

"3487 64535 12345 . Remember these numbers, you'll need to use them with POLITE people you'll know when to use them" 

"The savages never crossed the wall. So you must look for them before crossing it"
-->
```


---
# Directory Bruteforcing


```
http://192.168.229.135/js/game_of_thrones.js
```


![[Pasted image 20260215132926.png]]

```
/*
"You'll never enter into King's Landing through the main gates. The queen ordered to close them permanently until the end of the war" - Tywin Lannister

"If you put a city under siege, after five attacks you'll be banned two minutes" - Aegon the Conqueror and His Conquest of Westeros Book
*/
```


```
http://192.168.229.135/css/game_of_thrones.css
```

![[Pasted image 20260215133113.png]]

```
"Music reaches where words can't. It's known even for the animals" - Catelyn Stark
```

```
http://192.168.229.135/sitemap.xml
```

![[Pasted image 20260215134739.png]]

```
http://192.168.229.135/raven.php
```

![[Pasted image 20260215134824.png]]

```
<!--
You received a raven with this message:
"To pass through the wall, mcrypt spell will help you. It doesn't matter who you are, only the key is needed to open the secret door" - Anonymous
-->
```


```
http://192.168.229.135/h/i/d/d/e/n/
```

![[Pasted image 20260215133948.png]]

```
"My little birds are everywhere. To enter in Dorne you must say: A_verySmallManCanCastAVeryLargeShad0w . Now, you owe me" - Lord (The Spider) Varys
"Powerful docker spells were cast over all kingdoms. We must be careful! You can't travel directly from one to another... usually. That's what the Lord of Light has shown me" - The Red Woman Melisandre
```

Finally we found  the credentials for drone :

username : oberynmartell
password : A_verySmallManCanCastAVeryLargeShad0w

---
# ftp Bypass 

username : oberynmartell
password : A_verySmallManCanCastAVeryLargeShad0w

![[Pasted image 20260215140624.png]]

Download the files from ftp :

```
get problems_in_the_north.txt

get the_wall.txt.nc
```

![[Pasted image 20260215140736.png]]

If we read the problems_in_the_north.txt
![[Pasted image 20260215143355.png]]
we will find a hash : 6000e084bf18c302eae4559d48cb520c$2hY68a

First analyse the file type of the_wall.txt.nc :
```
file the_wall.txt.nc 
```

Output : the_wall.txt.nc: mcrypt 2.5 encrypted data, algorithm: rijndael-128, keysize: 32 bytes, mode: cbc,

It is a encrypted file.

Next Crack the hash of problems_in_the_north.txt

```
john --format=dynamic_2008 secret.txt
```

![[Pasted image 20260215143708.png]]

We got the passphrase of the_wall.txt.nc :

```
stark
```

```
mcrypt -d the_wall.txt.nc
```

![[Pasted image 20260215145305.png]]

```
"We defended the wall. Thanks for your help. Now you can go to recover Winterfell" - Jeor Mormont, Lord Commander of the Night's Watch

"I'll write on your map this route to get faster to Winterfell. Someday I'll be a great maester" - Samwell Tarly

http://winterfell.7kingdoms.ctf/------W1nt3rf3ll------
Enter using this user/pass combination:
User: jonsnow
Pass: Ha1lt0th3k1ng1nth3n0rth!!!
```

Now add the domain winterfell.7kingdoms.ctf to /etc/hosts
```
sudo nano /etc/hosts
```

![[Pasted image 20260215150437.png]]

![[Pasted image 20260215150320.png]]

![[Pasted image 20260215150341.png]]

![[Pasted image 20260215150702.png]]

In the viewsource section we found the second flag : ==`639bae9ac6b3e1a84cebb7b403297b79`==

```
<!--
Welcome to Winterfell
You conquered the Kingdom of the North. This is your second kingdom flag!
639bae9ac6b3e1a84cebb7b403297b79
"We must do something here before travelling to Iron Islands, my lady" - Podrick Payne
"Yeah, I can feel the magic on that shield. Swords are no more use here" - Brienne Tarth
-->
```

Also we have downloaded a image called stark_shield.jpg ,Lets check  if it contains anything :
![[Pasted image 20260215152052.png]]

```
xxd stark_shield.jpg
```

![[Pasted image 20260215153024.png]]

```
"Timef0rconqu3rs TeXT should be asked to enter into the Iron Islands fortress" 
- Theon Greyjoy
```

Now we make a new url by the reference of `http://winterfell.7kingdoms.ctf/------W1nt3rf3ll------` this Url

```
Timef0rconqu3rs.7Kingdoms.ctf
```


---

# DNS

```
nslookup -q=txt Timef0rconqu3rs.7Kingdoms.ctf 192.168.229.135
```

![[Pasted image 20260215154029.png]]

```
Timef0rconqu3rs.7kingdoms.ctf   text = "You conquered Iron Islands kingdom flag: 5e93de3efa544e85dcd6311732d28f95. Now you should go to Stormlands at http://stormlands.7kingdoms.ctf:10000 . Enter using this user/pass combination: aryastark/N3ddl3_1s_a_g00d_sword#!"
```

Finally we got Iron Islands kingdom flag: ==`5e93de3efa544e85dcd6311732d28f95`==

It also tells us to visit :
```
http://stormlands.7kingdoms.ctf:10000
```

To open the site we add the new domain name to /etc/hosts
![[Pasted image 20260215154610.png]]

![[Pasted image 20260215154627.png]]
user : aryastark
pass combination: N3ddl3_1s_a_g00d_sword#!

This is a webmin site :
![[Pasted image 20260215154900.png]]

Now search for file manager 
![[Pasted image 20260215163609.png]]

If this problem will occur add into chrome
![[Pasted image 20260215164622.png]]
Now to open the page add CheerpJ Applet Runner into chrome :
![[Pasted image 20260215164738.png]]

Now download the file flag.txt by clicking save button :

![[Pasted image 20260215164940.png]]

![[Pasted image 20260215165007.png]]
```
Welcome to:
 _____ _                 _           _     
|   __| |_ ___ ___ _____| |___ ___ _| |___ 
|__   |  _| . |  _|     | | . |   | . |_ -|
|_____|_| |___|_| |_|_|_|_|__,|_|_|___|___|

Congratulations! you conquered Stormlands. This is your flag: 8fc42c6ddf9966db3b09e84365034357

Now prepare yourself for the next challenge!

The credentials to access to the Mountain and the Vale kingdom are:
user/pass: robinarryn/cr0wn_f0r_a_King-_
db: mountainandthevale

pgAdmin magic will not work. Command line should be used on that kingdom - Talisa Maegyr

```

We got the fourth flag : ==`8fc42c6ddf9966db3b09e84365034357`==

also we got The credentials to access to the Mountain and the Vale kingdom are:

user : robinarryn
pass : cr0wn_f0r_a_King-_
db : mountainandthevale

---

# postgresql

There was a postgresql database running on port 5432 

user : robinarryn
pass : cr0wn_f0r_a_King-_
db : mountainandthevale

Lets try to login
```
psql -h 192.168.229.135 -U robinarryn -d mountainandthevale
```

```
\dt
```
![[Pasted image 20260215165925.png]]




