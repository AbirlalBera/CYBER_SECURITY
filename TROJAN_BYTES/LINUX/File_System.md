Linux Filesystem Hierarchy Standard (FHS) Instead of drive letters like C:\, D:\ in Windows, Linux uses a single tree structure starting from the / (root) directory. This structure is standardized by the **Filesystem Hierarchy Standard (FHS)**.

|**Directory**|**Description**|**Content Examples**|
|---|---|---|
|**`/`**|**Root**: The starting point of the entire file system.|Every file and directory starts here.|
|**`/bin`**|**Essential Binaries**: Basic commands needed for all users.|`ls`, `cp`, `cat`, `bash`, `mkdir`|
|**`/boot`**|**Boot Loader**: Files required to start the operating system.|Kernel (`vmlinuz`), GRUB config, `initrd`|
|**`/dev`**|**Device Files**: Interfaces for hardware components.|`/dev/sda` (Disk), `/dev/tty` (Terminal)|
|**`/etc`**|**Editable Text Configuration**: System-wide config files.|`/etc/passwd`, `/etc/ssh/sshd_config`|
|**`/home`**|**User Home**: Personal storage for regular users.|`/home/john`, `/home/ali`|
|**`/lib`**|**Libraries**: Shared code used by binaries in `/bin` and `/sbin`.|`libc.so`, Kernel modules|
|**`/media`**|**Removable Media**: Mount points for USBs and CDs.|`/media/usb-drive`, `/media/cdrom`|
|**`/mnt`**|**Mount**: Temporary mount points for filesystems.|Manually mounted network drives.|
|**`/opt`**|**Optional**: Large, third-party software packages.|Google Chrome, TeamViewer, Zoom.|
|**`/proc`**|**Process Information**: A virtual filesystem for system info.|`/proc/cpuinfo`, `/proc/meminfo`|
|**`/root`**|**Root Home**: The home directory for the "Superuser."|Root’s private files (not in `/home`).|
|**`/sbin`**|**System Binaries**: Tools for system administration.|`iptables`, `fdisk`, `reboot`, `shutdown`|
|**`/tmp`**|**Temporary**: Files that are usually deleted on reboot.|Application caches, socket files.|
|**`/usr`**|**User Utilities**: The largest share of user software.|`/usr/bin/python`, `/usr/share/man`|
|**`/var`**|**Variable**: Data that grows or changes frequently.|`/var/log` (Logs), `/var/www` (Web files)|
### Linux Architecture

The Linux operating system offers a layered structure between the hardware and the user. Understanding this structure is critical for troubleshooting and system management.

![](https://storage.hackviser.com/file/hackviser-prod/trainings/sections/images/68a4d2f6-4913-4850-b2cd-ec08a7918b4c/linux-layers-a4d3a0334.webp)

1. **Hardware Layer:** Physical components like CPU, RAM, Disk, Network Card.
    
2. **Kernel Layer:** The brain of the operating system.
    
    - **Kernel Space:** Secure memory area accessible only by the kernel, talking directly to hardware. Drivers run here.
    - **User Space:** Restricted area where user applications run. They ask permission from the kernel to access hardware (System Call).
3. **System Libraries:** Translators that convert complex kernel functions into simple commands that applications can understand (e.g., glibc).
    
4. **Shell Layer:** Interface that takes commands from the user and forwards them to the kernel (Bash, Zsh).
    
5. **Application Layer:** Programs that the user runs, such as browsers, text editors, database servers.