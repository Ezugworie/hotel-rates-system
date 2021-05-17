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
  </div>
</template>

<script lang="ts">
import Setup from './Setup.vue'

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