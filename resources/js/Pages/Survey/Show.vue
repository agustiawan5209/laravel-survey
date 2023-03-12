<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref, defineProps } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    survey: {
        type: Object,
        default: () => ({})
    },
    lokasi: {
        type: Object,
        default: () => ({})
    },
    can: Object

})

function jawaban(value){
    var hasil = null;
    if(value === 'a') hasil = "Mendukung";
    if(value === 'b') hasil = "Tidak Mendukung";
    if(value === 'c') hasil = "Tidak Tahu";

    return hasil;
}
</script>

<template>
    <Head title="Survey" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Survey</h2>
            <ul class="max-w-md space-y-1 text-gray-500 list-none list-inside dark:text-gray-400">
                <li>
                    Kabupaten : {{ lokasi.kabupaten }}
                </li>
                <li>
                    Kecamatan : {{ lokasi.kecamatan }}
                </li>
                <li>
                    Kelurahan/Desa : {{ lokasi.kelurahan_desa }}
                </li>
            </ul>
        </template>

        <!-- Content -->
        <div class="py-5 md:py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <!-- Table -->

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg py-5 px-3">
                        <div class="flex items-center justify-between pb-4">

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
                                       RT/RW.TPS
                                    </th>
                                    <th scope="col" class="px-6 py-3 capitalize">
                                        Nama
                                    </th>
                                    <th scope="col" class="px-6 py-3 capitalize">
                                        NO.HP
                                    </th>
                                    <th scope="col" class="px-6 py-3 capitalize">
                                        Kepala Keluarga
                                    </th>
                                    <th scope="col" class="px-6 py-3 capitalize">
                                      Alamat
                                    </th>
                                    <th scope="col" class="px-6 py-3 capitalize" v-if="can.admin">
                                        Hasil
                                    </th>
                                </tr>
                            </thead>
                            <tbody v-if="survey == null">
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="w-4 p-4" colspan="7">
                                        Data Kosong
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr v-for="(item,index) in survey.survey" :key="item.id" :index="index"
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="w-4 p-4">
                                        {{ index +1 }}
                                    </td>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ item.rt_rw }}.{{ item.tps }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ item.nama }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ item.no_hp }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ item.kepala_keluarga }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ item.alamat }}
                                    </td>
                                    <td class="px-6 py-4" v-if="can.admin">
                                        {{ jawaban(item.pertanyaan2) }}
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
