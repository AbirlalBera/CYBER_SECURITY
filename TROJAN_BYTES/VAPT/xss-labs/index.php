<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>XSS Labs - Complete Training Platform</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
:root {
    --bg: #0b0f14;
    --panel: #121826;
    --accent: #00ffc6;
    --text: #e6e6e6;
    --muted: #8b8b8b;
}

* { box-sizing: border-box; font-family: "Segoe UI", system-ui, sans-serif; }

body {
    margin: 0;
    background: radial-gradient(circle at top, #111827, #020617);
    color: var(--text);
    display: flex;
    height: 100vh;
    overflow: hidden;
}

.sidebar {
    width: 260px;
    background: linear-gradient(180deg, #0b1220, #020617);
    border-right: 1px solid #1f2937;
    padding: 20px;
    overflow-y: auto;
}

.sidebar h2 {
    color: var(--accent);
    margin-bottom: 30px;
    font-size: 22px;
}

.lab-link {
    display: block;
    padding: 14px 16px;
    margin-bottom: 12px;
    background: rgba(255,255,255,0.03);
    border-radius: 10px;
    color: var(--text);
    text-decoration: none;
    transition: all 0.3s ease;
    cursor: pointer;
    font-weight: 500;
}

.lab-link:hover {
    background: rgba(0,255,198,0.15);
    transform: translateX(8px);
}

.lab-link.active {
    background: rgba(0,255,198,0.25);
    border-left: 4px solid var(--accent);
}

.content {
    flex: 1;
    padding: 40px;
    position: relative;
    overflow-y: auto;
}

.difficulty-selector {
    position: absolute;
    top: 20px;
    right: 40px;
    background: var(--panel);
    padding: 12px 20px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.4);
    display: flex;
    align-items: center;
    gap: 12px;
    z-index: 10;
}

.difficulty-selector select {
    padding: 8px 12px;
    border-radius: 8px;
    border: none;
    background: #020617;
    color: white;
    cursor: pointer;
}

.card {
    background: var(--panel);
    border-radius: 14px;
    padding: 30px;
    box-shadow: 0 0 30px rgba(0,0,0,0.6);
    max-width: 900px;
}

.card h3 {
    margin-top: 0;
    color: var(--accent);
    font-size: 24px;
}

input[type="text"], textarea {
    width: 100%;
    padding: 16px;
    background: #020617;
    border: 1px solid #1f2937;
    border-radius: 10px;
    color: white;
    font-size: 17px;
    margin: 15px 0;
}

button {
    padding: 12px 24px;
    background: var(--accent);
    border: none;
    border-radius: 8px;
    color: #020617;
    font-weight: bold;
    cursor: pointer;
}

button:hover { background: #00d8a8; }

.feedback-list {
    max-height: 500px;
    overflow-y: auto;
    padding: 10px;
    margin-top: 20px;
    border: 1px solid #1f2937;
    border-radius: 10px;
    background: rgba(0,0,0,0.2);
}

.feedback-item {
    background: rgba(255,255,255,0.03);
    border-radius: 8px;
    padding: 14px;
    margin-bottom: 12px;
    border-left: 4px solid var(--accent);
    word-wrap: break-word;
}

.results-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.product-card {
    background: rgba(255,255,255,0.03);
    border-radius: 10px;
    padding: 16px;
}

.product-image {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 8px;
}

.no-image {
    width: 100%;
    height: 180px;
    background: #1f2937;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--muted);
}

.hint {
    background: rgba(251,191,36,0.1);
    padding: 12px;
    border-radius: 8px;
    border-left: 4px solid #fbbf24;
    margin-top: 20px;
    font-size: 14px;
}

#domOutput, #bypassOutput {
    margin-top: 20px;
    padding: 20px;
    background: #020617;
    border-radius: 10px;
    min-height: 100px;
    border: 1px solid #1f2937;
    word-wrap: break-word;
}
</style>
</head>

<body>

<div class="sidebar">
    <h2>XSS Labs</h2>
    <a class="lab-link" id="reflectedLink" onclick="loadReflected()">Reflected XSS</a>
    <a class="lab-link" id="storedLink" onclick="loadStored()">Stored XSS</a>
    <a class="lab-link" id="domLink" onclick="loadDom()">DOM-Based XSS</a>
    <a class="lab-link" id="filterLink" onclick="loadFilterBypass()">Filter Bypass</a>
    <a class="lab-link" id="blindLink" onclick="loadBlind()">Blind XSS</a>
    <a class="lab-link" id="uaLink" onclick="loadUserAgent()">User-Agent XSS</a>
</div>

<div class="content" id="content">
    <div class="card">
        <h3>Welcome to XSS Labs</h3>
        <p>Select any lab from the left to start practicing XSS safely.</p>
        <small>Educational • Local Only • January 2026</small>
    </div>
</div>

<script>
let currentDifficulty = 'medium';
let currentLab = null;

function setActive(id) {
    document.querySelectorAll('.lab-link').forEach(l => l.classList.remove('active'));
    document.getElementById(id).classList.add('active');
}

function updateDifficulty() {
    const select = document.getElementById('difficultySelect');
    if (select) currentDifficulty = select.value;
    if (currentLab) currentLab(); // Reload current lab with updated difficulty
}

// === REFLECTED XSS ===
function loadReflected() {
    currentLab = loadReflected;
    setActive('reflectedLink');

    document.getElementById('content').innerHTML = `
        <div class="difficulty-selector">
            <label>Difficulty:</label>
            <select id="difficultySelect" onchange="updateDifficulty()">
                <option value="easy" ${currentDifficulty==='easy'?'selected':''}>Easy</option>
                <option value="medium" ${currentDifficulty==='medium'?'selected':''}>Medium</option>
                <option value="hard" ${currentDifficulty==='hard'?'selected':''}>Hard</option>
            </select>
        </div>
        <div class="card">
            <h3>Reflected XSS - Product Search</h3>
            <p>Search products. Input is reflected unsafely.</p>
            <input type="text" id="searchInput" placeholder="Search...">
            <div id="reflection"></div>
            <div id="results" class="results-container"></div>
        </div>
    `;

    const input = document.getElementById('searchInput');
    const reflection = document.getElementById('reflection');
    const results = document.getElementById('results');

    input.addEventListener('input', async () => {
        const q = input.value.trim();
        reflection.innerHTML = '';
        results.innerHTML = 'Searching...';

        if (!q) {
            results.innerHTML = '';
            return;
        }

        if (currentDifficulty === 'easy') reflection.innerHTML = `<p>You searched for: <strong>${q}</strong></p>`;
        else if (currentDifficulty === 'medium') reflection.innerHTML = `<p>You searched for: <strong>${q.replace(/<script/gi, '[blocked]')}</strong></p>`;
        else reflection.innerHTML = `<p>Term: <span title="${q}" style="cursor:help; border-bottom:1px dotted #00ffc6;">hover</span></p>`;

        try {
            const res = await fetch(`search.php?q=${encodeURIComponent(q)}`);
            const products = await res.json();
            let html = '';
            products.forEach(p => {
                html += `<div class="product-card">
                    ${p.image ? `<img src="${p.image}" class="product-image">` : '<div class="no-image">No image</div>'}
                    <h4>${p.name}</h4><p>${p.description}</p>
                </div>`;
            });
            results.innerHTML = html || 'No results';
        } catch { results.innerHTML = 'Error loading products'; }
    });
}

// === STORED XSS (FIXED: Separate tables + correct difficulty persistence) ===
function loadStored() {
    currentLab = loadStored;
    setActive('storedLink');

    document.getElementById('content').innerHTML = `
        <div class="difficulty-selector">
            <label>Difficulty:</label>
            <select id="difficultySelect" onchange="updateDifficulty()">
                <option value="easy" ${currentDifficulty==='easy'?'selected':''}>Easy</option>
                <option value="medium" ${currentDifficulty==='medium'?'selected':''}>Medium</option>
                <option value="hard" ${currentDifficulty==='hard'?'selected':''}>Hard</option>
            </select>
        </div>
        <div class="card">
            <h3>Stored XSS - Guestbook (${currentDifficulty.charAt(0).toUpperCase() + currentDifficulty.slice(1)})</h3>
            <textarea id="feedbackInput" placeholder="Leave feedback..."></textarea>
            <button onclick="submitFeedback()">Submit</button>
            <div class="feedback-list" id="feedbackList"><h4>Loading last 15...</h4></div>
            <div class="hint">
                ${currentDifficulty === 'easy' ? '<strong>Easy:</strong> No filter → &lt;script&gt;alert(1)&lt;/script&gt;' :
                  currentDifficulty === 'medium' ? '<strong>Medium:</strong> &lt;script&gt; blocked → use onerror, onload' :
                  '<strong>Hard:</strong> Shown in title → break out with quotes'}
            </div>
        </div>
    `;

    loadFeedbacks();
}

async function submitFeedback() {
    const txt = document.getElementById('feedbackInput').value.trim();
    if (!txt) return alert('Feedback cannot be empty!');

    await fetch('store_feedback.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ feedback: txt, difficulty: currentDifficulty })
    });

    document.getElementById('feedbackInput').value = '';
    loadFeedbacks();
}

async function loadFeedbacks() {
    const list = document.getElementById('feedbackList');
    try {
        const res = await fetch(`get_feedbacks.php?difficulty=${currentDifficulty}`);
        const items = await res.json();

        let html = '<h4>Last 15 Feedbacks:</h4>';
        items.forEach(i => {
            let c = i.feedback;
            if (currentDifficulty === 'medium') c = c.replace(/<script/gi, '[blocked]');
            if (currentDifficulty === 'hard') c = `<span title="${c}" style="cursor:help;border-bottom:1px dotted #00ffc6;">(hover to view)</span>`;
            html += `<div class="feedback-item">${c}</div>`;
        });
        list.innerHTML = html || '<p>No feedback yet.</p>';
    } catch {
        list.innerHTML = '<p>Error loading feedbacks.</p>';
    }
}

// === DOM-BASED XSS ===
function loadDom() {
    currentLab = loadDom;
    setActive('domLink');

    document.getElementById('content').innerHTML = `
        <div class="difficulty-selector">
            <label>Difficulty:</label>
            <select id="difficultySelect" onchange="updateDifficulty()">
                <option value="easy" ${currentDifficulty==='easy'?'selected':''}>Easy</option>
                <option value="medium" ${currentDifficulty==='medium'?'selected':''}>Medium</option>
                <option value="hard" ${currentDifficulty==='hard'?'selected':''}>Hard</option>
            </select>
        </div>
        <div class="card">
            <h3>DOM-Based XSS</h3>
            <input type="text" id="nameInput" placeholder="Enter name">
            <div id="domOutput">Hello!</div>
            <div class="hint">Live DOM manipulation — try payloads</div>
        </div>
    `;

    document.getElementById('nameInput').addEventListener('input', function() {
        const val = this.value;
        const out = document.getElementById('domOutput');
        if (currentDifficulty === 'easy') out.innerHTML = `Hello, ${val}!`;
        else if (currentDifficulty === 'medium') out.innerHTML = `Hello, ${val.replace(/<script/gi, '')}!`;
        else try { out.textContent = `Hello, ${eval('"' + val + '"')}!`; } catch { out.textContent = 'Error'; }
    });
}

// === FILTER BYPASS ===
function loadFilterBypass() {
    currentLab = loadFilterBypass;
    setActive('filterLink');

    document.getElementById('content').innerHTML = `
        <div class="difficulty-selector">
            <label>Difficulty:</label>
            <select id="difficultySelect" onchange="updateDifficulty()">
                <option value="easy" ${currentDifficulty==='easy'?'selected':''}>Easy</option>
                <option value="medium" ${currentDifficulty==='medium'?'selected':''}>Medium</option>
                <option value="hard" ${currentDifficulty==='hard'?'selected':''}>Hard</option>
            </select>
        </div>
        <div class="card">
            <h3>Filter Bypass</h3>
            <input type="text" id="bypassInput" placeholder="Try payload">
            <div id="bypassOutput">Output here</div>
        </div>
    `;

    document.getElementById('bypassInput').addEventListener('input', function() {
        let val = this.value;
        if (currentDifficulty === 'easy') val = val.replace(/<script/gi, '[blocked]');
        else if (currentDifficulty === 'medium') val = val.replace(/<script|on\w+|javascript:/gi, '[blocked]');
        else val = val.replace(/alert|script|on|javascript|src|eval/gi, '[WAF]');
        document.getElementById('bypassOutput').innerHTML = val;
    });
}

// === BLIND XSS ===
function loadBlind() {
    currentLab = loadBlind;
    setActive('blindLink');

    document.getElementById('content').innerHTML = `
        <div class="difficulty-selector">
            <label>Difficulty:</label>
            <select id="difficultySelect" onchange="updateDifficulty()">
                <option value="easy" ${currentDifficulty==='easy'?'selected':''}>Easy</option>
                <option value="medium" ${currentDifficulty==='medium'?'selected':''}>Medium</option>
                <option value="hard" ${currentDifficulty==='hard'?'selected':''}>Hard</option>
            </select>
        </div>
        <div class="card">
            <h3>Blind XSS</h3>
            <textarea id="reportInput" placeholder="Report bug + payload"></textarea>
            <button onclick="alert('Report sent! Payload stored for admin.')">Send to Admin</button>
            <div style="margin-top:20px;padding:15px;background:#1f2937;border-radius:8px;">
                Payload executes only when admin views reports.
            </div>
        </div>
    `;
}

// === USER-AGENT XSS ===
function loadUserAgent() {
    currentLab = loadUserAgent;
    setActive('uaLink');

    document.getElementById('content').innerHTML = `
        <div class="difficulty-selector">
            <label>Difficulty:</label>
            <select id="difficultySelect" onchange="updateDifficulty()">
                <option value="easy" ${currentDifficulty==='easy'?'selected':''}>Easy</option>
                <option value="medium" ${currentDifficulty==='medium'?'selected':''}>Medium</option>
                <option value="hard" ${currentDifficulty==='hard'?'selected':''}>Hard</option>
            </select>
        </div>
        <div class="card">
            <h3>User-Agent XSS</h3>
            <p>Your User-Agent is logged and displayed:</p>
            <div style="background:#020617;padding:15px;border-radius:8px;word-break:break-all;" id="uaDisplay">
                ${navigator.userAgent}
            </div>
            <p style="margin-top:20px;">Change User-Agent in Dev Tools and refresh.</p>
        </div>
    `;

    const display = document.getElementById('uaDisplay');
    let ua = navigator.userAgent;
    if (currentDifficulty === 'medium') ua = ua.replace(/<script/gi, '[blocked]');
    if (currentDifficulty === 'hard') display.innerHTML = `<span title="${ua}" style="cursor:help;border-bottom:1px dotted #00ffc6;">(hover)</span>`;
    else display.innerHTML = ua;
}
</script>

</body>
</html>