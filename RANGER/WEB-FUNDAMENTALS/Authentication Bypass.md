
FFUF

If we try entering the username **admin** and fill in the other form fields with fake information, you'll see we get the error **An account with this username already exists**. We can use the existence of this error message to produce a list of valid usernames already signed up on the system by using the ffuf tool below. The ffuf tool uses a list of commonly used usernames to check against for any matches.

```

ffuf -w /usr/share/wordlists/SecLists/Usernames/Names/names.txt -X POST -d "username=FUZZ&email=x&password=x&cpassword=x" -H "Content-Type: application/x-www-form-urlencoded" -u http://10.48.142.162/customers/signup -mr "username already exists"

```

This ffuf command is used to **check which usernames already exist** on a signup page.

- **`-w`**: Points to a wordlist containing usernames to test
- **`FUZZ`**: Placeholder where each username from the wordlist is inserted
- **`-X POST`**: Sends a POST request (instead of the default GET)
- **`-d`**: Sends form data (username, email, password, cpassword)
- **`-H`**: Adds headers, here specifying form data content type
- **`-u`**: Target URL for the request
- **`-mr`**: Looks for the response text _"username already exists"_ to confirm a valid username

