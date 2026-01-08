
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

