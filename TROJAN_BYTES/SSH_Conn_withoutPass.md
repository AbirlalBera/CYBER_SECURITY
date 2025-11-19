
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

On Kali, run:

`ssh-copy-id username@server_ip`

If `ssh-copy-id` is missing (rare on Kali), install it:

`sudo apt install sshpass sudo apt install openssh-client`

Then copy manually:

`cat ~/.ssh/id_ed25519.pub | ssh username@server_ip "mkdir -p ~/.ssh && cat >> ~/.ssh/authorized_keys && chmod 600 ~/.ssh/authorized_keys"`

### **Step 3: Test SSH login**

```
ssh username@server_ip
```

### 

### 
