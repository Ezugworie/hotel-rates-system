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
              v-model="hotelData.name"
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
              v-model="hotelData.stars"
              class="focus:outline-none
                    focus:ring ring-gray-200 border border-2 
                    rounded-md w-full p-2"
            >
                <option disabled selected value="" class="text-gray-400">Please select one</option>
                <option>3 Stars</option>
                <option>4 Stars</option>
                <option>5 Stars</option>
                <option>7 Stars</option>
            </select>
          </div>
        </div>


        <div class="mb-3">
          <label for="address" class="mb-3">Address </label>
          <div>
            <textarea 
              name="address" 
              value=""
              class="focus:outline-none 
                    focus:ring ring-gray-200 border border-2 
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

export default {
  data() {
    return {
      hotelData: hotelObj
    }
  },
  methods: {
    createHotel() {
        console.log(this.hotelData)
    },
  },
  mounted() {
            console.log('HOtel Component mounted.')
            console.log('HOtel object imported.  '+ this.hotelData.name)
        }
}
</script>