There are three main ways of discovering content on a website :

**1.Manually**

**2.Automated** 

**3.OSINT (Open-Source Intelligence).**

---
## Manual Discovery -

**1.Robots.txt**

The robots.txt file is a document that tells search engines which pages they are and aren't allowed to show on their search engine results or ban specific search engines from crawling the website altogether. These pages may be areas such as administration portals or files meant for the website's customers. This file gives us a great list of locations on the website that the owners don't want us to discover as penetration testers.


**2.Favicon**

The favicon is a small icon displayed in the browser's address bar or tab used for branding a website. Sometimes when frameworks are used to build a website, a favicon that is part of the installation gets leftover, and if the website developer doesn't replace this with a custom one, this can give us a clue on what framework is in use


**3.Sitemap.xml**

Unlike the robots.txt file, which restricts what search engine crawlers can look at, the sitemap.xml file gives a list of every file the website owner wishes to be listed on a search engine. These can sometimes contain areas of the website that are a bit more difficult to navigate to or even list some old webpages that the current site no longer uses but are still working behind the scenes.


**4.HTTP Headers**

When we make requests to the web server, the server returns various HTTP headers. These headers can sometimes contain useful information such as the webserver software and possibly the programming/scripting language in use.Try running the below curl command against the web server, where the **-v** switch enables verbose mode, which will output the headers

```
root@ip-10-48-110-94:~# curl http://10.48.172.79 -v


*   Trying 10.48.172.79:80...
* TCP_NODELAY set
* Connected to 10.48.172.79 (10.48.172.79) port 80 (#0)
> GET / HTTP/1.1
> Host: 10.48.172.79
> User-Agent: curl/7.68.0
> Accept: */*
> 
* Mark bundle as not supporting multiuse
< HTTP/1.1 200 OK
< Server: nginx/1.18.0 (Ubuntu)
< Date: Sat, 03 Jan 2026 13:07:47 GMT
< Content-Type: text/html; charset=UTF-8
< Transfer-Encoding: chunked
< Connection: keep-alive
< X-FLAG: THM{HEADER_FLAG}
```


**5.Framework Stack**

Once we've established the framework of a website, either from the above favicon example or by looking for clues in the page source such as comments, copyright notices or credits, you can then locate the framework's website. From there, we can learn more about the software and other information, possibly leading to more content we can discover.

---

## OSINT Discovery -

1.