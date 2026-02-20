
#### 1. The Problem: Analyzing Malicious Software

**Risk:** Running unknown software can compromise your machine.

**Solution:** Use a **sandbox** or isolated environment.

**Two Main Analysis Types:**
- **Dynamic Analysis:** Running the code to observe its behavior.
- **Static Analysis:** Examining the code without executing it.

#### 2. What is CAPA?

**Full Name:** Common Analysis Platform for Artifacts.

**Developer:** FireEye Mandiant team.

**Purpose:** An automated tool that identifies the **capabilities** of a file (what it _can_ do) by analyzing it statically.

**Key Benefit:** Encapsulates years of reverse engineering knowledge, making capability analysis faster and accessible to non-experts.

**Supported File Types:**
- Portable Executables (PE)
- ELF binaries   
- .NET modules    
- Shellcode    
- Sandbox reports        

#### 3. How CAPA Works

It analyzes a file and applies a set of pre-defined **rules**.

These rules describe common behaviors.

The output tells you what the program is capable of, such as:
- Network communication    
- File manipulation    
- Process injection    

#### 4. Use Cases

**Malware Analysis:** Quickly understand a suspicious binary's functionality.

**Threat Hunting:** Identify binaries with specific, dangerous capabilities.

**Incident Response & Defense:** Crucial for understanding threats and planning countermeasures.


#### 5. Learning Objectives (for the TryHackMe Room)

1.Explore what CAPA is.

2.Learn how to use CAPA effectively.

3.Understand common fields and results in CAPA's output.

4.Leverage the tool to identify a program's potential activity.

---
# Tool Overview 
#### 1. Basic Usage

**Command:** `capa.exe <path_to_binary>`

**Process:**
1.Open PowerShell.
2.Navigate to the directory with the binary (e.g., `C:\Users\Administrator\Desktop\capa`).
3.Run the command.

**Note:** Analysis can take several minutes.

#### 2. Key Command-Line Options

|Option|Description|Sample Syntax|
|---|---|---|
|`-h` or `--help`|Show help message and exit.|`capa -h`|
|`-v` or `--verbose`|Enable verbose result document.|`capa.exe .\cryptbot.bin -v`|
|`-vv` or `--vverbose`|Enable a **very** verbose result document.|`capa.exe .\cryptbot.bin -vv`|

**Effect of `-v` and `-vv`:** These options provide more detailed results but significantly increase processing time.


==`capa.exe .\cryptbot.bin`== – This command runs **CAPA** on the file `cryptbot.bin` to analyze its capabilities.



==`Get-Content .\cryptbot.txt`== –  `Get-Content` is a **PowerShell command** used to read and display the contents of a file.


---
# Dissecting CAPA Results Part 1: General Information, MITRE and MAEC

As mentioned in the previous task, the results of running CAPA against cryptbot.bin  will be discussed in the succeeding task. As such, we will dissect the results per block and topic.

The first block contains basic information about the file. This includes the following:

- The cryptographic algorithms, such as the `md5`, and `sha1/256`.
- The `analysis` field tells us how CAPA performed its analysis on the file.
- The `os` field reveals the operating system (OS) context for which the identified capabilities apply.
- The `arch` field allows us to determine whether we are dealing with a binary related to x86 architecture.
- The `path` where the analyzed file was located.

![[Pasted image 20260221003216.png]]

