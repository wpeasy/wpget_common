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

/***/ "./js/split-characters.js":
/*!********************************!*\
  !*** ./js/split-characters.js ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var splitting_dist_splitting_css__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! splitting/dist/splitting.css */ \"../node_modules/splitting/dist/splitting.css\");\n/* harmony import */ var splitting_dist_splitting_cells_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! splitting/dist/splitting-cells.css */ \"../node_modules/splitting/dist/splitting-cells.css\");\n/* harmony import */ var splitting__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! splitting */ \"../node_modules/splitting/dist/splitting.js\");\n/* harmony import */ var splitting__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(splitting__WEBPACK_IMPORTED_MODULE_2__);\n/* provided dependency */ var jQuery = __webpack_require__(/*! jquery */ \"jquery\");\n\n\n\nvar selector = '.split-characters';\nvar subElements = ['p', 'h1', 'h2', 'h3', 'h4'];\nwindow.addEventListener('DOMContentLoaded', function () {\n  var $ = jQuery;\n  subElements.forEach(function (e) {\n    splitting__WEBPACK_IMPORTED_MODULE_2___default()({\n      target: selector + ' ' + e,\n      by: 'chars'\n    });\n  });\n  /* Add a Word odd/even class */\n\n  $('.splitting.words').each(function (i, e) {\n    var $words = $(e).find('.word');\n    $words.filter(':even').addClass('word-odd');\n    $words.filter(':odd').addClass('word-even');\n    $words.filter(':last').addClass('word-last');\n    $words.filter(':first').addClass('word-first');\n  });\n});\n\n//# sourceURL=webpack:///./js/split-characters.js?");

/***/ })

}]);