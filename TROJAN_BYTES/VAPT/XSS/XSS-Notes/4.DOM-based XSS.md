## DOM-based XSS

**DOM-based XSS** is a type of attack that occurs when a web page’s **client-side scripts (JavaScript)** manipulate the **Document Object Model (DOM)** in an unsafe way.

Unlike other XSS types, malicious scripts are **not directly embedded in the HTML sent by the server**. Instead, they are executed through **client-side interactions** that modify the DOM. The triggering and execution method is similar to **Reflected** and **Stored XSS**, with the key difference being that the vulnerability exists entirely in the **client-side JavaScript**.

These attacks occur when client-side JavaScript processes data from **untrusted sources** and interprets it in a way that allows **code execution**. This typically involves dangerous functions or properties such as:

- `eval()`
    
- `innerHTML`
    

---

## Dangerous JavaScript Functions

### `eval()`

The `eval()` function evaluates a string as JavaScript code and executes it.

`var userInput = 'console.log(1)'; eval(userInput); // output: 1`

In this example, the user input `console.log(1)` is evaluated by `eval()`, resulting in the number `1` being logged to the console.

---

### `innerHTML`

The `innerHTML` property is used to get or set the HTML content of an element, allowing dynamic modification of the page.

`document.getElementById('example').innerHTML = 'Hello, World!';`

This code updates the content of the element with the ID `example` to **Hello, World!**.

---

## Document Object Model (DOM)

The **Document Object Model (DOM)** is a programming interface that represents the structure, style, and content of a web document in a way that can be accessed and modified.

The DOM is structured as a **tree**, where each part of the document is represented as a node.

---

### DOM Structure

- **Nodes**  
    Every element, text, comment, and object in the document is a node.  
    Examples: `<div>`, `<p>`, `<span>`
    
- **Attributes**  
    Attributes such as `class`, `id`, and `style` store additional information about elements.
    
- **Text Nodes**  
    The text inside HTML elements is stored as text nodes.
    

---

### DOM and JavaScript

JavaScript uses DOM APIs to dynamically change the structure, style, and content of a web page. This allows updates without reloading the page.

JavaScript with DOM manipulation can:

- **Add / Remove Elements**
    
- **Modify Attributes**
    
- **Handle Events** (clicks, mouse movements, etc.)
    

---

### Importance of the DOM

The DOM enables real-time interaction and dynamic updates in modern web applications. It is central to making web applications interactive and responsive.

---

## DOM-based XSS Attack Examples

DOM-based XSS vulnerabilities occur **after the page loads**, during client-side JavaScript execution.

---

### 1. Injecting Script from URL Fragment

**Source Code:**

`document.getElementById('output').innerHTML = window.location.hash.substring(1);`

**Payload:**

`https://example.com#<script>alert(1)</script>`

The fragment (`#<script>alert(1)</script>`) is assigned directly to `innerHTML`, causing script execution.

---

### 2. Using `eval()` to Execute XSS

**Source Code:**

`window.onload = function () {     const productId = new URLSearchParams(window.location.search).get('id');     eval('getProduct(' + productId.toString() + ')'); };`

**Payload:**

`https://example.com/products?id=');alert(1)//`

This payload breaks out of the function call and injects `alert(1)`.

---

### 3. XSS Using `innerHTML`

**Source Code:**

`document.getElementById('content').innerHTML =     unescape(location.search.substring(1));`

**Payload:**

`https://example.com?%3Cscript%3Ealert(1)%3C/script%3E`

User input is decoded and directly rendered using `innerHTML`, leading to script execution.

---

### 4. Using `onerror` Event for XSS

**Source Code:**

`<img src="" id="image"> <script>   document.getElementById('image').src = location.hash.substring(1); </script>`

**Payload:**

`https://example.com#invalid-image" onerror="alert(1)`

Manipulating the `src` attribute triggers the `onerror` event, executing JavaScript.

---

## Implementing a DOM-based XSS Attack

### Application Examination

An application calculates the area of a triangle using **height** and **base** values.

**Normal Request:**

`https://example.com/?height=5&base=12`

**Generated JavaScript:**

`var height = 5; var base = 12; var ans = base * height / 2; document.getElementById("answer").innerHTML = "<b>Area:</b> " + ans;`

---

### Detecting the Vulnerability

**Malicious Payload:**

`https://example.com/?height=5;alert(1)&base=12`

**Injected JavaScript:**

`var height = 5; alert(1); var base = 12; var ans = base * height / 2; document.getElementById("answer").innerHTML = "<b>Area:</b> " + ans;`

The attacker closes the variable assignment and injects JavaScript.

---

## Source Code Analysis

### Vulnerable PHP Code

`<?php if (isset($_GET['base']) && isset($_GET['height'])) {     echo '<div class="alert alert-success" id="answer"></div>';     echo '<script>';     echo 'var height = ' . $_GET['height'] . ';';     echo 'var base = ' . $_GET['base'] . ';';     echo 'var ans = base * height / 2;';     echo 'document.getElementById("answer").innerHTML = "<b>Area:</b> " + ans;';     echo '</script>'; } ?>`

User input is directly embedded into JavaScript, making it exploitable.

---

### Secure PHP Code Example

`<?php if (isset($_GET['base']) && isset($_GET['height'])) {     $base = htmlspecialchars($_GET['base'], ENT_QUOTES, 'UTF-8');     $height = htmlspecialchars($_GET['height'], ENT_QUOTES, 'UTF-8');      echo '<div class="alert alert-success" id="answer"></div>';     echo '<script>';     echo 'var height = ' . $height . ';';     echo 'var base = ' . $base . ';';     echo 'var ans = base * height / 2;';     echo 'document.getElementById("answer").innerHTML = "<b>Area:</b> " + ans;';     echo '</script>'; } ?>`

### Why This Is Safer

- `htmlspecialchars()` converts dangerous characters like:
    
    - `<`, `>`, `&`, `"`, `'`
        
- Prevents injected JavaScript from being executed
    
- Ensures user input is treated as **data**, not **code**