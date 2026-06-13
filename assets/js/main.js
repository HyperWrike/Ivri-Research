document.addEventListener('DOMContentLoaded', () => {
    // 1. Navigation scroll state (shadow & blur)
    const nav = document.querySelector('nav');
    if (nav) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                nav.classList.add('shadow-sm', 'bg-opacity-95', 'backdrop-blur-md');
            } else {
                nav.classList.remove('shadow-sm', 'bg-opacity-95', 'backdrop-blur-md');
            }
        });
    }

    // 2. Navigation scroll hide/reveal header
    let lastScroll = 0;
    const header = document.querySelector('header');
    if (header) {
        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            if (currentScroll <= 0) {
                header.classList.remove('-translate-y-full');
                return;
            }
            if (currentScroll > lastScroll && currentScroll > 100) {
                header.classList.add('-translate-y-full');
            } else {
                header.classList.remove('-translate-y-full');
            }
            lastScroll = currentScroll;
        });
    }

    // 3. Entrance scroll animations
    const observerOptions = {
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('opacity-100');
                entry.target.classList.remove('opacity-0', 'translate-y-4');
            }
        });
    }, observerOptions);

    // Apply observer to sections that should animate
    document.querySelectorAll('section').forEach(section => {
        // Exclude headers or hero sections from start delay/blank state
        if (!section.classList.contains('hero-section') && !section.closest('header') && !section.classList.contains('no-fade')) {
            section.classList.add('transition-all', 'duration-700', 'opacity-0', 'translate-y-4');
            observer.observe(section);
        } else {
            section.classList.remove('opacity-0', 'translate-y-4');
            section.classList.add('opacity-100');
        }
    });

    // 4. About Us & general card group hover animations
    document.querySelectorAll('.group').forEach(card => {
        card.addEventListener('mouseenter', () => {
            // Apply slight translateY shift
            if (card.classList.contains('transition-all') || card.classList.contains('group')) {
                card.style.transform = 'translateY(-4px)';
                card.style.transition = 'transform 0.3s ease';
            }
        });
        card.addEventListener('mouseleave', () => {
            if (card.classList.contains('transition-all') || card.classList.contains('group')) {
                card.style.transform = 'translateY(0)';
            }
        });
    });

    // 5. Research Areas card icon micro-interactions
    document.querySelectorAll('.area-card').forEach(card => {
        card.addEventListener('mouseenter', () => {
            const icon = card.querySelector('.material-symbols-outlined');
            if (icon) {
                icon.style.transform = 'scale(1.1) rotate(-5deg)';
                icon.style.transition = 'transform 0.3s ease';
            }
        });
        card.addEventListener('mouseleave', () => {
            const icon = card.querySelector('.material-symbols-outlined');
            if (icon) {
                icon.style.transform = 'scale(1) rotate(0deg)';
            }
        });
    });

    // 6. Services card mouse tracking configuration
    document.querySelectorAll('.service-card').forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            card.style.setProperty('--mouse-x', `${x}px`);
            card.style.setProperty('--mouse-y', `${y}px`);
        });
    });
});
