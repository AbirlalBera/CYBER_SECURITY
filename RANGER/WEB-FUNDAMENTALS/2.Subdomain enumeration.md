
### Types of subdomain enumeration methods -

There are three different subdomain enumeration methods: 

```
1.Brute Force

2.OSINT (Open-Source Intelligence) 

3.Virtual Host.
```

---
## OSINT -


**SSL/TLS Certificates :**

https://crt.sh/   =   It offer a searchable database of certificates that shows current and historical results.

![[Pasted image 20260108200428.png]]


**Search Engines :**

Using advanced search methods on websites like Google, such as the `site: filter`, can narrow the search results. For example, `site:*.domain.com -site:www.domain.com` would only contain results leading to the domain name domain.com but exclude any links to www.domain.com; therefore, it shows us only subdomain names belonging to domain.com.

```
site:*.tryhackme.com -site:www.tryhackme.com
```


**sublist3r :**

To speed up the process of OSINT subdomain discovery, we can automate the above methods with the help of tools like [Sublist3r](https://www.kali.org/tools/sublist3r/)


```
sublist3r -d kali.org -t 3 -e bing
```


---

## Brute Force -

**Dnsrecon**

Bruteforce DNS (Domain Name System) enumeration is the method of trying tens, hundreds, thousands or even millions of different possible subdomains from a pre-defined list of commonly used subdomains. Because this method requires many requests, we automate it with tools to make the process quicker. In this instance, we are using a tool called dnsrecon to perform this

```
dnsrecon -t brt -d acmeitsupport.thm
```


---

## Virtual Hosts

Some subdomains aren't always hosted in publically accessible DNS results, such as development versions of a web application or administration portals. Instead, the DNS record could be kept on a private DNS server or recorded on the developer's machines in their **/etc/hosts** file (or **c:\windows\system32\drivers\etc\hosts** file for Windows users), which maps domain names to IP addresses.

```

ffuf -w /usr/share/wordlists/SecLists/Discovery/DNS/namelist.txt -H "Host: FUZZ.acmeitsupport.thm" -u http://10.48.160.174

```

The above command uses the -w switch to specify the wordlist we are going to use. The **-H** switch adds/edits a header (in this instance, the Host header), we have the **FUZZ** keyword in the space where a subdomain would normally go, and this is where we will try all the options from the wordlist.

Because the above command will always produce a valid result, we need to filter the output. We can do this by using the page size result with the **-fs** switch. Edit the below command replacing **{size}** with the most occurring size value from the previous result and try it on the AttackBox.

```

ffuf -w /usr/share/wordlists/SecLists/Discovery/DNS/namelist.txt -H "Host: FUZZ.acmeitsupport.thm" -u http://10.48.160.174 -fs {size}

```

```
EXAMPLE :  

ffuf -w /usr/share/wordlists/SecLists/Discovery/DNS/namelist.txt -H "Host: FUZZ.acmeitsupport.thm" -u http://10.48.160.174 -fs 2395

```

This command has a similar syntax to the first apart from the **-fs** switch, which tells **ffuf** to ignore any results that are of the specified size.



