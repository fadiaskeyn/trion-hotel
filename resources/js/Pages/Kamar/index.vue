<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Kamar</h2>
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
                                <th class="px-4 py-2 border">Nomor Kamar</th>
                                <th class="px-4 py-2 border">Harga Kamar</th>
                                <th class="px-4 py-2 border">Status Kamar</th>
                                <th class="px-4 py-2 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(room, index) in filteredRooms" :key="room.id">
                                <td class="px-4 py-2 border">{{ index + 1 }}</td>
                                <td class="px-4 py-2 border">{{ room.room_number }}</td>
                                <td class="px-4 py-2 border">{{ room.room_price }}</td>
                                <td class="px-4 py-2 border">{{ room.room_status }}</td>
                                <td class="px-4 py-2 border">
                                    <button @click="edit(room.id)" class="bg-green-500 text-white px-2 py-1 rounded">Edit</button>
                                    <button @click="hapus(room.id)" class="bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
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
const rooms = ref(props.rooms);
const searchQuery = ref('');

const filteredRooms = computed(() => {
    if (searchQuery.value) {
        return rooms.value.filter(room =>
            room.room_number.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            room.room_price.toString().includes(searchQuery.value.toLowerCase()) ||
            room.room_status.toLowerCase().includes(searchQuery.value.toLowerCase())
        );
    }
    return rooms.value;
});

function tambah() {
    window.location.href = route('kamar.create');
}

function edit(id) {
    window.location.href = route('kamar.edit', id);
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
            axios.delete(route('kamar.destroy', id))
                .then(() => {
                    Swal.fire(
                        'Deleted!',
                        'Data berhasil dihapus.',
                        'success'
                    ).then(() => {
                        rooms.value = rooms.value.filter(room => room.id !== id);
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
    props: ['rooms'],
    mounted() {
        console.log(this.rooms); // Check if rooms data is available
    }
}
</script>

<style scoped>
/* Add additional styles if needed */
</style>
