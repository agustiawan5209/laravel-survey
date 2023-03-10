<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref, defineProps } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    can: {
        type: Object,
        default: () => ({})
    },
    survey: {
        type: Object,
        default: () => ({})
    }
})
</script>

<template>
    <Head title="Survey" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $page.props.auth.user.name }}</h2>
        </template>

        <!-- Content -->
        <div class="py-5 md:py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <!-- Table -->

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg py-5 px-3">
                        <div class="flex items-center justify-between pb-4">
                            <div v-if="can.create">
                                <Link :href="route('Survey.create')">
                                <button id="dropdownRadioButton" data-dropdown-toggle="dropdownRadio"
                                    class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                    type="button">
                                    Tambah
                                </button>
                                </Link>
                            </div>
                            <label for="table-search" class="sr-only">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input type="text" id="table-search"
                                    class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Search for items">
                            </div>
                        </div>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="p-4">
                                        NO.
                                    </th>
                                    <th scope="col" class="px-6 py-3 capitalize">
                                        Kabupaten/Kota
                                    </th>
                                    <th scope="col" class="px-6 py-3 capitalize">
                                        Kecamatan
                                    </th>
                                    <th scope="col" class="px-6 py-3 capitalize">
                                        Kelurahan
                                    </th>
                                    <th scope="col" class="px-6 py-3 capitalize">
                                        Desa
                                    </th>
                                    <th scope="col" class="px-6 py-3 capitalize">
                                        RT/RW
                                    </th>
                                    <th scope="col" class="px-6 py-3 capitalize">
                                        TPS
                                    </th>
                                    <th scope="col" class="px-6 py-3 capitalize">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in survey.data" :key="item.id"
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="w-4 p-4">
                                        #
                                    </td>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ item.kabupaten }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ item.kecamatan }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ item.kelurahan }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ item.desa }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ item.rt_rw }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ item.tps }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <PrimaryButton type="button" class="bg-red-500 hover:bg-red-600 text-white active:bg-red-400 focus:bg-red-700" >Hapus</PrimaryButton>
                                        <PrimaryButton type="button" class="bg-blue-500 hover:bg-blue-600 text-white active:bg-blue-400 focus:bg-blue-700" >Detail</PrimaryButton>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
