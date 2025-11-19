
**1.Where is the SAM (Security Account Manager) stored, and why is it important?**

### **SAM :** 
**SAM** stands for **Security Account Manager**.It is a **Windows system component** responsible for storing and managing **local user accounts and their password hashes**.

The **Security Account Manager (SAM)** is a **database** in Windows that stores:
**Local user account names**

**Password hashes (not the passwords themselves)**

**Security identifiers (SIDs)**

**Account properties**

### **Location:**

**On disk :** C:\Windows\System32\config\SAM

**In the registry :** HKEY_LOCAL_MACHINE\SAM

### **Importance:**

The SAM stores user account information and hashed passwords for local users.

It is critical because access to the SAM allows attackers to crack password hashes or take over local accounts.

Windows uses SAM together with the SYSTEM file (which holds the encryption key) to verify passwords.

### **NOTICE :**

This file is locked while Windows is running, meaning we cannot access it directly unless booted into another OS (like Linux) or using specialized tools. like---

Online without changing the os : Mimikatz , pwdump / fgdump ,  **Cain & Abel (legacy)**

-------------------
**2.How can you change a Windows password without logging in?**

-------------

### **3. How to create a new Windows user without logging in?**

1.Boot from a Windows installation media or live CD.

2.Open the command prompt using the Ease of Access / cmd.exe replacement trick.

3.Create a new user:

```
net user NewUser NewPassword /add net localgroup administrators NewUser /add   (optional, for admin)
```

This creates a fully functional Windows account without needing to log in first.

---------------
### **4. Where are Windows passwords stored, and in what format?**

##### Local Accounts (not Microsoft accounts): 
Stored in the SAM file (C:\Windows\System32\config\SAM), hashed, never in plain text.

**Password formats in SAM:**

**NTLM hash**
**NTLM =** MD4 hash of the UTF-16LE password.
Example: password123 → hashed using MD4. 

**LM hash (older, insecure, often disabled)**
Split password into two 7-character blocks, uppercased, hashed with DES.
Easily cracked; modern Windows usually disables LM hashes.

##### Microsoft Accounts:
Passwords are not stored locally in SAM in plain form.

Windows caches a derivative hash of the Microsoft account credentials for offline login (called cached credentials).

