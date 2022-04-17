<template>
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th scope="col" colspan="2" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider game-outputs-title">
            Outcomes
          </th>
        </tr>
      </thead>
      <tbody>
        <template v-for="output in outputData.outputs" :key="output.name">
          <tr>
            <template v-if="output.showSingleValue == true">
                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500 text-right output-data" :colspan="output.colspan" :class="'outputData_' + output.name" :id="'outputData_' + output.name + '_0'" :t="output.type">
                  {{output.value}}
                </td>
            </template>
            <template v-else>
              <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900" :class="'outputData_' + output.name">
                <span class="pl-4" v-if="output.subItem1"></span>{{output.label}}
              </td>
                <template v-if="(output.valueCount)">
                  <template v-for="n in output.valueCount"  v-bind:key="n - 1">
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500 text-right output-data" :class="'outputData_' + output.name" :id="'outputData_' + output.name + '_' + (n - 1)" :t="output.type">
                      <template v-if="output.value">{{output.value[n - 1]}}</template>
                    </td>
                  </template>
                </template>
                <td v-else-if="!Array.isArray(output.value)" class="px-4 py-2 whitespace-nowrap text-sm text-gray-500 text-right output-data" :class="'outputData_' + output.name" :id="'outputData_' + output.name + '_0'" :t="output.type">
                  {{output.value}}
                </td>
              </template>
          </tr>
          <tr style="border:0;" v-if="output.spacingAfter">
            <td colspan="2" class="h-6"></td>
          </tr>
        </template>    
      </tbody>
    </table>
</template>

<script>
import InputCurrency from './Inputs/Currency';
import InputSelect from './Inputs/Select';
export default {
    components: {
      InputCurrency,
      InputSelect,
    },
    props: ["outputData"],
}
</script>