<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Pemesanan</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center mb-4">
                        <input type="text" v-model="searchQuery" class="border border-gray-300 p-2 rounded flex-grow" placeholder="Cari...">
                    </div>
                    <table class="min-w-full bg-white border">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-4 py-2 border">No</th>
                                <th class="px-4 py-2 border">Invoice</th>
                                <th class="px-4 py-2 border">Nama</th>
                                <th class="px-4 py-2 border">Check In</th>
                                <th class="px-4 py-2 border">Check Out</th>
                                <th class="px-4 py-2 border">Extra Bed</th>
                                <th class="px-4 py-2 border">Total Kamar</th>
                                <th class="px-4 py-2 border">Total Harga</th>
                                <th class="px-4 py-2 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(order, index) in filteredOrders" :key="order.id">
                                <td class="px-4 py-2 border">{{ index + 1 }}</td>
                                <td class="px-4 py-2 border">{{ order.invoice }}</td>
                                <td class="px-4 py-2 border">{{ order.visitor.name }}</td>
                                <td class="px-4 py-2 border">{{ order.checkin }}</td>
                                <td class="px-4 py-2 border">{{ order.checkout }}</td>
                                <td class="px-4 py-2 border">{{ order.extra_bed }}</td>
                                <td class="px-4 py-2 border">{{ order.rooms }}</td>
                                <td class="px-4 py-2 border">{{ order.amount }}</td>
                                <td class="px-4 py-2 border flex items-center space-x-1">
                                    <button @click="pay(order.id)" class="bg-white text-black px-2 py-1 rounded flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" width="20" height="20" viewBox="0 0 8 8">
                                            <path d="M0 0v8h7v-4h-4v-4h-3zm4 0v3h3l-3-3zm-3 2h1v1h-1v-1zm0 2h1v1h-1v-1zm0 2h4v1h-4v-1z"/>
                                        </svg>
                                    </button>
                                    <button @click="edit(order.id)" class="bg-white text-black px-2 py-1 rounded flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-6 h-6">
                                            <path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152L0 424c0 48.6 39.4 88 88 88l272 0c48.6 0 88-39.4 88-88l0-112c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 112c0 22.1-17.9 40-40 40L88 464c-22.1 0-40-17.9-40-40l0-272c0-22.1 17.9-40 40-40l112 0c13.3 0 24-10.7 24-24s-10.7-24-24-24L88 64z"/>
                                        </svg>
                                    </button>
                                    <button @click="hapus(order.id)" class="bg-white text-black px-2 py-1 rounded flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-6 h-6">
                                            <path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Swal from 'sweetalert2';
import axios from 'axios';

const searchQuery = ref('');
const orders = ref([]);

const filteredOrders = computed(() => {
    if (searchQuery.value) {
        return orders.value.filter(order =>
            order.invoice.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            order.visitor.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            order.checkin.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            order.checkout.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            order.extra_bed.toString().includes(searchQuery.value.toLowerCase()) ||
            order.rooms.toString().includes(searchQuery.value.toLowerCase()) ||
            order.amount.toString().includes(searchQuery.value.toLowerCase())
        );
    }
    return orders.value;
});

onMounted(() => {
    axios.get(route('api.order'))
        .then(response => {
            orders.value = response.data;
        })
        .catch(error => {
            console.error("There was an error fetching the data:", error);
        });
});

function tambah() {
    window.location.href = route('order.create');
}

function edit(id) {
    window.location.href = route('order.edit', id);
}

function pay(id) {
    window.location.href = route('payment.create', id);
}

function hapus(id) {
    Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(route('order.destroy', id))
                .then(() => {
                    Swal.fire(
                        'Deleted!',
                        'Data berhasil dihapus.',
                        'success'
                    ).then(() => {
                        orders.value = orders.value.filter(order => order.id !== id);
                    });
                })
                .catch(error => {
                    Swal.fire(
                        'Error!',
                        'Terjadi kesalahan saat menghapus data.',
                        'error'
                    );
                });
        }
    });
}
</script>

<style scoped>
/* Add additional styles if needed */
</style>
