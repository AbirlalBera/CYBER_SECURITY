Linux Filesystem Hierarchy Standard (FHS)

Instead of drive letters like

C:\

,

D:\

in Windows, Linux uses a single tree structure starting from the

/

(root) directory. This structure is standardized by the **Filesystem Hierarchy Standard (FHS)**.

|Directory|Description|Content Example|
|---|---|---|
|/<br><br> (Root)|The starting point of the file system.|Entire system.|
|/bin|Contains basic user commands. (Binary)|ls<br><br>, <br><br>cp<br><br>, <br><br>cat<br><br>, <br><br>bash|
|/boot|Contains files needed for the system to boot.|vmlinuz<br><br> (Kernel), <br><br>initrd<br><br>, GRUB|
|/dev|Contains hardware device files. (Devices)|/dev/sda<br><br> (Disk), <br><br>/dev/tty<br><br> (Terminal)|
|/etc|The center where system configuration files are located.|/etc/passwd<br><br>, <br><br>/etc/ssh/sshd_config|
|/home|The place where users' personal files are stored.|/home/john<br><br>, <br><br>/home/ali|
|/lib|Library files needed by programs.|libc.so<br><br>, Kernel modules|
|/mnt<br><br> & <br><br>/media|Temporarily mounted disks and USB drives.|/media/usb-disk|
|/opt|Manually installed 3rd party applications.|Google Chrome, TeamViewer etc.|
|/proc|Virtual file system. Holds system info.|/proc/cpuinfo<br><br>, <br><br>/proc/meminfo|
|/root|The home directory of the system administrator (root).|Root's private files.|
|/sbin|Critical commands used only by the administrator.|iptables<br><br>, <br><br>fdisk<br><br>, <br><br>reboot|
|/tmp|For temporary files.|Application caches.|
|/usr|Secondary hierarchy. User tools are here.|/usr/bin/python<br><br>, <br><br>/usr/share|
|/var|Files whose size constantly changes.|Logs (<br><br>/var/log<br><br>), Website (<br><br>/var/www<br><br>)|