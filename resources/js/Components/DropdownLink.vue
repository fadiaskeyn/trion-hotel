<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    to: {
        type: String,
        required: true,
    },
});
</script>
<template>
    <router-link
        :to="to"
        class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
    >
        <slot/>
    </router-link>
</template>
