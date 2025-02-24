import { createRouter, createWebHistory } from "vue-router";
import Login from "@/components/Login.vue";

import DashboardIndex from "@/components/admin/dashboard/Index.vue";

import BrandIndex from "@/components/admin/brands/Index.vue";
// import KategoriCreate from "@/components/auth/Kategori/Create.vue";
// import KategoriEdit from "@/components/auth/Kategori/Edit.vue";

// import ItemIndex from "@/components/auth/Item/Index.vue";
// import ItemCreate from "@/components/auth/Item/Create.vue";
// import ItemEdit from "@/components/auth/Item/Edit.vue";

// import PelangganIndex from "@/components/auth/Pelanggan/Index.vue";
// import PelangganCreate from "@/components/auth/Pelanggan/Create.vue";
// import PelangganEdit from "@/components/auth/Pelanggan/Edit.vue";

// import TransaksiIndex from "@/components/auth/Transaksi/Index.vue";

// import ReportIndex from "@/components/auth/Report/Index.vue";

import { storage } from "@/utils/storage";
import { STORAGE_KEYS } from "@/utils/constants";

const routes = [
    {
        path: "/",
        redirect: "/administrator/dashboard",
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
        path: "/administrator/dashboard",
        name: "dashboard",
        component: DashboardIndex,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/administrator/brand",
        name: "brand",
        meta: {
            requiresAuth: true,
        },
        children: [
            {
                path: "",
                name: "brand_index",
                component: BrandIndex,
            },
            // {
            //     path: "add",
            //     name: "kategori_create",
            //     component: KategoriCreate,
            // },
            // {
            //     path: ":id",
            //     name: "kategori_edit",
            //     component: KategoriEdit,
            // },
        ],
    },
    // {
    //     path: "/item",
    //     name: "item",
    //     meta: {
    //         requiresAuth: true,
    //     },
    //     children: [
    //         {
    //             path: "",
    //             name: "item_index",
    //             component: ItemIndex,
    //         },
    //         {
    //             path: "add",
    //             name: "item_create",
    //             component: ItemCreate,
    //         },
    //         {
    //             path: ":id",
    //             name: "item_edit",
    //             component: ItemEdit,
    //         },
    //     ],
    // },
    // {
    //     path: "/pelanggan",
    //     name: "pelanggan",
    //     meta: {
    //         requiresAuth: true,
    //     },
    //     children: [
    //         {
    //             path: "",
    //             name: "pelanggan_index",
    //             component: PelangganIndex,
    //         },
    //         {
    //             path: "add",
    //             name: "pelanggan_create",
    //             component: PelangganCreate,
    //         },
    //         {
    //             path: ":id",
    //             name: "pelanggan_edit",
    //             component: PelangganEdit,
    //         },
    //     ],
    // },
    // {
    //     path: "/transaksi",
    //     name: "transaksi",
    //     component: TransaksiIndex,
    //     meta: {
    //         requiresAuth: true,
    //     },
    // },
    // {
    //     path: "/report",
    //     name: "report",
    //     component: ReportIndex,
    //     meta: {
    //         requiresAuth: true,
    //     },
    // },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(async (to, from, next) => {
    const isAuthenticated = storage.getItem(STORAGE_KEYS.TOKEN);

    if (to.meta.guest && isAuthenticated) {
        return next({ name: "dashboard" });
    }

    if (to.meta.requiresAuth && !isAuthenticated) {
        return next({ name: "login" });
    }

    return next();
});

export default router;
