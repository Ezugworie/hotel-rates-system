<template>
  <div class="flex flex-col w-full justify-center items-center text-gray-500 bg-gray-50 h-screen">
      <span class="text-lg font-medium uppercase self-center my-5 text-gray-500 bg-gray-50">Hotel Rate Search</span>
      <div class="w-full flex justify-center spacce-x-5 bg-gray-50">
        <div class="w-1/4 justify-center border rounded-md shadow p-10 bg-white">
          <form @submit.prevent="searchRate()" class="self-center">
            <div class="mb-3">
              <label for="startDate" class="mb-3">Check-in Date </label>
              <div>
                <input 
                  required
                  type="date" 
                  name="startDate"
                  :max="searchRequest.check_out_date"
                  v-model="searchRequest.check_in_date"
                  class="focus:outline-none 
                        focus:ring ring-gray-200 border-2 
                        rounded-md w-full p-2"
                >
              </div>
            </div>

            <div class="mb-3">
              <label for="endDate" class="mb-3">Check-out Date </label>
              <div>
                <input 
                  required
                  type="date" 
                  name="endDate"
                  :min="searchRequest.check_in_date"
                  v-model="searchRequest.check_out_date"
                  class="focus:outline-none 
                        focus:ring ring-gray-200 border-2 
                        rounded-md w-full p-2"
                >
              </div>
            </div>

            <div class="mb-3">
              <label for="adultRate" class="mb-3">Number of Adults</label>
              <div>
                <input 
                  required
                  type="number" 
                  name="adultRate"
                  v-model="searchRequest.number_of_adults"
                  class="focus:outline-none 
                        focus:ring ring-gray-200 border-2 
                        rounded-md w-full p-2"
                >
              </div>
            </div>

            <div class="mb-3">
              <label for="childRate" class="mb-3">Number of Children </label>
              <div>
                <input 
                  required
                  type="number" 
                  name="adultRate"
                  v-model="searchRequest.number_of_children"
                  class="focus:outline-none 
                        focus:ring ring-gray-200 border-2 
                        rounded-md w-full p-2"
                >
              </div>
            </div>

            <div class="mb-3">
              <label for="hotel" class="mb-3">Hotel </label>
              <div>
                <select 
                  required
                  type="" 
                  name="hotel" 
                  v-model="searchRequest.hotel_id"
                  class="focus:outline-none
                        focus:ring ring-gray-200 border-2 
                        rounded-md w-full p-2"
                >
                    <option disabled selected value="" class="text-gray-400">Please select one</option>
                    <option v-for="hotel in hotels" :key="hotel.id" :value="hotel.id"> {{ hotel.name }} </option>
                </select>
              </div>
            </div>


            <button type="submit" 
                    class="w-full bg-gray-500 mt-5 
                          text-gray-50 
                          rounded-md p-2
                          hover:bg-gray-700 focus:outline-none
                          shadow
                          focus:ring-2 focus:ring-gray-600 
                          focus:ring-opacity-50">
              Search Rates
            </button>
          </form>
        </div>
        <div v-show="searchResult.total_rate" class="w-1/4 flex flex-col justify-items-center bg-white justify-center border font-medium text-xl items-center rounded-md space-y-5 shadow p-10">
          <p class="text-center">Rates for <br> {{ hotel }} <br> Hotel is:</p>
          
          <div>Per Adult Rate: {{ formatMoney(searchResult.per_adult_rate) || 0}} </div>
          <div>Per Child Rate: {{ formatMoney(searchResult.per_child_rate) || 0}}</div>
          <div>Total: {{ formatMoney(searchResult.total_rate) || 0}}</div>
        </div>

        <div v-show="loading" class="w-1/4 flex flex-col justify-items-center bg-white justify-center border  font-medium text-xl items-center rounded-md space-y-5 shadow p-10">
          <div class="animate-bounce">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16l2.879-2.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
        </div>
      </div>
  </div>
</template>

<script>
import axios from "axios" 
import { rateSearchObj, searchResultObj, formatMoney } from './utils/index.ts'

export default {
  data(){
    return {
      hotels: [],
      loading: false,
      searchRequest: rateSearchObj,
      searchResult: searchResultObj,
      formatMoney: formatMoney,
      hotel: '',
    } 
  },
  methods: {
    fetchHotels: function() {
      console.log("Fetching Hotels in Rates")
      axios.get('/api/hotels')
           .then(response => {
              this.hotels = response.data
            })
    },

    searchRate: function () {
              this.$data.loading = true
      console.log("searching for Rates")
      axios.post('/api/rates/search', this.$data.searchRequest)
           .then(response => {
              this.$data.searchResult = response.data
           }).then(() => {
              this.$data.hotel = this.$data.hotels[this.$data.searchRequest.hotel_id].name
             })
          this.$data.loading = false
              console.log(this.$data.searchResult)
    },

    // searchedHotelInfo:
  },
  mounted() {
    this.fetchHotels()
  },
}
</script>
