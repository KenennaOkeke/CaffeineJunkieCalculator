<template>
    <table class="min-w-full divide-y divide-gray-200 game-inputs">
      <thead class="bg-gray-50">
        <tr>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider game-inputs-greeting">
            Hello Player
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider game-inputs-descisions">
            Descisions
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="input in inputData.inputs" :key="input.name">
            <td class="px-6 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
            <input-label v-bind:inputData="input"></input-label>
          </td>
          <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500">
            <input-currency v-if="input.type === 'currency'" v-bind:inputData="input"></input-currency>
            <input-number v-if="input.type === 'number'" v-bind:inputData="input"></input-number>
            <input-select v-else-if="input.type === 'select'" v-bind:inputData="input"></input-select>
            <input-percentage v-else-if="input.type === 'percentage'" v-bind:inputData="input"></input-percentage>
            <p class="mt-2 text-sm text-red-600" :id="'inputDataError_' + input.name">{{input.error}}</p>
          </td>
        </tr>
      </tbody>
    </table>
</template>

<script>
import InputCurrency from './Inputs/Currency';
import InputSelect from './Inputs/Select';
import InputPercentage from './Inputs/Percentage';
import InputNumber from './Inputs/Number';
import InputLabel from './Inputs/Label';

export default {
    components: {
      InputCurrency,
      InputSelect,
      InputNumber,
      InputPercentage,
      InputLabel
    },
    props: ["inputData"],
}
</script>