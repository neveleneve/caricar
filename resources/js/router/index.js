import { createRouter, createWebHistory } from "vue-router";
import Login from "@/components/Login.vue";
import Register from "@/components/Register.vue";

import Welcome from "@/components/pages/Welcome.vue";

import DashboardIndex from "@/components/admin/dashboard/Index.vue";

import BrandIndex from "@/components/admin/brands/Index.vue";
import BrandEdit from "@/components/admin/brands/Edit.vue";

import UserIndex from "@/components/admin/user/Index.vue";

import ItemIndex from "@/components/admin/item/Index.vue";

import TransaksiIndex from "@/components/admin/transaksi/Index.vue";

import ReportIndex from "@/components/admin/report/Index.vue";

import { storage } from "@/utils/storage";
import { STORAGE_KEYS } from "@/utils/constants";

const adminRoutes = [
    {
        path: "dashboard",
        name: "dashboard",
        component: DashboardIndex,
    },
    {
        path: "brand",
        name: "brand",
        children: [
            {
                path: "",
                name: "brand_index",
                component: BrandIndex,
            },
            {
                path: ":id",
                name: "brand_edit",
                component: BrandEdit,
            },
        ],
    },
    {
        path: "user",
        name: "user",
        children: [
            {
                path: "",
                name: "user_index",
                component: UserIndex,
            },
        ],
    },
    {
        path: "item",
        name: "item",
        children: [
            {
                path: "",
                name: "item_index",
                component: ItemIndex,
            },
        ],
    },
    {
        path: "transaksi",
        name: "transaksi",
        children: [
            {
                path: "",
                name: "transaksi_index",
                component: TransaksiIndex,
            },
        ],
    },
    {
        path: "report",
        name: "report",
        children: [
            {
                path: "",
                name: "report_index",
                component: ReportIndex,
            },
        ],
    },
];

const routes = [
    {
        path: "/",
        name: "welcome",
        component: Welcome,
    },
    {
        path: "/login",
        name: "login",
        component: Login,
        meta: {
            requiresGuest: true,
        },
    },
    {
        path: "/register",
        name: "register",
        component: Register,
        meta: {
            requiresGuest: true,
        },
    },
    {
        path: "/administrator",
        children: adminRoutes.map((route) => ({
            ...route,
            path: route.path,
            meta: {
                requiresAuth: true,
                role: "administrator",
            },
        })),
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(async (to, from, next) => {
    const isAuthenticated = storage.getItem(STORAGE_KEYS.TOKEN);
    const user = storage.getItem(STORAGE_KEYS.AUTH);

    // Check for guest routes (login/register)
    if (to.meta.requiresGuest && isAuthenticated) {
        return next({ name: "dashboard" });
    }

    // Check for authenticated routes
    if (to.meta.requiresAuth && !isAuthenticated) {
        return next({ name: "login" });
    }

    // Check role-based access
    if (to.meta.role && user?.role !== to.meta.role) {
        return next({ name: "welcome" }); // or another appropriate fallback route
    }

    return next();
});

export default router;
