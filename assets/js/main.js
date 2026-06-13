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

    // 7. Mobile Navigation Drawer
    const mobileToggle = document.getElementById('mobile-menu-toggle');
    const mobileDrawer = document.getElementById('mobile-nav-drawer');
    const mobileBackdrop = document.getElementById('mobile-nav-backdrop');
    const mobileCloseBtn = document.getElementById('mobile-nav-close');
    const menuIcon = mobileToggle ? mobileToggle.querySelector('.mobile-menu-icon') : null;
    const closeIcon = mobileToggle ? mobileToggle.querySelector('.mobile-close-icon') : null;

    function openMobileNav() {
        if (!mobileDrawer || !mobileBackdrop) return;
        mobileDrawer.classList.add('drawer-open');
        mobileBackdrop.classList.add('backdrop-open');
        document.body.classList.add('overflow-hidden');
        if (menuIcon) menuIcon.classList.add('hidden');
        if (closeIcon) closeIcon.classList.remove('hidden');
        if (mobileToggle) mobileToggle.setAttribute('aria-expanded', 'true');
    }

    function closeMobileNav() {
        if (!mobileDrawer || !mobileBackdrop) return;
        mobileDrawer.classList.remove('drawer-open');
        mobileBackdrop.classList.remove('backdrop-open');
        document.body.classList.remove('overflow-hidden');
        if (menuIcon) menuIcon.classList.remove('hidden');
        if (closeIcon) closeIcon.classList.add('hidden');
        if (mobileToggle) mobileToggle.setAttribute('aria-expanded', 'false');
    }

    // Toggle on hamburger button click
    if (mobileToggle) {
        mobileToggle.addEventListener('click', () => {
            const isOpen = mobileDrawer && mobileDrawer.classList.contains('drawer-open');
            if (isOpen) {
                closeMobileNav();
            } else {
                openMobileNav();
            }
        });
    }

    // Close on close button inside drawer
    if (mobileCloseBtn) {
        mobileCloseBtn.addEventListener('click', closeMobileNav);
    }

    // Close on backdrop click (outside drawer)
    if (mobileBackdrop) {
        mobileBackdrop.addEventListener('click', closeMobileNav);
    }

    // Close on Escape key
    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && mobileDrawer && mobileDrawer.classList.contains('drawer-open')) {
            closeMobileNav();
        }
    });

    // Close when a mobile nav link is clicked
    document.querySelectorAll('.mobile-nav-link').forEach(link => {
        link.addEventListener('click', closeMobileNav);
    });
});
