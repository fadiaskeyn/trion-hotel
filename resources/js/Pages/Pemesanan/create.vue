<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Data Pemesanan</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white p-6 shadow-sm rounded-lg">
                <form @submit.prevent="saveOrder">
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                        <div class="mt-1">
                            <input v-model="form.name" type="text" name="name" id="name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" readonly />
                        </div>
                    </div>
                    <div class="flex items-center mb-4">
                        <div class="mb-4">
                            <label for="checkin" class="block text-sm font-medium text-gray-700">Check In</label>
                            <div class="mt-1">
                                <input v-model="form.checkin" type="date" name="checkin" id="checkin" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="checkout" class="block text-sm font-medium text-gray-700">Check Out</label>
                            <div class="mt-1">
                                <input v-model="form.checkout" type="date" name="checkout" id="checkout" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center mb-4">
                        <div class="mb-4">
                            <label for="extra_bed" class="block text-sm font-medium text-gray-700">Extra Bed</label>
                            <div class="mt-1">
                                <input v-model="form.extra_bed" type="number" name="extra_bed" id="extra_bed" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="rooms" class="block text-sm font-medium text-gray-700">Total Kamar</label>
                            <div class="mt-1">
                                <input v-model="form.rooms" type="number" name="rooms" id="rooms" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="amount" class="block text-sm font-medium text-gray-700">Total Harga</label>
                        <div class="mt-1">
                            <input v-model="form.amount" placeholder="Rp...." type="number" name="amount" id="amount" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                        </div>
                    </div>
                    <div class="flex space-x-4">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">SIMPAN</button>
                        <button type="button" @click="cancel" class="bg-red-500 text-white px-4 py-2 rounded">BATAL</button>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Swal from 'sweetalert2';
import axios from 'axios';

const { props } = usePage();
const visitor = props.visitor;

const form = useForm({
    visitor_id: visitor.id,
    name: visitor.name,
    checkin: '',
    checkout: '',
    extra_bed: 0,
    rooms: 0,
    amount: ''
});

function saveOrder() {
    axios.post(route('order.store'), form)
        .then(() => {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Data pemesanan berhasil ditambahkan',
            }).then(() => {
                window.location.href = route('order.index');
            });
        });
}

function cancel() {
    window.location.href = route('orders.index');
}
</script>

<style scoped>
/* Add additional styles if needed */
</style>
