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
                                <td class="px-4 py-2 border">
                                    <button @click="edit(pay.id)" class="bg-blue-500 text-white px-2 py-1 rounded">Bayar</button>
                                    <button @click="edit(order.id)" class="bg-green-500 text-white px-2 py-1 rounded">Edit</button>
                                    <button @click="hapus(order.id)" class="bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
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
import { ref, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Swal from 'sweetalert2';
import axios from 'axios';

const { props } = usePage();
const orders = ref(props.orders);

const searchQuery = ref('');
const filteredOrders = computed(() => {
    if (searchQuery.value) {
        return orders.value.filter(order =>
            order.invoice.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            order.visitor.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            order.checkin.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            order.checkout.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            order.extra_bed.toString().includes(searchQuery.value.toLowerCase()) ||
            order.rooms.toString().includes(searchQuery.value.toLowerCase()) ||
            order.total_harga.toString().includes(searchQuery.value.toLowerCase())
        );
    }
    return orders.value;
});

function tambah() {
    window.location.href = route('order.create');
}

function edit(id) {
    window.location.href = route('order.edit', id);
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

<script>
export default {
    props: ['orders'],
    mounted() {
        console.log(this.orders); // Check if orders data is available
    }
}
</script>

<style scoped>
/* Add additional styles if needed */
</style>
