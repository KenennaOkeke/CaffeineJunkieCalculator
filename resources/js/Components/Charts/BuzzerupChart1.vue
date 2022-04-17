<template>
  <vue3-chart-js ref="chartRef" v-bind="{ ...barChart }" />
</template>

<script>
import Vue3ChartJs from "@j-t-mcc/vue3-chartjs";
import { ref } from 'vue'

// globally registered and available for all charts

export default {
  props: ["graphData"],
  name: "App",
  components: {
    Vue3ChartJs,
  },
  watch: {
    graphData: {
      deep: true,
      handler : 'updateBarChart'
    }
  },
  setup(props) {
    var vm = this;
    const chartRef = ref(null)

    const barChart = {
      type: "bar",
      // locally registered and available for this chart
      plugins: [],
      data: {
       labels: ['Percentage'],
        datasets: []
      },
      options: {
        plugins: {
          title: {
                display: true,
                text: 'Sales By Flavor'
            }
        },
        aspectRatio: 2,
        scales: {
           
        }
      },
    };
    const updateBarChart = () => {
      barChart.data.datasets = [{
          label: "Lemon Line",
          data: [props.graphData.ll],
          backgroundColor: [
            '#FFFF00',
          ],
          borderColor: [
            '#FFFF00',
          ],
          borderWidth: 1
      },{
          label: "Orange",
          data: [props.graphData.o],
          backgroundColor: [
            '#ED7D31',
          ],
          borderColor: [
            '#ED7D31',
          ],
          borderWidth: 1
      },{
          label: "Cherry",
          data: [props.graphData.c],
          backgroundColor: [
            '#FF0000',
          ],
          borderColor: [
            '#FF0000',
          ],
          borderWidth: 1
      },{
          label: "Fruit Punch",
          data: [props.graphData.fp],
          backgroundColor: [
            '#7030A0',
          ],
          borderColor: [
            '#7030A0',
          ],
          borderWidth: 1
      },{
          label: "Kiwi",
          data: [props.graphData.k],
          backgroundColor: [
            '#A9D18E',
          ],
          borderColor: [
            '#A9D18E',
          ],
          borderWidth: 1
      }]
        chartRef.value.update(250)
    }
    return {
      barChart,
      chartRef,
      updateBarChart
    };
  },
};
</script>