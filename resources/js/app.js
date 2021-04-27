require('./bootstrap');

// added for chat using plain javascript
// const messages_el = document.getElementById("messages");
// const username_input = document.getElementById("username");
// const message_input = document.getElementById("message_input");
// const message_form = document.getElementById("message_form");

// message_form.addEventListener('submit', function(e){
// 	e.preventDefault();
// 	let has_errors = false;

// 	if(username_input.value == ''){
// 		alert('please enter username');
// 		has_errors = true;
// 	}
// 	if(message_input.value == ''){
// 		alert('please enter message');
// 		has_errors = true;
// 	}
// 	if(has_errors){
// 		return;
// 	}

// 	const options = {
// 		method: 'post',
// 		url: '/send-message',
// 		data: {
// 			username: username_input.value,
// 			message: message_input.value,
// 		}
// 	};

// 	axios(options)
// });

// window.Echo.channel('chat')
// .listen('.message', (e) => {
// 	messages_el.innerHTML += '<div class="message"><strong>'+ e.username +':</strong>'+e.message+'</div>';
// 	message_input.value = '';
// });
// end of javascript chat app

// Import modules...
import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

const el = document.getElementById('app');

createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
})
    .mixin({ methods: { route } })
    .use(InertiaPlugin)
    .mount(el);

InertiaProgress.init({ color: '#4B5563' });
