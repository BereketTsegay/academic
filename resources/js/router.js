
import * as VueRouter from 'vue-router'

const router = new VueRouter.createRouter({
    history: VueRouter.createWebHistory(),
    linkExactActiveClass: 'active',
    linkActiveClass: 'active',
    routes: [
        {
            path: "/:catchAll(.*)",
            name: '404',
            component: ()=>import('./pages/404.vue')
        },
        {
            path: '/',
            name: 'home',
            component: ()=>import('./pages/Home.vue'),
        },
        {
            path:'/academia',
            component: ()=> import('./pages/index.vue'),
            meta:{ requiresAuth:true},
            children:[
                {
                    path: '',
                    name: 'dashboard',
                    component: ()=>import('./pages/shippments/index.vue'),
                    meta:{ requiresAuth:true},
                },
                {
                    path: 'shipments',
                    name: 'shipments',
                    component: ()=>import('./pages/shippments/index.vue'),
                    meta:{ requiresAuth:true},
                },
                {
                    path:'settings/',
                    component: ()=> import('./pages/settings/index.vue'),
                    meta:{ requiresAuth:true},
                    children:[
                        {
                            path: 'items',
                            name: 'items',
                            component: ()=> import('./pages/settings/items/index.vue'),
                            children:[
                                {
                                    path: '',
                                    name: 'categories',
                                    component: ()=> import('./pages/settings/items/categories.vue')
                                },
                                {
                                    path: 'products',
                                    name: 'products',
                                    component: ()=> import('./pages/settings/items/products.vue')
                                },
                                {
                                    path: 'units',
                                    name: 'units',
                                    component: ()=> import('./pages/settings/items/units.vue')
                                },
                                {
                                    path: 'brands',
                                    name: 'brands',
                                    component: ()=> import('./pages/settings/items/brands/index.vue')
                                },

                            ],
                        },
                        {
                            path: 'operations',
                            name: 'operations',
                            component: ()=> import('./pages/settings/operations/index.vue'),
                            meta:{ requiresAuth:true},
                            children:[
                                {
                                    path: '',
                                    name: 'parties',
                                    component: ()=> import('./pages/settings/operations/parties/index.vue')
                                },
                                {
                                    path: 'vessels',
                                    name: 'vessels',
                                    component: ()=> import('./pages/settings/operations/vessel/index.vue')
                                },
                            ],
                        },
                        {
                            path: 'account',
                            name: 'account',
                            component: ()=> import('./pages/settings/account/index.vue'),
                            meta:{ requiresAuth:true},
                        },
                        // {
                        //     path: 'brands',
                        //     name: 'brands',
                        //     component: ()=> import('./pages/settings/brands/index.vue')
                        // },

                    ],
                   
                },
                {
                    path:'customers/',
                    component: ()=> import('./pages/Customers/index.vue'),
                }
            ]
        },
        {
            path: '/auth/',
            component: ()=> import('./pages/auth/index.vue'),
            children:[
                {
                    path: '',
                    component: ()=>  import('./pages/auth/login.vue')
                },
                {
                    path: 'register',
                    component: ()=>  import('./pages/auth/register.vue')
                },
            ]
        },
    ]
});

export default router;
