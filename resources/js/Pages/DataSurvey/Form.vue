<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { ref, defineProps, watch } from 'vue';
import InputError from '@/Components/InputError.vue';
import axios from 'axios';
const props = defineProps({
    lokasi: {
        type: Object,
    },
    lokasiKabupaten: {
        type: Object,
    },
    can: {
        type: Object,
        default: () => ({})
    },

    user_kecamatan: {
        type: Object,
        default: () => ({})
    },



});
// console.log(props.lokasi)
const Form = useForm({
        kabupaten: "",
        kecamatan: "",
        kelurahan_desa: "",
        jumlah_kk: "",
        estimasi: "",
        relawan: '',
    })


if (props.can.kecamatanView) {
   Form.kabupaten = props.user_kecamatan.kecamatan.kabupaten;
   Form.kecamatan = props.user_kecamatan.kecamatan.nama
}
if(props.can.kabupatenView){
    Form.kabupaten = props.user_kecamatan.kabupaten.nama;
}
const VarKabupaten = ref(null)
const VarKecamatan = ref(null)

function submit() {
    Swal.fire({
        title: 'Simpan Data',
        text: 'Cek Inputan Anda Terlebih Dahulu!!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Simpan Data!'
    }).then((value) => {
        if (value.isConfirmed) {
            Form.post(route('DataSurvey.store'))
        } else {
            Swal.fire('Dibatalkan')
            console.log('false')
        }
    })
}
const getKabupaten = ref(null)
const getKecamatan = ref({});
const getKelurahan = ref({});
axios.get(route('getKabupaten'))
    .then(res => {
        getKabupaten.value = res.data

    });


watch(VarKabupaten, (value) => {
    axios.get(route('getKecamatan', { id: value }))
        .then(res => {
            getKecamatan.value = res.data
            Form.kabupaten = value
        })
})
watch(VarKecamatan, (value) => {
    axios.get(route('getKelurahan', { id: value }))
        .then(res => {
            getKelurahan.value = res.data
            Form.kecamatan = value
        })
})
</script>

<template>
    <AuthenticatedLayout>

        <Head title="Survey" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Form Input Lokasi Data Survey</h2>

            <ul class="max-w-md space-y-1 text-gray-500 list-none list-inside " v-if="can.kecamatanView">
                <li>
                    Kabupaten : {{ lokasi.kabupaten }}
                </li>
                <li>
                    Kecamatan : {{ lokasi.nama }}
                </li>
            </ul>
            <ul class="max-w-md space-y-1 text-gray-500 list-none list-inside " v-if="can.kabupatenView">
                <li>
                    Kabupaten : {{ lokasiKabupaten.nama }}
                </li>
            </ul>

        </template>
        <!-- Content -->
        <div class="py-5 md:py-6">
            <div class="max-w-full mx-auto sm:px-3 lg:px-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <!-- Table -->

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg py-5 px-3">

                        <form @submit.prevent="submit">

                            <div class="mb-6">
                                <div v-if="can.adminView">
                                    <label for="countries"
                                        class="block mb-2 text-sm font-medium text-gray-900 ">List
                                        Kabupaten</label>
                                    <select id="countries" v-model="VarKabupaten"
                                        class="bg-gray-50 px-7 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

                                        <option :value="item.id" v-for="item in getKabupaten">{{ item.name }}</option>
                                    </select>
                                </div>
                                <div v-if="can.kabupatenView">
                                    <div >
                                        <label for="countries"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Kabupaten</label>
                                            <input type="tel" id="tel" v-model="Form.kabupaten"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                            placeholder="....................">
                                    </div>
                                </div>
                                <InputError :message="Form.errors.kabupaten" />
                            </div>
                            <div class="mb-6" v-if="can.adminView">
                                <div>
                                    <label for="countries"
                                        class="block mb-2 text-sm font-medium text-gray-900 ">List
                                        Kecamatan</label>
                                    <select id="countries" v-model="VarKecamatan"
                                        class="bg-gray-50 px-7 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

                                        <option :value="item.id" v-for="item in getKecamatan">{{ item.name }}</option>
                                    </select>
                                </div>
                                <InputError :message="Form.errors.kecamatan" />
                            </div>
                            <div class="mb-6" v-else-if="can.kabupatenView || can.kecamatanView">
                                <div >
                                    <label for="countries"
                                        class="block mb-2 text-sm font-medium text-gray-900 ">Kecamatan</label>
                                        <input type="tel" id="tel" v-model="Form.kecamatan"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                        placeholder="....................">
                                </div>
                                <InputError :message="Form.errors.kecamatan" />
                            </div>
                            <!-- Admin View -->
                            <div class="mb-6" v-if="can.adminView">
                                <div >
                                    <label for="countries"
                                        class="block mb-2 text-sm font-medium text-gray-900 ">Kelurahan/Desa</label>
                                    <select id="countries" v-model="Form.kelurahan_desa"
                                        class="bg-gray-50 px-7 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

                                        <option :value="item.id" v-for="item in getKelurahan">{{ item.name }}</option>
                                    </select>
                                </div>
                                <InputError :message="Form.errors.kelurahan_desa" />
                            </div>
                            <!-- Kecamatan View -->
                            <div class="mb-6" v-if="can.kecamatanView || can.kabupatenView">
                                <div >
                                    <label for="countries"
                                        class="block mb-2 text-sm font-medium text-gray-900 ">Kelurahan/Desa</label>
                                        <input type="tel" id="tel" v-model="Form.kelurahan_desa"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                        placeholder="....................">
                                </div>
                                <InputError :message="Form.errors.kelurahan_desa" />
                            </div>
                            <div class="mb-6">
                                <label for="kabupaten"
                                    class="block mb-2 text-sm font-medium text-gray-900 ">Jumlah KK</label>
                                <input type="tel" id="tel" v-model="Form.jumlah_kk"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    placeholder="....................">
                                <InputError :message="Form.errors.jumlah_kk" />

                            </div>
                            <div class="mb-6">
                                <label for="kabupaten"
                                    class="block mb-2 text-sm font-medium text-gray-900 ">Estimasi
                                    Rumah</label>
                                <input type="number" id="tel" v-model="Form.estimasi"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    placeholder="....................">
                                <InputError :message="Form.errors.estimasi" />

                            </div>
                            <div class="w-1/2">
                                <label for="kabupaten"
                                    class="block mb-2 text-sm font-medium text-gray-900 ">Jumlah
                                    Relawan</label>
                                <input type="text" id="kabupaten" v-model="Form.relawan"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    placeholder="................">
                                <InputError :message="Form.errors.relawan" />
                            </div>
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Simpan
                                Survey</button>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
