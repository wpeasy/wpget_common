const $ = jQuery;
const repeatAnimationSelector = '.repeat-entrance-animation';
const waitForElementorTimeout = 500;

console.log('REPEAT');

window.addEventListener('DOMContentLoaded', () => {
    trackElementsForAnimation();
})

const trackElementsForAnimation = () => {
    console.log('TRACK');
    const options = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    }

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach((e) => {
            let target = e.target;
            let $target = $(target);
            if (e.isIntersecting) {
                /*
                Get the classes to toggle here. If we get them on the observer init, Elementor would not yet have added teh animation classes.
                */
                if (undefined === target.dataset.toggleClasses) {
                    /*
                        waitForElementorTimeout timout allows time for Elementor to add animation classes.
                    */
                    setTimeout(() => {
                        setToggleClasses(target);
                    }, waitForElementorTimeout)
                }
                $target.addClass($target.data('toggle-classes'));
                $target.css('opacity','1');
            } else {
                $target.removeClass($target.data('toggle-classes'));
                $target.css('opacity','0');
            }
        });
    }, options);

    /*
           Get a string of classes to remove and add for an element. Parse existing classes, exclude any class starting with 'elementor'
       */
    const setToggleClasses = (element) => {
        let toggleClasses = ''
        element.classList.forEach((e) => {
            toggleClasses += e.startsWith('elementor') ? '' : e + ' ';
        });
        element.setAttribute('data-toggle-classes', toggleClasses);
    }

    /*
        Start observing elements
     */
    document.querySelectorAll(repeatAnimationSelector).forEach((i) => {
        if (i) {
            observer.observe(i);
        }
    });
}
