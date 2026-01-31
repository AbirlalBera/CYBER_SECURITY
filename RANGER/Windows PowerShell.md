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

### ==`Change directory`==

```
Set-Location
Set-Location -Path <path>
```

**Changes current directory (like `cd`)**

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

### ==`Delete files & directories`==

```
Remove-Item    
Remove-Item -Path <path>
```

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

### ==`Read file contents`==

```
Get-Content
Get-Content -Path <file>
```
Displays file content (like `type` / `cat`)

