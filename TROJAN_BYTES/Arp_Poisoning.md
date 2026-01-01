
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

