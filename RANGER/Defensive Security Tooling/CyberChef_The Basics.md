CyberChef is a simple, intuitive web-based application designed to help with various “cyber” operation tasks within your web browser. Think of it as a **Swiss Army knife** for data - like having a toolbox of different tools designed to do a specific task. These tasks range from simple encodings like **XOR** or **Base64** to complex operations like **AES encryption** or **RSA decryption**. CyberChef operates on **recipes**, a series of operations executed in order.

LINK : https://gchq.github.io/CyberChef/

---
# Navigating the Interface

CyberChef consists of four areas. Each consists of different components or features.

These are the following areas:

1.Operations
2.Recipe
3.Input
4.Output

![CyberChef's main page with all the features.](https://tryhackme-images.s3.amazonaws.com/user-uploads/6645aa8c024f7893371eb7ac/room-content/6645aa8c024f7893371eb7ac-1728731934241.png)  

Let's discuss each of these areas below.

## The Operations Area

This is a practical and comprehensive repository of all the diverse operations that CyberChef is equipped to perform. These operations are meticulously categorized, offering users convenient access to various capabilities. Users can utilize the search feature to locate specific operations quickly, enhancing their efficiency and productivity.

Below are some operations you might use throughout your cyber security journey:

**2.==`URL Encode :`==** Encodes problematic characters into percent-encoding, a format supported by URIs/URLs.  
Ex : `https://tryhackme.com/r/room/cyberchefbasics` becomes `https%3A%2F%2Ftryhackme%2Ecom%2Fr%2Froom%2Fcyberchefbasics` when used with the parameter “Encode all special chars”


**3.==`To Base64 :`==** This operation encodes raw data into an ASCII Base64 string.  
Ex : `This is fun!` becomes `VGhpcyBpcyBmdW4h`


**4.==`To Hex :`==** Converts the input string to hexadecimal bytes separated by the specified delimiter.  
Ex : `This Hex conversion is awesome!` becomes `54 68 69 73 20 48 65 78 20 63 6f 6e 76 65 72 73 69 6f 6e 20 69 73 20 61 77 65 73 6f 6d 65 21`


**5.==`To Decimal :`==** Converts the input data to an ordinal integer array.  
Ex : `This Decimal conversion is awesome!` becomes `84 104 105 115 32 68 101 99 105 109 97 108 32 99 111 110 118 101 114 115 105 111 110 32 105 115 32 97 119 101 115 111 109 101 33`


**6.==`ROT13 :`==** A simple Caesar substitution cipher which rotates alphabet characters by the specified amount (default 13).  
Ex : `Digital Forensics and Incident Response` becomes `Qvtvgny Sberafvpf naq Vapvqrag Erfcbafr`

Alternatively, you can directly check how the operations work by hovering on the specific operation. This should give you a sample or a description and a link to Wikipedia.

![Hovering to an operation in CyberChef tool.](https://tryhackme-images.s3.amazonaws.com/user-uploads/6645aa8c024f7893371eb7ac/room-content/6645aa8c024f7893371eb7ac-1729081368672.png)  

## The Recipe Area

This is considered as the heart of the tool. In this area, you can seamlessly select, arrange, and fine-tune operations to suit your needs. This is where you take control, defining each operation's arguments and options precisely and purposefully. The recipe area is a designated space to select and arrange specific operations and then define their respective arguments and options to customize their behaviour further. In the recipe area, you can drag the operations you want to use and specify arguments and options.

Features include the following:
- `Save recipe`: This feature allows the user to save selected operations.
- `Load recipe`: Allows the user to load previously saved recipes.
- `Clear Recipe`: This feature will enable users to clear the chosen recipe during usage.

These can be found in the highlighted icons below:
![The Recipe area of CyberChef tool with multiple options.](https://tryhackme-images.s3.amazonaws.com/user-uploads/6645aa8c024f7893371eb7ac/room-content/6645aa8c024f7893371eb7ac-1728731934220.png)

The bottom part of the image above is the `BAKE!` button. This processes the data with the given recipe.

Additionally, you can tick the `Auto Bake` checkbox. This feature allows users to automatically cook using the selected recipe without manually clicking `BAKE!` every time.

## Input Area

The input area provides a user-friendly space where you can easily input text or files by pasting, typing, or dragging them to perform operations.
![The Input area of CyberChef tool with multiple options.](https://tryhackme-images.s3.amazonaws.com/user-uploads/6645aa8c024f7893371eb7ac/room-content/6645aa8c024f7893371eb7ac-1729081714973.png)  

Additionally, it has the following features:

- `Add a new input tab`: This is where an additional tab is created for the user to use different values from the previous tab.
![Open a new input tab option under the Input Area.](https://tryhackme-images.s3.amazonaws.com/user-uploads/6645aa8c024f7893371eb7ac/room-content/6645aa8c024f7893371eb7ac-1728731934218.png)


- `Open folder as input`: This feature allows users to upload a whole folder as input value.
![Open folder as input option under the Input Area.](https://tryhackme-images.s3.amazonaws.com/user-uploads/6645aa8c024f7893371eb7ac/room-content/6645aa8c024f7893371eb7ac-1728731934186.png)  


- `Open file as input`: This feature allows the user to upload a file as its input value.
![Open file as input option under the Input Area.](https://tryhackme-images.s3.amazonaws.com/user-uploads/6645aa8c024f7893371eb7ac/room-content/6645aa8c024f7893371eb7ac-1728731934210.png)  

- `Clear input and output`: This feature allows the user to clear any input values inserted and the corresponding output value.
- `Reset pane layout`: This feature brings the tool's interface to its default window sizes.

## Output Area

The output area is a visual space that showcases the data processing results. It neatly presents the outcomes of any manipulations or transformations you have applied to the input data, allowing for a clear and intuitive display of the processed information.

![The Output area of CyberChef tool with multiple options.](https://tryhackme-images.s3.amazonaws.com/user-uploads/6645aa8c024f7893371eb7ac/room-content/6645aa8c024f7893371eb7ac-1729081715061.png)  

Features include:
- `Save output to file`: This feature allows the users to save the result into a .dat file.
- `Copy raw output to the clipboard`: This feature allows users to copy raw output directly to their clipboard, allowing them to quickly copy the results for use in other applications or documents.
- `Replace input with output`: This feature allows users to quickly overwrite the input data based on the operations' results.
- `Maximise output pane`: This feature brings the tool's interface to its default window sizes.

---
# Before Anything Else

# 1️⃣ Extractors Category

These operations extract specific data from large inputs.

==`Extract IP addresses :`==  Extracts all valid IPv4 and IPv6 addresses from the input.


==`Extract URLs :`==  Extracts Uniform Resource Locators (URLs) from input.  
⚠ Protocol (HTTP, HTTPS, FTP, etc.) must be present to reduce false positives.


==`Extract email addresses :`==  Extracts email addresses in the format: `anything@domain.com`  
**Examples:** hotmail.com, google.com, tryhackme.com, yahoo.com


# 2️⃣ Date / Time Category

==`From UNIX Timestamp :`==  Converts a UNIX timestamp into a readable date-time format.

==`To UNIX Timestamp :`==  Converts a date-time string (UTC) into a UNIX timestamp.

### 📌 UNIX Timestamp
- 32-bit value
- Counts seconds since **January 1, 1970 (UTC)**
- Example: `Fri Sep 6 20:30:22 +04 2024` → `1725654622`


# 3️⃣ Data Format Category

These operations encode/decode structured data.

==`From Base64 :`== Decodes Base64 string into raw format. 
**Ex:**  `V2VsY29tZSB0byB0cnloYWNrbWUh` → `Welcome to tryhackme!`


==`URL Decode :`==  Converts percent-encoded characters back to original form.  
**Ex:** `https%3A%2F%2Fgchq%2Egithub%2Eio%2FCyberChef%2F`  → `https://gchq.github.io/CyberChef/`


==`From Base85 :`== Decodes Base85 encoded ASCII string.  
**Ex:**  `BOu!rD]j7BEbo7` → `hello world`


==`From Base58 :`== Decodes Base58 encoded string (removes confusing characters like l, I, 0, O).  
**Ex:**  `AXLU7qR` → `Thm58`


==`To Base62 :`== Encodes data using Base62 character set.  
**Ex:**  `Thm62` → `6NiRkOY`


# 📌 Base Encodings (Important Concept)

Base encodings convert **binary data (0s and 1s)** into readable ASCII characters.

Common Types:
- Base64
- Base85
- Base58
- Base62

# 🔢 Manual Base64 Encoding Example (“THM”)

### Step 1: Convert to Binary

T → 01010100  
H → 01001000  
M → 01001101

Combined (24 bits):  `010101000100100001001101`

### Step 2: Split into 6-bit Groups

`010101 000100 100001 001101`

Convert to Decimal:

|Binary|Decimal|
|---|---|
|010101|21|
|000100|4|
|100001|33|
|001101|13|

### Step 3: Convert to Base64 Index

Using Base64 index table:

|Index|Character|
|---|---|
|21|V|
|4|E|
|33|h|
|13|N|

Final Base64 Output:  `VEhN`

# 🌐 URL Encoding (Common UTF-8 Examples)

|Character|Encoded|
|---|---|
|:|%3A|
|/|%2F|
|.|%2E|
|=|%3D|
|#|%23|

Default encoding standard: **UTF-8**


