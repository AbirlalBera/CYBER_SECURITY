
**1.Where is the SAM (Security Account Manager) stored, and why is it important?**

### **SAM :** 
**SAM** stands for **Security Account Manager**.It is a **Windows system component** responsible for storing and managing **local user accounts and their password hashes**.

The **Security Account Manager (SAM)** is a **database** in Windows that stores:
**Local user account names**

**Password hashes (not the passwords themselves)**

**Security identifiers (SIDs)**

**Account properties**

### **Location:**

On disk : C:\Windows\System32\config\SAM

In the registry : HKEY_LOCAL_MACHINE\SAM

### **Importance:**

The SAM stores user account information and hashed passwords for local users.

It is critical because access to the SAM allows attackers to crack password hashes or take over local accounts.

Windows uses SAM together with the SYSTEM file (which holds the encryption key) to verify passwords.

-------------------
**2.How can you change a Windows password without logging in?**

-------------

### **3. How to create a new Windows user without logging in?**

1.Boot from a Windows installation media or live CD.
    
Open the command prompt using the Ease of Access / cmd.exe replacement trick.
    
Create a new user:

`net user NewUser NewPassword /add net localgroup administrators NewUser /add   (optional, for admin)`


This creates a fully functional Windows account without needing to log in first.

