import { createRouter, createWebHistory } from "vue-router";

const router = [
  { path: "/", name: "dashboard", component: () => import("@/pages/Dashboard.vue"), },
  // { path: "/articles", name: "articles", component: () => import("@/pages/Articles.vue"), },
  { path: "/media-list", name: "media", component: () => import("@/pages/media/Overview.vue"), },
  // { path: "/media/new", name: "media-new", component: () => import("@/pages/media/New.vue"), },
  // { path: "/media/register-unknown", name: "media-register-unknown", component: () => import("@/pages/media/RegisterUnknown.vue"), },
  { path: "/blank-page", name: "blank-page", component: () => import("@/pages/blank-page.vue"), },
];

export default createRouter({
  history: createWebHistory(),
  routes: router,
});