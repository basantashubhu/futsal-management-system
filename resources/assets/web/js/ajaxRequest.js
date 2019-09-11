

var source = null;

function ajaxRequest(options, cb) {
    // console.log(options);
    if (options.hasOwnProperty('cancelPrevious') && options.cancelPrevious && source) {
        source.cancel('Operation canceled by the user.');
    }

    if (!options.hasOwnProperty('url'))
        return;

    var requestUrl = options.url,
        requestData = options.hasOwnProperty('data') ? options.data : '';
    let requestMethod = options.hasOwnProperty('method') ? options.method : 'get',
        form = options.hasOwnProperty('form') ?
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
        if (!called) {
            if (beforeSend) {
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
    axios({

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
                        console.log('You have been logged out.');
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
    if (thrown && thrown.response && thrown.response.status == 500 &&
        thrown.response.data && thrown.response.data[0] &&
        thrown.response.data[0].type == "error") {
        toastr.error(thrown.response.data[0].data);
    }
}