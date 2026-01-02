Download the files from mitmproxy website (https://www.mitmproxy.org/)

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
