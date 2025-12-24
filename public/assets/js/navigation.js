// Navigation Script for MPP Sukoharjo
// Manual JavaScript for button navigation

document.addEventListener('DOMContentLoaded', function() {
    // Get all navigation buttons
    const berandaBtn = document.querySelector('[data-nav="beranda"]');
    const profileBtn = document.querySelector('[data-nav="profile"]');
    const instansiBtn = document.querySelector('[data-nav="instansi"]');
    const skmBtn = document.querySelector('[data-nav="skm"]');
    
    // Add click event listeners
    if (berandaBtn) {
        berandaBtn.addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = '/';
        });
    }
    
    if (profileBtn) {
        profileBtn.addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = '/profile';
        });
    }
    
    if (instansiBtn) {
        instansiBtn.addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = '/instansi';
        });
    }
    
    if (skmBtn) {
        skmBtn.addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = '/skm';
        });
    }
    
    // Highlight active navigation
    function highlightActiveNav() {
        const currentPath = window.location.pathname;
        const navButtons = document.querySelectorAll('[data-nav]');
        
        navButtons.forEach(button => {
            button.classList.remove('active');
            const navPath = button.getAttribute('data-nav');
            
            if ((currentPath === '/' && navPath === 'beranda') ||
                (currentPath === '/profile' && navPath === 'profile') ||
                (currentPath === '/instansi' && navPath === 'instansi') ||
                (currentPath === '/skm' && navPath === 'skm')) {
                button.classList.add('active');
            }
        });
    }
    
    highlightActiveNav();
});

// Smooth page transitions
function smoothNavigate(url) {
    document.body.style.opacity = '0';
    setTimeout(() => {
        window.location.href = url;
    }, 300);
}