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


The options we pass into Hydra depend on which service (protocol) we’re attacking. 

## FTP

For example, if we wanted to brute force FTP with the username being `user` and a password list being `passlist.txt`, we’d use the following command:

```
hydra -l user -P passlist.txt ftp://10.48.162.202
```

## SSH

```
hydra -l <username> -P <full path to pass> 10.48.162.202 -t 4 ssh
```

|Option|Description|
|---|---|
|`-l`|specifies the (SSH) username for login|
|`-P`|indicates a list of passwords|
|`-t`|sets the number of threads to spawn|

```Example

```
## Post Web Form

We can use Hydra to brute force web forms too. You must know which type of request it is making; GET or POST methods are commonly used. You can use your browser’s network tab (in developer tools) to see the request types or view the source code.

```
sudo hydra <username> <wordlist> 10.48.162.202 http-post-form "<path>:<login_credentials>:<invalid_response>"
```

|Option|Description|
|---|---|
|`-l`|the username for (web form) login|
|`-P`|the password list to use|
|`http-post-form`|the type of the form is POST|
|`<path>`|the login page URL, for example, `login.php`|
|`<login_credentials>`|the username and password used to log in, for example, `username=^USER^&password=^PASS^`|
|`<invalid_response>`|part of the response when the login fails|
|`-V`|verbose output for every attempt|
