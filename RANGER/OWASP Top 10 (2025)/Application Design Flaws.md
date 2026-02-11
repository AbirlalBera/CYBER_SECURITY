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
