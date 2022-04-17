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
                text: 'Metrics %'
            }
        },
        aspectRatio: 2,
        scales: {
           
        }
      },
    };
    const updateBarChart = () => {
      barChart.data.datasets = [{
          label: "Return on Invested Assets",
          data: [props.graphData.roi],
          backgroundColor: [
            '#4472C4',
          ],
          borderColor: [
            '#4472C4',
          ],
          borderWidth: 1
      },{
          label: "Profit Margin",
          data: [props.graphData.margin],
          backgroundColor: [
            '#4472C4',
          ],
          borderColor: [
            '#4472C4',
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