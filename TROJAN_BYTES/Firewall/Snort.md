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
ls -al /etc/snort [Lists all files related to snort]
```

![[Pasted image 20260109214745.png]]

---
### Lets configure snort :

```
sudo vim /etc/snort/snort.conf
```

![[Pasted image 20260109215450.png]]

![[Pasted image 20260109220810.png]]

```
ipvar HOME_NET any ->  ipvar HOME_NET 192.168.229.130/24 [Machine IP]
```

---
### Lets start snort :

```
sudo snort -T -i ens33 -c /etc/snort/snort.conf
```
