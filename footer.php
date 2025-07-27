    </main>
    <footer>
        <p>&copy; 2024 LEA Web Creation. Tous droits réservés.</p>
    </footer>
    <!-- Script JavaScript pour menu mobile et slider -->
    <script>
    // Toggle du menu mobile
    const burger = document.querySelector('.hamburger');
    const navMenu = document.querySelector('.nav-menu');
    burger.addEventListener('click', () => {
        const expanded = burger.getAttribute('aria-expanded') === 'true' ? 'false' : 'true';
        burger.setAttribute('aria-expanded', expanded);
        burger.classList.toggle('open');
        navMenu.classList.toggle('open');
        // Indiquer si le menu est affiché ou non pour accessibilité
        if(expanded === 'true') {
            navMenu.setAttribute('aria-hidden', 'false');
        } else {
            navMenu.setAttribute('aria-hidden', 'true');
        }
    });

    // Slider simple pour les témoignages (boucle automatique)
    const slides = document.querySelectorAll('.slide');
    let currentSlide = 0;
    if(slides.length > 0) {
        slides[currentSlide].classList.add('active');
        setInterval(() => {
            slides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.add('active');
        }, 5000);
    }
    </script>
</body>
</html>
