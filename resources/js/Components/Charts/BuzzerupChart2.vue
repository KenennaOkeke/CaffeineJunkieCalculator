<template>
  <vue3-chart-js ref="chartRef" v-bind="{ ...doughnutChart }" />
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
      handler : 'updateDoughnutChart'
    }
  },
  setup(props) {
    var vm = this;
    const chartRef = ref(null)

    const doughnutChart = {
      type: "doughnut",
      // locally registered and available for this chart
      plugins: [],
      data: {
        labels: [
            'Minnesota',
            'California',
            'Texas'
        ],
        datasets: [{
            data: [0, 0, 0, 0],
            backgroundColor: [
            'lightblue',
            'orange',
            'gray'
            ],
            hoverOffset: 4
        }]
      },
      options: {
        plugins: {
          title: {
                display: true,
                text: 'Sales by State'
            }
        },
        aspectRatio: 2,
        scales: {
           
        }
      },
    };
    const updateDoughnutChart = () => {
      doughnutChart.data.datasets = [
       {
         data: [props.graphData.mn, props.graphData.ca, props.graphData.tx],
            backgroundColor: [
            'lightblue',
            'orange',
            'gray'
            ],
            hoverOffset: 4
       }
      ]
        chartRef.value.update(250)
    }
    return {
      doughnutChart,
      chartRef,
      updateDoughnutChart
    };
  },
};
</script>