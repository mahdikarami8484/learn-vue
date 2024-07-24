import HomeView from "@/views/HomeView.vue"
import panelRoute from "./panelRoute"

const adminRoutes = {
    name: 'Admin',
    path: '/admin',
    children: [
        panelRoute
    ],
    meta: { loginRequired: true }
}

export default adminRoutes