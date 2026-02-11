A **SOC** (**S**ecurity **O**perations **C**enter) is a dedicated facility operated by a specialized security team. This team aims to continuously monitor an organization’s network and resources and identify suspicious activity to prevent damage. This team works 24 hours a day, seven days a week.

### Purpose and Components

The main focus of the SOC team is to keep **Detection** and **Response** intact. The SOC team has some resources available in the form of security solutions that help them achieve this. These solutions integrate the whole company’s network and all the systems to monitor them from one centralized location. Continuous monitoring is required to detect and respond to any security incident.

![[Pasted image 20260211114206.png]]
## **Detection**

**Detect vulnerabilities**: Weaknesses in software/OS that attackers can exploit (e.g., unpatched Windows systems). While not always SOC's direct task, they affect overall security.

**Detect unauthorized activity**: Identifying actions beyond normal permissions (e.g., login with stolen credentials). Detection relies on clues like anomalous geographic location.

**Detect policy violations**: Spotting breaches of internal security rules (e.g., downloading pirated files, sending confidential data insecurely). Definitions vary by company.

**Detect intrusions**: Detecting unauthorized access to systems/networks (e.g., via exploited web apps, malware from malicious sites).

## **Response**

**Support with the incident response**: Once an incident is detected, certain steps are taken to respond to it. This response includes minimizing its impact and performing the root cause analysis of the incident. The SOC team also helps the incident response team carry out these steps.


There are three pillars of a SOC. With all these pillars, a SOC team becomes mature and efficiently detects and responds to different incidents. These pillars are **People**, **Process**, and **Technology**.

![The 3 pillars of SOC.](https://tryhackme-images.s3.amazonaws.com/user-uploads/6645aa8c024f7893371eb7ac/room-content/6645aa8c024f7893371eb7ac-1718954786769)  

  

**People**, **Process**, and **Technology** coexist in a SOC environment. A team of professional individuals working on state-of-the-art security tools in the presence of proper processes is what makes a mature SOC environment.

**==`Pillar 1`== : People**

People are always critical because automation generates alert noise that requires human judgment to filter false positives and identify real threats.
![[Pasted image 20260211132821.png]]
**SOC Team Roles & Responsibilities**

**SOC Analyst (Level 1): First Responder**  
Performs initial alert triage to determine if a detection is harmful and reports findings.

**SOC Analyst (Level 2): Incident Investigator**  
Conducts deeper investigation by correlating data from multiple sources.

**SOC Analyst (Level 3): Threat Hunter & Incident Responder**  
Proactively hunts for threats and leads the response to critical incidents (containment, eradication, recovery).

**Security Engineer: Tool Specialist**  
Deploys, configures, and maintains security solutions.

**Detection Engineer: Rule Developer**  
Creates and tunes the security rules and logic for detection.

**SOC Manager: Process & Communication Lead**  
Manages SOC processes and reports to the CISO on security posture.

**==`Pillar 2`== : Process**

Processes define the standardized workflows that each SOC role follows to ensure consistent and effective operations.

**Key SOC Processes:**

**1. Alert Triage**  
The foundational process performed first on any alert. It determines the alert's severity and priority by answering the **5 Ws**:

- **What?** The nature of the activity (e.g., "Malicious file detected").
- **When?** The timestamp of detection.
- **Where?** The affected system or location.
- **Who?** The associated user or account.
- **Why?** The root cause or source (e.g., "Downloaded from a pirated site").
![[Pasted image 20260211133055.png]]
**2. Reporting & Escalation**  
Harmful alerts are escalated as tickets to higher-level analysts. A report must include:

- Answers to the 5 Ws.
- Thorough analysis.
- Supporting evidence (e.g., screenshots).

**3. Incident Response & Forensics**  
For critical detections, a formal incident response process is initiated to contain and eradicate the threat. This may be followed by **forensics** to determine the root cause by analyzing system and network artifacts.

**==`Pillar 3`== : Technology**

Technology refers to the security solutions that centralize information and automate detection and response, minimizing manual effort.

**Key Security Solutions:**

**SIEM (Security Information and Event Management)**

- Central tool that **collects logs** from various network devices (log sources).
- Uses **configured detection rules** to identify suspicious activity by correlating data from multiple sources.
- Modern SIEMs include **user behavior analytics** and **threat intelligence**, often enhanced by machine learning.
- _Note:_ Primarily provides **detection** capabilities.

**EDR (Endpoint Detection and Response)**

- Provides detailed **real-time and historical visibility** into endpoint (device) activities.
- Operates at the endpoint level with extensive detection capabilities.
- Enables **automated response** and detailed investigation from a central console.

**Firewall**

- A **network security** barrier between internal and external networks.
- **Monitors and filters** incoming/outgoing traffic based on security rules.
- Can **detect and block** suspicious traffic before it enters the internal network.

**Other Solutions:** Antivirus, EPP, IDS/IPS, XDR, and SOAR also play unique roles. Technology selection depends on the organization's threat surface and available resources.