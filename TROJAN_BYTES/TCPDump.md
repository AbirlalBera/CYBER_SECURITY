Tcpdump is a command-line utility for capturing and analyzing network traffic in real-time on Unix-like systems, such as Linux and macOS. It intercepts and displays packets that are being sent and received by a system, making it a powerful tool for troubleshooting network problems, security analysis, and understanding network protocols.

History : The Tcpdump tool and its `libpcap` library are written in C and C++ and were released for Unix-like systems in the late 1980s or early 1990s. Consequently, they are very stable and offer optimal speed. The `libpcap` library is the foundation for various other networking tools today. Moreover, it was ported to MS Windows as `winpcap`.

**Key Benifits :**

1. Real time network monitoring
2. Filter traffic for specific analysis 
3. Security investigation and forensics 
4. Pinpoint traffic issues
----------------------------
# **tcpdump command Format :**


```
   tcpdump [options] [expressions ]
```

**options :**

- D [interface] : Use to identify all the network interface .

- i [interface] : Secify the network interface (e.g. `eth0`, `wlan0`).

- c [count] : Capture a specific number of packets(e.g. `c 100` for 100 packets).

- -w [File] : write captured packets to a file (e.g. `w capture.pcap`).

- -r [file] : Read from a previously saved capture file (e.g. `r capture.pcap`).

- -n : Disable DNS resolutions to show raw IP addresses.

- -v, -vv, -vvv : Increase verbosity level for more detailed output.

- -s [snaplen] : Specify the snapshot length(number of bytes per packet to capture).

- `-nn` : Don’t resolve IP addresses and don’t resolve protocol numbers.

---
# **PCAP File Filtering Expression :**

|Command|Explanation|
|---|---|
|`tcpdump host IP` or `tcpdump host HOSTNAME`|Filters packets by IP address or hostname|
|`tcpdump src host IP` or|Filters packets by a specific source host|
|`tcpdump dst host IP`|Filters packets by a specific destination host|
|`tcpdump port PORT_NUMBER`|Filters packets by port number|
|`tcpdump src port PORT_NUMBER`|Filters packets by the specified source port number|
|`tcpdump dst port PORT_NUMBER`|Filters packets by the specified destination port number|
|`tcpdump PROTOCOL`|Filters packets by protocol; examples include `ip`, `ip6`, and `icmp`|

------------------
# Advanced Filtering

## 1️⃣ Packet Length Filters

**greater LENGTH** : Displays packets whose size is **greater than or equal to** the specified length (in bytes).

```
Example: tcpdump greater 1000   [Shows packets ≥ 1000 bytes]
```

**less LENGTH :** Displays packets whose size is **less than or equal to** the specified length (in bytes).

```
Example: tcpdump less 64     [Shows packets ≤ 64 bytes]
```

## 2️⃣ Binary Operations (Used in Filters)

### **AND (`&`)**

**Definition:**  
Returns true (`1`) only if **both bits are 1**.

```
Example: tcpdump "tcp[tcpflags] & tcp-syn != 0" 

[Captures TCP packets where the SYN flag is set]
```

### **OR (`|`)**

**Definition:**  
Returns true if **at least one bit is 1**.

**Example:**

```
tcpdump "tcp[tcpflags] & (tcp-syn|tcp-ack) != 0"

[Captures packets with SYN or ACK flag set]
```

### **NOT (`!`)**

**Definition:**  
Inverts the bit value (`1 → 0`, `0 → 1`).

**Example:**

```
tcpdump "tcp[tcpflags] & tcp-rst == 0"

[Captures TCP packets without the RST flag]
```

## 3️⃣ Header Byte Filtering Syntax

### **proto[expr:size]**

**Definition:**  
Accesses a specific byte (or bytes) in a protocol header.

- `proto` → protocol (tcp, ip, udp, icmp, etc.)

- `expr` → byte offset (starting from 0)

- `size` → number of bytes (optional)

### Example 1: Ethernet Multicast

```
tcpdump "ether[0] & 1 != 0"
 
Filters Ethernet packets sent to multicast addresses.
```

### Example 2: IP Packets with Options

```
tcpdump "ip[0] & 0xf != 5"

Filters IP packets that contain IP header options.
```

---
## 4️⃣ TCP Flag Filtering (Most Common Use)

### **tcp[tcpflags]**

**Definition:**  
Refers to the **TCP flags field** in the TCP header.

### TCP Flags Definitions & Examples

#### **tcp-syn**

**Definition:**  
Used to **start a TCP connection**.

**Example:**

`tcpdump "tcp[tcpflags] == tcp-syn"`

➡️ Captures packets with **only SYN set**

#### **tcp-ack**

**Definition:**  
Acknowledges received data.

**Example:**

`tcpdump "tcp[tcpflags] & tcp-ack != 0"`

➡️ Captures packets with **ACK flag set**

#### **tcp-fin**

**Definition:**  
Gracefully **closes a TCP connection**.

**Example:**

`tcpdump "tcp[tcpflags] & tcp-fin != 0"`

➡️ Captures packets used to **end connections**

#### **tcp-rst**

**Definition:**  
Abruptly **resets a TCP connection**.

**Example:**

`tcpdump "tcp[tcpflags] & tcp-rst != 0"`

➡️ Captures **reset packets**

#### **tcp-push**

**Definition:**  
Forces data to be pushed to the application immediately.

**Example:**

`tcpdump "tcp[tcpflags] & tcp-push != 0"`

➡️ Captures packets with **PSH flag set**

---

## 5️⃣ Combined Flag Filters

### SYN + ACK (Handshake Response)

`tcpdump "tcp[tcpflags] & (tcp-syn|tcp-ack) != 0"`

**Definition:**  
Captures packets used in the **TCP three-way handshake**.

---
# Displaying Packets

|Command|Explanation|
|---|---|
|`tcpdump -q`|Quick and quite: brief packet information|
|`tcpdump -e`|Include MAC addresses|
|`tcpdump -A`|Print packets as ASCII encoding|
|`tcpdump -xx`|Display packets in hexadecimal format|
|`tcpdump -X`|Show packets in both hexadecimal and ASCII formats|
## 1️⃣ `-q` — Quick / Brief Packet Information

**Definition:**  
Displays **shorter output lines**. Shows only essential details such as:
- Timestamp
- Source & destination IP
- Source & destination ports
Useful when you want a **high-level overview** of traffic.

```
user@TryHackMe$ tcpdump -r TwoPackets.pcap reading from file TwoPackets.pcap, link-type EN10MB (Ethernet), snapshot length 262144 18:59:59.979771 IP 104.18.12.149.https > g5000.45248: Flags [P.], seq 2695955324:2695955349, ack 2856007037, win 16, options [nop,nop,TS val 412758285 ecr 3959057198], length 25 18:59:59.980574 IP g5000.45248 > 104.18.12.149.https: Flags [P.], seq 1:30, ack 25, win 2175, options [nop,nop,TS val 3959057384 ecr 412758285], length 29
```


---
### **Basic Capture & Output**

```
sudo tcpdump -i eth0 > file.out           # Redirect raw output to file
sudo tcpdump -i eth0 | tee file1.out      # View AND save to file simultaneously
```

### **Filter by Host & Verbosity**

```
sudo tcpdump -i eth0 host 192.168.229.129 -vvv  # Triple verbose for detailed info
```

### **Protocol-Based Filtering**

```
sudo tcpdump -i eth0 icmp                 # ICMP/ping packets only
sudo tcpdump -i eth0 udp                  # UDP packets only  
sudo tcpdump -i eth0 tcp port 80          # HTTP traffic only
```

### **Port Range & Multiple Ports**

```
sudo tcpdump -i eth0 portrange 100-200    # Ports 100 to 200
sudo tcpdump -i eth0 tcp port 80 or port 443  # HTTP or HTTPS traffic
```

### **Advanced Source/Destination Filters**

```
# Specific source → destination host
sudo tcpdump -i eth0 src 192.168.229.128 and dst host 172.65.64.5

# Specific source → destination port  
sudo tcpdump -i eth0 src 192.168.229.128 and dst port 443

# Specific source → destination network
sudo tcpdump -i eth0 src 192.168.229.128 and dst net 172.65.64.0/24
```

