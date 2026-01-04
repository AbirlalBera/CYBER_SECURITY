Below are **15 XSS & CSP interview questions with clear, professional answers**, written in **simple but technically strong language** so you can confidently answer in interviews.

---

## **1. What is Cross-Site Scripting (XSS), and how does it differ from SQL Injection?**

**Answer:**  
XSS is a client-side vulnerability where malicious scripts are injected into a web page and executed in the victim’s browser. SQL Injection targets the backend database, while XSS targets users by abusing the browser’s trust in the application.

---

## **2. Explain Reflected, Stored, and DOM-Based XSS.**

**Answer:**

- **Reflected XSS:** Payload is reflected in the HTTP response immediately.
    
- **Stored XSS:** Payload is stored in a database and served to multiple users.
    
- **DOM-Based XSS:** Execution happens entirely in the browser via JavaScript, without server-side reflection.
    

---

## **3. Why is DOM-Based XSS hard to detect with automated scanners?**

**Answer:**  
Because it requires JavaScript execution and runtime DOM manipulation, which most scanners cannot fully emulate.

---

## **4. User input is reflected inside an HTML attribute. How do you test for XSS?**

**Answer:**  
By breaking out of the attribute context using quotes and injecting event handlers like `onfocus`, `onmouseover`, or similar attribute-based payloads.

---

## **5. Why is input sanitization alone not enough to prevent XSS?**

**Answer:**  
Because different contexts require different encoding. Sanitizing input once does not guarantee safety in HTML, JavaScript, URL, and attribute contexts.

---

## **6. What are XSS sources and sinks? Give examples.**

**Answer:**

- **Sources:** User-controlled data like URL parameters, cookies, or localStorage.
    
- **Sinks:** Dangerous functions like `innerHTML`, `document.write`, `eval`.
    

---

## **7. If `<script>` tags are blocked, how can XSS still be exploited?**

**Answer:**  
By using alternative vectors such as event handlers, SVG tags, JavaScript URLs, or HTML injection that triggers script execution.

---

## **8. Why is `alert(1)` not sufficient proof of XSS impact?**

**Answer:**  
Because real attacks aim for data theft, session hijacking, phishing, or account takeover, not alerts. Professional reports focus on real-world impact.

---

## **9. What is Content Security Policy (CSP)?**

**Answer:**  
CSP is a browser security mechanism that restricts which resources (scripts, images, styles) a page is allowed to load and execute.

---

## **10. Why does CSP not completely prevent XSS?**

**Answer:**  
Because CSP does not fix insecure code. It only limits what can execute and can be bypassed or misconfigured.

---

## **11. Difference between CSP nonce and hash?**

**Answer:**

- **Nonce:** Random value generated per request to allow specific scripts.
    
- **Hash:** Allows scripts whose content matches a predefined cryptographic hash.
    

---

## **12. Will inline JavaScript execute with `script-src 'self'`? Why?**

**Answer:**  
No. Inline scripts are blocked unless `'unsafe-inline'`, a nonce, or a hash is explicitly allowed.

---

## **13. Is stored XSS valid if CSP blocks execution?**

**Answer:**  
Yes. The vulnerability still exists in the code and can become exploitable if CSP is bypassed, weakened, or removed.

---

## **14. How can attackers bypass weak CSP implementations?**

**Answer:**  
By abusing trusted domains, JSONP endpoints, unsafe directives like `'unsafe-inline'`, or allowed resource types such as images or styles.

---

## **15. How do you respond if a developer says “CSP makes XSS irrelevant”?**

**Answer:**  
CSP is a mitigation, not a fix. The root cause must still be resolved because CSP can fail, change, or be bypassed, leaving users at risk.
