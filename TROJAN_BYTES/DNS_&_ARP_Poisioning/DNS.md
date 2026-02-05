**DNS (Domain Name System)** is often called the "phonebook of the internet." Its primary job is to translate human-friendly domain names (like `google.com`) into machine-friendly IP addresses (like `142.250.190.46`).

---
### Domain Hierarchy

![A diagram of the domain hierarchy, with the root domain at the top, branching into several top-level domains, which in turn brnach into second level domains](https://tryhackme-images.s3.amazonaws.com/user-uploads/5c549500924ec576f953d9fc/room-content/a168c8511887fff98a6944619c4b5259.png)

## The DNS Hierarchy

DNS is organized in an "inverted tree" structure. It is decentralized so that no single server has to store every single website on the planet.

- **Root Level:** Represented by a silent dot `.` at the very end of every domain (e.g., `google.com.`).

- **Top-Level Domain (TLD):** The extension, such as `.com`, `.net`, `.gov`, or country codes like `.uk`.

- **Second-Level Domain:** The actual name of the site (e.g., `google` in `google.com`).

- **Subdomain:** A prefix used to organize sections of a site (e.g., `mail.google.com`).

---
## Common DNS Record Types

When you manage a website, you use different "records" to tell the internet where to send traffic:

| **Record Type** | **Full Name**       | **Purpose**                                                      |
| --------------- | ------------------- | ---------------------------------------------------------------- |
| **A**           | Address Record      | Maps a domain to an **IPv4** address.                            |
| **AAAA**        | IPv6 Address Record | Maps a domain to an **IPv6** address.                            |
| **CNAME**       | Canonical Name      | Creates an alias (points one domain to another domain).          |
| **MX**          | Mail Exchanger      | Specifies where to send emails for that domain.                  |
| **TXT**         | Text Record         | Used for verification (like proving you own the site to Google). |
| **NS**          | Name server         |                                                                  |
| **PTR**         | Reverse DNS lookup  |                                                                  |

---
## How DNS Works (The Lookup Process)

When you type a URL into your browser, a "DNS lookup" occurs. This is a multi-step process involving several servers that work together to find the right IP address.

1. **DNS Recursor:** The "librarian." This is usually provided by your ISP. It receives your request and goes searching through other servers to find the answer.

2. **Root Nameserver:** The first stop in the hierarchy. It doesn't know the IP, but it knows where to find the **Top-Level Domain (TLD)** servers (like `.com` or `.org`).

3. **TLD Nameserver:** This server manages a specific extension. If you're looking for `example.com`, the `.com` TLD server will point you toward the server that actually owns that domain.

4. **Authoritative Nameserver:** The final stop. This server holds the actual "A Record" (IP address) for the domain. It returns the IP to the Recursor, which then gives it to your browser.

![[Pasted image 20260103171347.png]]

---

## what is DNS Caching 

**DNS Caching** is the temporary storage of DNS lookup results (IP addresses) on your device or across the network. Its main goal is to make the internet faster by preventing your computer from having to ask the entire "DNS hierarchy" for the same website address every time you click a link.

---
## The Role of TTL (Time to Live)

DNS records aren't stored forever. Every record comes with a **TTL (Time to Live)** value, which is a timer set by the website owner.

**High TTL (e.g., 24 hours):** Good for stable websites. It reduces traffic and makes things fast but means if the site moves to a new server, it might take a day for everyone to see the change.

 **Low TTL (e.g., 5 minutes):** Good for sites that change often. It's more "accurate" but forces the computer to do more lookups.