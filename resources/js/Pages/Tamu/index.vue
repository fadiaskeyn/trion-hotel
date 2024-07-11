<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>


<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Tamu</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded">Tambah</button>
                        <input type="text" class="border border-gray-300 p-2 rounded" placeholder="Cari...">
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
                            <tr v-for="guest in guests" :key="guest.no">
                                <td class="px-4 py-2 border">{{ guest.no }}</td>
                                <td class="px-4 py-2 border">{{ guest.nama }}</td>
                                <td class="px-4 py-2 border">{{ guest.nik }}</td>
                                <td class="px-4 py-2 border">{{ guest.alamat }}</td>
                                <td class="px-4 py-2 border">{{ guest.telp }}</td>
                                <td class="px-4 py-2 border">
                                    <button class="bg-green-500 text-white px-2 py-1 rounded">Edit</button>
                                    <button class="bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
