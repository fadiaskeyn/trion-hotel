<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Data Pengeluaran</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white p-6 shadow-sm rounded-lg">
                <form @submit.prevent="updateCashout">
                    <div class="mb-4">
                        <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                        <div class="mt-1">
                            <input v-model="form.tanggal" type="date" name="tanggal" id="tanggal" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                        <div class="mt-1">
                            <input v-model="form.keterangan" type="text" name="keterangan" id="keterangan" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="total" class="block text-sm font-medium text-gray-700">Total</label>
                        <div class="mt-1">
                            <input v-model="form.total" type="number" name="total" id="total" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="bukti" class="block text-sm font-medium text-gray-700">Bukti</label>
                        <div class="mt-1">
                          <input @change="handleFileChange" type="file" name="bukti" id="bukti" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
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
import { usePage } from '@inertiajs/vue3';
import axios from 'axios';
import Swal from 'sweetalert2';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const { props } = usePage();
const cashout = props.cashout;
const form = ref({
    tanggal: cashout.tanggal || '',
    keterangan: cashout.keterangan || '',
    total: cashout.nominal || '',
    bukti: null
});

const id = route().params.id;

function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
}
function updateCashout() {
    const csrfTokenMetaTag = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfTokenMetaTag ? csrfTokenMetaTag.getAttribute('content') : '';

    const formData = new FormData();
    formData.append('tanggal', form.value.tanggal);
    formData.append('keterangan', form.value.keterangan);
    formData.append('total', form.value.total);
    if (form.value.bukti) {
        formData.append('bukti', form.value.bukti);
    }

    axios.put(`/cashout/${id}`, formData, {
        headers: {
            'Content-Type': 'multipart/form-data',
            'X-CSRF-TOKEN': csrfToken
        }
    }).then(response => {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Pengeluaran Berhasil Diubah',
        }).then(() => {
            window.location.href = route('cashout.index');
        });
    }).catch(error => {
        console.error('Error updating cashout:', error.response.data);
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Pengeluaran Berhasil Diubah',
        }).then(() => {
            window.location.href = route('cashout.index');
        });
    });
}


function handleFileChange(event) {
    const file = event.target.files[0];
    form.value.bukti = file;
}

function cancel() {
    window.location.href = route('cashout.index');
}
</script>

<style scoped>
/* Add additional styles if needed */
</style>
