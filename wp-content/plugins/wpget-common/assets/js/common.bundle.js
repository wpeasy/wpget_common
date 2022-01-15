"use strict";
/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
(self["webpackChunk"] = self["webpackChunk"] || []).push([["common"],{

/***/ "./js/partials/split-characters.js":
/*!*****************************************!*\
  !*** ./js/partials/split-characters.js ***!
  \*****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var splitting_dist_splitting_css__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! splitting/dist/splitting.css */ \"../node_modules/splitting/dist/splitting.css\");\n/* harmony import */ var splitting_dist_splitting_cells_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! splitting/dist/splitting-cells.css */ \"../node_modules/splitting/dist/splitting-cells.css\");\n/* harmony import */ var splitting__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! splitting */ \"../node_modules/splitting/dist/splitting.js\");\n/* harmony import */ var splitting__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(splitting__WEBPACK_IMPORTED_MODULE_2__);\n/* provided dependency */ var jQuery = __webpack_require__(/*! jquery */ \"jquery\");\n\r\n\r\n\r\nconst selector = '.split-characters';\r\nconst subElements  = ['p','h1','h2','h3','h4'];\r\nlet $;\r\nwindow.addEventListener('DOMContentLoaded', ()=>{\r\n    $ = jQuery;\r\n    splitCharacters();\r\n    rotateWords();\r\n})\r\n\r\nconst splitCharacters = ()=>{\r\n    subElements.forEach( e => {\r\n        splitting__WEBPACK_IMPORTED_MODULE_2___default()({target: selector + ' ' + e, by: 'chars'});\r\n    })\r\n\r\n    /* Add a Word odd/even class */\r\n    $('.splitting.words').each((i,e)=>{\r\n        const $words = $(e).find('.word');\r\n        $words.filter(':even').addClass('word-odd');\r\n        $words.filter(':odd').addClass('word-even');\r\n        $words.filter(':last').addClass('word-last');\r\n        $words.filter(':first').addClass('word-first');\r\n    })\r\n}\r\n\r\nconst rotateWords = ()=>{\r\n   const $splits = $('.wpg-word-rotate .splitting.words');\r\n   $splits.each((i,e)=>{\r\n       $e = $(e);\r\n       const heights = $e.find('.char').map((e)=>{\r\n           return e.outerHeight;\r\n       });\r\n       console.log('Heights:', heights);\r\n   });\r\n\r\n}\r\n\r\n\r\n\r\n\r\n\n\n//# sourceURL=webpack:///./js/partials/split-characters.js?");

/***/ })

}]);