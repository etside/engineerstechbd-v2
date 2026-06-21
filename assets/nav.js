/* nav.js — shared nav/footer + scroll behaviours + reveal system */
(function () {
  'use strict';

  /* ── helpers ── */
  const $ = id => document.getElementById(id);
  const currentPage = location.pathname.split('/').pop() || 'index.html';
  const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  function markActive(el) {
    const href = el.getAttribute('href') || '';
    if (href === currentPage || (currentPage === '' && href === 'index.html')) {
      el.classList.add('active');
      el.setAttribute('aria-current', 'page');
    }
  }

  /* Mark active links */
  document.querySelectorAll('#navbar a, #mobile-menu a').forEach(markActive);

  /* ── Scroll: navbar + btt ── */
  const nav = () => document.getElementById('navbar');
  const btt = () => document.getElementById('btt');
  let ticking = false;

  function onScroll() {
    if (ticking) return;
    ticking = true;
    requestAnimationFrame(() => {
      const s = window.scrollY > 50;
      nav() && nav().classList.toggle('scrolled', s);
      btt() && btt().classList.toggle('visible', window.scrollY > 400);

      /* Parallax hero layers */
      if (!reducedMotion) {
        document.querySelectorAll('.parallax-layer').forEach(el => {
          const speed = parseFloat(el.dataset.speed) || 0.3;
          const rect = el.getBoundingClientRect();
          if (rect.bottom > 0) {
            el.style.transform = `translateY(${window.scrollY * speed}px)`;
          }
        });
      }

      ticking = false;
    });
  }
  window.addEventListener('scroll', onScroll, { passive: true });

  /* ── Mobile menu toggle ── */
  document.addEventListener('click', e => {
    const tog = document.getElementById('menu-toggle');
    const mob = document.getElementById('mobile-menu');
    if (!tog || !mob) return;
    if (e.target.closest('#menu-toggle')) {
      const open = mob.classList.toggle('open');
      tog.classList.toggle('open', open);
      tog.setAttribute('aria-expanded', open);
    } else if (!e.target.closest('#mobile-menu') && !e.target.closest('#navbar')) {
      mob.classList.remove('open');
      tog.classList.remove('open');
      tog.setAttribute('aria-expanded', 'false');
    }
  });

  /* ── Mobile menu link closes menu ── */
  document.addEventListener('click', e => {
    if (e.target.closest('#mobile-menu a')) {
      const mob = document.getElementById('mobile-menu');
      const tog = document.getElementById('menu-toggle');
      mob && mob.classList.remove('open');
      tog && tog.classList.remove('open');
      tog && tog.setAttribute('aria-expanded', 'false');
    }
  });

  /* ── Back to top ── */
  document.addEventListener('click', e => {
    if (e.target.closest('#btt')) window.scrollTo({ top: 0, behavior: 'smooth' });
  });

  /* ── Footer year ── */
  const fy = document.getElementById('footer-year');
  if (fy) fy.textContent = new Date().getFullYear();

  /* ── Reveal observer (unified .reveal system) ── */
  const revealObs = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        revealObs.unobserve(entry.target);
      }
    });
  }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });
  document.querySelectorAll('.reveal').forEach(el => revealObs.observe(el));

  /* ── Stagger grid observer ── */
  const staggerObs = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const children = entry.target.children;
        Array.from(children).forEach((child, idx) => {
          child.style.transitionDelay = Math.min(idx * 0.06, 0.36) + 's';
          child.classList.add('visible');
        });
        staggerObs.unobserve(entry.target);
      }
    });
  }, { threshold: 0.06, rootMargin: '0px 0px -30px 0px' });
  document.querySelectorAll('.stagger-grid').forEach(el => staggerObs.observe(el));
})();
