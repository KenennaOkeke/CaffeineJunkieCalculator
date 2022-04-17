<template>
  <table class="min-w-full divide-y divide-gray-200">
      <tbody>
          <tr>
              <td colspan="2" class="px-6 py-2 whitespace-nowrap text-sm font-medium text-gray-900">Three Ways to Win!</td>
          </tr>
          <tr>
              <td colspan="2" class="px-6 py-2 whitespace-nowrap text-sm font-medium text-gray-900">Score the highest:</td>
          </tr>
          <tr>
              <td class="px-6 py-2 whitespace-nowrap text-sm font-medium text-gray-900">First Year Profit</td>
              <td>{{graphData.fyp}}</td>
          </tr>
          <tr>
              <td class="px-6 py-2 whitespace-nowrap text-sm font-medium text-gray-900">Angel Valuation</td>
              <td>{{graphData.av}}</td>
          </tr>
          <tr>
              <td class="px-6 py-2 whitespace-nowrap text-sm font-medium text-gray-900">Annual Return on Investment</td>
              <td>{{graphData.roi}}</td>
          </tr>
      </tbody>
  </table>
</template>

<script>
export default {
  props: ["graphData"],
  name: "App",
  watch: {
  }
};
</script>