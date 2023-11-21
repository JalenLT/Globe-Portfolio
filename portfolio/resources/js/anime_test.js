import { anime } from './main.js';

document.addEventListener('trigger-fade', () => {
    anime({
        targets: '.fade-in',
        opacity: [{value: 0}, {value: 1}],
        easing: 'spring',
        delay: anime.stagger(200),
        loop: false
    });
});

anime({
    targets: '.slide-top-down',
    translateY: [{value: 100}, {value: 0}],
    easing: 'spring',
    delay: anime.stagger(100),
    loop: false
});
