
## 1. Where Am I? (`pwd`)

The **`pwd`** (Print Working Directory) command displays your current location in the filesystem hierarchy.

```
user@hackerbox:~$ pwd
/home/user
```

> **Meaning:** You are currently inside the `/home/user` directory.

### Path Manipulation Utilities

**realpath:** Shows the absolute (full) path of a specific file.

```
Example: 

realpath notes.txt → /home/user/notes.txt
```

**basename:** Strips the directory path and returns only the filename.

```
Example: 

basename /home/user/notes.txt → notes.txt
```

**dirname:** Strips the filename and returns only the directory path.

```
Example: 

dirname /home/user/notes.txt → /home/user
```

---

## 2. Changing Directory (`cd`)

Switch between directories using the **`cd`** command.

|**Command**|**Description**|**Effect / Example**|
|---|---|---|
|**`cd [dir]`**|Enter directory|Moves you into the specified folder.|
|**`cd /path/to/dir`**|Absolute Path|Jumps directly to that exact location.|
|**`cd ..`**|Go Up|Moves to the parent directory (`/home/user` → `/home`).|
|**`cd ~`**|Go Home|Returns to your user home directory (`/home/username`).|
|**`cd -`**|Toggle|Returns to the previous directory you were in.|

## Practical Examples

### Going Up One Directory (`cd ..`)

```
user@hackerbox:/var/www$ cd .. 
user@hackerbox:/var$
```

We went up from the `/var/www` directory to the `/var` directory.
### Returning to Home Directory (`cd ~`)

```
user@hackerbox:/var/log$ cd ~ 
user@hackerbox:~$
```

Wherever you are, it teleports you to your home directory `/home/username`.
### Returning to Previous Directory (`cd -`)

```

user@hackerbox:~$ cd /etc user@hackerbox:/etc$ cd - /home/user user@hackerbox:~$
```

First we went to the `/etc` directory, then by saying `cd -` we returned to where we came from.

---
## 3. Listing Contents (`ls`)

The **`ls`** command lists the contents of a directory. Flags are used to customize the view.

### Frequently Used Parameters

|**Parameter**|**Name**|**Description**|
|---|---|---|
|**`-l`**|Long List|Shows permissions, owner, size, and modification date.|
|**`-a`**|All|Shows hidden files (those starting with a `.`).|
|**`-h`**|Human Readable|Displays sizes in KB, MB, or GB instead of raw bytes.|
|**`-t`**|Time Sort|Sorts files by modification date (newest first).|
|**`-r`**|Reverse|Reverses the sorting order.|
|**`-R`**|Recursive|Lists all subdirectories and their contents.|
|**`-S`**|Size Sort|Sorts files by size (largest first).|

### Detailed Analysis of `ls -l` : **Detailed Listing**

```auto
user@hackerbox:~$ ls -l
total 16
drwxr-xr-x 2 user users 4096 Jul 29 08:24 Desktop
drwxr-xr-x 2 user users 4096 Jul 29 08:24 Documents
drwxr-xr-x 2 user users 4096 Jul 29 08:24 Downloads
drwxr-xr-x 2 user users 4096 Jul 29 08:24 Pictures
drwxr-xr-x 2 user users 4096 Jul 29 08:24 Videos
-rw-r--r-- 1 user users 2100 Aug 01 12:00 notes.txt
-rwxr-xr-x 1 user users  500 Aug 01 11:00 script.sh
```

In the output obtained with the -l parameter, we see columns with the following structure:

|Column content|Description|
|---|---|
|`drwxr-xr-x`|File type and permissions (d: directory, -: file, rwx: permissions)|
|`2`|Number of hard links to the file/directory|
|`user`|The user who owns the file/directory|
|`users`|The group who owns the file/directory|
|`4096`|File size (Bytes)|
|`Jul 29 08:24`|Date of creation or last modification of file/directory|
|`Desktop`|Name of the file/directory|
Here we see that **Desktop** and **Documents** are directories (`d`), others are files (`-`), along with their sizes and dates.

## Example Scenario 2: Seeing Hidden Files (`ls -la`)

```
user@hackerbox:~$ ls -la
total 32
drwxr-xr-x 5 user user 4096 Oct 20 10:00 .
drwxr-xr-x 3 root root 4096 Oct 20 09:00 ..
-rw------- 1 user user  220 Oct 20 09:00 .bash_logout
-rw------- 1 user user 3771 Oct 20 09:00 .bashrc
-rw------- 1 user user  807 Oct 20 09:00 .profile
drwxr-xr-x 2 user user 4096 Oct 20 10:00 Documents
drwxr-xr-x 2 user user 4096 Oct 20 10:00 Downloads
```

Normally hidden configuration files like `.bashrc` appeared. `.` (current directory) and `..` (parent directory) are also listed.

## Example Scenario 3: Sorting by Time (`ls -lt`)

```
user@hackerbox:~$ ls -lt
total 16
-rw-r--r-- 1 user user 2100 Oct 20 12:00 notes.txt
-rwxr-xr-x 1 user user  500 Oct 20 11:00 script.sh
drwxr-xr-x 2 user user 4096 Oct 20 10:00 Documents
drwxr-xr-x 2 user user 4096 Oct 20 10:00 Downloads
```

The most recently modified file (`notes.txt`) appears at the top.

## Example Scenario 4: Listing All Subdirectories (`ls -R`)

```
user@hackerbox:~$ ls -R
.:
Documents  Downloads  notes.txt

./Documents:
Report.pdf  Picture.jpg

./Downloads:
installer.zip
```

Not only listed our current directory, but also dumped the contents of its subdirectories.

## Example Scenario 5: Sorting by Size (`ls -lS`)

```
user@hackerbox:~$ ls -lS
-rw-r--r-- 1 user user 10485760 Oct 20 12:00 large_file.iso
drwxr-xr-x 2 user user     4096 Oct 20 10:00 Documents
-rw-r--r-- 1 user user     2100 Oct 20 12:00 notes.txt
```

The largest file (`large_file.iso`) is at the top.

---

## 4. Directory Stack (`pushd` and `popd`)

Sometimes you need to temporarily check another place while working in a directory and come back.

### Usage

```
user@hackerbox:~/project$ pushd /var/log
/var/log ~/project
user@hackerbox:/var/log$ popd
~/project
user@hackerbox:~/project$
```

With `pushd` we teleported to `/var/log` but threw our old location into memory.  
When we said `popd`, we returned exactly to where we left off (`~/project`).

---

## 5. Tree View (`tree`)

Visualizes the directory structure like a tree branch.

```
user@hackerbox:~$ tree -L 2
.
├── Desktop
├── Documents
│   ├── Work
│   │   └── ProjectA
│   └── Personal
│       └── Photos
└── Downloads
    └── installer.zip
```

Allows us to understand the nested structure of directories at a glance.  
The `-L 2` parameter tells it to only go **2 levels deep**.