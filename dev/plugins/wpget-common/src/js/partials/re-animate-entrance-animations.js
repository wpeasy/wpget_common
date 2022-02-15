const $ = jQuery;
const repeatAnimationSelector = '.repeat-entrance-animation';
const waitForElementorTimeout = 200;

window.addEventListener('DOMContentLoaded', () => {
    trackElementsForAnimation();
})

/*
Get a string of classes to remove and add for an element. Parse existing classes, exclude any class starting with 'elementor'
*/
const setToggleClasses = (target) => {
    if( undefined === target ) { return };
    let toggleClasses = ''
    target.classList.forEach((e) => {
        toggleClasses += e.startsWith('elementor') ? '' : e + ' ';
    });
    target.setAttribute('data-toggle-classes', toggleClasses);
}

const checkForAnimatedClass = target => {
    return new Promise(resolve => {
        setTimeout(() => {
                resolve(target.classList.contains('animated'));
        }, waitForElementorTimeout);
    })
}

const asyncCall = async target => {
    const result = await checkForAnimatedClass(target);
    if (false === result) {
        asyncCall(target).then(()=>{

        });
    } else {

        return(target);
    }
}

const trackElementsForAnimation = () => {
    let debounceArray = {};
    let debounceDelay = 300; /* 300ms */

    const options = {
        root: null,
        rootMargin: '0px',
        threshold: 0
    }

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach((e) => {
            const target = e.target;
            const $target = $(target);
            const elementorID = $target.data('id');
            const date = new Date();
            const nowInMilliSeconds = date.getTime();

            /* First check for debounce timing */
            /*
            if( undefined === debounceArray[elementorID] ){
                debounceArray[elementorID] = nowInMilliSeconds - debounceDelay;
            }

            console.log(debounceArray);
            if(nowInMilliSeconds - debounceArray[elementorID] < debounceDelay ){
                console.log('DEBOUNCE: ', elementorID);
                return;
            }
            debounceArray[elementorID] = nowInMilliSeconds;
            */
             

            if (e.isIntersecting) {
                /*
                Get the classes to toggle here. If we get them on the observer init, Elementor would not yet have added teh animation classes.
                */
                if (undefined === target.dataset.toggleClasses) {
                    /*
                        waitForElementorTimeout timout allows time for Elementor to add animation classes.
                    */
                    asyncCall(target).then((t)=>{
                        setToggleClasses(t);
                    });
                }
                $target.addClass($target.data('toggle-classes'));
                $target.css('opacity', '1');
            } else {
                $target.removeClass($target.data('toggle-classes'));
                $target.css('opacity', '0');
            }
        });
    }, options);


    /*
        Start observing elements
     */
    document.querySelectorAll(repeatAnimationSelector).forEach((i) => {
        if (i) {
            observer.observe(i);
        }
    });
}
