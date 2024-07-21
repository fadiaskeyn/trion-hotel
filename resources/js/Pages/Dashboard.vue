<script setup>
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const { props } = usePage();

const incomeToday = ref(props.incomeToday);
const incomeThisWeek = ref(props.incomeThisWeek);
const incomeThisMonth = ref(props.incomeThisMonth);
const totalIncome = ref(props.totalIncome);

const expenseToday = ref(props.expenseToday);
const expenseThisWeek = ref(props.expenseThisWeek);
const expenseThisMonth = ref(props.expenseThisMonth);
const totalExpense = ref(props.totalExpense);
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="flex items-center mb-4">
            <div class="items-center mb-4 bg-green-500 rounded-lg m-5 p-4 w-52">
                <h1 class="text-white">Rp {{ incomeToday }}</h1>
                <label for="name" class="block text-sm font-medium text-white">Pemasukan Hari ini</label>
            </div>

            <div class="items-center mb-4 bg-blue-900 rounded-lg m-5 p-4 w-52">
                <h1 class="text-white">Rp {{ incomeThisWeek }}</h1>
                <label for="name" class="block text-sm font-medium text-white">Pemasukan Minggu ini</label>
            </div>

            <div class="items-center mb-4 bg-orange-500 rounded-lg m-5 p-4 w-52">
                <h1 class="text-white">Rp {{ incomeThisMonth }}</h1>
                <label for="name" class="block text-sm font-medium text-white">Pemasukan Bulan ini</label>
            </div>

            <div class="items-center mb-4 bg-gray-500 rounded-lg m-5 p-4 w-52">
                <h1 class="text-white">Rp {{ totalIncome }}</h1>
                <label for="name" class="block text-sm font-medium text-white">Total Pemasukan</label>
            </div>
        </div>

        <div class="flex items-center mb-4">
            <div class="items-center mb-4 bg-red-500 rounded-lg m-5 p-4 w-52">
                <h1 class="text-white">Rp {{ expenseToday }}</h1>
                <label for="name" class="block text-sm font-medium text-white">Pengeluaran Hari ini</label>
            </div>

            <div class="items-center mb-4 bg-red-500 rounded-lg m-5 p-4 w-52">
                <h1 class="text-white">Rp {{ expenseThisWeek }}</h1>
                <label for="name" class="block text-sm font-medium text-white">Pengeluaran Minggu ini</label>
            </div>

            <div class="items-center mb-4 bg-red-500 rounded-lg m-5 p-4 w-52">
                <h1 class="text-white">Rp {{ expenseThisMonth }}</h1>
                <label for="name" class="block text-sm font-medium text-white">Pengeluaran Bulan ini</label>
            </div>

            <div class="items-center mb-4 bg-gray-500 rounded-lg m-5 p-4 w-52">
                <h1 class="text-white">Rp {{ totalExpense }}</h1>
                <label for="name" class="block text-sm font-medium text-white">Total Pengeluaran</label>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
/* Add additional styles if needed */
</style>
