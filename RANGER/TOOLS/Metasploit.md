Metasploit is the most widely used exploitation framework. Metasploit is a powerful tool that can support all phases of a penetration testing engagement, from information gathering to post-exploitation

Metasploit has two main versions:

- **Metasploit Pro**: The commercial version that facilitates the automation and management of tasks. This version has a graphical user interface (GUI).
- **Metasploit Framework**: The open-source version that works from the command line. This room will focus on this version, installed on the AttackBox and most commonly used penetration testing Linux distributions.

The Metasploit Framework is a set of tools that allow information gathering, scanning, exploitation, exploit development, post-exploitation, and more. While the primary usage of the Metasploit Framework focuses on the penetration testing domain, it is also useful for vulnerability research and exploit development.

The main components of the Metasploit Framework are :
- **msfconsole**: The main command-line interface.
- **Modules**: supporting modules such as exploits, scanners, payloads, etc.
- **Tools**: Stand-alone tools that will help vulnerability research, vulnerability assessment, or penetration testing. Some of these tools are msfvenom, pattern_create and pattern_offset. pattern_create and pattern_offset are tools useful in exploit development.

---
# **Modules** 

Command to check all the modules :

```
cd /opt/metasploit-framework/embedded/framework/modules
```

![[Pasted image 20260113210232.png]]

### **Auxiliary :**

Any supporting module, such as scanners, crawlers and fuzzers, can be found here.

```
auxiliary/
├── admin
├── analyze
├── bnat
├── client
├── cloud
├── crawler
├── docx
├── dos
├── example.py
├── example.rb
├── fileformat
├── fuzzers
├── gather
├── parser
├── pdf
├── scanner
├── server
├── sniffer
├── spoof
├── sqli
├── voip
└── vsploit
```

## Encoders

Encoders will allow you to encode the exploit and payload in the hope that a signature-based antivirus solution may miss them.

```
encoders/
├── cmd
├── generic
├── mipsbe
├── mipsle
├── php
├── ppc
├── ruby
├── sparc
├── x64
└── x86
```

## Evasion

While encoders will encode the payload, they should not be considered a direct attempt to evade antivirus software. On the other hand, “evasion” modules will try that, with more or less success.

```
evasion/
└── windows
   ├── applocker_evasion_install_util.rb
   ├── applocker_evasion_msbuild.rb
   ├── applocker_evasion_presentationhost.rb
   ├── applocker_evasion_regasm_regsvcs.rb
   ├── applocker_evasion_workflow_compiler.rb
   ├── process_herpaderping.rb
   ├── syscall_inject.rb
   ├── windows_defender_exe.rb
   └── windows_defender_js_hta.rb
```

## Exploits

Exploits take advantage of vulnerabilities to gain access to a system.

```
exploits/
├── aix
├── android
├── apple_ios
├── bsd
├── bsdi
├── dialup
├── example_linux_priv_esc.rb
├── example.py
├── example.rb
├── example_webapp.rb
├── firefox
├── freebsd
├── hpux
├── irix
├── linux
├── mainframe
├── multi
├── netware
├── openbsd
├── osx
├── qnx
├── solaris
├── unix
└── windows
```

## NOPs (No Operation)

NOPs do nothing and are used as **buffers** to achieve consistent payload sizes.

```
nops/
├── aarch64
├── armle
├── cmd
├── mipsbe
├── php
├── ppc
├── sparc
├── tty
├── x64
└── x86
```

**Purpose:**  
Payloads are the **code executed on the target system** after exploitation.

Examples:
- Open a shell
- Run a command
- Add a user
- Launch `calc.exe` (proof of concept)

```
payloads/
├── adapters
├── singles
├── stagers
└── stages
```

### Payload Types Explained

- **Adapters:** An adapter wraps single payloads to convert them into different formats. For example, a normal single payload can be wrapped inside a Powershell adapter, which will make a single powershell command that will execute the payload.  

- **Singles:** Self-contained payloads (add user, launch notepad.exe, etc.) that do not need to download an additional component to run.

- **Stagers:** Responsible for setting up a connection channel between Metasploit and the target system. Useful when working with staged payloads. “Staged payloads” will first upload a stager on the target system then download the rest of the payload (stage). This provides some advantages as the initial size of the payload will be relatively small compared to the full payload sent at once.

- **Stages:** Downloaded by the stager. This will allow you to use larger sized payloads.

### Single vs Staged Payload Naming

```
generic/shell_reverse_tcp                      → Single 
(inline) windows/x64/shell/reverse_tcp         → Staged
```

- `_` → Single payload
- `/` → Staged payload

## Post Modules (Post-Exploitation)

Used **after a successful compromise**.

Typical actions:
- Privilege escalation
- Credential harvesting
- System enumeration
- Persistence

```
post/
├── aix
├── android
├── apple_ios
├── bsd
├── firefox
├── hardware
├── linux
├── multi
├── networking
├── osx
├── solaris
└── windows

```