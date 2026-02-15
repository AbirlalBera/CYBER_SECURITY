# Find the system IP

```
sudo netdiscover -f
```

![[Pasted image 20260215115159.png]]

GOT IP : 192.168.229.135

---

# Scanning 

```
rustscan -a 192.168.229.135 -- -sC -sV -O
```


