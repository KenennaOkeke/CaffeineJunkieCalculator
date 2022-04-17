<template>
  <vue3-chart-js ref="chartRef" v-bind="{ ...lineChart }" />
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
      handler : 'updateLineChart'
    }
  },
  setup(props) {
    var vm = this;
    const chartRef = ref(null)

    const lineChart = {
      type: "scatter",
      // locally registered and available for this chart
      plugins: [],
      data: {
        label: {
          x: "a",
          y: "b"
        },
        datasets: [
          {
            label: "Total Revenue",
            data: props.graphData.revenue,
            fill: false,
            borderColor: "red",
            backgroundColor: "red",
            tension: 0,
            showLine: true
          },
          {
            label: "Cost",
            data: props.graphData.cost,
            fill: false,
            borderColor: "blue",
            backgroundColor: "blue",
            showLine: true
          },
          {
            label: "Profit",
            data: props.graphData.profit,
            fill: false,
            borderColor: "green",
            backgroundColor: "green",
            showLine: true,
          },
        ],
      },
      options: {
        plugins: {
          title: {
                display: true,
                text: 'Revenue and Cost'
            }
        },
        scales: {
            y: {
                ticks: {
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return '$' + value.toLocaleString();
                    },
                },
                title: {
                  display: true,
                  text: "Dollars"
                }
              },
            x: {
                ticks: {
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return value.toLocaleString();
                    }
                },
                title: {
                  display: true,
                  text: "Units"
                }
            },

        }
      },
    };
    const updateLineChart = () => {
      lineChart.data.datasets = [
          {
            label: "Total Revenue",
            data: props.graphData.revenue,
            fill: false,
            borderColor: "red",
            backgroundColor: "red",
            tension: 0,
            showLine: true
          },
          {
            label: "Cost",
            data: props.graphData.cost,
            fill: false,
            borderColor: "blue",
            backgroundColor: "blue",
            showLine: true
          },
          {
            label: "Profit",
            data: props.graphData.profit,
            fill: false,
            borderColor: "green",
            backgroundColor: "green",
            showLine: true,
          },
        ];
        chartRef.value.update(250)
    }
    return {
      lineChart,
      chartRef,
      updateLineChart
    };
  },
};
</script>