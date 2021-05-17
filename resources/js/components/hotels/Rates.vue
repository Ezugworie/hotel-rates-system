<template>
  <div class="w-full flex flex-row">
    <div class="w-full md:w-1/2 flex flex-col justify-center items-center border-r">
      <span class="text-lg font-medium uppercase self-center my-5 text-gray-500">Create Rate</span>
      <form @submit.prevent="createRate()" class="w-2/5 self-center">
        <div class="mb-3">
          <label for="startDate" class="mb-3">Start Date </label>
          <div>
            <input 
              required
              type="date" 
              name="startDate"
              v-model="newRate.start_date"
              :min="today"
              class="focus:outline-none 
                    focus:ring ring-gray-200 border-2 
                    rounded-md w-full p-2"
            >
          </div>
        </div>

        <div class="mb-3">
          <label for="endDate" class="mb-3">End Date </label>
          <div>
            <input 
              required
              type="date" 
              name="endDate"
              :min="newRate.start_date"
              v-model="newRate.end_date"
              class="focus:outline-none 
                    focus:ring ring-gray-200 border-2 
                    rounded-md w-full p-2"
            >
          </div>
        </div>

        <div class="mb-3">
          <label for="adultRate" class="mb-3">Adult Rate </label>
          <div>
            <input 
              required
              type="number" 
              name="adultRate"
              v-model="newRate.adult_rate"
              class="focus:outline-none 
                    focus:ring ring-gray-200 border-2 
                    rounded-md w-full p-2"
            >
          </div>
        </div>

        <div class="mb-3">
          <label for="childRate" class="mb-3">Child Rate </label>
          <div>
            <input 
              required
              type="number" 
              name="adultRate"
              v-model="newRate.child_rate"
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
              v-model="newRate.hotel_id"
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
                      focus:ring-opacity-50"
                v-if="creatingRateMode"
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

      <div class="mt-5 justify-start flex w-2/5">
        <router-link to="/home" class="text-left underline uppercase">Go to Hotels</router-link>
      </div>
    </div>  

  <div class="w-full md:w-1/2 flex flex-col justify-center ritems-cente">
      <span class="text-lg font-medium uppercase self-center my-2 text-gray-500">Rates</span>
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
                      Date Range
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Rate for Adult per night <br/>[ USD ]
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Rate for Child per night <br/> [ USD ]
                    </th>
                    <th scope="col" class=" px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Actions
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr v-for="rate in rates" :key="rate.id">
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class="ml-4">
                          <div class="text-sm font-medium text-gray-800">
                            {{formatDate(rate.start_date) }} <span class="font-normal">-</span> {{ formatDate(rate.end_date) }}
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-800 font-medium">{{ rate.adult_rate }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-800 font-medium">{{ rate.child_rate }}</div>
                    </td>
                    
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex flex-row justify-between">
                      <span @click="editRate(rate)" class="text-blue-500 hover:text-blue-900 hover:underline cursor-pointer">Edit</span>
                      <span @click="deleteRate(rate.id)" class="text-red-500 hover:text-red-600 hover:underline cursor-pointer">Delete</span>
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
import { rateObj } from '../utils/index.js'
import axios from 'axios'
import { format, parseISO } from 'date-fns'
import Skeleton from '../shared/tableSkeleton'


export default {
  components: {
    Skeleton,
  },
  data() {
    return {
      newRate: rateObj,
      rates: [],
      hotels: [],
      creatingRateMode: true,
      loading: false,
      today: new Date().toISOString().split("T")[0],
      
    }
  },
  methods: {
    createRate: function() {
      if (this.creatingRateMode) {
        axios.post('/api/rates', this.$data.newRate)
             .then(response => {
                console.log(response.data)
                this.fetchRates()
                this.emptyForm(this.$data.newRate)
        })
      }else {
        //edit rates
        axios.put(`/api/rates/${this.newRate.id}`, this.$data.newRate).then(response => {
          this.fetchRates()
            this.emptyForm(this.$data.newRate)
             this.creatingRateMode = true
        })
      }
    },

    emptyForm: function(obj) {
      Object.keys(obj).forEach(k => delete obj[k])
    },
     
    fetchRates: function() {
      this.loading = true;
      console.log("Fetching")
      axios.get('/api/rates')
           .then(response => {
              this.rates = response.data
              this.loading = false;
            })
    },

    editRate: function(obj) {
      console.log("Editing"+ JSON.stringify(obj))
        obj.start_date = obj.start_date.split(' ')[0];
        obj.end_date = obj.end_date.split(' ')[0];

        this.newRate.id = obj.id,
        this.newRate.start_date = obj.start_date,
        this.newRate.end_date = obj.end_date,
        this.newRate.adult_rate = obj.adult_rate,
        this.newRate.child_rate = obj.child_rate,
        this.newRate.hotel_id = obj.hotel_id,

        this.creatingRateMode = false
    },

    deleteRate: function(id) {
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
            axios.delete(`/api/rates/${id}`).then(() => {
            this.fetchRates()
          })
          Swal.fire(
            'Deleted!',
            'Rate has been deleted.',
            'success'
          )
        }
      })
      
    },

    // createRate: function(hotel) {
    //   localStorage.setItem('hotel-key', hotel)
    //   this.$router.push('/home/hotel-rate');
    // }
    fetchHotels: function() {
      console.log("Fetching Hotels in Rates")
      axios.get('/api/hotels')
           .then(response => {
              this.hotels = response.data
            })
    },

    formatDate: function(date) {
      return format(parseISO(date), 'do MMM, yyyy')
    }
    
    
  },
  mounted() {
    this.fetchHotels()
    this.fetchRates()
    console.log('Rate Home mounted')
  },
  watch: {
    rates: {
      handler: (newRates, oldRates) => {
        console.log("Title changed from " + oldRates + " to " + newRates)
      },
      immediate: true
    }
  },
}
</script>