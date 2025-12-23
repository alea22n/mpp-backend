<div class="topbar">
    <div class="search-area">
        <div class="search-wrapper">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Cari data, layanan, atau instansi..." id="searchInput">
            <button class="clear-search" id="clearSearch" style="display: none;"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="topbar-date" id="todayDate"></div>
    </div>

    <div class="topbar-icons">
        <button onclick="toggleNotificationDropdown(event)">
            <i class="fa-solid fa-bell"></i>
            <span class="badge" id="notifBadge" style="display: none;"></span>
        </button>
        <div class="notification-dropdown" id="notificationDropdown">
            <div class="dropdown-header">
                <h4>Notifikasi</h4>
                <a href="#" onclick="markAllAsReadAndNavigate(false)">Tandai semua dibaca</a>
            </div>
            <ul id="dropdownNotificationList">
                </ul>
            <div class="dropdown-footer">
                <a href="aktivitas-utama.html">Lihat Semua Aktivitas</a>
            </div>
        </div>

        <div class="user-profile" onclick="toggleProfileDropdown(event)">
            <div class="avatar-sm">
                <i class="fa-solid fa-user-tie"></i>
            </div>
            <span class="user-name">Admin Utama</span>
            <i class="fa-solid fa-angle-down arrow-down"></i>
            <div class="profile-dropdown" id="profileDropdown">
                <a href="profil-utama.html"><i class="fa-solid fa-user-circle"></i> Profil Saya</a>
                <a href="pengaturan-utama.html"><i class="fa-solid fa-gears"></i> Pengaturan</a>
                <a href="#" onclick="handleLogout()"><i class="fa-solid fa-right-from-bracket"></i> Keluar</a>
            </div>
        </div>
    </div>
</div>