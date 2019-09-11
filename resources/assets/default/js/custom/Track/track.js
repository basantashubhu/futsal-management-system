

var clientInfo = {};
var latLong = {};

function collectInfo() {
    document.clientInfo = "";
    var client = new ClientJS();
    clientInfo["fingerprint"] = client.getFingerprint();
    clientInfo["browser"] = client.getBrowser();
    clientInfo["os"] = client.getOS() + ", " + client.getOSVersion();
    clientInfo["location"] = JSON.stringify(latLong);
    clientInfo["cpu"] = client.getCPU();
    clientInfo['device'] = getDevice();

}

function getDevice() {
    var device;
    var client = new ClientJS();
    if (client.isIpad()) {
        device = 'Ipad';
    }
    else if (client.isIphone()) {
        device = 'Iphone';
    }
    else if (client.isIpod()) {
        device = "Ipod";
    }
    else if (client.isMobileAndroid()) {
        device = "Android";
    }
    else if (client.isMobileWindows()) {
        device = "WindowsPhone";
    }
    else {
        device = 'Computer';
    }
    return device;
}

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            latLong = {
                "latitude": position.coords.latitude,
                "longitude": position.coords.longitude,
            }
            collectInfo();
        }, showError);
        return;
    } else {
        console.warn("Geolocation is not supported by this browser.");
    }
}

function showError(error) {
    collectInfo();
    switch (error.code) {
        case error.PERMISSION_DENIED:
            console.warn("User denied the request for Geolocation.");
            break;
        case error.POSITION_UNAVAILABLE:
            console.warn("Location information is unavailable.");
            break;
        case error.TIMEOUT:
            console.warn("The request to get user location timed out.");
            break;
        case error.UNKNOWN_ERROR:
            console.warn("An unknown error occurred.");
            break;
    }
}

function getInfo() {
    getLocation();
    var datas = {
        url: '/userlog/ping',
        data: clientInfo,
        method: 'POST'
    };
    // console.log(datas);
    setInterval(function () {
        ajaxRequest(datas, function (response) {
            console.log(response);
        });
    }, 2000);
}

getLocation();