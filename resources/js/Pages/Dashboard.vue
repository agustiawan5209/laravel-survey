<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import BarVue from '@/Components/Bar.vue';
import Modal from '@/Components/Modal.vue';
import InputError from '@/Components/InputError.vue';
const props = defineProps({
    can: {
        type: Object,
        default: () => ({}),
    },
    user: {
        type: Object,
        default: () => ({})
    },
    modal: {
        type: Boolean,
        default: false
    },

    survey: {
        type: Object,
        default: () => ({})
    },

})

const Form = useForm({
    nama: props.user.name,
    alamat: "",
    no_hp: "",
    kabupaten: "",
    kecamatan: "",
    kelurahan: "",
    desa: "",
})

function submit() {
    Form.post(route('Relawan.store'), {
        onError: error => console.log(error)
    });
}


// Buat Bar
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Akun : {{ $page.props.auth.user.name }}</h2>
        </template>
        <div class="md:py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-full text-center flex flex-col justify-center items-center">

                        <section class="w-full">
                            <div class="container px-6 py-16 mx-auto text-center  flex justify-center items-center">
                                <!-- <img alt="No alt" :src="'image/logo.png'" class="w-52" /> -->
                                <h1
                                class="my-4 text-2xl font-extrabold leading-none tracking-tight text-blue-900 md:text-5xl lg:text-4xl dark:text-white ">
                                FORM PENGGALANGAN HARAPAN</h1>
                            </div>
                          </section>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-full px-5 md:px-0 md:w-[500px]">

                            <BarVue class="w-96" :data="survey" />
                        </div>

                </div>
            </div>
            <div class="md:py-6">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                </div>
                </div>


                <Modal :show="props.modal">

                    <div class="px-5 py-3">
                        <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Untuk Melanjutkan. Mohon
                            Mengisi Form Relawan Di Bawah Ini</h2>
                        <form @submit="submit">
                            <div class="mb-6">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white capitalize">Nama</label>
                                <input type="text" id="nama" v-model="Form.nama"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder=".............">
                                <InputError :message="Form.errors.nama" />
                            </div>
                            <div class="mb-6">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white capitalize">alamat</label>
                                <input type="text" id="alamat" v-model="Form.alamat"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder=".............">
                                <InputError :message="Form.errors.alamat" />

                            </div>
                            <div class="mb-6">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white capitalize">Nomor
                                    HP</label>
                                <input type="text" id="no_hp" v-model="Form.no_hp"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder=".............">
                                <InputError :message="Form.errors.no_hp" />

                            </div>
                            <div class="mb-6">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white capitalize">kabupaten</label>
                                <input type="text" id="kabupaten" v-model="Form.kabupaten"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder=".............">
                                <InputError :message="Form.errors.kabupaten" />

                            </div>
                            <div class="mb-6">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white capitalize">kecamatan</label>
                                <input type="text" id="kecamatan" v-model="Form.kecamatan"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder=".............">
                                <InputError :message="Form.errors.kecamatan" />

                            </div>
                            <div class="mb-6">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white capitalize">kelurahan</label>
                                <input type="text" id="kelurahan" v-model="Form.kelurahan"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder=".............">
                                <InputError :message="Form.errors.kelurahan" />

                            </div>
                            <div class="mb-6">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white capitalize">desa</label>
                                <input type="text" id="desa" v-model="Form.desa"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder=".............">
                                <InputError :message="Form.errors.desa" />

                        </div>
                        <ul>
                            <li v-for="item in Form.errors">
                                {{ item }}
                            </li>
                        </ul>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
                    </form>

                </div>
            </Modal>


        </div>
</AuthenticatedLayout></template>
