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

// === Parallaxe multi-couches (scroll + souris) ===
(function(){
  const l1 = document.querySelector('.px-l1');
  const l2 = document.querySelector('.px-l2');
  const l3 = document.querySelector('.px-l3');
  const hero = document.querySelector('.hero-art');
  if (!l1 || !l2 || !l3 || !hero) return;

  const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const isMobile = window.matchMedia('(max-width: 768px)').matches;
  if (prefersReduced) return;

  let rafId = null;
  let target = { sy: 0, mx: 0, my: 0 };
  let state  = { sy: 0, mx: 0, my: 0 };

  // Interpolateur doux
  const lerp = (a,b,t)=> a + (b - a) * t;

  function onScroll(){
    target.sy = window.scrollY || 0;
    tick();
  }
  function onMouseMove(e){
    const rect = hero.getBoundingClientRect();
    const cx = rect.left + rect.width / 2;
    const cy = rect.top  + rect.height / 2;
    target.mx = (e.clientX - cx) / rect.width;   // -0.5 .. 0.5
    target.my = (e.clientY - cy) / rect.height;  // -0.5 .. 0.5
    tick();
  }

  function render(){
    // adoucir le mouvement
    state.sy = lerp(state.sy, target.sy, 0.08);
    state.mx = lerp(state.mx, target.mx, 0.10);
    state.my = lerp(state.my, target.my, 0.10);

    // intensités différentes pour chaque couche (px)
    const y1 = (state.sy * 0.06) + (state.my * -12);
    const x1 = (state.mx *  12);
    const y2 = (state.sy * 0.10) + (state.my * -18);
    const x2 = (state.mx *  18);
    const y3 = (state.sy * 0.16) + (state.my * -26);
    const x3 = (state.mx *  26);

    l1.style.transform = `translate3d(${x1}px, ${y1}px, 0)`;
    l2.style.transform = `translate3d(${x2}px, ${y2}px, 0)`;
    l3.style.transform = `translate3d(${x3}px, ${y3}px, 0)`;
  }

  function tick(){
    if (rafId) return;
    rafId = requestAnimationFrame(()=>{
      rafId = null;
      render();
    });
  }

  // Écouteurs (souris désactivée sur mobile pour éviter le jitter)
  window.addEventListener('scroll', onScroll, { passive: true });
  if (!isMobile) window.addEventListener('mousemove', onMouseMove, { passive: true });

  // premier rendu
  onScroll();
})();

// Menu burger mobile
document.addEventListener('DOMContentLoaded', () => {
  const btn = document.querySelector('.burger');
  const links = document.getElementById('nav-links');
  if (!btn || !links) return;
  btn.addEventListener('click', () => {
    const open = btn.getAttribute('aria-expanded') === 'true';
    btn.setAttribute('aria-expanded', String(!open));
    links.classList.toggle('is-open', !open);
  });
});

// FAQ: recherche + filtres + accordéon
document.addEventListener('DOMContentLoaded', () => {
  const search = document.getElementById('faq-search');
  const chips = document.querySelectorAll('.chip');
  const items = document.querySelectorAll('#faq-accordion .acc');
  let filter = 'all';

  function applyFilters(){
    const q = (search?.value || '').toLowerCase();
    items.forEach(el => {
      const cat = el.dataset.cat || '';
      const text = el.textContent.toLowerCase();
      const okCat = (filter === 'all' || cat === filter);
      const okText = !q || text.includes(q);
      el.style.display = (okCat && okText) ? '' : 'none';
    });
  }

  chips.forEach(btn => {
    btn.addEventListener('click', () => {
      chips.forEach(c => c.classList.remove('is-active'));
      btn.classList.add('is-active');
      filter = btn.dataset.filter || 'all';
      applyFilters();
    });
  });
  search?.addEventListener('input', applyFilters);

  // Accessibilité: focus le contenu quand on ouvre un <details>
  document.querySelectorAll('#faq-accordion details').forEach(d => {
    d.addEventListener('toggle', () => {
      if (d.open) d.querySelector('.acc-panel')?.setAttribute('tabindex', '-1'), d.querySelector('.acc-panel')?.focus();
    });
  });
});
