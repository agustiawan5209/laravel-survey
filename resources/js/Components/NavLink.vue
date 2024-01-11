<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() =>
    props.active
        ?  'bg-white px-8 py-2 inline-flex items-center text-base font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
        : ' bg-transparent px-8 py-2 inline-flex items-center  text-base font-medium leading-5 text-white hover:text-blue-300 hover:border-gray-300 focus:outline-none focus:text-gray-300 focus:border-gray-300 transition duration-150 ease-in-out'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
