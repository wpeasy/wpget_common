/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./scss/frontend.scss":
/*!****************************!*\
  !*** ./scss/frontend.scss ***!
  \****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n// extracted by mini-css-extract-plugin\n\n\n//# sourceURL=webpack:///./scss/frontend.scss?");

/***/ }),

/***/ "./js/frontend.js":
/*!************************!*\
  !*** ./js/frontend.js ***!
  \************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _scss_frontend_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../scss/frontend.scss */ \"./scss/frontend.scss\");\n/* harmony import */ var _partials_split_characters__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./partials/split-characters */ \"./js/partials/split-characters.js\");\n/* harmony import */ var _partials_re_animate_entrance_animations__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./partials/re-animate-entrance-animations */ \"./js/partials/re-animate-entrance-animations.js\");\n/* harmony import */ var _partials_re_animate_entrance_animations__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_partials_re_animate_entrance_animations__WEBPACK_IMPORTED_MODULE_2__);\n\r\n\r\n\r\n\r\n\n\n//# sourceURL=webpack:///./js/frontend.js?");

/***/ }),

/***/ "./js/partials/re-animate-entrance-animations.js":
/*!*******************************************************!*\
  !*** ./js/partials/re-animate-entrance-animations.js ***!
  \*******************************************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

eval("/* provided dependency */ var jQuery = __webpack_require__(/*! jquery */ \"jquery\");\nconst $ = jQuery;\r\nconst repeatAnimationSelector = '.repeat-entrance-animation';\r\nconst waitForElementorTimeout = 200;\r\n\r\nwindow.addEventListener('DOMContentLoaded', () => {\r\n    trackElementsForAnimation();\r\n})\r\n\r\n/*\r\nGet a string of classes to remove and add for an element. Parse existing classes, exclude any class starting with 'elementor'\r\n*/\r\nconst setToggleClasses = (target) => {\r\n    if( undefined === target ) { return };\r\n    let toggleClasses = ''\r\n    target.classList.forEach((e) => {\r\n        toggleClasses += e.startsWith('elementor') ? '' : e + ' ';\r\n    });\r\n    target.setAttribute('data-toggle-classes', toggleClasses);\r\n}\r\n\r\nconst checkForAnimatedClass = target => {\r\n    return new Promise(resolve => {\r\n        setTimeout(() => {\r\n                resolve(target.classList.contains('animated'));\r\n        }, waitForElementorTimeout);\r\n    })\r\n}\r\n\r\nconst asyncCall = async target => {\r\n    const result = await checkForAnimatedClass(target);\r\n    if (false === result) {\r\n        asyncCall(target).then(()=>{\r\n\r\n        });\r\n    } else {\r\n\r\n        return(target);\r\n    }\r\n}\r\n\r\nconst trackElementsForAnimation = () => {\r\n    const options = {\r\n        root: null,\r\n        rootMargin: '0px',\r\n        threshold: 0.1\r\n    }\r\n\r\n    const observer = new IntersectionObserver((entries, observer) => {\r\n        entries.forEach((e) => {\r\n            let target = e.target;\r\n            let $target = $(target);\r\n            if (e.isIntersecting) {\r\n                /*\r\n                Get the classes to toggle here. If we get them on the observer init, Elementor would not yet have added teh animation classes.\r\n                */\r\n                if (undefined === target.dataset.toggleClasses) {\r\n                    /*\r\n                        waitForElementorTimeout timout allows time for Elementor to add animation classes.\r\n                    */\r\n                    asyncCall(target).then((t)=>{\r\n                        setToggleClasses(t);\r\n                    });\r\n                }\r\n                $target.addClass($target.data('toggle-classes'));\r\n                $target.css('opacity', '1');\r\n            } else {\r\n                $target.removeClass($target.data('toggle-classes'));\r\n                $target.css('opacity', '0');\r\n            }\r\n        });\r\n    }, options);\r\n\r\n\r\n    /*\r\n        Start observing elements\r\n     */\r\n    document.querySelectorAll(repeatAnimationSelector).forEach((i) => {\r\n        if (i) {\r\n            observer.observe(i);\r\n        }\r\n    });\r\n}\r\n\n\n//# sourceURL=webpack:///./js/partials/re-animate-entrance-animations.js?");

/***/ }),

/***/ "jquery":
/*!*************************!*\
  !*** external "jQuery" ***!
  \*************************/
/***/ ((module) => {

"use strict";
module.exports = jQuery;

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"frontend": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkIds[i]] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["vendor","common"], () => (__webpack_require__("./js/frontend.js")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;