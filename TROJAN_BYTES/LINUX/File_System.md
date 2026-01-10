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
