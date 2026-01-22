 **Hydra** is a fast, automated **online authentication testing tool** that attempts many username/password combinations against network services.

It supports a **very wide range of protocols** (SSH, FTP, HTTP forms, databases, RDP, SNMP, SMB, etc.), which is why it’s commonly used in:

- Penetration testing

- Red-team exercises

- Security research and training labs

- Because it can rapidly try large password lists, **weak, short, common, or default credentials are easily compromised**.
- Devices and applications that ship with **default credentials** (e.g., `admin:password`) are especially vulnerable.
- Hydra comes **pre-installed in Kali Linux** and many security-focused environments, and is easily installable on other Linux distributions.

---
## Hydra Commands


The options we pass into Hydra depend on which service (protocol) we’re attacking. For example, if we wanted to brute force FTP with the username being `user` and a password list being `passlist.txt`, we’d use the following command:

```hydra -l user -P passlist.txt ftp://10.48.162.202
```
