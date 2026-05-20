{{-- resources/views/mail-dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel Mail Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f8fafc;
            color: #1e293b;
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Helvetica, sans-serif;
            line-height: 1.5;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Header */
        .header {
            margin-bottom: 2rem;
        }

        .header h1 {
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            display: inline-block;
        }

        .header p {
            color: #64748b;
            margin-top: 0.5rem;
        }

        /* Alert Messages */
        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .alert-success {
            background: #dcfce7;
            border: 1px solid #bbf7d0;
            color: #166534;
        }

        .alert-error {
            background: #fee2e2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .close-alert {
            cursor: pointer;
            font-weight: bold;
            font-size: 1.2rem;
        }

        /* Stats Grid */
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 1rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
            transition: all 0.2s ease;
        }

        .stat-card:hover {
            border-color: #cbd5e1;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        }

        .stat-card h3 {
            font-size: 0.875rem;
            font-weight: 500;
            color: #64748b;
            margin-bottom: 0.5rem;
            letter-spacing: 0.025em;
        }

        .stat-card .value {
            font-size: 2rem;
            font-weight: 700;
            color: #0f172a;
        }

        /* Toolbar */
        .toolbar {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 2rem;
            justify-content: space-between;
            align-items: center;
        }

        .search-box {
            flex: 1;
            min-width: 250px;
        }

        .search-box input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            font-size: 0.875rem;
            background: white;
            transition: all 0.2s;
        }

        .search-box input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
        }

        .filter-group {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            font-size: 0.875rem;
            font-weight: 500;
            background: white;
            border: 1px solid #e2e8f0;
            color: #475569;
            cursor: pointer;
            transition: all 0.2s;
        }

        .filter-btn.active {
            background: #3b82f6;
            border-color: #3b82f6;
            color: white;
        }

        .filter-btn:hover:not(.active) {
            background: #f1f5f9;
        }

        /* Mail Grid */
        .mail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
            gap: 1.5rem;
        }

        .mail-card {
            background: white;
            border-radius: 1rem;
            border: 1px solid #e2e8f0;
            overflow: hidden;
            transition: all 0.2s ease;
        }

        .mail-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px -12px rgba(0,0,0,0.15);
            border-color: #cbd5e1;
        }

        .card-header {
            padding: 1.25rem 1.5rem;
            background: #fafbfc;
            border-bottom: 1px solid #eef2f6;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 2rem;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-welcome { background: #dbeafe; color: #1e40af; }
        .badge-invoice { background: #dcfce7; color: #166534; }
        .badge-newsletter { background: #fef3c7; color: #92400e; }
        .badge-reminder { background: #ffe4e6; color: #9f1239; }

        .status-badge {
            font-size: 0.7rem;
            padding: 0.2rem 0.6rem;
            border-radius: 2rem;
            background: #f1f5f9;
            color: #475569;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-body h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .card-body .description {
            color: #64748b;
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }

        .meta-info {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.25rem;
            font-size: 0.75rem;
            color: #94a3b8;
            flex-wrap: wrap;
        }

        .meta-info span {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .button-group {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 1rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
            border: none;
            background: none;
        }

        .btn-primary {
            background: #3b82f6;
            color: white;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .btn-outline {
            border: 1px solid #e2e8f0;
            background: white;
            color: #475569;
        }

        .btn-outline:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
        }

        .btn-danger-outline {
            border: 1px solid #fee2e2;
            background: white;
            color: #dc2626;
        }

        .btn-danger-outline:hover {
            background: #fef2f2;
            border-color: #fecaca;
        }

        .toast {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background: #1e293b;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s;
            pointer-events: none;
        }

        .toast.show {
            opacity: 1;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 1rem;
            border: 1px solid #e2e8f0;
            color: #64748b;
        }

        .footer {
            margin-top: 3rem;
            text-align: center;
            padding-top: 1.5rem;
            border-top: 1px solid #e2e8f0;
            color: #94a3b8;
            font-size: 0.75rem;
        }

        @media (max-width: 640px) {
            .container { padding: 1rem; }
            .mail-grid { grid-template-columns: 1fr; }
            .toolbar { flex-direction: column; align-items: stretch; }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Mail Dashboard</h1>
       
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
        <div class="alert alert-success" id="alert-message">
            {{ session('success') }}
            <span class="close-alert" onclick="this.parentElement.remove()">&times;</span>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-error" id="alert-message">
            {{ session('error') }}
            <span class="close-alert" onclick="this.parentElement.remove()">&times;</span>
        </div>
        @endif

        <!-- Statistics -->
        <div class="stats" id="stats-container">
            <div class="stat-card">
                <h3>Total Templates</h3>
                <div class="value" id="total-templates">0</div>
            </div>
            <div class="stat-card">
                <h3>Mail Types</h3>
                <div class="value" id="unique-types">0</div>
            </div>
            <div class="stat-card">
                <h3>Last Updated</h3>
                <div class="value" style="font-size: 0.9rem;">{{ now()->format('M d, H:i') }}</div>
            </div>
        </div>

        <!-- Toolbar -->
        <div class="toolbar">
            <div class="search-box">
                <input type="text" id="search" placeholder=" Search by title, type, or description...">
            </div>
            <div class="filter-group" id="filter-group">
                <button class="filter-btn active" data-filter="all">All</button>
            </div>
        </div>

        <!-- Mail Grid -->
        <div class="mail-grid" id="mail-grid">
            <!-- Dynamic content -->
        </div>

        <!-- Toast Message -->
        <div id="toast" class="toast">Copied!</div>

        <!-- Footer -->
        <div class="footer">
            <p>Laravel Mail Dashboard • {{ date('Y') }} • <span id="mail-count"></span> templates available</p>
        </div>
    </div>

    <script>
        // Mails Data (injected from backend)
        const mailsData = @json($mails);

        let currentFilter = 'all';
        let searchTerm = '';

        // Helper: Copy to clipboard
        function copyToClipboard(text, label = 'Path') {
            navigator.clipboard.writeText(text).then(() => {
                showToast(`${label} copied: ${text}`);
            }).catch(() => {
                showToast('Failed to copy', true);
            });
        }

        // Send test email via AJAX
        async function sendTestEmail(type, event) {
            const button = event.target;
            const originalText = button.innerHTML;
            button.innerHTML = '⏳ Sending...';
            button.disabled = true;

            try {
                const response = await fetch(`/mail-test?type=${type}`, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (response.ok) {
                    showToast(data.message || 'Test email sent successfully!');
                } else {
                    showToast(data.error || 'Failed to send test email', true);
                }
            } catch (error) {
                showToast('Network error: ' + error.message, true);
            } finally {
                button.innerHTML = originalText;
                button.disabled = false;
            }
        }

        // Show toast notification
        function showToast(message, isError = false) {
            const toast = document.getElementById('toast');
            toast.textContent = message;
            toast.style.background = isError ? '#dc2626' : '#1e293b';
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
                toast.style.background = '#1e293b';
            }, 2000);
        }

        // Get unique types from mails
        function getUniqueTypes() {
            const types = [...new Set(mailsData.map(mail => mail.type))];
            return types;
        }

        // Render filter buttons
        function renderFilters() {
            const types = getUniqueTypes();
            const filterContainer = document.getElementById('filter-group');
            const allBtn = `<button class="filter-btn ${currentFilter === 'all' ? 'active' : ''}" data-filter="all">All</button>`;
            const typeBtns = types.map(type => `
                <button class="filter-btn ${currentFilter === type ? 'active' : ''}" data-filter="${type}">${type}</button>
            `).join('');
            filterContainer.innerHTML = allBtn + typeBtns;

            // Attach event listeners
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    currentFilter = btn.dataset.filter;
                    renderFilters();
                    renderMails();
                });
            });
        }

        // Get badge class for type
        function getBadgeClass(type) {
            const typeMap = {
                'Welcome': 'badge-welcome',
                'Invoice': 'badge-invoice',
                'Newsletter': 'badge-newsletter',
                'Reminder': 'badge-reminder'
            };
            return typeMap[type] || 'badge-welcome';
        }

        // Render mail cards
        function renderMails() {
            const grid = document.getElementById('mail-grid');
            const filtered = mailsData.filter(mail => {
                const matchesFilter = currentFilter === 'all' || mail.type === currentFilter;
                const matchesSearch = searchTerm === '' || 
                    mail.title.toLowerCase().includes(searchTerm) ||
                    mail.type.toLowerCase().includes(searchTerm) ||
                    mail.description.toLowerCase().includes(searchTerm);
                return matchesFilter && matchesSearch;
            });

            // Update stats
            document.getElementById('total-templates').textContent = filtered.length;
            document.getElementById('unique-types').textContent = getUniqueTypes().length;
            document.getElementById('mail-count').textContent = filtered.length;

            if (filtered.length === 0) {
                grid.innerHTML = `<div class="empty-state">✨ No email templates found. Try adjusting your search or filter.</div>`;
                return;
            }

            grid.innerHTML = filtered.map(mail => `
                <div class="mail-card" data-type="${mail.type}">
                    <div class="card-header">
                        <span class="badge ${getBadgeClass(mail.type)}">${escapeHtml(mail.type)}</span>
                        <span class="status-badge">${escapeHtml(mail.status || 'Active')}</span>
                    </div>
                    <div class="card-body">
                        <h3>${escapeHtml(mail.title)}</h3>
                        <div class="description">${escapeHtml(mail.description)}</div>
                        <div class="meta-info">
                            <span>📁 ${escapeHtml(mail.blade_path)}</span>
                            ${mail.updated_at ? `<span>🕒 ${escapeHtml(mail.updated_at)}</span>` : ''}
                        </div>
                        <div class="button-group">
                            <a href="${escapeHtml(mail.preview)}" class="btn btn-primary" target="_blank">
                                👁️ Preview
                            </a>
                            <button class="btn btn-outline" onclick="copyToClipboard('${escapeHtml(mail.blade_path)}', 'Blade path')">
                                📋 Copy Path
                            </button>
                            ${mail.test_url ? `<button class="btn btn-outline" onclick="sendTestEmail('${mail.type.toLowerCase()}', event)">📤 Send Test</button>` : ''}
                        </div>
                    </div>
                </div>
            `).join('');
        }

        // Simple escape to prevent XSS
        function escapeHtml(str) {
            if (!str) return '';
            return str.replace(/[&<>]/g, function(m) {
                if (m === '&') return '&amp;';
                if (m === '<') return '&lt;';
                if (m === '>') return '&gt;';
                return m;
            });
        }

        // Search handler
        function setupSearch() {
            const searchInput = document.getElementById('search');
            searchInput.addEventListener('input', (e) => {
                searchTerm = e.target.value.toLowerCase();
                renderMails();
            });
        }

        // Auto-hide flash messages after 5 seconds
        setTimeout(() => {
            const alert = document.getElementById('alert-message');
            if (alert) alert.remove();
        }, 5000);

        // Initialize dashboard
        function init() {
            renderFilters();
            renderMails();
            setupSearch();
        }

        init();
    </script>
</body>
</html>