<script setup>
import { ref } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const form = ref({
    name: '',
    nik: '',
    address: '',
    phone: ''
});

function saveGuest() {
    axios.post('/data-tamu', form.value)
        .then(response => {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Data tamu berhasil Disimpan',
            });
            form.value = {
                name: '',
                nik: '',
                address: '',
                phone: ''
            };
            window.location.href = route('data-tamu.index');
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Terjadi kesalahan saat menyimpan data tamu.',
            });
        });
}

function cancel() {
    window.location.href = route('data-tamu.index');
}
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Data Tamu</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white p-6 shadow-sm rounded-lg">
                <form @submit.prevent="saveGuest">
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                        <div class="mt-1">
                            <input v-model="form.name" type="text" name="name" id="name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="nik" class="block text-sm font-medium text-gray-700">Nik</label>
                        <div class="mt-1">
                            <input v-model="form.nik" type="text" name="nik" id="nik" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <div class="mt-1">
                            <input v-model="form.address" type="text" name="address" id="address" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-medium text-gray-700">No. Telp</label>
                        <div class="mt-1">
                            <input v-model="form.phone" type="text" name="phone" id="phone" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
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

<style scoped>
/* Add additional styles if needed */
</style>
