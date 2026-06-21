/* nav.js — shared nav/footer injector + scroll behaviours */
(function () {
  'use strict';

  /* ── helpers ── */
  const $ = id => document.getElementById(id);
  const currentPage = location.pathname.split('/').pop() || 'index.html';
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
  window.addEventListener('scroll', () => {
    const s = window.scrollY > 50;
    nav() && nav().classList.toggle('scrolled', s);
    btt() && btt().classList.toggle('visible', window.scrollY > 400);
  }, { passive: true });

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

  /* ── AOS observer ── */
  const obs = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); }
    });
  }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });
  document.querySelectorAll('.aos').forEach(el => obs.observe(el));
})();
