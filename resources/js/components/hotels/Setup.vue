<template>
  <div class="w-full">
    <div class="w-full flex flex-col justify-center items-center">
      <span class="text-lg font-medium uppercase self-center my-5 text-gray-500">Create Hotel</span>
      <form @submit.prevent="createHotel()" class="w-2/5 self-center">
        <div class="mb-3">
          <label for="name" class="mb-3">Hotel Name </label>
          <div>
            <input 
              required
              type="text" 
              name="name" 
              v-model="newHotel.name"
              class="focus:outline-none 
                    focus:ring ring-gray-200 border border-2 
                    rounded-md w-full p-2"
            >
          </div>
        </div>

        <div class="mb-3">
          <label for="name" class="mb-3">Stars </label>
          <div>
            <select 
              required
              type="" 
              name="name" 
              v-model="newHotel.stars"
              class="focus:outline-none
                    focus:ring ring-gray-200 border border-2 
                    rounded-md w-full p-2"
            >
                <option disabled selected value="" class="text-gray-400">Please select one</option>
                <option value="3">3 Stars</option>
                <option value="4">4 Stars</option>
                <option value="5">5 Stars</option>
                <option value="7">7 Stars</option>
            </select>
          </div>
        </div>


        <div class="mb-3">
          <label for="address" class="mb-3">Address </label>
          <div>
            <textarea 
              name="address" 
              v-model="newHotel.address"
              class="focus:outline-none 
                    focus:ring ring-gray-200 border-2 
                    rounded-md w-full p-2"
              rows="5"
            ></textarea>
          </div>
        </div>

        <button type="submit" 
                class="w-full bg-gray-500 mt-5 
                      text-gray-50 
                      rounded-md p-2
                      hover:bg-gray-700 focus:outline-none
                      shadow
                      focus:ring-2 focus:ring-gray-600 
                      focus:ring-opacity-50"
                >
          Create
        </button>
      </form>
    </div>
  </div>
</template>


<script>
import { hotelObj } from '../utils/index.js'
import axios from 'axios'


export default {
  data() {
    return {
      newHotel: hotelObj,
      
    }
  },
  methods: {
    createHotel: function() {
      axios.post('/api/hotels', {
        "name": this.newHotel.name,
        "stars": this.newHotel.stars,
        "address": this.newHotel.address
      }).then(response => {
             console.log(response.data)
             this.$emit('hotel-created')

              // this.hotels = response.data
              console.log("HOTELS RESPONSE ==>  "+JSON.stringify(response));
      })
    }
    
  },
  mounted() {
            console.log('HOtel Component mounted.')
            console.log('HOtel object imported.  '+ this.newHotel.name)
            // this.fetchHotels()
        }
}
</script>