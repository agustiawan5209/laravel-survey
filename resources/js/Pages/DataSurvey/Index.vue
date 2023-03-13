<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, defineProps, watch } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import PaginationVue from "@/Components/Pagination.vue";
import axios from 'axios';
import Swal from 'sweetalert2';

const props = defineProps({
    can: {
        type: Object,
        default: () => ({})
    },
    data: {
        type: Object,
        default: () => ({})
    },
    kabupaten: {
        type: Object,
        default: () => ({})
    },
    kecamatan: {
        type: Object,
        default: () => ({})
    },
    desa: {
        type: Object,
        default: () => ({})
    },

    filter: {
        type: Object,
        default: () => ({})
    },

})
const search = ref('');
const searchForm = useForm({});

watch(search, (value) => {
    searchForm.get(route('DataSurvey.index', {
        search: value
    }), {
        preserveState: true,
    })

})
// Fungsi Cari DataSurvey
const CariData = useForm({});
// {
//     kabupaten: null,
//     kecamatan: null,
//     desa: null,
// }
const Kabupaten = ref(props.filter.kabupaten);
const Kecamatan = ref(props.filter.kecamatan);
const Desa = ref(props.filter.desa);

watch(Kabupaten, (value) => {
    CariData.get(route('DataSurvey.index', { kabupaten: value, kecamatan: props.filter.kecamatan, desa: props.filter.desa }), {
        preserveState: true,
        preserveScroll: true,
    })

})
watch(Kecamatan, (value) => {
    CariData.get(route('DataSurvey.index', { kabupaten: props.filter.kabupaten, kecamatan: value, desa: props.filter.desa }), {
        preserveState: true,
        preserveScroll: true,
    })
})
watch(Desa, (value) => {
    CariData.get(route('DataSurvey.index', { kabupaten: props.filter.kabupaten, kecamatan: props.filter.kecamatan, desa: value }), {
        preserveState: true,
        preserveScroll: true,
    })
})
function hitungSuaraMendukung(value) {
    var arr = [];
    for (let i = 0; i < value.length; i++) {
        if (value[i].pertanyaan2 == 'a') {
            arr.push(value.pertanyaan2);
        }

    }
    return arr.length;
}
function hitungSuaraTidakMendukung(value) {
    var arr = [];
    for (let i = 0; i < value.length; i++) {
        if (value[i].pertanyaan2 == 'b') {
            arr.push(value.pertanyaan2);
        }

    }
    return arr.length;
}
const deleteForm = useForm({});
function Hapus(id, kabupaten) {
    console.log(id)
    Swal.fire({
        title: 'Apakah Anda Ingin Menghapus Data Survey?',
        text: 'Data Relawan Dan Hasil Survey Juga Terhapus!!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus Data!'
    }).then((value) => {
        if (value.isConfirmed) {
            deleteForm.delete(route('DataSurvey.delete', { id: id }))
        } else {
            Swal.fire('Dibatalkan')
        }
    })
}
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

                            <div>
                                <Link :href="route('DataSurvey.create')">
                                <PrimaryButton id="dropdownRadioButton" data-dropdown-toggle="dropdownRadio"
                                    class="!bg-blue-500 active:bg-blue-600 hover:bg-blue-400" type="button">
                                    Tambah
                                </PrimaryButton>
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
                                <input type="text" id="table-search" v-model="search"
                                    class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Masukkan Pencarian">
                            </div>
                        </div>
                        <div class="flex items-center justify-between pb-2">
                            <div class="flex item-center justify-start">
                                <div v-if="can.adminView">
                                    <label for="countries"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">List
                                        Kabupaten</label>
                                    <select id="countries" v-model="Kabupaten"
                                        class="bg-gray-50 px-7 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                        <option :value="item.nama" v-for="item in kabupaten">{{ item.nama }}</option>
                                    </select>
                                </div>
                                <div v-if="can.adminView">
                                    <label for="countries"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">List
                                        Kecamatan</label>
                                    <select id="countries" v-model="Kecamatan"
                                        class="bg-gray-50 px-7 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                        <option :value="item.nama" v-for="item in kecamatan">{{ item.nama }}</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="countries"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">List
                                        Kelurahan/Desa</label>
                                    <select id="countries" v-model="Desa"
                                        class="bg-gray-50 px-7 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                        <option :value="item.nama" v-for="item in desa" class="text-xs">{{ item.nama }}
                                        </option>

                                    </select>
                                </div>
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
                                        Estimasi
                                    </th>
                                    <th scope="col" class="px-6 py-3 capitalize">
                                        Detail
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in data.data" :key="item.id" :index="index"
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="w-4 p-4">
                                        {{ (data.current_page - 1) * data.per_page + index + 1 }}
                                    </td>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ item.kabupaten }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ item.kecamatan }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ item.kelurahan_desa }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ item.estimasi }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <Link
                                            :href="route('DataSurvey.show', { member: encodeURI(item.estimasi), id: item.id, name: item.kabupaten })">
                                        <PrimaryButton type="button"
                                            class="bg-blue-500 hover:bg-blue-600 text-white active:bg-blue-400 focus:bg-blue-700">
                                            Detail</PrimaryButton>
                                        </Link>
                                        <Link
                                            :href="route('DataSurvey.edit', { member: encodeURI(item.estimasi), id: item.id, name: item.kabupaten })"
                                            v-if="can.adminEdit">
                                        <PrimaryButton type="button"
                                            class="bg-green-500 hover:bg-green-600 text-white active:bg-green-400 focus:bg-green-700">
                                            Edit</PrimaryButton>
                                        </Link>
                                        <PrimaryButton type="button" v-if="can.adminEdit"
                                            @click="Hapus(item.id, item.kabupaten)"
                                            class="bg-red-500 hover:bg-red-600 text-white active:bg-red-400 focus:bg-red-700">
                                            Hapus</PrimaryButton>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <PaginationVue :links="data.links" />

                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
