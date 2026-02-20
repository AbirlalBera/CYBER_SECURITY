
If an attacker successfully bypasses a firewall via a legitimate-looking connection and then performs any malicious activities inside the network, there should be something to detect it in a timely manner. For this purpose, we have a security solution inside the network. This solution is known as an `Intrusion Detection System (IDS)`.

---
# Types of IDS

IDS can be categorized differently depending on certain factors. An IDS’s main categorization depends on its deployment and detection modes.

**IDS can be deployed in the following ways:**

- **Host Intrusion Detection System (HIDS):** Host-based IDS solutions are installed individually on the hosts and are responsible for only detecting potential security threats associated with that particular host. They provide detailed visibility of the host’s activities. However, host intrusion detection systems can be challenging to manage in large networks as they are resource-intensive and require management on each host.

- **Network Intrusion Detection System (NIDS):** Network-based IDS solutions are crucial in detecting potentially malicious activities within the whole network, regardless of any specific hosts. They monitor the network traffic of all the hosts involved to detect suspicious activities. It provides a centralized view of all the detections inside the whole network.

![Difference between NIDS and HIDS.](https://tryhackme-images.s3.amazonaws.com/user-uploads/6645aa8c024f7893371eb7ac/room-content/6645aa8c024f7893371eb7ac-1723026309300.png)

## ==`Detection Modes`==

**==`Signature-Based IDS:`==** Signature-based IDS detects attacks by comparing network traffic with a database of known attack patterns called signatures. When traffic matches a stored signature, the system generates an alert for administrators. The effectiveness of this type depends on how strong and updated the signature database is. It is fast and accurate for known attacks but cannot detect zero-day attacks because those attacks do not yet have predefined signatures in the database. An example of a signature-based IDS is Snort.

**==`Anomaly-Based IDS:`==** Anomaly-based IDS works by first learning the normal behavior (baseline) of a system or network. It then monitors current activity and generates alerts whenever it detects deviations from that baseline. Since it does not rely on stored signatures, it can detect zero-day attacks. However, it may produce many false positives because legitimate activities can sometimes appear abnormal. Fine-tuning and properly defining normal behavior can help reduce these false positives.

**==`Hybrid IDS:`==** Hybrid IDS combines both signature-based and anomaly-based detection techniques. It uses signature-based detection for known threats and anomaly-based detection for new or unknown attacks. This approach leverages the strengths of both methods, providing broader protection, although it may require more processing power and careful configuration.

In summary, signature-based IDS is efficient and quick for known threats and suitable for smaller threat environments. Anomaly-based and hybrid IDS are more effective in detecting modern and zero-day attacks but may involve higher processing overhead and tuning requirements.

---
# IDS Example: Snort

Snort is one of the most widely used open-source IDS solutions, developed in 1998. It primarily uses signature-based detection and can also support anomaly-based techniques through preprocessing and configuration. Snort identifies threats using rule files that contain known attack signatures. It comes with built-in rule sets capable of detecting a wide range of malicious traffic. Administrators can also create custom rules to detect specific types of traffic not covered by default rules. Additionally, built-in rules can be disabled if they are not relevant to a particular network environment. This flexibility makes Snort highly customizable for different security needs.
### Modes of Snort

**Packet Sniffer Mode:**  
In this mode, Snort reads and displays network packets in real time without analyzing them against detection rules. It does not function as an IDS here but is useful for monitoring traffic and troubleshooting network issues. Administrators can view traffic directly on the console or save it to a file for inspection.

**Packet Logging Mode:**  
Packet logging mode captures and stores network traffic in PCAP format for later analysis. It logs all observed traffic and related detections. This mode is especially useful for forensic investigations, where security teams need historical traffic data to perform root cause analysis after an attack.

**Network Intrusion Detection System (NIDS) Mode:**  
This is Snort’s primary and most important mode. In NIDS mode, Snort monitors network traffic in real time and compares it against its rule files. When traffic matches a known attack signature, it generates an alert for security administrators. This mode provides the core IDS functionality.
![[Pasted image 20260220012339.png]]
In summary, while Snort can operate as a packet sniffer or packet logger, its most significant role as a security solution is in NIDS mode, where it actively detects and alerts on potential threats.

---
# Snort Usage

During Snort installation, you must specify the network interface and the network range to monitor. By default, Snort captures only the traffic intended for the host system. If you want Snort to monitor the entire network, the network interface must be set to promiscuous mode so it can capture all passing traffic, not just traffic addressed to the host.

Snort’s main files are stored in the `/etc/snort` directory. The most important file is `snort.conf`, which defines network variables such as `$HOME_NET`, specifies which rule files are enabled, and controls other configuration settings. The detection rules are stored inside the `rules` directory. Custom rules are typically added to the `local.rules` file.
![[Pasted image 20260220013335.png]]
### Snort Rule Format

A Snort rule follows a specific structure:
```
action protocol source_ip source_port -> destination_ip destination_port (rule options)
```

![[Pasted image 20260220195445.png]]

The details of the components involved in this rule are given below:

- **Action:** This specifies which action to take when the rule triggers. In this case, we have the action to "alert" when the traffic matches this rule.

- **Protocol:** This refers to the protocol that matches this rule. In this case, we use the protocol "ICMP" when pinging a host.

- **Source IP:** This determines the IP originating from the traffic. Since we want to detect traffic from any source IP, we set this as "any".

- **Source port:** This determines the port from which the traffic originates. Since we want to detect traffic from any source port, we set this as "any".

- **Destination IP:** This specifies the destination IP to which the matching traffic comes; it generates the alert. In this case, we used "$HOME_NET". This is a variable, and we defined its value as our whole network’s range in Snort’s configuration file.

- **Destination port:** This specifies the port the traffic would reach. Since we want to detect traffic coming to any port, we set it to "any."

- **Rule metadata:** Every rule has some metadata. That is defined at the end of the rule in parentheses. The following are its components:
    - **Message (msg):** This describes the message displayed when the subject rule triggers. The message should indicate the type of activity detected. In this case, we used "Ping Detected".
    - **Signature ID (sid):** Every rule has a unique identifier that differentiates it from others. This identifier is called the signature ID (sid). In this case, we set the sid to "10001".
    - **Rule revision (rev):** This sets the rule's revision number. Every time the rule is modified, its revision number is incremented, which helps in tracking changes to any rule.


# Example custom rule:

Let’s paste the sample rule explained above into the custom **"local.rules"** file in the Snort rules directory.

Firstly, open the "local.rules" file in a text editor:

```shell-session
ubuntu@tryhackme:~$ sudo nano /etc/snort/rules/local.rules
```

Now, add the following rule after the already present rules to the file:
```
alert icmp any any -> 127.0.0.1 any (msg:"Loopback Ping Detected"; sid:10003; rev:1;)
```

This rule generates an alert whenever an ICMP packet (ping) is sent to the loopback address (127.0.0.1).

### Running Snort in NIDS Mode

To run Snort for real-time detection:
```
sudo snort -q -l /var/log/snort -i lo -A console -c /etc/snort/snort.conf
```

Here:
- `-q` runs in quiet mode,
- `-l` specifies log directory,
- `-i` specifies network interface,
- `-A console` prints alerts to console,
- `-c` specifies configuration file.

When you ping `127.0.0.1`, Snort detects the ICMP traffic and generates the configured alert, confirming the rule works correctly.
![[Pasted image 20260220195922.png]]
![[Pasted image 20260220195939.png]]

### Running Snort on PCAP Files

Snort can also analyze previously captured traffic stored in PCAP files for forensic investigation. This is useful when investigating past incidents.
![[Pasted image 20260220200415.png]]
Command to analyze a PCAP file:

```
sudo snort -q -l /var/log/snort -r Task.pcap -A console -c /etc/snort/snort.conf
```

The `-r` option allows Snort to read and analyze traffic from a PCAP file instead of live network traffic.

In summary, Snort allows real-time intrusion detection, custom rule creation, and offline traffic analysis, making it a flexible and powerful IDS tool.

