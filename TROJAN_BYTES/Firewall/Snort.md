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
### Lets test Snort’s configuration :

```
sudo snort -T -i ens33 -c /etc/snort/snort.conf
```

- `sudo`   → Runs Snort with root privileges (needed for network access)

- `snort`  → Starts the Snort IDS/IPS program

- `-T` (**Test mode**)  
   → Checks the configuration and rule files  
   → **Does NOT capture traffic**
   
- `-i ens33` → Specifies the network interface to test (e.g., `ens33`)

- `-c /etc/snort/snort.conf` → Loads the main Snort configuration file

---
## Start Snort (Common Modes)

### 🔍 IDS mode (console alerts)

`sudo snort -i ens33 -c /etc/snort/snort.conf -A console`

- `-i ens33` → network interface
    
- `-c snort.conf` → config & rules
    
- `-A console` → show alerts on screen
    

🧠 **Good for learning & labs**

---

### 📝 IDS mode (log alerts to files)

`sudo snort -i ens33 -c /etc/snort/snort.conf -l /var/log/snort`

- Logs alerts to `/var/log/snort`
    

---

### 🔇 Quiet background mode

`sudo snort -i ens33 -c /etc/snort/snort.conf -q -l /var/log/snort`

- `-q` → quiet (no banner)
    

---

### 🧪 Quick test (no config, basic detection)

`sudo snort -i ens33 -A console`

---

## Verify it’s running

In another terminal:

`ps aux | grep snort`

Or generate traffic (e.g., ping, nmap) and watch alerts.

---

## Stop Snort

Press:

`CTRL + C`

---

## Memory trick 🧠

> **Remove `-T`, add `-A` or `-l`**