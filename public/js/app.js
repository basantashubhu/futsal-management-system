/* axios v0.18.0 | (c) 2018 by Matt Zabriskie */
(function webpackUniversalModuleDefinition(root, factory) {
	if(typeof exports === 'object' && typeof module === 'object')
		module.exports = factory();
	else if(typeof define === 'function' && define.amd)
		define([], factory);
	else if(typeof exports === 'object')
		exports["axios"] = factory();
	else
		root["axios"] = factory();
})(this, function() {
return /******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

	module.exports = __webpack_require__(1);

/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var utils = __webpack_require__(2);
	var bind = __webpack_require__(3);
	var Axios = __webpack_require__(5);
	var defaults = __webpack_require__(6);
	
	/**
	 * Create an instance of Axios
	 *
	 * @param {Object} defaultConfig The default config for the instance
	 * @return {Axios} A new instance of Axios
	 */
	function createInstance(defaultConfig) {
	  var context = new Axios(defaultConfig);
	  var instance = bind(Axios.prototype.request, context);
	
	  // Copy axios.prototype to instance
	  utils.extend(instance, Axios.prototype, context);
	
	  // Copy context to instance
	  utils.extend(instance, context);
	
	  return instance;
	}
	
	// Create the default instance to be exported
	var axios = createInstance(defaults);
	
	// Expose Axios class to allow class inheritance
	axios.Axios = Axios;
	
	// Factory for creating new instances
	axios.create = function create(instanceConfig) {
	  return createInstance(utils.merge(defaults, instanceConfig));
	};
	
	// Expose Cancel & CancelToken
	axios.Cancel = __webpack_require__(23);
	axios.CancelToken = __webpack_require__(24);
	axios.isCancel = __webpack_require__(20);
	
	// Expose all/spread
	axios.all = function all(promises) {
	  return Promise.all(promises);
	};
	axios.spread = __webpack_require__(25);
	
	module.exports = axios;
	
	// Allow use of default import syntax in TypeScript
	module.exports.default = axios;


/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var bind = __webpack_require__(3);
	var isBuffer = __webpack_require__(4);
	
	/*global toString:true*/
	
	// utils is a library of generic helper functions non-specific to axios
	
	var toString = Object.prototype.toString;
	
	/**
	 * Determine if a value is an Array
	 *
	 * @param {Object} val The value to test
	 * @returns {boolean} True if value is an Array, otherwise false
	 */
	function isArray(val) {
	  return toString.call(val) === '[object Array]';
	}
	
	/**
	 * Determine if a value is an ArrayBuffer
	 *
	 * @param {Object} val The value to test
	 * @returns {boolean} True if value is an ArrayBuffer, otherwise false
	 */
	function isArrayBuffer(val) {
	  return toString.call(val) === '[object ArrayBuffer]';
	}
	
	/**
	 * Determine if a value is a FormData
	 *
	 * @param {Object} val The value to test
	 * @returns {boolean} True if value is an FormData, otherwise false
	 */
	function isFormData(val) {
	  return (typeof FormData !== 'undefined') && (val instanceof FormData);
	}
	
	/**
	 * Determine if a value is a view on an ArrayBuffer
	 *
	 * @param {Object} val The value to test
	 * @returns {boolean} True if value is a view on an ArrayBuffer, otherwise false
	 */
	function isArrayBufferView(val) {
	  var result;
	  if ((typeof ArrayBuffer !== 'undefined') && (ArrayBuffer.isView)) {
	    result = ArrayBuffer.isView(val);
	  } else {
	    result = (val) && (val.buffer) && (val.buffer instanceof ArrayBuffer);
	  }
	  return result;
	}
	
	/**
	 * Determine if a value is a String
	 *
	 * @param {Object} val The value to test
	 * @returns {boolean} True if value is a String, otherwise false
	 */
	function isString(val) {
	  return typeof val === 'string';
	}
	
	/**
	 * Determine if a value is a Number
	 *
	 * @param {Object} val The value to test
	 * @returns {boolean} True if value is a Number, otherwise false
	 */
	function isNumber(val) {
	  return typeof val === 'number';
	}
	
	/**
	 * Determine if a value is undefined
	 *
	 * @param {Object} val The value to test
	 * @returns {boolean} True if the value is undefined, otherwise false
	 */
	function isUndefined(val) {
	  return typeof val === 'undefined';
	}
	
	/**
	 * Determine if a value is an Object
	 *
	 * @param {Object} val The value to test
	 * @returns {boolean} True if value is an Object, otherwise false
	 */
	function isObject(val) {
	  return val !== null && typeof val === 'object';
	}
	
	/**
	 * Determine if a value is a Date
	 *
	 * @param {Object} val The value to test
	 * @returns {boolean} True if value is a Date, otherwise false
	 */
	function isDate(val) {
	  return toString.call(val) === '[object Date]';
	}
	
	/**
	 * Determine if a value is a File
	 *
	 * @param {Object} val The value to test
	 * @returns {boolean} True if value is a File, otherwise false
	 */
	function isFile(val) {
	  return toString.call(val) === '[object File]';
	}
	
	/**
	 * Determine if a value is a Blob
	 *
	 * @param {Object} val The value to test
	 * @returns {boolean} True if value is a Blob, otherwise false
	 */
	function isBlob(val) {
	  return toString.call(val) === '[object Blob]';
	}
	
	/**
	 * Determine if a value is a Function
	 *
	 * @param {Object} val The value to test
	 * @returns {boolean} True if value is a Function, otherwise false
	 */
	function isFunction(val) {
	  return toString.call(val) === '[object Function]';
	}
	
	/**
	 * Determine if a value is a Stream
	 *
	 * @param {Object} val The value to test
	 * @returns {boolean} True if value is a Stream, otherwise false
	 */
	function isStream(val) {
	  return isObject(val) && isFunction(val.pipe);
	}
	
	/**
	 * Determine if a value is a URLSearchParams object
	 *
	 * @param {Object} val The value to test
	 * @returns {boolean} True if value is a URLSearchParams object, otherwise false
	 */
	function isURLSearchParams(val) {
	  return typeof URLSearchParams !== 'undefined' && val instanceof URLSearchParams;
	}
	
	/**
	 * Trim excess whitespace off the beginning and end of a string
	 *
	 * @param {String} str The String to trim
	 * @returns {String} The String freed of excess whitespace
	 */
	function trim(str) {
	  return str.replace(/^\s*/, '').replace(/\s*$/, '');
	}
	
	/**
	 * Determine if we're running in a standard browser environment
	 *
	 * This allows axios to run in a web worker, and react-native.
	 * Both environments support XMLHttpRequest, but not fully standard globals.
	 *
	 * web workers:
	 *  typeof window -> undefined
	 *  typeof document -> undefined
	 *
	 * react-native:
	 *  navigator.product -> 'ReactNative'
	 */
	function isStandardBrowserEnv() {
	  if (typeof navigator !== 'undefined' && navigator.product === 'ReactNative') {
	    return false;
	  }
	  return (
	    typeof window !== 'undefined' &&
	    typeof document !== 'undefined'
	  );
	}
	
	/**
	 * Iterate over an Array or an Object invoking a function for each item.
	 *
	 * If `obj` is an Array callback will be called passing
	 * the value, index, and complete array for each item.
	 *
	 * If 'obj' is an Object callback will be called passing
	 * the value, key, and complete object for each property.
	 *
	 * @param {Object|Array} obj The object to iterate
	 * @param {Function} fn The callback to invoke for each item
	 */
	function forEach(obj, fn) {
	  // Don't bother if no value provided
	  if (obj === null || typeof obj === 'undefined') {
	    return;
	  }
	
	  // Force an array if not already something iterable
	  if (typeof obj !== 'object') {
	    /*eslint no-param-reassign:0*/
	    obj = [obj];
	  }
	
	  if (isArray(obj)) {
	    // Iterate over array values
	    for (var i = 0, l = obj.length; i < l; i++) {
	      fn.call(null, obj[i], i, obj);
	    }
	  } else {
	    // Iterate over object keys
	    for (var key in obj) {
	      if (Object.prototype.hasOwnProperty.call(obj, key)) {
	        fn.call(null, obj[key], key, obj);
	      }
	    }
	  }
	}
	
	/**
	 * Accepts varargs expecting each argument to be an object, then
	 * immutably merges the properties of each object and returns result.
	 *
	 * When multiple objects contain the same key the later object in
	 * the arguments list will take precedence.
	 *
	 * Example:
	 *
	 * ```js
	 * var result = merge({foo: 123}, {foo: 456});
	 * console.log(result.foo); // outputs 456
	 * ```
	 *
	 * @param {Object} obj1 Object to merge
	 * @returns {Object} Result of all merge properties
	 */
	function merge(/* obj1, obj2, obj3, ... */) {
	  var result = {};
	  function assignValue(val, key) {
	    if (typeof result[key] === 'object' && typeof val === 'object') {
	      result[key] = merge(result[key], val);
	    } else {
	      result[key] = val;
	    }
	  }
	
	  for (var i = 0, l = arguments.length; i < l; i++) {
	    forEach(arguments[i], assignValue);
	  }
	  return result;
	}
	
	/**
	 * Extends object a by mutably adding to it the properties of object b.
	 *
	 * @param {Object} a The object to be extended
	 * @param {Object} b The object to copy properties from
	 * @param {Object} thisArg The object to bind function to
	 * @return {Object} The resulting value of object a
	 */
	function extend(a, b, thisArg) {
	  forEach(b, function assignValue(val, key) {
	    if (thisArg && typeof val === 'function') {
	      a[key] = bind(val, thisArg);
	    } else {
	      a[key] = val;
	    }
	  });
	  return a;
	}
	
	module.exports = {
	  isArray: isArray,
	  isArrayBuffer: isArrayBuffer,
	  isBuffer: isBuffer,
	  isFormData: isFormData,
	  isArrayBufferView: isArrayBufferView,
	  isString: isString,
	  isNumber: isNumber,
	  isObject: isObject,
	  isUndefined: isUndefined,
	  isDate: isDate,
	  isFile: isFile,
	  isBlob: isBlob,
	  isFunction: isFunction,
	  isStream: isStream,
	  isURLSearchParams: isURLSearchParams,
	  isStandardBrowserEnv: isStandardBrowserEnv,
	  forEach: forEach,
	  merge: merge,
	  extend: extend,
	  trim: trim
	};


/***/ }),
/* 3 */
/***/ (function(module, exports) {

	'use strict';
	
	module.exports = function bind(fn, thisArg) {
	  return function wrap() {
	    var args = new Array(arguments.length);
	    for (var i = 0; i < args.length; i++) {
	      args[i] = arguments[i];
	    }
	    return fn.apply(thisArg, args);
	  };
	};


/***/ }),
/* 4 */
/***/ (function(module, exports) {

	/*!
	 * Determine if an object is a Buffer
	 *
	 * @author   Feross Aboukhadijeh <https://feross.org>
	 * @license  MIT
	 */
	
	// The _isBuffer check is for Safari 5-7 support, because it's missing
	// Object.prototype.constructor. Remove this eventually
	module.exports = function (obj) {
	  return obj != null && (isBuffer(obj) || isSlowBuffer(obj) || !!obj._isBuffer)
	}
	
	function isBuffer (obj) {
	  return !!obj.constructor && typeof obj.constructor.isBuffer === 'function' && obj.constructor.isBuffer(obj)
	}
	
	// For Node v0.10 support. Remove this eventually.
	function isSlowBuffer (obj) {
	  return typeof obj.readFloatLE === 'function' && typeof obj.slice === 'function' && isBuffer(obj.slice(0, 0))
	}


/***/ }),
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var defaults = __webpack_require__(6);
	var utils = __webpack_require__(2);
	var InterceptorManager = __webpack_require__(17);
	var dispatchRequest = __webpack_require__(18);
	
	/**
	 * Create a new instance of Axios
	 *
	 * @param {Object} instanceConfig The default config for the instance
	 */
	function Axios(instanceConfig) {
	  this.defaults = instanceConfig;
	  this.interceptors = {
	    request: new InterceptorManager(),
	    response: new InterceptorManager()
	  };
	}
	
	/**
	 * Dispatch a request
	 *
	 * @param {Object} config The config specific for this request (merged with this.defaults)
	 */
	Axios.prototype.request = function request(config) {
	  /*eslint no-param-reassign:0*/
	  // Allow for axios('example/url'[, config]) a la fetch API
	  if (typeof config === 'string') {
	    config = utils.merge({
	      url: arguments[0]
	    }, arguments[1]);
	  }
	
	  config = utils.merge(defaults, {method: 'get'}, this.defaults, config);
	  config.method = config.method.toLowerCase();
	
	  // Hook up interceptors middleware
	  var chain = [dispatchRequest, undefined];
	  var promise = Promise.resolve(config);
	
	  this.interceptors.request.forEach(function unshiftRequestInterceptors(interceptor) {
	    chain.unshift(interceptor.fulfilled, interceptor.rejected);
	  });
	
	  this.interceptors.response.forEach(function pushResponseInterceptors(interceptor) {
	    chain.push(interceptor.fulfilled, interceptor.rejected);
	  });
	
	  while (chain.length) {
	    promise = promise.then(chain.shift(), chain.shift());
	  }
	
	  return promise;
	};
	
	// Provide aliases for supported request methods
	utils.forEach(['delete', 'get', 'head', 'options'], function forEachMethodNoData(method) {
	  /*eslint func-names:0*/
	  Axios.prototype[method] = function(url, config) {
	    return this.request(utils.merge(config || {}, {
	      method: method,
	      url: url
	    }));
	  };
	});
	
	utils.forEach(['post', 'put', 'patch'], function forEachMethodWithData(method) {
	  /*eslint func-names:0*/
	  Axios.prototype[method] = function(url, data, config) {
	    return this.request(utils.merge(config || {}, {
	      method: method,
	      url: url,
	      data: data
	    }));
	  };
	});
	
	module.exports = Axios;


/***/ }),
/* 6 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var utils = __webpack_require__(2);
	var normalizeHeaderName = __webpack_require__(7);
	
	var DEFAULT_CONTENT_TYPE = {
	  'Content-Type': 'application/x-www-form-urlencoded'
	};
	
	function setContentTypeIfUnset(headers, value) {
	  if (!utils.isUndefined(headers) && utils.isUndefined(headers['Content-Type'])) {
	    headers['Content-Type'] = value;
	  }
	}
	
	function getDefaultAdapter() {
	  var adapter;
	  if (typeof XMLHttpRequest !== 'undefined') {
	    // For browsers use XHR adapter
	    adapter = __webpack_require__(8);
	  } else if (typeof process !== 'undefined') {
	    // For node use HTTP adapter
	    adapter = __webpack_require__(8);
	  }
	  return adapter;
	}
	
	var defaults = {
	  adapter: getDefaultAdapter(),
	
	  transformRequest: [function transformRequest(data, headers) {
	    normalizeHeaderName(headers, 'Content-Type');
	    if (utils.isFormData(data) ||
	      utils.isArrayBuffer(data) ||
	      utils.isBuffer(data) ||
	      utils.isStream(data) ||
	      utils.isFile(data) ||
	      utils.isBlob(data)
	    ) {
	      return data;
	    }
	    if (utils.isArrayBufferView(data)) {
	      return data.buffer;
	    }
	    if (utils.isURLSearchParams(data)) {
	      setContentTypeIfUnset(headers, 'application/x-www-form-urlencoded;charset=utf-8');
	      return data.toString();
	    }
	    if (utils.isObject(data)) {
	      setContentTypeIfUnset(headers, 'application/json;charset=utf-8');
	      return JSON.stringify(data);
	    }
	    return data;
	  }],
	
	  transformResponse: [function transformResponse(data) {
	    /*eslint no-param-reassign:0*/
	    if (typeof data === 'string') {
	      try {
	        data = JSON.parse(data);
	      } catch (e) { /* Ignore */ }
	    }
	    return data;
	  }],
	
	  /**
	   * A timeout in milliseconds to abort a request. If set to 0 (default) a
	   * timeout is not created.
	   */
	  timeout: 0,
	
	  xsrfCookieName: 'XSRF-TOKEN',
	  xsrfHeaderName: 'X-XSRF-TOKEN',
	
	  maxContentLength: -1,
	
	  validateStatus: function validateStatus(status) {
	    return status >= 200 && status < 300;
	  }
	};
	
	defaults.headers = {
	  common: {
	    'Accept': 'application/json, text/plain, */*'
	  }
	};
	
	utils.forEach(['delete', 'get', 'head'], function forEachMethodNoData(method) {
	  defaults.headers[method] = {};
	});
	
	utils.forEach(['post', 'put', 'patch'], function forEachMethodWithData(method) {
	  defaults.headers[method] = utils.merge(DEFAULT_CONTENT_TYPE);
	});
	
	module.exports = defaults;


/***/ }),
/* 7 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var utils = __webpack_require__(2);
	
	module.exports = function normalizeHeaderName(headers, normalizedName) {
	  utils.forEach(headers, function processHeader(value, name) {
	    if (name !== normalizedName && name.toUpperCase() === normalizedName.toUpperCase()) {
	      headers[normalizedName] = value;
	      delete headers[name];
	    }
	  });
	};


/***/ }),
/* 8 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var utils = __webpack_require__(2);
	var settle = __webpack_require__(9);
	var buildURL = __webpack_require__(12);
	var parseHeaders = __webpack_require__(13);
	var isURLSameOrigin = __webpack_require__(14);
	var createError = __webpack_require__(10);
	var btoa = (typeof window !== 'undefined' && window.btoa && window.btoa.bind(window)) || __webpack_require__(15);
	
	module.exports = function xhrAdapter(config) {
	  return new Promise(function dispatchXhrRequest(resolve, reject) {
	    var requestData = config.data;
	    var requestHeaders = config.headers;
	
	    if (utils.isFormData(requestData)) {
	      delete requestHeaders['Content-Type']; // Let the browser set it
	    }
	
	    var request = new XMLHttpRequest();
	    var loadEvent = 'onreadystatechange';
	    var xDomain = false;
	
	    // For IE 8/9 CORS support
	    // Only supports POST and GET calls and doesn't returns the response headers.
	    // DON'T do this for testing b/c XMLHttpRequest is mocked, not XDomainRequest.
	    if (("production") !== 'test' &&
	        typeof window !== 'undefined' &&
	        window.XDomainRequest && !('withCredentials' in request) &&
	        !isURLSameOrigin(config.url)) {
	      request = new window.XDomainRequest();
	      loadEvent = 'onload';
	      xDomain = true;
	      request.onprogress = function handleProgress() {};
	      request.ontimeout = function handleTimeout() {};
	    }
	
	    // HTTP basic authentication
	    if (config.auth) {
	      var username = config.auth.username || '';
	      var password = config.auth.password || '';
	      requestHeaders.Authorization = 'Basic ' + btoa(username + ':' + password);
	    }
	
	    request.open(config.method.toUpperCase(), buildURL(config.url, config.params, config.paramsSerializer), true);
	
	    // Set the request timeout in MS
	    request.timeout = config.timeout;
	
	    // Listen for ready state
	    request[loadEvent] = function handleLoad() {
	      if (!request || (request.readyState !== 4 && !xDomain)) {
	        return;
	      }
	
	      // The request errored out and we didn't get a response, this will be
	      // handled by onerror instead
	      // With one exception: request that using file: protocol, most browsers
	      // will return status as 0 even though it's a successful request
	      if (request.status === 0 && !(request.responseURL && request.responseURL.indexOf('file:') === 0)) {
	        return;
	      }
	
	      // Prepare the response
	      var responseHeaders = 'getAllResponseHeaders' in request ? parseHeaders(request.getAllResponseHeaders()) : null;
	      var responseData = !config.responseType || config.responseType === 'text' ? request.responseText : request.response;
	      var response = {
	        data: responseData,
	        // IE sends 1223 instead of 204 (https://github.com/axios/axios/issues/201)
	        status: request.status === 1223 ? 204 : request.status,
	        statusText: request.status === 1223 ? 'No Content' : request.statusText,
	        headers: responseHeaders,
	        config: config,
	        request: request
	      };
	
	      settle(resolve, reject, response);
	
	      // Clean up request
	      request = null;
	    };
	
	    // Handle low level network errors
	    request.onerror = function handleError() {
	      // Real errors are hidden from us by the browser
	      // onerror should only fire if it's a network error
	      reject(createError('Network Error', config, null, request));
	
	      // Clean up request
	      request = null;
	    };
	
	    // Handle timeout
	    request.ontimeout = function handleTimeout() {
	      reject(createError('timeout of ' + config.timeout + 'ms exceeded', config, 'ECONNABORTED',
	        request));
	
	      // Clean up request
	      request = null;
	    };
	
	    // Add xsrf header
	    // This is only done if running in a standard browser environment.
	    // Specifically not if we're in a web worker, or react-native.
	    if (utils.isStandardBrowserEnv()) {
	      var cookies = __webpack_require__(16);
	
	      // Add xsrf header
	      var xsrfValue = (config.withCredentials || isURLSameOrigin(config.url)) && config.xsrfCookieName ?
	          cookies.read(config.xsrfCookieName) :
	          undefined;
	
	      if (xsrfValue) {
	        requestHeaders[config.xsrfHeaderName] = xsrfValue;
	      }
	    }
	
	    // Add headers to the request
	    if ('setRequestHeader' in request) {
	      utils.forEach(requestHeaders, function setRequestHeader(val, key) {
	        if (typeof requestData === 'undefined' && key.toLowerCase() === 'content-type') {
	          // Remove Content-Type if data is undefined
	          delete requestHeaders[key];
	        } else {
	          // Otherwise add header to the request
	          request.setRequestHeader(key, val);
	        }
	      });
	    }
	
	    // Add withCredentials to request if needed
	    if (config.withCredentials) {
	      request.withCredentials = true;
	    }
	
	    // Add responseType to request if needed
	    if (config.responseType) {
	      try {
	        request.responseType = config.responseType;
	      } catch (e) {
	        // Expected DOMException thrown by browsers not compatible XMLHttpRequest Level 2.
	        // But, this can be suppressed for 'json' type as it can be parsed by default 'transformResponse' function.
	        if (config.responseType !== 'json') {
	          throw e;
	        }
	      }
	    }
	
	    // Handle progress if needed
	    if (typeof config.onDownloadProgress === 'function') {
	      request.addEventListener('progress', config.onDownloadProgress);
	    }
	
	    // Not all browsers support upload events
	    if (typeof config.onUploadProgress === 'function' && request.upload) {
	      request.upload.addEventListener('progress', config.onUploadProgress);
	    }
	
	    if (config.cancelToken) {
	      // Handle cancellation
	      config.cancelToken.promise.then(function onCanceled(cancel) {
	        if (!request) {
	          return;
	        }
	
	        request.abort();
	        reject(cancel);
	        // Clean up request
	        request = null;
	      });
	    }
	
	    if (requestData === undefined) {
	      requestData = null;
	    }
	
	    // Send the request
	    request.send(requestData);
	  });
	};


/***/ }),
/* 9 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var createError = __webpack_require__(10);
	
	/**
	 * Resolve or reject a Promise based on response status.
	 *
	 * @param {Function} resolve A function that resolves the promise.
	 * @param {Function} reject A function that rejects the promise.
	 * @param {object} response The response.
	 */
	module.exports = function settle(resolve, reject, response) {
	  var validateStatus = response.config.validateStatus;
	  // Note: status is not exposed by XDomainRequest
	  if (!response.status || !validateStatus || validateStatus(response.status)) {
	    resolve(response);
	  } else {
	    reject(createError(
	      'Request failed with status code ' + response.status,
	      response.config,
	      null,
	      response.request,
	      response
	    ));
	  }
	};


/***/ }),
/* 10 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var enhanceError = __webpack_require__(11);
	
	/**
	 * Create an Error with the specified message, config, error code, request and response.
	 *
	 * @param {string} message The error message.
	 * @param {Object} config The config.
	 * @param {string} [code] The error code (for example, 'ECONNABORTED').
	 * @param {Object} [request] The request.
	 * @param {Object} [response] The response.
	 * @returns {Error} The created error.
	 */
	module.exports = function createError(message, config, code, request, response) {
	  var error = new Error(message);
	  return enhanceError(error, config, code, request, response);
	};


/***/ }),
/* 11 */
/***/ (function(module, exports) {

	'use strict';
	
	/**
	 * Update an Error with the specified config, error code, and response.
	 *
	 * @param {Error} error The error to update.
	 * @param {Object} config The config.
	 * @param {string} [code] The error code (for example, 'ECONNABORTED').
	 * @param {Object} [request] The request.
	 * @param {Object} [response] The response.
	 * @returns {Error} The error.
	 */
	module.exports = function enhanceError(error, config, code, request, response) {
	  error.config = config;
	  if (code) {
	    error.code = code;
	  }
	  error.request = request;
	  error.response = response;
	  return error;
	};


/***/ }),
/* 12 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var utils = __webpack_require__(2);
	
	function encode(val) {
	  return encodeURIComponent(val).
	    replace(/%40/gi, '@').
	    replace(/%3A/gi, ':').
	    replace(/%24/g, '$').
	    replace(/%2C/gi, ',').
	    replace(/%20/g, '+').
	    replace(/%5B/gi, '[').
	    replace(/%5D/gi, ']');
	}
	
	/**
	 * Build a URL by appending params to the end
	 *
	 * @param {string} url The base of the url (e.g., http://www.google.com)
	 * @param {object} [params] The params to be appended
	 * @returns {string} The formatted url
	 */
	module.exports = function buildURL(url, params, paramsSerializer) {
	  /*eslint no-param-reassign:0*/
	  if (!params) {
	    return url;
	  }
	
	  var serializedParams;
	  if (paramsSerializer) {
	    serializedParams = paramsSerializer(params);
	  } else if (utils.isURLSearchParams(params)) {
	    serializedParams = params.toString();
	  } else {
	    var parts = [];
	
	    utils.forEach(params, function serialize(val, key) {
	      if (val === null || typeof val === 'undefined') {
	        return;
	      }
	
	      if (utils.isArray(val)) {
	        key = key + '[]';
	      } else {
	        val = [val];
	      }
	
	      utils.forEach(val, function parseValue(v) {
	        if (utils.isDate(v)) {
	          v = v.toISOString();
	        } else if (utils.isObject(v)) {
	          v = JSON.stringify(v);
	        }
	        parts.push(encode(key) + '=' + encode(v));
	      });
	    });
	
	    serializedParams = parts.join('&');
	  }
	
	  if (serializedParams) {
	    url += (url.indexOf('?') === -1 ? '?' : '&') + serializedParams;
	  }
	
	  return url;
	};


/***/ }),
/* 13 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var utils = __webpack_require__(2);
	
	// Headers whose duplicates are ignored by node
	// c.f. https://nodejs.org/api/http.html#http_message_headers
	var ignoreDuplicateOf = [
	  'age', 'authorization', 'content-length', 'content-type', 'etag',
	  'expires', 'from', 'host', 'if-modified-since', 'if-unmodified-since',
	  'last-modified', 'location', 'max-forwards', 'proxy-authorization',
	  'referer', 'retry-after', 'user-agent'
	];
	
	/**
	 * Parse headers into an object
	 *
	 * ```
	 * Date: Wed, 27 Aug 2014 08:58:49 GMT
	 * Content-Type: application/json
	 * Connection: keep-alive
	 * Transfer-Encoding: chunked
	 * ```
	 *
	 * @param {String} headers Headers needing to be parsed
	 * @returns {Object} Headers parsed into an object
	 */
	module.exports = function parseHeaders(headers) {
	  var parsed = {};
	  var key;
	  var val;
	  var i;
	
	  if (!headers) { return parsed; }
	
	  utils.forEach(headers.split('\n'), function parser(line) {
	    i = line.indexOf(':');
	    key = utils.trim(line.substr(0, i)).toLowerCase();
	    val = utils.trim(line.substr(i + 1));
	
	    if (key) {
	      if (parsed[key] && ignoreDuplicateOf.indexOf(key) >= 0) {
	        return;
	      }
	      if (key === 'set-cookie') {
	        parsed[key] = (parsed[key] ? parsed[key] : []).concat([val]);
	      } else {
	        parsed[key] = parsed[key] ? parsed[key] + ', ' + val : val;
	      }
	    }
	  });
	
	  return parsed;
	};


/***/ }),
/* 14 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var utils = __webpack_require__(2);
	
	module.exports = (
	  utils.isStandardBrowserEnv() ?
	
	  // Standard browser envs have full support of the APIs needed to test
	  // whether the request URL is of the same origin as current location.
	  (function standardBrowserEnv() {
	    var msie = /(msie|trident)/i.test(navigator.userAgent);
	    var urlParsingNode = document.createElement('a');
	    var originURL;
	
	    /**
	    * Parse a URL to discover it's components
	    *
	    * @param {String} url The URL to be parsed
	    * @returns {Object}
	    */
	    function resolveURL(url) {
	      var href = url;
	
	      if (msie) {
	        // IE needs attribute set twice to normalize properties
	        urlParsingNode.setAttribute('href', href);
	        href = urlParsingNode.href;
	      }
	
	      urlParsingNode.setAttribute('href', href);
	
	      // urlParsingNode provides the UrlUtils interface - http://url.spec.whatwg.org/#urlutils
	      return {
	        href: urlParsingNode.href,
	        protocol: urlParsingNode.protocol ? urlParsingNode.protocol.replace(/:$/, '') : '',
	        host: urlParsingNode.host,
	        search: urlParsingNode.search ? urlParsingNode.search.replace(/^\?/, '') : '',
	        hash: urlParsingNode.hash ? urlParsingNode.hash.replace(/^#/, '') : '',
	        hostname: urlParsingNode.hostname,
	        port: urlParsingNode.port,
	        pathname: (urlParsingNode.pathname.charAt(0) === '/') ?
	                  urlParsingNode.pathname :
	                  '/' + urlParsingNode.pathname
	      };
	    }
	
	    originURL = resolveURL(window.location.href);
	
	    /**
	    * Determine if a URL shares the same origin as the current location
	    *
	    * @param {String} requestURL The URL to test
	    * @returns {boolean} True if URL shares the same origin, otherwise false
	    */
	    return function isURLSameOrigin(requestURL) {
	      var parsed = (utils.isString(requestURL)) ? resolveURL(requestURL) : requestURL;
	      return (parsed.protocol === originURL.protocol &&
	            parsed.host === originURL.host);
	    };
	  })() :
	
	  // Non standard browser envs (web workers, react-native) lack needed support.
	  (function nonStandardBrowserEnv() {
	    return function isURLSameOrigin() {
	      return true;
	    };
	  })()
	);


/***/ }),
/* 15 */
/***/ (function(module, exports) {

	'use strict';
	
	// btoa polyfill for IE<10 courtesy https://github.com/davidchambers/Base64.js
	
	var chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
	
	function E() {
	  this.message = 'String contains an invalid character';
	}
	E.prototype = new Error;
	E.prototype.code = 5;
	E.prototype.name = 'InvalidCharacterError';
	
	function btoa(input) {
	  var str = String(input);
	  var output = '';
	  for (
	    // initialize result and counter
	    var block, charCode, idx = 0, map = chars;
	    // if the next str index does not exist:
	    //   change the mapping table to "="
	    //   check if d has no fractional digits
	    str.charAt(idx | 0) || (map = '=', idx % 1);
	    // "8 - idx % 1 * 8" generates the sequence 2, 4, 6, 8
	    output += map.charAt(63 & block >> 8 - idx % 1 * 8)
	  ) {
	    charCode = str.charCodeAt(idx += 3 / 4);
	    if (charCode > 0xFF) {
	      throw new E();
	    }
	    block = block << 8 | charCode;
	  }
	  return output;
	}
	
	module.exports = btoa;


/***/ }),
/* 16 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var utils = __webpack_require__(2);
	
	module.exports = (
	  utils.isStandardBrowserEnv() ?
	
	  // Standard browser envs support document.cookie
	  (function standardBrowserEnv() {
	    return {
	      write: function write(name, value, expires, path, domain, secure) {
	        var cookie = [];
	        cookie.push(name + '=' + encodeURIComponent(value));
	
	        if (utils.isNumber(expires)) {
	          cookie.push('expires=' + new Date(expires).toGMTString());
	        }
	
	        if (utils.isString(path)) {
	          cookie.push('path=' + path);
	        }
	
	        if (utils.isString(domain)) {
	          cookie.push('domain=' + domain);
	        }
	
	        if (secure === true) {
	          cookie.push('secure');
	        }
	
	        document.cookie = cookie.join('; ');
	      },
	
	      read: function read(name) {
	        var match = document.cookie.match(new RegExp('(^|;\\s*)(' + name + ')=([^;]*)'));
	        return (match ? decodeURIComponent(match[3]) : null);
	      },
	
	      remove: function remove(name) {
	        this.write(name, '', Date.now() - 86400000);
	      }
	    };
	  })() :
	
	  // Non standard browser env (web workers, react-native) lack needed support.
	  (function nonStandardBrowserEnv() {
	    return {
	      write: function write() {},
	      read: function read() { return null; },
	      remove: function remove() {}
	    };
	  })()
	);


/***/ }),
/* 17 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var utils = __webpack_require__(2);
	
	function InterceptorManager() {
	  this.handlers = [];
	}
	
	/**
	 * Add a new interceptor to the stack
	 *
	 * @param {Function} fulfilled The function to handle `then` for a `Promise`
	 * @param {Function} rejected The function to handle `reject` for a `Promise`
	 *
	 * @return {Number} An ID used to remove interceptor later
	 */
	InterceptorManager.prototype.use = function use(fulfilled, rejected) {
	  this.handlers.push({
	    fulfilled: fulfilled,
	    rejected: rejected
	  });
	  return this.handlers.length - 1;
	};
	
	/**
	 * Remove an interceptor from the stack
	 *
	 * @param {Number} id The ID that was returned by `use`
	 */
	InterceptorManager.prototype.eject = function eject(id) {
	  if (this.handlers[id]) {
	    this.handlers[id] = null;
	  }
	};
	
	/**
	 * Iterate over all the registered interceptors
	 *
	 * This method is particularly useful for skipping over any
	 * interceptors that may have become `null` calling `eject`.
	 *
	 * @param {Function} fn The function to call for each interceptor
	 */
	InterceptorManager.prototype.forEach = function forEach(fn) {
	  utils.forEach(this.handlers, function forEachHandler(h) {
	    if (h !== null) {
	      fn(h);
	    }
	  });
	};
	
	module.exports = InterceptorManager;


/***/ }),
/* 18 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var utils = __webpack_require__(2);
	var transformData = __webpack_require__(19);
	var isCancel = __webpack_require__(20);
	var defaults = __webpack_require__(6);
	var isAbsoluteURL = __webpack_require__(21);
	var combineURLs = __webpack_require__(22);
	
	/**
	 * Throws a `Cancel` if cancellation has been requested.
	 */
	function throwIfCancellationRequested(config) {
	  if (config.cancelToken) {
	    config.cancelToken.throwIfRequested();
	  }
	}
	
	/**
	 * Dispatch a request to the server using the configured adapter.
	 *
	 * @param {object} config The config that is to be used for the request
	 * @returns {Promise} The Promise to be fulfilled
	 */
	module.exports = function dispatchRequest(config) {
	  throwIfCancellationRequested(config);
	
	  // Support baseURL config
	  if (config.baseURL && !isAbsoluteURL(config.url)) {
	    config.url = combineURLs(config.baseURL, config.url);
	  }
	
	  // Ensure headers exist
	  config.headers = config.headers || {};
	
	  // Transform request data
	  config.data = transformData(
	    config.data,
	    config.headers,
	    config.transformRequest
	  );
	
	  // Flatten headers
	  config.headers = utils.merge(
	    config.headers.common || {},
	    config.headers[config.method] || {},
	    config.headers || {}
	  );
	
	  utils.forEach(
	    ['delete', 'get', 'head', 'post', 'put', 'patch', 'common'],
	    function cleanHeaderConfig(method) {
	      delete config.headers[method];
	    }
	  );
	
	  var adapter = config.adapter || defaults.adapter;
	
	  return adapter(config).then(function onAdapterResolution(response) {
	    throwIfCancellationRequested(config);
	
	    // Transform response data
	    response.data = transformData(
	      response.data,
	      response.headers,
	      config.transformResponse
	    );
	
	    return response;
	  }, function onAdapterRejection(reason) {
	    if (!isCancel(reason)) {
	      throwIfCancellationRequested(config);
	
	      // Transform response data
	      if (reason && reason.response) {
	        reason.response.data = transformData(
	          reason.response.data,
	          reason.response.headers,
	          config.transformResponse
	        );
	      }
	    }
	
	    return Promise.reject(reason);
	  });
	};


/***/ }),
/* 19 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var utils = __webpack_require__(2);
	
	/**
	 * Transform the data for a request or a response
	 *
	 * @param {Object|String} data The data to be transformed
	 * @param {Array} headers The headers for the request or response
	 * @param {Array|Function} fns A single function or Array of functions
	 * @returns {*} The resulting transformed data
	 */
	module.exports = function transformData(data, headers, fns) {
	  /*eslint no-param-reassign:0*/
	  utils.forEach(fns, function transform(fn) {
	    data = fn(data, headers);
	  });
	
	  return data;
	};


/***/ }),
/* 20 */
/***/ (function(module, exports) {

	'use strict';
	
	module.exports = function isCancel(value) {
	  return !!(value && value.__CANCEL__);
	};


/***/ }),
/* 21 */
/***/ (function(module, exports) {

	'use strict';
	
	/**
	 * Determines whether the specified URL is absolute
	 *
	 * @param {string} url The URL to test
	 * @returns {boolean} True if the specified URL is absolute, otherwise false
	 */
	module.exports = function isAbsoluteURL(url) {
	  // A URL is considered absolute if it begins with "<scheme>://" or "//" (protocol-relative URL).
	  // RFC 3986 defines scheme name as a sequence of characters beginning with a letter and followed
	  // by any combination of letters, digits, plus, period, or hyphen.
	  return /^([a-z][a-z\d\+\-\.]*:)?\/\//i.test(url);
	};


/***/ }),
/* 22 */
/***/ (function(module, exports) {

	'use strict';
	
	/**
	 * Creates a new URL by combining the specified URLs
	 *
	 * @param {string} baseURL The base URL
	 * @param {string} relativeURL The relative URL
	 * @returns {string} The combined URL
	 */
	module.exports = function combineURLs(baseURL, relativeURL) {
	  return relativeURL
	    ? baseURL.replace(/\/+$/, '') + '/' + relativeURL.replace(/^\/+/, '')
	    : baseURL;
	};


/***/ }),
/* 23 */
/***/ (function(module, exports) {

	'use strict';
	
	/**
	 * A `Cancel` is an object that is thrown when an operation is canceled.
	 *
	 * @class
	 * @param {string=} message The message.
	 */
	function Cancel(message) {
	  this.message = message;
	}
	
	Cancel.prototype.toString = function toString() {
	  return 'Cancel' + (this.message ? ': ' + this.message : '');
	};
	
	Cancel.prototype.__CANCEL__ = true;
	
	module.exports = Cancel;


/***/ }),
/* 24 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var Cancel = __webpack_require__(23);
	
	/**
	 * A `CancelToken` is an object that can be used to request cancellation of an operation.
	 *
	 * @class
	 * @param {Function} executor The executor function.
	 */
	function CancelToken(executor) {
	  if (typeof executor !== 'function') {
	    throw new TypeError('executor must be a function.');
	  }
	
	  var resolvePromise;
	  this.promise = new Promise(function promiseExecutor(resolve) {
	    resolvePromise = resolve;
	  });
	
	  var token = this;
	  executor(function cancel(message) {
	    if (token.reason) {
	      // Cancellation has already been requested
	      return;
	    }
	
	    token.reason = new Cancel(message);
	    resolvePromise(token.reason);
	  });
	}
	
	/**
	 * Throws a `Cancel` if cancellation has been requested.
	 */
	CancelToken.prototype.throwIfRequested = function throwIfRequested() {
	  if (this.reason) {
	    throw this.reason;
	  }
	};
	
	/**
	 * Returns an object that contains a new `CancelToken` and a function that, when called,
	 * cancels the `CancelToken`.
	 */
	CancelToken.source = function source() {
	  var cancel;
	  var token = new CancelToken(function executor(c) {
	    cancel = c;
	  });
	  return {
	    token: token,
	    cancel: cancel
	  };
	};
	
	module.exports = CancelToken;


/***/ }),
/* 25 */
/***/ (function(module, exports) {

	'use strict';
	
	/**
	 * Syntactic sugar for invoking a function and expanding an array for arguments.
	 *
	 * Common use case would be to use `Function.prototype.apply`.
	 *
	 *  ```js
	 *  function f(x, y, z) {}
	 *  var args = [1, 2, 3];
	 *  f.apply(null, args);
	 *  ```
	 *
	 * With `spread` this example can be re-written.
	 *
	 *  ```js
	 *  spread(function(x, y, z) {})([1, 2, 3]);
	 *  ```
	 *
	 * @param {Function} callback
	 * @returns {Function}
	 */
	module.exports = function spread(callback) {
	  return function wrap(arr) {
	    return callback.apply(null, arr);
	  };
	};


/***/ })
/******/ ])
});
;
//# sourceMappingURL=axios.map
/**
 * DEVELOPERS
 * ----------------------------------------------
 * SUMAN  THAPA - LEAD  (NEPALNME@GMAIL.COM)
 * ----------------------------------------------
 * - Rakesh Shrestha
 * - Manish Shrestha
 * - Prabhat Gurung
 * - Basanta Tajpuriya
 * - Lekhraj Rai
 * -----------------------------------------------
 * Created On: 5/14/2019
 *
 * THIS INTELLECTUAL PROPERTY IS COPYRIGHT Ⓒ 2018
 * ZEUSLOGIC, INC. ALL RIGHT RESERVED
*/


/**
 * Instance of Route.
 * Initial config setup.
 * Init route parameter
 */

var Route = function(options, cb) {

	for(url in options) {
		if(options[url].hasOwnProperty('url')) {
			window.routes 	= this;
			this.options 	= options;
		}
	}

	this.clearDiv 		= false;
	this.defaultRoute 	= null;
	this.currentRoute	= this.currentRoute ? this.currentRoute : null;
	this.location 		= window.location ? window.location : null;
	this.eventRef 		= $('*[data-route]');
	this.container 		= $("#contentHolder");
	this.activeClass 	= 'm-menu__item--expanded';

	/**
	 * Init route parameters
	 */
	this.prepareRoutes();

}


/**
 * Initialization of routes.
 */
Route.prototype.prepareRoutes = function(){

	// Default Route Executation
	this.defaultRoute = {};
	for(var index in routes.options) {
		if(routes.options[index].hasOwnProperty('default')) {
			this.defaultRoute[index] = routes.options[index];
			if(!this.location.hash.length)
				this.executeRoute(Object.keys(this.defaultRoute));
		}
	}
};


/**
 * Executation of route where XML request and response perform.
 */
var sourceR = null;
Route.prototype.executeRoute = function(route, options = null, cb = null) {

	if(sourceR) {
		sourceR.cancel('Operation canceled');
		// sourceR = null;
	}

	var self 			= this,
		CancelToken		= axios.CancelToken;
		sourceR 		= CancelToken.source();

	if(routes.options.hasOwnProperty(route)) {
		this.currentRoute 	= routes.options[route];

		var u = this.currentRoute.hasOwnProperty('url') ? this.currentRoute.url :
			  				options.hasOwnProperty('url') ? options.url : '404';


		/**
		 * Start Router XHR Process
		 */
		axios({

			  	url 	: u.trim(),
			  	method	: this.currentRoute.hasOwnProperty('method') ? this.currentRoute.method.toLowerCase() : 'get',
			  	cancelToken: sourceR.token,

			}).then( function(response) {
				if(!response.data && (response.data && response.data != '')) {
					return toastr.error("Something went Wrong");
				}

				// Remove Page Router Loader
				$("#contentHolder").find('.m-loader.page').remove();

				// Change Hash
				self.changeUrl(u);

				if(self.clearDiv) {
					$('.__route_container_class').html('');
				}

				// Has Container
				// Default : #contentHolder
				if(routes.options[route].hasOwnProperty('container')) {

					// Has Parent Route
					// Prepare Parent route before child route
					if(routes.options[route].hasOwnProperty('parentRoute')) {
						var prev_response 	= response,
							callback 		= routes.options[route].hasOwnProperty('callback') ? routes.options[route].callback : '',
							pageUrl 		= routes.options[route].hasOwnProperty('url') ? routes.options[route].url : routes.options[route];

						// Execute parent URL
						self.executeRoute(routes.options[route].parentRoute, null, function(){
							self.changeUrl(pageUrl.trim());
							$(routes.options[route].container).addClass('__route_container_class').html(prev_response.data);

							// Current URL callback
							if(callback) {
								window[callback](prev_response);
							}
						})
					}

				} else {
					self.container.addClass('__route_container_class').html(response.data);
				}

				// Add Active Class
				var pageUrl = options.hasOwnProperty('url') ? options.url : routes.options[route];
				if(routes.options[route].hasOwnProperty('class')) {

					routes.activeClass 	= routes.options[route].class;

					$(document).find('.'+routes.activeClass).removeClass(routes.activeClass);
					$('*[data-route="'+pageUrl+'"]').addClass(routes.activeClass);

				} else {

					$('*[data-route]').closest('li').siblings('li').removeClass(routes.activeClass+ " m-menu__item--open");
				  	$('*[data-route="'+pageUrl+'"]').closest('li').addClass(routes.activeClass+ " m-menu__item--open");
				}

				self.currentRoute.hasOwnProperty('callback') ? window[self.currentRoute['callback']](response) : '';

				(typeof cb === 'function') ? cb(response) : '';

				// If Has Initial Load on Parent
				if(routes.options[route].hasOwnProperty('initialLoad')) {
					return self.executeRoute(routes.options[route].initialLoad);
				}

			}).catch( function(error){
				showError(error);
				self.currentRoute.hasOwnProperty('callback') ? window[self.currentRoute['callback']](error) : '';
				$("#contentHolder").find('.m-loader.page').remove();
				(typeof cb === 'function') ? cb(error) : '';

			});

	} else {
		return this.notFound();
	}
}

/**
 * 404 Error for route path.
 */
Route.prototype.notFound = function() {
	$("#contentHolder").find('.m-loader.page').remove();
	toastr.error("View Not Found");
}


/**
 * Get Current URL
 * Current URL is defined on executeRoute method
 */
Route.prototype.getCurrentUrl = function() {
	return (this.currentRoute !== null) ? this.currentRoute.url : false;
}


/**
 * Reload Page using URL
 */
Route.prototype.redirect = function(url) {

	if(!url && url === '' || url === ' ') {
		toastr.error("Route Not Found");
	}

	routeIndex = url;
	if(url.split('/').length > 1) {
		routeIndex = routes.mapRoutes(url);
	}

	routes.executeRoute(routeIndex, {
		url: url
	});
}


/**
 * Change Hash path on browser
 */
Route.prototype.changeUrl = function(url = null) {
	var u = '';
	if(url) {
		u = url;
	} else {
		u = this.currentRoute.hasOwnProperty('url') ? this.currentRoute.url : url;
	}

	if(u.split('#').length > 1) {
		u = u.split('#')[1];
	}
	this.location.hash = u;
};


/**
 * Find dynamic placeholder of route
 */
Route.prototype.getPlaceholder = function(r) {

	var placeHolders = [];
	if(r.split("{").length >= 2){
		for(var i =0; i < r.split("{").length; i++) {
			if(r.split("{")[i].split('}').length >= 2) {
				placeHolders.push(r.split("{")[i].split('}')[0]);
			}
		}
	}
	return placeHolders;
};


/**
 * Get the defined dynamic route path using browser URL
 */

var matched = '';
var u = '';
Route.prototype.mapRoutes = function(url = null) {

	var r = '';
	if(url) {

		var prev = ''
		if(this.options.hasOwnProperty(url) && this.options[url].hasOwnProperty('url')) {
			return url;
		}

		for(var index in this.options) {

			if(index != prev) {
				u = '';
			}
			prev = index;

			if(index.split('/').length == url.split('/').length) {
				for(var i = 0; i <= index.split('/').length; i++) {
					if(index.split('/')[i] != undefined && index.split('/')[i].match(/\{(.*?)\}/g) == null) {
						if(index.split('/')[i].trim() == url.split('/')[i].trim()) {
							matched = true;
							if(matched) {
								u += index.split('/')[i]+'/';
							}
						} else {
							matched = false;
						}
					} else {
						if((index.split('/')[i] != undefined && url.split('/')[i] != undefined) && (index.split('/')[i].trim().match(/\{(.*?)\}/g) != null) && url.split('/')[i].trim().length) {
							matched = true;
							if(matched) {
								u += index.split('/')[i]+'/';
							}
						} else {
							matched = false;
						}
					}
				}

				if(url.split('/').length == u.replace(/.$/,"").split('/').length) {
					r = u.replace(/.$/,"");
				}
			} else {

			}
		}
		return r ? r : 'map not found';
	}

};


function removePrevClass(self) {
	if(routes.location.hash && routes.location.hash.split("#")[1].trim() != self.attr('data-route')) {
		var prevRoute = routes.mapRoutes(routes.location.hash.split("#")[1].trim());
		var prevRouteConfig = routes.options[prevRoute];
		if(!prevRouteConfig)
			return;
		var removeClassList = prevRouteConfig.hasOwnProperty('class') ? prevRouteConfig.class : false;
		if(removeClassList) {
			$('*[data-route="'+routes.location.hash.split("#")[1].trim()+'"]').removeClass(removeClassList);
		}
	}
}


/**
 * Event using *[data-route] attributes of DOM for route executation/navigation
 */
$(document).off('click','*[data-route]').on('click','*[data-route]', function(e) {

	var self 		= $(this),
		routeName 	= self.attr('data-route');

	if(routeName === '' || routeName === ' ') {
		toastr.error("Route Not Found");
	}

	if(routeName.split('/').length > 1) {
		routeName = routes.mapRoutes(routeName);
	}

	removePrevClass(self);
	$("#contentHolder").append('<div class="m-loader page" rel="pageLoader"></div>');
	routes.executeRoute(routeName, {
		url: self.attr('data-route')
	});
});


/**
 * On page reload get defined dynamic route using @mapRoutes method
 * process route params for callback and get dynamic content
 */

window.onload = function() {

	$("#contentHolder").append('<div class="m-loader page" rel="pageLoader"></div>');

	var url = window.location.hash.length ? window.location.hash : '';
	var routeIndex = url.split('#')[1];

	if(routeIndex && routeIndex.split('/').length > 1) {
		routeIndex = routes.mapRoutes(routeIndex);
	}
	if(url && url.split('#')[1] !== "undefined") {
		if(routes.currentRoute && routes.currentRoute.hasOwnProperty('default')) {
			// console.log("Default route detected");
		} else {
			if(Object.keys(window.routes).length && window.routes instanceof Route) {
				routes.executeRoute(routeIndex, {
					url: window.location.hash.split("#")[1]
				});
			}
		}
	}
}


/**
 * Hash Change Event
 */

var oldURL = [];
window.onhashchange = function(e) {
	oldURL.push(e.oldURL);
}

$(document).off('click','.redirect-back').on('click','.redirect-back', redirectBack);


function redirectBack(e) {

	if(typeof e !== "undefined") {
		e.preventDefault();
	}
	if(oldURL.length) {
		var lastURLIndex 	= oldURL.length - 1,
			url 			= oldURL[lastURLIndex],
			routeIndex 		= url.split("#")[1];

		if(routeIndex && routeIndex.split('/').length > 1) {
			routeIndex = routes.mapRoutes(routeIndex);
		}

		if(url && typeof url !== "undefined") {
			if(routes.currentRoute && routes.currentRoute.hasOwnProperty('default')) {
				// console.log("Default route detected");
			} else {
				if(Object.keys(window.routes).length && window.routes instanceof Route) {

					addFormLoader();
					var tempUrl=url.split("#")[1];

					//check if it contains empty hash
					if(tempUrl=="")
					{
						var ind=url.split("#")[0].lastIndexOf('/');
						tempUrl=url.split("#")[0].substring(ind+1);

						if(tempUrl=="home" || tempUrl=="" || tempUrl=="/")
						{
							tempUrl='dashboard';
							routeIndex='dashboard';
						}

					}
					routes.executeRoute(routeIndex, {
						url: tempUrl
					}, function() {
						removeFormLoader();
						oldURL.pop();
					});
				}
			}
		}
	} else {
		// console.warn('Direct jumped path detected');
	}
}


/**
 * Show Error Message On Response status > 500
 */
function showError(error) {
	if(error && error.response &&
		error.response.status && error.response.status >= 500 &&
		error.response.data) {

		// Display Errors
		for(var i = 0; i < error.response.data.length; i++) {
			if(error.response.data[i].type == "error") {
				toastr.error(error.response.data[i].data);
			}
		}

	}
}


var source = null;

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function ajaxRequest(options, cb) {
    if(options.hasOwnProperty('cancelPrevious') && options.cancelPrevious && source) {
    	source.cancel('Operation canceled by the user.');
    }

    if (!options.hasOwnProperty('url'))
        return;

    var requestUrl  = options.url,
        requestData = options.hasOwnProperty('data') ? options.data : '';
    requestMethod   = options.hasOwnProperty('method') ? options.method : 'get',
        form        = options.hasOwnProperty('form') ?
            (document.getElementById(options.form) ? new FormData(document.getElementById(options.form)) : false)
                        : false,
        beforeSend = options.hasOwnProperty('beforeSend') ? (typeof options.beforeSend === 'function') ? options.beforeSend : false : false,
        CancelToken = axios.CancelToken,
        source = CancelToken.source();


    /**
     * Setup CSRF token
     */
    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    /**
     * Setup Interceptors
     */
    var called = false;
    axios.interceptors.request.use(function (config) {
        if(!called) {
            if (beforeSend){
                options.beforeSend();
            }
        }
        called = true;
        // Custom Before send wrapper
        return config;

    }, function (error) {
        // Do something with request error
        return Promise.reject(error);
    });


    axios.interceptors.response.use(function (response) {
        // Do something with response data
        return response;
    }, function (error) {
        // Do something with response error
        return Promise.reject(error);
    });

    // Axios Ajax Request
    return axios({

        method: requestMethod,
        url: requestUrl,
        data: form ? form : requestData,
        cancelToken: source.token,
        validateStatus: function (status) {
            var statusFunction = '';
            switch (status) {
                case 200:
                    statusFunction = function () {
                        // console.log("This is status 200");
                    }
                    break;

                case 400:
                    statusFunction = function () {

                    }
                    break;

                case 401:
                    statusFunction = function () {

                    }
                    break;

                case 403:
                    statusFunction = function () {

                    }
                    break;

                case 404:
                    statusFunction = function () {

                    }
                    break;

                case 419:
                    statusFunction = function () {
                       alert('You have been Kicked off by System Admin');
                       location.assign('/');
                    }
                    break;
                case 405:
                    statusFunction = function () {
                        // console.log("This is status 405");
                    }
                    break;

                case 500:
                    statusFunction = function () {

                    }
                    break;

                default:
                    statusFunction = function () {

                    }
                    break;
            }

            statusFunction();

            return status >= 200 && status < 300; // default

        },

    }).then(function (response) {
        $("#contentHolder").find('.m-loader.page').remove();
        return (typeof cb === 'function') ? cb(response) : response;

    }).catch(function (thrown) {
        handleError(thrown);
        $("#contentHolder").find('.m-loader.page').remove();
        // if (axios.isCancel(thrown))
        // console.log('Request canceled', thrown.message);
        return (typeof cb === 'function') ? cb(thrown) : thrown;
    });
}


function handleError(thrown) {
    if(thrown && thrown.response && thrown.response.status == 500 &&
        thrown.response.data && thrown.response.data[0]  &&
        thrown.response.data[0].type == "error") {
        toastr.error(thrown.response.data[0].data);
    }
}


function readURL(option) {
    if (option.input.files && option.input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(option.img).attr('src', e.target.result);
        }

        reader.readAsDataURL(option.input.files[0]);
    }
}

/**
 * numval
 * Get Number value from string
 */
if (!String.prototype.numval) {
    String.prototype.numval = function () {
        if (this && this.match(/\d+/g)) {
            var numbers = this.match(/\d+/g).map(Number);
            if (numbers && numbers.length === 1)
                return numbers[0];
            else
                return numbers;
        }
    }
}

function showSuccessMessage(response) {
    if (response && response[0] && response[0].type.toLowerCase() == 'success' && response[0].data) {
        toastr.success(response[0].data);
    }
}

function addFormLoader() {
    $("#contentHolder").append('<div class="m-loader page from-top" rel="pageLoader"></div>');
}

function addCSVLoader() {
    $('#CustomTableHolder').append('<div class="text-loader"><div class="loader"></div>\
                                            <div class="process-status">Importing...</div></div>');
}
function changeCSVLoader(count = 0, total = 100) {
    // console.log(count);
    $('#CustomTableHolder').append('<div class="text-loader"><div class="loader"></div>\
                                            <div class="process-status">Importing ' + count + ' of ' + total + '</div></div>');
}

function removeCSVLoader() {
    $('#contentHolder').remove('.text-loader');
}

function removeFormLoader() {
    $("#contentHolder").find('.m-loader.page.from-top').remove();
}


$(document).off('blur', '.ucfirst').on('blur', '.ucfirst', function (e) {
    var inputVal = $(this).val();
    if (inputVal.length) {
        $(this).val(inputVal.ucfirst());
    }
});
﻿/*jslint adsafe: false, bitwise: true, browser: true, cap: false, css: false,
  debug: false, devel: true, eqeqeq: true, es5: false, evil: false,
  forin: false, fragment: false, immed: true, laxbreak: false, newcap: true,
  nomen: false, on: false, onevar: true, passfail: false, plusplus: true,
  regexp: false, rhino: true, safe: false, strict: false, sub: false,
  undef: true, white: false, widget: false, windows: false */
/*global jQuery: false, window: false */
//"use strict";

/*
 * Original code (c) 2010 Nick Galbreath
 * http://code.google.com/p/stringencoders/source/browse/#svn/trunk/javascript
 *
 * jQuery port (c) 2010 Carlo Zottmann
 * http://github.com/carlo/jquery-base64
 *
 * Permission is hereby granted, free of charge, to any person
 * obtaining a copy of this software and associated documentation
 * files (the "Software"), to deal in the Software without
 * restriction, including without limitation the rights to use,
 * copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following
 * conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
 * OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
*/

/* base64 encode/decode compatible with window.btoa/atob
 *
 * window.atob/btoa is a Firefox extension to convert binary data (the "b")
 * to base64 (ascii, the "a").
 *
 * It is also found in Safari and Chrome.  It is not available in IE.
 *
 * if (!window.btoa) window.btoa = $.base64.encode
 * if (!window.atob) window.atob = $.base64.decode
 *
 * The original spec's for atob/btoa are a bit lacking
 * https://developer.mozilla.org/en/DOM/window.atob
 * https://developer.mozilla.org/en/DOM/window.btoa
 *
 * window.btoa and $.base64.encode takes a string where charCodeAt is [0,255]
 * If any character is not [0,255], then an exception is thrown.
 *
 * window.atob and $.base64.decode take a base64-encoded string
 * If the input length is not a multiple of 4, or contains invalid characters
 *   then an exception is thrown.
 */
 
jQuery.base64 = ( function( $ ) {
  
  var _PADCHAR = "=",
    _ALPHA = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/",
    _VERSION = "1.0";


  function _getbyte64( s, i ) {
    // This is oddly fast, except on Chrome/V8.
    // Minimal or no improvement in performance by using a
    // object with properties mapping chars to value (eg. 'A': 0)

    var idx = _ALPHA.indexOf( s.charAt( i ) );

    if ( idx === -1 ) {
      throw "Cannot decode base64";
    }

    return idx;
  }
  
  
  function _decode( s ) {
    var pads = 0,
      i,
      b10,
      imax = s.length,
      x = [];

    s = String( s );
    
    if ( imax === 0 ) {
      return s;
    }

    if ( imax % 4 !== 0 ) {
      throw "Cannot decode base64";
    }

    if ( s.charAt( imax - 1 ) === _PADCHAR ) {
      pads = 1;

      if ( s.charAt( imax - 2 ) === _PADCHAR ) {
        pads = 2;
      }

      // either way, we want to ignore this last block
      imax -= 4;
    }

    for ( i = 0; i < imax; i += 4 ) {
      b10 = ( _getbyte64( s, i ) << 18 ) | ( _getbyte64( s, i + 1 ) << 12 ) | ( _getbyte64( s, i + 2 ) << 6 ) | _getbyte64( s, i + 3 );
      x.push( String.fromCharCode( b10 >> 16, ( b10 >> 8 ) & 0xff, b10 & 0xff ) );
    }

    switch ( pads ) {
      case 1:
        b10 = ( _getbyte64( s, i ) << 18 ) | ( _getbyte64( s, i + 1 ) << 12 ) | ( _getbyte64( s, i + 2 ) << 6 );
        x.push( String.fromCharCode( b10 >> 16, ( b10 >> 8 ) & 0xff ) );
        break;

      case 2:
        b10 = ( _getbyte64( s, i ) << 18) | ( _getbyte64( s, i + 1 ) << 12 );
        x.push( String.fromCharCode( b10 >> 16 ) );
        break;
    }

    return x.join( "" );
  }
  
  
  function _getbyte( s, i ) {
    var x = s.charCodeAt( i );

    if ( x > 255 ) {
      throw "INVALID_CHARACTER_ERR: DOM Exception 5";
    }
    
    return x;
  }


  function _encode( s ) {
    if ( arguments.length !== 1 ) {
      throw "SyntaxError: exactly one argument required";
    }

    s = String( s );

    var i,
      b10,
      x = [],
      imax = s.length - s.length % 3;

    if ( s.length === 0 ) {
      return s;
    }

    for ( i = 0; i < imax; i += 3 ) {
      b10 = ( _getbyte( s, i ) << 16 ) | ( _getbyte( s, i + 1 ) << 8 ) | _getbyte( s, i + 2 );
      x.push( _ALPHA.charAt( b10 >> 18 ) );
      x.push( _ALPHA.charAt( ( b10 >> 12 ) & 0x3F ) );
      x.push( _ALPHA.charAt( ( b10 >> 6 ) & 0x3f ) );
      x.push( _ALPHA.charAt( b10 & 0x3f ) );
    }

    switch ( s.length - imax ) {
      case 1:
        b10 = _getbyte( s, i ) << 16;
        x.push( _ALPHA.charAt( b10 >> 18 ) + _ALPHA.charAt( ( b10 >> 12 ) & 0x3F ) + _PADCHAR + _PADCHAR );
        break;

      case 2:
        b10 = ( _getbyte( s, i ) << 16 ) | ( _getbyte( s, i + 1 ) << 8 );
        x.push( _ALPHA.charAt( b10 >> 18 ) + _ALPHA.charAt( ( b10 >> 12 ) & 0x3F ) + _ALPHA.charAt( ( b10 >> 6 ) & 0x3f ) + _PADCHAR );
        break;
    }

    return x.join( "" );
  }


  return {
    decode: _decode,
    encode: _encode,
    VERSION: _VERSION
  };
      
}( jQuery ) );

/**
 * @preserve tableExport.jquery.plugin
 *
 * Version 1.9.6
 *
 * Copyright (c) 2015-2017 hhurz, https://github.com/hhurz
 *
 * Original Work Copyright (c) 2014 Giri Raj
 *
 * Licensed under the MIT License
 **/

(function ($) {
    $.fn.extend({
        tableExport: function (options) {
            var defaults = {
                consoleLog:        false,
                csvEnclosure:      '"',
                csvSeparator:      ',',
                csvUseBOM:         true,
                displayTableName:  false,
                escape:            false,
                excelFileFormat:   'xlshtml',     // xmlss = XML Spreadsheet 2003 file format (XMLSS), xlshtml = Excel 2000 html format
                excelstyles:       [],            // e.g. ['border-bottom', 'border-top', 'border-left', 'border-right']
                fileName:          'tableExport',
                htmlContent:       false,
                ignoreColumn:      [],
                ignoreRow:         [],
                jsonScope:         'all',         // head, data, all
                jspdf: {
                    orientation:  'p',
                    unit:         'pt',
                    format:       'a4',             // jspdf page format or 'bestfit' for autmatic paper format selection
                    margins:      {left: 20, right: 10, top: 10, bottom: 10},
                    onDocCreated: null,
                    autotable: {
                        styles: {
                            cellPadding: 2,
                            rowHeight:   12,
                            fontSize:    8,
                            fillColor:   255,           // color value or 'inherit' to use css background-color from html table
                            textColor:   50,            // color value or 'inherit' to use css color from html table
                            fontStyle:   'normal',      // normal, bold, italic, bolditalic or 'inherit' to use css font-weight and fonst-style from html table
                            overflow:    'ellipsize',   // visible, hidden, ellipsize or linebreak
                            halign:      'left',        // left, center, right
                            valign:      'middle'       // top, middle, bottom
                        },
                        headerStyles: {
                            fillColor: [52, 73, 94],
                            textColor: 255,
                            fontStyle: 'bold',
                            halign:    'center'
                        },
                        alternateRowStyles: {
                            fillColor: 245
                        },
                        tableExport: {
                            doc:               null,    // jsPDF doc object. If set, an already created doc will be used to export to
                            onAfterAutotable:  null,
                            onBeforeAutotable: null,
                            onAutotableText:   null,
                            onTable:           null,
                            outputImages:      true
                        }
                    }
                },
                numbers: {
                    html: {
                        decimalMark:        '.',
                        thousandsSeparator: ','
                    },
                    output:                         // set to false to not format numbers in exported output
                    {
                        decimalMark:        '.',
                        thousandsSeparator: ','
                    }
                },
                onCellData:        null,
                onCellHtmlData:    null,
                onIgnoreRow:       null,          // onIgnoreRow($tr, rowIndex): function should return true to not export a row
                onMsoNumberFormat: null,          // Excel 2000 html format only. See readme.md for more information about msonumberformat
                outputMode:        'file',        // 'file', 'string', 'base64' or 'window' (experimental)
                pdfmake: {
                    enabled: false,                 // true: use pdfmake instead of jspdf and jspdf-autotable (experimental)
                    docDefinition: {
                        pageOrientation: 'portrait',  // 'portrait' or 'landscape'
                        defaultStyle: {
                            font: 'Roboto'              // default is 'Roboto', for arabic font set this option to 'Mirza' and include mirza_fonts.js
                        }
                    },
                    fonts: {}
                },
                tbodySelector:     'tr',
                tfootSelector:     'tr',          // set empty ('') to prevent export of tfoot rows
                theadSelector:     'tr',
                tableName:         'myTableName',
                type:              'csv',         // 'csv', 'tsv', 'txt', 'sql', 'json', 'xml', 'excel', 'doc', 'png' or 'pdf'
                worksheetName:     'Worksheet'
            };

            var FONT_ROW_RATIO = 1.15;
            var el             = this;
            var DownloadEvt    = null;
            var $hrows         = [];
            var $rows          = [];
            var rowIndex       = 0;
            var rowspans       = [];
            var trData         = '';
            var colNames       = [];
            var blob;
            var $hiddenTableElements = [];
            var checkCellVisibilty = false;     // used to speed up export of tables with extensive css styling

            $.extend(true, defaults, options);

            colNames = GetColumnNames(el);

            if ( defaults.type == 'csv' || defaults.type == 'tsv' || defaults.type == 'txt' ) {

                var csvData   = "";
                var rowlength = 0;
                rowIndex      = 0;

                function csvString (cell, rowIndex, colIndex) {
                    var result = '';

                    if ( cell !== null ) {
                        var dataString = parseString(cell, rowIndex, colIndex);

                        var csvValue = (dataString === null || dataString === '') ? '' : dataString.toString();

                        if ( defaults.type == 'tsv' ) {
                            if ( dataString instanceof Date )
                                dataString.toLocaleString();

                            // According to http://www.iana.org/assignments/media-types/text/tab-separated-values
                            // are fields that contain tabs not allowable in tsv encoding
                            result = replaceAll(csvValue, '\t', ' ');
                        }
                        else {
                            // Takes a string and encapsulates it (by default in double-quotes) if it
                            // contains the csv field separator, spaces, or linebreaks.
                            if ( dataString instanceof Date )
                                result = defaults.csvEnclosure + dataString.toLocaleString() + defaults.csvEnclosure;
                            else {
                                result = replaceAll(csvValue, defaults.csvEnclosure, defaults.csvEnclosure + defaults.csvEnclosure);

                                if ( result.indexOf(defaults.csvSeparator) >= 0 || /[\r\n ]/g.test(result) )
                                    result = defaults.csvEnclosure + result + defaults.csvEnclosure;
                            }
                        }
                    }

                    return result;
                }

                var CollectCsvData = function ($rows, rowselector, length) {

                    $rows.each(function () {
                        trData = "";
                        ForEachVisibleCell(this, rowselector, rowIndex, length + $rows.length,
                            function (cell, row, col) {
                                trData += csvString(cell, row, col) + (defaults.type == 'tsv' ? '\t' : defaults.csvSeparator);
                            });
                        trData = $.trim(trData).substring(0, trData.length - 1);
                        if ( trData.length > 0 ) {

                            if ( csvData.length > 0 )
                                csvData += "\n";

                            csvData += trData;
                        }
                        rowIndex++;
                    });

                    return $rows.length;
                };

                rowlength += CollectCsvData($(el).find('thead').first().find(defaults.theadSelector), 'th,td', rowlength);
                $(el).find('tbody').each(function () {
                    rowlength += CollectCsvData($(this).find(defaults.tbodySelector), 'td,th', rowlength);
                });
                if ( defaults.tfootSelector.length )
                    CollectCsvData($(el).find('tfoot').first().find(defaults.tfootSelector), 'td,th', rowlength);

                csvData += "\n";

                //output
                if ( defaults.consoleLog === true )
                    console.log(csvData);

                if ( defaults.outputMode === 'string' )
                    return csvData;

                if ( defaults.outputMode === 'base64' )
                    return base64encode(csvData);

                if ( defaults.outputMode === 'window' ) {
                    downloadFile(false, 'data:text/' + (defaults.type == 'csv' ? 'csv' : 'plain') + ';charset=utf-8,', csvData);
                    return;
                }

                try {
                    blob = new Blob([csvData], {type: "text/" + (defaults.type == 'csv' ? 'csv' : 'plain') + ";charset=utf-8"});
                    saveAs(blob, defaults.fileName + '.' + defaults.type, (defaults.type != 'csv' || defaults.csvUseBOM === false));
                }
                catch (e) {
                    downloadFile(defaults.fileName + '.' + defaults.type,
                        'data:text/' + (defaults.type == 'csv' ? 'csv' : 'plain') + ';charset=utf-8,' + ((defaults.type == 'csv' && defaults.csvUseBOM) ? '\ufeff' : ''),
                        csvData);
                }

            } else if ( defaults.type == 'sql' ) {

                // Header
                rowIndex   = 0;
                var tdData = "INSERT INTO `" + defaults.tableName + "` (";
                $hrows     = $(el).find('thead').first().find(defaults.theadSelector);
                $hrows.each(function () {
                    ForEachVisibleCell(this, 'th,td', rowIndex, $hrows.length,
                        function (cell, row, col) {
                            tdData += "'" + parseString(cell, row, col) + "',";
                        });
                    rowIndex++;
                    tdData = $.trim(tdData);
                    tdData = $.trim(tdData).substring(0, tdData.length - 1);
                });
                tdData += ") VALUES ";
                // Row vs Column
                $(el).find('tbody').each(function () {
                    $rows.push.apply($rows, $(this).find(defaults.tbodySelector));
                });
                if ( defaults.tfootSelector.length )
                    $rows.push.apply($rows, $(el).find('tfoot').find(defaults.tfootSelector));
                $($rows).each(function () {
                    trData = "";
                    ForEachVisibleCell(this, 'td,th', rowIndex, $hrows.length + $rows.length,
                        function (cell, row, col) {
                            trData += "'" + parseString(cell, row, col) + "',";
                        });
                    if ( trData.length > 3 ) {
                        tdData += "(" + trData;
                        tdData = $.trim(tdData).substring(0, tdData.length - 1);
                        tdData += "),";
                    }
                    rowIndex++;
                });

                tdData = $.trim(tdData).substring(0, tdData.length - 1);
                tdData += ";";

                //output
                if ( defaults.consoleLog === true )
                    console.log(tdData);

                if ( defaults.outputMode === 'string' )
                    return tdData;

                if ( defaults.outputMode === 'base64' )
                    return base64encode(tdData);

                try {
                    blob = new Blob([tdData], {type: "text/plain;charset=utf-8"});
                    saveAs(blob, defaults.fileName + '.sql');
                }
                catch (e) {
                    downloadFile(defaults.fileName + '.sql',
                        'data:application/sql;charset=utf-8,',
                        tdData);
                }

            } else if ( defaults.type == 'json' ) {
                var jsonHeaderArray = [];
                $hrows              = $(el).find('thead').first().find(defaults.theadSelector);
                $hrows.each(function () {
                    var jsonArrayTd = [];

                    ForEachVisibleCell(this, 'th,td', rowIndex, $hrows.length,
                        function (cell, row, col) {
                            jsonArrayTd.push(parseString(cell, row, col));
                        });
                    jsonHeaderArray.push(jsonArrayTd);
                });

                var jsonArray = [];
                $(el).find('tbody').each(function () {
                    $rows.push.apply($rows, $(this).find(defaults.tbodySelector));
                });
                if ( defaults.tfootSelector.length )
                    $rows.push.apply($rows, $(el).find('tfoot').find(defaults.tfootSelector));
                $($rows).each(function () {
                    var jsonObjectTd = {};
                    var colIndex = 0;

                    ForEachVisibleCell(this, 'td,th', rowIndex, $hrows.length + $rows.length,
                        function (cell, row, col) {
                            if ( jsonHeaderArray.length ) {
                                jsonObjectTd[jsonHeaderArray[jsonHeaderArray.length - 1][colIndex]] = parseString(cell, row, col);
                            } else {
                                jsonObjectTd[colIndex] = parseString(cell, row, col);
                            }
                            colIndex++;
                        });
                    if ( $.isEmptyObject(jsonObjectTd) === false )
                        jsonArray.push(jsonObjectTd);

                    rowIndex++;
                });

                var sdata = "";

                if ( defaults.jsonScope == 'head' )
                    sdata = JSON.stringify(jsonHeaderArray);
                else if ( defaults.jsonScope == 'data' )
                    sdata = JSON.stringify(jsonArray);
                else // all
                    sdata = JSON.stringify({header: jsonHeaderArray, data: jsonArray});

                if ( defaults.consoleLog === true )
                    console.log(sdata);

                if ( defaults.outputMode === 'string' )
                    return sdata;

                if ( defaults.outputMode === 'base64' )
                    return base64encode(sdata);

                try {
                    blob = new Blob([sdata], {type: "application/json;charset=utf-8"});
                    saveAs(blob, defaults.fileName + '.json');
                }
                catch (e) {
                    downloadFile(defaults.fileName + '.json',
                        'data:application/json;charset=utf-8;base64,',
                        sdata);
                }

            } else if ( defaults.type === 'xml' ) {

                rowIndex = 0;
                var xml  = '<?xml version="1.0" encoding="utf-8"?>';
                xml += '<tabledata><fields>';

                // Header
                $hrows = $(el).find('thead').first().find(defaults.theadSelector);
                $hrows.each(function () {

                    ForEachVisibleCell(this, 'th,td', rowIndex, $hrows.length,
                        function (cell, row, col) {
                            xml += "<field>" + parseString(cell, row, col) + "</field>";
                        });
                    rowIndex++;
                });
                xml += '</fields><data>';

                // Row Vs Column
                var rowCount = 1;
                $(el).find('tbody').each(function () {
                    $rows.push.apply($rows, $(this).find(defaults.tbodySelector));
                });
                if ( defaults.tfootSelector.length )
                    $rows.push.apply($rows, $(el).find('tfoot').find(defaults.tfootSelector));
                $($rows).each(function () {
                    var colCount = 1;
                    trData       = "";
                    ForEachVisibleCell(this, 'td,th', rowIndex, $hrows.length + $rows.length,
                        function (cell, row, col) {
                            trData += "<column-" + colCount + ">" + parseString(cell, row, col) + "</column-" + colCount + ">";
                            colCount++;
                        });
                    if ( trData.length > 0 && trData != "<column-1></column-1>" ) {
                        xml += '<row id="' + rowCount + '">' + trData + '</row>';
                        rowCount++;
                    }

                    rowIndex++;
                });
                xml += '</data></tabledata>';

                //output
                if ( defaults.consoleLog === true )
                    console.log(xml);

                if ( defaults.outputMode === 'string' )
                    return xml;

                if ( defaults.outputMode === 'base64' )
                    return base64encode(xml);

                try {
                    blob = new Blob([xml], {type: "application/xml;charset=utf-8"});
                    saveAs(blob, defaults.fileName + '.xml');
                }
                catch (e) {
                    downloadFile(defaults.fileName + '.xml',
                        'data:application/xml;charset=utf-8;base64,',
                        xml);
                }
            }
            else if ( defaults.type === 'excel' && defaults.excelFileFormat === 'xmlss' ) {
                var docDatas = [];

                $(el).filter(function () {
                    return isVisible($(this));
                }).each(function () {
                    var $table  = $(this);
                    var docData = '';

                    $hiddenTableElements = $table.find("tr, th, td").filter(":hidden");
                    checkCellVisibilty = $hiddenTableElements.length > 0;

                    rowIndex    = 0;
                    colNames    = GetColumnNames(this);
                    $hrows      = $table.find('thead').first().find(defaults.theadSelector);
                    docData    += '<Table>';

                    // Header
                    var cols = 0;
                    $hrows.each(function () {
                        trData = "";
                        ForEachVisibleCell(this, 'th,td', rowIndex, $hrows.length,
                            function (cell, row, col) {
                                if ( cell !== null ) {
                                    trData += '<Cell><Data ss:Type="String">' + parseString(cell, row, col) + '</Data></Cell>';
                                    cols++;
                                }
                            });
                        if ( trData.length > 0 )
                            docData += '<Row>' + trData + '</Row>';
                        rowIndex++;
                    });

                    // Row Vs Column, support multiple tbodys
                    $rows = [];
                    $table.find('tbody').each(function () {
                        $rows.push.apply($rows, $(this).find(defaults.tbodySelector));
                    });

                    //if (defaults.tfootSelector.length)
                    //    $rows.push.apply($rows, $table.find('tfoot').find(defaults.tfootSelector));

                    $($rows).each(function () {
                        trData   = "";
                        ForEachVisibleCell(this, 'td,th', rowIndex, $hrows.length + $rows.length,
                            function (cell, row, col) {
                                if ( cell !== null ) {
                                    var type  = "String";
                                    var style = "";
                                    var data  = parseString(cell, row, col);

                                    if ( jQuery.isNumeric(data) !== false ) {
                                        type = "Number";
                                    }
                                    else {
                                        var number = parsePercent(data);
                                        if ( number !== false ) {
                                            data  = number;
                                            type  = "Number";
                                            style = ' ss:StyleID="pct1"';
                                        }
                                    }

                                    if ( type !== "Number" )
                                        data = data.replace(/\n/g, '<br>');

                                    trData += '<Cell' + style + '><Data ss:Type="' + type + '">' + data + '</Data></Cell>';
                                }
                            });
                        if ( trData.length > 0 )
                            docData += '<Row>' + trData + '</Row>';
                        rowIndex++;
                    });

                    docData += '</Table>';
                    docDatas.push(docData);

                    if ( defaults.consoleLog === true )
                        console.log(docData);
                });

                var CreationDate = new Date().toISOString();
                var xmlssDocFile = '<?xml version="1.0" encoding="UTF-8"?><?mso-application progid="Excel.Sheet"?> ' +
                    '<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet" ' +
                    'xmlns:o="urn:schemas-microsoft-com:office:office" ' +
                    'xmlns:x="urn:schemas-microsoft-com:office:excel" ' +
                    'xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet" ' +
                    'xmlns:html="http://www.w3.org/TR/REC-html40"> ' +
                    '<DocumentProperties xmlns="urn:schemas-microsoft-com:office:office"> ' +
                    '<Created>' + CreationDate + '</Created> ' +
                    '</DocumentProperties> ' +
                    '<OfficeDocumentSettings xmlns="urn:schemas-microsoft-com:office:office"> ' +
                    '<AllowPNG/> ' +
                    '</OfficeDocumentSettings> ' +
                    '<ExcelWorkbook xmlns="urn:schemas-microsoft-com:office:excel"> ' +
                    '<WindowHeight>9000</WindowHeight> ' +
                    '<WindowWidth>13860</WindowWidth> ' +
                    '<WindowTopX>0</WindowTopX> ' +
                    '<WindowTopY>0</WindowTopY> ' +
                    '<ProtectStructure>False</ProtectStructure> ' +
                    '<ProtectWindows>False</ProtectWindows> ' +
                    '</ExcelWorkbook> ' +
                    '<Styles> ' +
                    '<Style ss:ID="Default" ss:Name="Default"> ' +
                    '<Alignment ss:Vertical="Center"/> ' +
                    '<Borders/> ' +
                    '<Font/> ' +
                    '<Interior/> ' +
                    '<NumberFormat/> ' +
                    '<Protection/> ' +
                    '</Style> ' +
                    '<Style ss:ID="Normal" ss:Name="Normal"/> ' +
                    '<Style ss:ID="pct1"> ' +
                    '  <NumberFormat ss:Format="Percent"/> ' +
                    '</Style> ' +
                    '</Styles>';

                for ( var j = 0; j < docDatas.length; j++ ) {
                    var ssName = typeof defaults.worksheetName === 'string' ? defaults.worksheetName + ' ' + (j + 1) :
                        typeof defaults.worksheetName[j] !== 'undefined' ? defaults.worksheetName[j] :
                        'Table ' + (j + 1);

                    xmlssDocFile += '<Worksheet ss:Name="' + ssName + '">' +
                        docDatas[j] +
                        '<WorksheetOptions/> ' +
                        '</Worksheet>';
                }

                xmlssDocFile += '</Workbook>';

                if ( defaults.consoleLog === true )
                    console.log(xmlssDocFile);

                if ( defaults.outputMode === 'string' )
                    return xmlssDocFile;

                if ( defaults.outputMode === 'base64' )
                    return base64encode(xmlssDocFile);

                try {
                    blob = new Blob([xmlssDocFile], {type: "application/xml;charset=utf-8"});
                    saveAs(blob, defaults.fileName + '.xml');
                }
                catch (e) {
                    downloadFile(defaults.fileName + '.xml',
                        'data:application/xml;charset=utf-8;base64,',
                        xmlssDocFile);
                }
            }
            else if ( defaults.type == 'excel' || defaults.type == 'xls' || defaults.type == 'word' || defaults.type == 'doc' ) {

                var MSDocType   = (defaults.type == 'excel' || defaults.type == 'xls') ? 'excel' : 'word';
                var MSDocExt    = (MSDocType == 'excel') ? 'xls' : 'doc';
                var MSDocSchema = 'xmlns:x="urn:schemas-microsoft-com:office:' + MSDocType + '"';
                var docData     = '';

                $(el).filter(function () {
                    return isVisible($(this));
                }).each(function () {
                    var $table = $(this);

                    $hiddenTableElements = $table.find("tr, th, td").filter(":hidden");
                    checkCellVisibilty = $hiddenTableElements.length > 0;

                    rowIndex   = 0;
                    colNames   = GetColumnNames(this);

                    // Header
                    docData += '<table><thead>';
                    $hrows = $table.find('thead').first().find(defaults.theadSelector);
                    $hrows.each(function () {
                        trData = "";
                        ForEachVisibleCell(this, 'th,td', rowIndex, $hrows.length,
                            function (cell, row, col) {
                                if ( cell !== null ) {
                                    var thstyle = '';
                                    trData += '<th';
                                    for ( var styles in defaults.excelstyles ) {
                                        if ( defaults.excelstyles.hasOwnProperty(styles) ) {
                                            var thcss = $(cell).css(defaults.excelstyles[styles]);
                                            if ( thcss !== '' && thcss != '0px none rgb(0, 0, 0)' && thcss != 'rgba(0, 0, 0, 0)' ) {
                                                thstyle += (thstyle === '') ? 'style="' : ';';
                                                thstyle += defaults.excelstyles[styles] + ':' + thcss;
                                            }
                                        }
                                    }
                                    if ( thstyle !== '' )
                                        trData += ' ' + thstyle + '"';
                                    if ( $(cell).is("[colspan]") )
                                        trData += ' colspan="' + $(cell).attr('colspan') + '"';
                                    if ( $(cell).is("[rowspan]") )
                                        trData += ' rowspan="' + $(cell).attr('rowspan') + '"';
                                    trData += '>' + parseString(cell, row, col) + '</th>';
                                }
                            });
                        if ( trData.length > 0 )
                            docData += '<tr>' + trData + '</tr>';
                        rowIndex++;
                    });

                    docData += '</thead><tbody>';
                    // Row Vs Column, support multiple tbodys
                    $table.find('tbody').each(function () {
                        $rows.push.apply($rows, $(this).find(defaults.tbodySelector));
                    });
                    if ( defaults.tfootSelector.length )
                        $rows.push.apply($rows, $table.find('tfoot').find(defaults.tfootSelector));

                    $($rows).each(function () {
                        var $row = $(this);
                        trData   = "";
                        ForEachVisibleCell(this, 'td,th', rowIndex, $hrows.length + $rows.length,
                            function (cell, row, col) {
                                if ( cell !== null ) {
                                    var tdvalue = parseString(cell, row, col);
                                    var tdstyle = '';
                                    var tdcss   = $(cell).data("tableexport-msonumberformat");

                                    if ( typeof tdcss == 'undefined' && typeof defaults.onMsoNumberFormat === 'function' )
                                        tdcss = defaults.onMsoNumberFormat(cell, row, col);

                                    if ( typeof tdcss != 'undefined' && tdcss !== '' )
                                        tdstyle = 'style="mso-number-format:\'' + tdcss + '\'';

                                    for ( var cssStyle in defaults.excelstyles ) {
                                        if ( defaults.excelstyles.hasOwnProperty(cssStyle) ) {
                                            tdcss = $(cell).css(defaults.excelstyles[cssStyle]);
                                            if ( tdcss === '' )
                                                tdcss = $row.css(defaults.excelstyles[cssStyle]);

                                            if ( tdcss !== '' && tdcss != '0px none rgb(0, 0, 0)' && tdcss != 'rgba(0, 0, 0, 0)' ) {
                                                tdstyle += (tdstyle === '') ? 'style="' : ';';
                                                tdstyle += defaults.excelstyles[cssStyle] + ':' + tdcss;
                                            }
                                        }
                                    }
                                    trData += '<td';
                                    if ( tdstyle !== '' )
                                        trData += ' ' + tdstyle + '"';
                                    if ( $(cell).is("[colspan]") )
                                        trData += ' colspan="' + $(cell).attr('colspan') + '"';
                                    if ( $(cell).is("[rowspan]") )
                                        trData += ' rowspan="' + $(cell).attr('rowspan') + '"';

                                    if ( typeof tdvalue === 'string' && tdvalue != '' )
                                        tdvalue = tdvalue.replace(/\n/g, '<br>');

                                    trData += '>' + tdvalue + '</td>';
                                }
                            });
                        if ( trData.length > 0 )
                            docData += '<tr>' + trData + '</tr>';
                        rowIndex++;
                    });

                    if ( defaults.displayTableName )
                        docData += '<tr><td></td></tr><tr><td></td></tr><tr><td>' + parseString($('<p>' + defaults.tableName + '</p>')) + '</td></tr>';

                    docData += '</tbody></table>';

                    if ( defaults.consoleLog === true )
                        console.log(docData);
                });

                //noinspection XmlUnusedNamespaceDeclaration
                var docFile = '<html xmlns:o="urn:schemas-microsoft-com:office:office" ' + MSDocSchema + ' xmlns="http://www.w3.org/TR/REC-html40">';
                docFile += '<meta http-equiv="content-type" content="application/vnd.ms-' + MSDocType + '; charset=UTF-8">';
                docFile += "<head>";
                if ( MSDocType === 'excel' ) {
                    docFile += "<!--[if gte mso 9]>";
                    docFile += "<xml>";
                    docFile += "<x:ExcelWorkbook>";
                    docFile += "<x:ExcelWorksheets>";
                    docFile += "<x:ExcelWorksheet>";
                    docFile += "<x:Name>";
                    docFile += defaults.worksheetName;
                    docFile += "</x:Name>";
                    docFile += "<x:WorksheetOptions>";
                    docFile += "<x:DisplayGridlines/>";
                    docFile += "</x:WorksheetOptions>";
                    docFile += "</x:ExcelWorksheet>";
                    docFile += "</x:ExcelWorksheets>";
                    docFile += "</x:ExcelWorkbook>";
                    docFile += "</xml>";
                    docFile += "<![endif]-->";
                }
                docFile += "<style>br {mso-data-placement:same-cell;}</style>";
                docFile += "</head>";
                docFile += "<body>";
                docFile += docData;
                docFile += "</body>";
                docFile += "</html>";

                if ( defaults.consoleLog === true )
                    console.log(docFile);

                if ( defaults.outputMode === 'string' )
                    return docFile;

                if ( defaults.outputMode === 'base64' )
                    return base64encode(docFile);

                try {
                    blob = new Blob([docFile], {type: 'application/vnd.ms-' + defaults.type});
                    saveAs(blob, defaults.fileName + '.' + MSDocExt);
                }
                catch (e) {
                    downloadFile(defaults.fileName + '.' + MSDocExt,
                        'data:application/vnd.ms-' + MSDocType + ';base64,',
                        docFile);
                }

            } else if ( defaults.type == 'xlsx' ) {

                var data   = [];
                var ranges = [];
                rowIndex   = 0;

                $rows = $(el).find('thead').first().find(defaults.theadSelector);
                $(el).find('tbody').each(function () {
                    $rows.push.apply($rows, $(this).find(defaults.tbodySelector));
                });
                if ( defaults.tfootSelector.length )
                    $rows.push.apply($rows, $(el).find('tfoot').find(defaults.tfootSelector));

                $($rows).each(function () {
                    var cols = [];
                    ForEachVisibleCell(this, 'th,td', rowIndex, $rows.length,
                        function (cell, row, col) {
                            if ( typeof cell !== 'undefined' && cell !== null ) {

                                var cellValue = parseString(cell, row, col);

                                var colspan = parseInt(cell.getAttribute('colspan'));
                                var rowspan = parseInt(cell.getAttribute('rowspan'));

                                // Skip ranges
                                ranges.forEach(function (range) {
                                    if ( rowIndex >= range.s.r && rowIndex <= range.e.r && cols.length >= range.s.c && cols.length <= range.e.c ) {
                                        for ( var i = 0; i <= range.e.c - range.s.c; ++i )
                                            cols.push(null);
                                    }
                                });

                                // Handle Row Span
                                if ( rowspan || colspan ) {
                                    rowspan = rowspan || 1;
                                    colspan = colspan || 1;
                                    ranges.push({
                                        s: {r: rowIndex, c: cols.length},
                                        e: {r: rowIndex + rowspan - 1, c: cols.length + colspan - 1}
                                    });
                                }

                                // Handle Value
                                if ( typeof defaults.onCellData !== 'function' ) {

                                    // Type conversion
                                    if ( cellValue !== "" && cellValue == +cellValue )
                                        cellValue = +cellValue;
                                }
                                cols.push(cellValue !== "" ? cellValue : null);

                                // Handle Colspan
                                if ( colspan )
                                    for ( var k = 0; k < colspan - 1; ++k )
                                        cols.push(null);
                            }
                        });
                    data.push(cols);
                    rowIndex++;
                });

                //noinspection JSPotentiallyInvalidConstructorUsage
                var wb = new jx_Workbook(),
                    ws = jx_createSheet(data);

                // add ranges to worksheet
                ws['!merges'] = ranges;

                // add worksheet to workbook
                wb.SheetNames.push(defaults.worksheetName);
                wb.Sheets[defaults.worksheetName] = ws;

                var wbout = XLSX.write(wb, {bookType: defaults.type, bookSST: false, type: 'binary'});

                try {
                    blob = new Blob([jx_s2ab(wbout)], {type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=UTF-8'});
                    saveAs(blob, defaults.fileName + '.' + defaults.type);
                }
                catch (e) {
                    downloadFile(defaults.fileName + '.' + defaults.type,
                        'data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=UTF-8,',
                        jx_s2ab(wbout));
                }

            } else if ( defaults.type == 'png' ) {
                //html2canvas($(el)[0], {
                //  onrendered: function (canvas) {
                html2canvas($(el)[0]).then(
                    function (canvas) {

                        var image      = canvas.toDataURL();
                        var byteString = atob(image.substring(22)); // remove data stuff
                        var buffer     = new ArrayBuffer(byteString.length);
                        var intArray   = new Uint8Array(buffer);

                        for ( var i = 0; i < byteString.length; i++ )
                            intArray[i] = byteString.charCodeAt(i);

                        if ( defaults.consoleLog === true )
                            console.log(byteString);

                        if ( defaults.outputMode === 'string' )
                            return byteString;

                        if ( defaults.outputMode === 'base64' )
                            return base64encode(image);

                        if ( defaults.outputMode === 'window' ) {
                            window.open(image);
                            return;
                        }

                        try {
                            blob = new Blob([buffer], {type: "image/png"});
                            saveAs(blob, defaults.fileName + '.png');
                        }
                        catch (e) {
                            downloadFile(defaults.fileName + '.png', 'data:image/png,', blob);
                        }
                        //}
                    });

            } else if ( defaults.type == 'pdf' ) {

                if ( defaults.pdfmake.enabled === true ) {
                    // pdf output using pdfmake
                    // https://github.com/bpampuch/pdfmake

                    var widths = [];
                    var body   = [];
                    rowIndex   = 0;

                    var CollectPdfmakeData = function ($rows, colselector, length) {
                        var rlength = 0;

                        $($rows).each(function () {
                            var r = [];

                            ForEachVisibleCell(this, colselector, rowIndex, length,
                                function (cell, row, col) {
                                    if ( typeof cell !== 'undefined' && cell !== null ) {

                                        var colspan = parseInt(cell.getAttribute('colspan'));
                                        var rowspan = parseInt(cell.getAttribute('rowspan'));

                                        var cellValue = parseString(cell, row, col) || " ";

                                        if ( colspan > 1 || rowspan > 1 ) {
                                            colspan = colspan || 1;
                                            rowspan = rowspan || 1;
                                            r.push({colSpan: colspan, rowSpan: rowspan, text: cellValue});
                                        }
                                        else
                                            r.push(cellValue);
                                    }
                                    else
                                        r.push(" ");
                                });

                            if ( r.length )
                                body.push(r);

                            if ( rlength < r.length )
                                rlength = r.length;

                            rowIndex++;
                        });

                        return rlength;
                    };

                    $hrows = $(this).find('thead').first().find(defaults.theadSelector);

                    var colcount = CollectPdfmakeData($hrows, 'th,td', $hrows.length);

                    for ( var i = widths.length; i < colcount; i++ )
                        widths.push("*");

                    $(this).find('tbody').each(function () {
                        $rows.push.apply($rows, $(this).find(defaults.tbodySelector));
                    });
                    if ( defaults.tfootSelector.length )
                        $rows.push.apply($rows, $(this).find('tfoot').find(defaults.tfootSelector));

                    CollectPdfmakeData($rows, 'th,td', $hrows.length + $rows.length);

                    var docDefinition = {
                        content: [{
                            table: {
                                headerRows: $hrows.length,
                                widths:     widths,
                                body:       body
                            }
                        }]
                    };

                    $.extend(true, docDefinition, defaults.pdfmake.docDefinition);

                    pdfMake.fonts = {
                        Roboto: {
                            normal:      'Roboto-Regular.ttf',
                            bold:        'Roboto-Medium.ttf',
                            italics:     'Roboto-Italic.ttf',
                            bolditalics: 'Roboto-MediumItalic.ttf'
                        }
                    };

                    $.extend(true, pdfMake.fonts, defaults.pdfmake.fonts);

                    pdfMake.createPdf(docDefinition).getBuffer(function (buffer) {

                        try {
                            var blob = new Blob([buffer], {type: "application/pdf"});
                            saveAs(blob, defaults.fileName + '.pdf');
                        }
                        catch (e) {
                            downloadFile(defaults.fileName + '.pdf',
                                'data:application/pdf;base64,',
                                buffer);
                        }
                    });

                }
                else if ( defaults.jspdf.autotable === false ) {
                    // pdf output using jsPDF's core html support

                    var addHtmlOptions = {
                        dim:       {
                            w: getPropertyUnitValue($(el).first().get(0), 'width', 'mm'),
                            h: getPropertyUnitValue($(el).first().get(0), 'height', 'mm')
                        },
                        pagesplit: false
                    };

                    var doc = new jsPDF(defaults.jspdf.orientation, defaults.jspdf.unit, defaults.jspdf.format);
                    doc.addHTML($(el).first(),
                        defaults.jspdf.margins.left,
                        defaults.jspdf.margins.top,
                        addHtmlOptions,
                        function () {
                            jsPdfOutput(doc, false);
                        });
                    //delete doc;
                }
                else {
                    // pdf output using jsPDF AutoTable plugin
                    // https://github.com/simonbengtsson/jsPDF-AutoTable

                    var teOptions = defaults.jspdf.autotable.tableExport;

                    // When setting jspdf.format to 'bestfit' tableExport tries to choose
                    // the minimum required paper format and orientation in which the table
                    // (or tables in multitable mode) completely fits without column adjustment
                    if ( typeof defaults.jspdf.format === 'string' && defaults.jspdf.format.toLowerCase() === 'bestfit' ) {
                        var pageFormats = {
                            'a0': [2383.94, 3370.39], 'a1': [1683.78, 2383.94],
                            'a2': [1190.55, 1683.78], 'a3': [841.89, 1190.55],
                            'a4': [595.28, 841.89]
                        };
                        var rk = '', ro = '';
                        var mw = 0;

                        $(el).each(function () {
                            if ( isVisible($(this)) ) {
                                var w = getPropertyUnitValue($(this).get(0), 'width', 'pt');

                                if ( w > mw ) {
                                    if ( w > pageFormats.a0[0] ) {
                                        rk = 'a0';
                                        ro = 'l';
                                    }
                                    for ( var key in pageFormats ) {
                                        if ( pageFormats.hasOwnProperty(key) ) {
                                            if ( pageFormats[key][1] > w ) {
                                                rk = key;
                                                ro = 'l';
                                                if ( pageFormats[key][0] > w )
                                                    ro = 'p';
                                            }
                                        }
                                    }
                                    mw = w;
                                }
                            }
                        });
                        defaults.jspdf.format      = (rk === '' ? 'a4' : rk);
                        defaults.jspdf.orientation = (ro === '' ? 'w' : ro);
                    }

                    // The jsPDF doc object is stored in defaults.jspdf.autotable.tableExport,
                    // thus it can be accessed from any callback function
                    if ( teOptions.doc == null ) {
                        teOptions.doc = new jsPDF(defaults.jspdf.orientation,
                            defaults.jspdf.unit,
                            defaults.jspdf.format);

                        if ( typeof defaults.jspdf.onDocCreated === 'function' )
                            defaults.jspdf.onDocCreated(teOptions.doc);
                    }

                    if ( teOptions.outputImages === true )
                        teOptions.images = {};

                    if ( typeof teOptions.images != 'undefined' ) {
                        $(el).filter(function () {
                            return isVisible($(this));
                        }).each(function () {
                            var rowCount = 0;

                            $hiddenTableElements = $(this).find("tr, th, td").filter(":hidden");
                            checkCellVisibilty = $hiddenTableElements.length > 0;

                            $hrows = $(this).find('thead').find(defaults.theadSelector);
                            $(this).find('tbody').each(function () {
                                $rows.push.apply($rows, $(this).find(defaults.tbodySelector));
                            });
                            if ( defaults.tfootSelector.length )
                                $rows.push.apply($rows, $(this).find('tfoot').find(defaults.tfootSelector));

                            $($rows).each(function () {
                                ForEachVisibleCell(this, 'td,th', $hrows.length + rowCount, $hrows.length + $rows.length,
                                    function (cell) {
                                        if ( typeof cell !== 'undefined' && cell !== null ) {
                                            var kids = $(cell).children();
                                            if ( typeof kids != 'undefined' && kids.length > 0 )
                                                collectImages(cell, kids, teOptions);
                                        }
                                    });
                                rowCount++;
                            });
                        });

                        $hrows = [];
                        $rows  = [];
                    }

                    loadImages(teOptions, function () {
                        $(el).filter(function () {
                            return isVisible($(this));
                        }).each(function () {
                            var colKey;
                            var rowIndex = 0;

                            $hiddenTableElements = $(this).find("tr, th, td").filter(":hidden");
                            checkCellVisibilty = $hiddenTableElements.length > 0;

                            colNames = GetColumnNames(this);

                            teOptions.columns    = [];
                            teOptions.rows       = [];
                            teOptions.rowoptions = {};

                            // onTable: optional callback function for every matching table that can be used
                            // to modify the tableExport options or to skip the output of a particular table
                            // if the table selector targets multiple tables
                            if ( typeof teOptions.onTable === 'function' )
                                if ( teOptions.onTable($(this), defaults) === false )
                                    return true; // continue to next iteration step (table)

                            // each table works with an own copy of AutoTable options
                            defaults.jspdf.autotable.tableExport = null;  // avoid deep recursion error
                            var atOptions                        = $.extend(true, {}, defaults.jspdf.autotable);
                            defaults.jspdf.autotable.tableExport = teOptions;

                            atOptions.margin = {};
                            $.extend(true, atOptions.margin, defaults.jspdf.margins);
                            atOptions.tableExport = teOptions;

                            // Fix jsPDF Autotable's row height calculation
                            if ( typeof atOptions.beforePageContent !== 'function' ) {
                                atOptions.beforePageContent = function (data) {
                                    if ( data.pageCount == 1 ) {
                                        var all = data.table.rows.concat(data.table.headerRow);
                                        all.forEach(function (row) {
                                            if ( row.height > 0 ) {
                                                row.height += (2 - FONT_ROW_RATIO) / 2 * row.styles.fontSize;
                                                data.table.height += (2 - FONT_ROW_RATIO) / 2 * row.styles.fontSize;
                                            }
                                        });
                                    }
                                };
                            }

                            if ( typeof atOptions.createdHeaderCell !== 'function' ) {
                                // apply some original css styles to pdf header cells
                                atOptions.createdHeaderCell = function (cell, data) {

                                    // jsPDF AutoTable plugin v2.0.14 fix: each cell needs its own styles object
                                    cell.styles = $.extend({}, data.row.styles);

                                    if ( typeof teOptions.columns [data.column.dataKey] != 'undefined' ) {
                                        var col = teOptions.columns [data.column.dataKey];

                                        if ( typeof col.rect != 'undefined' ) {
                                            var rh;

                                            cell.contentWidth = col.rect.width;

                                            if ( typeof teOptions.heightRatio == 'undefined' || teOptions.heightRatio === 0 ) {
                                                if ( data.row.raw [data.column.dataKey].rowspan )
                                                    rh = data.row.raw [data.column.dataKey].rect.height / data.row.raw [data.column.dataKey].rowspan;
                                                else
                                                    rh = data.row.raw [data.column.dataKey].rect.height;

                                                teOptions.heightRatio = cell.styles.rowHeight / rh;
                                            }

                                            rh = data.row.raw [data.column.dataKey].rect.height * teOptions.heightRatio;
                                            if ( rh > cell.styles.rowHeight )
                                                cell.styles.rowHeight = rh;
                                        }

                                        if ( typeof col.style != 'undefined' && col.style.hidden !== true ) {
                                            cell.styles.halign = col.style.align;
                                            if ( atOptions.styles.fillColor === 'inherit' )
                                                cell.styles.fillColor = col.style.bcolor;
                                            if ( atOptions.styles.textColor === 'inherit' )
                                                cell.styles.textColor = col.style.color;
                                            if ( atOptions.styles.fontStyle === 'inherit' )
                                                cell.styles.fontStyle = col.style.fstyle;
                                        }
                                    }
                                };
                            }

                            if ( typeof atOptions.createdCell !== 'function' ) {
                                // apply some original css styles to pdf table cells
                                atOptions.createdCell = function (cell, data) {
                                    var rowopt = teOptions.rowoptions [data.row.index + ":" + data.column.dataKey];

                                    if ( typeof rowopt != 'undefined' &&
                                        typeof rowopt.style != 'undefined' &&
                                        rowopt.style.hidden !== true ) {
                                        cell.styles.halign = rowopt.style.align;
                                        if ( atOptions.styles.fillColor === 'inherit' )
                                            cell.styles.fillColor = rowopt.style.bcolor;
                                        if ( atOptions.styles.textColor === 'inherit' )
                                            cell.styles.textColor = rowopt.style.color;
                                        if ( atOptions.styles.fontStyle === 'inherit' )
                                            cell.styles.fontStyle = rowopt.style.fstyle;
                                    }
                                };
                            }

                            if ( typeof atOptions.drawHeaderCell !== 'function' ) {
                                atOptions.drawHeaderCell = function (cell, data) {
                                    var colopt = teOptions.columns [data.column.dataKey];

                                    if ( (colopt.style.hasOwnProperty("hidden") !== true || colopt.style.hidden !== true) &&
                                        colopt.rowIndex >= 0 )
                                        return prepareAutoTableText(cell, data, colopt);
                                    else
                                        return false; // cell is hidden
                                };
                            }

                            if ( typeof atOptions.drawCell !== 'function' ) {
                                atOptions.drawCell = function (cell, data) {
                                    var rowopt = teOptions.rowoptions [data.row.index + ":" + data.column.dataKey];
                                    if ( prepareAutoTableText(cell, data, rowopt) ) {

                                        teOptions.doc.rect(cell.x, cell.y, cell.width, cell.height, cell.styles.fillStyle);

                                        if ( typeof rowopt != 'undefined' && typeof rowopt.kids != 'undefined' && rowopt.kids.length > 0 ) {

                                            var dh = cell.height / rowopt.rect.height;
                                            if ( dh > teOptions.dh || typeof teOptions.dh == 'undefined' )
                                                teOptions.dh = dh;
                                            teOptions.dw = cell.width / rowopt.rect.width;

                                            var y = cell.textPos.y;
                                            drawAutotableElements(cell, rowopt.kids, teOptions);
                                            cell.textPos.y = y;
                                            drawAutotableText(cell, rowopt.kids, teOptions);
                                        }
                                        else
                                            drawAutotableText(cell, {}, teOptions);
                                    }
                                    return false;
                                };
                            }

                            // collect header and data rows
                            teOptions.headerrows = [];
                            $hrows               = $(this).find('thead').find(defaults.theadSelector);
                            $hrows.each(function () {
                                colKey = 0;

                                teOptions.headerrows[rowIndex] = [];

                                ForEachVisibleCell(this, 'th,td', rowIndex, $hrows.length,
                                    function (cell, row, col) {
                                        var obj      = getCellStyles(cell);
                                        obj.title    = parseString(cell, row, col);
                                        obj.key      = colKey++;
                                        obj.rowIndex = rowIndex;
                                        teOptions.headerrows[rowIndex].push(obj);
                                    });
                                rowIndex++;
                            });

                            if ( rowIndex > 0 ) {
                                // iterate through last row
                                var lastrow = rowIndex - 1;
                                while ( lastrow >= 0 ) {
                                    $.each(teOptions.headerrows[lastrow], function () {
                                        var obj = this;

                                        if ( lastrow > 0 && this.rect === null )
                                            obj = teOptions.headerrows[lastrow - 1][this.key];

                                        if ( obj !== null && obj.rowIndex >= 0 &&
                                            (obj.style.hasOwnProperty("hidden") !== true || obj.style.hidden !== true) )
                                            teOptions.columns.push(obj);
                                    });

                                    lastrow = (teOptions.columns.length > 0) ? -1 : lastrow - 1;
                                }
                            }

                            var rowCount = 0;
                            $rows        = [];
                            $(this).find('tbody').each(function () {
                                $rows.push.apply($rows, $(this).find(defaults.tbodySelector));
                            });
                            if ( defaults.tfootSelector.length )
                                $rows.push.apply($rows, $(this).find('tfoot').find(defaults.tfootSelector));
                            $($rows).each(function () {
                                var rowData = [];
                                colKey      = 0;

                                ForEachVisibleCell(this, 'td,th', rowIndex, $hrows.length + $rows.length,
                                    function (cell, row, col) {
                                        var obj;

                                        if ( typeof teOptions.columns[colKey] === 'undefined' ) {
                                            // jsPDF-Autotable needs columns. Thus define hidden ones for tables without thead
                                            obj = {
                                                title: '',
                                                key:   colKey,
                                                style: {
                                                    hidden: true
                                                }
                                            };
                                            teOptions.columns.push(obj);
                                        }
                                        if ( typeof cell !== 'undefined' && cell !== null ) {
                                            obj = getCellStyles(cell);
                                            obj.kids = $(cell).children();
                                            teOptions.rowoptions [rowCount + ":" + colKey++] = obj;
                                        }
                                        else {
                                            obj = $.extend(true, {}, teOptions.rowoptions [rowCount + ":" + (colKey - 1)]);
                                            obj.colspan = -1;
                                            teOptions.rowoptions [rowCount + ":" + colKey++] = obj;
                                        }

                                        rowData.push(parseString(cell, row, col));
                                    });
                                if ( rowData.length ) {
                                    teOptions.rows.push(rowData);
                                    rowCount++;
                                }
                                rowIndex++;
                            });

                            // onBeforeAutotable: optional callback function before calling
                            // jsPDF AutoTable that can be used to modify the AutoTable options
                            if ( typeof teOptions.onBeforeAutotable === 'function' )
                                teOptions.onBeforeAutotable($(this), teOptions.columns, teOptions.rows, atOptions);

                            teOptions.doc.autoTable(teOptions.columns, teOptions.rows, atOptions);

                            // onAfterAutotable: optional callback function after returning
                            // from jsPDF AutoTable that can be used to modify the AutoTable options
                            if ( typeof teOptions.onAfterAutotable === 'function' )
                                teOptions.onAfterAutotable($(this), atOptions);

                            // set the start position for the next table (in case there is one)
                            defaults.jspdf.autotable.startY = teOptions.doc.autoTableEndPosY() + atOptions.margin.top;

                        });

                        jsPdfOutput(teOptions.doc, (typeof teOptions.images != 'undefined' && jQuery.isEmptyObject(teOptions.images) === false));

                        if ( typeof teOptions.headerrows != 'undefined' )
                            teOptions.headerrows.length = 0;
                        if ( typeof teOptions.columns != 'undefined' )
                            teOptions.columns.length = 0;
                        if ( typeof teOptions.rows != 'undefined' )
                            teOptions.rows.length = 0;
                        delete teOptions.doc;
                        teOptions.doc = null;
                    });
                }
            }

            /*
             function FindColObject (objects, colIndex, rowIndex) {
             var result = null;
             $.each(objects, function () {
             if ( this.rowIndex == rowIndex && this.key == colIndex ) {
             result = this;
             return false;
             }
             });
             return result;
             }
             */

            function GetColumnNames (table) {
                var result = [];
                $(table).find('thead').first().find('th').each(function (index, el) {
                    if ( $(el).attr("data-field") !== undefined )
                        result[index] = $(el).attr("data-field");
                    else
                        result[index] = index.toString();
                });
                return result;
            }

            function isVisible ($element) {
                var isCell = typeof $element[0].cellIndex !== 'undefined';
                var isRow = typeof $element[0].rowIndex !== 'undefined';
                var isElementVisible = (isCell || isRow) ? isTableElementVisible($element) : $element.is(':visible');
                var tableexportDisplay = $element.data("tableexport-display");

                if (isCell && tableexportDisplay != 'none' && tableexportDisplay != 'always') {
                    $element = $($element[0].parentNode);
                    isRow = typeof $element[0].rowIndex !== 'undefined';
                    tableexportDisplay = $element.data("tableexport-display");
                }
                if (isRow && tableexportDisplay != 'none' && tableexportDisplay != 'always') {
                    tableexportDisplay = $element.closest('table').data("tableexport-display");
                }

                return tableexportDisplay !== 'none' && (isElementVisible == true || tableexportDisplay == 'always');
            }

            function isTableElementVisible ($element) {
                var hiddenEls = [];

                if ( checkCellVisibilty ) {
                    hiddenEls = $hiddenTableElements.filter (function () {
                        var found = false;

                        if (this.nodeType == $element[0].nodeType) {
                            if (typeof this.rowIndex !== 'undefined' && this.rowIndex == $element[0].rowIndex)
                                found = true;
                            else if (typeof this.cellIndex !== 'undefined' && this.cellIndex == $element[0].cellIndex &&
                                typeof this.parentNode.rowIndex !== 'undefined' &&
                                typeof $element[0].parentNode.rowIndex !== 'undefined' &&
                                this.parentNode.rowIndex == $element[0].parentNode.rowIndex)
                                found = true;
                        }
                        return found;
                    });
                }
                return (checkCellVisibilty == false || hiddenEls.length == 0);
            }

            function isColumnIgnored ($cell, rowLength, colIndex) {
                var result = false;

                if (isVisible($cell)) {
                    if ( defaults.ignoreColumn.length > 0 ) {
                        if ( $.inArray(colIndex, defaults.ignoreColumn) != -1 ||
                            $.inArray(colIndex - rowLength, defaults.ignoreColumn) != -1 ||
                            (colNames.length > colIndex && typeof colNames[colIndex] != 'undefined' &&
                            $.inArray(colNames[colIndex], defaults.ignoreColumn) != -1) )
                            result = true;
                    }
                }
                else
                    result = true;

                return result;
            }

            function ForEachVisibleCell (tableRow, selector, rowIndex, rowCount, cellcallback) {
                if ( typeof (cellcallback) === 'function' ) {
                    var ignoreRow = false;

                    if (typeof defaults.onIgnoreRow === 'function')
                        ignoreRow = defaults.onIgnoreRow($(tableRow), rowIndex);

                    if (ignoreRow === false &&
                        $.inArray(rowIndex, defaults.ignoreRow) == -1 &&
                        $.inArray(rowIndex - rowCount, defaults.ignoreRow) == -1 &&
                        isVisible($(tableRow))) {

                        var $cells = $(tableRow).find(selector);
                        var rowColspan = 0;

                        $cells.each(function (colIndex) {
                            var $cell = $(this);
                            var c, Colspan = 1;
                            var r, Rowspan = 1;
                            var cellCount  = $cells.length;

                            // handle rowspans from previous rows
                            if ( typeof rowspans[rowIndex] != 'undefined' && rowspans[rowIndex].length > 0 ) {
                                var colCount = colIndex;
                                for ( c = 0; c <= colCount; c++ ) {
                                    if ( typeof rowspans[rowIndex][c] != 'undefined' ) {
                                        if ( isColumnIgnored($cell, cellCount, colIndex + rowColspan) === false )
                                            cellcallback(null, rowIndex, c);
                                        delete rowspans[rowIndex][c];
                                        colCount++;
                                    }
                                }
                                colIndex += rowspans[rowIndex].length;
                                cellCount += rowspans[rowIndex].length;
                            }

                            if ( $cell.is("[colspan]") ) {
                                Colspan = parseInt($cell.attr('colspan')) || 1;

                                rowColspan += Colspan > 0 ? Colspan - 1 : 0;
                            }
                            else if ( $cell.is("[rowspan]") )
                                Rowspan = parseInt($cell.attr('rowspan')) || 1;

                            if ( isColumnIgnored($cell, cellCount, colIndex + rowColspan) === false ) {
                                // output content of current cell
                                cellcallback(this, rowIndex, colIndex);

                                // handle colspan of current cell
                                for ( c = 1; c < Colspan; c++ )
                                    cellcallback(null, rowIndex, colIndex + c);
                            }

                            // store rowspan for following rows
                            if ( Rowspan > 1 ) {
                                for ( r = 1; r < Rowspan; r++ ) {
                                    if ( typeof rowspans[rowIndex + r] == 'undefined' )
                                        rowspans[rowIndex + r] = [];

                                    rowspans[rowIndex + r][colIndex + rowColspan] = "";

                                    for ( c = 1; c < Colspan; c++ )
                                        rowspans[rowIndex + r][colIndex + rowColspan - c] = "";
                                }
                            }
                        });

                        // handle rowspans from previous rows
                        if ( typeof rowspans[rowIndex] != 'undefined' && rowspans[rowIndex].length > 0 ) {
                            for ( var c = 0; c <= rowspans[rowIndex].length; c++ ) {
                                if ( typeof rowspans[rowIndex][c] != 'undefined' ) {
                                    cellcallback(null, rowIndex, c);
                                    delete rowspans[rowIndex][c];
                                }
                            }
                        }
                    }
                }
            }

            function jsPdfOutput (doc, hasimages) {
                if ( defaults.consoleLog === true )
                    console.log(doc.output());

                if ( defaults.outputMode === 'string' )
                    return doc.output();

                if ( defaults.outputMode === 'base64' )
                    return base64encode(doc.output());

                if ( defaults.outputMode === 'window' ) {
                    window.open(URL.createObjectURL(doc.output("blob")));
                    return;
                }

                try {
                    var blob = doc.output('blob');
                    saveAs(blob, defaults.fileName + '.pdf');
                }
                catch (e) {
                    downloadFile(defaults.fileName + '.pdf',
                        'data:application/pdf' + (hasimages ? '' : ';base64') + ',',
                        hasimages ? doc.output('blob') : doc.output());
                }
            }

            function prepareAutoTableText (cell, data, cellopt) {
                var cs = 0;
                if ( typeof cellopt != 'undefined' )
                    cs = cellopt.colspan;

                if ( cs >= 0 ) {
                    // colspan handling
                    var cellWidth = cell.width;
                    var textPosX  = cell.textPos.x;
                    var i         = data.table.columns.indexOf(data.column);

                    for ( var c = 1; c < cs; c++ ) {
                        var column = data.table.columns[i + c];
                        cellWidth += column.width;
                    }

                    if ( cs > 1 ) {
                        if ( cell.styles.halign === 'right' )
                            textPosX = cell.textPos.x + cellWidth - cell.width;
                        else if ( cell.styles.halign === 'center' )
                            textPosX = cell.textPos.x + (cellWidth - cell.width) / 2;
                    }

                    cell.width     = cellWidth;
                    cell.textPos.x = textPosX;

                    if ( typeof cellopt != 'undefined' && cellopt.rowspan > 1 )
                        cell.height = cell.height * cellopt.rowspan;

                    // fix jsPDF's calculation of text position
                    if ( cell.styles.valign === 'middle' || cell.styles.valign === 'bottom' ) {
                        var splittedText = typeof cell.text === 'string' ? cell.text.split(/\r\n|\r|\n/g) : cell.text;
                        var lineCount    = splittedText.length || 1;
                        if ( lineCount > 2 )
                            cell.textPos.y -= ((2 - FONT_ROW_RATIO) / 2 * data.row.styles.fontSize) * (lineCount - 2) / 3;
                    }
                    return true;
                }
                else
                    return false; // cell is hidden (colspan = -1), don't draw it
            }

            function collectImages (cell, elements, teOptions) {
                if ( typeof teOptions.images != 'undefined' ) {
                    elements.each(function () {
                        var kids = $(this).children();

                        if ( $(this).is("img") ) {
                            var hash = strHashCode(this.src);

                            teOptions.images[hash] = {
                                url: this.src,
                                src: this.src
                            };
                        }

                        if ( typeof kids != 'undefined' && kids.length > 0 )
                            collectImages(cell, kids, teOptions);
                    });
                }
            }

            function loadImages (teOptions, callback) {
                var i;
                var imageCount = 0;
                var x          = 0;

                function done () {
                    callback(imageCount);
                }

                function loadImage (image) {
                    if ( !image.url )
                        return;
                    var img         = new Image();
                    imageCount      = ++x;
                    img.crossOrigin = 'Anonymous';
                    img.onerror     = img.onload = function () {
                        if ( img.complete ) {

                            if ( img.src.indexOf('data:image/') === 0 ) {
                                img.width  = image.width || img.width || 0;
                                img.height = image.height || img.height || 0;
                            }

                            if ( img.width + img.height ) {
                                var canvas = document.createElement("canvas");
                                var ctx    = canvas.getContext("2d");

                                canvas.width  = img.width;
                                canvas.height = img.height;
                                ctx.drawImage(img, 0, 0);

                                image.src = canvas.toDataURL("image/jpeg");
                            }
                        }
                        if ( !--x )
                            done();
                    };
                    img.src = image.url;
                }

                if ( typeof teOptions.images != 'undefined' ) {
                    for ( i in teOptions.images )
                        if ( teOptions.images.hasOwnProperty(i) )
                            loadImage(teOptions.images[i]);
                }

                return x || done();
            }

            function drawAutotableElements (cell, elements, teOptions) {
                elements.each(function () {
                    var kids = $(this).children();
                    var uy   = 0;

                    if ( $(this).is("div") ) {
                        var bcolor = rgb2array(getStyle(this, 'background-color'), [255, 255, 255]);
                        var lcolor = rgb2array(getStyle(this, 'border-top-color'), [0, 0, 0]);
                        var lwidth = getPropertyUnitValue(this, 'border-top-width', defaults.jspdf.unit);

                        var r  = this.getBoundingClientRect();
                        var ux = this.offsetLeft * teOptions.dw;
                        uy = this.offsetTop * teOptions.dh;
                        var uw = r.width * teOptions.dw;
                        var uh = r.height * teOptions.dh;

                        teOptions.doc.setDrawColor.apply(undefined, lcolor);
                        teOptions.doc.setFillColor.apply(undefined, bcolor);
                        teOptions.doc.setLineWidth(lwidth);
                        teOptions.doc.rect(cell.x + ux, cell.y + uy, uw, uh, lwidth ? "FD" : "F");
                    }
                    else if ( $(this).is("img") ) {
                        if ( typeof teOptions.images != 'undefined' ) {
                            var hash  = strHashCode(this.src);
                            var image = teOptions.images[hash];

                            if ( typeof image != 'undefined' ) {

                                var arCell    = cell.width / cell.height;
                                var arImg     = this.width / this.height;
                                var imgWidth  = cell.width;
                                var imgHeight = cell.height;
                                var px2pt     = 0.264583 * 72 / 25.4;

                                if ( arImg <= arCell ) {
                                    imgHeight = Math.min(cell.height, this.height);
                                    imgWidth  = this.width * imgHeight / this.height;
                                }
                                else if ( arImg > arCell ) {
                                    imgWidth  = Math.min(cell.width, this.width);
                                    imgHeight = this.height * imgWidth / this.width;
                                }

                                imgWidth *= px2pt;
                                imgHeight *= px2pt;

                                if ( imgHeight < cell.height )
                                    uy = (cell.height - imgHeight) / 2;

                                try {
                                    teOptions.doc.addImage(image.src, cell.textPos.x, cell.y + uy, imgWidth, imgHeight);
                                }
                                catch (e) {
                                    // TODO: IE -> convert png to jpeg
                                }
                                cell.textPos.x += imgWidth;
                            }
                        }
                    }

                    if ( typeof kids != 'undefined' && kids.length > 0 )
                        drawAutotableElements(cell, kids, teOptions);
                });
            }

            function drawAutotableText (cell, texttags, teOptions) {
                if ( typeof teOptions.onAutotableText === 'function' ) {
                    teOptions.onAutotableText(teOptions.doc, cell, texttags);
                }
                else {
                    var x     = cell.textPos.x;
                    var y     = cell.textPos.y;
                    var style = {halign: cell.styles.halign, valign: cell.styles.valign};

                    if ( texttags.length ) {
                        var tag = texttags[0];
                        while ( tag.previousSibling )
                            tag = tag.previousSibling;

                        var b = false, i = false;

                        while ( tag ) {
                            var txt = tag.innerText || tag.textContent || "";

                            txt = ((txt.length && txt[0] == " ") ? " " : "") +
                                $.trim(txt) +
                                ((txt.length > 1 && txt[txt.length - 1] == " ") ? " " : "");

                            if ( $(tag).is("br") ) {
                                x = cell.textPos.x;
                                y += teOptions.doc.internal.getFontSize();
                            }

                            if ( $(tag).is("b") )
                                b = true;
                            else if ( $(tag).is("i") )
                                i = true;

                            if ( b || i )
                                teOptions.doc.setFontType((b && i) ? "bolditalic" : b ? "bold" : "italic");

                            var w = teOptions.doc.getStringUnitWidth(txt) * teOptions.doc.internal.getFontSize();

                            if ( w ) {
                                if ( cell.styles.overflow === 'linebreak' &&
                                    x > cell.textPos.x && (x + w) > (cell.textPos.x + cell.width) ) {
                                    var chars = ".,!%*;:=-";
                                    if ( chars.indexOf(txt.charAt(0)) >= 0 ) {
                                        var s = txt.charAt(0);
                                        w     = teOptions.doc.getStringUnitWidth(s) * teOptions.doc.internal.getFontSize();
                                        if ( (x + w) <= (cell.textPos.x + cell.width) ) {
                                            teOptions.doc.autoTableText(s, x, y, style);
                                            txt = txt.substring(1, txt.length);
                                        }
                                        w = teOptions.doc.getStringUnitWidth(txt) * teOptions.doc.internal.getFontSize();
                                    }
                                    x = cell.textPos.x;
                                    y += teOptions.doc.internal.getFontSize();
                                }

                                while ( txt.length && (x + w) > (cell.textPos.x + cell.width) ) {
                                    txt = txt.substring(0, txt.length - 1);
                                    w   = teOptions.doc.getStringUnitWidth(txt) * teOptions.doc.internal.getFontSize();
                                }

                                teOptions.doc.autoTableText(txt, x, y, style);
                                x += w;
                            }

                            if ( b || i ) {
                                if ( $(tag).is("b") )
                                    b = false;
                                else if ( $(tag).is("i") )
                                    i = false;

                                teOptions.doc.setFontType((!b && !i) ? "normal" : b ? "bold" : "italic");
                            }

                            tag = tag.nextSibling;
                        }
                        cell.textPos.x = x;
                        cell.textPos.y = y;
                    }
                    else {
                        teOptions.doc.autoTableText(cell.text, cell.textPos.x, cell.textPos.y, style);
                    }
                }
            }

            function escapeRegExp (string) {
                return string.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
            }

            function replaceAll (string, find, replace) {
                return string.replace(new RegExp(escapeRegExp(find), 'g'), replace);
            }

            function parseNumber (value) {
                value = value || "0";
                value = replaceAll(value, defaults.numbers.html.thousandsSeparator, '');
                value = replaceAll(value, defaults.numbers.html.decimalMark, '.');

                return typeof value === "number" || jQuery.isNumeric(value) !== false ? value : false;
            }

            function parsePercent (value) {
                if ( value.indexOf("%") > -1 ) {
                    value = parseNumber(value.replace(/%/g, ""));
                    if ( value !== false )
                        value = value / 100;
                }
                else
                    value = false;
                return value;
            }

            function parseString (cell, rowIndex, colIndex) {
                var result = '';

                if ( cell !== null ) {
                    var $cell = $(cell);
                    var htmlData;

                    if ( $cell[0].hasAttribute("data-tableexport-value") ) {
                        htmlData = $cell.data("tableexport-value");
                        htmlData = htmlData ? htmlData + '' : ''
                    }
                    else {
                        htmlData = $cell.html();

                        if ( typeof defaults.onCellHtmlData === 'function' )
                            htmlData = defaults.onCellHtmlData($cell, rowIndex, colIndex, htmlData);
                        else if ( htmlData != '' ) {
                            var html      = $.parseHTML(htmlData);
                            var inputidx  = 0;
                            var selectidx = 0;

                            htmlData = '';
                            $.each(html, function () {
                                if ( $(this).is("input") )
                                    htmlData += $cell.find('input').eq(inputidx++).val();
                                else if ( $(this).is("select") )
                                    htmlData += $cell.find('select option:selected').eq(selectidx++).text();
                                else {
                                    if ( typeof $(this).html() === 'undefined' )
                                        htmlData += $(this).text();
                                    else if ( jQuery().bootstrapTable === undefined || $(this).hasClass('filterControl') !== true )
                                        htmlData += $(this).html();
                                }
                            });
                        }
                    }

                    if ( defaults.htmlContent === true ) {
                        result = $.trim(htmlData);
                    }
                    else if ( htmlData && htmlData != '' ) {
                        var text   = htmlData.replace(/\n/g, '\u2028').replace(/<br\s*[\/]?>/gi, '\u2060');
                        var obj    = $('<div/>').html(text).contents();
                        var number = false;
                        text       = '';
                        $.each(obj.text().split("\u2028"), function (i, v) {
                            if ( i > 0 )
                                text += " ";
                            text += $.trim(v);
                        });

                        $.each(text.split("\u2060"), function (i, v) {
                            if ( i > 0 )
                                result += "\n";
                            result += $.trim(v).replace(/\u00AD/g, ""); // remove soft hyphens
                        });

                        if ( defaults.type == 'json' ||
                            (defaults.type === 'excel' && defaults.excelFileFormat === 'xmlss') ||
                            defaults.numbers.output === false ) {
                            number = parseNumber(result);

                            if ( number !== false )
                                result = Number(number);
                        }
                        else if ( defaults.numbers.html.decimalMark != defaults.numbers.output.decimalMark ||
                            defaults.numbers.html.thousandsSeparator != defaults.numbers.output.thousandsSeparator ) {
                            number = parseNumber(result);

                            if ( number !== false ) {
                                var frac = ("" + number.substr(number < 0 ? 1 : 0)).split('.');
                                if ( frac.length == 1 )
                                    frac[1] = "";
                                var mod = frac[0].length > 3 ? frac[0].length % 3 : 0;

                                result = (number < 0 ? "-" : "") +
                                    (defaults.numbers.output.thousandsSeparator ? ((mod ? frac[0].substr(0, mod) + defaults.numbers.output.thousandsSeparator : "") + frac[0].substr(mod).replace(/(\d{3})(?=\d)/g, "$1" + defaults.numbers.output.thousandsSeparator)) : frac[0]) +
                                    (frac[1].length ? defaults.numbers.output.decimalMark + frac[1] : "");
                            }
                        }
                    }

                    if ( defaults.escape === true ) {
                        //noinspection JSDeprecatedSymbols
                        result = escape(result);
                    }

                    if ( typeof defaults.onCellData === 'function' ) {
                        result = defaults.onCellData($cell, rowIndex, colIndex, result);
                    }
                }

                return result;
            }

            //noinspection JSUnusedLocalSymbols
            function hyphenate (a, b, c) {
                return b + "-" + c.toLowerCase();
            }

            function rgb2array (rgb_string, default_result) {
                var re     = /^rgb\((\d{1,3}),\s*(\d{1,3}),\s*(\d{1,3})\)$/;
                var bits   = re.exec(rgb_string);
                var result = default_result;
                if ( bits )
                    result = [parseInt(bits[1]), parseInt(bits[2]), parseInt(bits[3])];
                return result;
            }

            function getCellStyles (cell) {
                var a  = getStyle(cell, 'text-align');
                var fw = getStyle(cell, 'font-weight');
                var fs = getStyle(cell, 'font-style');
                var f  = '';
                if ( a == 'start' )
                    a = getStyle(cell, 'direction') == 'rtl' ? 'right' : 'left';
                if ( fw >= 700 )
                    f = 'bold';
                if ( fs == 'italic' )
                    f += fs;
                if ( f === '' )
                    f = 'normal';

                var result = {
                    style:   {
                        align:  a,
                        bcolor: rgb2array(getStyle(cell, 'background-color'), [255, 255, 255]),
                        color:  rgb2array(getStyle(cell, 'color'), [0, 0, 0]),
                        fstyle: f
                    },
                    colspan: (parseInt($(cell).attr('colspan')) || 0),
                    rowspan: (parseInt($(cell).attr('rowspan')) || 0)
                };

                if ( cell !== null ) {
                    var r       = cell.getBoundingClientRect();
                    result.rect = {
                        width:  r.width,
                        height: r.height
                    };
                }

                return result;
            }

            // get computed style property
            function getStyle (target, prop) {
                try {
                    if ( window.getComputedStyle ) { // gecko and webkit
                        prop = prop.replace(/([a-z])([A-Z])/, hyphenate);  // requires hyphenated, not camel
                        return window.getComputedStyle(target, null).getPropertyValue(prop);
                    }
                    if ( target.currentStyle ) { // ie
                        return target.currentStyle[prop];
                    }
                    return target.style[prop];
                }
                catch (e) {
                }
                return "";
            }

            function getUnitValue (parent, value, unit) {
                var baseline = 100;  // any number serves

                var temp              = document.createElement("div");  // create temporary element
                temp.style.overflow   = "hidden";  // in case baseline is set too low
                temp.style.visibility = "hidden";  // no need to show it

                parent.appendChild(temp); // insert it into the parent for em, ex and %

                temp.style.width = baseline + unit;
                var factor       = baseline / temp.offsetWidth;

                parent.removeChild(temp);  // clean up

                return (value * factor);
            }

            function getPropertyUnitValue (target, prop, unit) {
                var value = getStyle(target, prop);  // get the computed style value

                var numeric = value.match(/\d+/);  // get the numeric component
                if ( numeric !== null ) {
                    numeric = numeric[0];  // get the string

                    return getUnitValue(target.parentElement, numeric, unit);
                }
                return 0;
            }

            function jx_Workbook () {
                if ( !(this instanceof jx_Workbook) ) {
                    //noinspection JSPotentiallyInvalidConstructorUsage
                    return new jx_Workbook();
                }
                this.SheetNames = [];
                this.Sheets     = {};
            }

            function jx_s2ab (s) {
                var buf  = new ArrayBuffer(s.length);
                var view = new Uint8Array(buf);
                for ( var i = 0; i != s.length; ++i ) view[i] = s.charCodeAt(i) & 0xFF;
                return buf;
            }

            function jx_datenum (v, date1904) {
                if ( date1904 ) v += 1462;
                var epoch = Date.parse(v);
                return (epoch - new Date(Date.UTC(1899, 11, 30))) / (24 * 60 * 60 * 1000);
            }

            function jx_createSheet (data) {
                var ws    = {};
                var range = {s: {c: 10000000, r: 10000000}, e: {c: 0, r: 0}};
                for ( var R = 0; R != data.length; ++R ) {
                    for ( var C = 0; C != data[R].length; ++C ) {
                        if ( range.s.r > R ) range.s.r = R;
                        if ( range.s.c > C ) range.s.c = C;
                        if ( range.e.r < R ) range.e.r = R;
                        if ( range.e.c < C ) range.e.c = C;
                        var cell = {v: data[R][C]};
                        if ( cell.v === null ) continue;
                        var cell_ref = XLSX.utils.encode_cell({c: C, r: R});

                        if ( typeof cell.v === 'number' ) cell.t = 'n';
                        else if ( typeof cell.v === 'boolean' ) cell.t = 'b';
                        else if ( cell.v instanceof Date ) {
                            cell.t = 'n';
                            cell.z = XLSX.SSF._table[14];
                            cell.v = jx_datenum(cell.v);
                        }
                        else cell.t = 's';
                        ws[cell_ref] = cell;
                    }
                }

                if ( range.s.c < 10000000 ) ws['!ref'] = XLSX.utils.encode_range(range);
                return ws;
            }

            function strHashCode (str) {
                var hash = 0, i, chr, len;
                if ( str.length === 0 ) return hash;
                for ( i = 0, len = str.length; i < len; i++ ) {
                    chr  = str.charCodeAt(i);
                    hash = ((hash << 5) - hash) + chr;
                    hash |= 0; // Convert to 32bit integer
                }
                return hash;
            }

            function downloadFile (filename, header, data) {

                var ua = window.navigator.userAgent;
                if ( filename !== false && (ua.indexOf("MSIE ") > 0 || !!ua.match(/Trident.*rv\:11\./)) ) {
                    if ( window.navigator.msSaveOrOpenBlob ) {
                        //noinspection JSUnresolvedFunction
                        window.navigator.msSaveOrOpenBlob(new Blob([data]), filename);
                    }
                    else {
                        // Internet Explorer (<= 9) workaround by Darryl (https://github.com/dawiong/tableExport.jquery.plugin)
                        // based on sampopes answer on http://stackoverflow.com/questions/22317951
                        // ! Not working for json and pdf format !
                        var frame = document.createElement("iframe");

                        if ( frame ) {
                            document.body.appendChild(frame);
                            frame.setAttribute("style", "display:none");
                            frame.contentDocument.open("txt/html", "replace");
                            frame.contentDocument.write(data);
                            frame.contentDocument.close();
                            frame.focus();

                            frame.contentDocument.execCommand("SaveAs", true, filename);
                            document.body.removeChild(frame);
                        }
                    }
                }
                else {
                    var DownloadLink = document.createElement('a');

                    if ( DownloadLink ) {
                        var blobUrl = null;

                        DownloadLink.style.display = 'none';
                        if ( filename !== false )
                            DownloadLink.download = filename;
                        else
                            DownloadLink.target = '_blank';

                        if ( typeof data == 'object' ) {
                            blobUrl           = window.URL.createObjectURL(data);
                            DownloadLink.href = blobUrl;
                        }
                        else if ( header.toLowerCase().indexOf("base64,") >= 0 )
                            DownloadLink.href = header + base64encode(data);
                        else
                            DownloadLink.href = header + encodeURIComponent(data);

                        document.body.appendChild(DownloadLink);

                        if ( document.createEvent ) {
                            if ( DownloadEvt === null )
                                DownloadEvt = document.createEvent('MouseEvents');

                            DownloadEvt.initEvent('click', true, false);
                            DownloadLink.dispatchEvent(DownloadEvt);
                        }
                        else if ( document.createEventObject )
                            DownloadLink.fireEvent('onclick');
                        else if ( typeof DownloadLink.onclick == 'function' )
                            DownloadLink.onclick();

                        if ( blobUrl )
                            window.URL.revokeObjectURL(blobUrl);

                        document.body.removeChild(DownloadLink);
                    }
                }
            }

            function utf8Encode (string) {
                string      = string.replace(/\x0d\x0a/g, "\x0a");
                var utftext = "";
                for ( var n = 0; n < string.length; n++ ) {
                    var c = string.charCodeAt(n);
                    if ( c < 128 ) {
                        utftext += String.fromCharCode(c);
                    }
                    else if ( (c > 127) && (c < 2048) ) {
                        utftext += String.fromCharCode((c >> 6) | 192);
                        utftext += String.fromCharCode((c & 63) | 128);
                    }
                    else {
                        utftext += String.fromCharCode((c >> 12) | 224);
                        utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                        utftext += String.fromCharCode((c & 63) | 128);
                    }
                }
                return utftext;
            }

            function base64encode (input) {
                var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
                var keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
                var output = "";
                var i      = 0;
                input      = utf8Encode(input);
                while ( i < input.length ) {
                    chr1 = input.charCodeAt(i++);
                    chr2 = input.charCodeAt(i++);
                    chr3 = input.charCodeAt(i++);
                    enc1 = chr1 >> 2;
                    enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
                    enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
                    enc4 = chr3 & 63;
                    if ( isNaN(chr2) ) {
                        enc3 = enc4 = 64;
                    } else if ( isNaN(chr3) ) {
                        enc4 = 64;
                    }
                    output = output +
                        keyStr.charAt(enc1) + keyStr.charAt(enc2) +
                        keyStr.charAt(enc3) + keyStr.charAt(enc4);
                }
                return output;
            }

            return this;
        }
    });
})(jQuery);
﻿/**
 * @author Suman Thaapa -- Lead 
 * @author Prabhat gurung 
 * @author Basanta Tajpuriya 
 * @author Rakesh Shrestha 
 * @author Manish Buddhacharya 
 * @author Lekh Raj Rai 
 * @author Ascol Parajuli
 * @email NEPALNME@GMAIL.COM
 * @create date 2019-03-12 16:51:56
 * @modify date 2019-03-12 16:51:56
 * @desc [description]
 */

// SXT written 7-27-2015

(function (root, factory) {
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module unless amdModuleId is set
    define([], function () {
      return (root['SignaturePad'] = factory());
    });
  } else if (typeof exports === 'object') {
    // Node. Does not work with strict CommonJS, but
    // only CommonJS-like environments that support module.exports,
    // like Node.
    module.exports = factory();
  } else {
    root['SignaturePad'] = factory();
  }
}(this, function () {

var SignaturePad = (function (document) {
    "use strict";

    var SignaturePad = function (canvas, options) {
        var self = this,
            opts = options || {};

        this.velocityFilterWeight = opts.velocityFilterWeight || 0.7;
        this.minWidth = opts.minWidth || 0.5;
        this.maxWidth = opts.maxWidth || 2.5;
        this.dotSize = opts.dotSize || function () {
            return (this.minWidth + this.maxWidth) / 2;
        };
        this.penColor = opts.penColor || "black";
        this.backgroundColor = opts.backgroundColor || "rgba(0,0,0,0)";
        this.onEnd = opts.onEnd;
        this.onBegin = opts.onBegin;

        this._canvas = canvas;
        this._ctx = canvas.getContext("2d");
        this.clear();

        // we need add these inline so they are available to unbind while still having
        //  access to 'self' we could use _.bind but it's not worth adding a dependency
        this._handleMouseDown = function (event) {
            if (event.which === 1) {
                self._mouseButtonDown = true;
                self._strokeBegin(event);
            }
        };

        this._handleMouseMove = function (event) {
            if (self._mouseButtonDown) {
                self._strokeUpdate(event);
            }
        };

        this._handleMouseUp = function (event) {
            if (event.which === 1 && self._mouseButtonDown) {
                self._mouseButtonDown = false;
                self._strokeEnd(event);
            }
        };

        this._handleTouchStart = function (event) {
            var touch = event.changedTouches[0];
            self._strokeBegin(touch);
        };

        this._handleTouchMove = function (event) {
            // Prevent scrolling.
            event.preventDefault();

            var touch = event.changedTouches[0];
            self._strokeUpdate(touch);
        };

        this._handleTouchEnd = function (event) {
            var wasCanvasTouched = event.target === self._canvas;
            if (wasCanvasTouched) {
                self._strokeEnd(event);
            }
        };

        this._handleMouseEvents();
        this._handleTouchEvents();
    };

    SignaturePad.prototype.clear = function () {
        var ctx = this._ctx,
            canvas = this._canvas;

        ctx.fillStyle = this.backgroundColor;
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        this._reset();
    };

    SignaturePad.prototype.toDataURL = function (imageType, quality) {
        var canvas = this._canvas;
        return canvas.toDataURL.apply(canvas, arguments);
    };

    SignaturePad.prototype.fromDataURL = function (dataUrl) {
        var self = this,
            image = new Image(),
            ratio = window.devicePixelRatio || 1,
            width = this._canvas.width / ratio,
            height = this._canvas.height / ratio;

        this._reset();
        image.src = dataUrl;
        image.onload = function () {
            self._ctx.drawImage(image, 0, 0, width, height);
        };
        this._isEmpty = false;
    };

    SignaturePad.prototype._strokeUpdate = function (event) {
        var point = this._createPoint(event);
        this._addPoint(point);
    };

    SignaturePad.prototype._strokeBegin = function (event) {
        this._reset();
        this._strokeUpdate(event);
        if (typeof this.onBegin === 'function') {
            this.onBegin(event);
        }
    };

    SignaturePad.prototype._strokeDraw = function (point) {
        var ctx = this._ctx,
            dotSize = typeof(this.dotSize) === 'function' ? this.dotSize() : this.dotSize;

        ctx.beginPath();
        this._drawPoint(point.x, point.y, dotSize);
        ctx.closePath();
        ctx.fill();
    };

    SignaturePad.prototype._strokeEnd = function (event) {
        var canDrawCurve = this.points.length > 2,
            point = this.points[0];

        if (!canDrawCurve && point) {
            this._strokeDraw(point);
        }
        if (typeof this.onEnd === 'function') {
            this.onEnd(event);
        }
    };

    SignaturePad.prototype._handleMouseEvents = function () {
        var self = this;
        this._mouseButtonDown = false;

        this._canvas.addEventListener("mousedown", this._handleMouseDown);
        this._canvas.addEventListener("mousemove", this._handleMouseMove);
        document.addEventListener("mouseup", this._handleMouseUp);
    };

    SignaturePad.prototype._handleTouchEvents = function () {
        var self = this;

        // Pass touch events to canvas element on mobile IE.
        this._canvas.style.msTouchAction = 'none';

        this._canvas.addEventListener("touchstart", this._handleTouchStart);
        this._canvas.addEventListener("touchmove", this._handleTouchMove);
        document.addEventListener("touchend", this._handleTouchEnd);
    };

    SignaturePad.prototype.off = function () {
        this._canvas.removeEventListener("mousedown", this._handleMouseDown);
        this._canvas.removeEventListener("mousemove", this._handleMouseMove);
        document.removeEventListener("mouseup", this._handleMouseUp);

        this._canvas.removeEventListener("touchstart", this._handleTouchStart);
        this._canvas.removeEventListener("touchmove", this._handleTouchMove);
        document.removeEventListener("touchend", this._handleTouchEnd);
    };

    SignaturePad.prototype.isEmpty = function () {
        return this._isEmpty;
    };

    SignaturePad.prototype._reset = function () {
        this.points = [];
        this._lastVelocity = 0;
        this._lastWidth = (this.minWidth + this.maxWidth) / 2;
        this._isEmpty = true;
        this._ctx.fillStyle = this.penColor;
    };

    SignaturePad.prototype._createPoint = function (event) {
        var rect = this._canvas.getBoundingClientRect();
        return new Point(
            event.clientX - rect.left,
            event.clientY - rect.top
        );
    };

    SignaturePad.prototype._addPoint = function (point) {
        var points = this.points,
            c2, c3,
            curve, tmp;

        points.push(point);

        if (points.length > 2) {
            // To reduce the initial lag make it work with 3 points
            // by copying the first point to the beginning.
            if (points.length === 3) points.unshift(points[0]);

            tmp = this._calculateCurveControlPoints(points[0], points[1], points[2]);
            c2 = tmp.c2;
            tmp = this._calculateCurveControlPoints(points[1], points[2], points[3]);
            c3 = tmp.c1;
            curve = new Bezier(points[1], c2, c3, points[2]);
            this._addCurve(curve);

            // Remove the first element from the list,
            // so that we always have no more than 4 points in points array.
            points.shift();
        }
    };

    SignaturePad.prototype._calculateCurveControlPoints = function (s1, s2, s3) {
        var dx1 = s1.x - s2.x, dy1 = s1.y - s2.y,
            dx2 = s2.x - s3.x, dy2 = s2.y - s3.y,

            m1 = {x: (s1.x + s2.x) / 2.0, y: (s1.y + s2.y) / 2.0},
            m2 = {x: (s2.x + s3.x) / 2.0, y: (s2.y + s3.y) / 2.0},

            l1 = Math.sqrt(dx1*dx1 + dy1*dy1),
            l2 = Math.sqrt(dx2*dx2 + dy2*dy2),

            dxm = (m1.x - m2.x),
            dym = (m1.y - m2.y),

            k = l2 / (l1 + l2),
            cm = {x: m2.x + dxm*k, y: m2.y + dym*k},

            tx = s2.x - cm.x,
            ty = s2.y - cm.y;

        return {
            c1: new Point(m1.x + tx, m1.y + ty),
            c2: new Point(m2.x + tx, m2.y + ty)
        };
    };

    SignaturePad.prototype._addCurve = function (curve) {
        var startPoint = curve.startPoint,
            endPoint = curve.endPoint,
            velocity, newWidth;

        velocity = endPoint.velocityFrom(startPoint);
        velocity = this.velocityFilterWeight * velocity
            + (1 - this.velocityFilterWeight) * this._lastVelocity;

        newWidth = this._strokeWidth(velocity);
        this._drawCurve(curve, this._lastWidth, newWidth);

        this._lastVelocity = velocity;
        this._lastWidth = newWidth;
    };

    SignaturePad.prototype._drawPoint = function (x, y, size) {
        var ctx = this._ctx;

        ctx.moveTo(x, y);
        ctx.arc(x, y, size, 0, 2 * Math.PI, false);
        this._isEmpty = false;
    };

    SignaturePad.prototype._drawCurve = function (curve, startWidth, endWidth) {
        var ctx = this._ctx,
            widthDelta = endWidth - startWidth,
            drawSteps, width, i, t, tt, ttt, u, uu, uuu, x, y;

        drawSteps = Math.floor(curve.length());
        ctx.beginPath();
        for (i = 0; i < drawSteps; i++) {
            // Calculate the Bezier (x, y) coordinate for this step.
            t = i / drawSteps;
            tt = t * t;
            ttt = tt * t;
            u = 1 - t;
            uu = u * u;
            uuu = uu * u;

            x = uuu * curve.startPoint.x;
            x += 3 * uu * t * curve.control1.x;
            x += 3 * u * tt * curve.control2.x;
            x += ttt * curve.endPoint.x;

            y = uuu * curve.startPoint.y;
            y += 3 * uu * t * curve.control1.y;
            y += 3 * u * tt * curve.control2.y;
            y += ttt * curve.endPoint.y;

            width = startWidth + ttt * widthDelta;
            this._drawPoint(x, y, width);
        }
        ctx.closePath();
        ctx.fill();
    };

    SignaturePad.prototype._strokeWidth = function (velocity) {
        return Math.max(this.maxWidth / (velocity + 1), this.minWidth);
    };


    var Point = function (x, y, time) {
        this.x = x;
        this.y = y;
        this.time = time || new Date().getTime();
    };

    Point.prototype.velocityFrom = function (start) {
        return (this.time !== start.time) ? this.distanceTo(start) / (this.time - start.time) : 1;
    };

    Point.prototype.distanceTo = function (start) {
        return Math.sqrt(Math.pow(this.x - start.x, 2) + Math.pow(this.y - start.y, 2));
    };

    var Bezier = function (startPoint, control1, control2, endPoint) {
        this.startPoint = startPoint;
        this.control1 = control1;
        this.control2 = control2;
        this.endPoint = endPoint;
    };

    // Returns approximated length.
    Bezier.prototype.length = function () {
        var steps = 10,
            length = 0,
            i, t, cx, cy, px, py, xdiff, ydiff;

        for (i = 0; i <= steps; i++) {
            t = i / steps;
            cx = this._point(t, this.startPoint.x, this.control1.x, this.control2.x, this.endPoint.x);
            cy = this._point(t, this.startPoint.y, this.control1.y, this.control2.y, this.endPoint.y);
            if (i > 0) {
                xdiff = cx - px;
                ydiff = cy - py;
                length += Math.sqrt(xdiff * xdiff + ydiff * ydiff);
            }
            px = cx;
            py = cy;
        }
        return length;
    };

    Bezier.prototype._point = function (t, start, c1, c2, end) {
        return          start * (1.0 - t) * (1.0 - t)  * (1.0 - t)
               + 3.0 *  c1    * (1.0 - t) * (1.0 - t)  * t
               + 3.0 *  c2    * (1.0 - t) * t          * t
               +        end   * t         * t          * t;
    };

    return SignaturePad;
})(document);

return SignaturePad;

}));
// Spectrum Colorpicker v1.8.0
// https://github.com/bgrins/spectrum
// Author: Brian Grinstead
// License: MIT

(function (factory) {
    "use strict";

    if (typeof define === 'function' && define.amd) { // AMD
        define(['jquery'], factory);
    }
    else if (typeof exports == "object" && typeof module == "object") { // CommonJS
        module.exports = factory(require('jquery'));
    }
    else { // Browser
        factory(jQuery);
    }
})(function($, undefined) {
    "use strict";

    var defaultOpts = {

        // Callbacks
        beforeShow: noop,
        move: noop,
        change: noop,
        show: noop,
        hide: noop,

        // Options
        color: false,
        flat: false,
        showInput: false,
        allowEmpty: false,
        showButtons: true,
        clickoutFiresChange: true,
        showInitial: false,
        showPalette: false,
        showPaletteOnly: false,
        hideAfterPaletteSelect: false,
        togglePaletteOnly: false,
        showSelectionPalette: true,
        localStorageKey: false,
        appendTo: "body",
        maxSelectionSize: 7,
        cancelText: "cancel",
        chooseText: "choose",
        togglePaletteMoreText: "more",
        togglePaletteLessText: "less",
        clearText: "Clear Color Selection",
        noColorSelectedText: "No Color Selected",
        preferredFormat: false,
        className: "", // Deprecated - use containerClassName and replacerClassName instead.
        containerClassName: "",
        replacerClassName: "",
        showAlpha: false,
        theme: "sp-light",
        palette: [["#ffffff", "#000000", "#ff0000", "#ff8000", "#ffff00", "#008000", "#0000ff", "#4b0082", "#9400d3"]],
        selectionPalette: [],
        disabled: false,
        offset: null
    },
    spectrums = [],
    IE = !!/msie/i.exec( window.navigator.userAgent ),
    rgbaSupport = (function() {
        function contains( str, substr ) {
            return !!~('' + str).indexOf(substr);
        }

        var elem = document.createElement('div');
        var style = elem.style;
        style.cssText = 'background-color:rgba(0,0,0,.5)';
        return contains(style.backgroundColor, 'rgba') || contains(style.backgroundColor, 'hsla');
    })(),
    replaceInput = [
        "<div class='sp-replacer'>",
            "<div class='sp-preview'><div class='sp-preview-inner'></div></div>",
            "<div class='sp-dd'>&#9660;</div>",
        "</div>"
    ].join(''),
    markup = (function () {

        // IE does not support gradients with multiple stops, so we need to simulate
        //  that for the rainbow slider with 8 divs that each have a single gradient
        var gradientFix = "";
        if (IE) {
            for (var i = 1; i <= 6; i++) {
                gradientFix += "<div class='sp-" + i + "'></div>";
            }
        }

        return [
            "<div class='sp-container sp-hidden'>",
                "<div class='sp-palette-container'>",
                    "<div class='sp-palette sp-thumb sp-cf'></div>",
                    "<div class='sp-palette-button-container sp-cf'>",
                        "<button type='button' class='sp-palette-toggle'></button>",
                    "</div>",
                "</div>",
                "<div class='sp-picker-container'>",
                    "<div class='sp-top sp-cf'>",
                        "<div class='sp-fill'></div>",
                        "<div class='sp-top-inner'>",
                            "<div class='sp-color'>",
                                "<div class='sp-sat'>",
                                    "<div class='sp-val'>",
                                        "<div class='sp-dragger'></div>",
                                    "</div>",
                                "</div>",
                            "</div>",
                            "<div class='sp-clear sp-clear-display'>",
                            "</div>",
                            "<div class='sp-hue'>",
                                "<div class='sp-slider'></div>",
                                gradientFix,
                            "</div>",
                        "</div>",
                        "<div class='sp-alpha'><div class='sp-alpha-inner'><div class='sp-alpha-handle'></div></div></div>",
                    "</div>",
                    "<div class='sp-input-container sp-cf'>",
                        "<input class='sp-input' type='text' spellcheck='false'  />",
                    "</div>",
                    "<div class='sp-initial sp-thumb sp-cf'></div>",
                    "<div class='sp-button-container sp-cf'>",
                        "<a class='sp-cancel' href='#'></a>",
                        "<button type='button' class='sp-choose'></button>",
                    "</div>",
                "</div>",
            "</div>"
        ].join("");
    })();

    function paletteTemplate (p, color, className, opts) {
        var html = [];
        for (var i = 0; i < p.length; i++) {
            var current = p[i];
            if(current) {
                var tiny = tinycolor(current);
                var c = tiny.toHsl().l < 0.5 ? "sp-thumb-el sp-thumb-dark" : "sp-thumb-el sp-thumb-light";
                c += (tinycolor.equals(color, current)) ? " sp-thumb-active" : "";
                var formattedString = tiny.toString(opts.preferredFormat || "rgb");
                var swatchStyle = rgbaSupport ? ("background-color:" + tiny.toRgbString()) : "filter:" + tiny.toFilter();
                html.push('<span title="' + formattedString + '" data-color="' + tiny.toRgbString() + '" class="' + c + '"><span class="sp-thumb-inner" style="' + swatchStyle + ';" /></span>');
            } else {
                var cls = 'sp-clear-display';
                html.push($('<div />')
                    .append($('<span data-color="" style="background-color:transparent;" class="' + cls + '"></span>')
                        .attr('title', opts.noColorSelectedText)
                    )
                    .html()
                );
            }
        }
        return "<div class='sp-cf " + className + "'>" + html.join('') + "</div>";
    }

    function hideAll() {
        for (var i = 0; i < spectrums.length; i++) {
            if (spectrums[i]) {
                spectrums[i].hide();
            }
        }
    }

    function instanceOptions(o, callbackContext) {
        var opts = $.extend({}, defaultOpts, o);
        opts.callbacks = {
            'move': bind(opts.move, callbackContext),
            'change': bind(opts.change, callbackContext),
            'show': bind(opts.show, callbackContext),
            'hide': bind(opts.hide, callbackContext),
            'beforeShow': bind(opts.beforeShow, callbackContext)
        };

        return opts;
    }

    function spectrum(element, o) {

        var opts = instanceOptions(o, element),
            flat = opts.flat,
            showSelectionPalette = opts.showSelectionPalette,
            localStorageKey = opts.localStorageKey,
            theme = opts.theme,
            callbacks = opts.callbacks,
            resize = throttle(reflow, 10),
            visible = false,
            isDragging = false,
            dragWidth = 0,
            dragHeight = 0,
            dragHelperHeight = 0,
            slideHeight = 0,
            slideWidth = 0,
            alphaWidth = 0,
            alphaSlideHelperWidth = 0,
            slideHelperHeight = 0,
            currentHue = 0,
            currentSaturation = 0,
            currentValue = 0,
            currentAlpha = 1,
            palette = [],
            paletteArray = [],
            paletteLookup = {},
            selectionPalette = opts.selectionPalette.slice(0),
            maxSelectionSize = opts.maxSelectionSize,
            draggingClass = "sp-dragging",
            shiftMovementDirection = null;

        var doc = element.ownerDocument,
            body = doc.body,
            boundElement = $(element),
            disabled = false,
            container = $(markup, doc).addClass(theme),
            pickerContainer = container.find(".sp-picker-container"),
            dragger = container.find(".sp-color"),
            dragHelper = container.find(".sp-dragger"),
            slider = container.find(".sp-hue"),
            slideHelper = container.find(".sp-slider"),
            alphaSliderInner = container.find(".sp-alpha-inner"),
            alphaSlider = container.find(".sp-alpha"),
            alphaSlideHelper = container.find(".sp-alpha-handle"),
            textInput = container.find(".sp-input"),
            paletteContainer = container.find(".sp-palette"),
            initialColorContainer = container.find(".sp-initial"),
            cancelButton = container.find(".sp-cancel"),
            clearButton = container.find(".sp-clear"),
            chooseButton = container.find(".sp-choose"),
            toggleButton = container.find(".sp-palette-toggle"),
            isInput = boundElement.is("input"),
            isInputTypeColor = isInput && boundElement.attr("type") === "color" && inputTypeColorSupport(),
            shouldReplace = isInput && !flat,
            replacer = (shouldReplace) ? $(replaceInput).addClass(theme).addClass(opts.className).addClass(opts.replacerClassName) : $([]),
            offsetElement = (shouldReplace) ? replacer : boundElement,
            previewElement = replacer.find(".sp-preview-inner"),
            initialColor = opts.color || (isInput && boundElement.val()),
            colorOnShow = false,
            currentPreferredFormat = opts.preferredFormat,
            clickoutFiresChange = !opts.showButtons || opts.clickoutFiresChange,
            isEmpty = !initialColor,
            allowEmpty = opts.allowEmpty && !isInputTypeColor;

        function applyOptions() {

            if (opts.showPaletteOnly) {
                opts.showPalette = true;
            }

            toggleButton.text(opts.showPaletteOnly ? opts.togglePaletteMoreText : opts.togglePaletteLessText);

            if (opts.palette) {
                palette = opts.palette.slice(0);
                paletteArray = $.isArray(palette[0]) ? palette : [palette];
                paletteLookup = {};
                for (var i = 0; i < paletteArray.length; i++) {
                    for (var j = 0; j < paletteArray[i].length; j++) {
                        var rgb = tinycolor(paletteArray[i][j]).toRgbString();
                        paletteLookup[rgb] = true;
                    }
                }
            }

            container.toggleClass("sp-flat", flat);
            container.toggleClass("sp-input-disabled", !opts.showInput);
            container.toggleClass("sp-alpha-enabled", opts.showAlpha);
            container.toggleClass("sp-clear-enabled", allowEmpty);
            container.toggleClass("sp-buttons-disabled", !opts.showButtons);
            container.toggleClass("sp-palette-buttons-disabled", !opts.togglePaletteOnly);
            container.toggleClass("sp-palette-disabled", !opts.showPalette);
            container.toggleClass("sp-palette-only", opts.showPaletteOnly);
            container.toggleClass("sp-initial-disabled", !opts.showInitial);
            container.addClass(opts.className).addClass(opts.containerClassName);

            reflow();
        }

        function initialize() {

            if (IE) {
                container.find("*:not(input)").attr("unselectable", "on");
            }

            applyOptions();

            if (shouldReplace) {
                boundElement.after(replacer).hide();
            }

            if (!allowEmpty) {
                clearButton.hide();
            }

            if (flat) {
                boundElement.after(container).hide();
            }
            else {

                var appendTo = opts.appendTo === "parent" ? boundElement.parent() : $(opts.appendTo);
                if (appendTo.length !== 1) {
                    appendTo = $("body");
                }

                appendTo.append(container);
            }

            updateSelectionPaletteFromStorage();

            offsetElement.bind("click.spectrum touchstart.spectrum", function (e) {
                if (!disabled) {
                    toggle();
                }

                e.stopPropagation();

                if (!$(e.target).is("input")) {
                    e.preventDefault();
                }
            });

            if(boundElement.is(":disabled") || (opts.disabled === true)) {
                disable();
            }

            // Prevent clicks from bubbling up to document.  This would cause it to be hidden.
            container.click(stopPropagation);

            // Handle user typed input
            textInput.change(setFromTextInput);
            textInput.bind("paste", function () {
                setTimeout(setFromTextInput, 1);
            });
            textInput.keydown(function (e) { if (e.keyCode == 13) { setFromTextInput(); } });

            cancelButton.text(opts.cancelText);
            cancelButton.bind("click.spectrum", function (e) {
                e.stopPropagation();
                e.preventDefault();
                revert();
                hide();
            });

            clearButton.attr("title", opts.clearText);
            clearButton.bind("click.spectrum", function (e) {
                e.stopPropagation();
                e.preventDefault();
                isEmpty = true;
                move();

                if(flat) {
                    //for the flat style, this is a change event
                    updateOriginalInput(true);
                }
            });

            chooseButton.text(opts.chooseText);
            chooseButton.bind("click.spectrum", function (e) {
                e.stopPropagation();
                e.preventDefault();

                if (IE && textInput.is(":focus")) {
                    textInput.trigger('change');
                }

                if (isValid()) {
                    updateOriginalInput(true);
                    hide();
                }
            });

            toggleButton.text(opts.showPaletteOnly ? opts.togglePaletteMoreText : opts.togglePaletteLessText);
            toggleButton.bind("click.spectrum", function (e) {
                e.stopPropagation();
                e.preventDefault();

                opts.showPaletteOnly = !opts.showPaletteOnly;

                // To make sure the Picker area is drawn on the right, next to the
                // Palette area (and not below the palette), first move the Palette
                // to the left to make space for the picker, plus 5px extra.
                // The 'applyOptions' function puts the whole container back into place
                // and takes care of the button-text and the sp-palette-only CSS class.
                if (!opts.showPaletteOnly && !flat) {
                    container.css('left', '-=' + (pickerContainer.outerWidth(true) + 5));
                }
                applyOptions();
            });

            draggable(alphaSlider, function (dragX, dragY, e) {
                currentAlpha = (dragX / alphaWidth);
                isEmpty = false;
                if (e.shiftKey) {
                    currentAlpha = Math.round(currentAlpha * 10) / 10;
                }

                move();
            }, dragStart, dragStop);

            draggable(slider, function (dragX, dragY) {
                currentHue = parseFloat(dragY / slideHeight);
                isEmpty = false;
                if (!opts.showAlpha) {
                    currentAlpha = 1;
                }
                move();
            }, dragStart, dragStop);

            draggable(dragger, function (dragX, dragY, e) {

                // shift+drag should snap the movement to either the x or y axis.
                if (!e.shiftKey) {
                    shiftMovementDirection = null;
                }
                else if (!shiftMovementDirection) {
                    var oldDragX = currentSaturation * dragWidth;
                    var oldDragY = dragHeight - (currentValue * dragHeight);
                    var furtherFromX = Math.abs(dragX - oldDragX) > Math.abs(dragY - oldDragY);

                    shiftMovementDirection = furtherFromX ? "x" : "y";
                }

                var setSaturation = !shiftMovementDirection || shiftMovementDirection === "x";
                var setValue = !shiftMovementDirection || shiftMovementDirection === "y";

                if (setSaturation) {
                    currentSaturation = parseFloat(dragX / dragWidth);
                }
                if (setValue) {
                    currentValue = parseFloat((dragHeight - dragY) / dragHeight);
                }

                isEmpty = false;
                if (!opts.showAlpha) {
                    currentAlpha = 1;
                }

                move();

            }, dragStart, dragStop);

            if (!!initialColor) {
                set(initialColor);

                // In case color was black - update the preview UI and set the format
                // since the set function will not run (default color is black).
                updateUI();
                currentPreferredFormat = opts.preferredFormat || tinycolor(initialColor).format;

                addColorToSelectionPalette(initialColor);
            }
            else {
                updateUI();
            }

            if (flat) {
                show();
            }

            function paletteElementClick(e) {
                if (e.data && e.data.ignore) {
                    set($(e.target).closest(".sp-thumb-el").data("color"));
                    move();
                }
                else {
                    set($(e.target).closest(".sp-thumb-el").data("color"));
                    move();
                    updateOriginalInput(true);
                    if (opts.hideAfterPaletteSelect) {
                      hide();
                    }
                }

                return false;
            }

            var paletteEvent = IE ? "mousedown.spectrum" : "click.spectrum touchstart.spectrum";
            paletteContainer.delegate(".sp-thumb-el", paletteEvent, paletteElementClick);
            initialColorContainer.delegate(".sp-thumb-el:nth-child(1)", paletteEvent, { ignore: true }, paletteElementClick);
        }

        function updateSelectionPaletteFromStorage() {

            if (localStorageKey && window.localStorage) {

                // Migrate old palettes over to new format.  May want to remove this eventually.
                try {
                    var oldPalette = window.localStorage[localStorageKey].split(",#");
                    if (oldPalette.length > 1) {
                        delete window.localStorage[localStorageKey];
                        $.each(oldPalette, function(i, c) {
                             addColorToSelectionPalette(c);
                        });
                    }
                }
                catch(e) { }

                try {
                    selectionPalette = window.localStorage[localStorageKey].split(";");
                }
                catch (e) { }
            }
        }

        function addColorToSelectionPalette(color) {
            if (showSelectionPalette) {
                var rgb = tinycolor(color).toRgbString();
                if (!paletteLookup[rgb] && $.inArray(rgb, selectionPalette) === -1) {
                    selectionPalette.push(rgb);
                    while(selectionPalette.length > maxSelectionSize) {
                        selectionPalette.shift();
                    }
                }

                if (localStorageKey && window.localStorage) {
                    try {
                        window.localStorage[localStorageKey] = selectionPalette.join(";");
                    }
                    catch(e) { }
                }
            }
        }

        function getUniqueSelectionPalette() {
            var unique = [];
            if (opts.showPalette) {
                for (var i = 0; i < selectionPalette.length; i++) {
                    var rgb = tinycolor(selectionPalette[i]).toRgbString();

                    if (!paletteLookup[rgb]) {
                        unique.push(selectionPalette[i]);
                    }
                }
            }

            return unique.reverse().slice(0, opts.maxSelectionSize);
        }

        function drawPalette() {

            var currentColor = get();

            var html = $.map(paletteArray, function (palette, i) {
                return paletteTemplate(palette, currentColor, "sp-palette-row sp-palette-row-" + i, opts);
            });

            updateSelectionPaletteFromStorage();

            if (selectionPalette) {
                html.push(paletteTemplate(getUniqueSelectionPalette(), currentColor, "sp-palette-row sp-palette-row-selection", opts));
            }

            paletteContainer.html(html.join(""));
        }

        function drawInitial() {
            if (opts.showInitial) {
                var initial = colorOnShow;
                var current = get();
                initialColorContainer.html(paletteTemplate([initial, current], current, "sp-palette-row-initial", opts));
            }
        }

        function dragStart() {
            if (dragHeight <= 0 || dragWidth <= 0 || slideHeight <= 0) {
                reflow();
            }
            isDragging = true;
            container.addClass(draggingClass);
            shiftMovementDirection = null;
            boundElement.trigger('dragstart.spectrum', [ get() ]);
        }

        function dragStop() {
            isDragging = false;
            container.removeClass(draggingClass);
            boundElement.trigger('dragstop.spectrum', [ get() ]);
        }

        function setFromTextInput() {

            var value = textInput.val();

            if ((value === null || value === "") && allowEmpty) {
                set(null);
                updateOriginalInput(true);
            }
            else {
                var tiny = tinycolor(value);
                if (tiny.isValid()) {
                    set(tiny);
                    updateOriginalInput(true);
                }
                else {
                    textInput.addClass("sp-validation-error");
                }
            }
        }

        function toggle() {
            if (visible) {
                hide();
            }
            else {
                show();
            }
        }

        function show() {
            var event = $.Event('beforeShow.spectrum');

            if (visible) {
                reflow();
                return;
            }

            boundElement.trigger(event, [ get() ]);

            if (callbacks.beforeShow(get()) === false || event.isDefaultPrevented()) {
                return;
            }

            hideAll();
            visible = true;

            $(doc).bind("keydown.spectrum", onkeydown);
            $(doc).bind("click.spectrum", clickout);
            $(window).bind("resize.spectrum", resize);
            replacer.addClass("sp-active");
            container.removeClass("sp-hidden");

            reflow();
            updateUI();

            colorOnShow = get();

            drawInitial();
            callbacks.show(colorOnShow);
            boundElement.trigger('show.spectrum', [ colorOnShow ]);
        }

        function onkeydown(e) {
            // Close on ESC
            if (e.keyCode === 27) {
                hide();
            }
        }

        function clickout(e) {
            // Return on right click.
            if (e.button == 2) { return; }

            // If a drag event was happening during the mouseup, don't hide
            // on click.
            if (isDragging) { return; }

            if (clickoutFiresChange) {
                updateOriginalInput(true);
            }
            else {
                revert();
            }
            hide();
        }

        function hide() {
            // Return if hiding is unnecessary
            if (!visible || flat) { return; }
            visible = false;

            $(doc).unbind("keydown.spectrum", onkeydown);
            $(doc).unbind("click.spectrum", clickout);
            $(window).unbind("resize.spectrum", resize);

            replacer.removeClass("sp-active");
            container.addClass("sp-hidden");

            callbacks.hide(get());
            boundElement.trigger('hide.spectrum', [ get() ]);
        }

        function revert() {
            set(colorOnShow, true);
        }

        function set(color, ignoreFormatChange) {
            if (tinycolor.equals(color, get())) {
                // Update UI just in case a validation error needs
                // to be cleared.
                updateUI();
                return;
            }

            var newColor, newHsv;
            if (!color && allowEmpty) {
                isEmpty = true;
            } else {
                isEmpty = false;
                newColor = tinycolor(color);
                newHsv = newColor.toHsv();

                currentHue = (newHsv.h % 360) / 360;
                currentSaturation = newHsv.s;
                currentValue = newHsv.v;
                currentAlpha = newHsv.a;
            }
            updateUI();

            if (newColor && newColor.isValid() && !ignoreFormatChange) {
                currentPreferredFormat = opts.preferredFormat || newColor.getFormat();
            }
        }

        function get(opts) {
            opts = opts || { };

            if (allowEmpty && isEmpty) {
                return null;
            }

            return tinycolor.fromRatio({
                h: currentHue,
                s: currentSaturation,
                v: currentValue,
                a: Math.round(currentAlpha * 100) / 100
            }, { format: opts.format || currentPreferredFormat });
        }

        function isValid() {
            return !textInput.hasClass("sp-validation-error");
        }

        function move() {
            updateUI();

            callbacks.move(get());
            boundElement.trigger('move.spectrum', [ get() ]);
        }

        function updateUI() {

            textInput.removeClass("sp-validation-error");

            updateHelperLocations();

            // Update dragger background color (gradients take care of saturation and value).
            var flatColor = tinycolor.fromRatio({ h: currentHue, s: 1, v: 1 });
            dragger.css("background-color", flatColor.toHexString());

            // Get a format that alpha will be included in (hex and names ignore alpha)
            var format = currentPreferredFormat;
            if (currentAlpha < 1 && !(currentAlpha === 0 && format === "name")) {
                if (format === "hex" || format === "hex3" || format === "hex6" || format === "name") {
                    format = "rgb";
                }
            }

            var realColor = get({ format: format }),
                displayColor = '';

             //reset background info for preview element
            previewElement.removeClass("sp-clear-display");
            previewElement.css('background-color', 'transparent');

            if (!realColor && allowEmpty) {
                // Update the replaced elements background with icon indicating no color selection
                previewElement.addClass("sp-clear-display");
            }
            else {
                var realHex = realColor.toHexString(),
                    realRgb = realColor.toRgbString();

                // Update the replaced elements background color (with actual selected color)
                if (rgbaSupport || realColor.alpha === 1) {
                    previewElement.css("background-color", realRgb);
                }
                else {
                    previewElement.css("background-color", "transparent");
                    previewElement.css("filter", realColor.toFilter());
                }

                if (opts.showAlpha) {
                    var rgb = realColor.toRgb();
                    rgb.a = 0;
                    var realAlpha = tinycolor(rgb).toRgbString();
                    var gradient = "linear-gradient(left, " + realAlpha + ", " + realHex + ")";

                    if (IE) {
                        alphaSliderInner.css("filter", tinycolor(realAlpha).toFilter({ gradientType: 1 }, realHex));
                    }
                    else {
                        alphaSliderInner.css("background", "-webkit-" + gradient);
                        alphaSliderInner.css("background", "-moz-" + gradient);
                        alphaSliderInner.css("background", "-ms-" + gradient);
                        // Use current syntax gradient on unprefixed property.
                        alphaSliderInner.css("background",
                            "linear-gradient(to right, " + realAlpha + ", " + realHex + ")");
                    }
                }

                displayColor = realColor.toString(format);
            }

            // Update the text entry input as it changes happen
            if (opts.showInput) {
                textInput.val(displayColor);
            }

            if (opts.showPalette) {
                drawPalette();
            }

            drawInitial();
        }

        function updateHelperLocations() {
            var s = currentSaturation;
            var v = currentValue;

            if(allowEmpty && isEmpty) {
                //if selected color is empty, hide the helpers
                alphaSlideHelper.hide();
                slideHelper.hide();
                dragHelper.hide();
            }
            else {
                //make sure helpers are visible
                alphaSlideHelper.show();
                slideHelper.show();
                dragHelper.show();

                // Where to show the little circle in that displays your current selected color
                var dragX = s * dragWidth;
                var dragY = dragHeight - (v * dragHeight);
                dragX = Math.max(
                    -dragHelperHeight,
                    Math.min(dragWidth - dragHelperHeight, dragX - dragHelperHeight)
                );
                dragY = Math.max(
                    -dragHelperHeight,
                    Math.min(dragHeight - dragHelperHeight, dragY - dragHelperHeight)
                );
                dragHelper.css({
                    "top": dragY + "px",
                    "left": dragX + "px"
                });

                var alphaX = currentAlpha * alphaWidth;
                alphaSlideHelper.css({
                    "left": (alphaX - (alphaSlideHelperWidth / 2)) + "px"
                });

                // Where to show the bar that displays your current selected hue
                var slideY = (currentHue) * slideHeight;
                slideHelper.css({
                    "top": (slideY - slideHelperHeight) + "px"
                });
            }
        }

        function updateOriginalInput(fireCallback) {
            var color = get(),
                displayColor = '',
                hasChanged = !tinycolor.equals(color, colorOnShow);

            if (color) {
                displayColor = color.toString(currentPreferredFormat);
                // Update the selection palette with the current color
                addColorToSelectionPalette(color);
            }

            if (isInput) {
                boundElement.val(displayColor);
            }

            if (fireCallback && hasChanged) {
                callbacks.change(color);
                boundElement.trigger('change', [ color ]);
            }
        }

        function reflow() {
            if (!visible) {
                return; // Calculations would be useless and wouldn't be reliable anyways
            }
            dragWidth = dragger.width();
            dragHeight = dragger.height();
            dragHelperHeight = dragHelper.height();
            slideWidth = slider.width();
            slideHeight = slider.height();
            slideHelperHeight = slideHelper.height();
            alphaWidth = alphaSlider.width();
            alphaSlideHelperWidth = alphaSlideHelper.width();

            if (!flat) {
                container.css("position", "absolute");
                if (opts.offset) {
                    container.offset(opts.offset);
                } else {
                    container.offset(getOffset(container, offsetElement));
                }
            }

            updateHelperLocations();

            if (opts.showPalette) {
                drawPalette();
            }

            boundElement.trigger('reflow.spectrum');
        }

        function destroy() {
            boundElement.show();
            offsetElement.unbind("click.spectrum touchstart.spectrum");
            container.remove();
            replacer.remove();
            spectrums[spect.id] = null;
        }

        function option(optionName, optionValue) {
            if (optionName === undefined) {
                return $.extend({}, opts);
            }
            if (optionValue === undefined) {
                return opts[optionName];
            }

            opts[optionName] = optionValue;

            if (optionName === "preferredFormat") {
                currentPreferredFormat = opts.preferredFormat;
            }
            applyOptions();
        }

        function enable() {
            disabled = false;
            boundElement.attr("disabled", false);
            offsetElement.removeClass("sp-disabled");
        }

        function disable() {
            hide();
            disabled = true;
            boundElement.attr("disabled", true);
            offsetElement.addClass("sp-disabled");
        }

        function setOffset(coord) {
            opts.offset = coord;
            reflow();
        }

        initialize();

        var spect = {
            show: show,
            hide: hide,
            toggle: toggle,
            reflow: reflow,
            option: option,
            enable: enable,
            disable: disable,
            offset: setOffset,
            set: function (c) {
                set(c);
                updateOriginalInput();
            },
            get: get,
            destroy: destroy,
            container: container
        };

        spect.id = spectrums.push(spect) - 1;

        return spect;
    }

    /**
    * checkOffset - get the offset below/above and left/right element depending on screen position
    * Thanks https://github.com/jquery/jquery-ui/blob/master/ui/jquery.ui.datepicker.js
    */
    function getOffset(picker, input) {
        var extraY = 0;
        var dpWidth = picker.outerWidth();
        var dpHeight = picker.outerHeight();
        var inputHeight = input.outerHeight();
        var doc = picker[0].ownerDocument;
        var docElem = doc.documentElement;
        var viewWidth = docElem.clientWidth + $(doc).scrollLeft();
        var viewHeight = docElem.clientHeight + $(doc).scrollTop();
        var offset = input.offset();
        offset.top += inputHeight;

        offset.left -=
            Math.min(offset.left, (offset.left + dpWidth > viewWidth && viewWidth > dpWidth) ?
            Math.abs(offset.left + dpWidth - viewWidth) : 0);

        offset.top -=
            Math.min(offset.top, ((offset.top + dpHeight > viewHeight && viewHeight > dpHeight) ?
            Math.abs(dpHeight + inputHeight - extraY) : extraY));

        return offset;
    }

    /**
    * noop - do nothing
    */
    function noop() {

    }

    /**
    * stopPropagation - makes the code only doing this a little easier to read in line
    */
    function stopPropagation(e) {
        e.stopPropagation();
    }

    /**
    * Create a function bound to a given object
    * Thanks to underscore.js
    */
    function bind(func, obj) {
        var slice = Array.prototype.slice;
        var args = slice.call(arguments, 2);
        return function () {
            return func.apply(obj, args.concat(slice.call(arguments)));
        };
    }

    /**
    * Lightweight drag helper.  Handles containment within the element, so that
    * when dragging, the x is within [0,element.width] and y is within [0,element.height]
    */
    function draggable(element, onmove, onstart, onstop) {
        onmove = onmove || function () { };
        onstart = onstart || function () { };
        onstop = onstop || function () { };
        var doc = document;
        var dragging = false;
        var offset = {};
        var maxHeight = 0;
        var maxWidth = 0;
        var hasTouch = ('ontouchstart' in window);

        var duringDragEvents = {};
        duringDragEvents["selectstart"] = prevent;
        duringDragEvents["dragstart"] = prevent;
        duringDragEvents["touchmove mousemove"] = move;
        duringDragEvents["touchend mouseup"] = stop;

        function prevent(e) {
            if (e.stopPropagation) {
                e.stopPropagation();
            }
            if (e.preventDefault) {
                e.preventDefault();
            }
            e.returnValue = false;
        }

        function move(e) {
            if (dragging) {
                // Mouseup happened outside of window
                if (IE && doc.documentMode < 9 && !e.button) {
                    return stop();
                }

                var t0 = e.originalEvent && e.originalEvent.touches && e.originalEvent.touches[0];
                var pageX = t0 && t0.pageX || e.pageX;
                var pageY = t0 && t0.pageY || e.pageY;

                var dragX = Math.max(0, Math.min(pageX - offset.left, maxWidth));
                var dragY = Math.max(0, Math.min(pageY - offset.top, maxHeight));

                if (hasTouch) {
                    // Stop scrolling in iOS
                    prevent(e);
                }

                onmove.apply(element, [dragX, dragY, e]);
            }
        }

        function start(e) {
            var rightclick = (e.which) ? (e.which == 3) : (e.button == 2);

            if (!rightclick && !dragging) {
                if (onstart.apply(element, arguments) !== false) {
                    dragging = true;
                    maxHeight = $(element).height();
                    maxWidth = $(element).width();
                    offset = $(element).offset();

                    $(doc).bind(duringDragEvents);
                    $(doc.body).addClass("sp-dragging");

                    move(e);

                    prevent(e);
                }
            }
        }

        function stop() {
            if (dragging) {
                $(doc).unbind(duringDragEvents);
                $(doc.body).removeClass("sp-dragging");

                // Wait a tick before notifying observers to allow the click event
                // to fire in Chrome.
                setTimeout(function() {
                    onstop.apply(element, arguments);
                }, 0);
            }
            dragging = false;
        }

        $(element).bind("touchstart mousedown", start);
    }

    function throttle(func, wait, debounce) {
        var timeout;
        return function () {
            var context = this, args = arguments;
            var throttler = function () {
                timeout = null;
                func.apply(context, args);
            };
            if (debounce) clearTimeout(timeout);
            if (debounce || !timeout) timeout = setTimeout(throttler, wait);
        };
    }

    function inputTypeColorSupport() {
        return $.fn.spectrum.inputTypeColorSupport();
    }

    /**
    * Define a jQuery plugin
    */
    var dataID = "spectrum.id";
    $.fn.spectrum = function (opts, extra) {

        if (typeof opts == "string") {

            var returnValue = this;
            var args = Array.prototype.slice.call( arguments, 1 );

            this.each(function () {
                var spect = spectrums[$(this).data(dataID)];
                if (spect) {
                    var method = spect[opts];
                    if (!method) {
                        throw new Error( "Spectrum: no such method: '" + opts + "'" );
                    }

                    if (opts == "get") {
                        returnValue = spect.get();
                    }
                    else if (opts == "container") {
                        returnValue = spect.container;
                    }
                    else if (opts == "option") {
                        returnValue = spect.option.apply(spect, args);
                    }
                    else if (opts == "destroy") {
                        spect.destroy();
                        $(this).removeData(dataID);
                    }
                    else {
                        method.apply(spect, args);
                    }
                }
            });

            return returnValue;
        }

        // Initializing a new instance of spectrum
        return this.spectrum("destroy").each(function () {
            var options = $.extend({}, opts, $(this).data());
            var spect = spectrum(this, options);
            $(this).data(dataID, spect.id);
        });
    };

    $.fn.spectrum.load = true;
    $.fn.spectrum.loadOpts = {};
    $.fn.spectrum.draggable = draggable;
    $.fn.spectrum.defaults = defaultOpts;
    $.fn.spectrum.inputTypeColorSupport = function inputTypeColorSupport() {
        if (typeof inputTypeColorSupport._cachedResult === "undefined") {
            var colorInput = $("<input type='color'/>")[0]; // if color element is supported, value will default to not null
            inputTypeColorSupport._cachedResult = colorInput.type === "color" && colorInput.value !== "";
        }
        return inputTypeColorSupport._cachedResult;
    };

    $.spectrum = { };
    $.spectrum.localization = { };
    $.spectrum.palettes = { };

    $.fn.spectrum.processNativeColorInputs = function () {
        var colorInputs = $("input[type=color]");
        if (colorInputs.length && !inputTypeColorSupport()) {
            colorInputs.spectrum({
                preferredFormat: "hex6"
            });
        }
    };

    // TinyColor v1.1.2
    // https://github.com/bgrins/TinyColor
    // Brian Grinstead, MIT License

    (function() {

    var trimLeft = /^[\s,#]+/,
        trimRight = /\s+$/,
        tinyCounter = 0,
        math = Math,
        mathRound = math.round,
        mathMin = math.min,
        mathMax = math.max,
        mathRandom = math.random;

    var tinycolor = function(color, opts) {

        color = (color) ? color : '';
        opts = opts || { };

        // If input is already a tinycolor, return itself
        if (color instanceof tinycolor) {
           return color;
        }
        // If we are called as a function, call using new instead
        if (!(this instanceof tinycolor)) {
            return new tinycolor(color, opts);
        }

        var rgb = inputToRGB(color);
        this._originalInput = color,
        this._r = rgb.r,
        this._g = rgb.g,
        this._b = rgb.b,
        this._a = rgb.a,
        this._roundA = mathRound(100*this._a) / 100,
        this._format = opts.format || rgb.format;
        this._gradientType = opts.gradientType;

        // Don't let the range of [0,255] come back in [0,1].
        // Potentially lose a little bit of precision here, but will fix issues where
        // .5 gets interpreted as half of the total, instead of half of 1
        // If it was supposed to be 128, this was already taken care of by `inputToRgb`
        if (this._r < 1) { this._r = mathRound(this._r); }
        if (this._g < 1) { this._g = mathRound(this._g); }
        if (this._b < 1) { this._b = mathRound(this._b); }

        this._ok = rgb.ok;
        this._tc_id = tinyCounter++;
    };

    tinycolor.prototype = {
        isDark: function() {
            return this.getBrightness() < 128;
        },
        isLight: function() {
            return !this.isDark();
        },
        isValid: function() {
            return this._ok;
        },
        getOriginalInput: function() {
          return this._originalInput;
        },
        getFormat: function() {
            return this._format;
        },
        getAlpha: function() {
            return this._a;
        },
        getBrightness: function() {
            var rgb = this.toRgb();
            return (rgb.r * 299 + rgb.g * 587 + rgb.b * 114) / 1000;
        },
        setAlpha: function(value) {
            this._a = boundAlpha(value);
            this._roundA = mathRound(100*this._a) / 100;
            return this;
        },
        toHsv: function() {
            var hsv = rgbToHsv(this._r, this._g, this._b);
            return { h: hsv.h * 360, s: hsv.s, v: hsv.v, a: this._a };
        },
        toHsvString: function() {
            var hsv = rgbToHsv(this._r, this._g, this._b);
            var h = mathRound(hsv.h * 360), s = mathRound(hsv.s * 100), v = mathRound(hsv.v * 100);
            return (this._a == 1) ?
              "hsv("  + h + ", " + s + "%, " + v + "%)" :
              "hsva(" + h + ", " + s + "%, " + v + "%, "+ this._roundA + ")";
        },
        toHsl: function() {
            var hsl = rgbToHsl(this._r, this._g, this._b);
            return { h: hsl.h * 360, s: hsl.s, l: hsl.l, a: this._a };
        },
        toHslString: function() {
            var hsl = rgbToHsl(this._r, this._g, this._b);
            var h = mathRound(hsl.h * 360), s = mathRound(hsl.s * 100), l = mathRound(hsl.l * 100);
            return (this._a == 1) ?
              "hsl("  + h + ", " + s + "%, " + l + "%)" :
              "hsla(" + h + ", " + s + "%, " + l + "%, "+ this._roundA + ")";
        },
        toHex: function(allow3Char) {
            return rgbToHex(this._r, this._g, this._b, allow3Char);
        },
        toHexString: function(allow3Char) {
            return '#' + this.toHex(allow3Char);
        },
        toHex8: function() {
            return rgbaToHex(this._r, this._g, this._b, this._a);
        },
        toHex8String: function() {
            return '#' + this.toHex8();
        },
        toRgb: function() {
            return { r: mathRound(this._r), g: mathRound(this._g), b: mathRound(this._b), a: this._a };
        },
        toRgbString: function() {
            return (this._a == 1) ?
              "rgb("  + mathRound(this._r) + ", " + mathRound(this._g) + ", " + mathRound(this._b) + ")" :
              "rgba(" + mathRound(this._r) + ", " + mathRound(this._g) + ", " + mathRound(this._b) + ", " + this._roundA + ")";
        },
        toPercentageRgb: function() {
            return { r: mathRound(bound01(this._r, 255) * 100) + "%", g: mathRound(bound01(this._g, 255) * 100) + "%", b: mathRound(bound01(this._b, 255) * 100) + "%", a: this._a };
        },
        toPercentageRgbString: function() {
            return (this._a == 1) ?
              "rgb("  + mathRound(bound01(this._r, 255) * 100) + "%, " + mathRound(bound01(this._g, 255) * 100) + "%, " + mathRound(bound01(this._b, 255) * 100) + "%)" :
              "rgba(" + mathRound(bound01(this._r, 255) * 100) + "%, " + mathRound(bound01(this._g, 255) * 100) + "%, " + mathRound(bound01(this._b, 255) * 100) + "%, " + this._roundA + ")";
        },
        toName: function() {
            if (this._a === 0) {
                return "transparent";
            }

            if (this._a < 1) {
                return false;
            }

            return hexNames[rgbToHex(this._r, this._g, this._b, true)] || false;
        },
        toFilter: function(secondColor) {
            var hex8String = '#' + rgbaToHex(this._r, this._g, this._b, this._a);
            var secondHex8String = hex8String;
            var gradientType = this._gradientType ? "GradientType = 1, " : "";

            if (secondColor) {
                var s = tinycolor(secondColor);
                secondHex8String = s.toHex8String();
            }

            return "progid:DXImageTransform.Microsoft.gradient("+gradientType+"startColorstr="+hex8String+",endColorstr="+secondHex8String+")";
        },
        toString: function(format) {
            var formatSet = !!format;
            format = format || this._format;

            var formattedString = false;
            var hasAlpha = this._a < 1 && this._a >= 0;
            var needsAlphaFormat = !formatSet && hasAlpha && (format === "hex" || format === "hex6" || format === "hex3" || format === "name");

            if (needsAlphaFormat) {
                // Special case for "transparent", all other non-alpha formats
                // will return rgba when there is transparency.
                if (format === "name" && this._a === 0) {
                    return this.toName();
                }
                return this.toRgbString();
            }
            if (format === "rgb") {
                formattedString = this.toRgbString();
            }
            if (format === "prgb") {
                formattedString = this.toPercentageRgbString();
            }
            if (format === "hex" || format === "hex6") {
                formattedString = this.toHexString();
            }
            if (format === "hex3") {
                formattedString = this.toHexString(true);
            }
            if (format === "hex8") {
                formattedString = this.toHex8String();
            }
            if (format === "name") {
                formattedString = this.toName();
            }
            if (format === "hsl") {
                formattedString = this.toHslString();
            }
            if (format === "hsv") {
                formattedString = this.toHsvString();
            }

            return formattedString || this.toHexString();
        },

        _applyModification: function(fn, args) {
            var color = fn.apply(null, [this].concat([].slice.call(args)));
            this._r = color._r;
            this._g = color._g;
            this._b = color._b;
            this.setAlpha(color._a);
            return this;
        },
        lighten: function() {
            return this._applyModification(lighten, arguments);
        },
        brighten: function() {
            return this._applyModification(brighten, arguments);
        },
        darken: function() {
            return this._applyModification(darken, arguments);
        },
        desaturate: function() {
            return this._applyModification(desaturate, arguments);
        },
        saturate: function() {
            return this._applyModification(saturate, arguments);
        },
        greyscale: function() {
            return this._applyModification(greyscale, arguments);
        },
        spin: function() {
            return this._applyModification(spin, arguments);
        },

        _applyCombination: function(fn, args) {
            return fn.apply(null, [this].concat([].slice.call(args)));
        },
        analogous: function() {
            return this._applyCombination(analogous, arguments);
        },
        complement: function() {
            return this._applyCombination(complement, arguments);
        },
        monochromatic: function() {
            return this._applyCombination(monochromatic, arguments);
        },
        splitcomplement: function() {
            return this._applyCombination(splitcomplement, arguments);
        },
        triad: function() {
            return this._applyCombination(triad, arguments);
        },
        tetrad: function() {
            return this._applyCombination(tetrad, arguments);
        }
    };

    // If input is an object, force 1 into "1.0" to handle ratios properly
    // String input requires "1.0" as input, so 1 will be treated as 1
    tinycolor.fromRatio = function(color, opts) {
        if (typeof color == "object") {
            var newColor = {};
            for (var i in color) {
                if (color.hasOwnProperty(i)) {
                    if (i === "a") {
                        newColor[i] = color[i];
                    }
                    else {
                        newColor[i] = convertToPercentage(color[i]);
                    }
                }
            }
            color = newColor;
        }

        return tinycolor(color, opts);
    };

    // Given a string or object, convert that input to RGB
    // Possible string inputs:
    //
    //     "red"
    //     "#f00" or "f00"
    //     "#ff0000" or "ff0000"
    //     "#ff000000" or "ff000000"
    //     "rgb 255 0 0" or "rgb (255, 0, 0)"
    //     "rgb 1.0 0 0" or "rgb (1, 0, 0)"
    //     "rgba (255, 0, 0, 1)" or "rgba 255, 0, 0, 1"
    //     "rgba (1.0, 0, 0, 1)" or "rgba 1.0, 0, 0, 1"
    //     "hsl(0, 100%, 50%)" or "hsl 0 100% 50%"
    //     "hsla(0, 100%, 50%, 1)" or "hsla 0 100% 50%, 1"
    //     "hsv(0, 100%, 100%)" or "hsv 0 100% 100%"
    //
    function inputToRGB(color) {

        var rgb = { r: 0, g: 0, b: 0 };
        var a = 1;
        var ok = false;
        var format = false;

        if (typeof color == "string") {
            color = stringInputToObject(color);
        }

        if (typeof color == "object") {
            if (color.hasOwnProperty("r") && color.hasOwnProperty("g") && color.hasOwnProperty("b")) {
                rgb = rgbToRgb(color.r, color.g, color.b);
                ok = true;
                format = String(color.r).substr(-1) === "%" ? "prgb" : "rgb";
            }
            else if (color.hasOwnProperty("h") && color.hasOwnProperty("s") && color.hasOwnProperty("v")) {
                color.s = convertToPercentage(color.s);
                color.v = convertToPercentage(color.v);
                rgb = hsvToRgb(color.h, color.s, color.v);
                ok = true;
                format = "hsv";
            }
            else if (color.hasOwnProperty("h") && color.hasOwnProperty("s") && color.hasOwnProperty("l")) {
                color.s = convertToPercentage(color.s);
                color.l = convertToPercentage(color.l);
                rgb = hslToRgb(color.h, color.s, color.l);
                ok = true;
                format = "hsl";
            }

            if (color.hasOwnProperty("a")) {
                a = color.a;
            }
        }

        a = boundAlpha(a);

        return {
            ok: ok,
            format: color.format || format,
            r: mathMin(255, mathMax(rgb.r, 0)),
            g: mathMin(255, mathMax(rgb.g, 0)),
            b: mathMin(255, mathMax(rgb.b, 0)),
            a: a
        };
    }


    // Conversion Functions
    // --------------------

    // `rgbToHsl`, `rgbToHsv`, `hslToRgb`, `hsvToRgb` modified from:
    // <http://mjijackson.com/2008/02/rgb-to-hsl-and-rgb-to-hsv-color-model-conversion-algorithms-in-javascript>

    // `rgbToRgb`
    // Handle bounds / percentage checking to conform to CSS color spec
    // <http://www.w3.org/TR/css3-color/>
    // *Assumes:* r, g, b in [0, 255] or [0, 1]
    // *Returns:* { r, g, b } in [0, 255]
    function rgbToRgb(r, g, b){
        return {
            r: bound01(r, 255) * 255,
            g: bound01(g, 255) * 255,
            b: bound01(b, 255) * 255
        };
    }

    // `rgbToHsl`
    // Converts an RGB color value to HSL.
    // *Assumes:* r, g, and b are contained in [0, 255] or [0, 1]
    // *Returns:* { h, s, l } in [0,1]
    function rgbToHsl(r, g, b) {

        r = bound01(r, 255);
        g = bound01(g, 255);
        b = bound01(b, 255);

        var max = mathMax(r, g, b), min = mathMin(r, g, b);
        var h, s, l = (max + min) / 2;

        if(max == min) {
            h = s = 0; // achromatic
        }
        else {
            var d = max - min;
            s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
            switch(max) {
                case r: h = (g - b) / d + (g < b ? 6 : 0); break;
                case g: h = (b - r) / d + 2; break;
                case b: h = (r - g) / d + 4; break;
            }

            h /= 6;
        }

        return { h: h, s: s, l: l };
    }

    // `hslToRgb`
    // Converts an HSL color value to RGB.
    // *Assumes:* h is contained in [0, 1] or [0, 360] and s and l are contained [0, 1] or [0, 100]
    // *Returns:* { r, g, b } in the set [0, 255]
    function hslToRgb(h, s, l) {
        var r, g, b;

        h = bound01(h, 360);
        s = bound01(s, 100);
        l = bound01(l, 100);

        function hue2rgb(p, q, t) {
            if(t < 0) t += 1;
            if(t > 1) t -= 1;
            if(t < 1/6) return p + (q - p) * 6 * t;
            if(t < 1/2) return q;
            if(t < 2/3) return p + (q - p) * (2/3 - t) * 6;
            return p;
        }

        if(s === 0) {
            r = g = b = l; // achromatic
        }
        else {
            var q = l < 0.5 ? l * (1 + s) : l + s - l * s;
            var p = 2 * l - q;
            r = hue2rgb(p, q, h + 1/3);
            g = hue2rgb(p, q, h);
            b = hue2rgb(p, q, h - 1/3);
        }

        return { r: r * 255, g: g * 255, b: b * 255 };
    }

    // `rgbToHsv`
    // Converts an RGB color value to HSV
    // *Assumes:* r, g, and b are contained in the set [0, 255] or [0, 1]
    // *Returns:* { h, s, v } in [0,1]
    function rgbToHsv(r, g, b) {

        r = bound01(r, 255);
        g = bound01(g, 255);
        b = bound01(b, 255);

        var max = mathMax(r, g, b), min = mathMin(r, g, b);
        var h, s, v = max;

        var d = max - min;
        s = max === 0 ? 0 : d / max;

        if(max == min) {
            h = 0; // achromatic
        }
        else {
            switch(max) {
                case r: h = (g - b) / d + (g < b ? 6 : 0); break;
                case g: h = (b - r) / d + 2; break;
                case b: h = (r - g) / d + 4; break;
            }
            h /= 6;
        }
        return { h: h, s: s, v: v };
    }

    // `hsvToRgb`
    // Converts an HSV color value to RGB.
    // *Assumes:* h is contained in [0, 1] or [0, 360] and s and v are contained in [0, 1] or [0, 100]
    // *Returns:* { r, g, b } in the set [0, 255]
     function hsvToRgb(h, s, v) {

        h = bound01(h, 360) * 6;
        s = bound01(s, 100);
        v = bound01(v, 100);

        var i = math.floor(h),
            f = h - i,
            p = v * (1 - s),
            q = v * (1 - f * s),
            t = v * (1 - (1 - f) * s),
            mod = i % 6,
            r = [v, q, p, p, t, v][mod],
            g = [t, v, v, q, p, p][mod],
            b = [p, p, t, v, v, q][mod];

        return { r: r * 255, g: g * 255, b: b * 255 };
    }

    // `rgbToHex`
    // Converts an RGB color to hex
    // Assumes r, g, and b are contained in the set [0, 255]
    // Returns a 3 or 6 character hex
    function rgbToHex(r, g, b, allow3Char) {

        var hex = [
            pad2(mathRound(r).toString(16)),
            pad2(mathRound(g).toString(16)),
            pad2(mathRound(b).toString(16))
        ];

        // Return a 3 character hex if possible
        if (allow3Char && hex[0].charAt(0) == hex[0].charAt(1) && hex[1].charAt(0) == hex[1].charAt(1) && hex[2].charAt(0) == hex[2].charAt(1)) {
            return hex[0].charAt(0) + hex[1].charAt(0) + hex[2].charAt(0);
        }

        return hex.join("");
    }
        // `rgbaToHex`
        // Converts an RGBA color plus alpha transparency to hex
        // Assumes r, g, b and a are contained in the set [0, 255]
        // Returns an 8 character hex
        function rgbaToHex(r, g, b, a) {

            var hex = [
                pad2(convertDecimalToHex(a)),
                pad2(mathRound(r).toString(16)),
                pad2(mathRound(g).toString(16)),
                pad2(mathRound(b).toString(16))
            ];

            return hex.join("");
        }

    // `equals`
    // Can be called with any tinycolor input
    tinycolor.equals = function (color1, color2) {
        if (!color1 || !color2) { return false; }
        return tinycolor(color1).toRgbString() == tinycolor(color2).toRgbString();
    };
    tinycolor.random = function() {
        return tinycolor.fromRatio({
            r: mathRandom(),
            g: mathRandom(),
            b: mathRandom()
        });
    };


    // Modification Functions
    // ----------------------
    // Thanks to less.js for some of the basics here
    // <https://github.com/cloudhead/less.js/blob/master/lib/less/functions.js>

    function desaturate(color, amount) {
        amount = (amount === 0) ? 0 : (amount || 10);
        var hsl = tinycolor(color).toHsl();
        hsl.s -= amount / 100;
        hsl.s = clamp01(hsl.s);
        return tinycolor(hsl);
    }

    function saturate(color, amount) {
        amount = (amount === 0) ? 0 : (amount || 10);
        var hsl = tinycolor(color).toHsl();
        hsl.s += amount / 100;
        hsl.s = clamp01(hsl.s);
        return tinycolor(hsl);
    }

    function greyscale(color) {
        return tinycolor(color).desaturate(100);
    }

    function lighten (color, amount) {
        amount = (amount === 0) ? 0 : (amount || 10);
        var hsl = tinycolor(color).toHsl();
        hsl.l += amount / 100;
        hsl.l = clamp01(hsl.l);
        return tinycolor(hsl);
    }

    function brighten(color, amount) {
        amount = (amount === 0) ? 0 : (amount || 10);
        var rgb = tinycolor(color).toRgb();
        rgb.r = mathMax(0, mathMin(255, rgb.r - mathRound(255 * - (amount / 100))));
        rgb.g = mathMax(0, mathMin(255, rgb.g - mathRound(255 * - (amount / 100))));
        rgb.b = mathMax(0, mathMin(255, rgb.b - mathRound(255 * - (amount / 100))));
        return tinycolor(rgb);
    }

    function darken (color, amount) {
        amount = (amount === 0) ? 0 : (amount || 10);
        var hsl = tinycolor(color).toHsl();
        hsl.l -= amount / 100;
        hsl.l = clamp01(hsl.l);
        return tinycolor(hsl);
    }

    // Spin takes a positive or negative amount within [-360, 360] indicating the change of hue.
    // Values outside of this range will be wrapped into this range.
    function spin(color, amount) {
        var hsl = tinycolor(color).toHsl();
        var hue = (mathRound(hsl.h) + amount) % 360;
        hsl.h = hue < 0 ? 360 + hue : hue;
        return tinycolor(hsl);
    }

    // Combination Functions
    // ---------------------
    // Thanks to jQuery xColor for some of the ideas behind these
    // <https://github.com/infusion/jQuery-xcolor/blob/master/jquery.xcolor.js>

    function complement(color) {
        var hsl = tinycolor(color).toHsl();
        hsl.h = (hsl.h + 180) % 360;
        return tinycolor(hsl);
    }

    function triad(color) {
        var hsl = tinycolor(color).toHsl();
        var h = hsl.h;
        return [
            tinycolor(color),
            tinycolor({ h: (h + 120) % 360, s: hsl.s, l: hsl.l }),
            tinycolor({ h: (h + 240) % 360, s: hsl.s, l: hsl.l })
        ];
    }

    function tetrad(color) {
        var hsl = tinycolor(color).toHsl();
        var h = hsl.h;
        return [
            tinycolor(color),
            tinycolor({ h: (h + 90) % 360, s: hsl.s, l: hsl.l }),
            tinycolor({ h: (h + 180) % 360, s: hsl.s, l: hsl.l }),
            tinycolor({ h: (h + 270) % 360, s: hsl.s, l: hsl.l })
        ];
    }

    function splitcomplement(color) {
        var hsl = tinycolor(color).toHsl();
        var h = hsl.h;
        return [
            tinycolor(color),
            tinycolor({ h: (h + 72) % 360, s: hsl.s, l: hsl.l}),
            tinycolor({ h: (h + 216) % 360, s: hsl.s, l: hsl.l})
        ];
    }

    function analogous(color, results, slices) {
        results = results || 6;
        slices = slices || 30;

        var hsl = tinycolor(color).toHsl();
        var part = 360 / slices;
        var ret = [tinycolor(color)];

        for (hsl.h = ((hsl.h - (part * results >> 1)) + 720) % 360; --results; ) {
            hsl.h = (hsl.h + part) % 360;
            ret.push(tinycolor(hsl));
        }
        return ret;
    }

    function monochromatic(color, results) {
        results = results || 6;
        var hsv = tinycolor(color).toHsv();
        var h = hsv.h, s = hsv.s, v = hsv.v;
        var ret = [];
        var modification = 1 / results;

        while (results--) {
            ret.push(tinycolor({ h: h, s: s, v: v}));
            v = (v + modification) % 1;
        }

        return ret;
    }

    // Utility Functions
    // ---------------------

    tinycolor.mix = function(color1, color2, amount) {
        amount = (amount === 0) ? 0 : (amount || 50);

        var rgb1 = tinycolor(color1).toRgb();
        var rgb2 = tinycolor(color2).toRgb();

        var p = amount / 100;
        var w = p * 2 - 1;
        var a = rgb2.a - rgb1.a;

        var w1;

        if (w * a == -1) {
            w1 = w;
        } else {
            w1 = (w + a) / (1 + w * a);
        }

        w1 = (w1 + 1) / 2;

        var w2 = 1 - w1;

        var rgba = {
            r: rgb2.r * w1 + rgb1.r * w2,
            g: rgb2.g * w1 + rgb1.g * w2,
            b: rgb2.b * w1 + rgb1.b * w2,
            a: rgb2.a * p  + rgb1.a * (1 - p)
        };

        return tinycolor(rgba);
    };


    // Readability Functions
    // ---------------------
    // <http://www.w3.org/TR/AERT#color-contrast>

    // `readability`
    // Analyze the 2 colors and returns an object with the following properties:
    //    `brightness`: difference in brightness between the two colors
    //    `color`: difference in color/hue between the two colors
    tinycolor.readability = function(color1, color2) {
        var c1 = tinycolor(color1);
        var c2 = tinycolor(color2);
        var rgb1 = c1.toRgb();
        var rgb2 = c2.toRgb();
        var brightnessA = c1.getBrightness();
        var brightnessB = c2.getBrightness();
        var colorDiff = (
            Math.max(rgb1.r, rgb2.r) - Math.min(rgb1.r, rgb2.r) +
            Math.max(rgb1.g, rgb2.g) - Math.min(rgb1.g, rgb2.g) +
            Math.max(rgb1.b, rgb2.b) - Math.min(rgb1.b, rgb2.b)
        );

        return {
            brightness: Math.abs(brightnessA - brightnessB),
            color: colorDiff
        };
    };

    // `readable`
    // http://www.w3.org/TR/AERT#color-contrast
    // Ensure that foreground and background color combinations provide sufficient contrast.
    // *Example*
    //    tinycolor.isReadable("#000", "#111") => false
    tinycolor.isReadable = function(color1, color2) {
        var readability = tinycolor.readability(color1, color2);
        return readability.brightness > 125 && readability.color > 500;
    };

    // `mostReadable`
    // Given a base color and a list of possible foreground or background
    // colors for that base, returns the most readable color.
    // *Example*
    //    tinycolor.mostReadable("#123", ["#fff", "#000"]) => "#000"
    tinycolor.mostReadable = function(baseColor, colorList) {
        var bestColor = null;
        var bestScore = 0;
        var bestIsReadable = false;
        for (var i=0; i < colorList.length; i++) {

            // We normalize both around the "acceptable" breaking point,
            // but rank brightness constrast higher than hue.

            var readability = tinycolor.readability(baseColor, colorList[i]);
            var readable = readability.brightness > 125 && readability.color > 500;
            var score = 3 * (readability.brightness / 125) + (readability.color / 500);

            if ((readable && ! bestIsReadable) ||
                (readable && bestIsReadable && score > bestScore) ||
                ((! readable) && (! bestIsReadable) && score > bestScore)) {
                bestIsReadable = readable;
                bestScore = score;
                bestColor = tinycolor(colorList[i]);
            }
        }
        return bestColor;
    };


    // Big List of Colors
    // ------------------
    // <http://www.w3.org/TR/css3-color/#svg-color>
    var names = tinycolor.names = {
        aliceblue: "f0f8ff",
        antiquewhite: "faebd7",
        aqua: "0ff",
        aquamarine: "7fffd4",
        azure: "f0ffff",
        beige: "f5f5dc",
        bisque: "ffe4c4",
        black: "000",
        blanchedalmond: "ffebcd",
        blue: "00f",
        blueviolet: "8a2be2",
        brown: "a52a2a",
        burlywood: "deb887",
        burntsienna: "ea7e5d",
        cadetblue: "5f9ea0",
        chartreuse: "7fff00",
        chocolate: "d2691e",
        coral: "ff7f50",
        cornflowerblue: "6495ed",
        cornsilk: "fff8dc",
        crimson: "dc143c",
        cyan: "0ff",
        darkblue: "00008b",
        darkcyan: "008b8b",
        darkgoldenrod: "b8860b",
        darkgray: "a9a9a9",
        darkgreen: "006400",
        darkgrey: "a9a9a9",
        darkkhaki: "bdb76b",
        darkmagenta: "8b008b",
        darkolivegreen: "556b2f",
        darkorange: "ff8c00",
        darkorchid: "9932cc",
        darkred: "8b0000",
        darksalmon: "e9967a",
        darkseagreen: "8fbc8f",
        darkslateblue: "483d8b",
        darkslategray: "2f4f4f",
        darkslategrey: "2f4f4f",
        darkturquoise: "00ced1",
        darkviolet: "9400d3",
        deeppink: "ff1493",
        deepskyblue: "00bfff",
        dimgray: "696969",
        dimgrey: "696969",
        dodgerblue: "1e90ff",
        firebrick: "b22222",
        floralwhite: "fffaf0",
        forestgreen: "228b22",
        fuchsia: "f0f",
        gainsboro: "dcdcdc",
        ghostwhite: "f8f8ff",
        gold: "ffd700",
        goldenrod: "daa520",
        gray: "808080",
        green: "008000",
        greenyellow: "adff2f",
        grey: "808080",
        honeydew: "f0fff0",
        hotpink: "ff69b4",
        indianred: "cd5c5c",
        indigo: "4b0082",
        ivory: "fffff0",
        khaki: "f0e68c",
        lavender: "e6e6fa",
        lavenderblush: "fff0f5",
        lawngreen: "7cfc00",
        lemonchiffon: "fffacd",
        lightblue: "add8e6",
        lightcoral: "f08080",
        lightcyan: "e0ffff",
        lightgoldenrodyellow: "fafad2",
        lightgray: "d3d3d3",
        lightgreen: "90ee90",
        lightgrey: "d3d3d3",
        lightpink: "ffb6c1",
        lightsalmon: "ffa07a",
        lightseagreen: "20b2aa",
        lightskyblue: "87cefa",
        lightslategray: "789",
        lightslategrey: "789",
        lightsteelblue: "b0c4de",
        lightyellow: "ffffe0",
        lime: "0f0",
        limegreen: "32cd32",
        linen: "faf0e6",
        magenta: "f0f",
        maroon: "800000",
        mediumaquamarine: "66cdaa",
        mediumblue: "0000cd",
        mediumorchid: "ba55d3",
        mediumpurple: "9370db",
        mediumseagreen: "3cb371",
        mediumslateblue: "7b68ee",
        mediumspringgreen: "00fa9a",
        mediumturquoise: "48d1cc",
        mediumvioletred: "c71585",
        midnightblue: "191970",
        mintcream: "f5fffa",
        mistyrose: "ffe4e1",
        moccasin: "ffe4b5",
        navajowhite: "ffdead",
        navy: "000080",
        oldlace: "fdf5e6",
        olive: "808000",
        olivedrab: "6b8e23",
        orange: "ffa500",
        orangered: "ff4500",
        orchid: "da70d6",
        palegoldenrod: "eee8aa",
        palegreen: "98fb98",
        paleturquoise: "afeeee",
        palevioletred: "db7093",
        papayawhip: "ffefd5",
        peachpuff: "ffdab9",
        peru: "cd853f",
        pink: "ffc0cb",
        plum: "dda0dd",
        powderblue: "b0e0e6",
        purple: "800080",
        rebeccapurple: "663399",
        red: "f00",
        rosybrown: "bc8f8f",
        royalblue: "4169e1",
        saddlebrown: "8b4513",
        salmon: "fa8072",
        sandybrown: "f4a460",
        seagreen: "2e8b57",
        seashell: "fff5ee",
        sienna: "a0522d",
        silver: "c0c0c0",
        skyblue: "87ceeb",
        slateblue: "6a5acd",
        slategray: "708090",
        slategrey: "708090",
        snow: "fffafa",
        springgreen: "00ff7f",
        steelblue: "4682b4",
        tan: "d2b48c",
        teal: "008080",
        thistle: "d8bfd8",
        tomato: "ff6347",
        turquoise: "40e0d0",
        violet: "ee82ee",
        wheat: "f5deb3",
        white: "fff",
        whitesmoke: "f5f5f5",
        yellow: "ff0",
        yellowgreen: "9acd32"
    };

    // Make it easy to access colors via `hexNames[hex]`
    var hexNames = tinycolor.hexNames = flip(names);


    // Utilities
    // ---------

    // `{ 'name1': 'val1' }` becomes `{ 'val1': 'name1' }`
    function flip(o) {
        var flipped = { };
        for (var i in o) {
            if (o.hasOwnProperty(i)) {
                flipped[o[i]] = i;
            }
        }
        return flipped;
    }

    // Return a valid alpha value [0,1] with all invalid values being set to 1
    function boundAlpha(a) {
        a = parseFloat(a);

        if (isNaN(a) || a < 0 || a > 1) {
            a = 1;
        }

        return a;
    }

    // Take input from [0, n] and return it as [0, 1]
    function bound01(n, max) {
        if (isOnePointZero(n)) { n = "100%"; }

        var processPercent = isPercentage(n);
        n = mathMin(max, mathMax(0, parseFloat(n)));

        // Automatically convert percentage into number
        if (processPercent) {
            n = parseInt(n * max, 10) / 100;
        }

        // Handle floating point rounding errors
        if ((math.abs(n - max) < 0.000001)) {
            return 1;
        }

        // Convert into [0, 1] range if it isn't already
        return (n % max) / parseFloat(max);
    }

    // Force a number between 0 and 1
    function clamp01(val) {
        return mathMin(1, mathMax(0, val));
    }

    // Parse a base-16 hex value into a base-10 integer
    function parseIntFromHex(val) {
        return parseInt(val, 16);
    }

    // Need to handle 1.0 as 100%, since once it is a number, there is no difference between it and 1
    // <http://stackoverflow.com/questions/7422072/javascript-how-to-detect-number-as-a-decimal-including-1-0>
    function isOnePointZero(n) {
        return typeof n == "string" && n.indexOf('.') != -1 && parseFloat(n) === 1;
    }

    // Check to see if string passed in is a percentage
    function isPercentage(n) {
        return typeof n === "string" && n.indexOf('%') != -1;
    }

    // Force a hex value to have 2 characters
    function pad2(c) {
        return c.length == 1 ? '0' + c : '' + c;
    }

    // Replace a decimal with it's percentage value
    function convertToPercentage(n) {
        if (n <= 1) {
            n = (n * 100) + "%";
        }

        return n;
    }

    // Converts a decimal to a hex value
    function convertDecimalToHex(d) {
        return Math.round(parseFloat(d) * 255).toString(16);
    }
    // Converts a hex value to a decimal
    function convertHexToDecimal(h) {
        return (parseIntFromHex(h) / 255);
    }

    var matchers = (function() {

        // <http://www.w3.org/TR/css3-values/#integers>
        var CSS_INTEGER = "[-\\+]?\\d+%?";

        // <http://www.w3.org/TR/css3-values/#number-value>
        var CSS_NUMBER = "[-\\+]?\\d*\\.\\d+%?";

        // Allow positive/negative integer/number.  Don't capture the either/or, just the entire outcome.
        var CSS_UNIT = "(?:" + CSS_NUMBER + ")|(?:" + CSS_INTEGER + ")";

        // Actual matching.
        // Parentheses and commas are optional, but not required.
        // Whitespace can take the place of commas or opening paren
        var PERMISSIVE_MATCH3 = "[\\s|\\(]+(" + CSS_UNIT + ")[,|\\s]+(" + CSS_UNIT + ")[,|\\s]+(" + CSS_UNIT + ")\\s*\\)?";
        var PERMISSIVE_MATCH4 = "[\\s|\\(]+(" + CSS_UNIT + ")[,|\\s]+(" + CSS_UNIT + ")[,|\\s]+(" + CSS_UNIT + ")[,|\\s]+(" + CSS_UNIT + ")\\s*\\)?";

        return {
            rgb: new RegExp("rgb" + PERMISSIVE_MATCH3),
            rgba: new RegExp("rgba" + PERMISSIVE_MATCH4),
            hsl: new RegExp("hsl" + PERMISSIVE_MATCH3),
            hsla: new RegExp("hsla" + PERMISSIVE_MATCH4),
            hsv: new RegExp("hsv" + PERMISSIVE_MATCH3),
            hsva: new RegExp("hsva" + PERMISSIVE_MATCH4),
            hex3: /^([0-9a-fA-F]{1})([0-9a-fA-F]{1})([0-9a-fA-F]{1})$/,
            hex6: /^([0-9a-fA-F]{2})([0-9a-fA-F]{2})([0-9a-fA-F]{2})$/,
            hex8: /^([0-9a-fA-F]{2})([0-9a-fA-F]{2})([0-9a-fA-F]{2})([0-9a-fA-F]{2})$/
        };
    })();

    // `stringInputToObject`
    // Permissive string parsing.  Take in a number of formats, and output an object
    // based on detected format.  Returns `{ r, g, b }` or `{ h, s, l }` or `{ h, s, v}`
    function stringInputToObject(color) {

        color = color.replace(trimLeft,'').replace(trimRight, '').toLowerCase();
        var named = false;
        if (names[color]) {
            color = names[color];
            named = true;
        }
        else if (color == 'transparent') {
            return { r: 0, g: 0, b: 0, a: 0, format: "name" };
        }

        // Try to match string input using regular expressions.
        // Keep most of the number bounding out of this function - don't worry about [0,1] or [0,100] or [0,360]
        // Just return an object and let the conversion functions handle that.
        // This way the result will be the same whether the tinycolor is initialized with string or object.
        var match;
        if ((match = matchers.rgb.exec(color))) {
            return { r: match[1], g: match[2], b: match[3] };
        }
        if ((match = matchers.rgba.exec(color))) {
            return { r: match[1], g: match[2], b: match[3], a: match[4] };
        }
        if ((match = matchers.hsl.exec(color))) {
            return { h: match[1], s: match[2], l: match[3] };
        }
        if ((match = matchers.hsla.exec(color))) {
            return { h: match[1], s: match[2], l: match[3], a: match[4] };
        }
        if ((match = matchers.hsv.exec(color))) {
            return { h: match[1], s: match[2], v: match[3] };
        }
        if ((match = matchers.hsva.exec(color))) {
            return { h: match[1], s: match[2], v: match[3], a: match[4] };
        }
        if ((match = matchers.hex8.exec(color))) {
            return {
                a: convertHexToDecimal(match[1]),
                r: parseIntFromHex(match[2]),
                g: parseIntFromHex(match[3]),
                b: parseIntFromHex(match[4]),
                format: named ? "name" : "hex8"
            };
        }
        if ((match = matchers.hex6.exec(color))) {
            return {
                r: parseIntFromHex(match[1]),
                g: parseIntFromHex(match[2]),
                b: parseIntFromHex(match[3]),
                format: named ? "name" : "hex"
            };
        }
        if ((match = matchers.hex3.exec(color))) {
            return {
                r: parseIntFromHex(match[1] + '' + match[1]),
                g: parseIntFromHex(match[2] + '' + match[2]),
                b: parseIntFromHex(match[3] + '' + match[3]),
                format: named ? "name" : "hex"
            };
        }

        return false;
    }

    window.tinycolor = tinycolor;
    })();

    $(function () {
        if ($.fn.spectrum.load) {
            $.fn.spectrum.processNativeColorInputs();
        }
    });

});

/**
 * @author Suman Thaapa -- Lead 
 * @author Prabhat gurung 
 * @author Basanta Tajpuriya 
 * @author Rakesh Shrestha 
 * @author Manish Buddhacharya 
 * @author Lekh Raj Rai 
 * @author Ascol Parajuli
 * @email NEPALNME@GMAIL.COM
 * @create date 2019-03-12 16:51:56
 * @modify date 2019-03-12 16:51:56
 * @desc [description]
 */

$(document).off('click','.toggleSSN').on('click','.toggleSSN', function(e) {
    e.preventDefault();
    var targetInput = $(this).attr('data-target-input');
    if(targetInput) {
        var input = $('#'+targetInput);
        if(input.attr('type') == "password") {
            input.attr('type','text');
        } else if(input.attr('type') == "text") {
            input.attr('type','password');
        }
    }
});
toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": true,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
};

/**
 * DEVELOPERS
 * ----------------------------------------------
 * SUMAN  THAPA - LEAD  (NEPALNME@GMAIL.COM)
 * ----------------------------------------------
 * - RUNA SIDDHI BAJRACHARYA
 * - RABIN BHANDARI
 * - SHIVA THAPA
 * - PRABHAT GURUNG
 * - KIRAN CHAULAGAIN
 * -----------------------------------------------
 * Created On: 3/16/2018
 *
 * THIS INTELLECTUAL PROPERTY IS COPYRIGHT Ⓒ 2018
 * ZEUSLOGIC, INC. ALL RIGHT RESERVED
*/


var modalConfig = {
		container: '#modalContainer',
		subContainer: '*[rel=subModalContainer]',
		header: 'modal-header',
		body: 'modal-body',
		footer: 'modal-footer',
		loader: '.modal-btn-loader'
	}

var title 			= null,
	self 			= null,
	prevIcon 		= null,
	callbyEvent 	= false,
	modalId 		= 0;

/**
 * Parent Modal
 * @return void
 */

$(document).off('click', '*[data-modal-route]').on('click', '*[data-modal-route]', function(e){

	e.preventDefault();
	e.stopPropagation();
		self 			= $(this);
	var type 			= self.attr('data-modal-type') ? self.attr('data-modal-type') : 'default',
		modal_url		= self.attr('data-modal-route'),
		callback 		= self.attr('data-modal-callback') || false,
		icon 			= self.find('*[class^="la"], *[class^="fa"], *[class^="flaticon-"], *[class^="socicon-"]').length ?
							self.find('*[class^="la"], *[class^="fa"], *[class^="flaticon-"], *[class^="socicon-"]').eq(0) :
								self.closest('.dropdown-menu').prev('.dropdown-toggle').find('*[class^="la"], *[class^="fa"], *[class^="flaticon-"], *[class^="socicon-"]').eq(0);

		// Dynamic Modal Id
		callbyEvent = true;
		++modalId;

		document.param = null;

		if(self.attr('data-param')) {
			document.param = self.attr('data-param');
		}

		// get prev icon
		prevIcon 		= icon.length ? icon[0].outerHTML : null;
		// update title
		title 			= self.attr('data-modal-title') ? self.attr('data-modal-title') : 'Delete';

		// update icon with loader
		$(modalConfig.loader).remove();
		if(self)
			self.attr("disabled","disabled");
		icon.after('<div class="m-loader modal-btn-loader"></div>').end().remove();


		showModal(modal_url, {
			type : type,
			callback: callback
		});
});



/**
 * Child Modal
 * @return void
 */

$(document).off('click', '*[data-sub-modal-route]').on('click', '*[data-sub-modal-route]', function(e){

	e.preventDefault();
		self 			= $(this);
		var modal_url	= self.attr('data-sub-modal-route'),
		 	type 		= self.attr('data-modal-type') ? self.attr('data-modal-type') : 'default',
			parent 		= self.closest('.modal.show').attr('data-modal-id'),
			callback 	= self.attr('data-modal-callback') ? self.attr('data-modal-callback') : false,
			icon 		= self.find('*[class^="la"], *[class^="fa"], *[class^="flaticon-"], *[class^="socicon-"]').length ?
							self.find('*[class^="la"], *[class^="fa"], *[class^="flaticon-"], *[class^="socicon-"]').eq(0) :
								self.closest('.dropdown-menu').prev('.dropdown-toggle').find('*[class^="la"], *[class^="fa"], *[class^="flaticon-"], *[class^="socicon-"]').eq(0);

		// get prev icon
		prevIcon 		= icon.length ? icon[0].outerHTML : null;
		// update title
		title 			= self.attr('data-modal-title') ? self.attr('data-modal-title') : 'Delete';

		// update icon with loader
		$(modalConfig.loader).remove();
		if(self)
			self.attr("disabled","disabled");
		icon.after('<div class="m-loader modal-btn-loader"></div>').end().remove();

		callbyEvent = true;
		++modalId;

		showModal(modal_url, {
			type : type,
			relation: "child",
			parentId: parent,
			callback: callback
		});
		$('.modal.show[data-modal-id='+parent+']').modal('hide');

});


function showModal(modal_url, options = null){
	if(modal_url.length) {

		/**
		 * Add Loader Before Modal Call
		 */
		addFormLoader();

		ajaxRequest({
			url : modal_url.trim()
		}, function(response) {

			/**
			 * Remove Loader After Modal Call
			 */
			removeFormLoader();

			if(prevIcon){
				$(modalConfig.loader).after(prevIcon).end();
			}

			$(modalConfig.loader).remove();

			if(!response) {
				toastr.error('Response Error');
			}
			if(response.response && (response.response.status >= 500 || response.response.status == 404)) {
				if(response.response.data && response.response.data[0] && response.response.data[0].data)
                {
                }
                else
				    toastr.error(response.response.statusText);
			} else{
				setModalDom(response, options);
			}
			if(self)
				self.removeAttr("disabled");
		});
	}

}

function setModalDom(response, options = null) {
	var relation = (options && options.hasOwnProperty('relation') )? options.relation : "parent";
	var modalRef = modalConfig.container,
		callback = (options && options.hasOwnProperty('callback') )? options.callback : false;

	if(relation == "child") {

		var childModal = '<div class="modal fade std-modal" rel="subModalContainer" data-parent-modal-id="'+options.parentId+'" data-modal-callback="'+callback+'" data-modal-id="'+modalId+'" tabindex="-1" role="dialog"\
							 aria-labelledby="modalContainerHeader" aria-hidden="true" data-backdrop="static" data-keyboard="false">\
						</div>';

		$('body').append(childModal);
		modalRef = 'body .modal[data-modal-id='+modalId+']';
	}

	if(!callbyEvent) {
		++modalId;
	}

 	if(options && options.hasOwnProperty('type') && options.type == 'delete') {
		$(modalRef)
			.removeClass('modal-default').addClass('modal-danger')
			.html("").html(response.data)
			.find('.modal-title').html(title)
			.end().modal('show');

	} else {
		$(modalRef).removeClass('modal-danger').addClass('modal-default').html("").html(response.data).modal('show');
	}

	$(modalRef).attr('data-modal-id', modalId);
	$(modalRef).attr('data-modal-callback', callback);
	onModalInit();
	callbyEvent = false;
}


/**
 * Remove Nested Modal
 */
$(document).off('click', '[data-dismiss=modal]').on('click', '[data-dismiss=modal]', function(e){
	var self 			= $(this),
		parentModalId 	= self.closest('.modal').attr('data-parent-modal-id'),
		callback 		= self.closest('.modal').attr('data-modal-callback') || false;
		if(parentModalId) {
			var parent 			= 'body .modal[data-modal-id='+parentModalId+']';
			$('body .modal-backdrop').remove();
			$(parent).modal('show');
			self.closest('.modal').modal('hide').remove();
		}
		// alert(callback);
		if(callback && window[callback]) {
			window[callback]();
		}
});

/**
 * Show CLient Modal
 */
$(document).off('click', '.openModal').on('click', '.openModal', function(e){
	e.preventDefault();
    var self = $(this),
        modal = self.attr('data-modal-id');
        $("#"+modal).modal('show');
        $("#"+modal).attr('data-modal-id', modal);
        $("#"+modal).on('shown.bs.modal', function (e) {
		    if(self.attr('data-callback')) {
	        	window[self.attr('data-callback')]();
	        }

	        switch (modal) {
				case "volunteerCreateModal":
					$('#'+modal).find('.dynamicPetAppendSection').attr('id','newPet_Template_Append_Citizan');
					break;
				case "applicationNpCreateModal":
					$('#'+modal).find('.dynamicPetAppendSection').attr('id','newPet_Template_Append_Np');

					/* Change Np Pet Accordion Options */
					$('#'+modal).find('.parentAccordion').attr('id','m_pet_accordion_np');
					$('#'+modal).find('.m-accordion__item-body').attr('data-parent','m_pet_accordion_np');

					$('#'+modal).find('.m-accordion__item-head').attr('id','m_pet_accordion_np_header');
					$('#'+modal).find('.m-accordion__item-body').attr('aria-labelledby','m_pet_accordion_np_header');

					$('#'+modal).find('.m-accordion__item-head').attr('href','#m_pet_accordion_np_body');
					$('#'+modal).find('.m-accordion__item-body').attr('id','m_pet_accordion_np_body');

					break;
				default:
					// statements_def
					break;
			}

		});
});


function onModalInit() {
	$("input[name=phone], input[name='cell_phone[]']").inputmask("mask", {
	    "mask": "(999) 999-9999"
	});
}

// $.fn.modal.Constructor.prototype._enforceFocus = function() {};
