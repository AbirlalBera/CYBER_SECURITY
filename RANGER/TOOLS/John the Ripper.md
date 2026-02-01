John the Ripper is a well-known, well-loved, and versatile ==`hash-cracking`== tool. It combines a fast cracking speed with an extraordinary range of compatible hash types.

## What are Hashes?

A **hash** converts data of _any length_ into a **fixed-length value**.The original data is **masked** and **cannot be reversed directly**.

Common hashing algorithms:
- **MD4**
- **MD5**    
- **SHA1**    
- **NTLM**
### Example (MD5):

|Input|Output (MD5 Hash)|
|---|---|
|`polo`|`b53759f3ce692de7aff1b5779d3964da`|
|`polomints`|`584b6e4f4586e136bc280f27f9c64f3b`|
### what is dictionary attack ?

A **dictionary attack** uses a **predefined list of words** (called a _wordlist_ or _dictionary_) to guess passwords or crack hashes.

### What is the most popular extended version of John the Ripper?

=> **Jumbo John.**

---
## Installation

**Installation link :** https://github.com/openwall/john/tree/bleeding-jumbo

**For Windows :** https://www.openwall.com/john/k/john-1.9.0-jumbo-1-win64.zip

**How to check is it installed or not ?**

```
john
```

Wordlists : https://github.com/danielmiessler/SecLists or /usr/share/wordlists/rockyou.txt

---
## John Basic Syntax

The basic syntax of John the Ripper commands is as follows. 
```
john [options] [file path ]
```

### 1.  Automatic Cracking 

John can **==`auto-detect hash type`==** and try cracking it.
### Command:

```
john --wordlist=/path/to/wordlist hash.txt
```

### Example:

```
john --wordlist=/usr/share/wordlists/rockyou.txt hash_to_crack.txt
```

### 2. Identifying Hashes (If john auto fails)

If John struggles, **identify the hash first**.
### Tool: ==`hash-identifier`==

**Download and run:**
```
wget https://gitlab.com/kalilinux/packages/hash-identifier/-/raw/kali/master/hash-id.py python3 hash-id.py
```

**Then paste the hash:**
```
HASH: 2e728dd31fb5949bc39cac5a9f066498
```

**Output example:**
```
Possible Hashs: 
[+] MD5 
[+] Domain Cached Credentials - MD4
```

![[Pasted image 20260201200115.png]]

### Format-Specific Cracking (Most Reliable)

Once the hash type is known, **force John to use it**.
### Syntax:
```
john --format=[format] --wordlist=[wordlist] [hash_file]
```

### Example (MD5):
```
john --format=raw-md5 --wordlist=/usr/share/wordlists/rockyou.txt hash_to_crack.txt
```

