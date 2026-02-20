
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

- **Malware Analysis:** Quickly understand a suspicious binary's functionality.
    
- **Threat Hunting:** Identify binaries with specific, dangerous capabilities.
    
- **Incident Response & Defense:** Crucial for understanding threats and planning countermeasures.
    

#### 5. Learning Objectives (for the TryHackMe Room)

1. Explore what CAPA is.
    
2. Learn how to use CAPA effectively.
    
3. Understand common fields and results in CAPA's output.
    
4. Leverage the tool to identify a program's potential activity.
    

#### 6. Prerequisites

- Familiarity with the **MITRE ATT&CK Framework** is recommended.
    

#### 7. Virtual Machine / Lab Setup

- The room provides a pre-configured VM.
    
- CAPA is pre-installed.
    
- **Note:** Running CAPA in the VM can be slow.
    
- Pre-processed reports are available for quick reference at:
    
    - `C:\Users\Administrator\Desktop\capa\`
        
- **Example files:**
    
    - `cryptbot.txt`
        
    - `cryptbot_vv.txt`
        
    - `cryptbot_vv.json`