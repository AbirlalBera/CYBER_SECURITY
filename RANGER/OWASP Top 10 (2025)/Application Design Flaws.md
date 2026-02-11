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
Software Supply Chain Failures

What It Is
Software supply chain failures happen when applications rely on components, libraries, services, or models that are compromised, outdated, or improperly verified. These weaknesses are not inherent in your code, but rather in the software and tools you depend on. Attackers exploit these weak links to inject malicious code, bypass security, or steal sensitive data.

Why It Matters
Modern applications are built from many third-party packages, APIs, and AI models. One compromised dependency can compromise your entire system, allowing attackers to gain access without ever touching your own code. Supply chain attacks can be automated and distributed, making them hard to detect and very damaging.

Example
In 2021, the SolarWinds Orion compromise showed the danger of supply chain attacks. Attackers inserted malicious code into a trusted update, affecting thousands of organisations that automatically installed it. This wasn’t a bug in SolarWinds’ core logic. It was a flaw in the software update building, verification, and distribution process.

With AI, we can observe this when using unverified third-party models or fine-tuned datasets that can embed hidden behaviours, backdoors, or biased outputs, compromising systems or leaking data.

Common Patterns

    Using unverified or unmaintained libraries and dependencies
    Automatically installing updates without verification
    Over-reliance on third-party AI models without monitoring or auditing
    Insecure build pipelines or CI/CD processes that allow tampering
    Poor license or provenance tracking for components
    Lack of monitoring for vulnerabilities in dependencies after deployment

How To Protect The Supply Chain

    Verify all third-party components, libraries, and AI models before use
    Monitor and patch dependencies regularly
    Sign, verify, and audit software updates and packages
    Lock down CI/CD pipelines and build processes to prevent tampering
    Track provenance and licensing for all dependencies
    Implement runtime monitoring for unusual behaviour from dependencies or AI components
    Integrate supply chain threat modelling into the SDLC, including testing, deployment, and update workflows
