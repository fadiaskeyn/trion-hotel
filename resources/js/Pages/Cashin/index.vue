<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Laporan Pemasukan</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center mb-4">
                        <input type="text" v-model="searchQuery" class="border border-gray-300 p-2 rounded flex-grow" placeholder="Cari...">
                        <button @click="cetakpdf" class="bg-green-500 text-white px-4 py-2 rounded ml-4">Cetak PDF</button>
                    </div>
                    <table class="min-w-full bg-white border" name="table" id="table">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-4 py-2 border">No</th>
                                <th class="px-4 py-2 border">Nama Tamu</th>
                                <th class="px-4 py-2 border">Check In</th>
                                <th class="px-4 py-2 border">Check Out</th>
                                <th class="px-4 py-2 border">Extra Bed</th>
                                <th class="px-4 py-2 border">Total Kamar</th>
                                <th class="px-4 py-2 border">Tanggal Bayar</th>
                                <th class="px-4 py-2 border">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(payment, index) in filteredPayments" :key="payment.id">
                                <td class="px-4 py-2 border">{{ index + 1 }}</td>
                                <td class="px-4 py-2 border">{{ payment.order.visitor.name }}</td>
                                <td class="px-4 py-2 border">{{ payment.order.checkin }}</td>
                                <td class="px-4 py-2 border">{{ payment.order.checkout }}</td>
                                <td class="px-4 py-2 border">{{ payment.order.extra_bed }}</td>
                                <td class="px-4 py-2 border">{{ payment.order.rooms }}</td>
                                <td class="px-4 py-2 border">{{ payment.payment_date }}</td>
                                <td class="px-4 py-2 border">{{ payment.order.amount }}</td>
                            </tr>
                            <tr>
                                <td colspan="7" class="px-4 py-2 border font-bold">Jumlah Uang Masuk</td>
                                <td colspan="2" class="px-4 py-2 border font-bold">{{ totalNominal }}</td>
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
const payments = ref(props.payments);
const searchQuery = ref('');

const filteredPayments = computed(() => {
    if (searchQuery.value) {
        return payments.value.filter(payment =>
            payment.order.visitor.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            payment.order.checkin.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            payment.order.checkout.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            payment.order.amount.toString().includes(searchQuery.value) ||
            payment.payment_date.toLowerCase().includes(searchQuery.value.toLowerCase())
        );
    }
    return payments.value;
});

const bukti = async (id) => {
    try {
        const response = await axios.get(route('payment.show', id));
        const payment = response.data;

        Swal.fire({
            title: "Sukses",
            text: "Berikut Bukti Pembayaran yang Anda Cari",
            imageUrl: payment.proof_url,
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: "Custom image"
        });
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Gagal memuat bukti pembayaran',
        });
        console.log(error);
    }
};

function edit(id) {
    window.location.href = route('payment.edit', id);
}



function cetakpdf() {
    // Ambil elemen tabel dengan id 'table'
    const table = document.querySelector('table[name="table"]').outerHTML;

    // Buat dokumen baru
    const printWindow = window.open('', '', 'height=600,width=800');

    // Sisipkan HTML tabel ke dalam dokumen
    printWindow.document.write('<html><head><title>Cetak PDF</title>');
    printWindow.document.write('<style>table { width: 100%; border-collapse: collapse; } th, td { border: 1px solid black; padding: 8px; text-align: left; } th { background-color: #f2f2f2; }</style>');
    printWindow.document.write('</head><body >');
    printWindow.document.write(table);
    printWindow.document.write('</body></html>');

    // Tunggu sampai konten selesai dimuat, lalu cetak
    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
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
            axios.delete(route('payment.destroy', id))
                .then(() => {
                    Swal.fire(
                        'Deleted!',
                        'Data berhasil dihapus.',
                        'success'
                    ).then(() => {
                        payments.value = payments.value.filter(payment => payment.id !== id);
                    });
                })
                .catch(error => {
                    Swal.fire(
                        'Error!',
                        'Terjadi kesalahan saat menghapus data.',
                        'error'
                    );
                    console.log(error);
                });
        }
    });
}

const totalNominal = computed(() => {
    return filteredPayments.value.reduce((sum, payment) => sum + parseFloat(payment.order.amount), 0).toFixed(2);
});
</script>

<style scoped>
/* Add additional styles if needed */
</style>
