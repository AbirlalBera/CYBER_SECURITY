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

**Scan default subnet**

```
sudo netdiscover   //Scans the network you are currently connected to.and Auto-detects subnet
                    
```


