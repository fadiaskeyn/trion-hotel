<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pembayaran</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white p-6 shadow-sm rounded-lg">
                <form @submit.prevent="submitPayment">
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
                                <input v-model="form.checkin" type="date" name="checkin" id="checkin" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" readonly />
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="checkout" class="block text-sm font-medium text-gray-700">Check Out</label>
                            <div class="mt-1">
                                <input v-model="form.checkout" type="date" name="checkout" id="checkout" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="payment_method" class="block text-sm font-medium text-gray-700">Metode Bayar</label>
                        <div class="mt-1">
                            <select v-model="form.payment_method" name="payment_method" id="payment_method" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                <option value="cash">Cash</option>
                                <option value="transfer">Transfer</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="payment_date" class="block text-sm font-medium text-gray-700">Tgl Bayar</label>
                        <div class="mt-1">
                            <input v-model="form.payment_date" type="date" name="payment_date" id="payment_date" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="buktibayar" class="block text-sm font-medium text-gray-700">Bukti</label>
                        <div class="mt-1">
                            <input @change="handleFileChange" type="file" name="buktibayar" id="buktibayar" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
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

const { props } = usePage();
const order = props.order;

const form = useForm({
    visitor_id: order.visitor_id,
    name: order.visitor.name,
    checkin: order.checkin,
    checkout: order.checkout,
    extra_bed: order.extra_bed,
    rooms: order.rooms,
    amount: order.amount,
    payment_method: order.payment_method,
    payment_date: order.payment_date,
    buktibayar: null,
});

function handleFileChange(event) {
    const file = event.target.files[0];
    form.buktibayar = file;
}

function submitPayment() {
    form.post(route('payment.store', order.id), {
        onSuccess: () => {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Pembayaran berhasil disimpan',
            }).then(() => {
                window.location.href = route('orders.index');
            });
        }
    });
}

function cancel() {
    window.location.href = route('orders.index');
}
</script>

<style scoped>
/* Add additional styles if needed */
</style>
