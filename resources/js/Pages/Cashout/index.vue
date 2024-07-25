<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Cashout</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center mb-4">
                        <button @click="tambah" name="tambah" class="bg-blue-500 text-white px-4 py-2 rounded mr-4">Tambah</button>
                        <input type="text" v-model="searchQuery" class="border border-gray-300 p-2 rounded flex-grow" placeholder="Cari...">
                       <button @click="cetakpdf" class="bg-green-500 text-white px-4 py-2 rounded ml-4">Cetak PDF</button>
                    </div>
                    <table class="min-w-full bg-white border" name="table">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-4 py-2 border">No</th>
                                <th class="px-4 py-2 border">Nama Karyawan</th>
                                <th class="px-4 py-2 border">Tgl Pengeluaran</th>
                                <th class="px-4 py-2 border">Keterangan</th>
                                <th class="px-4 py-2 border">Total</th>
                                <th class="px-4 py-2 border">Bukti</th>
                                <th class="px-4 py-2 border">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(cashout, index) in filteredCashouts" :key="cashout.id">
                                <td class="px-4 py-2 border">{{ index + 1 }}</td>
                                <td class="px-4 py-2 border">{{ cashout.user.name }}</td>
                                <td class="px-4 py-2 border">{{ cashout.tanggal }}</td>
                                <td class="px-4 py-2 border">{{ cashout.keterangan }}</td>
                                <td class="px-4 py-2 border">{{ cashout.nominal }}</td>
                                <td class="px-4 py-2 border">
                                     <img src="/build/assets/images/tf.png" class="w-10 h-10 fill-current text-gray-500" @click="bukti(cashout.id)" id="cetak" name="cetak"/>
</td>
                                <td class="px-4 py-2 border">
                                    <button @click="edit(cashout.id)" class="bg-green-500 text-white px-2 py-1 rounded">Edit</button>
                                    <button @click="hapus(cashout.id)" class="bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="px-4 py-2 border font-bold">Jumlah Uang Keluar</td>
                                <td colspan="3" class="px-4 py-2 border font-bold">{{ totalNominal }}</td>
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
const cashouts = ref(props.cashouts);
const searchQuery = ref('');

const filteredCashouts = computed(() => {
    if (searchQuery.value) {
        return cashouts.value.filter(cashout =>
            cashout.user.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            cashout.tanggal.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            cashout.keterangan.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            cashout.nominal.toString().includes(searchQuery.value.toLowerCase()) ||
            cashout.bukti.toLowerCase().includes(searchQuery.value.toLowerCase())
        );
    }
    return cashouts.value;
});

const totalNominal = computed(() => {
    return filteredCashouts.value.reduce((sum, cashout) => sum + parseFloat(cashout.nominal), 0).toFixed(2);
});

function tambah() {
    window.location.href = route('cashout.create');
}

function edit(id) {
    window.location.href = route('cashout.edit', id);
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
            axios.delete(route('cashout.destroy', id))
                .then(() => {
                    Swal.fire(
                        'Deleted!',
                        'Data berhasil dihapus.',
                        'success'
                    ).then(() => {
                        cashouts.value = cashouts.value.filter(cashout => cashout.id !== id);
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


const bukti = async (id) => {
    try {
        const response = await axios.get(route('cashout.show', id));
        const cashout = response.data;

        Swal.fire({
            title: "Sukses",
            text: "Berikut Bukti Pembayaran yang Anda Cari",
            imageUrl: cashout.proof_url,
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


function cetakPdf() {
    // Implement your PDF generation logic here
    // This can be done using libraries like jsPDF or similar
    console.log('Cetak PDF clicked');
}
</script>

<script>
export default {
    props: ['cashouts'],
    mounted() {
        console.log(this.cashouts);
    }
}
</script>

<style scoped>
/* Add additional styles if needed */
</style>
