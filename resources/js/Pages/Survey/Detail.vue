<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, defineProps } from 'vue';
import Swal from 'sweetalert2';

const props = defineProps({
    data: {
        type: Object,
        default: () => ({})
    },
    can: {
        type: Object,
        default: () => ({})
    }
})

function jawaban1(value) {
    var hasil = null;
    switch (value) {
        case 'a':
            hasil = "Pembangunan Infrastruktur Jalan"
            break;
        case 'b':
            hasil = "Penciptaan Lapangan Kerja"
            break;
        case 'c':
            hasil = "Bantuan Bibit Pertanian"
            break;
        case 'd':
            hasil = "Bantuan Pengembangan Wilayah"
            break;
        case 'e':
            hasil = "Pendidikan Yang Berkualitas"
            break;

        default:
            hasil = value
            break;
    }
    return hasil;
}
function jawaban2(value) {
    var hasil = null;
    if (value === 'a') hasil = "Mendukung";
    if (value === 'b') hasil = "Tidak Mendukung";
    if (value === 'c') hasil = "Tidak Tahu";

    return hasil;
}
const Form= useForm({});

function Hapus() {
    Swal.fire({
        title: 'Apakah Anda Ingin Menghapus Survey?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus Data!'
    }).then((value) => {
        if (value.isConfirmed) {
            Form.delete(route('Survey.delete', {id: props.data.id}))
        } else {
            Swal.fire('Dibatalkan')
        }
    })
}
function back()
{
    window.history.back();
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

                    <div
                        class="w-full max-w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">

                        <dl class="max-w-full text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                            <div class="flex flex-col pb-3">
                                <dt class="mb-1 text-gray-900 font-extrabold md:text-lg">Daerah Survey</dt>
                                <dd class="text-lg font-normal">Kabupaten : {{ data.lokasisurvey.kabupaten }}</dd>
                                <dd class="text-lg font-normal">Kecamatan : {{ data.lokasisurvey.kecamatan }}</dd>
                                <dd class="text-lg font-normal">Kelurahan/Desa : {{ data.lokasisurvey.kelurahan_desa }}</dd>
                                <dd class="text-lg font-normal">RT/RW : {{ data.rt_rw }}</dd>
                                <dd class="text-lg font-normal">TPS : {{ data.tps }}</dd>

                            </div>
                            <div class="flex flex-col py-3">
                                <dt class="mb-1 text-gray-900 font-normal md:text-lg">Nama Yang Ditemui : <span
                                        class="text-lg font-extrabold capitalize">{{ data.nama }}</span></dt>
                            </div>
                            <div class="flex flex-col py-3">
                                <dt class="mb-1 text-gray-900 font-normal md:text-lg">Nama Kepala Keluarga : <span
                                        class="text-lg font-extrabold capitalize">{{ data.kepala_keluarga }}</span></dt>
                            </div>
                            <div class="flex flex-col py-3">
                                <dt class="mb-1 text-gray-900 font-normal md:text-lg">Alamat : <span
                                        class="text-lg font-extrabold capitalize">{{ data.alamat }}</span></dt>
                            </div>
                            <div class="flex flex-col py-3">
                                <dt class="mb-1 text-gray-900 font-normal md:text-lg">NO. HP : <span
                                        class="text-lg font-extrabold capitalize">{{ data.no_hp }}</span></dt>
                            </div>
                            <div class="flex flex-col py-3">
                                <dt class="mb-1 text-gray-900 font-normal md:text-lg">Jumlah Memilih : <span
                                        class="text-lg font-extrabold capitalize">{{ data.jumlah_memilih }}</span></dt>
                            </div>
                            <div class="flex flex-col py-3">
                                <dt class="mb-1 text-gray-900 font-normal md:text-lg">Jawaban Pertanyaan 1 : </dt>
                                <dd class="text-lg font-extrabold capitalize"> {{ data.pertanyaan1 }}.{{
                                    jawaban1(data.pertanyaan1) }} </dd>
                            </div>
                            <div class="flex flex-col py-3">
                                <dt class="mb-1 text-gray-900 font-normal md:text-lg">Jawaban Pertanyaan 2 : </dt>
                                <dd class="text-lg font-extrabold capitalize">{{ data.pertanyaan2 }}.{{
                                    jawaban2(data.pertanyaan2) }}</dd>
                            </div>
                        </dl>

                        <div class="inline-flex rounded-md shadow-sm" role="group">
                            <Link :href="route('Survey.edit', {id: data.id})"
                                class="px-4 py-2 text-sm font-medium text-white bg-green-500 border border-gray-200 rounded-l-lg hover:bg-green-600  focus:z-10 focus:ring-2 ">
                                Edit
                            </Link>
                            <button @click="Hapus()" v-if="$page.props.auth.username == data.username_user || can.kecamatanDelete || $page.props.auth.lokasi == data.kecamatan"
                                class="px-4 py-2 text-sm font-medium text-white bg-red-500 border-t border-b border-gray-200 hover:bg-red-900  focus:z-10 focus:ring-2 ">
                                Hapus
                            </button>
                            <button @click="back()"
                                class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100  focus:z-10 focus:ring-2 ">
                                Kembali
                            </button>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout></template>
