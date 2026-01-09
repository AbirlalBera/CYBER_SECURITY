```
sudo apt install snort -y

snort --version
```

![[Pasted image 20260109214335.png]]

---

![[Pasted image 20260109214509.png]]

```
sudo ip link set ens33 promisc on
```

---

```
man snort
```

---

```
ls -al /etc/snort [Lists all fil]
```

![[Pasted image 20260109214745.png]]

```
sudo vim /etc/snort/snort.conf
```

![[Pasted image 20260109215450.png]]

```
ipvar HOME_NET any ->  ipvar HOME_NET 192.168.229.130/24 [Machine IP]
```

---
