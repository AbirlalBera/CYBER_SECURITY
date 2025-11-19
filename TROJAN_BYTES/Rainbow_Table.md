### What are Rainbow Tables?

Rainbow tables are precomputed tables used to reverse cryptographic hash functions, primarily for password cracking. They represent a time-memory trade-off attack that can crack password hashes much faster than brute-force methods.

### How it work :

1.Instead of hashing passwords one by one during cracking, rainbow tables contain millions or billions of pre-hashed values.

2.An attacker compares a stolen hash (e.g., NTLM hash from SAM) to the hashes in the table.

If a match is found → the attacker instantly retrieves the password.