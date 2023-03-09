<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import  BarVue  from '@/Components/Bar.vue';
const props = defineProps({
    can: {
        type: Object,
        default: () => ({}),
    },
    data: {
        type: Object,
        default: () => ({})
    }
})
console.log(props);


// Buat Bar
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $page.props.auth.user.name }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <BarVue class="2-96"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
