<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
   <div class="min-h-screen flex bg-blue-900 text-white">
        <!-- Sidebar -->
        <div class="w-64 flex flex-col">
            <div class="p-4">
                <Link :href="route('dashboard')">
                    <ApplicationLogo class="block h-9 w-auto fill-current text-white" />
                </Link>
            </div>
            <nav class="flex-1 px-2 py-2 space-y-2">
                <ul class="space-y-2">
                    <li>
                        <Link :href="route('dashboard')" class="block ps-3 pe-4 py-2 text-start text-base font-medium hover:bg-blue-700">Dashboard</Link>
                    </li>
                    <li>
                        <Link :href="route('data-tamu')" class="block ps-3 pe-4 py-2 text-start text-base font-medium hover:bg-blue-700">Data Tamu</Link>
                    </li>
                    <li>
                        <Link :href="route('pemesanan')" class="block ps-3 pe-4 py-2 text-start text-base font-medium hover:bg-blue-700">Pemesanan</Link>
                    </li>
                    <li>
                        <Link :href="route('pembayaran')" class="block ps-3 pe-4 py-2 text-start text-base font-medium hover:bg-blue-700">Pembayaran</Link>
                    </li>
                    <li>
                        <Link :href="route('data-kamar')" class="block ps-3 pe-4 py-2 text-start text-base font-medium hover:bg-blue-700">Data Kamar</Link>
                    </li>
                    <li>
                        <Link :href="route('laporan-pemasukan')" class="block ps-3 pe-4 py-2 text-start text-base font-medium hover:bg-blue-700">Laporan Pemasukan</Link>
                    </li>
                    <li>
                        <Link :href="route('laporan-pengeluaran')" class="block ps-3 pe-4 py-2 text-start text-base font-medium hover:bg-blue-700">Laporan Pengeluaran</Link>
                    </li>
                    <li>
                        <Link :href="route('user')" class="block ps-3 pe-4 py-2 text-start text-base font-medium hover:bg-blue-700">User</Link>
                    </li>
                </ul>
            </nav>
        </div>
        </div>
</template>
