Target Url : http://tazapay.com/
Target IP : 198.202.211.1

Nmap scan result : 
 ![[Pasted image 20251105125843.png]]
![[Pasted image 20251105184221.png]]
![[Pasted image 20251105184250.png]]


![[Pasted image 20251105184054.png]]

![[Pasted image 20251105184445.png]]

![[Pasted image 20251105184810.png]]

![[screencapture-web-check-xyz-check-https-tazapay-com-2025-11-05-18_49_40.png]]

--------------

## **Subdomains**

**All Subdomains : -**

```
┌──(kali㉿RANGER)-[~]
└─$ subfinder -d https://tazapay.com
www.tazapay.com
mattermost-dev.tazapay.com
offer.tazapay.com
docs.tazapay.com
m2demo.tazapay.com
tazapay-prod-test.tazapay.com
preprod.tazapay.com
pritunl.tazapay.com
vpn.tazapay.com
api-dev.tazapay.com
tazapay-design-test.tazapay.com
drone.tazapay.com
pritunl-user.tazapay.com
developer.tazapay.com
web.tazapay.com
support.tazapay.com
akto.tazapay.com
admin.tazapay.com
pay.tazapay.com
dev-api.tazapay.com
pritunl-web.tazapay.com
custom-domain.tazapay.com
pritunl-test.tazapay.com
hr.tazapay.com
sonarqube.tazapay.com
dev.tazapay.com
marketing.tazapay.com
example.tazapay.com
m2dev.tazapay.com
staging.tazapay.com
careers.tazapay.com
bank.tazapay.com
wcdemo.tazapay.com
app.tazapay.com
pritunl-clone.tazapay.com
wcdev.tazapay.com
api-sandbox.tazapay.com
[INF] Found 38 subdomains for tazapay.com in 11 seconds 727 milliseconds
```


-----------------------------------------------------------------------------------------------------------------
Active Subdomai

```
┌──(kali㉿RANGER)-[~]
└─$ subfinder -d https://tazapay.com -nW
[INF] Current subfinder version v2.9.0 (latest)
[INF] Loading provider config from /home/kali/.config/subfinder/provider-config.yaml
[INF] Enumerating subdomains for tazapay.com
www.tazapay.com
service.tazapay.com
marketing.tazapay.com
akto.tazapay.com
docs.tazapay.com
relay.tazapay.com
preprod.tazapay.com
staging.tazapay.com
wcdemo.tazapay.com
support.tazapay.com
pritunl.tazapay.com
hr.tazapay.com
api-orange.tazapay.com
wcdev.tazapay.com
vpn.tazapay.com
[INF] Found 15 subdomains for tazapay.com in 10 seconds 26 milliseconds
```


-----------------------------------------------------------------------------------------------------------------



