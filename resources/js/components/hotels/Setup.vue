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

      <div class="mt-5 justify-start flex w-2/5 text-gray-600 hover:underline">
        <router-link to="/home/hotel-rate" class="text-left  uppercase flex font-semibold items-center">
          <span>Go to Rates</span>
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
            </svg>
          </span>
        </router-link>
      </div>
    </div>

     <div class="w-full md:w-1/2 flex flex-col justify-center items-center">
      <span class="text-lg font-medium uppercase self-center my-5 text-gray-500">Hotels</span>
      <div class="w-full p-10 self-center">
        

      <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
              <skeleton v-show="loading" :repeat="4" />


                <table v-show="!loading" class="min-w-full divide-y divide-gray-200">
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
                      <div class="text-sm text-gray-900">
                        <span class="flex flex-grow">
                          <svg v-for="i in hotel.stars" :key="i" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                          </svg>
                        </span>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-900" v-if="hotel.address">{{ hotel.address }}</div>
                      <div class="text-sm text-gray-900" v-else>N/A</div>
                    </td>
                    
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex flex-row justify-between">
                      <!-- <span @click="goToRates(hotel)" class="text-gray-400 hover:text-gray-900 hover:underline cursor-pointer">Rates</span> -->
                      <span @click="editHotels(hotel)" class="text-blue-500 hover:text-blue-900 hover:underline cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                      </span>
                      <span @click="deleteHotels(hotel.id)" class="text-red-500 hover:text-red-600 hover:underline cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                      </span>
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
import Skeleton from '../shared/tableSkeleton'


export default {
  components: {
    Skeleton
  },
  data() {
    return {
      newHotel: hotelObj,
      hotels: [],
      creatingHotelMode: true,
      loading: false
      
    }
  },
  methods: {
    createHotel: function() {
      if (this.creatingHotelMode) {
        axios.post('/api/hotels',
          this.$data.newHotel
        ).then(response => {
             console.log(response.data)
             this.fetchHotels()
             this.newHotel = hotelObj
              // this.hotels = response.data
              console.log("HOTELS RESPONSE ==>  "+JSON.stringify(response));
        })
      }else {
        axios.put(`/api/hotels/${this.newHotel.id}`, this.$data.newHotel)
             .then(response => {
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
      this.loading = true;
      axios.get('/api/hotels')
           .then(response => {
             console.log(response.data)
              this.hotels = response.data
             this.loading = false;

            })
    },

    editHotels: function(obj) {
      console.log("Editing"+ JSON.stringify(obj))
      this.newHotel = obj
      this.creatingHotelMode = false
    },

    deleteHotels: function(id) {
      this.$swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(`/api/hotels/${id}`).then(() => {
            this.fetchHotels()
          })
          Swal.fire(
            'Deleted!',
            'Hotel has been deleted.',
            'success'
          )
        }
      })
      
    },

    goToRates: function(hotel) {
      localStorage.setItem('hotel-key', hotel)
      this.$router.push('/home/hotel-rate');
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