import Vue from 'vue'
import Router from 'vue-router'
import UserHome from './components/UserHome.vue'
import AdminHome from './components/AdminHome.vue'
import Hotel from './components/hotels/Home.vue'
import Setup from './components/hotels/Setup.vue'


Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '',
      component: UserHome,
    },
    {
      path: '/home',
      component: AdminHome,
      children: [
        {
          path: '',
          component: Hotel,
          children: [
            {
              path: '',
              component: Setup,
            },
          ]
        },
        
      ]
    },
    {
      path: '/:catchAll(.*)',
      component: () => import('./components/NotFound.vue'),
    },
    // 
  ]
})