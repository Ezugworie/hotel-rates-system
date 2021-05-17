<template>
  <div class="w-full flex flex-row">
    <div class="w-full md:w-1/2 flex flex-col justify-center items-center border-r">
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
                    focus:ring ring-gray-200 border-2 
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
                v-if="creatingHotelMode"
                >
          Create
        </button>

         <button type="submit"
                class="w-full bg-gray-500 mt-5 
                      text-gray-50 
                      rounded-md p-2
                      hover:bg-gray-700 focus:outline-none
                      shadow
                      focus:ring-2 focus:ring-gray-600 
                      focus:ring-opacity-50"
                @click=""
                v-else
                >
          Update
        </button>
      </form>
    </div>

     <div class="w-full md:w-1/2 flex flex-col justify-center items-center">
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
                    <th scope="col" class=" px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Actions
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
                    
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex flex-row justify-between">
                      <span @click="editHotels(hotel)" class="text-gray-400 hover:text-gray-900 hover:underline cursor-pointer">Edit</span>
                      <span @click="deleteHotels(hotel.id)" class="text-red-500 hover:text-red-600 hover:underline cursor-pointer">Delete</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      </div>
    </div>
  </div>
</template>


<script>
import { hotelObj } from '../utils/index.js'
import axios from 'axios'
import Swal from 'sweetalert2'



export default {
  data() {
    return {
      newHotel: hotelObj,
      hotels: [],
      creatingHotelMode: true,
      
    }
  },
  methods: {
    createHotel: function() {
      if (this.creatingHotelMode) {
        axios.post('/api/hotels', {
          "name": this.newHotel.name,
          "stars": this.newHotel.stars,
          "address": this.newHotel.address
        }).then(response => {
             console.log(response.data)
             this.fetchHotels()
             this.newHotel = hotelObj
              // this.hotels = response.data
              console.log("HOTELS RESPONSE ==>  "+JSON.stringify(response));
        })
      }else {
        axios.put(`/api/hotels/${this.newHotel.id}`, {
          "name": this.newHotel.name,
          "stars": this.newHotel.stars,
          "address": this.newHotel.address
        }).then(response => {
             console.log(response.data)
             this.fetchHotels()
             this.newHotel = hotelObj
             this.creatingHotelMode = true
              // this.hotels = response.data
              console.log("HOTELS RESPONSE ==>  "+JSON.stringify(response));
        })
      }
    },
     
    fetchHotels: function() {
      console.log("Fetching")
      axios.get('/api/hotels')
           .then(response => {
             console.log(response.data)
              this.hotels = response.data
            })
    },

    editHotels: function(obj) {
      console.log("Editing"+ JSON.stringify(obj))
      this.newHotel = obj
      this.creatingHotelMode = false
    },

    deleteHotels: function(id) {
      this.$swal({
        title: 'Confirm!',
        text: 'Sure to delete this Hotel?',
        icon: 'info',
        confirmButtonText: 'Delete please'
      })
      axios.delete(`/api/hotels/${id}`).then(() => {
        this.fetchHotels()
      })
    },
    
  },
  mounted() {
    this.fetchHotels()
    console.log('Hotel Home mounted')
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