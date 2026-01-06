
# 1.Subdomain 

subfinder

```
subfinder -d target.com -o subdomains.txt
```

Assetfinder

```
assetfinder --subs-only target.com >> subdomains.txt
```

Amass

```
amass enum -passive -d target.com -o subdomains.txt
```

---
# 2.Port Scanning

Masscan

```
masscan -p1-65535 --rate 10000 -oL masscan_results.txt target.com
```

Nmap

```
nmap -p- --open -sV -sC -T4 -oN nmap_results.txt target.com
```

Rustscan

```
rustscan -a testfire.net -- -sC -sV -O
```

---

# 3.Automating Screenshot Capture For Subdomains

Eyewitness

```
eyewitness -f subdomais.txt --web
```

Aquatone

```
cat subdomains.txt | aquatone -out screenshots/
```

---

# 4.Automating Directory BruteForcing

Ffuf

```

ffuf -u https://target.com/FUZZ -w /usr/share/wordlists/dirbuster/directory-list-2.3-medium.txt -o ffuf_results.txt

```

Gobuster

```
gobuster dir -u https://target.com -w /usr/share/wordlists/dirb/common.txt -o gobuster_results.txt
```

Feroxbuster

```
feroxbuster -u http://target.com/ -s 200,300,301
```

---

# 5.Automating JavaScript Ananlysis

```
python3 linkfinder.py -i https://target.com/script.js -o results.html
```