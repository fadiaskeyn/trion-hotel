<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Data Kamar</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white p-6 shadow-sm rounded-lg">
                <form @submit.prevent="saveRoom">
                    <div class="mb-4">
                        <label for="room_number" class="block text-sm font-medium text-gray-700">Nomor Kamar</label>
                        <div class="mt-1">
                            <input v-model="form.room_number" type="text" name="room_number" id="room_number" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="room_price" class="block text-sm font-medium text-gray-700">Harga Kamar</label>
                        <div class="mt-1">
                            <input v-model="form.room_price" type="text" name="room_price" id="room_price" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="room_status" class="block text-sm font-medium text-gray-700">Status Kamar</label>
                        <div class="mt-1">
                            <input v-model="form.room_status" type="text" name="room_status" id="room_status" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
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
import { useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Swal from 'sweetalert2';

const form = useForm({
    room_number: '',
    room_price: '',
    room_status: ''
});

function saveRoom() {
    form.post(route('kamar.store'), {
        onSuccess: () => {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Data kamar berhasil disimpan',
            }).then(() => {
                window.location.href = route('kamar.index');
            });
        }
    });
}

function cancel() {
    window.location.href = route('kamar.index');
}
</script>

<style scoped>
/* Add additional styles if needed */
</style>
