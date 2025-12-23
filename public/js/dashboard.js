// public/js/dashboard.js
// DAFTAR INSTANSI
const instansiNames = [
    "Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu (DPMPTSP) Prov. Jawa Tengah",
    "Unit Pelaksana Teknis Badan Pelindungan Pekerja Migran Indonesia (UPT BP2MI) Kota Semarang",
    "Unit Pengelolaan Pendapatan Daerah (UPPD) Kab. Sukoharjo",
    "Polres Sukoharjo",
    "Kejaksaan Negeri Sukoharjo",
    "Kementerian Agama Kab. Sukoharjo",
    "Pengadilan Negeri Sukoharjo Kelas IA",
    "Pengadilan Agama Kab. Sukoharjo",
    "Kantor Pajak Pratama (KPP) Kab. Sukoharjo",
    "Loka POM Surakarta",
    "PT Taspen",
    "BPJS Kesehatan",
    "BPJS Ketenagakerjaan",
    "Kantor Pertanahan Kab. Sukoharjo",
    "Dinas Kesehatan Kab. Sukoharjo",
    "Dinas Perdagangan, Koperasi Usaha Kecil dan Menengah Kab. Sukoharjo",
    "Dinas Pekerjaan Umum dan Penataan Ruang Kab. Sukoharjo",
    "Dinas Lingkungan Hidup Kab. Sukoharjo",
    "Dinas Kependudukan dan Pencatatan Sipil Kab. Sukoharjo",
    "Badan Keuangan Daerah (BKD) Kab. Sukoharjo",
    "Dinas Sosial Kab. Sukoharjo",
    "Dinas Pendidikan dan Kebudayaan Kab. Sukoharjo",
    "Badan Kesatuan Bangsa dan Politik",
    "Dinas Kearsipan dan Perpustakaan Kab. Sukoharjo",
    "Dinas Perhubungan Kab. Sukoharjo",
    "Dinas Perindustrian dan Tenaga Kerja Kab. Sukoharjo",
    "Dinas Pengendalian Penduduk Keluarga Berencana dan Pemberdayaan Perempuan dan Perlindungan Anak (DPPKBP3A) Kab. Sukoharjo",
    "Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu (DPMPTSP) Kab. Sukoharjo",
    "Bank Jateng Cabang Sukoharjo",
    "BRI",
    "Bank Sukoharjo",
    "PDAM Tirta Makmur",
    "PT. Pegadaian"
];

// Data Mapping URL Instansi untuk tombol aksi (Menggunakan URL placeholder untuk Laravel)
const instansiLinks = {
    "Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu (DPMPTSP) Prov. Jawa Tengah": "/instansi/detail-dpmptsp-prov-jawa-tengah",
    "Unit Pelaksana Teknis Badan Pelindungan Pekerja Migran Indonesia (UPT BP2MI) Kota Semarang": "/instansi/detail-upt-bp2mi-semarang",
    "Unit Pengelolaan Pendapatan Daerah (UPPD) Kab. Sukoharjo": "/instansi/detail-uppd-sukoharjo",
    "Polres Sukoharjo": "/instansi/detail-polres",
    "Kejaksaan Negeri Sukoharjo": "/instansi/detail-kejaksaan",
    "Kementerian Agama Kab. Sukoharjo": "/instansi/detail-kemenag",
    "Pengadilan Negeri Sukoharjo Kelas IA": "/instansi/detail-pengadilan-negeri",
    "Pengadilan Agama Kab. Sukoharjo": "/instansi/detail-pengadilan-agama",
    "Kantor Pajak Pratama (KPP) Kab. Sukoharjo": "/instansi/detail-kpp",
    "Loka POM Surakarta": "/instansi/detail-loka-pom",
    "PT Taspen": "/instansi/detail-taspen",
    "BPJS Kesehatan": "/instansi/detail-bpjs-kesehatan",
    "BPJS Ketenagakerjaan": "/instansi/detail-bpjs-ketenagakerjaan",
    "Kantor Pertanahan Kab. Sukoharjo": "/instansi/detail-kantor-pertanahan",
    "Dinas Kesehatan Kab. Sukoharjo": "/instansi/detail-dinkes",
    "Dinas Perdagangan, Koperasi Usaha Kecil dan Menengah Kab. Sukoharjo": "/instansi/detail-disdagkop-ukm",
    "Dinas Pekerjaan Umum dan Penataan Ruang Kab. Sukoharjo": "/instansi/detail-dpupr",
    "Dinas Lingkungan Hidup Kab. Sukoharjo": "/instansi/detail-dlh",
    "Dinas Kependudukan dan Pencatatan Sipil Kab. Sukoharjo": "/instansi/detail-disdukcapil",
    "Badan Keuangan Daerah (BKD) Kab. Sukoharjo": "/instansi/detail-bkd",
    "Dinas Sosial Kab. Sukoharjo": "/instansi/detail-dinsos",
    "Dinas Pendidikan dan Kebudayaan Kab. Sukoharjo": "/instansi/detail-dikbud",
    "Badan Kesatuan Bangsa dan Politik": "/instansi/detail-bakesbangpol",
    "Dinas Kearsipan dan Perpustakaan Kab. Sukoharjo": "/instansi/detail-dinarpus",
    "Dinas Perhubungan Kab. Sukoharjo": "/instansi/detail-dishub",
    "Dinas Perindustrian dan Tenaga Kerja Kab. Sukoharjo": "/instansi/detail-disperinaker",
    "Dinas Pengendalian Penduduk Keluarga Berencana dan Pemberdayaan Perempuan dan Perlindungan Anak (DPPKBP3A) Kab. Sukoharjo": "/instansi/detail-dppkbp3a",
    "Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu (DPMPTSP) Kab. Sukoharjo": "/instansi/detail-dpmptsp",
    "Bank Jateng Cabang Sukoharjo": "/instansi/detail-bank-jateng",
    "BRI": "/instansi/detail-bri",
    "Bank Sukoharjo": "/instansi/detail-bank-sukoharjo",
    "PDAM Tirta Makmur": "/instansi/detail-pdam",
    "PT. Pegadaian": "/instansi/detail-pegadaian"
};

// Global Data Setup
const createInstansiList = (names) => names.map((name, index) => ({
    id: index + 1,
    nama: name,
    layanan: Math.floor(Math.random() * 14) + 2,
    status: 'Aktif'
}));

const baseInstansiList = createInstansiList(instansiNames);
let instansiList = [...baseInstansiList];
const rowsPerPage = 5;
let currentPage = 1;

// Data Notifikasi Simulasi
const notificationData = [
    { id: 1, avatarClass: "notif-avatar-1", icon: "fa-user", text: "Admin Utama memperbarui Instansi", time: "2 jam lalu", read: false }, // Belum dibaca
    { id: 2, avatarClass: "notif-avatar-2", icon: "fa-bell", text: "Pengaduan dari masyarakat telah ditindak lanjuti", time: "2 jam lalu", read: true },
    { id: 3, avatarClass: "notif-avatar-3", icon: "fa-user", text: "Admin DPMPTSP login", time: "3 jam lalu", read: false }, // Belum dibaca
    { id: 4, avatarClass: "notif-avatar-1", icon: "fa-building", text: "Instansi baru (BPJS) telah ditambahkan", time: "1 hari lalu", read: true },
    { id: 5, avatarClass: "notif-avatar-2", icon: "fa-comments", text: "Ada 3 masukan baru dari masyarakat", time: "1 hari lalu", read: false }, // Belum dibaca
];

// Data Jadwal Pelayanan
let serviceSchedule = {
    "senin": "08.00 - 15.00",
    "selasa": "08.00 - 15.00",
    "rabu": "08.00 - 15.00",
    "kamis": "08.00 - 15.00",
    "jumat": "08.00 - 14.00",
    "weekend": "Tutup"
};

// ===================================================
// UTILITY FUNCTIONS
// ===================================================

/**
 * Utility to escape HTML for safety in alerts/injection
 * @param {string} unsafe 
 * @returns {string}
 */
function escapeHtml(unsafe) {
    return String(unsafe)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

/**
 * Updates the digital clock in the sidebar footer.
 */
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

/**
 * Handles the logout process. Redirects to the login page.
 */
window.handleLogout = function() {
    // PENTING: Lakukan semua proses pembersihan sesi/token di sini jika menggunakan localStorage/sessionStorage.
    // Contoh: localStorage.removeItem('userToken');

    // Mengarahkan ke halaman login dan mengganti entri di history. (Asumsi rute login.html)
    window.location.replace('/log-in.html');
}

// ===================================================
// NOTIFICATION & ASIDE FUNCTIONS
// ===================================================

/**
 * Updates the visual notification badge count.
 * @param {number} count 
 */
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

/**
 * Checks localStorage for unread notification count and updates the badge.
 */
function checkNotifications() {
    let unreadCount = parseInt(localStorage.getItem('unreadNotificationCount'));

    if (isNaN(unreadCount) || unreadCount === null) {
        const initialUnread = notificationData.filter(n => !n.read).length;
        unreadCount = initialUnread;
        localStorage.setItem('unreadNotificationCount', unreadCount.toString());
    }

    updateNotificationBadge(unreadCount);
}

/**
 * Toggles the visibility of the notification dropdown.
 * @param {Event} event 
 */
window.toggleNotificationDropdown = function(event) {
    event.stopPropagation();
    const dropdown = document.getElementById('notificationDropdown');
    const isShowing = dropdown.style.display === 'block';

    if (isShowing) {
        dropdown.style.display = 'none';
    } else {
        dropdown.style.display = 'block';
        renderDropdownNotifications();
    }
}

/**
 * Renders the top 3 notifications in the dropdown.
 */
function renderDropdownNotifications() {
    const ul = document.getElementById('dropdownNotificationList');
    if (!ul) return;

    const topNotifications = notificationData.slice(0, 3);
    ul.innerHTML = '';

    if (topNotifications.length === 0) {
        ul.innerHTML = '<li><div class="notif-text" style="padding: 10px 0; color: var(--muted);">Tidak ada notifikasi terbaru.</div></li>';
        return;
    }

    topNotifications.forEach(n => {
        const li = document.createElement('li');
        li.classList.add('notification-item');
        // Navigasi ke halaman notifikasi.html dengan parameter ID
        li.onclick = () => {
            markAllAsReadAndNavigate(false); // Tandai sudah dibaca tapi JANGAN navigasi
            window.location.href = '/notifikasi.html?id=' + n.id; // Asumsi rute notifikasi
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

/**
 * Renders the top 5 activities in the dashboard aside.
 */
function renderNotifications() {
    const ul = document.getElementById('notificationList');
    if (!ul) return;
    ul.innerHTML = '';

    const latestNotifications = notificationData.slice(0, 5);

    latestNotifications.forEach(n => {
        const li = document.createElement('li');
        li.classList.add('notification-item');
        li.innerHTML = `
        <div class="notification-avatar ${n.avatarClass}">
          <i class="fa-solid ${n.icon} notif-icon"></i>
        </div>
        <div class="notif-text">${escapeHtml(n.text)}</div>
        <div class="notif-time">${escapeHtml(n.time)}</div>`;
        ul.appendChild(li);
    });
}

/**
 * Resets notification count and optionally navigates to the notifications page.
 * @param {boolean} doNavigate - Whether to navigate after marking as read.
 */
window.markAllAsReadAndNavigate = function(doNavigate = true) {
    localStorage.setItem('unreadNotificationCount', '0');
    updateNotificationBadge(0);

    const dropdown = document.getElementById('notificationDropdown');
    if (dropdown) dropdown.style.display = 'none';

    if (doNavigate) {
        window.location.href = '/notifikasi.html'; // Asumsi rute notifikasi
    }
}

// ===================================================
// INSTANSI TABLE & CRUD FUNCTIONS
// ===================================================

/**
 * Renders the main Instansi table and its pagination.
 */
function renderDashboardList() {
    const tbody = document.querySelector('#tableInstansiDashboard tbody');
    if (!tbody) return;
    const start = (currentPage - 1) * rowsPerPage;
    const paginated = instansiList.slice(start, start + rowsPerPage);
    tbody.innerHTML = '';

    // Render rows
    paginated.forEach((r) => {
        const tr = document.createElement('tr');
        const statusClass = r.status === 'Aktif' ? 'status-aktif' : '';
        const detailHref = instansiLinks[r.nama] || '#';
        tr.innerHTML = `
        <td>${r.nama}</td>
        <td style="text-align:center;">${r.layanan}</td>
        <td style="text-align:center;"><button class="status-btn ${statusClass}">${r.status}</button></td>
        <td style="text-align:center;">
            <div class="actions">
                <a href="${detailHref}" class="btn edit" title="Lihat Detail/Edit Instansi"><i class="fa-solid fa-pen"></i></a>
                <button class="btn delete" title="Hapus" onclick="deleteInstansi(${r.id}, '${escapeHtml(r.nama)}')"><i class="fa-solid fa-trash"></i></button>
            </div>
        </td>`;
        tbody.appendChild(tr);
    });

    // Fill empty rows so table height consistent
    const emptyRowsCount = rowsPerPage - paginated.length;
    for (let i = 0; i < emptyRowsCount; i++) {
        const tr = document.createElement('tr');
        tr.innerHTML = '<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>';
        tbody.appendChild(tr);
    }

    // Update total instansi count
    const totalInstEl = document.getElementById('totalInstansi');
    if (totalInstEl) totalInstEl.textContent = instansiList.length;

    renderPagination();
}

/**
 * Renders the pagination controls for the Instansi table.
 */
function renderPagination() {
    const totalPages = Math.ceil(instansiList.length / rowsPerPage) || 1;
    const p = document.getElementById('pagination');
    if (!p) return;
    p.innerHTML = '';

    // Prev
    const prev = document.createElement('button');
    prev.textContent = '«';
    prev.disabled = currentPage === 1;
    prev.onclick = () => {
        if (currentPage > 1) {
            currentPage--;
            renderDashboardList();
        }
    };
    p.appendChild(prev);

    // Page numbers
    for (let i = 1; i <= totalPages; i++) {
        const b = document.createElement('button');
        b.textContent = i;
        if (i === currentPage) b.classList.add('active');
        b.onclick = () => {
            currentPage = i;
            renderDashboardList();
        };
        p.appendChild(b);
    }

    // Next
    const next = document.createElement('button');
    next.textContent = '»';
    next.disabled = currentPage === totalPages;
    next.onclick = () => {
        if (currentPage < totalPages) {
            currentPage++;
            renderDashboardList();
        }
    };
    p.appendChild(next);
}

/**
 * Opens the Add Instansi modal.
 */
window.openAddModal = function() {
    const modal = document.getElementById('modal');
    if (!modal) return;
    document.getElementById('modalTitle').textContent = 'Tambah Instansi';
    document.getElementById('instName').value = '';
    document.getElementById('instServices').value = '';
    document.getElementById('instStatus').value = 'Aktif';

    modal.style.display = 'flex';
    modal.classList.add('open');
}

/**
 * Closes the Add Instansi modal.
 * @param {Event | null} event 
 */
window.closeModal = function(event) {
    const modal = document.getElementById('modal');
    if (!modal) return;
    // Cek jika klik berasal dari backdrop
    const isBackdropClick = event && event.target && event.target.id === 'modal';
    // Cek jika dipanggil tanpa event (misal dari tombol Batal atau Escape)
    const isNoEventCall = !event;

    if (isBackdropClick || isNoEventCall) {
        modal.classList.remove('open');
        setTimeout(() => {
            modal.style.display = 'none';
        }, 200);
    }
}

/**
 * Saves a new Instansi to the list. (Simulation)
 */
window.saveInstansi = function() {
    const nameEl = document.getElementById('instName');
    const servicesEl = document.getElementById('instServices');
    const statusEl = document.getElementById('instStatus');
    if (!nameEl || !servicesEl || !statusEl) return;

    const name = nameEl.value.trim();
    const services = parseInt(servicesEl.value) || 1;
    const status = statusEl.value;
    if (!name) {
        alert('Nama instansi harus diisi');
        return;
    }

    // Buat ID baru yang unik
    const nid = baseInstansiList.length ? baseInstansiList[baseInstansiList.length - 1].id + 1 : 1;
    const newInstansi = { id: nid, nama: name, layanan: services, status };

    baseInstansiList.push(newInstansi);
    instansiList.unshift(newInstansi); // Tampilkan di paling atas

    closeModal();
    currentPage = 1;
    renderDashboardList();
    alert(`Instansi "${name}" berhasil ditambahkan!`);
}

/**
 * Deletes an Instansi. (Simulation)
 * @param {number} id - The ID of the instansi to delete.
 * @param {string} name - The name of the instansi (for confirmation message).
 */
window.deleteInstansi = function(id, name) {
    if (confirm(`Apakah Anda yakin ingin menghapus Instansi "${name}"? Tindakan ini tidak dapat dibatalkan.`)) {

        // 1. Hapus dari baseInstansiList (data master)
        const baseIndex = baseInstansiList.findIndex(inst => inst.id === id);
        if (baseIndex > -1) {
            baseInstansiList.splice(baseIndex, 1);
        }

        // 2. Hapus dari instansiList (data yang ditampilkan/difilter saat ini)
        const filteredIndex = instansiList.findIndex(inst => inst.id === id);
        if (filteredIndex > -1) {
            instansiList.splice(filteredIndex, 1);
        }

        // 3. Perbarui tampilan
        renderDashboardList();

        // 4. Perbarui total instansi di kartu dashboard
        const totalInstEl = document.getElementById('totalInstansi');
        if (totalInstEl) totalInstEl.textContent = baseInstansiList.length;

        alert(`Instansi "${name}" berhasil dihapus.`);
    }
}


// ===================================================
// SCHEDULE MODAL FUNCTIONS
// ===================================================

/**
 * Renders the schedule table on the dashboard.
 */
function renderScheduleTable() {
    const scheduleKeys = Object.keys(serviceSchedule);
    scheduleKeys.forEach(day => {
        const el = document.getElementById(`schedule-${day}`);
        if (el) {
            el.textContent = serviceSchedule[day];
        }
    });
}

/**
 * Opens the Edit Schedule modal and populates the form.
 */
window.openEditScheduleModal = function() {
    const modal = document.getElementById('editScheduleModal');
    const formContent = document.getElementById('scheduleFormContent');
    if (!modal || !formContent) return;

    let htmlContent = '';
    const orderedDays = ["senin", "selasa", "rabu", "kamis", "jumat", "weekend"];

    orderedDays.forEach(day => {
        const dayDisplay = day.charAt(0).toUpperCase() + day.slice(1);
        const labelText = day === 'weekend' ? 'Sabtu, Minggu' : dayDisplay;

        htmlContent += `
        <div class="schedule-form-row">
          <label for="schedule-input-${day}">${labelText}</label>
          <input type="text" id="schedule-input-${day}" value="${escapeHtml(serviceSchedule[day])}" placeholder="Contoh: 08.00 - 15.00 atau Tutup" />
        </div>`;
    });

    formContent.innerHTML = htmlContent;

    modal.style.display = 'flex';
    modal.classList.add('open');
}

/**
 * Closes the Edit Schedule modal.
 * @param {Event | null} event 
 */
window.closeScheduleModal = function(event) {
    const modal = document.getElementById('editScheduleModal');
    if (!modal) return;

    const isBackdropClick = event && event.target && event.target.id === 'editScheduleModal';
    const isNoEventCall = !event;

    if (isBackdropClick || isNoEventCall) {
        modal.classList.remove('open');
        setTimeout(() => {
            modal.style.display = 'none';
        }, 200);
    }
}

/**
 * Saves the updated service schedule. (Simulation)
 */
window.saveSchedule = function() {
    let updated = false;
    const newSchedule = {};

    for (const day in serviceSchedule) {
        const input = document.getElementById(`schedule-input-${day}`);
        if (input && input.value.trim() !== serviceSchedule[day]) {
            newSchedule[day] = input.value.trim();
            updated = true;
        } else if (input) {
            newSchedule[day] = serviceSchedule[day];
        }
    }

    if (updated) {
        serviceSchedule = newSchedule;
        renderScheduleTable();
        alert('Jadwal pelayanan berhasil diperbarui!');
    } else {
        alert('Tidak ada perubahan pada jadwal.');
    }

    closeScheduleModal();
}

// ===================================================
// CHART & EXPORT FUNCTIONS
// ===================================================

/**
 * Initializes the Chart.js graph for Layanan data.
 * @param {HTMLCanvasElement} ctx 
 */
function initChart(ctx) {
    if (!ctx) return;
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul'],
            datasets: [
                {
                    label: 'Permintaan Layanan',
                    data: [5, 10, 15, 8, 12, 18, 10],
                    backgroundColor: '#1a73e8',
                    borderRadius: 6,
                    barPercentage: 0.8,
                    categoryPercentage: 0.8
                },
                {
                    label: 'Layanan Selesai',
                    data: [4, 9, 14, 7, 11, 17, 9],
                    backgroundColor: '#6b9cf1',
                    borderRadius: 6,
                    barPercentage: 0.8,
                    categoryPercentage: 0.8
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'top', display: true },
                title: { display: false }
            },
            scales: {
                x: { stacked: false },
                y: { beginAtZero: true, max: 20, ticks: { stepSize: 5 } }
            }
        }
    });
}

/**
 * Exports the Instansi data in the selected format.
 */
window.exportInstansiData = function() {
    const type = document.getElementById("exportType").value;

    const listToExport = instansiList;
    const headers = ["Nama Instansi", "Jumlah Layanan", "Status"];
    const rows = listToExport.map(n => [n.nama, n.layanan, n.status]);
    const data = [headers, ...rows];
    const filename = "data_instansi_" + new Date().toISOString().slice(0, 10);

    if (type === "csv") {
        const csv = data.map(r => r.join(";")).join("\n");
        const blob = new Blob([csv], { type: "text/csv;charset=utf-8;" });
        saveAs(blob, filename + ".csv");

    } else if (type === "xlsx") {
        const wb = XLSX.utils.book_new();
        const ws = XLSX.utils.aoa_to_sheet(data);
        XLSX.utils.book_append_sheet(wb, ws, "Instansi");
        XLSX.writeFile(wb, filename + ".xlsx");

    } else if (type === "pdf") {
        const {
            jsPDF
        } = window.jspdf;
        const doc = new jsPDF();

        doc.setFontSize(14);
        doc.text("Laporan Data Instansi Aktif", 14, 20);

        doc.autoTable({
            head: [headers],
            body: rows,
            startY: 25,
            styles: {
                fontSize: 10,
                cellPadding: 3
            },
            headStyles: {
                fillColor: [26, 115, 232]
            }
        });

        doc.save(filename + ".pdf");

    } else if (type === "word") {
        let tableHtml = '<html><head><meta charset="utf-8"></head><body>';
        tableHtml += '<h2>Laporan Data Instansi Aktif</h2>';
        tableHtml += '<table border="1" style="border-collapse: collapse; width: 100%;">';

        // Header
        tableHtml += '<thead><tr style="background-color: #f0f0f0;">';
        headers.forEach(h => tableHtml += `<th style="padding: 8px;">${h}</th>`);
        tableHtml += '</tr></thead>';

        // Body
        rows.forEach(row => {
            tableHtml += '<tr>';
            row.forEach(cell => tableHtml += `<td style="padding: 8px;">${cell}</td>`);
            tableHtml += '</tr>';
        });
        tableHtml += '</tbody></table></body></html>';

        const blob = new Blob(['\ufeff', tableHtml], {
            type: 'application/msword'
        });

        saveAs(blob, filename + ".doc");

    } else {
        alert(`Export ke format ${type.toUpperCase()} belum didukung.`);
    }
}

// ===================================================
// INITIALIZATION AND EVENT LISTENERS
// ===================================================

document.addEventListener('DOMContentLoaded', function() {
    updateClock();
    setInterval(updateClock, 1000); // Realtime clock

    // Set total instansi display
    const totalInstEl = document.getElementById('totalInstansi');
    if (totalInstEl) totalInstEl.textContent = instansiList.length;

    // Chart Setup
    initChart(document.getElementById('chartLayanan'));

    // Render table, notifications, and schedule
    renderDashboardList();
    renderNotifications();
    renderScheduleTable();

    // Initialize notification badge
    checkNotifications();

    // Search and Clear Search functionality
    const searchInput = document.getElementById('searchInput');
    const clearSearch = document.getElementById('clearSearch');

    if (searchInput) {
        // Listener Pencarian (Fungsi Search)
        searchInput.addEventListener('input', e => {
            const q = e.target.value.toLowerCase();
            // Logika filtering data
            instansiList = baseInstansiList.filter(r => r.nama.toLowerCase().includes(q) || String(r.layanan).includes(q));
            currentPage = 1;
            renderDashboardList();
            // Tampilkan/Sembunyikan tombol clear
            if (clearSearch) {
                clearSearch.style.display = q ? "block" : "none";
            }
        });
    }

    if (clearSearch) {
        // Listener Membersihkan Pencarian (Fungsi Clear Search)
        clearSearch.addEventListener("click", () => {
            searchInput.value = ""; // Membersihkan input field
            instansiList = [...baseInstansiList]; // Mengembalikan ke daftar lengkap
            currentPage = 1;
            renderDashboardList();
            clearSearch.style.display = "none"; // Sembunyikan tombol
        });
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('notificationDropdown');
        // Mendapatkan tombol notifikasi, yang merupakan icon-btn pertama di dalam topbar-icons
        const iconBtn = document.querySelector('.topbar-icons .icon-btn:first-child'); 

        if (dropdown && dropdown.style.display === 'block' &&
            iconBtn && !iconBtn.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.style.display = 'none';
        }
    });

    // Close modal when pressing Escape (untuk kedua modal)
    document.addEventListener('keydown', (ev) => {
        if (ev.key === 'Escape') {
            const modalInstansi = document.getElementById('modal');
            const modalJadwal = document.getElementById('editScheduleModal');
            if (modalInstansi && modalInstansi.classList.contains('open')) closeModal();
            if (modalJadwal && modalJadwal.classList.contains('open')) closeScheduleModal();
        }
    });
});