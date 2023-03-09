<script setup>
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js'
import { Pie } from 'vue-chartjs'
ChartJS.register(ArcElement, Tooltip, Legend)
// variabel Chart
const chartData = {
    labels: ['January', 'February', 'March'],
    datasets: [
        {
            label: 'Data Survey',
            data: [40, 20, 12],
            backgroundColor: ['#41B883', '#E46651', '#00D8FF'],
        }
    ]
}

const chartOptions = {
    responsive : true,
}
</script>

<template>
    <Pie
    id="my-chart-id"
    :options="chartOptions"
    :data="chartData"
    class="w-[400px]"
  />
</template>
