Netdiscover is a **network reconnaissance tool** used primarily to discover live hosts (active devices) on a local network (LAN) . It works by **ARP (Address Resolution Protocol) scanning**, which is very effective in detecting devices on a subnet, especially in networks that do not respond to ping requests.

### **How Netdiscover Works**

**Netdiscover uses two main modes:**
### **a) Active Mode**

- Sends ARP requests to a range of IP addresses (subnet scan).

- Receives ARP replies from live hosts.

- Lists IP addresses, MAC addresses, and manufacturer/vendor info (from MAC).
### **b) Passive Mode**

- Listens for ARP requests on the network without sending any packets.

- Useful when you don’t want to alert network monitoring systems.

- Can detect devices communicating on the network while it listens.

------------

## **Commands :-**

**1.Scan default subnet**

```
sudo netdiscover   
```

Scans the network you are currently connected to and Auto-detects subnet

**2.Specify Network Interface**

```
netdiscover -i eth0
netdiscover -i wlan0
```

**3.Scan a Specific Range**

```
netdiscover -r 192.168.1.0/24
netdiscover -r 10.0.0.0/16
netdiscover -r 192.168.0.1-192.168.0.254
```

**4.Passive Mode (Listen Only)**

```
netdiscover -p (lowecase of p)
```

**Use when:**
- Avoid detection
- Just want to observe network traffic silently

**5.Active Mode (Force Active Scan)**


```
netdiscover -P ( Uppercase of P )
```

**6.Set Delay Between ARP Requests**

```

netdiscover -s 1 ( Fast scan )

netdiscover -s 5 ( Slow scan stealthier )
```

**7. Number of ARP Requests to Send**

Set number of times to send ARP packets per host.

```
netdiscover -c 3  //Scan each host 3 times
```

**8.Number of Results to Display**

```
netdiscover -n 50    //Limit number of discovered hosts shown
```

Shows only top 50 devices.

**9.Fast Scan Mode**

Skips DNS lookups for faster scanning.

```
netdiscover -f  // Provides quick results.
```

# 🔥 **9. -d : Debug Mode**

Shows detailed internal debug output.

**Use when:**  
Troubleshooting errors.

**Example:**

`netdiscover -d`

---

# 🔥 **10. -b : Display MAC Address Vendor List**

Show manufacturer/vendor information for known MAC prefixes.

**Example:**

`netdiscover -b`

---

# 🔥 **11. -L : Load Hostlist from File**

Scan only IP addresses from a file.

**Example:**

hosts.txt:

`192.168.1.10 192.168.1.20 192.168.1.30`

`netdiscover -L hosts.txt`