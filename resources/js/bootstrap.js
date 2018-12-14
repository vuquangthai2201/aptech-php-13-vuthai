
window._ = require('lodash');
window.Popper = require('popper.js').default;

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo'

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '2dafc8100a8830ddece1',
    cluster: 'ap1',
    encrypted: true
});

/* Pusher Notification */
$( document ).ready(function() {
    var pusher = new Pusher('2dafc8100a8830ddece1', {
        cluster: 'ap1',
        forceTLS: true
    });
    var channel = pusher.subscribe('notify-confirmed');
    channel.bind('notify-user', function(data) {
        if (data['count'] > 0) {
            $('.countUser-' + data['id']).html('(' + data['count'] + ')');
        } else {
            $('.countUser-' + data['id']).html('');
        }
    });

    var channel2 = pusher.subscribe('notify-unconfirm');
    channel2.bind('notify-admin', function(data) {
        var count = 0;
        var datahtml = '';
        data.forEach(function(element) {
            var img = Math.floor(Math.random() * 10 *element['id']);
            datahtml += '<a href="http://localhost/ecommerce_03/public/admin/order/confirm/'+ element['id']
                +'" target="_blank"><img src="https://api.adorable.io/avatars/10/'
                + img + '.png" /> Order Number: ' + element['id'] + ' Unconfirm</a>';
            count += 1;
        });
        $('#number').html(count);
        $('.message-footer').html(datahtml);
    });
});
