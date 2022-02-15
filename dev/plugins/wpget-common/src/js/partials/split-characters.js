import "splitting/dist/splitting.css";
import "splitting/dist/splitting-cells.css";
import Splitting from 'splitting';
const selector = '.split-characters';
const subElements  = ['p','h1','h2','h3','h4'];
let $;

window.addEventListener('DOMContentLoaded', ()=>{
    $ = jQuery;
    splitCharacters();
    rotateWords();
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
   const $splits = $('.wpg-word-rotate .splitting.words');
   $splits.each((i,e)=>{
       const $e = $(e);
       const heights = $e.find('.char').map((e)=>{
           return e.outerHeight;
       });
       console.log('Heights:', heights);
   });

}




