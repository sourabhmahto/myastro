/**
 * Omkareshwar Admin Panel - Admin JavaScript
 * Vanilla JS only.
 */

document.addEventListener('DOMContentLoaded', () => {

  /* ===== SIDEBAR TOGGLE (mobile) ===== */
  const sidebar = document.querySelector('.admin-sidebar');
  const overlay = document.querySelector('.admin-sidebar-overlay');
  const menuToggle = document.querySelector('.menu-toggle-btn');

  const openSidebar = () => {
    sidebar && sidebar.classList.add('open');
    overlay && overlay.classList.add('show');
    document.body.style.overflow = 'hidden';
  };
  const closeSidebar = () => {
    sidebar && sidebar.classList.remove('open');
    overlay && overlay.classList.remove('show');
    document.body.style.overflow = '';
  };

  if (menuToggle) menuToggle.addEventListener('click', openSidebar);
  if (overlay) overlay.addEventListener('click', closeSidebar);

  /* ===== DELETE CONFIRMATION ===== */
  document.querySelectorAll('[data-confirm]').forEach(el => {
    el.addEventListener('click', (e) => {
      const msg = el.dataset.confirm || 'Are you sure? This action cannot be undone.';
      if (!confirm(msg)) e.preventDefault();
    });
  });

  /* ===== TABLE LIVE SEARCH FILTER ===== */
  const searchInput = document.querySelector('.table-search-input');
  if (searchInput) {
    const table = document.querySelector('.admin-table tbody');
    if (table) {
      searchInput.addEventListener('input', () => {
        const query = searchInput.value.toLowerCase().trim();
        Array.from(table.rows).forEach(row => {
          const text = row.innerText.toLowerCase();
          row.style.display = text.includes(query) ? '' : 'none';
        });
      });
    }
  }

  /* ===== IMAGE PREVIEW ===== */
  document.querySelectorAll('input[type="file"][data-preview]').forEach(input => {
    input.addEventListener('change', () => {
      const previewId = input.dataset.preview;
      const preview = document.getElementById(previewId);
      if (!preview) return;
      const file = input.files[0];
      if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = (e) => {
          preview.innerHTML = `<img src="${e.target.result}" alt="Preview" style="max-width:100%;max-height:155px;object-fit:contain;border-radius:8px;">`;
        };
        reader.readAsDataURL(file);
      }
    });
  });

  /* ===== SLUG AUTO-GENERATOR (admin blog/pooja forms) ===== */
  const titleInputs = [
    { title: 'blog-title-input', slug: 'blog-slug-input' },
    { title: 'form-name-input', slug: 'form-slug-input' }
  ];
  titleInputs.forEach(({ title, slug }) => {
    const t = document.getElementById(title);
    const s = document.getElementById(slug);
    if (t && s) {
      t.addEventListener('input', () => {
        if (!s._manual) {
          s.value = t.value.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .trim()
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
        }
      });
      s.addEventListener('input', () => { s._manual = true; });
    }
  });

  /* ===== AUTO DISMISS ALERTS ===== */
  document.querySelectorAll('.alert-auto-dismiss').forEach(alert => {
    setTimeout(() => {
      alert.style.transition = 'opacity 0.5s';
      alert.style.opacity = '0';
      setTimeout(() => alert.remove(), 500);
    }, 4500);
  });

  /* ===== BOOKING STATUS QUICK UPDATE FORM ===== */
  document.querySelectorAll('.quick-status-form select').forEach(sel => {
    sel.addEventListener('change', () => {
      sel.closest('form') && sel.closest('form').submit();
    });
  });

  /* ===== HIGHLIGHT CURRENT SIDEBAR LINK ===== */
  const currentPath = window.location.pathname + window.location.search;
  document.querySelectorAll('.sidebar-nav-link').forEach(link => {
    const href = link.getAttribute('href') || '';
    if (href && currentPath.includes(href.split('?')[0].replace(/\/$/, ''))) {
      link.classList.add('active');
    }
  });

});
