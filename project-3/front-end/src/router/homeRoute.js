import HomeView from '../views/HomeView.vue'

const homeRoute = {
    path: '/',
    name: 'Home',
    component: HomeView,
    alias: ['/home', '/Home']
}

export default homeRoute