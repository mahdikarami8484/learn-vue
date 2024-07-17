import SignInView from '../views/SignInView.vue'

const signInRoute = {
    path: '/SignIn',
    name: 'SignIn',
    component: SignInView,
    alias: ['/signin', '/signIn'],
    meta: { loginRedirect: true }
}

export default signInRoute