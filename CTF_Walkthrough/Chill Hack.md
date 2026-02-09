**Target Ip :** 
```
10.49.160.137
```

-----------
# Scanning using RustScan 

```
rustscan -a 10.49.160.137 -- -sC -sV 
```

We found open ports :  
```
Open 10.49.160.137:22
Open 10.49.160.137:21
Open 10.49.160.137:80
```

These are the service running on the server :
![[Pasted image 20260209215212.png]]

---
Now we are trying to find the subdomians.

```
subfinder -d http://10.49.160.137
```

![[Pasted image 20260209215314.png]]