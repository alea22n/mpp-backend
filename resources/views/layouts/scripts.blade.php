<script>
  // Data Simulasi (diubah sesuai konteks Dashboard Admin Utama)
  const notificationData = [
    { id: 1, avatarClass: "notif-avatar-2", icon: "fa-triangle-exclamation", text: "Pengaduan baru masuk: 'Layanan lambat' (DPMPTSP)", time: "10 menit lalu", read: false },
    { id: 2, avatarClass: "notif-avatar-3", icon: "fa-user-clock", text: "Admin Instansi (Disdukcapil) merespons pengaduan", time: "25 menit lalu", read: true },
    { id: 3, avatarClass: "notif-avatar-1", icon: "fa-list-check", text: "Admin Instansi (DPMPTSP) menyelesaikan pengaduan", time: "3 jam lalu", read: false },
    { id: 4, avatarClass: "notif-avatar-4", icon: "fa-comments", text: "Pengaduan No. #P002 telah diselesaikan", time: "1 hari lalu", read: true },
  ];

  // Data Simulasi Utama untuk Grafik
  const dataLayanan = {
    bulan: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
    antrian: [4500, 4800, 5200, 5000, 5500, 5800, 6100, 6050, 6300, 6500, 6800, 7000],
    pengaduan: [15, 12, 18, 14, 20, 16, 22, 19, 25, 21, 28, 30],
    kepuasan: [85, 87, 88, 86, 89, 90, 91, 90, 92, 93, 94, 95],
  };

  const dataInstansi = [
    { instansi: 'DPMPTSP', layanan: 1250, pengaduan: 10, rating: 4.8 },
    { instansi: 'Disdukcapil', layanan: 980, pengaduan: 5, rating: 4.5 },
    { instansi: 'Samsat', layanan: 850, pengaduan: 3, rating: 4.9 },
    { instansi: 'Dinas Sosial', layanan: 620, pengaduan: 1, rating: 4.6 },
    { instansi: 'BPJS', layanan: 550, pengaduan: 2, rating: 4.7 }
  ];

  // --- FUNGSI CHART.JS ---

  function createChart(ctxId, type, dataLabels, dataValues, chartLabel, color, isPercentage = false) {
    const ctx = document.getElementById(ctxId).getContext('2d');
    
    // Hapus instance chart lama jika ada
    if (window[ctxId + 'Chart']) {
        window[ctxId + 'Chart'].destroy();
    }

    window[ctxId + 'Chart'] = new Chart(ctx, {
      type: type,
      data: {
        labels: dataLabels,
        datasets: [{
          label: chartLabel,
          data: dataValues,
          backgroundColor: color,
          borderColor: color,
          borderWidth: 1,
          fill: type === 'line' ? true : false,
          tension: 0.3 // Untuk garis yang lebih smooth
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              callback: function(value) {
                return isPercentage ? value + '%' : value;
              }
            }
          }
        },
        plugins: {
          legend: {
            display: type === 'line' ? false : true // Sembunyikan legenda untuk line chart
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                let label = context.dataset.label || '';
                if (label) {
                  label += ': ';
                }
                if (context.parsed.y !== null) {
                  label += new Intl.NumberFormat('id-ID', { maximumSignificantDigits: 3 }).format(context.parsed.y);
                  if (isPercentage) label += '%';
                }
                return label;
              }
            }
          }
        }
      }
    });
  }

  // Fungsi untuk merender semua chart
  function renderAllCharts() {
    // 1. Chart Layanan Bulanan (Line Chart)
    createChart('layananChart', 'line', dataLayanan.bulan, dataLayanan.antrian, 'Jumlah Layanan Bulanan', 'rgba(26, 115, 232, 0.7)');

    // 2. Chart Pengaduan Bulanan (Bar Chart)
    createChart('pengaduanChart', 'bar', dataLayanan.bulan, dataLayanan.pengaduan, 'Jumlah Pengaduan Bulanan', 'rgba(244, 180, 0, 0.7)');

    // 3. Chart Kepuasan (Line Chart, Persentase)
    createChart('kepuasanChart', 'line', dataLayanan.bulan, dataLayanan.kepuasan, 'Tingkat Kepuasan (%)', 'rgba(52, 168, 83, 0.7)', true);

    // 4. Chart Instansi Berdasarkan Layanan (Doughnut Chart)
    const instansiLabels = dataInstansi.map(d => d.instansi);
    const instansiLayanan = dataInstansi.map(d => d.layanan);
    const instansiColors = [
      '#1a73e8', '#fbbc04', '#34a853', '#ea4335', '#9a67ea' 
    ];

    const instansiCtx = document.getElementById('instansiChart').getContext('2d');
    if (window.instansiChartInstance) {
        window.instansiChartInstance.destroy();
    }
    window.instansiChartInstance = new Chart(instansiCtx, {
      type: 'doughnut',
      data: {
        labels: instansiLabels,
        datasets: [{
          data: instansiLayanan,
          backgroundColor: instansiColors,
          hoverOffset: 4
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'right',
            }
        }
      }
    });
  }

  // --- FUNGSI UTILITY & UI ---

  // Utility to escape HTML for safety in alerts/injection
  function escapeHtml(unsafe) {
    return String(unsafe)
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
  }
  // TANGGAL DAN JAM REALTIME
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
        // Mengisi elemen div#todayDate dengan tanggal dan waktu sistem saat ini
        dateElement.textContent = today.toLocaleDateString("id-ID", options);
    }
  }

  function handleLogout() { window.location.replace('log-in.html'); }
  
  function updateCardValues() {
    // Simulasi data kartu
    const totalLayanan = dataLayanan.antrian.reduce((a, b) => a + b, 0);
    const totalPengaduan = dataLayanan.pengaduan.reduce((a, b) => a + b, 0);
    const rataRataKepuasan = (dataLayanan.kepuasan.reduce((a, b) => a + b, 0) / dataLayanan.kepuasan.length).toFixed(1);
    const totalInstansi = dataInstansi.length;

    document.getElementById('totalLayanan').textContent = totalLayanan.toLocaleString('id-ID');
    document.getElementById('totalPengaduan').textContent = totalPengaduan.toLocaleString('id-ID');
    document.getElementById('rataRataKepuasan').textContent = `${rataRataKepuasan}%`;
    document.getElementById('totalInstansi').textContent = totalInstansi;
  }

  // --- FUNGSI NOTIFIKASI ---
  
  function updateNotificationBadge(count) { 
    const badge = document.getElementById('notifBadge'); 
    if (!badge) return; 
    
    const storedCount = localStorage.getItem('unreadNotificationCountAdmin');
    let finalCount = count;

    if (storedCount !== null) {
        finalCount = parseInt(storedCount, 10);
    } else if (count === 0 && notificationData.length > 0) {
        finalCount = notificationData.filter(n => !n.read).length;
        localStorage.setItem('unreadNotificationCountAdmin', finalCount.toString());
    }

    if (finalCount > 0) {
        badge.textContent = finalCount > 9 ? '9+' : finalCount;
        badge.style.display = 'flex';
    } else {
        badge.style.display = 'none';
    }
  }

  function renderDropdownNotifications() { 
    const ul = document.getElementById('dropdownNotificationList'); 
    if (!ul) return; 
    
    const unreadNotifications = notificationData.filter(n => !n.read);
    const topNotifications = unreadNotifications.slice(0, 3);
    
    if (topNotifications.length < 3) {
        const readNotifications = notificationData.filter(n => n.read);
        const needed = 3 - topNotifications.length;
        topNotifications.push(...readNotifications.slice(0, needed));
    }
    
    ul.innerHTML = ''; 
    
    if (notificationData.length === 0) { 
        ul.innerHTML = '<li><div class="notif-text" style="padding: 10px 0; color: var(--muted); text-align: center;">Tidak ada aktivitas terbaru.</div></li>'; 
        return; 
    } 
    
    topNotifications.forEach(n => { 
        const li = document.createElement('li'); 
        li.classList.add('notification-item'); 
        li.style.backgroundColor = '#ffffff'; 
        li.onclick = () => { markAsReadAndNavigate(n.id); } 
        
        li.innerHTML = ` 
            <div class="notification-avatar ${n.avatarClass}"> 
                <i class="fa-solid ${n.icon} notif-icon"></i> 
            </div> 
            <div class="notif-text">${escapeHtml(n.text)}</div> 
            <div class="notif-time">${escapeHtml(n.time)}</div>`; 
        ul.appendChild(li); 
    }); 
  }

  function toggleNotificationDropdown(event) {
      event.stopPropagation();
      const dropdown = document.getElementById('notificationDropdown');
      const isShowing = dropdown.style.display === 'block';
      if (isShowing) {
          dropdown.style.display = 'none';
      } else {
          renderDropdownNotifications(); 
          dropdown.style.display = 'block';
      }
  }

  function markAsReadAndNavigate(notifId) {
      const notif = notificationData.find(n => n.id === notifId);
      if (notif && !notif.read) {
          notif.read = true;
          let currentCount = parseInt(localStorage.getItem('unreadNotificationCountAdmin') || '0', 10);
          if (currentCount > 0) {
              currentCount--;
              localStorage.setItem('unreadNotificationCountAdmin', currentCount.toString());
          }
          updateNotificationBadge(currentCount); 
      }
      const dropdown = document.getElementById('notificationDropdown'); 
      if (dropdown) dropdown.style.display = 'none'; 
      // Navigasi ke halaman detail notifikasi
      window.location.href = 'aktivitas-admin.html?id=' + notifId;
  }

  function markAllAsReadAndNavigate(doNavigate = true) { 
      notificationData.forEach(n => n.read = true); 
      localStorage.setItem('unreadNotificationCountAdmin', '0'); 
      updateNotificationBadge(0); 
      const dropdown = document.getElementById('notificationDropdown'); 
      if (dropdown) dropdown.style.display = 'none'; 
      if (doNavigate) { 
          window.location.href = 'aktivitas-admin.html'; 
      } 
  }

  function checkNotifications() { 
      let storedCount = localStorage.getItem('unreadNotificationCountAdmin');
      let initialUnread = notificationData.filter(n => !n.read).length;

      if (storedCount === null) {
          localStorage.setItem('unreadNotificationCountAdmin', initialUnread.toString());
      } else {
          initialUnread = parseInt(storedCount, 10);
      }
      updateNotificationBadge(initialUnread); 
  }


  // --- INISIALISASI ---
  
  document.addEventListener('DOMContentLoaded', function() {
    
    // INISIALISASI JAM REAL-TIME & NOTIFIKASI
    updateClock();
    setInterval(updateClock, 1000);
    checkNotifications();

    // INISIALISASI CARD DAN CHART
    updateCardValues();
    renderAllCharts();


    // Menutup dropdown saat klik di luar
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('notificationDropdown');
        const iconBtn = document.querySelector('.topbar-icons button:first-child'); 
        
        if (dropdown && dropdown.style.display === 'block' && 
            iconBtn && !iconBtn.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.style.display = 'none';
        }
    });

    // Menangani perubahan ukuran layar untuk chart
    window.addEventListener('resize', renderAllCharts);
  });
</script>