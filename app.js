document.addEventListener('DOMContentLoaded', () => {
  const els = document.querySelectorAll('[data-reveal]');
  const io = new IntersectionObserver((entries) => {
    for (const e of entries) {
      if (e.isIntersecting) {
        e.target.classList.add('reveal-in');
        io.unobserve(e.target);
      }
    }
  }, { threshold: 0.15 });
  els.forEach(el => io.observe(el));
});

(function(){
  const root = document.documentElement;
  const STORAGE_KEY = 'theme';
  const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
  const saved = localStorage.getItem(STORAGE_KEY);
  const initial = saved || (prefersDark ? 'dark' : 'light');
  root.setAttribute('data-theme', initial);

  function updateButton(btn){
    const t = root.getAttribute('data-theme');
    btn.classList.toggle('is-dark', t === 'dark');
  }

  window.addEventListener('DOMContentLoaded', () => {
    const btn = document.querySelector('.theme-toggle');
    if (btn){
      updateButton(btn);
      btn.addEventListener('click', () => {
        const current = root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
        root.setAttribute('data-theme', current);
        localStorage.setItem(STORAGE_KEY, current);
        updateButton(btn);
      });
    }
  });
})();

// Parallaxe léger sur l'image du hero
window.addEventListener('scroll', () => {
  const heroImg = document.querySelector('.hero-img');
  if (!heroImg) return;
  const scrolled = window.scrollY;
  heroImg.style.transform = `translateY(${scrolled * 0.2}px)`; // 0.2 = intensité
});