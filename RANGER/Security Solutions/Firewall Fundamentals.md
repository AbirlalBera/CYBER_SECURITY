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

### 📌 OSI Layers:

- **Layer 3 to Layer 7**

### 📌 How It Works:

- Combines features of all previous firewalls
- Performs deep packet inspection (DPI)
- Integrates Intrusion Prevention System (IPS)
- Uses threat intelligence feeds
- Performs SSL/TLS decryption
- Uses heuristic and behavioral analysis

### 📌 Key Characteristics:

- Advanced threat detection
- Real-time attack blocking
- Pattern recognition
- Application awareness
- SSL inspection

### 📌 Advantage:

Provides comprehensive protection against modern cyber threats.

The table below lists each firewall’s characteristics, which will help you choose the most suitable firewall for different use cases.

|Firewalls|Characteristics|
|---|---|
|Stateless firewalls|- Basic filtering  <br>- No track of previous connections  <br>- Efficient for high-speed networks|
|Stateful firewalls|- Recognize traffic by patterns  <br>- Complex rules can be applicable  <br>- Monitor the network connections|
|Proxy firewalls|- Inspect the data inside the packets as well  <br>- Provides content filtering options  <br>- Provides application control  <br>- Decrypts and inspects SSL/TLS data packets|
|Next-generation firewalls|- Provides advanced threat protection  <br>- Comes with an intrusion prevention system  <br>- Identify anomalies based on heuristic analysis  <br>- Decrypts and inspects SSL/TLS data packets|

---
# Rules in Firewalls

A **firewall rule** tells the firewall how to handle specific network traffic. It defines **what traffic is allowed, blocked, or redirected** based on certain conditions. Organizations create customized rules depending on their security needs.

**Example:** One company may block all SSH traffic.  Another may allow SSH only from specific trusted IP addresses.

The basic components of a firewall’s rule are described below:

- **Source address:** The machine’s IP address that would originate the traffic.
- **Destination address:** The machine’s IP address that would receive the data.
- **Port:** The port number for the traffic.
- **Protocol:** The protocol that would be used during the communication.
- **Action:** This defines the action that would be taken upon identifying any traffic of this particular nature. (Allow, Deny, Forward)
- **Direction:** This field defines the rule’s applicability to incoming or outgoing traffic.


### Types of Actions in Firewall Rules

The component “Action” from a rule indicates the steps to take after a data packet falls under the category of the defined rule. Three main actions that can be applied to a rule are explained below.

### Allow :
A rule’s “Allow” action indicates that the particular traffic defined inside the rule would be permitted.

For example, let’s create a rule with an action to allow all the outgoing traffic from our network for port 80 (used for HTTP traffic to the Internet).

|Action|Source|Destination|Protocol|Port|Direction|
|---|---|---|---|---|---|
|Allow|192.168.1.0/24|Any|TCP|80|Outbound|

### Deny :
A rule’s “Deny” action means that the traffic defined inside the rule would be blocked and not permitted. These rules are fundamental for the security team to deny specific traffic coming from malicious IP addresses and create more rules to reduce the threat surface of the network.

For example, let’s create a rule with an action to deny all the incoming traffic on port 22 (used for remotely connecting to a machine via SSH) of our critical server.

|Action|Source|Destination|Protocol|Port|Direction|
|---|---|---|---|---|---|
|Deny|Any|192.168.1.0/24|TCP|22|Inbound|
### Forward :
The action “Forward” redirects traffic to a different network segment using the forwarding rules created on the firewalls. This applies to the firewalls that provide routing functionality and act as gateways between different network segments.

For example, let’s create a rule with an action to forward all the incoming traffic on port 80 (used for HTTP traffic) to the web server `192.168.1.8`.

|Action|Source|Destination|Protocol|Port|Direction|
|---|---|---|---|---|---|
|Forward|Any|192.168.1.8|TCP|80|Inbound|

# Directionality of Rules
Firewalls have different categories of rules, each categorized based on the traffic directionality on which the rules are created. Let’s examine each of these directionalities.
![](https://tryhackme-images.s3.amazonaws.com/user-uploads/6645aa8c024f7893371eb7ac/room-content/6645aa8c024f7893371eb7ac-1725970029903.svg)

**Inbound Rules :** - Apply to incoming traffic. **Example:** Allow incoming HTTP (port 80) to a web server. Block incoming SSH (port 22).

**Outbound Rules :** - Apply to outgoing traffic. **Example:** Block all outgoing SMTP (port 25) except from mail server. Allow employees to access web services (port 80/443).

**Forward Rules :** - Apply when traffic is passing through the firewall to another network segment. **Example:** Forward HTTP traffic to internal web server. Forward VPN traffic to VPN server.

---
# Windows Defender Firewall

**Windows Defender Firewall** is a built-in firewall in Microsoft Windows that allows you to monitor and control incoming and outgoing network traffic.

It helps:
- Block unauthorized access
- Control application network usage
- Create custom security rules
- Protect systems in different network environments




