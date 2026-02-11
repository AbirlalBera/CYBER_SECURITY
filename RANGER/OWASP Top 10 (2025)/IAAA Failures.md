

This room focuses on **three OWASP Top 10 (2025) categories** related to weaknesses in **Identity, Authentication, Authorization, and Accountability (IAAA)** within applications. These issues arise when access controls, authentication mechanisms, or logging and monitoring are improperly implemented.

Theoretical concepts are reinforced through **hands-on challenges**, allowing practical application of the learned material.

## Covered OWASP Top 10 Categories

### A01: Broken Access Control

Occurs when users can access resources or perform actions beyond their intended permissions. This can result from missing or improperly enforced authorization checks.

### A07: Authentication Failures

Happens when authentication mechanisms are weak or incorrectly implemented, allowing attackers to impersonate legitimate users.

### A09: Logging & Alerting Failures

Occurs when security events are not properly logged or monitored, preventing timely detection and response to attacks.

---
# What is IAAA?

IAAA is a simple way to think about how users and their actions are verified on applications. Each item plays a crucial role and it isn't possible to skip a level. That means, if a previous item isn't being performed, you cannot perform the later times. The four items are:

- **Identity** - the unique account (e.g., user ID/email) that represents a person or service.
- **Authentication** - proving that identity (passwords, OTP, passkeys).
- **Authorisation** - what that identity is allowed to do.
- **Accountability** - recording and alerting on who did what, when, and from where.

---
# A01: Broken Access Control

