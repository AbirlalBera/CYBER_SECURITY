# Find the system IP

```
sudo netdiscover -f
```

![[Pasted image 20260215115159.png]]

Target IP : 192.168.229.135

---

# Scanning 

```
nmap -Pn -n -A -sV -sC -O 192.168.229.135
```


![[Pasted image 20260215180219.png]]
### **Open Ports:**

| Port      | Service    | Version / Details                         |
| --------- | ---------- | ----------------------------------------- |
| **21**    | FTP        | Pure-FTPd                                 |
| **22**    | SSH        | Modified Dropbear (Linksys WRT45G themed) |
| **53**    | DNS        | BIND                                      |
| **80**    | HTTP       | Apache                                    |
| **143**   | IMAP       | Filtered                                  |
| **3306**  | MySQL      | Filtered                                  |
| **5432**  | PostgreSQL | 9.6.x                                     |
| **10000** | HTTP       | Webmin 1.590 (MiniServ)                   |

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

```
user : robinarryn
pass : cr0wn_f0r_a_King-_
db : mountainandthevale
```

Lets try to login
```
psql -h 192.168.229.135 -U robinarryn -d mountainandthevale
```

```
\dt
```

![[Pasted image 20260215165925.png]]

```
SELECT * FROM aryas_kill_list;
```

![[Pasted image 20260215170619.png]]

```
 id |         name          |                               why                      
  1 | WalderFrey            | For orchestrating the Red Wedding
  2 | CerseiLannister       | For her role in Ned Starks death
  3 | TheMountain           | For the torture at Harrenhal
  4 | TheHound              | For killing Mycah, the butchers boy
  5 | TheRedWomanMelisandre | For kidnapping Gendry
  6 | BericDondarrion       | For selling Gendry to Melisandre
  7 | ThorosofMyr           | For selling Gendry to Melisandre
  8 | IlynPayne             | For executing Ned Stark
  9 | MerynTrant            | For killing Syrio Forel
 10 | JoffreyBaratheon      | For ordering Ned Starks execution
 11 | TywinLannister        | For orchestrating the Red Wedding
 12 | Polliver              | For killing Lommy, stealing Needle and the torture at Harrenhal
 13 | Rorge                 | For the torture at Harrenhal and threatening to rape her
```

```
SELECT * FROM braavos_book;
```

![[Pasted image 20260215170729.png]]

```

 1 | City of Braavos is a very particular place. It is not so far from here.
 2 | "There is only one god, and his name is Death. And there is only one thing we say to Death: Not today" - Syrio Forel
 3 | Braavos have a lot of curious buildings. The Iron Bank of Braavos, The House of Black and White, The Titan of Braavos, etc.
 4 | "A man teaches a girl. -Valar Dohaeris- All men must serve. Faceless Men most of all" - Jaqen H'ghar
 6 | "A girl has no name" - Arya Stark
 7 | City of Braavos is ruled by the Sealord, an elected position.
 8 | "That man's life was not yours to take. A girl stole from the Many-Faced God. Now a debt is owed" - Jaqen H'ghar
 9 | Dro wkxi-pkmon qyn gkxdc iye dy mrkxqo iyeb pkmo. Ro gkxdc iye dy snoxdspi kc yxo yp iyeb usvv vscd. Covomd sd lkcon yx drsc lyyu'c vycd zkqo xewlob. Dro nkdklkco dy myxxomd gsvv lo lbkkfyc kxn iyeb zkccgybn gsvv lo: FkvkbWybqrevsc

```

Here the 9th line might say something:
```
Dro wkxi-pkmon qyn gkxdc iye dy mrkxqo iyeb pkmo. Ro gkxdc iye dy snoxdspi kc yxo yp iyeb usvv vscd. Covomd sd lkcon yx drsc lyyu'c vycd zkqo xewlob. Dro nkdklkco dy myxxomd gsvv lo lbkkfyc kxn iyeb zkccgybn gsvv lo: FkvkbWybqrevsc
```

It might be a ROT cipher :
![[Pasted image 20260215172606.png]]

![[Pasted image 20260215172944.png]]

Decrypted Text
```
The many-faced god wants you to change your face. He wants you to identify as one of your kill list. Select it based on this book's lost page number. The database to connect will be braavos and your password will be: ValarMorghulis
```

It says that one of the person from the kill list on the basis of book's lost page number we have to connect the database braavos using ValarMorghulis password.

```
SELECT * FROM eyrie;
```

![[Pasted image 20260215171308.png]]

```
1 | Lysa Arryn                   | We were allies for centuries. We can negotiate the peace if you win this mind game
2 | Robin Arryn                  | The flag is hidden somewhere on this dungeon. You'll never find it. Ha ha ha!
3 | Mord                         | You'll be thrown into one of the sky cells!!
4 | Petyr (Littlefinger) Baelish | I'm here to help as always... If you OWN your destiny you can do anything
5 | Tyrion Lannister             | Books say stupid things sometimes like people do. You have to decide what to believe and what could be useful. The best choice for me is to be drunk
```

```
SELECT * FROM popular_wisdom_book ;
```

![[Pasted image 20260215171537.png]]

```
1 | The First Men are the original human inhabitants of Westeros
2 | The King's Landing main gates are closed by orders of the Queen. Nobody can pass, and it seems something permanent
3 | The High Garden citizens never were great warriors, they are POLITE people. If you want to enter to their fortress you only need to Knock at the gates but following their rules... they like order
4 | A Lannister always pays his debts
5 | The old arcane Docker magic is present over all the kingdoms. Usually you can't use it to move between them but there is a secret tunnel from The Rock to King's Landing, everybody knows that
6 | The Iron Bank has the control. They can give you anything you want if you pay enough...
```

Now lets test all the user to log in using `ValarMorghulis` password and the database was braavos
finally we found the 
username : TheRedWomanMelisandre
password : ValarMorghulis
database : braavos

```
psql -h 192.168.229.135 -U TheRedWomanMelisandre -d braavos
```

```
SELECT * FROM temple_of_the_faceless_men;
```

![[Pasted image 20260215175030.png]]

```
3f82c41a70a8b0cfec9052252d9fd721 | Congratulations. You've found the secret flag at City of Braavos. You've served well to the Many-Faced God.
(1 row)
```

Finally we got the fifth flag : ==`3f82c41a70a8b0cfec9052252d9fd721`==

**Our next target is  kingdom of the Reach for that we have to connect with the imap**

The High Garden citizens never were great warriors, they are POLITE people. If you want to enter to their fortress you only need to Knock at the gates but following their rules... they like order

popular_wisdom_book 

and the password from : 3487 64535 12345 . Remember these numbers, you'll need to use them with POLITE people you'll know when to use them

---
