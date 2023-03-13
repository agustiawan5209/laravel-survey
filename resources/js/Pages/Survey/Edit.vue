<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { ref, defineProps } from 'vue';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    lokasi: {
        type: Object,
        default: () => ({})
    },
    can: {
        type: Object,
        default: () => ({})
    },
    kelurahan: {
        type: Object,
        default: () => ({})
    },
    data: {
        type: Object,
        default: () => ({})
    },
});
const Form = useForm({
    kabupaten: props.data.lokasisurvey.kabupaten,
    kecamatan: props.data.lokasisurvey.kecamatan,
    kelurahan_desa: props.data.lokasisurvey.kelurahan_desa,
    nama: props.data.nama,
    kepala_keluarga: props.data.kepala_keluarga,
    alamat: props.data.alamat,
    no_hp: props.data.no_hp,
    jumlah_memilih: props.data.jumlah_memilih,
    pertanyaan1: props.data.pertanyaan1,
    textpertanyaan1: props.data.pertanyaan1,
    pertanyaan2: props.data.pertanyaan2,
    rt_rw: props.data.rt_rw,
    tps: props.data.tps,
})
if(props.can.kecamatanView){
    Form.kabupaten = props.lokasi.kabupaten;
    Form.kecamatan = props.lokasi.nama;
}else if(props.can.adminView){
    Form.kabupaten = props.lokasi.kabupaten;
    Form.kecamatan = props.lokasi.kecamatan;
    Form.kelurahan_desa = props.lokasi.kelurahan_desa;
}

function submit() {
    Swal.fire({
        title: 'Simpan Data',
        text: 'Cek Inputan Sebelumnya',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Simpan Data!'
    }).then((value) => {
        if (value.isConfirmed) {
            Form.put(route('Survey.update', {id: props.data.id}))
        } else {
            Swal.fire('Dibatalkan')
            console.log('false')
        }
    })
}

</script>

<template>
    <AuthenticatedLayout>

        <Head title="Survey" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Survey</h2>
            <ul class="max-w-md space-y-1 text-gray-500 list-none list-inside dark:text-gray-400" v-if="can.relawanView" >
                <li>
                    Kabupaten : {{ props.lokasi.kabupaten }}
                </li>
                <li>
                    Kecamatan : {{ props.lokasi.kecamatan }}
                </li>
                <li>
                    Kelurahan/Desa : {{ props.lokasi.kelurahan_desa }}
                </li>
            </ul>
            <ul class="max-w-md space-y-1 text-gray-500 list-none list-inside dark:text-gray-400" v-if="can.kecamatanView" >
                <li>
                    Kabupaten : {{ props.lokasi.kabupaten }}
                </li>
                <li>
                    Kecamatan : {{ props.lokasi.nama }}
                </li>
            </ul>

        </template>
        <!-- Content -->
        <div class="py-5 md:py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <!-- Table -->

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg py-5 px-3">

                        <form @submit.prevent="submit">
                            <div class="mb-6" v-if="can.kecamatanView">
                                <div >
                                    <label for="countries"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelurahan/Desa</label>
                                    <select id="countries" v-model="Form.kelurahan_desa"
                                        class="bg-gray-50 px-7 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                        <option :value="item.nama" v-for="item in kelurahan">{{ item.nama }}</option>
                                    </select>
                                </div>
                                <InputError :message="Form.errors.kelurahan_desa" />
                            </div>
                            <div class="mb-6 flex justify-center items-center w-full gap-4">

                                <div class="w-1/2">
                                    <label for="nama"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">RT/RW</label>
                                    <input type="text" id="nama" v-model="Form.rt_rw"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="................">
                                    <InputError :message="Form.errors.rt_rw" />
                                </div>
                                <div class="w-1/2">
                                    <label for="nama"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                                        TPS</label>
                                    <input type="text" id="nama" v-model="Form.tps"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="................">
                                    <InputError :message="Form.errors.tps" />

                                </div>
                            </div>
                            <div class="mb-6">
                                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                    Yang Ditemui</label>
                                <input type="text" id="nama" v-model="Form.nama"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="................">
                                <InputError :message="Form.errors.nama" />

                            </div>
                            <div class="mb-6">
                                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                    Kepala Keluarga</label>
                                <input type="text" id="nama" v-model="Form.kepala_keluarga"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="....................">
                                <InputError :message="Form.errors.kepala_keluarga" />

                            </div>
                            <div class="mb-6">
                                <label for="alamat"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat
                                    Lengkap</label>
                                <input type="text" id="alamat" v-model="Form.alamat"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="....................">
                                <InputError :message="Form.errors.alamat" />

                            </div>
                            <div class="mb-6">
                                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No.
                                    Telpon</label>
                                <input type="tel" id="tel" v-model="Form.no_hp"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="....................">
                                <InputError :message="Form.errors.no_hp" />

                            </div>
                            <div class="mb-6">
                                <label for="nama"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah Anggota Yang
                                    Memilih</label>
                                <input type="number" id="tel" v-model="Form.jumlah_memilih"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="....................">
                                <InputError :message="Form.errors.jumlah_memilih" />

                            </div>

                            <!-- Tanya Jawab -->

                            <div class="mb-5">
                                <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">1. Menurut Bapak/Ibu, Kira-kira
                                    apa
                                    masalah yang paling penting di wilayah tinggal bapak/ibu?</h3>
                                <InputError :message="Form.errors.pertanyaan1" />

                                <ul
                                    class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input id="list-radio-license" type="radio" v-model="Form.pertanyaan1" value="a"
                                                name="list-radio"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="list-radio-license"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">a.
                                                Pembangunan
                                                Infrastruktur Jalan</label>
                                        </div>
                                    </li>
                                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input id="list-radio-id" type="radio" v-model="Form.pertanyaan1" value="b"
                                                name="list-radio"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="list-radio-id"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">b.
                                                Penciptaan
                                                Lapangan Kerja</label>
                                        </div>
                                    </li>
                                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input id="list-radio-millitary" type="radio" v-model="Form.pertanyaan1"
                                                value="c" name="list-radio"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="list-radio-millitary"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">c.
                                                Bantuan
                                                Bibit Pertanian</label>
                                        </div>
                                    </li>
                                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input id="list-radio-passport" type="radio" v-model="Form.pertanyaan1"
                                                value="d" name="list-radio"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="list-radio-passport"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">d.
                                                Bantuan
                                                Pengembangan Nelayan</label>
                                        </div>
                                    </li>
                                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input id="list-radio-passport" type="radio" v-model="Form.pertanyaan1"
                                                value="e" name="list-radio"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="list-radio-passport"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">e.
                                                Pendidikan
                                                Dan kesehatan Yang Berkualitas</label>
                                        </div>
                                    </li>
                                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                        <div class="mb-6">
                                            <label for="nama"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Masalah
                                                Lainnya</label>
                                            <input type="text" id="text" v-model="Form.textpertanyaan1"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="....................">
                                            <InputError :message="Form.errors.textpertanyaan1" />

                                        </div>
                                    </li>
                                </ul>

                            </div>
                            <div class="mb-5">
                                <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">2. Apakah Bapak/Ibu Mendukung
                                    ANDI PALALLOI TABRANG bersama PARTAI NASDEM Menjalankan Program Anak Kampung Membawa
                                    Perubahan Dengan Menjemput Dan Memperjuangkan Suara Aspirasi Masyarakat Ketika Terpilih
                                    Sebagai Anggota DPR-RI?</h3>
                                <InputError :message="Form.errors.pertanyaan2" />

                                <ul
                                    class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input id="list-radio-license" type="radio" v-model="Form.pertanyaan2" value="a"
                                                name="pertanyaan2"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="list-radio-license"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">a.
                                                Mendukung</label>
                                        </div>
                                    </li>
                                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input id="list-radio-id" type="radio" v-model="Form.pertanyaan2" value="b"
                                                name="pertanyaan2"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="list-radio-id"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">b.
                                                Tidak Mendukung</label>
                                        </div>
                                    </li>
                                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input id="list-radio-millitary" type="radio" v-model="Form.pertanyaan2"
                                                value="c" name="pertanyaan2"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="list-radio-millitary"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">c.
                                                Belum Memutuskan</label>
                                        </div>
                                    </li>
                                </ul>

                            </div>
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan
                                Survey</button>
                        </form>

                    </div>

                </div>
            </div>
        </div>
</AuthenticatedLayout></template>
