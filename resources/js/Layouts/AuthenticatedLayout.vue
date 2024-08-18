<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
// import { Link } from '@inertiajs/vue3';



const showingNavigationDropdown = ref(false);
</script>
<script>
export default {
  methods: {
    showAlert() {
      this.$swal('Hello Vue world!!!');
    },
  },
};
</script>
<template>
    <div class="min-h-screen bg-gray-100 flex">
        <!-- Sidebar -->
        <div class="min-h-screen flex bg-blue-900 text-white">
            <div class="w-64 flex flex-col">
                <div class="p-4">
                    <router-link to="/dashboard">
                    <img src="/build/assets/images/logo-trion.png" class="w-12 h-12 fill-current text-gray-500" />
                    </router-link>
                </div>
                <nav class="flex-1 px-2 py-2 space-y-2">
                    <ul class="space-y-2">
                        <li>
    <router-link to="/dashboard" class="block ps-3 pe-4 py-2 text-start text-base font-medium hover:bg-blue-700 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="30" height="30" class="flex-shrink-0 mr-2">
            <path d="M0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM288 96a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zM256 416c35.3 0 64-28.7 64-64c0-17.4-6.9-33.1-18.1-44.6L366 161.7c5.3-12.1-.2-26.3-12.3-31.6s-26.3 .2-31.6 12.3L257.9 288c-.6 0-1.3 0-1.9 0c-35.3 0-64 28.7-64 64s28.7 64 64 64zM176 144a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zM96 288a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm352-32a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z"/>
        </svg>
        Dashboard
    </router-link>
</li>

                        <li>
                            <router-link to="/data-tamu-cuy" class="block ps-3 pe-4 py-2 text-start text-base font-medium hover:bg-blue-700 flex items-center">
                            <svg fill="#000000" width="30" height="30" viewBox="0 0 64 64" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

<g id="_x32_5_attachment"/>

<g id="_x32_4_office"/>

<g id="_x32_3_pin"/>

<g id="_x32_2_business_card"/>

<g id="_x32_1_form"/>

<g id="_x32_0_headset"/>

<g id="_x31_9_video_call"/>

<g id="_x31_8_letter_box"/>

<g id="_x31_7_papperplane"/>

<g id="_x31_6_laptop"/>

<g id="_x31_5_connection"/>

<g id="_x31_4_phonebook"/>

<g id="_x31_3_classic_telephone"/>

<g id="_x31_2_sending_mail"/>

<g id="_x31_1_man_talking"/>

<g id="_x31_0_date"/>

<g id="_x30_9_review"/>

<g id="_x30_8_email"/>

<g id="_x30_7_information"/>

<g id="_x30_6_phone_talking"/>

<g id="_x30_5_women_talking"/>

<g id="_x30_4_calling"/>

<g id="_x30_3_women"/>

<g id="_x30_2_writing">

<g>

<g>

<path d="M11.8418,20.4248l29.042-0.0034c0.5522,0,1-0.4478,1-1s-0.4478-1-1-1l-29.042,0.0034c-0.5522,0-1,0.4478-1,1     S11.2896,20.4248,11.8418,20.4248z"/>

<path d="M33.7593,25.8887H11.8418c-0.5522,0-1,0.4478-1,1s0.4478,1,1,1h21.9175c0.5522,0,1-0.4478,1-1     S34.3115,25.8887,33.7593,25.8887z"/>

<path d="M33.7593,33.1934H11.8418c-0.5522,0-1,0.4478-1,1s0.4478,1,1,1h21.9175c0.5522,0,1-0.4478,1-1     S34.3115,33.1934,33.7593,33.1934z"/>

<path d="M33.7763,40.5015H11.8418c-0.5522,0-1,0.4478-1,1s0.4478,1,1,1h21.9345c0.5522,0,1-0.4478,1-1     S34.3286,40.5015,33.7763,40.5015z"/>

<path d="M33.396,48.6914h-0.0005l-8.3828,0.0034c-0.5522,0-0.9995,0.4482-0.9995,1.0005s0.4478,0.9995,1,0.9995h0.0005     l8.3828-0.0034c0.5522,0,0.9995-0.4482,0.9995-1.0005S33.9482,48.6914,33.396,48.6914z"/>

<path d="M61.3525,12.0815l-2.2285-1.209c-0.7393-0.4023-1.5928-0.4932-2.4019-0.2515c-0.8101,0.2393-1.4771,0.7778-1.8809,1.519     l-4.3599,8.0269V5.8838c0-2.2632-1.8413-4.1045-4.1045-4.1045H9.5327c-0.2462,0-0.5461,0.1156-0.7222,0.291L1.2985,9.5375     C1.1246,9.7224,1,9.9928,1,10.25v47.8662c0,2.2632,1.8413,4.1045,4.1045,4.1045H46.377c2.2632,0,4.1045-1.8413,4.1045-4.1045     v-19.41l12.1372-22.3444C63.4482,14.834,62.8809,12.9141,61.3525,12.0815z M8.5156,5.1962v1.9493     c0,1.1606-0.9438,2.1045-2.1045,2.1045H4.4283L8.5156,5.1962z M48.4814,58.1162c0,1.1606-0.9438,2.1045-2.1045,2.1045H5.1045     C3.9438,60.2207,3,59.2769,3,58.1162V11.25h3.4111c2.2632,0,4.1045-1.8413,4.1045-4.1045V3.7793H46.377     c1.1606,0,2.1045,0.9438,2.1045,2.1045v17.9654L38.6118,42.02c-0.0438,0.0808-0.1229,0.3453-0.1211,0.4893l0.0864,7.3013     c0.0044,0.3682,0.2109,0.7046,0.5371,0.875c0.1455,0.0757,0.3047,0.1133,0.4629,0.1133c0.1968,0,0.3931-0.0581,0.562-0.1729     l5.9287-4.0278c0.0111-0.0076,0.0159-0.0214,0.0267-0.0294c0.1144-0.0842,0.2173-0.1868,0.2897-0.3197     c0,0,0.0001-0.0005,0.0002-0.0007c0.0001-0.0001,0.0002-0.0002,0.0002-0.0002l2.0967-3.86V58.1162z M40.5108,44.1913     l3.0764,1.6741l-3.032,2.0599L40.5108,44.1913z M60.8613,15.4067L45.1049,44.4142l-4.2584-2.3174L55.9409,14.313l0.6582-1.2197     c0.3062-0.5615,1.0093-0.769,1.5693-0.4639l2.2285,1.209C60.957,14.1436,61.165,14.8477,60.8613,15.4067z"/>

</g>

</g>

</g>

<g id="_x30_1_chatting"/>

</svg>
Data Tamu</router-link>
                        </li>
                        <li>
                            <!-- <router-link :href="route('order.index')" class="block ps-3 pe-4 py-2 text-start text-base font-medium hover:bg-blue-700">Pemesanan</router-link> -->
                        </li>
                        <li>
                            <!-- <router-link :href="route('payment.index')" class="block ps-3 pe-4 py-2 text-start text-base font-medium hover:bg-blue-700">Pembayaran</router-link> -->
                        </li>
                        <li>
                            <!-- <router-link :href="route('kamar.index')" class="block ps-3 pe-4 py-2 text-start text-base font-medium hover:bg-blue-700">Data Kamar</router-link> -->
                        </li>
                        <li>
                            <!-- <router-link :href="route('cashin.index')" class="block ps-3 pe-4 py-2 text-start text-base font-medium hover:bg-blue-700">Laporan Pemasukan</router-link> -->
                        </li>
                        <li>
                            <!-- <router-link :href="route('cashout.index')" class="block ps-3 pe-4 py-2 text-start text-base font-medium hover:bg-blue-700">Laporan Pengeluaran</router-link> -->
                        </li>
                        <li>
                            <!-- <router-link :href="route('user')" class="block ps-3 pe-4 py-2 text-start text-base font-medium hover:bg-blue-700">User</router-link> -->
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Navigation Menu -->
            <nav class="bg-white border-b border-gray-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <router-link to="/dashboard">
                                    <!-- <img src="/build/assets/images/logo-trion.png" class="w-10 h-10 fill-current text-gray-500" /> -->
                                </router-link>
                            </div>
                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <!-- <NavLink :href="route('dashboard')"></NavLink> -->
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                            >
                                                {{ $page.props.auth.user.name }}
                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 111.414 1.414l-4 4a1 1 01-1.414 0l-4-4a1 1 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink to='/profile/edit'> Profile </DropdownLink>
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                            >
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                    class="sm:hidden"
                >
                    <div class="pt-2 pb-3 space-y-1">
                        <!-- <ResponsiveNavLink :href="route('dashboard')" :active="route().current(' ')">
                        </ResponsiveNavLink> -->
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')"> Profile </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 bg-gray-100 p-6">
                <slot />
            </main>
        </div>
    </div>
</template>

<style scoped>
/* Add additional styles if needed */
</style>
