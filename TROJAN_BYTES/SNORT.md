```
sudo apt-get install snort -y
```

```
snort --version
```

![[Pasted image 20260116233027.png]]

Lets setup promiscuous mode so snort can monitor all the traaffic :

![[Pasted image 20260116233135.png]]

```
sudo ip link set ens33 promisc on
```

---
open snort manual :

```
man snort
```

---
