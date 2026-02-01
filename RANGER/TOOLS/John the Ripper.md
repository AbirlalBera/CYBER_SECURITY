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
## ==`Single Crack Mode Technique`==

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

If we looked at the entries for both `/etc/shadow` and `/etc/passwd`. Looking closely, you will notice that The fields are separated by a colon `:`. The fifth field in the user account record is the GECOS field. It stores general information about the user, such as the user’s full name, office number, and telephone number, among other things. John can take information stored in those records, such as full name and home directory name, to add to the wordlist it generates when cracking `/etc/shadow` hashes with single crack mode.
## Single Crack Mode Syntax

```
john --single --format=[format] [hash_file]
```
## Example Command

```
john --single --format=raw-sha256 hashes.txt
```
## Required File Format (Before cracking hash)

For single crack mode, the hash file must be in the format: ==`username:hash`==
## Example File Format Change

Before: `1efee03cdcb96d90ad48ccc7b8666033`

After: `mike:1efee03cdcb96d90ad48ccc7b8666033`

---
## Custom Rules

User-defined rules in John the Ripper that dynamically modify words from a wordlist to generate password guesses based on known or predicted password patterns.
## Purpose of Custom Rules

To exploit **predictable password creation patterns** used by users and organisations enforcing password complexity.
## What Custom Rules Exploit

**Password complexity predictability**

✅ **Answer:** **password complexity predictability**
## Common Password Pattern Exploited

- Capital letter at the beginning
- Numbers at the end
- Symbols at the end

Example pattern:  `Polopassword1!`
## john.conf

Configuration file where custom rules are defined.

Common locations:
- `/opt/john/john.conf` (TryHackMe AttackBox)
- `/etc/john/john.conf` (System install)
## Rule Naming

`[List.Rules:RuleName]`

Defines the custom rule name used when calling John.
## Common Rule Modifiers

- **Az** → Append characters to the end
- **A0** → Prepend characters to the beginning
- **c** → Capitalise letters
## Character Sets

- `[0-9]` → Numbers
- `[A-Z]` → Uppercase letters
- `[a-z]` → Lowercase letters
- `[!£$%@]` → Symbols
## Example Custom Rule

`[List.Rules:PoloPassword] cAz"[0-9][!£$%@]"`
## Rule to Add All Capital Letters to the End

**Answer:**`Az"[A-Z]"`
## Using a Custom Rule

```syntax
john --wordlist=[path] --rule=RuleName [hash_file]
```

---
# Cracking Password Protected Zip Files

## Password‑Protected Zip Files

Zip archives can be protected with passwords, and these passwords can be cracked if weak using John the Ripper.
## zip2john

A tool in the John the Ripper suite that converts a password‑protected Zip file into a **hash format** that John can understand.
## Purpose of zip2john

To extract the password hash from a Zip archive so it can be cracked using John.
## zip2john Syntax

```
zip2john [options] [zip_file] > [output_file]
```

## zip2john Example

```
zip2john zipfile.zip > zip_hash.txt
```
## Output File

The output file contains the Zip password hash in a format compatible with John the Ripper.
## Cracking the Zip Hash

```
john --wordlist=/usr/share/wordlists/rockyou.txt zip_hash.txt
```

---
# ==`Cracking Password-Protected RAR Archives`==

## Password‑Protected RAR Archives

RAR archives are compressed files created using WinRAR and can be protected with passwords that may be cracked if weak.
## rar2john

A John the Ripper suite tool used to convert a password‑protected RAR archive into a **hash format** that John can process.
## Purpose of rar2john

To extract the password hash from a RAR file so it can be cracked using John the Ripper.
## rar2john Syntax

```
rar2john [rar_file] > [output_file]
```

## rar2john Example

```
/opt/john/rar2john rarfile.rar > rar_hash.txt
```
## Output File

The output file contains the RAR password hash formatted for John.
## Cracking the RAR Hash

```
john --wordlist=/usr/share/wordlists/rockyou.txt rar_hash.txt
```

## Extract RAR file to the current directory

```
unrar x file.rar
```

---

# ==`Cracking SSH Keys with John`==

## SSH Private Key Authentication

SSH can use **key‑based authentication** instead of passwords. The private key file is usually named **id_rsa** and may be protected with a passphrase.
## SSH Key Password

The passphrase protects access to the private SSH key. If weak, it can be cracked to allow SSH authentication using the key.
## ssh2john

A John the Ripper suite tool that converts an **SSH private key (id_rsa)** into a hash format that John can crack. It used to extract the hash from an encrypted SSH private key so it can be cracked using John the Ripper.
## ssh2john Syntax

```
ssh2john [id_rsa_file] > [output_file]
```

## ssh2john Example

```
/opt/john/ssh2john.py id_rsa > id_rsa_hash.txt
```

## Tool Location Notes

- TryHackMe AttackBox:  `python3 /opt/john/ssh2john.py`
- Kali Linux:  `python /usr/share/john/ssh2john.py`
## Output File

The output file contains the **SSH private key hash** formatted for John.

## Cracking the SSH Key Hash

```
john --wordlist=/usr/share/wordlists/rockyou.txt id_rsa_hash.txt
```

## Result

Once cracked, the recovered passphrase can be used to unlock the SSH private key and authenticate over SSH.