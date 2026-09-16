(function () {
  'use strict';

  var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---------------- Sticky navbar: compact on scroll ---------------- */
  var header = document.querySelector('[data-site-header]');
  if (header) {
    var onScroll = function () {
      header.classList.toggle('is-scrolled', window.scrollY > 12);
    };
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
  }

  /* ---------------- Mobile menu ---------------- */
  var menuToggle = document.querySelector('[data-menu-toggle]');
  var mobileMenu = document.querySelector('[data-mobile-menu]');
  var menuClose = document.querySelector('[data-menu-close]');

  function openMenu() {
    if (!mobileMenu) return;
    mobileMenu.classList.add('is-open');
    menuToggle && menuToggle.setAttribute('aria-expanded', 'true');
    document.body.classList.add('overflow-hidden');
  }

  function closeMenu() {
    if (!mobileMenu) return;
    mobileMenu.classList.remove('is-open');
    menuToggle && menuToggle.setAttribute('aria-expanded', 'false');
    document.body.classList.remove('overflow-hidden');
  }

  if (menuToggle && mobileMenu) {
    menuToggle.addEventListener('click', function () {
      var isOpen = mobileMenu.classList.contains('is-open');
      isOpen ? closeMenu() : openMenu();
    });
  }
  if (menuClose) {
    menuClose.addEventListener('click', closeMenu);
  }
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') closeMenu();
  });

  /* ---------------- Desktop dropdown / mega menu ---------------- */
  var dropdownToggles = document.querySelectorAll('[data-dropdown-toggle]');

  function closeAllDropdowns(except) {
    dropdownToggles.forEach(function (toggle) {
      if (toggle === except) return;
      toggle.setAttribute('aria-expanded', 'false');
      var menu = document.getElementById(toggle.getAttribute('aria-controls'));
      if (menu) menu.classList.remove('is-open');
    });
  }

  dropdownToggles.forEach(function (toggle) {
    var menu = document.getElementById(toggle.getAttribute('aria-controls'));
    if (!menu) return;

    toggle.addEventListener('click', function (e) {
      e.stopPropagation();
      var isOpen = menu.classList.contains('is-open');
      closeAllDropdowns(toggle);
      menu.classList.toggle('is-open', !isOpen);
      toggle.setAttribute('aria-expanded', String(!isOpen));
    });
  });

  document.addEventListener('click', function () {
    closeAllDropdowns();
  });
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') closeAllDropdowns();
  });

  /* ---------------- Category filter + optional search (services, portfolio, etc.) ---------------- */
  document.querySelectorAll('[data-filter-group]').forEach(function (group) {
    var targetSelector = group.getAttribute('data-filter-group');
    var items = document.querySelectorAll(targetSelector + ' [data-filter-item]');
    var searchInput = group.querySelector('[data-filter-search]');
    var activeFilter = 'all';

    function applyFilters() {
      var term = searchInput ? searchInput.value.trim().toLowerCase() : '';

      items.forEach(function (item) {
        var categoryMatch = activeFilter === 'all' || item.getAttribute('data-filter-item') === activeFilter;
        var textMatch = term === '' || (item.getAttribute('data-filter-text') || '').indexOf(term) !== -1;
        item.classList.toggle('hidden', !(categoryMatch && textMatch));
      });
    }

    group.querySelectorAll('[data-filter-btn]').forEach(function (btn) {
      btn.addEventListener('click', function () {
        activeFilter = btn.getAttribute('data-filter-btn');
        group.querySelectorAll('[data-filter-btn]').forEach(function (b) {
          b.classList.toggle('is-active', b === btn);
        });
        applyFilters();
      });
    });

    if (searchInput) {
      searchInput.addEventListener('input', applyFilters);
    }
  });

  /* ---------------- Lightbox (native <dialog>, no library) ---------------- */
  var lightbox = document.getElementById('lightbox');
  if (lightbox) {
    var lightboxImg = lightbox.querySelector('img');
    document.querySelectorAll('[data-lightbox-src]').forEach(function (trigger) {
      trigger.addEventListener('click', function () {
        lightboxImg.src = trigger.getAttribute('data-lightbox-src');
        lightboxImg.alt = trigger.getAttribute('data-lightbox-alt') || '';
        lightbox.showModal();
      });
    });
    lightbox.addEventListener('click', function (e) {
      if (e.target === lightbox) lightbox.close();
    });
    var lightboxClose = lightbox.querySelector('[data-lightbox-close]');
    if (lightboxClose) lightboxClose.addEventListener('click', function () { lightbox.close(); });
  }

  /* ---------------- Scroll-reveal animations ---------------- */
  var animatedEls = document.querySelectorAll('[data-animate]');

  if (reducedMotion || !('IntersectionObserver' in window)) {
    animatedEls.forEach(function (el) {
      el.classList.add('is-visible');
    });
  } else {
    var observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (!entry.isIntersecting) return;
          var el = entry.target;
          var delay = el.getAttribute('data-delay');
          if (delay) el.style.animationDelay = delay + 'ms';
          el.classList.add('is-visible');
          observer.unobserve(el);
        });
      },
      { threshold: 0.15, rootMargin: '0px 0px -40px 0px' }
    );

    animatedEls.forEach(function (el) {
      observer.observe(el);
    });
  }
})();
