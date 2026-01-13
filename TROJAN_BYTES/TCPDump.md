Tcpdump is a command-line utility for capturing and analyzing network traffic in real-time on Unix-like systems, such as Linux and macOS. It intercepts and displays packets that are being sent and received by a system, making it a powerful tool for troubleshooting network problems, security analysis, and understanding network protocols.

History : The Tcpdump tool and its `libpcap` library are written in C and C++ and were released for Unix-like systems in the late 1980s or early 1990s. Consequently, they are very stable and offer optimal speed. The `libpcap` library is the foundation for various other networking tools today. Moreover, it was ported to MS Windows as `winpcap`.

**Key Benifits :**

1. Real time network monitoring
2. Filter traffic for specific analysis 
3. Security investigation and forensics 
4. Pinpoint traffic issues
----------------------------
**tcpdump command Format :**

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


**PCAP File Filtering Expression :**

- -host [IP]: Capture traffic from or to a specific host.

- -port [number]: Capture traffic from/to a specific port.

- -src [IP]: Source IP address filter.

- -dst [IP]: Destination IP address filter.

- -tcp, udp, icmp: Capture only specific protocols.
- 
------------------

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

