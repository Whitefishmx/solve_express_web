var CACHE_NAME = 'v1';
var urlsToCache = [
	'https://code.jquery.com/jquery-3.6.0.min.js',
	'https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js',
	'https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css'
];
self.addEventListener('install', function(event) {
	event.waitUntil(
		caches.open(CACHE_NAME)
			.then(function(cache) {
				console.log('Opened cache');
				return cache.addAll(urlsToCache);
			})
	);
});
self.addEventListener('fetch', function(event) {
	event.respondWith(
		caches.match(event.request)
			.then(function(response) {
				// Cache hit - return the response from the cache
				if (response) {
					return response;
				}
				return fetch(event.request);
			})
	);
});
