
// Custom cursor
const cursor = document.querySelector('.cursor');

document.addEventListener('mousemove', (e) => {
    cursor.style.left = e.clientX + 'px';
    cursor.style.top = e.clientY + 'px';
});

// Navbar scroll effect
window.addEventListener('scroll', () => {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

// Initialize GSAP animations
document.addEventListener('DOMContentLoaded', () => {
    // Hero animations
    gsap.to('.hero-subtitle', { opacity: 1, y: 0, duration: 0.8, delay: 0.2 });
    gsap.to('.hero-title', { opacity: 1, y: 0, duration: 0.8, delay: 0.4 });
    gsap.to('.hero-description', { opacity: 1, y: 0, duration: 0.8, delay: 0.6 });
    gsap.to('.btn-book', { opacity: 1, y: 0, duration: 0.8, delay: 0.8 });
    gsap.to('.scroll-indicator', { opacity: 1, duration: 0.8, delay: 1.2 });
    
    // Section animations
    gsap.registerPlugin(ScrollTrigger);
    
    // Services section
    gsap.to('.section-title', {
        scrollTrigger: {
            trigger: '.section-title',
            start: 'top 80%'
        },
        opacity: 1,
        y: 0,
        duration: 0.8
    });
    
    gsap.to('.section-subtitle', {
        scrollTrigger: {
            trigger: '.section-subtitle',
            start: 'top 80%'
        },
        opacity: 1,
        y: 0,
        duration: 0.8,
        delay: 0.2
    });
    
    // Service cards
    gsap.utils.toArray('.service-card').forEach((card, i) => {
        gsap.to(card, {
            scrollTrigger: {
                trigger: card,
                start: 'top 80%'
            },
            opacity: 1,
            y: 0,
            duration: 0.8,
            delay: 0.2 * i
        });
    });
    
    // Location section
    gsap.to('.location-title', {
        scrollTrigger: {
            trigger: '.location-title',
            start: 'top 80%'
        },
        opacity: 1,
        y: 0,
        duration: 0.8
    });
    
    gsap.to('.location-description', {
        scrollTrigger: {
            trigger: '.location-description',
            start: 'top 80%'
        },
        opacity: 1,
        y: 0,
        duration: 0.8,
        delay: 0.2
    });
    
    gsap.to('.location-details', {
        scrollTrigger: {
            trigger: '.location-details',
            start: 'top 80%'
        },
        opacity: 1,
        y: 0,
        duration: 0.8,
        delay: 0.4
    });
    
    gsap.to('.map-container', {
        scrollTrigger: {
            trigger: '.map-container',
            start: 'top 80%'
        },
        opacity: 1,
        x: 0,
        duration: 0.8,
        delay: 0.4
    });
    
    // Testimonial
    gsap.to('.testimonial', {
        scrollTrigger: {
            trigger: '.testimonial',
            start: 'top 80%'
        },
        opacity: 1,
        duration: 0.8
    });
});