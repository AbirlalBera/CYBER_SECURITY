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

#### PowerShell commands are known as `cmdlets`

#### 1. Cmdlet Syntax: `Verb-Noun`

PowerShell commands are called **cmdlets** and follow a consistent naming pattern.

- `Get-Content` - Gets the content of a file.

- `Set-Location` - Sets the current working directory (like `cd`).


#### 2. Essential Cmdlets for Discovery

|Cmdlet|Purpose|Example|
|---|---|---|
|`Get-Command`|Lists all available commands (cmdlets, aliases, functions).|`Get-Command`|
|`Get-Help`|Shows help for a specific cmdlet.|`Get-Help Get-Date -Examples`|
|`Get-Alias`|Shows shortcut names for cmdlets.|`Get-Alias`|

**Key Aliases:**

- `dir` -> `Get-ChildItem` (Lists directory contents)

- `cd` -> `Set-Location` (Changes directory)

- `cat` -> `Get-Content` (Shows file content)


#### 3. Extending PowerShell with Modules

You can download and install new cmdlets from online repositories like the **PowerShell Gallery**.

- **Search for a module:** `Find-Module -Name "ModuleName*"`

- **Install a module:** `Install-Module -Name "ModuleName"`