document.addEventListener('DOMContentLoaded', function () {
  // == Submenu Toggle (click & keyboard) ==
  const parentLinks = document.querySelectorAll('.elica-bootstrap-mobile-menu > a');
  parentLinks.forEach(link => {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      toggleOpen(link);
    });
    link.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        toggleOpen(link);
      }
    });
  });
  function toggleOpen(link) {
    const li = link.parentElement;
    li.classList.toggle('open');
    const expanded = li.classList.contains('open');
    link.setAttribute('aria-expanded', expanded ? 'true' : 'false');
  }

  // == Search Popup Toggle ==
  const openBtn = document.getElementById('openSearchPopup');
  const closeBtn = document.getElementById('closeSearchPopup');
  const popup = document.getElementById('searchPopup');

  if (openBtn && closeBtn && popup) {
    openBtn.addEventListener('click', function () {
      popup.hidden = false;
      const firstInput = popup.querySelector('input[type="search"]');
      if (firstInput) firstInput.focus();
    });
    closeBtn.addEventListener('click', function () {
      popup.hidden = true;
      openBtn.focus();
    });
    document.addEventListener('keydown', function (e) {
      if (!popup.hidden) {
        const focusable = popup.querySelectorAll(
          'a, button, input, textarea, select, [tabindex]:not([tabindex="-1"])'
        );
        const first = focusable[0];
        const last = focusable[focusable.length - 1];

        if (e.key === 'Tab') {
          if (e.shiftKey) {
            if (document.activeElement === first) {
              e.preventDefault();
              last.focus();
            }
          } else {
            if (document.activeElement === last) {
              e.preventDefault();
              first.focus();
            }
          }
        }

        if (e.key === 'Escape') {
          popup.hidden = true;
          openBtn.focus();
        }
      }
    });
  }

  // == Mobile Menu Toggle & Close on outside click & blur ==
  const toggleBtn = document.getElementById('mobile-menu-toggle');
  const menu = document.getElementById('primary-menu');

  if (toggleBtn && menu) {
    toggleBtn.addEventListener('click', function (e) {
      e.stopPropagation();
      const isOpen = menu.classList.contains('active');
      if (isOpen) {
        menu.classList.remove('active');
        toggleBtn.setAttribute('aria-expanded', 'false');
      } else {
        menu.classList.add('active');
        toggleBtn.setAttribute('aria-expanded', 'true');
        // Optional: focus first link inside menu
        const firstLink = menu.querySelector('a');
        if (firstLink) firstLink.focus();
      }
    });

    // Close menu if clicking outside menu or toggle button
    document.addEventListener('click', function (e) {
      if (!menu.contains(e.target) && !toggleBtn.contains(e.target)) {
        menu.classList.remove('active');
        toggleBtn.setAttribute('aria-expanded', 'false');
      }
    });

    // Close menu if focus leaves menu & toggle (keyboard nav)
    const focusableSelectors = 'a, button, input, select, textarea, [tabindex]:not([tabindex="-1"])';
    const focusableEls = menu.querySelectorAll(focusableSelectors);
    focusableEls.forEach(el => {
      el.addEventListener('blur', () => {
        setTimeout(() => {
          const active = document.activeElement;
          if (!menu.contains(active) && !toggleBtn.contains(active)) {
            menu.classList.remove('active');
            toggleBtn.setAttribute('aria-expanded', 'false');
          }
        }, 50);
      });
    });
  }

  // == Search button hides main nav on mobile ==
  const searchButton = document.getElementById('openSearchPopup');
  const searchPopup = document.getElementById('searchPopup');
  const mainNav = document.querySelector('.main-navigation');

  if (searchButton && mainNav) {
    searchButton.addEventListener('click', function () {
      if (window.innerWidth <= 768) {
        mainNav.style.display = 'none';
      }
    });
  }

  const closeSearch = document.getElementById('closeSearchPopup');
  if (closeSearch) {
    closeSearch.addEventListener('click', function () {
      if (window.innerWidth <= 768) {
        mainNav.style.display = 'block';
      }
    });
  }
});
