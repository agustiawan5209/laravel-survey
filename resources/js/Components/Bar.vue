<script setup>
import { Chart as ChartJS, ArcElement, Tooltip, Legend, Title} from 'chart.js'
import { Pie } from 'vue-chartjs';
import { defineProps } from 'vue';
ChartJS.register(ArcElement, Tooltip, Legend,Title)

const suara = defineProps({
    data: Object,
})
function hitungSuaraMendukung(value){
    var arr = [];
    for (let i = 0; i < value.length; i++) {
      if(value[i].pertanyaan2 == 'a'){
        arr.push(value.pertanyaan2);
      }

    }
    return arr.length;
}
function hitungSuaraTidakMendukung(value){
    var arr = [];
    for (let i = 0; i < value.length; i++) {
      if(value[i].pertanyaan2 == 'b'){
        arr.push(value.pertanyaan2);
      }

    }
    return arr.length;
}
function hitungSuaraBelumMemutuskan(value){
    var arr = [];
    for (let i = 0; i < value.length; i++) {
      if(value[i].pertanyaan2 == 'c'){
        arr.push(value.pertanyaan2);
      }

    }
    return arr.length;
}
// variabel Chart
const chartData = {
    labels: ['Medukung', 'Tidak Mendukung', 'Belum Memutuskan'],
    datasets: [
        {
            label: 'Data Survey',
            data: [hitungSuaraMendukung(suara.data),hitungSuaraTidakMendukung(suara.data), hitungSuaraBelumMemutuskan(suara.data) ],
            backgroundColor: ['#41B883', '#E46651', "#0080b1"],
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
    :width="300" :height="300"
  />
</template>
