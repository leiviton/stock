/**
 * Copyright 2016 Google Inc. All rights reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
*/

// DO NOT EDIT THIS GENERATED OUTPUT DIRECTLY!
// This file should be overwritten as part of your build process.
// If you need to extend the behavior of the generated service worker, the best approach is to write
// additional code and include it using the importScripts option:
//   https://github.com/GoogleChrome/sw-precache#importscripts-arraystring
//
// Alternatively, it's possible to make changes to the underlying template file and then use that as the
// new base for generating output, via the templateFilePath option:
//   https://github.com/GoogleChrome/sw-precache#templatefilepath-string
//
// If you go that route, make sure that whenever you update your sw-precache dependency, you reconcile any
// changes made to this original template file with your modified copy.

// This generated service worker JavaScript will precache your site's resources.
// The code needs to be saved in a .js file at the top-level of your site, and registered
// from your pages in order to be used. See
// https://github.com/googlechrome/sw-precache/blob/master/demo/app/js/service-worker-registration.js
// for an example of how you can register this script and handle various service worker events.

/* eslint-env worker, serviceworker */
/* eslint-disable indent, no-unused-vars, no-multiple-empty-lines, max-nested-callbacks, space-before-function-paren, quotes, comma-spacing */
'use strict';

var precacheConfig = [["3rdpartylicenses.txt","00214ff9bd3ec02f3512676b42e42518"],["4.3d3e3922e5e8186bc21e.js","15903cc935fcfe515361d08dfd8d3dfe"],["assets/demo/demo.css","e2ab559b268a6876b03bd86553755323"],["assets/fonts/nucleo-outline.eot","53a1bed7a3ec86d010fe100873828a89"],["assets/fonts/nucleo-outline.ttf","22a0bffe789c286a9d78eb52670996a7"],["assets/fonts/nucleo-outline.woff","24e2d6b43b1b0f84fdfaa06a4032f154"],["assets/fonts/nucleo-outline.woff2","8ebec31f5ce59f908db84d86aed5947f"],["assets/img/angular2-logo-red.png","9db278d630f5fabd8e7ba16c2e329a3a"],["assets/img/angular2-logo-white.png","33633b4148ad1f4fd222b2f2312d5893"],["assets/img/apple-icon.png","82afbfaa2a64cebfd0077f73abe15659"],["assets/img/banco_ideias.jpg","a9e2a8f048f3419c47d5230d1ec3c508"],["assets/img/banco_ideias.png","446f24435f000b2792fa8e1fb28e24e7"],["assets/img/bg5.jpg","056eb0586182a8d28273ad11c028e912"],["assets/img/favicon.png","996d8248f580f8e26e6c45c67da9b5a6"],["assets/img/header.jpg","44274a4597a19a5a5ec4c32258e04f25"],["assets/img/mike.jpg","aab414f7b69d0d4ad897e75e735f240a"],["assets/img/noticias.jpg","768a654847e545e912f27bb307aea65b"],["assets/img/noticias.png","9a2ea4e2358e5ad7975c53f8b03f965d"],["assets/img/now-logo.png","06e0fc6563685a66896afba4a3b71b2a"],["assets/scss/now-ui-dashboard.scss","fc61968505f11da9d8b66f27f6c7d04d"],["assets/scss/now-ui-dashboard/_alerts.scss","4c1ab249d85f5ef4dd76595d20286f59"],["assets/scss/now-ui-dashboard/_buttons.scss","ac4afc91bd02c223541ff41cbd13ad8c"],["assets/scss/now-ui-dashboard/_cards.scss","a2c76da619ca7583ccb179a5e433178d"],["assets/scss/now-ui-dashboard/_checkboxes-radio.scss","f5d52d15034a3375c1bb77db245150b7"],["assets/scss/now-ui-dashboard/_dropdown.scss","195d2c9525b51b256f532f7d784185a6"],["assets/scss/now-ui-dashboard/_fixed-plugin.scss","a86ccaaa1f4c4eb50051a4a17e47d1db"],["assets/scss/now-ui-dashboard/_footers.scss","ebead1d341281854b6ff0eaa79a63653"],["assets/scss/now-ui-dashboard/_images.scss","2b445b2c57e17f57b196c3f4541b2c6c"],["assets/scss/now-ui-dashboard/_inputs.scss","22257fa9b2c86e3c1e2145fc47449cce"],["assets/scss/now-ui-dashboard/_misc.scss","003c65fa63a2fe06b63a719666a56baf"],["assets/scss/now-ui-dashboard/_mixins.scss","a9c65d5fc666bd079cfe780dba67ed35"],["assets/scss/now-ui-dashboard/_navbar.scss","e95ba0f37c6b60076d7fb686cfe972e5"],["assets/scss/now-ui-dashboard/_nucleo-outline.scss","e738130414acaf6f30c32ec0dc9e27e9"],["assets/scss/now-ui-dashboard/_page-header.scss","e233de0241615326d8b03dd2a889e419"],["assets/scss/now-ui-dashboard/_responsive.scss","9028223dba723bcdb0d99a727631e5f0"],["assets/scss/now-ui-dashboard/_sidebar-and-main-panel.scss","207d131014b637a9340dfe320ff4f63c"],["assets/scss/now-ui-dashboard/_tables.scss","b6b7b2da0ab3e5c95ebaca2b73832e23"],["assets/scss/now-ui-dashboard/_typography.scss","ce65cc61319443fe690a532e6fccfed0"],["assets/scss/now-ui-dashboard/_variables.scss","38911614ddf8fbd6ecee12f70c42af5c"],["assets/scss/now-ui-dashboard/cards/_card-chart.scss","74f65c0c98ef681334ce46284e6fca58"],["assets/scss/now-ui-dashboard/cards/_card-map.scss","f5163082ba0133d1e5de6385cd302156"],["assets/scss/now-ui-dashboard/cards/_card-plain.scss","20c8fe657f93e852112ae48377cfb0fb"],["assets/scss/now-ui-dashboard/cards/_card-user.scss","579d06ae6047f05c63452fa2c3b65266"],["assets/scss/now-ui-dashboard/mixins/_buttons.scss","97317a610ed2e22e06fac60fd5727cfa"],["assets/scss/now-ui-dashboard/mixins/_cards.scss","63fe75737a2ad9f053500ea42aff3029"],["assets/scss/now-ui-dashboard/mixins/_dropdown.scss","df64db7f944eff6ce8ca6fc9b622eb9a"],["assets/scss/now-ui-dashboard/mixins/_inputs.scss","b899380abe765230fc6521783adea8dd"],["assets/scss/now-ui-dashboard/mixins/_page-header.scss","650f14b49f1a2ac461197e4be3849477"],["assets/scss/now-ui-dashboard/mixins/_transparency.scss","f71273a12f13be603032bf9aa4aa9c1a"],["assets/scss/now-ui-dashboard/mixins/_vendor-prefixes.scss","e7a3e4da0a840e336a2eb6f8046fb155"],["assets/scss/now-ui-dashboard/plugins/_plugin-animate-bootstrap-notify.scss","b6d8361890634e7f9aef41325c6d6689"],["assets/scss/now-ui-dashboard/plugins/_plugin-perfect-scrollbar.scss","43ac8d38d75f769f16f1d1002ba8e58a"],["banco_ideias.446f24435f000b2792fa.png","446f24435f000b2792fa8e1fb28e24e7"],["favicon.ico","b9aa7c338693424aae99599bec875b5f"],["index.html","2e03fba26c3e752464c4d501af4321b4"],["main.9a8362625b88a4c86a65.js","4e8191810af550bd022c638baf2a2ed6"],["noticias.768a654847e545e912f2.jpg","768a654847e545e912f27bb307aea65b"],["nucleo-outline.22a0bffe789c286a9d78.ttf","22a0bffe789c286a9d78eb52670996a7"],["nucleo-outline.24e2d6b43b1b0f84fdfa.woff","24e2d6b43b1b0f84fdfaa06a4032f154"],["nucleo-outline.53a1bed7a3ec86d010fe.eot","53a1bed7a3ec86d010fe100873828a89"],["nucleo-outline.8ebec31f5ce59f908db8.woff2","8ebec31f5ce59f908db84d86aed5947f"],["polyfills.f8f8239de0fe580b5c3d.js","bce855815c428006a341499f9deba401"],["runtime.15157f60d91a8bf150d0.js","0f4cae37b46933694af7b9cf8b189d01"],["scripts.2cc9101aa9ed72da1ec4.js","417d975e512dbda20766d644fac4f184"],["styles.c2410dc2aaf98c7d1e95.css","55ea5f9d25fb23c14c2a01d0f0b52ab9"]];
var cacheName = 'sw-precache-v3-sw-precache-' + (self.registration ? self.registration.scope : '');


var ignoreUrlParametersMatching = [/^utm_/];



var addDirectoryIndex = function(originalUrl, index) {
    var url = new URL(originalUrl);
    if (url.pathname.slice(-1) === '/') {
      url.pathname += index;
    }
    return url.toString();
  };

var cleanResponse = function(originalResponse) {
    // If this is not a redirected response, then we don't have to do anything.
    if (!originalResponse.redirected) {
      return Promise.resolve(originalResponse);
    }

    // Firefox 50 and below doesn't support the Response.body stream, so we may
    // need to read the entire body to memory as a Blob.
    var bodyPromise = 'body' in originalResponse ?
      Promise.resolve(originalResponse.body) :
      originalResponse.blob();

    return bodyPromise.then(function(body) {
      // new Response() is happy when passed either a stream or a Blob.
      return new Response(body, {
        headers: originalResponse.headers,
        status: originalResponse.status,
        statusText: originalResponse.statusText
      });
    });
  };

var createCacheKey = function(originalUrl, paramName, paramValue,
                           dontCacheBustUrlsMatching) {
    // Create a new URL object to avoid modifying originalUrl.
    var url = new URL(originalUrl);

    // If dontCacheBustUrlsMatching is not set, or if we don't have a match,
    // then add in the extra cache-busting URL parameter.
    if (!dontCacheBustUrlsMatching ||
        !(url.pathname.match(dontCacheBustUrlsMatching))) {
      url.search += (url.search ? '&' : '') +
        encodeURIComponent(paramName) + '=' + encodeURIComponent(paramValue);
    }

    return url.toString();
  };

var isPathWhitelisted = function(whitelist, absoluteUrlString) {
    // If the whitelist is empty, then consider all URLs to be whitelisted.
    if (whitelist.length === 0) {
      return true;
    }

    // Otherwise compare each path regex to the path of the URL passed in.
    var path = (new URL(absoluteUrlString)).pathname;
    return whitelist.some(function(whitelistedPathRegex) {
      return path.match(whitelistedPathRegex);
    });
  };

var stripIgnoredUrlParameters = function(originalUrl,
    ignoreUrlParametersMatching) {
    var url = new URL(originalUrl);
    // Remove the hash; see https://github.com/GoogleChrome/sw-precache/issues/290
    url.hash = '';

    url.search = url.search.slice(1) // Exclude initial '?'
      .split('&') // Split into an array of 'key=value' strings
      .map(function(kv) {
        return kv.split('='); // Split each 'key=value' string into a [key, value] array
      })
      .filter(function(kv) {
        return ignoreUrlParametersMatching.every(function(ignoredRegex) {
          return !ignoredRegex.test(kv[0]); // Return true iff the key doesn't match any of the regexes.
        });
      })
      .map(function(kv) {
        return kv.join('='); // Join each [key, value] array into a 'key=value' string
      })
      .join('&'); // Join the array of 'key=value' strings into a string with '&' in between each

    return url.toString();
  };


var hashParamName = '_sw-precache';
var urlsToCacheKeys = new Map(
  precacheConfig.map(function(item) {
    var relativeUrl = item[0];
    var hash = item[1];
    var absoluteUrl = new URL(relativeUrl, self.location);
    var cacheKey = createCacheKey(absoluteUrl, hashParamName, hash, false);
    return [absoluteUrl.toString(), cacheKey];
  })
);

function setOfCachedUrls(cache) {
  return cache.keys().then(function(requests) {
    return requests.map(function(request) {
      return request.url;
    });
  }).then(function(urls) {
    return new Set(urls);
  });
}

self.addEventListener('install', function(event) {
  event.waitUntil(
    caches.open(cacheName).then(function(cache) {
      return setOfCachedUrls(cache).then(function(cachedUrls) {
        return Promise.all(
          Array.from(urlsToCacheKeys.values()).map(function(cacheKey) {
            // If we don't have a key matching url in the cache already, add it.
            if (!cachedUrls.has(cacheKey)) {
              var request = new Request(cacheKey, {credentials: 'same-origin'});
              return fetch(request).then(function(response) {
                // Bail out of installation unless we get back a 200 OK for
                // every request.
                if (!response.ok) {
                  throw new Error('Request for ' + cacheKey + ' returned a ' +
                    'response with status ' + response.status);
                }

                return cleanResponse(response).then(function(responseToCache) {
                  return cache.put(cacheKey, responseToCache);
                });
              });
            }
          })
        );
      });
    }).then(function() {
      
      // Force the SW to transition from installing -> active state
      return self.skipWaiting();
      
    })
  );
});

self.addEventListener('activate', function(event) {
  var setOfExpectedUrls = new Set(urlsToCacheKeys.values());

  event.waitUntil(
    caches.open(cacheName).then(function(cache) {
      return cache.keys().then(function(existingRequests) {
        return Promise.all(
          existingRequests.map(function(existingRequest) {
            if (!setOfExpectedUrls.has(existingRequest.url)) {
              return cache.delete(existingRequest);
            }
          })
        );
      });
    }).then(function() {
      
      return self.clients.claim();
      
    })
  );
});


self.addEventListener('fetch', function(event) {
  if (event.request.method === 'GET') {
    // Should we call event.respondWith() inside this fetch event handler?
    // This needs to be determined synchronously, which will give other fetch
    // handlers a chance to handle the request if need be.
    var shouldRespond;

    // First, remove all the ignored parameters and hash fragment, and see if we
    // have that URL in our cache. If so, great! shouldRespond will be true.
    var url = stripIgnoredUrlParameters(event.request.url, ignoreUrlParametersMatching);
    shouldRespond = urlsToCacheKeys.has(url);

    // If shouldRespond is false, check again, this time with 'index.html'
    // (or whatever the directoryIndex option is set to) at the end.
    var directoryIndex = 'index.html';
    if (!shouldRespond && directoryIndex) {
      url = addDirectoryIndex(url, directoryIndex);
      shouldRespond = urlsToCacheKeys.has(url);
    }

    // If shouldRespond is still false, check to see if this is a navigation
    // request, and if so, whether the URL matches navigateFallbackWhitelist.
    var navigateFallback = '';
    if (!shouldRespond &&
        navigateFallback &&
        (event.request.mode === 'navigate') &&
        isPathWhitelisted([], event.request.url)) {
      url = new URL(navigateFallback, self.location).toString();
      shouldRespond = urlsToCacheKeys.has(url);
    }

    // If shouldRespond was set to true at any point, then call
    // event.respondWith(), using the appropriate cache key.
    if (shouldRespond) {
      event.respondWith(
        caches.open(cacheName).then(function(cache) {
          return cache.match(urlsToCacheKeys.get(url)).then(function(response) {
            if (response) {
              return response;
            }
            throw Error('The cached response that was expected is missing.');
          });
        }).catch(function(e) {
          // Fall back to just fetch()ing the request if some unexpected error
          // prevented the cached response from being valid.
          console.warn('Couldn\'t serve response for "%s" from cache: %O', event.request.url, e);
          return fetch(event.request);
        })
      );
    }
  }
});







