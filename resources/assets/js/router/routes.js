export default [
  { path: "/", name: "landing", component: () => import("~/pages/index") },

  {
    path: "/admin/login",
    name: "admin.login",
    component: () => import("~/pages/admin/login")
  },
  {
    path: "/admin/register",
    name: "admin.register",
    component: () => import("~/pages/admin/register")
  },
  {
    path: "/admin/password/reset",
    name: "admin.password.request",
    component: () => import("~/pages/admin/password/email")
  },
  {
    path: "/admin/password/reset/:token",
    name: "admin.password.reset",
    component: () => import("~/pages/admin/password/reset")
  },

  {
    path: "/admin/dashboard",
    name: "admin.dashboard",
    component: () => import("~/pages/admin/dashboard")
  },
  {
    path: "/settings",
    component: () => import("~/pages/admin/settings/index"),
    children: [
      { path: "", redirect: { name: "settings.profile" } },
      {
        path: "admin.profile",
        name: "settings.profile",
        component: () => import("~/pages/admin/settings/profile")
      },
      {
        path: "admin.password",
        name: "settings.password",
        component: () => import("~/pages/admin/settings/password")
      }
    ]
  },

  { path: "*", component: require("~/pages/errors/404") },

  {
    path: "/admin/categories",
    name: "admin.categories",
    component: () => import("~/pages/admin/categories")
  },
  
  {
    path: "/admin/concours_avantages",
    name: "admin.concours_avantages",
    component: () => import("~/pages/admin/concours_avantages")
  }
];
