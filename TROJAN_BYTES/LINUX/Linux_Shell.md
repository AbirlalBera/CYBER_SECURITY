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

### Shell Types (Bash, Zsh, Fish)

There is not a single shell in Linux. You can change it according to your needs.

```

1. Bash (Bourne Again Shell): The most common and standard shell. Comes by default in most Linux distributions.

2. Zsh (Z Shell): Compatible with Bash but offers more advanced auto-completion and theme support (macOS default).

3. Fish: User-friendly, colors commands as you type and offers suggestions.
```

**To find out which shell you are using:**

```
```auto
user@hackerbox:~$ echo $SHELL
/bin/bash
```
```