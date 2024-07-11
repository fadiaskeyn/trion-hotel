<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 sm:justify-center bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="flex justify-center">
                <Link href="/">
                    <img src="/build/assets/images/logo-trion.png" class="w-20 h-20 fill-current text-gray-500" />
                </Link>
            </div>
            <slot />
        </div>
    </div>
</template>
