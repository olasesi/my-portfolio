// Nav scroll
const nav = document.querySelector('.nav');
window.addEventListener('scroll', () => nav?.classList.toggle('scrolled', window.scrollY > 30));

// Mobile nav
const mBtn = document.querySelector('.nav-mobile-btn');
const nLinks = document.querySelector('.nav-links');
mBtn?.addEventListener('click', () => nLinks?.classList.toggle('open'));
document.addEventListener('click', e => { if (!nav?.contains(e.target)) nLinks?.classList.remove('open'); });

// Active link
const pg = window.location.pathname.split('/').pop() || 'index.html';
document.querySelectorAll('.nav-links a').forEach(a => {
  if (a.getAttribute('href') === pg) a.classList.add('active');
});

// Scroll reveal
new IntersectionObserver((entries) => {
  entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('in'); });
}, { threshold: 0.1 }).observe instanceof Function &&
(() => {
  const io = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('in'); });
  }, { threshold: 0.1 });
  document.querySelectorAll('.reveal').forEach(el => io.observe(el));
})();

// Animated counters
const counterObserver = new IntersectionObserver((entries) => {
  entries.forEach(e => {
    if (e.isIntersecting && !e.target.dataset.counted) {
      e.target.dataset.counted = 'true';
      const target = parseInt(e.target.dataset.target);
      const suffix = e.target.dataset.suffix || '';
      let current = 0;
      const step = target / 60;
      const timer = setInterval(() => {
        current = Math.min(current + step, target);
        e.target.textContent = Math.floor(current) + suffix;
        if (current >= target) clearInterval(timer);
      }, 16);
    }
  });
}, { threshold: 0.5 });
document.querySelectorAll('[data-target]').forEach(el => counterObserver.observe(el));

// Smooth page transitions
document.querySelectorAll('a[href]').forEach(a => {
  const href = a.getAttribute('href');
  if (href && href.endsWith('.html') && !a.target) {
    a.addEventListener('click', e => {
      e.preventDefault();
      document.body.style.cssText = 'opacity:0;transition:opacity 0.2s ease';
      setTimeout(() => window.location.href = href, 200);
    });
  }
});
document.body.style.cssText = 'opacity:1;transition:opacity 0.3s ease';
