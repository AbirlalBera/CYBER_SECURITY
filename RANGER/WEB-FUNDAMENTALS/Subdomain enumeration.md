
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

