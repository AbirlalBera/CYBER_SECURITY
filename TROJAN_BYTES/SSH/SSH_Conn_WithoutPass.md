
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
------------
# ✅ **Step 3: Test SSH login**

From Kali:

`ssh username@server_ip`

You should now log in **without typing your password**.

---

# 🔥 Kali Tip: Auto-load key with ssh-agent

If you want _no passphrase typing_ and auto key loading:

`eval "$(ssh-agent -s)" ssh-add ~/.ssh/id_ed25519`

To load key automatically every reboot, add this to your `~/.bashrc`:

`eval "$(ssh-agent -s)" > /dev/null ssh-add ~/.ssh/id_ed25519 2>/dev/null`

---

# 🛑 Optional: Disable password login on the server (more secure)

On the **remote server**, edit SSH config:

`sudo nano /etc/ssh/sshd_config`

Find or add:

`PasswordAuthentication no PubkeyAuthentication yes`

Restart SSH:

`sudo systemctl restart ssh`

---

# 🗂 Optional: Use an SSH config file for faster commands

Create/edit this file on Kali:

`nano ~/.ssh/config`

Add:

`Host myserver     HostName server_ip     User username     IdentityFile ~/.ssh/id_ed25519`

Now connect simply with:

`ssh myserver`

---

If you want, I can also show you how to:

✔ Connect to multiple servers without passwords  
✔ Fix "Permission denied (publickey)" errors  
✔ Use SSH keys for Git (GitHub, GitLab, Kali repos)  
✔ Transfer files using SCP or SSHFS

Just tell me!