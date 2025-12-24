// ======================================================
//   MAIN JS – BERANDA MPP SUKOHARJO
//   Semua animasi & fungsi sudah tersusun rapi
// ======================================================
(function () {

    // ============================
    // SET CURRENT YEAR
    // ============================
    const yearEl = document.getElementById("year");
    if (yearEl) yearEl.textContent = new Date().getFullYear();



    // ============================
    // WORD-BY-WORD ANIMATION
    // ============================
    function animateTextByWords(elementId, text, delay = 150) {
        const element = document.getElementById(elementId);
        if (!element) return;

        const words = text.trim().split(/\s+/);

        element.innerHTML = "";

        const colorRules = {
            heroTitle: {
                white: ["Mal", "Pelayanan", "Publik", "Kabupaten", "Sukoharjo"],
                red: []
            },
            slide2Title: {
                white: ["Pojok", "Baca", "MPP", "Sukoharjo"],
                red: []
            },
            slide3Title: {
                white: ["Pojok", "Bermain", "Anak", "MPP","Sukoharjo"],
                red: []
            }
        };

        words.forEach((word, index) => {
            const span = document.createElement("span");
            span.className = "animated-word";
            span.textContent = word;

            // coloring rules
            if (colorRules[elementId]) {
                if (colorRules[elementId].white.includes(word)) span.style.color = "#fff";
                if (colorRules[elementId].red.includes(word)) span.style.color = "#C41212";
            }

            element.appendChild(span);
            if (index < words.length - 1) element.appendChild(document.createTextNode(" "));
        });

        const wordElements = element.querySelectorAll(".animated-word");

        wordElements.forEach((w, i) => {
            setTimeout(() => w.classList.add("show"), delay * i);
        });
    }



    // ============================
    // CAROUSEL SLIDE ANIMATION
    // ============================
    function animateSlide(slideIndex) {
        if (slideIndex === 0) {
            setTimeout(() => animateTextByWords("heroTitle", "Mal Pelayanan Publik Kabupaten Sukoharjo"), 300);
            setTimeout(() => animateTextByWords("heroSubtitle", "Pelayanan Cepat, Transparan, Nyaman untuk Warga Sukoharjo"), 1500);
        }

        if (slideIndex === 1) {
            setTimeout(() => animateTextByWords("slide2Title", "Pojok Baca MPP Sukoharjo"), 300);
            setTimeout(() => animateTextByWords("slide2Subtitle", "Ruang baca nyaman dengan koleksi buku lengkap"), 1000);
        }

        if (slideIndex === 2) {
            setTimeout(() => animateTextByWords("slide3Title", "Pojok Bermain Anak MPP Sukoharjo"), 300);
            setTimeout(() => animateTextByWords("slide3Subtitle", "Tempat bermain anak ramah dan edukatif di area MPP"), 1200);
        }
    }

    window.addEventListener("load", () => {
        animateSlide(0);

        const carousel = document.getElementById("heroCarousel");
        if (carousel) {
            carousel.addEventListener("slid.bs.carousel", e => animateSlide(e.to));
        }
    });



    // ============================
    // BACK TO TOP BUTTON
    // ============================
    const backToTopBtn = document.getElementById("backToTop");

    if (backToTopBtn) {
        window.addEventListener("scroll", () => {
            backToTopBtn.classList.toggle("show", window.pageYOffset > 300);
        });

        backToTopBtn.addEventListener("click", () => {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    }



    // ============================
    // NAVBAR ACTIVE (Scroll Spy)
    // ============================
    const navLinks = document.querySelectorAll(".navbar-nav .nav-link");
    const sections = document.querySelectorAll("section[id]");

    window.addEventListener("scroll", () => {
        let current = "";

        sections.forEach(sec => {
            const top = sec.offsetTop - 120;
            const height = sec.offsetHeight;

            if (window.pageYOffset >= top && window.pageYOffset < top + height) {
                current = sec.getAttribute("id");
            }
        });

        navLinks.forEach(link => {
            const href = link.getAttribute("href");
            if (href.startsWith("#")) {
                link.classList.toggle("active", href === "#" + current);
            }
        });
    });


    // ============================
    // QUICK ACTION BUTTONS (fade from side)
    // ============================
    const animatedCards = document.querySelectorAll(".fade-slide, .fade-slide-left");

    function showOnScroll() {
        const trigger = window.innerHeight * 0.85;

        animatedCards.forEach((el) => {
            if (el.getBoundingClientRect().top < trigger) {
                el.classList.add("visible");
            }
        });
    }

    window.addEventListener("scroll", showOnScroll);
    showOnScroll();



    // ============================
    // PROFIL + VISI MISI FADE ANIMATION
    // ============================
    const fadeUpElements = document.querySelectorAll(".fade-up");

    function fadeUpScroll() {
        fadeUpElements.forEach(el => {
            const trigger = window.innerHeight * 0.85;

            if (el.getBoundingClientRect().top < trigger) {
                el.classList.add("visible");
            }
        });
    }

    window.addEventListener("scroll", fadeUpScroll);
    fadeUpScroll();

    // ============================
    // MANFAAT MPP – TITLE + ITEMS + BUTTON
    // ============================
    const manfaatTitle = document.querySelector(".fade-up-title");
    const manfaatItems = document.querySelectorAll(".fade-up-item");
    const manfaatMore = document.querySelector(".fade-up-more");  // tombol selengkapnya

    function animateManfaat() {
        if (!manfaatTitle) return;

        const trigger = window.innerHeight * 0.85;

        if (manfaatTitle.getBoundingClientRect().top < trigger) {

            // 1) Judul
            manfaatTitle.classList.add("visible");

            // 2) Item satu per satu
            manfaatItems.forEach((item, i) => {
                setTimeout(() => item.classList.add("visible"), 200 * (i + 1));
            });

            // 3) Tombol Selengkapnya
            if (manfaatMore) {
                const totalDelay = 200 * (manfaatItems.length + 1);
                setTimeout(() => manfaatMore.classList.add("visible"), totalDelay);
            }

            window.removeEventListener("scroll", animateManfaat);
        }
    }

    window.addEventListener("scroll", animateManfaat);
    animateManfaat();
// ============================
// INSTANSI TERGABUNG – ANIMATION
// ============================
const instansiTitle = document.querySelector(".fade-up-instansi-title");
const instansiItems = document.querySelectorAll(".fade-instansi-item");
const instansiMore = document.querySelector(".fade-instansi-more");

function animateInstansi() {
    if (!instansiTitle) return;

    const trigger = window.innerHeight * 0.85;

    if (instansiTitle.getBoundingClientRect().top < trigger) {

        // 1) Judul
        instansiTitle.classList.add("visible");

        // 2) Card Instansi satu per satu
        instansiItems.forEach((item, i) => {
            setTimeout(() => item.classList.add("visible"), 150 * (i + 1));
        });

        // 3) Tombol Lihat Semua Instansi
        if (instansiMore) {
            const delay = 150 * (instansiItems.length + 1);
            setTimeout(() => instansiMore.classList.add("visible"), delay);
        }

        window.removeEventListener("scroll", animateInstansi);
    }
}

window.addEventListener("scroll", animateInstansi);
animateInstansi();

    // ============================
    // FIX — LOCK BERANDA ACTIVE
    // ============================
    const path = window.location.pathname;
    if (path.includes("beranda.html") || path.includes("index.html") || path.endsWith("/")) {
        const link = document.querySelector('a[href="beranda.html"]');
        if (link) link.classList.add("active");
    }

})();

