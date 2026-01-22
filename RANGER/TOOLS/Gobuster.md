#### **GitHub link :** https://github.com/OJ/gobuster

---
### **Introduction**
Gobuster is an open-source offensive tool written in Golang. It enumerates web directories, DNS subdomains, vhosts, Amazon S3 buckets, and Google Cloud Storage by brute force, using specific wordlists and handling the incoming responses

we can place Gobuster between the reconnaissance and scanning phases.

Gobuster is powerful because it allows you to scan the website and return the status codes. These status codes immediately tell you if you, as an outside user, can request that directory or not.

**Enumeration** : Enumeration is the act of listing all the available resources, whether they are accessible or not. For example, Gobuster enumerates web directories.

**==Example:==**
Directories
Subdomains
Virtual hosts

**Brute Force** : Brute force is the act of trying every possibility until a match is found. It is like having ten keys and trying them all on a lock until one fits. Gobuster uses wordlists for this purpose.

**For more details :** 

```
gobuster --help
```

---
## Understanding Gobuster modes 

##### Commonly used modes in this room

### **dir** → 

directories & files   

**Example:**  
```
gobuster dir -u http://TARGET -w wordlist.txt
```

### **dns** →

subdomains

**Example:**  
```
gobuster dns -d target.com -w subdomains.txt
```

### **vhost** ->

virtual hosts

**Example:**  
```
gobuster vhost -u http://IP -w vhosts.txt
```

### **fuzz ->**

Replaces `FUZZ` in a request to discover inputs or paths.  

**Example:**  
```
gobuster fuzz -u http://TARGET/FUZZ -w wordlist.txt
```

### **s3(Simple Storage Service) -> 

AWS S3 bucket enumeration.Finds public or misconfigured S3 buckets.  

**Example:**  
```
gobuster s3 -w buckets.txt
```

### **gcs (Google Cloud Storage enumeration) ->**

Finds GCS buckets by name.  

**Example:**  
```
gobuster gcs -w buckets.txt
```

---
## Common Flags (quick)

- `-w` → wordlist

```
-u http://example.thm
```

- `-t` → threads (speed)  

```
-t 50
```

- `-o` → output file

```
-o results.txt
```

- `--delay` → slow scan

```
--delay 1500ms
```

- `--debug` → troubleshoot

```
--debug
```

---
## **Directory and File Enumeration (Advance)**

```
gobuster dir --help
```

### `-u` — Target URL

Base path to start enumeration.

```
-u http://example.thm
```

### `-w` — Wordlist

List of directory/file names to try.

```
-w /usr/share/wordlists/dirbuster/directory-list-2.3-medium.txt
```

### `-x` — File extensions

Search for specific file types.

```
gobuster dir -u http://example.thm -w wordlist.txt -x .php,.js
```

### `-r` — Follow redirects

Follows 301/302 responses automatically.

```
gobuster dir -u http://example.thm -w wordlist.txt -r
```

### `-s` — Show status codes

Only display selected response codes.

```
-s 200,301
```

### `-b` — Blacklist status codes

Hide unwanted responses (e.g., 404).

```
-b 404
```

### `-c` — Cookies

Send session cookies with requests.

```
-c "PHPSESSID=abc123"
```

### `-H` — Custom headers

Add headers like authorization tokens.

```
-H "Authorization: Bearer TOKEN"
```

### `-k` — Skip TLS validation(--no-tls-validation)

Ignore invalid/self-signed HTTPS certs.

```
-k
```


---

## **Subdomain Enumeration (Advance)**

```Help
gobuster dns --help
```

```Syntax
gobuster dns -d example.thm -w /path/to/wordlist
```

```Example
gobuster dns -d example.thm -w /usr/share/wordlists/SecLists/Discovery/DNS/subdomains-top1million-5000.txt
```

## Required Flags

### **`-d`** — Domainls 

Target domain to enumerate.

```
-d example.thm
```


### **`-w`** — Wordlist

List of possible subdomain names.

```
-w subdomains.txt
```


### **`-i`** — Show IP addresses

Displays the IP each subdomain resolves to.

```
-i
```


### **`-c`** — Show CNAME records

Shows CNAME mappings (cannot be used with `-i`).

```
-c
```


### **`-r`** — Custom DNS resolver

Use a specific DNS server.

```
-r 10.48.128.79
```


### **`-t`** — Threads

Increase speed of enumeration.

```
-t 50
```

### **`-o`** — Output to file

Save results to a file.

```
-o dns_results.txt
```

---
## **Vhost Enumeration (Advance)**

This mode allows Gobuster to brute force virtual hosts. Virtual hosts are different websites on the same machine. Sometimes, they look like subdomains, but don’t be deceived! Virtual hosts are IP-based and are running on the same server. Subdomains are set up in DNS. The  difference between `vhost` and `dns` mode is in the way Gobuster scans:

==`vhost`==  =  mode will navigate to the URL created by combining the configured HOSTNAME (-u flag) with an entry of a wordlist.

==`dns`==  =  mode will do a DNS lookup to the FQDN created by combining the configured domain name (-d flag) with an entry of a wordlist.

```Help
gobuster vhost --help
```

```Syntax
gobuster vhost -u http://IP -w wordlist.txt
```

```Example
gobuster vhost -u http://10.48.128.79 -w /usr/share/wordlists/SecLists/Discovery/DNS/subdomains-top1million-5000.txt
```

## Required Flags

### **`-u` / `--url`** — Base URL (IP or hostname)

Target web server to send requests to.

```
-u http://10.48.128.79
```

### **`-w`** — Wordlist

List of possible virtual host names.

```
-w subdomains.txt
```

### **`--domain`** — Domain name

Sets the domain part of the Host header. ==(Mention the domain we want to appends)==

```
--domain example.thm
```

### **`--append-domain`** — Append domain to wordlist entries

Turns `blog` → `blog.example.thm`. ==(It appends or adds the mentioned domain on the --domain flag )==

```
--append-domain
```

### **`-m` / `--method`** — HTTP method

Specify GET, POST, etc.

```
-m GET
```

### **`--exclude-length`** — Filter false positives

Hide responses with common body sizes.

```
--exclude-length 250-320
```

### **`-r` / `--follow-redirect`** — Follow redirects

Useful when vhosts redirect to other pages.

```
-r
```

### **`-t`** — Threads

Increase scan speed.

```
-t 50
```

### **`-o`** — Output to file

Save results.

```
-o vhost_results.txt
```

### **Example :**

```
gobuster vhost -u "http://www.offensivetools.thm/" --domain offensivetools.thm -w /usr/share/wordlists/SecLists/Discovery/DNS/subdomains-top1million-5000.txt --append-domain --exclude-length 250-320 
```

## Flag-by-flag explanation

 **==`gobuster vhost`==** : Uses **virtual host enumeration mode**.

**==`-u "http://www.offensivetools.thm/"`==** : Base URL to send HTTP requests to  
(Gobuster changes the **Host header**, not the URL path).

**==`--domain offensivetools.thm`==** : Sets the domain part of the Host header.Used to build hostnames like:  `blog.offensivetools.thm admin.offensivetools.thm`

**==`-w subdomains-top1million-5000.txt`==** : Wordlist containing possible virtual host names  
(e.g., `blog`, `shop`, `dev`).

**==`--append-domain`==** : Appends the domain to each wordlist entry.  
Example: `blog → blog.offensivetools.thm`

**==`--exclude-length 250-320`==** : Filters out **false positives** based on response size.  
Pages returning sizes in this range are ignored.


![[Pasted image 20260122224600.png]]