### What is a Shell and Why Do We Need It?

Computer hardware (CPU, RAM, Disk) is useless on its own. We need a Kernel to manage them. However, the kernel is also a complex structure that only understands 0s and 1s. This is where the **Shell** comes in.

**The Shell's Job:** It translates the "near-human language" commands you type (e.g. , ls- list) into "machine language" that the kernel can understand. After the kernel performs the operation, the shell takes the result and prints it back to the screen in a way you can understand. In a way, it acts as a **translator**.

There are two main types of shells in Linux: **Command Line (CLI)** and **Graphical Interface (GUI)**.

### Command Line (CLI)

The command line is a text-based communication method. You open a window called
Terminal and manage the computer by typing commands.

![](https://storage.hackviser.com/file/hackviser-prod/trainings/sections/images/68a4d2f6-4913-4850-b2cd-ec08a7918b4c/terminal-example-2fe48b7c6.webp)

**Why Should I Use Command Line?**

- **Speed:** Copying files, installing programs is much faster with the keyboard.
- **Automation:** You can do hundreds of operations with a single command file (script).
- **Remote Access:** When you connect to servers with SSH, there is no graphical interface, only the command line.

### Graphical Interface (GUI)

It is an interface managed with windows, icons, and mouse, just like in Windows or macOS.

![](https://storage.hackviser.com/file/hackviser-prod/trainings/sections/images/68a4d2f6-4913-4850-b2cd-ec08a7918b4c/gui-example-50294f77d.webp)


---
### Shell Types (Bash, Zsh, Fish)

There is not a single shell in Linux. You can change it according to your needs.

## 1. Bourne Again Shell

Bash (Bourne Again Shell) is the most common and standard shell. Comes by default in most Linux distributions.Before bash, some shells like sh, ksh, and csh had different capabilities. Bash came as an enhanced replacement for these shells, borrowing capabilities from all of them. This means that it has many of the features of these old shells and some of its unique abilities. Some of the key features provided by bash are listed below:

- Bash is a widely used shell with scripting capabilities.
- It offers a tab completion feature, which means if you are in the middle of completing a command, you can press the tab key on your keyboard. It will automatically complete the command based on a possible match or give you multiple suggestions for completing it.
- Bash keeps a history file and logs all of your commands. You can use the up and down arrow keys to use the previous commands without typing them again. You can also type `history` to display all your previous commands



2 . Zsh (Z Shell): Compatible with Bash but offers more advanced auto-completion and theme support (macOS default).

## Friendly Interactive Shell

3 . Fish: User-friendly, colors commands as you type and offers suggestions.Friendly Interactive Shell (Fish) is also not default in most Linux distributions. As its name suggests, it focuses more on user-friendliness than other shells. Some of the key features provided by fish are listed below:

- It offers a very simple syntax, which is feasible for beginner users.
- Unlike bash, it has auto spell correction for the commands you write.
- You can customize the command prompt with some cool themes using fish.
- The syntax highlighting feature of fish colors different parts of a command based on their roles, which can improve the readability of commands. It also helps us to spot errors with their unique colors.
- Fish also provides scripting, tab completion, and command history functionality like the shells mentioned in this task.


**To find out which shell you are using:**

```
user@hackerbox:~$ echo $SHELL
/bin/bash
```

 We can list down the available shells in your Linux OS by typing :
 
```
cat /etc/shells
```

If we want to permanently change your default shell, you can use the command: 

```
chsh -s /usr/bin/zsh
```

Switch between shells :

```
user@tryhackme:~$ zsh 
tryhackme%
```
---
### What is a Terminal?

The terminal application acts as a gateway allowing users to interact with the shell, offering a text-based interface where commands can be entered and their outputs seen.

**Useful Terminal Commands:**

1 . **clear (Clear Screen):** Used to clean the terminal screen when it gets filled with commands.

2 . **history (Past Commands):** Gives a list of commands you ran before. Great for finding a command you forgot.

3 . **type (Command Type):** Shows what a command really is (alias, builtin, file).

### Shell Configuration Files ( .bashrc , .zshrc)

Every time the terminal opens, the shell reads some hidden settings files in your home directory ( /home/user). You can add your own shortcuts to these files.

**If using Bash:**  .bashrc

**If using Zsh:**  .zshrc

**Example Scenario:** We want to clear the screen by typing just c instead of clear every time.

1 . Open the file with nano editor:  nano ~/.bashrc

2 . Add this line to the bottom:  alias c='clear'

3 . Save and exit ( CTRL+O , Enter, CTRL+X).

4 . Load settings: source ~/.bashrc

---
### Environment Variables

Dynamic values that affect how the operating system and programs work.

**Most Important Variables:**

|Variable|Description|
|---|---|
|$HOME|User's home directory.|
|$USER|Current username.|
|$PWD|Present Working Directory.|
|$SHELL|Shell program used.|
|$PATH|List of directories where commands are searched.|

---

## Command Chaining Operators

Command chaining allows you to execute multiple commands in a single line, creating simple "one-liner" logic flows based on success or failure.

| **Operator** | **Name**        | **Logic**                                                                                      |
| ------------ | --------------- | ---------------------------------------------------------------------------------------------- |
| **`;`**      | **Semicolon**   | Runs commands **sequentially**. The second command runs regardless of the first one's outcome. |
| **`&&`**     | **Logical AND** | Runs the second command **only if** the first one succeeds (Exit Code 0).                      |


### 1. Sequential Execution (`;`)

The first command finishes, and then the second one runs immediately, even if the first one results in an error.

```
user@hackerbox:~$ echo "First Command" ; date

First Command
Fri Oct 20 14:30:00 UTC 2026
```

> **Result:** The text is printed, and the date is shown immediately after.

### 2. Continue if Successful (`&&`)

This is commonly used for installing software or compiling code where the second step depends on the first one working.

Bash

```
user@hackerbox:~$ mkdir test_folder && cd test_folder
user@hackerbox:~/test_folder$ pwd
/home/user/test_folder
```

> **Result:** Since `mkdir` successfully created the folder, the `cd` command executed. If the folder already existed, `mkdir` would error, and you would **not** move into the directory.

### 3. Run if Error (`||`)

This acts as an "error handler." It is frequently used to provide custom error messages or fallback actions.

Bash

```
user@hackerbox:~$ cd secret_vault || echo "Access Denied or Directory Missing!"
-bash: cd: secret_vault: No such file or directory
Access Denied or Directory Missing!
```

> **Result:** Because the `cd` command failed, the `echo` command was triggered to notify the user.

---

## Script Start: The Shebang (`#!`)

The **Shebang** is a special character sequence at the very beginning of a script that tells the operating system which interpreter to use to execute the file.

### Common Shebang Examples:

- **Bash Script:** `#!/bin/bash`

- **Python Script:** `#!/usr/bin/python3`

- **Perl Script:** `#!/usr/bin/perl`
### Example Script:

```
#!/bin/bash
echo "Hello World"
echo "Current user: $USER"
```

> **Note:** For a script to run, you must also give it "execute" permissions using the command: `chmod +x script_name.sh`.



