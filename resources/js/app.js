import './bootstrap';
//import { createApp } from 'vue/dist/vue.esm-bundler';
import { createApp } from 'vue';
import App from './components/App.vue';

//const app = createApp({
//    components: {
//        'import-users' : App,
//}
//});

//app.mount('#app');

createApp(App).mount("#app")