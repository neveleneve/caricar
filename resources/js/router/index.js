import { createRouter, createWebHistory } from "vue-router";

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
        component: () => import("@/components/admin/dashboard/Index.vue"),
    },
    {
        path: "brand",
        name: "brand",
        children: [
            {
                path: "",
                name: "brand_index",
                component: () => import("@/components/admin/brands/Index.vue"),
            },
            {
                path: ":id",
                name: "brand_edit",
                component: () => import("@/components/admin/brands/Edit.vue"),
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
                component: () => import("@/components/admin/user/Index.vue"),
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
                component: () => import("@/components/admin/item/Index.vue"),
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
                component: () =>
                    import("@/components/admin/transaksi/Index.vue"),
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
                component: () => import("@/components/admin/report/Index.vue"),
            },
        ],
    },
];

const routes = [
    {
        path: "/",
        name: "welcome",
        component: () => import("@/components/pages/Welcome.vue"),
    },
    {
        path: "/mobil-baru",
        name: "mobilbaru",
        component: () => import("@/components/pages/MobilBaru.vue"),
    },
    {
        path: "/mobil-bekas",
        name: "mobilbekas",
        component: () => import("@/components/pages/MobilBekas.vue"),
    },
    {
        path: "/motor-baru",
        name: "motorbaru",
        component: () => import("@/components/pages/MotorBaru.vue"),
    },
    {
        path: "/motor-bekas",
        name: "motorbekas",
        component: () => import("@/components/pages/MotorBekas.vue"),
    },
    {
        path: "/sell",
        name: "sell",
        component: () => import("@/components/pages/JualKendaraanAnda.vue"),
    },
    {
        path: "/login",
        name: "login",
        component: () => import("@/components/Login.vue"),
        meta: {
            requiresGuest: true,
        },
    },
    {
        path: "/register",
        name: "register",
        component: () => import("@/components/Register.vue"),
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

    if (to.meta.requiresGuest && isAuthenticated) {
        return next({ name: "dashboard" });
    }

    if (to.meta.requiresAuth && !isAuthenticated) {
        return next({ name: "login" });
    }

    if (to.meta.role && user?.role !== to.meta.role) {
        return next({ name: "welcome" });
    }

    return next();
});

export default router;
