/* import './bootstrap'; */
import { createApp, h } from 'vue'
import { createInertiaApp, Head, Link } from '@inertiajs/vue3'
import Layout from './Layouts/Layout.vue'
import { ZiggyVue } from '../../vendor/tightenco/ziggy'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import Echo from 'laravel-echo'
import Pusher from 'pusher-js'
import PrimeVue from 'primevue/config';
import Aura from '@primeuix/themes/aura';
import { ProgressSpinner } from 'primevue'
/* window.Pusher = Pusher;
window.Echo = new Echo({
  broadcaster: 'pusher',
  key: import.meta.env.VITE_PUSHER_APP_KEY,
  cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
  wsHost: window.location.hostname,
  wsPort: 6001,
  forceTLS: false,
  disableStats: true,
});
 */
createInertiaApp({
  title: (title) => `Beltei E-Learning${title}`,
  resolve: name => {
    const pages = import.meta.glob([
      './Pages/**/*.vue',
      './Pages/**/Assets/**'
    ], { eager: true })
    let page = pages[`./Pages/${name}.vue`]
    page.default.layout = page.default.layout || Layout;
    return page;
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue)
      .use(PrimeVue, {
        theme: {
          preset: Aura
        }
      })
      .component('ProgressSpinner', ProgressSpinner)
      .component('Head', Head)
      .component('Link', Link)
      .mount(el)
  },
  progress: {
    delay: 250,
    color: '#fff',
    includeCSS: true,
    showSpinner: false,
  }
})