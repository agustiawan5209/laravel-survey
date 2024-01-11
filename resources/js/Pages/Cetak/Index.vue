<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, defineProps, watch } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import PaginationVue from "@/Components/Pagination.vue";
import axios from 'axios';
import Swal from 'sweetalert2';
import { library } from "@fortawesome/fontawesome-svg-core";
import { faBars } from "@fortawesome/free-solid-svg-icons";
import {
    faTwitter,
    faFacebook,
    faStackOverflow,
    faGithub
} from "@fortawesome/free-brands-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

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
const searchForm = useForm({
    kabupaten: null,
    lokasi: null,
    dataSurvey_id: null,
});

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
    CariData.get(route('Cetak.Index', { kabupaten: value, kecamatan: props.filter.kecamatan, desa: props.filter.desa }), {
        preserveState: true,
        preserveScroll: true,
    })
    searchForm.kabupaten = value;

})
watch(Kecamatan, (value) => {
    CariData.get(route('Cetak.Index', { kabupaten: props.filter.kabupaten, kecamatan: value, desa: props.filter.desa }), {
        preserveState: true,
        preserveScroll: true,
    })
})
watch(Desa, (value) => {
    CariData.get(route('Cetak.Index', { kabupaten: props.filter.kabupaten, kecamatan: props.filter.kecamatan, desa: value }), {
        preserveState: true,
        preserveScroll: true,
    })
})

//
const uploadPercentage = ref(0);
let config = {
    responseType: 'blob',
    onDownloadProgress: function (progressEvent) {
        uploadPercentage.value = Math.round((progressEvent.loaded * 100) / progressEvent.total)
        // console.log(uploadPercentage.value) // this works fine but how do I update the initial value from here?
    }
}
function cetakEXCEL(e) {
    // console.log(uploadPercentage.value)

    axios
        .get(route('Cetak.DataSurvey', { kabupaten: searchForm.kabupaten}), config)
        .then(response => {
            // console.log(response)
            const url = window.URL.createObjectURL(new Blob([response.data]));
            const link = document.createElement('a');
            link.href = url;
            link.setAttribute('download', 'file.xlsx');
            document.body.appendChild(link);
            link.click();
            // Mostly the same, I was just experimenting with different approaches, tried link.click, iframe and other solutions
        }).catch(error => console.log(error))
}
function cetakPDF() {
   // console.log(uploadPercentage.value)

   axios
        .get(route('Cetak.DataSurveyPDF', { lokasi: searchForm.lokasi, dataSurvey_id: searchForm.dataSurvey_id}), config)
        .then(response => {
            // console.log(response)
            const url = window.URL.createObjectURL(new Blob([response.data]));
            const link = document.createElement('a');
            link.href = url;
            link.setAttribute('download', 'file.pdf');
            document.body.appendChild(link);
            link.click();
            // Mostly the same, I was just experimenting with different approaches, tried link.click, iframe and other solutions
        }).catch(error => console.log(error))
}


</script>

<template>
    <Head title="Survey" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $page.props.auth.user.name }}</h2>
        </template>

        <!-- Content -->
        <div class="py-2 md:py-5">
            <div class="max-w-full mx-auto sm:px-3 lg:px-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <!-- Table -->

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg py-5 px-3">

                        <div class="flex items-center justify-between pb-2">
                            <div class="flex item-center justify-start">
                                <div v-if="can.adminView">
                                    <label for="countries"
                                        class="block mb-2 text-xs md:text-sm font-medium text-gray-900 ">List
                                        Kabupaten</label>
                                    <select id="countries" v-model="Kabupaten"
                                        class="bg-gray-50 px-3 md:px-7 border border-gray-300 text-gray-900 text-xs md:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

                                        <option :value="item.nama" v-for="item in kabupaten">{{ item.nama }}</option>
                                    </select>
                                </div>
                                <!-- <div v-if="can.adminView || can.kabupatenView">
                                        <label for="countries"
                                            class="block mb-2 text-xs md:text-sm font-medium text-gray-900 ">List
                                            Kecamatan</label>
                                        <select id="countries" v-model="Kecamatan"
                                            class="bg-gray-50 px-3 md:px-7 border border-gray-300 text-gray-900 text-xs md:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

                                            <option :value="item.nama" v-for="item in kecamatan">{{ item.nama }}</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="countries"
                                            class="block mb-2 text-xs md:text-sm font-medium text-gray-900 ">List
                                            Kelurahan/Desa</label>
                                        <select id="countries" v-model="Desa"
                                            class="bg-gray-50 px-3 md:px-7 border border-gray-300 text-gray-900 text-xs md:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

                                            <option :value="item.nama" v-for="item in desa" class="text-xs">{{ item.nama }}
                                            </option>

                                        </select>
                                    </div> -->
                            </div>
                            <div class="inline-flex rounded-md shadow-sm" role="group">
                                <div class="inline-flex rounded-md shadow-sm" role="group">
                                    <button type="button" @click="cetakEXCEL()"
                                        class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                                        Cetak Excel
                                    </button>
                                    <button type="button" @click="cetakPDF()"
                                        class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                                        Cetak PDF
                                    </button>
                                </div>
                            </div>
                        </div>
                        <table class="w-full text-sm text-left text-gray-500 ">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
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
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in data.data" :key="item.id" :index="index"
                                    class="bg-white border-b  hover:bg-gray-50 ">
                                    <td class="md:px-6 md:py-4 border border-gray-300 px-3 text-xs md:text-sm">
                                        {{ (data.current_page - 1) * data.per_page + index + 1 }}
                                    </td>
                                    <th scope="row"
                                        class="md:px-6 md:py-4 border border-gray-300 px-3 text-xs md:text-sm font-medium text-gray-900 whitespace-nowrap ">
                                        {{ item.kabupaten }}
                                    </th>
                                    <td class="md:px-6 md:py-4 border border-gray-300 px-3 text-xs md:text-sm">
                                        {{ item.kecamatan }}
                                    </td>
                                    <td class="md:px-6 md:py-4 border border-gray-300 px-3 text-xs md:text-sm">
                                        {{ item.kelurahan_desa }}
                                    </td>
                                    <td class="md:px-6 md:py-4 border border-gray-300 px-3 text-xs md:text-sm">
                                        {{ item.estimasi }}
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
