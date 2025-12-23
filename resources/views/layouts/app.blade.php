<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    {{-- Menetapkan judul halaman --}}
    <title>@yield('title', 'Dashboard - MPP Sukoharjo')</title>

    {{-- Meta tags untuk mencegah caching --}}
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    {{-- Link Font Awesome untuk ikon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Stack untuk CSS spesifik halaman anak --}}
    @stack('styles')

    {{-- =====================================
        GLOBAL & LAYOUT STYLES (Diperbarui)
        ===================================== --}}
    <style>
        /* =====================================
           GLOBAL & VARIABLES (Diperbarui)
           ===================================== */
        :root{
            --bg:#f6f8fb;
            --card:#ffffff;
            --muted:#666; /* Lebih gelap dari versi sebelumnya */
            --accent:#1a73e8; /* Biru Primer */
            --error: #ea4335;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.05); /* Shadow lebih ringan */
            font-family:Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            font-size: 14px;
        }
        body {
            margin: 0;
            background: var(--bg);
            color: #222;
            display: flex; /* Mengatur Sidebar dan Main Content bersebelahan */
            overflow-x: hidden;
            height: 100vh;
        }
        *{box-sizing:border-box}

        /* =====================================
           1. SIDEBAR (Diperbarui)
           ===================================== */
        .sidebar {
            width: 250px;
            background-color: #ffffff;
            height: 100vh;
            border-right: 1px solid #ddd;
            display: flex;
            flex-direction: column;
            position: fixed;
            z-index: 100;
        }
        .sidebar .logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 130px;
            padding-top: 20px;
            flex-shrink: 0;
        }
        .sidebar .logo img {
            width: 85%;
            height: auto;
            display: block;
            margin: 0 auto;
            max-height: 80px;
            object-fit: contain;
        }
        .sidebar ul {
            list-style-type:none;
            padding:0;
            margin:0;
            flex-grow:1; /* Memungkinkan daftar menu mengambil sisa ruang */
            overflow-y: auto; /* Scrollbar jika menu terlalu banyak */
        }
        .sidebar ul li {
            display:flex;align-items:center;
            padding:12px 20px;color:#555;font-size:15px;
            cursor:pointer;transition:all 0.2s ease;
        }
        .sidebar ul li i {margin-right:12px;font-size:18px;width:22px;text-align:center;}
        .sidebar ul li:hover {background-color:#f0f4ff;color:#1a73e8;}
        .sidebar ul li.active {
            background-color:#e6ebff;color:#1a73e8;
            border-left:4px solid #1a73e8;
        }
        
        /* Gaya untuk tombol Logout */
        .sidebar ul li.logout-item {
            margin-top: 15px; 
            border-top: 1px solid #eee; 
            padding-top: 15px; 
            color: #961015; 
        }
        .sidebar ul li.logout-item:hover {
            background-color: #ffeaea; 
            color: #e41e26;
        }

        /* Footer Sidebar (Pindah ke dalam sidebar) */
        .sidebar .footer {
            padding:16px;font-size:13px;color:var(--muted);
            border-top:1px solid #eee;text-align:center;
            flex-shrink: 0; 
            line-height: 1.4;
        }

        /* =====================================
           2. MAIN CONTENT & TOPBAR (Diperbarui)
           ===================================== */
        .main {
            flex:1;
            padding:22px; /* Padding utama untuk konten */
            margin-left:250px; /* Offset agar tidak tertutup Sidebar */
            min-width:0;
            display: flex; /* Untuk menempatkan Topbar, Content, dan Footer di main */
            flex-direction: column;
            min-height: 100vh;
        }
        /* TOPBAR (Tidak sticky, tapi berada di atas konten) */
        .topbar{display:flex;justify-content:space-between;align-items:center;margin-bottom:18px}

        /* Search Bar */
        .search {position:relative;width:420px;max-width:100%;}
        .search input {
            /* Padding kanan ditambah (36px) untuk memberi ruang tombol silang */
            padding:10px 36px 10px 12px;
            border-radius:10px;
            border:1px solid #e6e6e6;
            width:100%;
        }
        .search .clear-btn {
            position:absolute;
            right:10px;
            top:50%;
            transform:translateY(-50%);
            border:none;
            background:none;
            font-size:16px;
            color:#888;
            cursor:pointer;
            display:none; /* Sembunyikan secara default */
        }
        .search .clear-btn:hover{color:#000;}

        /* User Profile Info */
        .user{display:flex;gap:12px;align-items:center}
        .user img{width:40px;height:40px;border-radius:50%}
        .user > div:first-child > div:first-child {
            font-weight: 600;
        }

        /* Icon Buttons */
        .icon-btn {
            position: relative; 
            width: 40px; height: 40px; border-radius: 50%; background: #fff; border: 1px solid #eee;
            color: var(--muted); display: flex; align-items: center; justify-content: center;
            cursor: pointer; transition: all 0.2s;
        }
        .icon-btn:hover { background: #f0f4ff; color: #444; }
        .topbar-icons {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 10px;
        }
        
        /* Badge Notifikasi */
        .notification-badge {
            position: absolute;
            top: 0px; 
            right: 0px; 
            min-width: 18px; 
            height: 18px;
            line-height: 18px;
            background-color: #f44336; 
            border-radius: 9px; 
            border: 2px solid var(--card); 
            z-index: 10;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            text-align: center;
            padding: 0 4px; 
            display: none; 
            align-items: center; 
            justify-content: center;
        }
        
        /* Dropdown Notifikasi */
        .notification-dropdown {
            position: absolute;
            top: 50px; 
            right: 0;
            width: 300px;
            background: var(--card);
            border-radius: 10px;
            box-shadow: var(--shadow);
            padding: 15px;
            z-index: 200;
            display: none; 
            text-align: left; 
        }
        .notification-dropdown .notification-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .notification-dropdown .notification-item {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
            cursor: pointer;
            gap: 10px;
            transition: background-color 0.2s;
        }
        .notification-dropdown .notification-item:hover {
            background-color: #f6f8fb;
        }
        .notification-dropdown .notification-item:last-child {
            border-bottom: none;
        }
        .notification-dropdown .notification-item .notif-text {
            flex-grow: 1;
            font-size: 13px;
            line-height: 1.4;
            color: #333;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        .notification-dropdown .notification-item .notif-time {
            font-size: 11px;
            color: var(--muted);
            flex-shrink: 0;
        }
        .notification-dropdown .notification-avatar {
            width: 30px; 
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .notification-dropdown .notification-avatar .notif-icon {
            font-size: 14px;
            color: #fff;
        }
        /* Warna Avatar Simulasi */
        .notif-avatar-1 { background-color: #1a73e8; }
        .notif-avatar-2 { background-color: #ea4335; }
        .notif-avatar-3 { background-color: #fbbc04; }
        .notification-dropdown .table-footer a {
            display: block;
            text-align: center;
            padding: 8px 0;
            font-size: 13px;
            color: var(--accent);
            text-decoration: none;
            border-top: 1px solid #f0f0f0;
            margin-top: 10px;
        }
        .notification-dropdown .table-footer a:hover {
            text-decoration: underline;
        }

        /* 3. MAIN FOOTER (Diperbarui) */
        .main-footer {
            margin-top: auto; /* Memastikan footer selalu di bawah */
            padding: 15px 0 10px 0; 
            text-align: center; 
            width: 100%;
            font-size: 13px;
            color: var(--muted);
            /* Catatan: Padding kiri-kanan sudah dicakup oleh padding .main */
        }
    </style>
</head>
<body>
    {{-- =====================================
        1. SIDEBAR (Fixed Left Navigation)
        ===================================== --}}
    <div class="sidebar">
        <div style="display: flex; flex-direction: column; flex-grow: 1; min-height: 0;"> 
            <div class="logo">
                <img src="{{ asset('Asset 3@4x.png') }}" alt="Logo MPP Sukoharjo">
            </div>
            <ul>
                {{-- Menu Sidebar. Kelas 'active' disetel secara dinamis --}}
                <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}" 
                    onclick="window.location.href='{{ route('dashboard') }}'">
                    <i class="fa-solid fa-gauge"></i>Dashboard
                </li>
                <li class="{{ request()->routeIs('kelola-instansi') ? 'active' : '' }}" 
                    onclick="window.location.href='{{ route('kelola-instansi') }}'">
                    <i class="fa-solid fa-building"></i>Data Instansi & Layanan
                </li>
                <li class="{{ request()->routeIs('data-pengguna') ? 'active' : '' }}" 
                    onclick="window.location.href='{{ route('data-pengguna') }}'">
                    <i class="fa-solid fa-user"></i>Data Pengguna
                </li>
                <li class="{{ request()->routeIs('laporan-statistik') ? 'active' : '' }}" 
                    onclick="window.location.href='{{ route('laporan-statistik') }}'">
                    <i class="fa-solid fa-chart-column"></i>Laporan & Statistik
                </li>
                <li class="{{ request()->routeIs('pengaduan-masukan') ? 'active' : '' }}" 
                    onclick="window.location.href='{{ route('pengaduan-masukan') }}'">
                    <i class="fa-solid fa-comments"></i>Pengaduan & Masukan
                </li>
                <li class="{{ request()->routeIs('kelola-konten-website') ? 'active' : '' }}" 
                    onclick="window.location.href='{{ route('kelola-konten-website') }}'">
                    <i class="fa-solid fa-image"></i>Kelola Konten Website
                </li>
                <li class="{{ request()->routeIs('aktivitas-sistem') ? 'active' : '' }}" 
                    onclick="window.location.href='{{ route('aktivitas-sistem') }}'">
                    {{-- Menggunakan ikon yang lebih semantik untuk Riwayat Aktivitas --}}
                    <i class="fa-solid fa-clipboard-list"></i>Riwayat Aktivitas 
                </li>
                <li class="{{ request()->routeIs('pengaturan-sistem') ? 'active' : '' }}" 
                    onclick="window.location.href='{{ route('pengaturan-sistem') }}'">
                    <i class="fa-solid fa-gear"></i>Pengaturan Sistem
                </li>
                
                {{-- Tombol Logout terpisah --}}
                <li class="logout-item" onclick="handleLogout()">
                    <i class="fa-solid fa-right-from-bracket"></i>Logout
                </li>
            </ul>
        </div>
        
        {{-- FOOTER SIDEBAR (Informasi Sistem) --}}
        <div class="footer">
            <div id="todayDate"></div>
            <div>● Sistem Aktif</div>
        </div>
    </div>
    
    {{-- =====================================
        2. MAIN CONTENT WRAPPER
        ===================================== --}}
    <main class="main">
        {{-- 2a. TOPBAR (Header) --}}
        <div class="topbar">
            <div class="search">
                <input id="searchInput" oninput="toggleClearButton(this)" placeholder="Cari Instansi atau Layanan..." />
                <button id="clearSearch" class="clear-btn" onclick="clearSearchInput()">&times;</button>
            </div>
            <div style="display:flex;align-items:center;gap:15px;">
                <div class="topbar-icons">
                    {{-- Tombol Notifikasi --}}
                    <button
                        class="icon-btn"
                        title="Notifikasi"
                        onclick="toggleNotificationDropdown(event)">
                        <i class="fa-regular fa-bell"></i>
                        <div class="notification-badge" id="notifBadge" style="display:none;"></div>
                        
                        {{-- Dropdown Notifikasi --}}
                        <div class="notification-dropdown" id="notificationDropdown">
                            <h4 style="margin:0 0 10px 0; font-size:14px; font-weight: 600; color: #333;">Notifikasi Terbaru</h4>
                            <ul id="dropdownNotificationList" class="notification-list">
                                {{-- Konten diisi oleh JavaScript --}}
                            </ul>
                            <div class="table-footer">
                                <a href="{{ route('notifikasi') }}" onclick="markAllAsReadAndNavigate(true)">Lihat Semua Notifikasi</a>
                            </div>
                        </div>
                    </button>
                    {{-- Tombol Pesan/Chat (Placeholder) --}}
                    <button class="icon-btn"><i class="fa-regular fa-comment-dots"></i></button>
                </div>
                
                {{-- Info Profil User --}}
                <div class="user" onclick="window.location.href='{{ route('profile.edit') }}'">
                    <div style="text-align:right;font-size:13px">
                        <div>Admin Utama</div>
                        <div style="color:var(--muted);font-size:12px">Super Admin</div>
                    </div>
                    <img id="topbarProfileImage" src="https://i.pravatar.cc/150?img=1" alt="avatar" />
                </div>
            </div>
        </div>
        
        {{-- 2b. CONTENT AREA (Isi Halaman) --}}
        <div class="content-area">
            {{-- Konten halaman anak akan ditempatkan di sini --}}
            @yield('content')
        </div>

        {{-- 3. MAIN FOOTER (Copyright) --}}
        <footer class="main-footer">
            <p>&copy; 2025 Mal Pelayanan Publik (MPP) Sukoharjo – All Rights Reserved.</p>
        </footer>
    </main>

    {{-- =====================================
        4. GLOBAL SCRIPTS
        ===================================== --}}
    {{-- Script Pustaka Eksternal (Hanya yang relevan jika ini adalah layout utama) --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
    
    {{-- Script tambahan dari view anak masuk di sini --}}
    @stack('scripts')
    
    {{-- SCRIPT GLOBAL (Clock, Logout, Notifikasi, Search) --}}
    <script>
        // Data notifikasi simulasi (diperlukan untuk fungsi notifikasi yang Anda sediakan)
        const notificationData = [
            { id: 1, text: 'Layanan baru "SIAK" telah diaktifkan.', time: '1 jam lalu', read: false, icon: 'fa-check', avatarClass: 'notif-avatar-1' },
            { id: 2, text: 'Instansi "Dinas Kesehatan" diperbarui.', time: '3 jam lalu', read: true, icon: 'fa-pen-to-square', avatarClass: 'notif-avatar-2' },
            { id: 3, text: 'Ada 5 pengaduan baru yang perlu diperiksa.', time: '1 hari lalu', read: false, icon: 'fa-comments', avatarClass: 'notif-avatar-3' },
            { id: 4, text: 'Pengaturan sistem berhasil disimpan.', time: '2 hari lalu', read: false, icon: 'fa-gear', avatarClass: 'notif-avatar-1' },
        ];
        
        // Utility to escape HTML for safety
        function escapeHtml(unsafe) {
            return String(unsafe)
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        // =====================================
        // CLOCK / TANGGAL DAN JAM REALTIME
        // =====================================
        function updateClock() {
            const dateElement = document.getElementById("todayDate");
            if (dateElement) {
                const today = new Date();
                const options = {
                    weekday: "long",
                    day: "numeric",
                    month: "long",
                    year: "numeric",
                    hour: "2-digit",
                    minute: "2-digit",
                    second: "2-digit",
                    hour12: false
                };
                dateElement.textContent = today.toLocaleDateString("id-ID", options);
            }
        }

        // =====================================
        // LOGOUT
        // =====================================
        function handleLogout() {
            if (confirm("Anda yakin ingin keluar?")) {
                // Mengarahkan ke rute login menggunakan Blade helper dan mengganti entri di history.
                window.location.replace('{{ route('login') }}');
            }
        }

        // =====================================
        // SEARCH BAR UTILITIES
        // =====================================
        function toggleClearButton(input) {
            const clearBtn = document.getElementById('clearSearch');
            if (clearBtn) {
                clearBtn.style.display = input.value.length > 0 ? 'block' : 'none';
            }
        }

        function clearSearchInput() {
            const input = document.getElementById('searchInput');
            if (input) {
                input.value = '';
                toggleClearButton(input);
                // Tambahkan logika pencarian untuk membersihkan hasil
                // performSearch(''); 
            }
        }


        // =====================================
        // NOTIFICATION LOGIC
        // =====================================

        // FUNGSI UTILITY: Memperbarui tampilan badge (count)
        function updateNotificationBadge(count) {
            const notifBadge = document.getElementById('notifBadge');
            if (!notifBadge) return;

            if (count > 0) {
                notifBadge.style.display = 'flex'; 
                notifBadge.textContent = count > 9 ? '9+' : count.toString(); 
            } else {
                notifBadge.style.display = 'none';
                notifBadge.textContent = '';
            }
        }

        // SIMULASI LOGIKA NOTIFIKASI: Mengecek apakah ada notifikasi yang belum dibaca
        function checkNotifications() {
            let unreadCount = parseInt(localStorage.getItem('unreadNotificationCount'));
                
            // Jika belum pernah disetel, kita hitung dari data simulasi
            if (isNaN(unreadCount) || unreadCount === null) {
                const initialUnread = notificationData.filter(n => !n.read).length;
                unreadCount = initialUnread;
                localStorage.setItem('unreadNotificationCount', unreadCount.toString());
            }

            // Tampilkan/Sembunyikan badge berdasarkan count
            updateNotificationBadge(unreadCount);
        }

        // FUNGSI TOGGLE DROPDOWN NOTIFIKASI
        function toggleNotificationDropdown(event) {
            event.stopPropagation();
            const dropdown = document.getElementById('notificationDropdown');
            const isShowing = dropdown.style.display === 'block';

            if (isShowing) {
                dropdown.style.display = 'none';
            } else {
                // Selalu render ulang saat dibuka untuk tampilan data terbaru
                renderDropdownNotifications(); 
                dropdown.style.display = 'block';
            }
        }

        // FUNGSI RENDER KONTEN DROPDOWN NOTIFIKASI
        function renderDropdownNotifications() {
            const ul = document.getElementById('dropdownNotificationList');
            if (!ul) return;
                
            // Ambil hanya 3 notifikasi teratas untuk dropdown
            const topNotifications = notificationData.slice(0, 3); 
            ul.innerHTML = '';

            if (topNotifications.length === 0) {
                ul.innerHTML = '<li><div class="notif-text" style="padding: 10px 0; color: var(--muted);">Tidak ada notifikasi terbaru.</div></li>';
                return;
            }

            topNotifications.forEach(n => {
                const li = document.createElement('li');
                li.classList.add('notification-item');
                // Navigasi ke halaman notifikasi dengan parameter ID
                li.onclick = () => {
                    // Di lingkungan Laravel, ini akan menjadi `window.location.href = '{{ route('notifikasi') }}' + '?id=' + n.id;`
                    markAllAsReadAndNavigate(false); 
                    console.log('Navigasi ke notifikasi ID: ' + n.id);
                    // Contoh simulasi:
                    // window.location.href = '{{ route('notifikasi') }}' + '?id=' + n.id;
                } 
                li.innerHTML = `
                    <div class="notification-avatar ${n.avatarClass}">
                        <i class="fa-solid ${n.icon} notif-icon"></i>
                    </div>
                    <div class="notif-text">${escapeHtml(n.text)}</div>
                    <div class="notif-time">${escapeHtml(n.time)}</div>`;
                ul.appendChild(li);
            });
        }

        // FUNGSI UNTUK MERESET COUNT NOTIFIKASI DAN NAVIGASI
        function markAllAsReadAndNavigate(doNavigate = true) {
            // 1. Reset jumlah notifikasi yang belum dibaca di localStorage
            localStorage.setItem('unreadNotificationCount', '0');
            
            // 2. Sembunyikan badge notifikasi secara visual
            updateNotificationBadge(0);
            
            // 3. Tutup dropdown jika terbuka
            const dropdown = document.getElementById('notificationDropdown');
            if (dropdown) dropdown.style.display = 'none';

            // 4. Navigasi ke halaman notifikasi
            if (doNavigate) {
                window.location.href = '{{ route('notifikasi') }}';
            }
        }

        // =====================================
        // INISIALISASI
        // =====================================
        document.addEventListener("DOMContentLoaded", function() {
            updateClock();
            checkNotifications(); // Inisialisasi badge dan list
            setInterval(updateClock, 1000); // Update jam setiap detik

            // Menutup dropdown notifikasi saat klik di luar
            document.addEventListener('click', function(event) {
                const dropdown = document.getElementById('notificationDropdown');
                const iconBtn = document.querySelector('.topbar-icons button:first-child'); 
                
                if (dropdown && dropdown.style.display === 'block') {
                    // Jika yang diklik BUKAN dropdown DAN BUKAN tombol lonceng
                    if (!dropdown.contains(event.target) && (!iconBtn || !iconBtn.contains(event.target))) {
                        dropdown.style.display = 'none';
                    }
                }
            });

            // Inisialisasi Search Clear Button
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                 // Panggil sekali saat DOMContentLoaded untuk menangani kasus input terisi dari cache browser
                toggleClearButton(searchInput); 
            }
        });
    </script>

</body>
</html>