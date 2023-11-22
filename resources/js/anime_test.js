import { anime } from './main.js';

document.addEventListener('trigger-fade-in', () => {
    anime({
        targets: '.fade-in',
        opacity: [{value: 0}, {value: 1}],
        easing: 'spring',
        loop: false
    });
});

document.addEventListener('trigger-fade-out', () => {
    anime({
        targets: '.fade-out',
        opacity: [{value: 1}, {value: 0}],
        easing: 'spring',
        loop: false,
        complete: function(anim){
            let parentElement = document.getElementById('timeline-container');
            while (parentElement.firstChild) {
                parentElement.removeChild(parentElement.firstChild);
            }
            if(document.getElementById("loading-screen")){
                console.log("hi");
                document.getElementById("loading-screen").remove();
            }
        }
    });
});

anime({
    targets: '.slide-top-down',
    translateY: [{value: 100}, {value: 0}],
    easing: 'spring',
    delay: anime.stagger(100),
    loop: false
});
