**Active Directory is a directory service developed by Microsoft for Windows domain networks. It stores information about network objects such as computers, users, and groups. It provides authentication and authorisation services, and allows administrators to manage network resources centrally.**

**Domain Controller :** The server that runs the Active Directory services is known as a Domain Controller (DC).A domain controller is a server that manages security authentication requests in a Windows Server network. It stores user account information and controls access to resources on the network. It is a critical component for managing and securing a network infrastructure.

![[Pasted image 20251026234357.png]]
##  Advantage

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



|                    |                                                                                                                                                           |
| ------------------ | --------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **Security Group** | **Description**                                                                                                                                           |
| Domain Admins      | Users of this group have administrative privileges over the entire domain. By default, they can administer any computer on the domain, including the DCs. |
| Server Operators   | Users in this group can administer Domain Controllers. They cannot change any administrative group memberships.                                           |
| Backup Operators   | Users in this group are allowed to access any file, ignoring their permissions. They are used to perform backups of data on computers.                    |
| Account Operators  | Users in this group can create or modify other accounts in the domain.                                                                                    |
| Domain Users       | Includes all existing user accounts in the domain.                                                                                                        |
| Domain Computers   | Includes all existing computers in the domain.                                                                                                            |
| Domain Controllers | Includes all existing DCs on the domain.                                                                                                                  |

