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

### 📌 OSI Layers:

- **Layer 3 (Network)**
- **Layer 4 (Transport)**

### 📌 How It Works:

- Maintains a **state table**
- Tracks active connections
- Uses connection history to make decisions

### 📌 Key Characteristics:

- Monitors ongoing session
- Applies complex policies
- Automatically allows packets belonging to trusted sessions
- Denies packets from blocked connections

### 📌 Advantage:

Smarter than stateless firewalls because it remembers previous activity.

### ==`Proxy Firewall`==

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