
Just as you secure a home with guards and cameras, organizations implement proactive security measures. However, they must also plan for what happens **after** a breach occurs—when an attacker bypasses defenses.

In the digital realm, such breaches are **cyber security incidents**. Incident Response (IR) is the structured approach for handling an incident from start to finish. It encompasses:

- Deploying preventative security
- Fighting active threats
- Minimizing impact

---
# What Are Incidents?

### Events and Logs

Computing devices such as laptops and mobile phones run multiple processes. Some are interactive, like playing games or watching videos, while others run in the background and are necessary for system operation. Every action performed by these processes generates an **event**, which is recorded as a log.

Because many processes run simultaneously, devices generate a very large number of events. Reviewing them manually is not feasible, so security solutions collect these events as logs and analyze them to identify suspicious or harmful activity.

### Alerts
When a security solution detects suspicious behavior from logs, it generates an **alert**. The security team reviews and analyzes these alerts to determine whether they indicate a real security threat.

Alerts fall into two categories:
**False Positives**: Alerts that appear harmful but are actually legitimate activity (e.g., high data transfer caused by a cloud backup).

**True Positives**: Alerts that correctly identify malicious activity (e.g., a phishing email targeting a user).
### Incidents
A **true positive alert** is classified as an **incident**. Incidents represent real security threats that require action from the security team.

### Incident Severity
Once an incident is identified, it is assigned a **severity level** to prioritize response efforts. Severity levels include **low, medium, high, and critical**. Critical incidents are addressed first due to their potential impact, followed by high, medium, and low severity incidents.

---
# Types of Incidents

Not all harmful digital activities are the same, even though they are often generically called “hacking.” In cybersecurity, **security incidents** are categorized into different types. These incidents may occur independently or multiple types may occur together in a single attack.
### Malware Infections
Malware is a malicious program designed to damage systems, networks, or applications. Most security incidents involve some form of malware. There are many types of malware, each capable of causing different levels of harm. Malware infections often occur through files such as documents, text files, or executable programs that users download or open.
![[Pasted image 20260211142902.png]]
### Security Breaches
A security breach occurs when an unauthorized individual gains access to confidential or sensitive data. These incidents are extremely critical because organizations rely on the confidentiality of their data, which should only be accessible to authorized users.
![[Pasted image 20260211142910.png]]
### Data Leaks
Data leaks involve the exposure of confidential information to unauthorized parties. Attackers may use leaked data for reputational damage, blackmail, or extortion. Unlike security breaches, data leaks can also happen unintentionally due to human error or system misconfiguration.
![[Pasted image 20260211142918.png]]
### Insider Attacks
Insider attacks originate from within an organization. These involve employees or trusted individuals intentionally causing harm, such as infecting the network with malware using a USB device. Insider attacks are particularly dangerous because insiders often have higher access privileges than external attackers.
![[Pasted image 20260211142924.png]]
### Denial of Service (DoS) Attacks
Availability is one of the three core principles of cybersecurity. Denial of Service (DoS) attacks aim to disrupt availability by overwhelming a system, network, or application with excessive or fake requests. This exhausts system resources and prevents legitimate users from accessing services.
![[Pasted image 20260211142937.png]]
### Impact and Severity
Each type of incident has a different impact depending on the organization. The severity of an incident cannot be universally defined. For example, a data leak may have minimal impact on one organization but be devastating to another. Similarly, a Denial of Service attack can be catastrophic for businesses that rely heavily on online services.

---
# Incident Response Process

Handling different types of security incidents can be challenging due to their varying nature. To ensure incidents are managed effectively and consistently, organizations follow **Incident Response Frameworks**. These frameworks provide a structured approach to detecting, handling, and recovering from security incidents.

Two of the most widely used frameworks are **SANS** and **NIST**. Both are developed by well-known cybersecurity organizations and follow similar principles.

## SANS Incident Response Framework (PICERL)

The SANS framework consists of **six phases**, commonly remembered as **PICERL**.

### 1. Preparation
This phase focuses on building the capability to handle incidents before they occur. It includes forming an incident response team, creating an incident response plan, and deploying security tools.  
**Example:** Conducting phishing awareness training for employees.

### 2. Identification
In this phase, the organization looks for abnormal behavior that may indicate an incident. Security tools and monitoring systems are used to detect suspicious activity.  
**Example:** Detecting unusually high data transfer from a host that was later found to be compromised by a phishing attachment.

### 3. Containment
Once an incident is confirmed, immediate action is taken to limit its spread and impact. This often involves isolating systems or disabling compromised accounts.  
**Example:** Isolating the infected host from the network to prevent lateral movement.

### 4. Eradication
The eradication phase involves completely removing the threat from the environment to ensure it does not persist.  
**Example:** Running deep malware scans to remove malicious software.

### 5. Recovery
Affected systems are restored and returned to normal operation. Systems may be rebuilt, restored from backups, and tested before being put back into production.  
**Example:** Reconfiguring the compromised system and restoring lost data from backups.

### 6. Lessons Learned
After the incident is resolved, the organization reviews what happened to identify gaps and improve future response efforts.  
**Example:** Conducting a post-incident review to analyze root causes and enhance security controls.

![[Pasted image 20260211143208.png]]
## NIST Incident Response Framework

The **NIST framework** is similar to SANS but simplifies the process into **four phases**:

1. Preparation
2. Detection and Analysis
3. Containment, Eradication, and Recovery
4. Post-Incident Activity
![[Pasted image 20260211143245.png]]
This model groups related activities together while maintaining the same core incident response principles.
## Incident Response Plan (IRP)

Organizations usually formalize their response process in a document called the **Incident Response Plan**. This plan defines how incidents are handled before, during, and after they occur. It is officially approved by senior management and ensures consistency in response.

### Key Components of an Incident Response Plan

- Defined roles and responsibilities
- Incident response methodology
- Communication plan with stakeholders and law enforcement
- Escalation procedures

### Key Takeaway

Both **SANS and NIST frameworks** provide structured, effective approaches to incident response. Organizations may adapt these frameworks to build their own incident response processes and plans.