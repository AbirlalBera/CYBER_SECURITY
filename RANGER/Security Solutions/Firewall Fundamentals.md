A security tool, hardware or software that is used to filter network traffic by stopping unauthorized incoming and outgoing traffic.

![[6645aa8c024f7893371eb7ac-1723114287705.svg]]A lot of incoming and outgoing traffic flows daily between our digital devices and the Internet they are connected to. What if somebody sneaks in between this massive traffic without getting caught? We would also need a security guard for our digital devices then, who can check the data coming in and going out of them. This security guard is what we call a **firewall**. A firewall is designed to inspect a network's or digital device’s incoming and outgoing traffic. The goal is the same as for the security guard sitting outside a building: not letting any unauthorized visitor enter a system or a network. You instruct the firewall by giving it rules to check against all the traffic. Anything that comes in or goes out of your device or network would face the firewall first. The firewall will allow or deny that traffic based on its maintained rules. Most firewalls today go beyond rule-based filtering and offer extra functionalities to protect your device or network from the outside world. 

---
# Types of Firewalls

Firewall deployment became common in networks after organizations discovered their ability to filter harmful traffic from their systems and networks. Several different types of firewalls were introduced afterward, each serving a unique purpose. It's also important to note that different types of firewalls work on different OSI model layers. Firewalls are categorized into many types. 

Let’s examine a few of the most common types of firewalls and their roles in the OSI model.
![[Pasted image 20260220001955.png]]

### ==`Stateless Firewall`==

### 📌 OSI Working Layers:

- **Layer 3 (Network)**
- **Layer 4 (Transport)**

### 📌 How It Works:

- Checks each packet individually
- Matches packets against predefined rules
- Does NOT remember previous packets or connections
### 📌 Key Characteristics:

- Basic filtering
- Fast processing
- No connection tracking
- Cannot apply complex security logic

### 📌 Limitation:

If one malicious packet is blocked, future packets from the same source are still treated as new traffic.

### ==`Stateful Firewall`==

### 📌 OSI Layer:

- **Layer 7 (Application Layer)**

### 📌 How It Works:

- Acts as an intermediary between internal network and internet
- Inspects packet contents (not just headers)
- Masks internal IP addresses

### 📌 Key Characteristics:

- Deep content inspection
- Application-level filtering
- Content filtering policies
- SSL/TLS decryption capability
- Hides internal network structure

### 📌 Advantage:

Can block traffic based on content (e.g., specific websites or file types).

### ==`Proxy Firewall`==

The problem with previous firewalls was their inability to inspect the contents of a packet. Proxy firewalls, or application-level gateways, act as intermediaries between the private network and the Internet and operate on the OSI model’s layer 7. They inspect the content of all packets as well. The requests made by users in a network are forwarded by this proxy after inspection and masking them with their own IP address to provide anonymity for the internal IP addresses. Content filtering policies can be applied to these firewalls to allow/deny incoming and outgoing traffic based on their content.

### ==`Next-Generation Firewall (NGFW)`==

This is the most advanced type of firewall that operates from layer 3 to layer 7 of the OSI model, offering deep packet inspection and other functionalities that enhance the security of incoming and outgoing network traffic. It has an intrusion prevention system that blocks malicious activities in real time. It offers heuristic analysis by analyzing the patterns of attacks and blocking them instantly before reaching the network. NGFWs have SSL/TLS decryption capabilities, which inspect the packets after decrypting them and correlate the data with the threat intelligence feeds to make efficient decisions.

The table below lists each firewall’s characteristics, which will help you choose the most suitable firewall for different use cases.

Firewalls	Characteristics
Stateless firewalls	- Basic filtering
- No track of previous connections
- Efficient for high-speed networks
Stateful firewalls	- Recognize traffic by patterns
- Complex rules can be applicable
- Monitor the network connections
Proxy firewalls	- Inspect the data inside the packets as well
- Provides content filtering options
- Provides application control
- Decrypts and inspects SSL/TLS data packets
Next-generation firewalls	- Provides advanced threat protection
- Comes with an intrusion prevention system
- Identify anomalies based on heuristic analysis
- Decrypts and inspects SSL/TLS data packets