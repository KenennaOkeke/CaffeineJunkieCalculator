<template>
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="background: red;color: white;font-weight: bold;">
            Hello Player {{inputData.user_name}}
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="background: blue;color: white;font-weight: bold;">
            Descisions
          </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="px-6 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
            Price (Must be between $5.00 and $9.99)
          </td>
          <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500">
            <div class="mt-1 relative rounded-md shadow-sm">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span class="text-gray-500 sm:text-sm">
                  $
                </span>
              </div>
              <input type="text" value="5.00" name="price" id="price" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="0.00" aria-describedby="price-currency" />
              <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                <span class="text-gray-500 sm:text-sm" id="price-currency">
                  USD
                </span>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td class="px-6 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
            Quality of materials (Select from this list)
          </td>
          <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500">
            <select id="location" name="location" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
              <option></option>
              <option selected>$2.50</option>
              <option>$3.00</option>
              <option>$3.50</option>
              <option>$4.00</option>
            </select>
          </td>
        </tr>
        <tr>
          <td class="px-6 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
            Advertising Dollars
          </td>
          <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500">
            <div class="mt-1 relative rounded-md shadow-sm">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span class="text-gray-500 sm:text-sm">
                  $
                </span>
              </div>
              <input value="500.00" type="text" name="price" id="price" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="0.00" aria-describedby="price-currency" />
              <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                <span class="text-gray-500 sm:text-sm" id="price-currency">
                  USD
                </span>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td class="px-6 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
            Sales Promotion (Cost = $300)
          </td>
          <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500">
            <select id="location" name="location" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
              <option></option>
              <option selected>Yes</option>
              <option>No</option>
            </select>
          </td>
        </tr>
        <tr>
          <td class="px-6 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
            Internet Marketing (Cost = $100)
          </td>
          <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500">
            <select id="location" name="location" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
              <option></option>
              <option selected>Yes</option>
              <option>No</option>
            </select>
          </td>
        </tr>
        <tr>
          <td class="px-6 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
            Purchase the Goody Mixer?
          </td>
          <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500">
            <select id="location" name="location" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
              <option></option>
              <option selected>Yes</option>
              <option>No</option>
            </select>
          </td>
        </tr>
      </tbody>
    </table>
</template>

<script>
export default {
    props: ["inputData"],
    data() {
        return {
            username: "Chester", //TODO: Load this or pass it through a prop
            formData : []
        }
    },
}
</script>