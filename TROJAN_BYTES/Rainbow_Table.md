### What are Rainbow Tables?

Rainbow tables are precomputed tables used to reverse cryptographic hash functions, primarily for password cracking. They represent a time-memory trade-off attack that can crack password hashes much faster than brute-force methods.

### How it work :

1.Instead of hashing passwords one by one during cracking, rainbow tables contain millions or billions of pre-hashed values.

2.An attacker compares a stolen hash (e.g., NTLM hash from SAM) to the hashes in the table.

3.If a match is found → the attacker instantly retrieves the password.

### How modern systems resist them ------

Modern OSes use salted hashes (unique random values per password) . Salt makes pre-computed tables useless.

------------
## Tools used for Rainbow Table attacks

**Ophcrack -** Includes rainbow tables for LM and NTLM hashes

**RainbowCrack -** General-purpose rainbow table implementation

**Cain and Abel -** Includes rainbow table functionality

**rcrack -** Command-line rainbow table cracker

