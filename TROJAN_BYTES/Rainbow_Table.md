### What are Rainbow Tables?

Rainbow tables are precomputed tables used to reverse cryptographic hash functions, primarily for password cracking. They represent a time-memory trade-off attack that can crack password hashes much faster than brute-force methods.

**How they work:**

- Precompute and store chains of hash-reduction pairs
    
- Significantly reduce storage compared to full lookup tables
    
- Allow reversing hashes by reconstructing the chain
    
- Effective against unsalted password hashes