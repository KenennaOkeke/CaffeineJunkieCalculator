<template>
    <div class="mt-1 relative rounded-md shadow-sm">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span class="text-gray-500 sm:text-sm">
                  $
                </span>
              </div>
              <input type="number" :min="inputData.min" :max="inputData.max" :placeholder="inputData.placeholder" :id="'inputData_' + inputData.name" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md" aria-describedby="price-currency" />
              <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                <span class="text-gray-500 sm:text-sm" id="price-currency">
                  USD
                </span>
              </div>
            </div>
</template>

<script>
export default {
    props: ["inputData"],
}
</script>