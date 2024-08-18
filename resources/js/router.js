import { Link } from '@inertiajs/vue3'
import { createRouter, createWebHistory } from 'vue-router'
import DataTamuComponent from '@/Pages/Tamu/index.vue'

export default new createRouter({
    history: createWebHistory(),
    routes: [{
                path: '/data-tamu-cuy',
                component: DataTamuComponent,
                name: 'DataTamu'
            },],
})


