/* =========================================================================
   Rantharu Machines and Tools (Pvt) Ltd - Main Script
   ========================================================================= */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Mobile Menu Toggle
    const hamburger = document.querySelector('.hamburger');
    const navLinks = document.querySelector('.nav-links');

    if(hamburger){
        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            navLinks.classList.toggle('active');
        });
    }

    // Close menu when clicking a link
    document.querySelectorAll('.nav-links li a').forEach(link => {
        link.addEventListener('click', () => {
            if(hamburger.classList.contains('active')){
                hamburger.classList.remove('active');
                navLinks.classList.remove('active');
            }
        });
    });

    // 2. Active Link Highlighting Based on Page URL
    const currentPath = window.location.pathname.split('/').pop();
    document.querySelectorAll('.nav-links li a').forEach(link => {
        const linkPath = link.getAttribute('href');
        // If empty path or index, match / or index.html
        if (currentPath === '' || currentPath === 'index.html') {
            if (linkPath === 'index.html' || linkPath === './' || linkPath === '/') {
                link.classList.add('active');
            }
        } else if (linkPath.includes(currentPath)) {
            link.classList.add('active');
        }
    });

    // 3. Scroll Header Effect
    const header = document.querySelector('header');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.style.boxShadow = '0 5px 20px rgba(0,0,0,0.1)';
            header.style.background = 'rgba(255, 255, 255, 0.98)';
        } else {
            header.style.boxShadow = 'var(--shadow-sm)';
            header.style.background = 'rgba(255, 255, 255, 0.95)';
        }
    });

    // 4. Reveal Animations on Scroll
    const observers = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('appear');
            }
        });
    }, { threshold: 0.15 });

    document.querySelectorAll('.fade-in').forEach(el => observers.observe(el));
});
