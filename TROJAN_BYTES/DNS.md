**DNS (Domain Name System)** is often called the "phonebook of the internet." Its primary job is to translate human-friendly domain names (like `google.com`) into machine-friendly IP addresses (like `142.250.190.46`).

---
### Domain Hierarchy

![A diagram of the domain hierarchy, with the root domain at the top, branching into several top-level domains, which in turn brnach into second level domains](https://tryhackme-images.s3.amazonaws.com/user-uploads/5c549500924ec576f953d9fc/room-content/a168c8511887fff98a6944619c4b5259.png)

**TLD (Top-Level Domain)**

A TLD is the most righthand part of a domain name. So, for example, the [tryhackme.com](http://tryhackme.com/) TLD is **.com**. There are two types of TLD, gTLD (Generic Top Level) and ccTLD (Country Code Top Level Domain). Historically a gTLD was meant to tell the user the domain name's purpose; for example, a .com would be for commercial purposes, .org for an organisation, .edu for education and .gov for government. And a ccTLD was used for geographical purposes, for example, .ca for sites based in Canada, .co.uk for sites based in the United Kingdom and so on. Due to such demand, there is an influx of new gTLDs ranging from .online , .club , .website , .biz and so many more. For a full list of over 2000 TLDs .

**Second-Level Domain**

Taking [tryhackme.com](http://tryhackme.com/) as an example, the .com part is the TLD, and tryhackme is the Second Level Domain. When registering a domain name, the second-level domain is limited to 63 characters + the TLD and can only use a-z 0-9 and hyphens (cannot start or end with hyphens or have consecutive hyphens).

**Subdomain**

A subdomain sits on the left-hand side of the Second-Level Domain using a period to separate it; for example, in the name [admin.tryhackme.com](http://admin.tryhackme.com/) the admin part is the subdomain. A subdomain name has the same creation restrictions as a Second-Level Domain, being limited to 63 characters and can only use a-z 0-9 and hyphens (cannot start or end with hyphens or have consecutive hyphens). You can use multiple subdomains split with periods to create longer names, such as [jupiter.servers.tryhackme.com](http://jupiter.servers.tryhackme.com/). But the length must be kept to 253 characters or less. There is no limit to the number of subdomains you can create for your domain name.

---
## Common DNS Record Types

When you manage a website, you use different "records" to tell the internet where to send traffic:

|**Record Type**|**Full Name**|**Purpose**|
|---|---|---|
|**A**|Address Record|Maps a domain to an **IPv4** address.|
|**AAAA**|IPv6 Address Record|Maps a domain to an **IPv6** address.|
|**CNAME**|Canonical Name|Creates an alias (points one domain to another domain).|
|**MX**|Mail Exchanger|Specifies where to send emails for that domain.|
|**TXT**|Text Record|Used for verification (like proving you own the site to Google).|