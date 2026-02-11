
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

### Impact and Severity
Each type of incident has a different impact depending on the organization. The severity of an incident cannot be universally defined. For example, a data leak may have minimal impact on one organization but be devastating to another. Similarly, a Denial of Service attack can be catastrophic for businesses that rely heavily on online services.