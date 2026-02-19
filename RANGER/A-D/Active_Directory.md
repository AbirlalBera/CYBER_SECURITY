**Active Directory is a directory service developed by Microsoft for Windows domain networks. It stores information about network objects such as computers, users, and groups. It provides authentication and authorisation services, and allows administrators to manage network resources centrally.**

**Domain Controller :** The server that runs the Active Directory services is known as a Domain Controller (DC).A domain controller is a server that manages security authentication requests in a Windows Server network. It stores user account information and controls access to resources on the network. It is a critical component for managing and securing a network infrastructure.

![[Pasted image 20251026234357.png]]
## Advantage

The main advantages of having a configured Windows domain are:

**Centralised identity management:**  All users across the network can be configured from Active Directory with minimum effort.

**Managing security policies:**  You can configure security policies directly from Active Directory and apply them to users and computers across the network as needed.

------------------------------------
**Active Directory Domain Service** :  The core of any Windows Domain is the **Active Directory Domain Service (AD DS)**. This service acts as a catalogue that holds the information of all of the "objects" that exist on your network. Amongst the many objects supported by AD, we have users, groups, machines, printers, shares and many others

### The Main Objects

#### 👤 1. Users

- These are accounts that can log in and access things (they are "security principals").
    
- **Two Types:**
    
    - **People:** Regular employees.
        
    - **Services:** Special accounts used to run programs (like a web server).
        

#### 💻 2. Machines (Computers)

- Every computer that joins the network gets its own account in AD.
    
- They are also "security principals."
    
- **How to spot them:** Their name ends with a **`$`** (e.g., `DC01$`).
    

#### 👥 3. Security Groups

- This is how you manage permissions efficiently. Instead of giving access to each user individually, you put them in a **group** and give the **group** permission.
    
- **Key Advantage:** Add a user to a group, and they instantly get all the group's access rights.
    
- Groups can contain both users and computers.

Several groups are created by default in a domain that can be used to grant specific privileges to users. As an example, here are some of the most important groups in a domain:

| **Security Group** | **Description**                                                                                                                                           |
| ------------------ | --------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Domain Admins      | Users of this group have administrative privileges over the entire domain. By default, they can administer any computer on the domain, including the DCs. |
| Server Operators   | Users in this group can administer Domain Controllers. They cannot change any administrative group memberships.                                           |
| Backup Operators   | Users in this group are allowed to access any file, ignoring their permissions. They are used to perform backups of data on computers.                    |
| Account Operators  | Users in this group can create or modify other accounts in the domain.                                                                                    |
| Domain Users       | Includes all existing user accounts in the domain.                                                                                                        |
| Domain Computers   | Includes all existing computers in the domain.                                                                                                            |
| Domain Controllers | Includes all existing DCs on the domain.                                                                                                                  |

### Active Directory Users and Computers: The Management Tool

- This is the program you use to manage everything in your Active Directory (users, computers, groups). You run it on a **Domain Controller** **(the main server).**

![[Pasted image 20251027001836.png]]

### Organizational Units (OUs): The Folders for Organization

- **What they are:** OUs are like folders or directories that you use to organize your users and computers within Active Directory.

- **Main Purpose:** They are used to apply **policies and settings** to specific sets of users or computers.

- **Example:** You can create an "IT" OU and apply specific software installation rules to everyone in it. You can create a "Sales" OU with a different set of rules.
![[Pasted image 20251027002406.png]]

There are other default containers apart from the THM OU. These containers are created by Windows automatically and contain the following:

- **Builtin:** Contains default groups available to any Windows host.
- **Computers:** Any machine joining the network will be put here by default. You can move them if needed.
- **Domain Controllers:** Default OU that contains the DCs in your network.
- **Users:** Default users and groups that apply to a domain-wide context.
- **Managed Service Accounts:** Holds accounts used by services in your Windows domain.
### OUs vs. Groups: The Simple Difference

This is a common point of confusion, but the distinction is crucial:

| Organizational Unit (OU) | Security Group                                                        |
| ------------------------ | --------------------------------------------------------------------- |
| **Purpose**              | **Apply Policies** (like software rules or security settings)         |
| **Membership**           | A user/computer can be in **only one** OU.                            |
| **Analogy**              | Assigning an employee to the **"Sales Department"** in the HR system. |

---------------


## Deleting extra OUs and users

The first thing you should notice is that there is an additional department OU in your current AD configuration that doesn't appear in the chart. We've been told it was closed due to budget cuts and should be removed from the domain. If you try to right-click and delete the OU, you will get the following error:
![[Pasted image 20251027010147.png]]

![[Pasted image 20251027010156.png]]
![[Pasted image 20251027010206.png]]
Be sure to uncheck the box and try deleting the OU again. You will be prompted to confirm that you want to delete the OU, and as a result, any users, groups or OUs under it will also be deleted.

-----------------

### Delegation :

One of the nice things you can do in AD is to give specific users some control over some OUs. This process is known as **delegation** and allows you to grant users specific privileges to perform advanced tasks on OUs without needing a Domain Administrator to step in.

One of the most common use cases for this is granting `IT support` the privileges to reset other low-privilege users' passwords. According to our organisational chart, Phillip is in charge of IT support, so we'd probably want to delegate the control of resetting passwords over the Sales, Marketing and Management OUs to him.

For this example, we will delegate control over the Sales OU to Phillip. To delegate control over an OU, you can right-click it and select **Delegate Control**

How to give permission to a another user to change or reset someones password ---------

![[Pasted image 20251027010337.png]]

![[Pasted image 20251027010342.png]]


![[Pasted image 20251027010356.png]]

After giving the permission lets change some ones password-----------

```
PS C:\Users\phillip> Set-ADAccountPassword sophie -Reset -NewPassword (Read-Host -AsSecureString -Prompt 'New Password') -Verbose New 

Password: ********* 

VERBOSE: Performing the operation "Set-ADAccountPassword" on target "CN=Sophie,OU=Sales,OU=THM,DC=thm,DC=local".
```

Now change the user password

--------------------------


### Organizing Machines in Active Directory (AD)

**Default Location:** All non-Domain Controller machines that join the domain are placed in the default **"Computers" container**. This is not ideal for applying different security policies.

### Recommended Machine Categories (for OUs)

Create separate Organizational Units (OUs) for different device types to apply specific policies.

|Category|Purpose|Policy Needs|
|---|---|---|
|**Workstations**|Daily-use computers for regular users.|Standard user policies, web browsing, office apps. **Privileged users should NOT log in here.**|
|**Servers**|Machines that provide services to the network.|Locked down, minimal access, specific service rules.|
|**Domain Controllers**|The critical servers that manage AD itself.|Highly restricted, most sensitive policies. (Often has a default OU).|

**Why Organize?** Placing machines in the correct OU allows you to deploy targeted Group Policies (like security settings, software, and access rules) to entire categories of devices at once.

**Action:** Manually move devices from the default **"Computers" container** into the appropriate OUs you create (e.g., Workstations, Servers).

--------
# Group Policies :

### Group Policy Objects (GPO) - Key Notes

**What is a GPO?**  
A collection of settings applied to OUs to configure computers and users.

**Management Tool:**  
`Group Policy Management` on a Domain Controller.

**How it Works:**

1. Create a GPO in the `Group Policy Objects` folder.
    
2. **Link** the GPO to an OU.
    
3. The GPO applies to all users/computers in that OU and any **child OUs**.
    

**Key Concepts:**

- **Scope:** Where the GPO is linked (e.g., an OU or the entire domain).
    
- **Security Filtering:** Can be refined to apply to specific users/groups within the OU (default is `Authenticated Users`).
    
- **Two Policy Types:**
    
    - **Computer Configuration:** Settings applied to machines (e.g., password policy, lock screen).
        
    - **User Configuration:** Settings applied to users (e.g., blocking Control Panel).
        

**GPO Distribution & Update:**

- Distributed via the `SYSVOL` network share on Domain Controllers.
    
- Changes can take up to 2 hours to apply. Force an immediate update with:
    
    powershell
    
    gpupdate /force
    


### Practical GPO Examples

**1. Restrict Control Panel (User Policy)**

- **GPO Name:** `Restrict Control Panel Access`
    
- **Policy Path:** `User Configuration -> Administrative Templates -> Control Panel`
    
- **Setting:** `Prohibit Access to Control Panel and PC settings` -> **Enabled**
    
- **Linking:** Link to user OUs (e.g., Marketing, Sales) where you want the restriction.
    

**2. Auto Lock Screen (Computer Policy)**

- **GPO Name:** `Auto Lock Screen`
    
- **Policy Path:** `Computer Configuration -> Policies -> Windows Settings -> Security Settings -> Local Policies -> Security Options`
    
- **Setting:** `Interactive logon: Machine inactivity limit` -> **300 seconds** (5 minutes)
    
- **Linking:** Link to computer OUs (e.g., Workstations, Servers) or the root domain (computer policies are ignored on user-only OUs).
--------------------------------

# Windows Authentication Methods

Two main protocols are used:

1. **Kerberos (Modern Default)**
    
2. **NetNTLM (Legacy, for compatibility)**
    

### ==`Kerberos Authentication (3-Step Process)`==

Uses "tickets" as proof of authentication.

1.**Get a Ticket-Granting Ticket (TGT)**

- User logs in and sends a request to the **Key Distribution Center (KDC)** on the Domain Controller.

- The KDC verifies the user and issues a **TGT**. This TGT is the user's "master ticket" to get other service tickets.

![[Pasted image 20251027215857.png]]


2.**Get a Service Ticket (TGS)**

- When the user wants to access a service (e.g., a file share), they present their TGT to the KDC and ask for a **Ticket-Granting Service (TGS)** ticket for that specific service.

- The KDC issues a TGS, which is encrypted with the **service account's password hash**.
![[Pasted image 20251027222010.png]]
2.**Connect to the Service**

- The user presents the TGS to the service.

- The service decrypts it with its own password hash. If successful, access is granted.


**Key Takeaway:** Kerberos is more secure and efficient. The user's password hash is never sent over the network after the initial login.

![[Pasted image 20251027222027.png]]

### NetNTLM Authentication (Challenge-Response)

A legacy protocol that uses a "challenge-response" method.

1. **Client requests authentication.**
    
2. **Server sends a random challenge.**
    
3. **Client calculates a response** using its NTLM password hash and the challenge, then sends it back.
    
4. **Server sends the challenge and response** to the Domain Controller for verification.
    
5. **Domain Controller verifies** the response and tells the server if authentication passed or failed.

![[Pasted image 20251027222035.png]]
**Key Takeaway:** The user's password hash is never sent directly over the wire, but it is vulnerable to relay attacks. Considered obsolete.

-----

# Trees, Forests and Trusts

### Scaling Active Directory: Beyond a Single Domain

As companies grow, a single domain may become insufficient. AD uses **Trees** and **Forests** to organize multiple domains.

![[Pasted image 20251027222702.png]]
### Trees

- **What it is:** A hierarchy of domains that share a **common namespace**.
    
- **Example:** A root domain `thm.local` with subdomains `uk.thm.local` and `us.thm.local`.
    
- **Purpose:** Provides administrative separation. The IT team for `uk.thm.local` manages only their domain, not the US one.
    
- **New Group:** **Enterprise Admins** have administrative privileges over **all domains** in the entire structure.

![[Pasted image 20251027222709.png]]
### Forests

- **What it is:** A collection of one or more **domain Trees** that have different namespaces.
    
- **Example:** The `thm.local` tree and the `mht.local` tree from a merged company exist together in one forest.
    
- **Purpose:** Allows completely separate companies or business units to be managed together under a single umbrella.

![[Pasted image 20251027222714.png]]

### Trust Relationships

Trusts define how domains in a forest or tree can access each other's resources.

- **What it is:** A bridge that allows users from one domain to be **authenticated** in another domain.
    
- **Key Point:** A trust relationship **enables** authorization but does **not automatically grant** access. Permissions must still be explicitly given.
    

|Trust Type|Description|Example|
|---|---|---|
|**One-Way Trust**|Domain A trusts Domain B. Users from B can be given access to resources in A, but not vice-versa.|`uk.thm.local` **<--** `us.thm.local` (A trusts B)|
|**Two-Way Trust**|Domains A and B trust each other. Users from either domain can be given access to resources in the other.|**Default relationship** between domains in the same tree or forest.|

-------------

### Labs :  
https://tryhackme.com/room/activedirectoryhardening

https://tryhackme.com/module/hacking-active-directory