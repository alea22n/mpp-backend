// Initialize components for all-instansi.html
(function(){
  // Set current year
  const yearEl = document.getElementById('year');
  if (yearEl) yearEl.textContent = new Date().getFullYear();
  
  // Agency search functionality
  const searchInput = document.getElementById('agencySearch');
  if (searchInput) {
    searchInput.addEventListener('input', function() {
      const searchTerm = this.value.toLowerCase().trim();
      
      // Get all agency cards
      const agencyCards = document.querySelectorAll('#allAgencies .agency-card');
      
      // If search term is empty, show all cards
      if (searchTerm === '') {
        agencyCards.forEach(card => {
          const parentCol = card.closest('.col-sm-6, .col-lg-3');
          if (parentCol) {
            parentCol.style.display = 'block';
          }
        });
        return;
      }
      
      // Filter cards based on search term
      agencyCards.forEach(card => {
        const agencyNameElement = card.querySelector('h5.card-title');
        if (agencyNameElement) {
          const agencyName = agencyNameElement.textContent.toLowerCase();
          const parentCol = card.closest('.col-sm-6, .col-lg-3');
          
          if (parentCol) {
            if (agencyName.includes(searchTerm)) {
              parentCol.style.display = 'block'; // Show matching
            } else {
              parentCol.style.display = 'none';  // Hide non-matching
            }
          }
        }
      });
    });
  }
  
  // Back to top button functionality
  const backToTopBtn = document.getElementById('backToTop');
  if (backToTopBtn) {
    // Show/hide button based on scroll position
    window.addEventListener('scroll', function() {
      if (window.pageYOffset > 300) {
        backToTopBtn.classList.add('show');
      } else {
        backToTopBtn.classList.remove('show');
      }
    });
    
    // Smooth scroll to top when clicked
    backToTopBtn.addEventListener('click', function() {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  }
  
  // Agency card click handlers
  const agencyCards = document.querySelectorAll('.agency-card');
  agencyCards.forEach(card => {
    card.addEventListener('click', function(e) {
      // Only handle if not clicking on the "Selengkapnya" button
      if (!e.target.closest('.btn')) {
        const agencyName = this.querySelector('h5.card-title').textContent;
        console.log('Navigate to agency details:', agencyName);
        // You can implement navigation to specific agency pages here
        // Example: window.location.href = `/instansi/${agencySlug}`;
      }
    });
  });
})();