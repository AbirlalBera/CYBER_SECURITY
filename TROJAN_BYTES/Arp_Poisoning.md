
ARP Poisoning (also called ARP Spoofing) is a **man-in-the-middle attack** that exploits the ARP (Address Resolution Protocol) to intercept network traffic between two devices. The attacker sends falsified ARP messages to link their MAC address with the IP address of a legitimate device, causing network traffic to be redirected through the attacker's machine.

### Normal communication

```
Windows (Victim)  →  Router  →  Internet
```

### During ARP Poisoning

```
Windows (Victim) → Attacker (Linux) → Router → Internet
```

----------

