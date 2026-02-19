
If an attacker successfully bypasses a firewall via a legitimate-looking connection and then performs any malicious activities inside the network, there should be something to detect it in a timely manner. For this purpose, we have a security solution inside the network. This solution is known as an `Intrusion Detection System (IDS)`.

---
# Types of IDS

IDS can be categorized differently depending on certain factors. An IDS’s main categorization depends on its deployment and detection modes.

**IDS can be deployed in the following ways:**

- **Host Intrusion Detection System (HIDS):** Host-based IDS solutions are installed individually on the hosts and are responsible for only detecting potential security threats associated with that particular host. They provide detailed visibility of the host’s activities. However, host intrusion detection systems can be challenging to manage in large networks as they are resource-intensive and require management on each host.

- **Network Intrusion Detection System (NIDS):** Network-based IDS solutions are crucial in detecting potentially malicious activities within the whole network, regardless of any specific hosts. They monitor the network traffic of all the hosts involved to detect suspicious activities. It provides a centralized view of all the detections inside the whole network.

![Difference between NIDS and HIDS.](https://tryhackme-images.s3.amazonaws.com/user-uploads/6645aa8c024f7893371eb7ac/room-content/6645aa8c024f7893371eb7ac-1723026309300.png)

## Detection Modes

**Signature-Based IDS:** Signature-based IDS detects attacks by comparing network traffic with a database of known attack patterns called signatures. When traffic matches a stored signature, the system generates an alert for administrators. The effectiveness of this type depends on how strong and updated the signature database is. It is fast and accurate for known attacks but cannot detect zero-day attacks because those attacks do not yet have predefined signatures in the database. An example of a signature-based IDS is Snort.

**Anomaly-Based IDS:** 

**Hybrid IDS:** 

Signature-based IDS can detect threats quickly, while other IDS can have a high processing overhead. However, it is also essential to consider the IDS based on several different factors. Signature-based IDS can be a good option for covering a small threat surface. Anomaly-based IDS and hybrid IDS can help detect modern zero-day attacks, which are increasing daily and can cause massive damage to organizations.