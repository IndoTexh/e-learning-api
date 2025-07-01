/* import './bootstrap'; */
import { createApp, h } from 'vue'
import { createInertiaApp, Head, Link } from '@inertiajs/vue3'
import Layout from './Layouts/Layout.vue'
import { ZiggyVue } from '../../vendor/tightenco/ziggy'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

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