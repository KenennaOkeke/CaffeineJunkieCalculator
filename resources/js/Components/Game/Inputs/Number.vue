<template>
    <div class="mt-1 relative rounded-md shadow-sm">

              <input type="number" :min="inputData.min" :max="inputData.max" :value="inputData.default" :placeholder="inputData.placeholder" :id="'inputData_' + inputData.name" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md" aria-describedby="" />


            </div>
</template>

<script>
export default {
    props: ["inputData"],
}
</script>