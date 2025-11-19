
### **how to connect ssh without puting your passwod every single time?**

##### **ANS :** 

we can connect to SSH **without typing your password every time** by using **SSH key‑based authentication** (public/private key). 


### **Step 1: Generate an SSH key on your local machine**

Open a terminal in Kali and run:

`ssh-keygen -t ed25519`

(or RSA if you prefer)

`ssh-keygen -t rsa -b 4096`

Press **Enter** three times to accept the defaults.

Your keys are created here:

`~/.ssh/id_ed25519 ~/.ssh/id_ed25519.pub`


### **Step 2: Copy your public key to the remote server**



### 

### 

### 
