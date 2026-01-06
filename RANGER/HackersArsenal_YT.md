
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

Gobuster

Feroxbuster
