### What is PowerShell?

A cross-platform task automation tool from Microsoft that combines:

- A **command-line shell**
- A **scripting language**
- A **configuration management framework**

It is built on the .NET framework.

### The Core Power: Object-Oriented

This is the most important concept that sets PowerShell apart.

|Traditional Command Line (cmd, bash)|PowerShell|
|---|---|
|Commands input and output **text**.|Commands (called **cmdlets**) input and output **objects**.|
|You manipulate lines of text.|You manipulate structured data with **Properties** (data) and **Methods** (actions).|

**Analogy:** A `File` object in PowerShell has properties like `Name`, `Size`, and `LastWriteTime`, and methods like `Copy()` or `Delete()`.

**Benefit:** You can directly work with an object's properties without complex text parsing, making automation much more powerful and efficient.

### Brief History

- **Problem:** Old Windows tools (`cmd.exe`, batch files) were limited for complex enterprise management.

- **Solution:** **Jeffrey Snover** led the creation of an object-oriented shell that integrates deeply with Windows via the .NET framework.

- **Evolution:** First released for Windows (2006). The open-source, cross-platform **PowerShell Core** was released in 2016 (now known simply as PowerShell 7+).

---------------
# PowerShell Basics Commands :

#### PowerShell commands are known as ==`cmdlets`==

#### 1. Cmdlet Syntax: `Verb-Noun`

PowerShell commands are called **cmdlets** and follow a consistent naming pattern.

- `Get-Content` - Gets the content of a file.

- `Set-Location` - Sets the current working directory (like `cd`).


#### 2. Essential Cmdlets for Discovery

| Command              | Description                                                                        |
| -------------------- | ---------------------------------------------------------------------------------- |
| **`powershell`**     | Launches PowerShell from a Command Prompt (cmd) window.                            |
| **`Get-Command`**    | Lists all available commands (cmdlets, functions, aliases) in the current session. |
| **`Get-Help`**       | Provides detailed help and usage information for a specific cmdlet.                |
| **`Get-Alias`**      | Lists all command aliases (shortcuts, e.g., `dir` for `Get-ChildItem`).            |
| **`Find-Module`**    | Searches online repositories (like the PowerShell Gallery) for modules.            |
| **`Install-Module`** | Downloads and installs a module from a repository, making its cmdlets available.   |
![[Pasted image 20260131012913.png]]

![[Pasted image 20260131012934.png]]
### Common Aliases

|Alias|Equivalent Cmdlet|
|---|---|
|**`dir`**|`Get-ChildItem`|
|**`cd`**|`Set-Location`|
|**`cat`**|`Get-Content`|
#### 3. Extending PowerShell with Modules

You can download and install new cmdlets from online repositories like the **PowerShell Gallery**.

- **==`Search for a module:`==** `Find-Module -Name "ModuleName*"`

- **==`Install a module:`==** `Install-Module -Name "ModuleName"`

![[Pasted image 20260131012849.png]]



Questions :

1 > How would you retrieve a list of commands that **start with** the verb `Remove`? [for the sake of this question, avoid the use of quotes (" or ') in your answer]

ANS :  Get-Command -name Remove*

2 > What cmdlet has its traditional counterpart `echo` as an alias?

ANS : Write-Output ( same as echo )

3 > What is the command to retrieve some example usage for the cmdlet `New-LocalUser`?

ANS : Get-Help New-LocalUser -examples

------
# Navigating the File System and Working with Files

PowerShell provides a range of cmdlets for navigating the file system and managing files, many of which have counterparts in the traditional Windows CLI.

### ==`List files & directories`==

```
Get-ChildItem
Get-ChildItem -Path <path>
```
Lists contents of a directory (like `dir` / `ls`)

![[Pasted image 20260131213817.png]]
### ==`Change directory`==

```
Set-Location
Set-Location -Path <path>
```
**Changes current directory (like `cd`)**

![[Pasted image 20260131213855.png]]
### ==`Create files & directories`==

**Directory:**  
```
New-Item -Path <path> -ItemType Directory
```

**File:**  
```
New-Item -Path <path> -ItemType File
```
**Creates files or directories**

![[Pasted image 20260131213915.png]]
### ==`Delete files & directories`==

```
Remove-Item    
Remove-Item -Path <path>
```
Removes files or directories

![[Pasted image 20260131213937.png]]
### ==`Copy & move items`==

**`Copy-Item`**  
```
Copy-Item -Path <source> -Destination <destination>
```
Copies files or directories

**`Move-Item`**  
```
Move-Item -Path <source> -Destination <destination>
```
Moves or renames items

![[Pasted image 20260131213958.png]]
### ==`Read file contents`==

```
Get-Content
Get-Content -Path <file>
```
Displays file content (like `type` / `cat`)

![[Pasted image 20260131214016.png]]

---
# Piping, Filtering, and Sorting Data

### Piping basics

**==`|`== (pipe)** passes output of one cmdlet as input to another. PowerShell pipes **objects**, not plain text (includes properties & methods) .

### ==`Sorting objects`==

**`Sort-Object :`**  Sorts objects by size
```
Get-ChildItem | Sort-Object Length
```

Here, `Get-ChildItem` retrieves the files (as objects), and the pipe (`|`) sends those file objects to `Sort-Object`, which then sorts them by their `Length` (size) property.

![[Pasted image 20260131220503.png]]
### ==`Filtering objects`==

**`Where-Object :`**Filters objects based on conditions

Example (by extension):
```
Get-ChildItem | Where-Object Extension -eq ".txt"
```

![[Pasted image 20260131220546.png]]

Example (by name pattern):  
```
Get-ChildItem | Where-Object Name -like "ship*"
```

![[Pasted image 20260131220607.png]]
#### Common comparison operators

- `-eq` → equal
- `-ne` → not equal
- `-gt` → greater than
- `-ge` → greater than or equal
- `-lt` → less than
- `-le` → less than or equal
- `-like` → matches pattern (wildcards)

### ==`Selecting output`==

**`Select-Object :`**Chooses specific properties or limits output

```
Get-ChildItem | Select-Object Name, Length
```

![[Pasted image 20260131220626.png]]
### ==`Searching file content`==

**`Select-String :`** Searches text inside files (like `grep` / `findstr`)

```
Select-String -Path <file> -Pattern "text"
```

 Supports **regular expressions (regex)**

![[Pasted image 20260131220747.png]]

---
# System and Network Information

## ==`System Information`==

```
Get-ComputerInfo
```
Retrieves **comprehensive system details**

**Includes:**
- OS version & edition
- Hardware info
- BIOS details
- Installation data
- More detailed than `systeminfo`

## ==`Local User Accounts`==

```
Get-LocalUser
```
Lists **all local user accounts**

Shows:
- Username
- Account status (Enabled/Disabled)
- Description

## ==`Network Configuration`==

```
Get-NetIPConfiguration
```
Displays **active network interface configuration** . **Comparable to:** `ipconfig` (but more detailed)

Includes:
- IP addresses   
- Default gateways
- DNS servers
- Network adapter details

```
Get-NetIPAddress
```
Shows **all IP addresses** on the system

**Includes:**
- IPv4 and IPv6
- Active and inactive addresses
- Loopback addresses
- Provides technical details (prefix, origin, lifetime)

---
# Real-Time System Analysis

### Purpose

- Used for **real-time system monitoring**
- Focuses on **running processes, services, network connections, and file integrity**
- Especially useful for **troubleshooting, incident response, and threat hunting**

## ==`Running Processes`==

```
Get-Process
```
Lists **currently running processes**

Displays:
- Process name
- Process ID (PID)
- CPU usage
- Memory usage

## ==`Services Management`==

```
Get-Service
```
Retrieves **status of system services**

Shows:
- Service name    
- Display name    
- Status (Running / Stopped / Paused)

## ==`Active Network Connections`==

```
Get-NetTCPConnection
```
Displays **current TCP connections**

Shows:

- Local & remote IP addresses
- Ports
- Connection state (Listen, Established, TimeWait)
- Owning process ID

**Use cases**
- Incident response
- Malware detection
- Finding backdoors or suspicious outbound connections

## ==`File Integrity & Malware Analysis`==

```
Get-FileHash
```

- Generates cryptographic hashes for files
- Default algorithm: **SHA256**

**Use cases**
- Verify file integrity
- Compare against known malicious hashes
- Detect file tampering
## ==`Alternate Data Streams (ADS)`==

### Viewing ADS

```
Get-Item -Path <file> -Stream *
```

 **:$DATA**
- Default NTFS data stream
- Normal file contents
- **Named streams**
    - Hidden Alternate Data Streams
    - Not visible in standard file listings

**Use cases**
- Forensics investigations
- Detecting hidden or malicious data stored in files
