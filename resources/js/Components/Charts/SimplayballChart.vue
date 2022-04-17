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
            'Concession Income',
            'Luxury Box Sales',
            'Playoff Ticket Sales',
            'Regular Season Ticket Sales'
        ],
        datasets: [{
            data: [0, 0, 0, 0],
            backgroundColor: [
            '#FFC000',
            '#ED7D31',
            '#A5A5A5',
            '#5B9BD5'
            ],
            hoverOffset: 4
        }]
      },
      options: {
        plugins: {
          title: {
                display: true,
                text: 'Gross Revenue'
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
         data: [props.graphData.concession_sales, props.graphData.luxury_box_sales, props.graphData.playoff_ticket_sales, props.graphData.regular_ticket_sales],
            backgroundColor: [
            '#FFC000',
            '#ED7D31',
            '#A5A5A5',
            '#5B9BD5'
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