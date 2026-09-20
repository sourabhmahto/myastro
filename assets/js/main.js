/**
 * Omkareshwar Jyotirlinga - Main Frontend JavaScript
 * Vanilla JS only. No framework dependencies.
 */

document.addEventListener('DOMContentLoaded', () => {

  /* ===== NAVBAR SCROLL EFFECT ===== */
  const navbar = document.querySelector('.navbar-main');
  const handleNavbarScroll = () => {
    if (navbar) navbar.classList.toggle('scrolled', window.scrollY > 60);
  };
  window.addEventListener('scroll', handleNavbarScroll, { passive: true });
  handleNavbarScroll();

  /* ===== SCROLL-TO-TOP ===== */
  const scrollTopBtn = document.querySelector('.scroll-top-btn');
  if (scrollTopBtn) {
    window.addEventListener('scroll', () => {
      scrollTopBtn.classList.toggle('visible', window.scrollY > 300);
    }, { passive: true });
    scrollTopBtn.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  /* ===== BOOKING FORM LOGIC ===== */
  const poojaSelect = document.getElementById('pooja_service_id');
  const bookingDateInput = document.getElementById('booking_date');
  const timeSlotGrid = document.querySelector('.time-slot-grid');
  const selectedTimeInput = document.getElementById('booking_time');
  const displayPrice = document.getElementById('display-price');
  const displayName = document.getElementById('display-pooja-name');
  const displayDuration = document.getElementById('display-duration');
  const priceSummary = document.querySelector('.price-summary-box');

  const allTimeSlots = [
    '06:00 AM', '07:00 AM', '07:30 AM', '08:30 AM', '09:30 AM',
    '10:30 AM', '11:00 AM', '01:30 PM', '02:00 PM', '03:00 PM',
    '04:00 PM', '05:00 PM', '06:00 PM', '07:00 PM', '08:00 PM'
  ];

  if (bookingDateInput) {
    const today = new Date().toISOString().split('T')[0];
    bookingDateInput.setAttribute('min', today);
  }

  function renderTimeSlots() {
    if (!timeSlotGrid || !selectedTimeInput) return;
    timeSlotGrid.innerHTML = '';
    const currentSelected = selectedTimeInput.value;
    allTimeSlots.forEach(slot => {
      const btn = document.createElement('button');
      btn.type = 'button';
      btn.className = 'time-slot-btn' + (currentSelected === slot ? ' selected' : '');
      btn.textContent = slot;
      btn.dataset.time = slot;
      btn.addEventListener('click', () => {
        selectedTimeInput.value = slot;
        timeSlotGrid.querySelectorAll('.time-slot-btn').forEach(b => b.classList.remove('selected'));
        btn.classList.add('selected');
      });
      timeSlotGrid.appendChild(btn);
    });
  }

  function updatePoojaDetails() {
    if (!poojaSelect) return;
    const opt = poojaSelect.options[poojaSelect.selectedIndex];
    const price = opt.dataset.price || '0';
    const dur = opt.dataset.duration || '';
    const name = opt.textContent.trim();
    if (displayPrice) displayPrice.textContent = '\u20B9 ' + parseFloat(price).toLocaleString('en-IN');
    if (displayName) displayName.textContent = name;
    if (displayDuration) displayDuration.textContent = dur;
    if (priceSummary) priceSummary.style.display = parseFloat(price) > 0 ? 'block' : 'none';
  }

  if (poojaSelect) {
    poojaSelect.addEventListener('change', updatePoojaDetails);
    updatePoojaDetails();
    renderTimeSlots();
  }
  if (bookingDateInput) {
    bookingDateInput.addEventListener('change', renderTimeSlots);
  }

  /* ===== STEP NAVIGATION ===== */
  const steps = document.querySelectorAll('.booking-step');
  const stepDots = document.querySelectorAll('.step-dot');
  const nextBtns = document.querySelectorAll('[data-next-step]');
  const prevBtns = document.querySelectorAll('[data-prev-step]');
  let currentStep = 0;

  function showStep(idx) {
    steps.forEach((s, i) => s.style.display = (i === idx) ? 'block' : 'none');
    stepDots.forEach((d, i) => {
      d.classList.toggle('active', i === idx);
      d.classList.toggle('done', i < idx);
    });
    currentStep = idx;
    const card = document.querySelector('.booking-form-card');
    if (card) window.scrollTo({ top: card.offsetTop - 80, behavior: 'smooth' });
  }

  if (steps.length > 1) {
    showStep(0);
    nextBtns.forEach(btn => btn.addEventListener('click', () => {
      if (validateStep(currentStep)) showStep(currentStep + 1);
    }));
    prevBtns.forEach(btn => btn.addEventListener('click', () => {
      if (currentStep > 0) showStep(currentStep - 1);
    }));
  }

  function validateStep(step) {
    if (step === 0) {
      if (!poojaSelect || !poojaSelect.value) { showAlert('Please select a Pooja service.', 'danger'); return false; }
      if (!bookingDateInput || !bookingDateInput.value) { showAlert('Please select a pilgrimage date.', 'danger'); return false; }
      if (!selectedTimeInput || !selectedTimeInput.value) { showAlert('Please select a time slot.', 'danger'); return false; }
    }
    if (step === 1) {
      const nm = document.getElementById('customer_name');
      const ph = document.getElementById('customer_phone');
      const em = document.getElementById('customer_email');
      if (!nm || nm.value.trim().length < 3) { showAlert('Please enter your full name.', 'danger'); if(nm) nm.focus(); return false; }
      if (!ph || !/^[0-9+\-\s]{10,16}$/.test(ph.value.trim())) { showAlert('Enter a valid 10-digit mobile number.', 'danger'); if(ph) ph.focus(); return false; }
      if (!em || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(em.value.trim())) { showAlert('Enter a valid email address.', 'danger'); if(em) em.focus(); return false; }
    }
    return true;
  }

  function showAlert(message, type) {
    document.querySelectorAll('.js-inline-alert').forEach(a => a.remove());
    const al = document.createElement('div');
    al.className = `alert alert-${type} alert-dismissible fade show shadow-sm js-inline-alert`;
    al.innerHTML = message + '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
    const body = document.querySelector('.booking-form-card .form-body') || document.body;
    body.insertBefore(al, body.firstChild);
    al.scrollIntoView({ behavior: 'smooth', block: 'center' });
    setTimeout(() => al.remove(), 5000);
  }

  /* ===== GALLERY LIGHTBOX ===== */
  const lightbox = document.querySelector('.gallery-lightbox');
  const lightboxImg = lightbox ? lightbox.querySelector('img') : null;
  const lightboxCaption = lightbox ? lightbox.querySelector('.lightbox-caption') : null;
  const lightboxClose = lightbox ? lightbox.querySelector('.lightbox-close') : null;
  let galleryItems = Array.from(document.querySelectorAll('.gallery-item'));
  let lbIdx = 0;

  galleryItems.forEach((item, idx) => {
    item.addEventListener('click', () => {
      if (!lightbox || !lightboxImg) return;
      const img = item.querySelector('img');
      lightboxImg.src = img ? img.src : '';
      lightboxImg.alt = img ? img.alt : '';
      if (lightboxCaption) lightboxCaption.textContent = img ? img.alt : '';
      lbIdx = idx;
      lightbox.classList.add('open');
      document.body.style.overflow = 'hidden';
    });
  });

  const closeLightbox = () => { if(lightbox) lightbox.classList.remove('open'); document.body.style.overflow = ''; };
  if (lightboxClose) lightboxClose.addEventListener('click', closeLightbox);
  if (lightbox) lightbox.addEventListener('click', e => { if(e.target === lightbox) closeLightbox(); });
  document.addEventListener('keydown', e => {
    if (!lightbox || !lightbox.classList.contains('open')) return;
    if (e.key === 'Escape') closeLightbox();
    if (e.key === 'ArrowRight' && lbIdx < galleryItems.length - 1) galleryItems[++lbIdx].click();
    if (e.key === 'ArrowLeft' && lbIdx > 0) galleryItems[--lbIdx].click();
  });

  /* ===== GALLERY FILTER BUTTONS ===== */
  document.querySelectorAll('.gallery-filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.gallery-filter-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      const cat = btn.dataset.category;
      document.querySelectorAll('.gallery-item').forEach(item => {
        item.style.display = (cat === 'all' || cat === item.dataset.category) ? 'block' : 'none';
      });
    });
  });

  /* ===== ANIMATED COUNTERS ===== */
  const counterEls = document.querySelectorAll('.stat-number[data-count]');
  if (counterEls.length) {
    const obs = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        const el = entry.target;
        const target = parseInt(el.dataset.count, 10);
        const suffix = el.dataset.suffix || '';
        let cur = 0;
        const inc = Math.max(1, Math.ceil(target / 60));
        const timer = setInterval(() => {
          cur = Math.min(cur + inc, target);
          el.textContent = cur.toLocaleString('en-IN') + suffix;
          if (cur >= target) clearInterval(timer);
        }, 18);
        obs.unobserve(el);
      });
    }, { threshold: 0.5 });
    counterEls.forEach(el => obs.observe(el));
  }

  /* ===== PRINT VOUCHER ===== */
  const printBtn = document.getElementById('print-voucher-btn');
  if (printBtn) printBtn.addEventListener('click', () => window.print());

  /* ===== WHATSAPP SHARE ===== */
  const waBtn = document.getElementById('whatsapp-share-btn');
  if (waBtn) {
    waBtn.addEventListener('click', () => {
      const bnum = waBtn.dataset.booking || '';
      const nm = waBtn.dataset.name || '';
      const pooja = waBtn.dataset.pooja || '';
      const dt = waBtn.dataset.date || '';
      const msg = encodeURIComponent(`Har Har Mahadev! ॐ\nI have booked my pilgrimage at Shree Omkareshwar Jyotirlinga.\n\nBooking Ref: ${bnum}\nPooja: ${pooja}\nDate: ${dt}\nName: ${nm}\n\nMay Lord Omkar bless us all! 🙏`);
      window.open('https://wa.me/?text=' + msg, '_blank');
    });
  }

  /* ===== AUTO SLUG FROM TITLE ===== */
  const titleInput = document.getElementById('blog-title-input');
  const slugInput = document.getElementById('blog-slug-input');
  if (titleInput && slugInput) {
    titleInput.addEventListener('input', () => {
      if (!slugInput._manual) {
        slugInput.value = titleInput.value.toLowerCase().replace(/[^a-z0-9\s-]/g, '').trim().replace(/\s+/g, '-').replace(/-+/g, '-');
      }
    });
    slugInput.addEventListener('input', () => { slugInput._manual = true; });
  }

  /* ===== MOBILE NAVBAR ===== */
  const toggler = document.querySelector('.navbar-toggler');
  const collapse = document.querySelector('.navbar-collapse');
  if (toggler && collapse) {
    document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
      link.addEventListener('click', () => {
        if (collapse.classList.contains('show')) toggler.click();
      });
    });
  }

});
