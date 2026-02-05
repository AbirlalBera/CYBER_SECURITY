Nmap or Rustscan Scanning :

```
nmap -Pn -n -A -sV -sC -O target.com
```


---
Subdomain Discovery :

---
Directory Finding :

```
dirsearch –u <URL>
dirsearch -u <URL> -i 200 -r -w /usr/share/wordlists/dirb/big.txt
```

```
dirb <URL>
dirb <URL< -X
```

```
ffuf -u <URL>/FUZZ -w wordlist
```

---
