# 1. Strict-Transport-Security (HSTS)

### **Definition** :
Forces the browser to use HTTPS only for your website.

```
Strict-Transport-Security: max-age=31536000; includeSubDomains; preload
```

### **Purpose :**

**Prevents:**
SSL stripping attacks
Downgrade attacks (HTTPS → HTTP)

### **Key Directives**

`max-age` → Time in seconds browser remembers HTTPS rule
`includeSubDomains` → Applies to subdomains
`preload` → Allows inclusion in browser preload list

---
# 2. Content-Security-Policy (CSP)

### **Definition**
Controls which resources (scripts, styles, images, etc.) the browser is allowed to load.

```
Content-Security-Policy: default-src 'self';
```

### **Purpose**

**Prevents:**
- Cross-Site Scripting (XSS)
- Code injection
- Clickjacking (via frame-ancestors)
- Data exfiltration
### **Important Directives**

- `default-src`
- `script-src`
- `style-src`
- `img-src`
- `frame-ancestors`
- `object-src`

---
# 3. X-Frame-Options

### **Definition**

Prevents your website from being embedded inside an iframe.

```
X-Frame-Options: DENY
```

### **Purpose**

**Prevents:**
- Clickjacking attacks

### **Values**
- `DENY`
- `SAMEORIGIN`

⚠️ Modern alternative: `Content-Security-Policy: frame-ancestors`

---

# 4. X-Content-Type-Options

### **Definition**

Prevents browsers from guessing (sniffing) file types.

```
X-Content-Type-Options: nosniff
```

### **Purpose**

**Stops:**

- MIME-type confusion attacks
- Malicious script execution

---

# 5. X-XSS-Protection (Deprecated)

### **Definition**
Old browser-based XSS filter control.

```
X-XSS-Protection: 1; mode=block
```

### **Status**

❌ Deprecated in modern browsers  
Not recommended anymore.

---

# 6. Referrer-Policy

### **Definition**

Controls how much referrer information is sent with requests.

```
Referrer-Policy: strict-origin-when-cross-origin
```

### **Purpose**

**Protects:**
- Sensitive URL data
- User privacy

### **Common Values**

- `no-referrer`
- `same-origin`
- `strict-origin`
- `strict-origin-when-cross-origin` (recommended)

---

# 7. Permissions-Policy (formerly Feature-Policy)

### **Definition**

Controls which browser features can be used.

```
Permissions-Policy: camera=(), microphone=(), geolocation=()
```

### **Purpose**

**Disables:**

- Camera access
- Microphone access
- Location tracking
- Fullscreen
- USB, etc.

---

# 8. Cross-Origin-Opener-Policy (COOP)

### **Definition**

Controls how your page interacts with cross-origin windows.

```
Cross-Origin-Opener-Policy: same-origin
```

### **Purpose**

**Prevents:**

- Cross-origin attacks
- Data leaks between windows

---

# 9. Cross-Origin-Resource-Policy (CORP)

### **Definition**

Restricts who can load your resources cross-origin.

```
Cross-Origin-Resource-Policy: same-origin
```

### **Purpose**

**Prevents:**
- Unauthorized resource sharing

---

# 10. Cross-Origin-Embedder-Policy (COEP)

### **Definition**

Controls which cross-origin resources can be embedded.

```
Cross-Origin-Embedder-Policy: require-corp
```

### **Purpose**

Required for:

- Cross-origin isolation
- SharedArrayBuffer usage

---

# 11. Cookie Security Flags (Set-Cookie Attributes)

### **Definition**

Security attributes applied to cookies.

```
Set-Cookie: sessionId=abc123; Secure; HttpOnly; SameSite=Strict;
```

### **Flags**

- `Secure` → HTTPS only
- `HttpOnly` → Not accessible via JavaScript
- `SameSite=Strict/Lax/None` → CSRF protection

---

# 12. CORS Headers

### **Definition**

Control cross-origin requests for APIs.

```
Access-Control-Allow-Origin: https://example.com
```

### **Common Headers**

- `Access-Control-Allow-Origin`
- `Access-Control-Allow-Methods`
- `Access-Control-Allow-Headers`
- `Access-Control-Allow-Credentials`

### **Purpose**

**Controls:**
- API access from other domains

---

# 13. Cache-Control

### **Definition**

Controls caching behavior of responses.

```
Cache-Control: no-store
```

### **Purpose**

**Prevents:**
- Caching of sensitive pages
- Data exposure in shared systems

---

# 14. Expect-CT (Obsolete)

### **Definition**

Enforced Certificate Transparency compliance.

```
Expect-CT: max-age=86400, enforce
```

### **Status**

Mostly obsolete in modern browsers.

---

# Modern Recommended Security Header Set (2026)

For most secure production websites :

```
Strict-Transport-Security: max-age=31536000; includeSubDomains; preload  
Content-Security-Policy: default-src 'self';  
X-Content-Type-Options: nosniff  
Referrer-Policy: strict-origin-when-cross-origin  
Permissions-Policy: camera=(), microphone=(), geolocation=()  
Cross-Origin-Opener-Policy: same-origin  
Cross-Origin-Resource-Policy: same-origin  
Cross-Origin-Embedder-Policy: require-corp
```

Plus secure cookies :

```
Secure; HttpOnly; SameSite=Strict
```

