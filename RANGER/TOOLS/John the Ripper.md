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
wget https://gitlab.com/kalilinux/packages/hash-identifier/-/raw/kali/master/hash-id.py 
```

```
python3 hash-id.py
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

### 3. Format-Specific Cracking (Most Reliable)

Once the hash type is known, **force John to use it**.
### Syntax:
```
john --format=[format] --wordlist=[wordlist] [hash_file]
```

### Example (MD5):
```
john --format=raw-md5 --wordlist=/usr/share/wordlists/rockyou.txt hash_to_crack.txt
```

## ⚠️ Important Note About Formats

For **standard hashes** (MD5, SHA1, etc.), use:
```
raw-md5
raw-sha1 
raw-sha256
```

**==`raw`==** is used in John the Ripper to specify that the hash is a **plain, unsalted, standalone hash output** of a hashing algorithm, with no additional data or structure.

---
# ==`Cracking Windows Authentication Hashes`==

#### What is Authentication Hashes ?
Hashed versions of passwords used by operating systems for user authentication.  
These hashes may be cracked using brute-force or dictionary attacks if weak passwords are used.

### What is NTHash / NTLM ?

The password hash format used by modern Windows operating systems to store user and service account passwords. Also known as NTLM (NT LAN Manager).

## Purpose of NTLM

Used by Windows to authenticate users locally and in domain environments.

## Storage Location

- SAM (Security Account Manager) database
- Active Directory database (NTDS.dit)

## Hash Acquisition

NTLM hashes can be obtained using:
- SAM database dumping
- Credential dumping tools (e.g., Mimikatz)
- Active Directory database extraction

Requires privileged access.
## Attack Usage

- Hash cracking (when passwords are weak)
- Pass-the-Hash attacks (without cracking)
## John the Ripper Format

NTLM hashes are cracked in John using the **==`nt`==** format.
## Practical Command

```
john --format=nt --wordlist=/usr/share/wordlists/rockyou.txt ntlm.txt
```

---
# =`Cracking /etc/shadow Hashes`=

## /etc/shadow

A Linux system file that stores **hashed user passwords** along with password aging information such as last change date and expiration. Accessible only by the **root user**.
## /etc/passwd

A Linux file that stores **user account information** such as username, UID, GID, home directory, and shell. Does **not** store password hashes.
## Why /etc/shadow Cracking Is Possible

If an attacker gains **root or sufficient privileges**, they can extract password hashes and attempt to crack them using brute-force or dictionary attacks.
## Unshadow

A tool included with John the Ripper used to **combine `/etc/passwd` and `/etc/shadow`** files into a single format that John can understand.

## Purpose of Unshadow

John requires both:
- Username information (`/etc/passwd`)
- Password hash information (`/etc/shadow`)

Unshadow merges these into a crackable file.

## Unshadow Syntax

```
unshadow [passwd_file] [shadow_file]
```

## Example Usage

```
unshadow local_passwd local_shadow > unshadowed.txt
```

## Input Files Example

When using `unshadow`, you can either use the entire `/etc/passwd` and `/etc/shadow` files, assuming you have them available, or you can use the relevant line from each, for example:

**==FILE 1 - local_passwd==**

Contains the `/etc/passwd` line for the root user:

`root:x:0:0::/root:/bin/bash`

**==FILE 2 - local_shadow==**

Contains the `/etc/shadow` line for the root user: `root:$6$2nwjN454g.dv4HN/$m9Z/r2xVfweYVkrr.v5Ft8Ws3/YYksfNwq96UL1FX0OJjY1L6l.DS3KEVsZ9rOVLB/ldTeEL/OIhJZ4GMFMGA0:18576::::::`

## Hash Type Used

Linux systems commonly use **SHA-512** hashing for passwords. John format name: **==`sha512crypt`==**

## Cracking the Hash

```
john --wordlist=/usr/share/wordlists/rockyou.txt --format=sha512crypt unshadowed.txt
```

---
## Single Crack Mode

A John the Ripper cracking mode that generates password guesses **using the username and related user information**, instead of a predefined wordlist.
## Purpose of Single Crack Mode

To exploit **weak, predictable passwords** that are derived from usernames or user-related data.
## Word Mangling

A technique where John modifies a base word (such as a username) using predefined rules to generate possible passwords.
## Word Mangling Examples
```
Base word: `Markus`

Generated guesses:
- Markus1, Markus2
- MArkus, MARKus
- Markus!, Markus$
```
## Mangling Rules

A set of rules used by John to:
- Change letter cases
- Append or prepend numbers
- Add symbols
- Create variations of a base word
## GECOS Field

A field in UNIX/Linux user account records that stores user-related information such as:
- Full name
- Office number
- Contact details
## Role of GECOS(General Electric Comprehensive Operating System) in Single Mode

John extracts information from the GECOS field to generate **additional password candidates** when cracking ==`/etc/shadow`== hashes.
## Single Crack Mode Syntax

```
john --single --format=[format] [hash_file]
```
## Example Command

```
john --single --format=raw-sha256 hashes.txt
```
## Required File Format

For single crack mode, the hash file must be in the format: ==`username:hash`==
## Example File Format Change

Before: `1efee03cdcb96d90ad48ccc7b8666033`

After: `mike:1efee03cdcb96d90ad48ccc7b8666033`

---
