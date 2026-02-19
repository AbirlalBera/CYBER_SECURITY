## What Are VM Network Types?

**VM (Virtual Machine) network types** define how a virtual machine connects to other machines and networks—whether that’s the internet, your local network, or only the host computer.

# 🔥 Why VM Network Types Matter

1.  Safe hacking environments
2. Controlled VM connectivity to networks
3. Prevents accidental attacks on production systems
4. Enables realistic attack simulation.

---
Types :

# 1️⃣ NAT(Network Address Translation)

A network mode where the virtual machine accesses external networks through the host machine using Network Address Translation (NAT), sharing the host’s IP address. The VM can go out to the internet, but outside devices cannot directly connect to it (unless configured).

![[Pasted image 20260219185904.png]]


# 2️⃣Bridged Network

A network mode where the virtual machine connects directly to the physical network through the host’s network adapter and acts like an independent physical computer. In simple terms the VM becomes another device on your real network.



# 3️⃣ Host-Only Network

A network mode where the virtual machine can communicate only with the host computer, but not with external networks.The VM talks only to your computer — not the internet.



