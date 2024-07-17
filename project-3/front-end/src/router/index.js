import { createRouter, createWebHistory } from "vue-router";
import homeRoute from "./homeRoute";
import notFoundRoute from "./notFoundRoute";
import signInRoute from "./signInRoute";
import adminRoutes from "./adminRoutes";
import store from "@/store";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    homeRoute,
    notFoundRoute,
    adminRoutes,
    signInRoute,
    {
      path: "/:pathMatch(.*)*",
      redirect: "/404",
    },
  ],
});

router.beforeEach((to, from) => {
  if (to.meta.loginRequired && !store.state.isAuthenticated) {
    return {
      path: "/SignIn",
      query: { redirect: to.fullPath },
    };
  }
  if (to.meta.loginRedirect && store.state.isAuthenticated) {
    return {
      path: "/admin",
      query: { redirect: to.fullPath },
    };
  }
  return;
});

export default router;
