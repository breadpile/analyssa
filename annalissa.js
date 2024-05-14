(function() {
    'use strict';

    let allData = {
        browserInfo: {
            userAgent: navigator.userAgent,
            language: navigator.language,
            platform: navigator.platform,
            onlineStatus: navigator.onLine,
            doNotTrack: navigator.doNotTrack
        },
        screenInfo: {
            width: screen.width,
            height: screen.height,
            colorDepth: screen.colorDepth,
            devicePixelRatio: window.devicePixelRatio
        },
        locationInfo: window.location.href,
        referrer: document.referrer,
        performanceData: {
            navigationStart: performance.timing.navigationStart,
            domComplete: performance.timing.domComplete
        },
        deviceOrientation: window.orientation,
        visibilityState: document.visibilityState,
        cookies: document.cookie,
        storage: {
            localStorageItems: Object.keys(localStorage).reduce((acc, key) => {
                acc[key] = localStorage.getItem(key);
                return acc;
            }, {}),
            sessionStorageItems: Object.keys(sessionStorage).reduce((acc, key) => {
                acc[key] = sessionStorage.getItem(key);
                return acc;
            }, {})
        }
    };

    function collectGeolocation() {
        if ('geolocation' in navigator) {
            navigator.geolocation.getCurrentPosition(function(position) {
                allData.geolocation = {
                    latitude: position.coords.latitude,
                    longitude: position.coords.longitude
                };
                logData(); // Log data after geolocation is fetched
            }, function(error) {
                console.error('Geolocation Error:', error.message);
                logData(); // Log data even if geolocation fails
            });
        } else {
            console.log('Geolocation is not supported by this browser.');
            logData();
        }
    }

    function logData() {
        console.log('All Collected Data:', JSON.stringify(allData, null, 2));
    }

    // Collect and log all available data
    collectGeolocation();

    // Event listeners for user interactions
    document.addEventListener('click', function(event) {
        allData.lastClick = {
            eventType: 'click',
            elementTag: event.target.tagName,
            elementClasses: event.target.className
        };
        logData(); // Update log on user interaction
    });

    document.addEventListener('visibilitychange', function() {
        allData.currentVisibility = document.visibilityState;
        logData(); // Update log on visibility change
    });
})();
