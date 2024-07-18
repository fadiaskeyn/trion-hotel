<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Tamu</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center mb-4">
                        <button @click="tambah" name="tambah" class="bg-blue-500 text-white px-4 py-2 rounded mr-4">Tambah</button>
                        <input type="text" v-model="searchQuery" class="border border-gray-300 p-2 rounded flex-grow" placeholder="Cari...">
                    </div>
                    <table class="min-w-full bg-white border">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-4 py-2 border">No</th>
                                <th class="px-4 py-2 border">Nama</th>
                                <th class="px-4 py-2 border">NIK</th>
                                <th class="px-4 py-2 border">Alamat</th>
                                <th class="px-4 py-2 border">No. Telp</th>
                                <th class="px-4 py-2 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(guest, index) in filteredGuests" :key="guest.id">
                                <td class="px-4 py-2 border">{{ index + 1 }}</td>
                                <td class="px-4 py-2 border">{{ guest.name }}</td>
                                <td class="px-4 py-2 border">{{ guest.nik }}</td>
                                <td class="px-4 py-2 border">{{ guest.address }}</td>
                                <td class="px-4 py-2 border">{{ guest.phone }}</td>
                                <td class="px-4 py-2 border">
                                    <button @click="order(guest.id)" class="bg-blue-500 text-white px-2 py-1 rounded">Order</button>
                                    <button @click="edit(guest.id)" class="bg-green-500 text-white px-2 py-1 rounded">Edit</button>
                                    <button @click="hapus(guest.id)" class="bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
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
import { ref, watch, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Swal from 'sweetalert2';
import axios from 'axios';

const { props } = usePage();
const guests = ref(props.visitors);
const searchQuery = ref('');

const filteredGuests = computed(() => {
    if (searchQuery.value) {
        return guests.value.filter(guest =>
            guest.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            guest.nik.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            guest.address.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            guest.phone.toLowerCase().includes(searchQuery.value.toLowerCase())
        );
    }
    return guests.value;
});

function tambah() {
    window.location.href = route('data-tamu.create');
}

function edit(id){
    window.location.href = route('data-tamu.edit', id);
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
            axios.delete(route('data-tamu.destroy', id))
                .then(() => {
                    Swal.fire(
                        'Deleted!',
                        'Data berhasil dihapus.',
                        'success'
                    ).then(() => {
                        guests.value = guests.value.filter(guest => guest.id !== id);
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

function order(guestId) {
    window.location.href = route('order.create', guestId);
}


</script>

<style scoped>
/* Add additional styles if needed */
</style>
