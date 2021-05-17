<style scopedSlots>
  .table--head {
    @apply px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider;
  }
</style>
<template>
  <div class="w-full flex flex-col md:flex-row ">
    <div class="w-full flex flex-col justify-center items-center border-r">
      <setup v-on:hotel-created="fetchHotels()"></setup>
    </div>
    <!-- <div class="w-full md:w-1/2 flex flex-col justify-center items-center">
      <span class="text-lg font-medium uppercase self-center my-5 text-gray-500">Hotels</span>
      <div class="w-full p-10 self-center">
        

      <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Stars
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Address
                    </th>
                    <th scope="col" class=" px-6 py-3 font-medium text-gray-500 uppercase">
                      <span class="sr-only">Edit</span>
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr v-for="hotel in hotels" :key="hotel.id">
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class="ml-4">
                          <div class="text-sm font-medium text-gray-900">
                            {{ hotel.name }}
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-900">{{ hotel.stars }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-900">{{ hotel.address }}</div>
                    </td>
                    
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                      <span @click="editHotels(hotel)" class="text-gray-400 hover:text-gray-900 hover:underline cursor-pointer">Edit</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      </div>
    </div> -->
  </div>
</template>

<script lang="ts">
import Setup from './Setup.vue'
import axios from 'axios'


export default {
  components: {
    Setup
  },
  data() {
    return {
      hotels: [],
    }
  },
  methods: {
  
  },
  mounted() {
   
  },
  watch: {
    hotels: {
      handler: (newHotels, oldHotels) => {
        console.log("Title changed from " + oldHotels + " to " + newHotels)
      },
      immediate: true
    }
},
}
</script>