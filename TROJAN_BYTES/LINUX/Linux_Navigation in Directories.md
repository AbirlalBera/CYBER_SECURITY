
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

### Detailed Analysis of `ls -l` Output

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

|**Field**|**Description**|
|---|---|
|**`-rw-r--r--`**|**File Type & Permissions**: `-` is a file, `d` is a directory.|
|**`1`**|**Links**: Number of hard links to the file.|
|**`user`**|**Owner**: The user who owns the file.|
|**`users`**|**Group**: The group that has access to the file.|
|**`2100`**|**Size**: File size in bytes (use `-h` for KB/MB).|
|**`Aug 01 12:00`**|**Timestamp**: Last modification date/time.|
|**`notes.txt`**|**Name**: The name of the file or directory.|

---

## 4. Directory Stack (`pushd` & `popd`)

Use these when you need to jump to a directory temporarily and return later without typing the full path again.

- **`pushd /var/log`**: Saves your current location and moves you to `/var/log`.
    
- **`popd`**: Removes the top directory from the stack and "pops" you back to your original location.
    

Bash

```
user@hackerbox:~/project$ pushd /var/log
/var/log ~/project
user@hackerbox:/var/log$ popd
~/project
```

---

## 5. Tree View (`tree`)

The **`tree`** command provides a visual representation of the directory structure.

Bash

```
user@hackerbox:~$ tree -L 2
.
├── Desktop
├── Documents
│   ├── Work
│   └── Personal
└── Downloads
    └── installer.zip
```

> **Tip:** Use `-L [number]` to limit how many levels deep the tree should display.

Would you like to learn how to create and delete these files and directories using `mkdir`, `touch`, and `rm`?