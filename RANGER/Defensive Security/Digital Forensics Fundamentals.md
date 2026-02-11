**Introduction to Digital Forensics**

Forensics is the application of methods and procedures to investigate crimes. **Digital forensics** is the branch that investigates **cyber crimes**—criminal activities conducted on or using digital devices. It uses specialized tools and techniques to thoroughly examine digital devices, find evidence, and support legal action.

**Context:** While digital devices simplify communication and daily tasks, their widespread use has also led to a rise in cyber crimes.

**Example Investigation:**

Law enforcement raids a bank robber’s home and seizes digital devices (laptop, phone, hard drive, USB). The digital forensics team securely collects and examines the devices in a forensics lab. Evidence found includes:

- A digital map of the bank on the laptop.
- Documents detailing entrance/escape routes and plans to bypass security on the hard drive.
- Photos/videos of previous robberies on the laptop.
- Illegal chat groups and call records related to the robbery on the mobile phone.

This evidence is critical for legal proceedings.

**Scope:** This section will cover the **standard procedures** followed by digital forensics teams for evidence collection, storage, analysis, and reporting.

---
### **Digital Forensics Process (NIST Framework)**
![[Pasted image 20260211135951.png]]
The process is defined in **four phases**:

1. **Collection** : Identify and securely collect all potential digital evidence (computers, phones, USBs, etc.).

 **Critical:** Preserve original data integrity and maintain a detailed evidence log.

2. **Examination** : Filter and extract relevant data from the large collected dataset.

 _Example:_ Isolate files from a specific date/time or data belonging to a particular user.

3. **Analysis** : Correlate evidence to reconstruct events and draw conclusions. Build a chronological timeline of activities relevant to the case.

4. **Reporting** : Create a detailed report of the methodology, findings, and recommendations. Include an **executive summary** for audiences with varying technical understanding. Presented to law enforcement and management.        

### **Types of Digital Forensics**

Different evidence categories require specialized tools and techniques.
![[Pasted image 20260211140003.png]]
**Computer Forensics:** Investigation of computers and laptops (most common).

**Mobile Forensics:** Investigation of mobile devices (call records, messages, GPS, etc.).

**Network Forensics:** Investigation of network-wide traffic and logs.

**Database Forensics:** Investigation of database intrusions, data theft, or tampering.

**Cloud Forensics:** Investigation of data stored on cloud infrastructure (often challenging due to limited evidence access).

**Email Forensics:** Investigation of emails for phishing, fraud, or other malicious campaigns.

---
### **Evidence Acquisition:**

Acquiring evidence securely and without altering the original data is critical. While methods vary by device, general best practices apply.

**1. Proper Authorization**
- Must be obtained **before** collection.
- Evidence gathered without authorization is likely **inadmissible in court**.
- Ensures the investigation operates within legal boundaries.
![[Pasted image 20260211140127.png]]
**2. Chain of Custody**
- A **formal document** that tracks evidence from collection to presentation in court.
- Prevents loss or tampering by creating an **accountable audit trail**.
- **Key details included:** Evidence description, collector's name, date/time of collection, storage location, and every access record.
- Proves the **integrity and reliability** of the evidence.

**3. Use of Write Blockers**

Write blockers are an essential part of the digital forensics team’s toolbox. Suppose you are collecting evidence from a suspect’s hard drive and attaching the hard drive to the forensic workstation. While the collection occurs, some background tasks in the forensic workstation may alter the timestamps of the files on the hard drive. This can cause hindrances during the analysis, ultimately producing incorrect results. Suppose the data was collected from the hard drive using a write blocker instead in the same scenario. This time, the suspect’s hard drive would remain in its original state as the write blocker can block any evidence alteration actions.

![A write blocker.](https://tryhackme-images.s3.amazonaws.com/user-uploads/6645aa8c024f7893371eb7ac/room-content/6645aa8c024f7893371eb7ac-1719477004541)
- **Hardware or software tools** that prevent any modification to the evidence source.
- **Purpose:** When connecting a suspect's drive to a forensic workstation, a write blocker ensures the original data remains **unaltered** (e.g., timestamps are preserved).
- **Essential** for maintaining the integrity of the original evidence.
