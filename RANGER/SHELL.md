### What is a Shell?

A shell is software that allows a user to interact with an OS. It can be a graphical interface, but it is usually a command-line interface, and this will depend on the operating system running on the target system.
## What attackers can do with a shell

🖥️ ==`Remote System Control`== : Run commands or software on the target machine from afar.
 
⬆️ ==`Privilege Escalation`== : Upgrade from limited access (user) to higher access (admin/root).

📤 ==`Data Exfiltration`== : Search for, read, and copy sensitive files or data.

🔁 ==`Persistence`== : 

Maintain access by:  Creating users, Adding credentials ,Installing backdoors

🧪 ==`Post‑Exploitation`== : 

Perform actions after initial access, such as: Deploying malware, Creating hidden accounts ,Deleting logs or data

🌐 ==`Pivoting`== : Use the compromised system as a **launch point** to attack other systems on the same network.

---
# Reverse Shell

A reverse shell, sometimes referred to as a "connect back shell," is one of the most popular techniques for gaining access to a system in cyberattacks. The connections initiate from the target system to the attacker's machine, which can help avoid detection from network firewalls and other security appliances.

