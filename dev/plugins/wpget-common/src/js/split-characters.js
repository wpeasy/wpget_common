import "splitting/dist/splitting.css";
import "splitting/dist/splitting-cells.css";
import Splitting from 'splitting';
const selector = '.split-characters';
const subElements  = ['p','h1','h2','h3','h4'];
let $;
window.addEventListener('DOMContentLoaded', ()=>{
    $ = jQuery;
    splitCharacters();
    //rotateWords();
})

const splitCharacters = ()=>{
    subElements.forEach( e => {
        Splitting({target: selector + ' ' + e, by: 'chars'});
    })

    /* Add a Word odd/even class */
    $('.splitting.words').each((i,e)=>{
        const $words = $(e).find('.word');
        $words.filter(':even').addClass('word-odd');
        $words.filter(':odd').addClass('word-even');
        $words.filter(':last').addClass('word-last');
        $words.filter(':first').addClass('word-first');
    })
}

const rotateWords = ()=>{
    /* for some reason a timeout is needed before elementorFrontend.utils is available */
    setTimeout(()=>{
        const $wordSplitElements = $('.wpg-word-rotate');
        $wordSplitElements.each((i,e)=>{
            const $el = $(e).find('.elementor-widget-container:first');
            $el.addClass('swiper-container');
            const $wrapper = $el.find('.words');
            $wrapper.addClass('swiper-wrapper');
            $wrapper.find('.word').addClass('swiper-slide');

            let mySwiper;
            if ( 'undefined' === typeof Swiper ) {
                const asyncSwiper = elementorFrontend.utils.swiper;
                new asyncSwiper( $el , {} ).then( ( newSwiperInstance ) => {
                    mySwiper = newSwiperInstance;
                } );
            } else {
                mySwiper = new Swiper( swiperElement, swiperConfig );
            }
        });
    },1)
}




