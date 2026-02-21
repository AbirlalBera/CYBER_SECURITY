This room focuses on **four OWASP Top 10 (2025) categories** related to **failures in system architecture and application design**. These vulnerabilities arise from insecure design decisions, weak cryptography, misconfigurations, and risks in the software supply chain.

Theoretical concepts are reinforced through **practical challenges**, allowing learners to apply the concepts in real-world scenarios.
## Covered OWASP Top 10 Categories

### AS02: Security Misconfigurations
Occurs when systems, applications, or services are improperly configured, exposing unnecessary functionality or sensitive information.

### AS03: Software Supply Chain Failures
Involves risks introduced through third-party libraries, dependencies, or compromised development and deployment pipelines.


### AS04: Cryptographic Failures
Happens when weak, broken, or incorrectly implemented cryptographic mechanisms are used to protect sensitive data.

### AS06: Insecure Design
Results from missing or ineffective security controls due to poor design decisions, even if the implementation is technically correct.

---
## Security Misconfigurations

### What It Is

Security misconfigurations occur when systems, servers, applications, or cloud services are deployed with unsafe default settings, incomplete configurations, or exposed services. These issues are not caused by coding flaws but by mistakes in how environments, software, or networks are configured. Such misconfigurations often create easy entry points for attackers.

### Why It Matters

Even minor configuration mistakes can expose sensitive data, allow privilege escalation, or give attackers an initial foothold. Modern applications rely on complex architectures involving cloud services, APIs, containers, and third-party components. A single exposed admin interface, publicly accessible storage bucket, or overly permissive access control can compromise the entire system.

### Example

In 2017, Uber suffered a major data breach when a backup AWS S3 bucket containing sensitive driver and rider information was left publicly accessible. Attackers were able to download the data without authentication, demonstrating how a simple deployment misconfiguration can lead to severe consequences.

### Common Patterns

Security misconfigurations commonly include:

- Default credentials or weak passwords left unchanged
- Unnecessary services or endpoints exposed to the internet
- Misconfigured cloud storage or permissions (AWS S3, Azure Blob, GCP buckets)
- Missing or unrestricted authentication and authorization for APIs
- Verbose error messages revealing stack traces or system details
- Outdated software, frameworks, or containers with known vulnerabilities
- Exposed AI or machine learning endpoints without proper access controls

### How to Prevent It

To reduce the risk of security misconfigurations:

- Harden default configurations and disable unused features or services
- Enforce strong authentication and least-privilege access
- Limit network exposure and segment sensitive resources
- Keep systems, frameworks, and containers updated with security patches
- Suppress detailed error messages in production environments
- Regularly audit cloud configurations and access permissions
- Secure AI endpoints and automation services with proper controls and monitoring
- Integrate configuration reviews and automated security checks into deployment pipelines

---
## Software Supply Chain Failures

### What It Is

Software supply chain failures occur when applications depend on compromised, outdated, or improperly verified components such as libraries, frameworks, services, or AI models. These weaknesses do not originate from an organization’s own code but from external dependencies. Attackers exploit these weak links to inject malicious code, bypass security controls, or steal sensitive data.

### Why It Matters

Modern applications heavily rely on third-party packages, APIs, and AI models. A single compromised dependency can undermine the entire system without attackers ever interacting with the application’s source code. Supply chain attacks are often automated, widespread, and difficult to detect, making them highly impactful.

### Example

The **SolarWinds Orion breach (2021)** demonstrated the severity of supply chain attacks. Malicious code was inserted into a trusted software update, which was then distributed to thousands of organizations. The issue was not in the application’s core logic but in the **update build, verification, and distribution process**.

In AI systems, similar risks occur when unverified third-party models or datasets introduce hidden backdoors, biased outputs, or data leakage.

### Common Patterns

Common indicators of supply chain failures include:

- Use of unverified or unmaintained libraries and dependencies
- Automatic updates without integrity or authenticity verification
- Heavy reliance on third-party AI models without auditing or monitoring
- Insecure CI/CD pipelines that allow tampering.
- Poor tracking of component provenance or licensing
- Lack of post-deployment vulnerability monitoring for dependencies

### How to Protect the Supply Chain

To reduce supply chain risk:

- Verify all third-party libraries, components, and AI models before use
- Regularly monitor and patch dependencies
- Digitally sign, verify, and audit software updates and packages
- Secure CI/CD pipelines and build environments
- Track provenance and licensing of all dependencies
- Monitor runtime behavior of dependencies and AI components
- Integrate supply chain threat modeling into the SDLC, including testing, deployment, and update stages

---
## Cryptographic Failures

### What It Is

Cryptographic failures occur when encryption is **missing, weak, or incorrectly implemented**. This includes the use of weak or deprecated algorithms, hard-coded secrets, poor key management, or storing/transmitting sensitive data without encryption. These weaknesses allow attackers to access information that should remain confidential.
### Why It Matters

Cryptography is fundamental to web application security. It protects network traffic, stored data, identities, and secrets such as passwords and tokens. When cryptographic controls fail, attackers can expose sensitive information, leading to account compromise or large-scale data breaches.

Attackers may exploit cryptographic failures through man-in-the-middle attacks, brute-forcing weak keys, or discovering secrets that were never properly protected.

### Common Patterns

Typical cryptographic failure patterns include:

- Use of weak or deprecated algorithms (MD5, SHA-1, ECB mode)

- Hard-coded encryption keys or secrets in code or configuration

- Poor key rotation or lifecycle management

- Missing encryption for sensitive data at rest or in transit

- Self-signed, expired, or invalid TLS certificates

- Improper secret handling in AI or ML systems

### How to Prevent It

To avoid cryptographic failures:

- Use modern, strong algorithms such as **AES-GCM**, **ChaCha20-Poly1305**, and enforce **TLS 1.3** with valid certificates

- Store and manage secrets using secure key management services (AWS KMS, Azure Key Vault, HashiCorp Vault)

- Rotate keys and secrets regularly according to defined cryptographic lifetimes

- Establish and enforce key lifecycle management policies

- Maintain an inventory of all certificates, keys, and their ownership

- Ensure AI models and automation systems never expose plaintext secrets or sensitive data

---
## Insecure Design

### What It Is

Insecure design occurs when **flawed logic, architecture, or trust assumptions** are built into a system from the beginning. These flaws usually result from missing threat modeling, lack of security requirements, insufficient design reviews, or incorrect assumptions about how users and systems behave.

With the rise of **AI assistants and automation**, insecure design risks have increased. Developers may assume AI-generated code, decisions, or classifications are correct and safe. When AI systems are given broad authority without guardrails, the insecurity becomes part of the system’s design.

### Example

An early example is **Clubhouse**, whose backend API lacked proper authentication. The system assumed users would interact only through the mobile app. As a result, attackers could directly query backend APIs to access user data, room information, and even private conversations, completely breaking the platform’s privacy model.
### Why It Matters

Insecure design **cannot be fixed with simple patches**. Since the vulnerability exists in the system’s logic and architecture, remediation often requires redesigning workflows, trust boundaries, and decision-making processes.

## Common Insecure Designs (2025)

- Weak business logic controls (approval, recovery, or payment flows)

- Incorrect assumptions about user or AI model behavior

- AI components with excessive authority or unrestricted access

- Missing guardrails for large language models (LLMs) and automation agents

- Debug or test bypasses left enabled in production

- Lack of abuse-case analysis or AI-specific threat modeling

## Insecure Design in the AI Era

AI introduces new architectural risks:

- **Prompt injection**, where user input manipulates system prompts and extracts sensitive data

- Blind trust in AI output without validation or oversight

- Use of poisoned or unverified AI models containing hidden backdoors

- Automation agents acting on AI decisions without human review


These risks make human oversight and validation critical.

## How to Design Securely

### Secure Design Principles

- Build threat modeling into every stage of development

- Define security requirements before implementation

- Apply least privilege across users, APIs, and services

- Enforce strong authentication, authorization, and session management

- Continuously test for logic flaws and abuse paths


### AI-Specific Secure Design Practices

- Treat AI models as untrusted by default

- Validate and filter all model inputs and outputs

- Separate system prompts from user-controlled input

- Keep sensitive data out of prompts unless strictly necessary

- Require human review for high-risk AI-driven actions

- Log model provenance and monitor runtime behavior

- Apply AI-specific threat modeling (prompt injection, inference risks, agent misuse, supply chain threats)