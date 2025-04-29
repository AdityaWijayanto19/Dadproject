document.addEventListener('DOMContentLoaded', function() {
    // Scroll Reveal Library Setup
    const sr = ScrollReveal({
        distance: '65px',
        duration: 2600,
        delay: 450,
        reset: false,
    });

    // Landing Page Reveal
    sr.reveal('.title', { delay: 50, origin: 'left' });
    sr.reveal('.login', { delay: 50, origin: 'top' });
    sr.reveal('.loginForm h1', { distance: '15px', delay: 1500, origin: 'bottom' });
    sr.reveal('.loginForm h2', { distance: '15px', delay: 1500, origin: 'top' });
    sr.reveal('.socialIcon i:nth-child(1)', { delay: 1000});
    sr.reveal('.socialIcon i:nth-child(2)', { delay: 1500});
    sr.reveal('.socialIcon i:nth-child(3)', { delay: 2000});
    sr.reveal('.registBox', { distance: '15px', delay: 1000, origin: 'bottom' });
});