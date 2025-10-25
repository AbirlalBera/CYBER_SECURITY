#### Target Ip :  10.201.76.54

-----------

RustScan 

rustscan -a 10.201.76.54 -- -sC -sV 

![[Pasted image 20251025174816.png]]

We found open ports :  

Open 10.201.76.54:22  
Open 10.201.76.54:80
Open 10.201.76.54:3306
Open 10.201.76.54:5038

![[Pasted image 20251025183606.png]]

These are the service running on the server.

----------------
Then we found a exploit on msf console and the service was MagnusBilling


search MagnusBilling
![[Pasted image 20251025183737.png]]


![[Pasted image 20251025184034.png]]

