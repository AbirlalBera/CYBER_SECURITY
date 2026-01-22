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

```
gobuster dns --help
```

```Syntax
gobuster dns -d example.thm -w /path/to/wordlist
```

```Example
gobuster dns -d example.thm -w wordlist.txt
```

## Required Flags

### **`-d`** — Domain

Target domain to enumerate.

```
-d example.thm
```


### **`-w`** — Wordlist

List of possible subdomain names.

```
-w subdomains.txt
```


## Common Flags (with examples)

### **`-i`** — Show IP addresses

Displays the IP each subdomain resolves to.

```-i
```


### **`-c`** — Show CNAME records

Shows CNAME mappings (cannot be used with `-i`).

`-c`


### **`-r`** — Custom DNS resolver

Use a specific DNS server.

`-r 10.48.128.79`


### **`-t`** — Threads

Increase speed of enumeration.

`-t 50`


### **`-o`** — Output to file

Save results to a file.

`-o dns_results.txt`