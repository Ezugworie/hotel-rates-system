<template>
  <div class="flex flex-col w-full justify-center items-center text-gray-500">
      <span class="text-lg font-medium uppercase self-center my-5 text-gray-500">Hotel Rate Search</span>
      <div class="w-full flex justify-center spacce-x-5">
        <div class="w-1/4 justify-center border rounded-md shadow p-10">
          <form @submit.prevent="" class="self-center">
            <div class="mb-3">
              <label for="startDate" class="mb-3">Check-in Date </label>
              <div>
                <input 
                  required
                  type="date" 
                  name="startDate"
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
        <div class="w-1/4 flex flex-col justify-items-center justify-center border font-medium text-xl items-center rounded-md space-y-5 shadow p-10">
          <div>Per Adult Rate: $45</div>
          <div>Per Child Rate: $45</div>
          <div>Total: $90.00</div>
        </div>
      </div>
  </div>
</template>

<script>
import axios from "axios" 
export default {
  data(){
    return {
      hotels: [],
      today: new Date().toISOString().split("T")[0],
      loading: false,
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
  },
  mounted() {
    this.fetchHotels()
    console.log('User home mounted')
  },
}
</script>