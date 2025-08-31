<template>
  <div>
      <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
        {{ label }}
      </label>
      <div class="flex">
      <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border rounded-e-0 border-gray-300 border-e-0 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
        <i :class="'fa-solid fa-'+{icon}"></i>
      </span>
        <input
          v-bind="model"
          @input="$emit('update:model',model)"
          :type="type"
          :placeholder="placeholder"
          :tabindex="tabindex"
          data-slot="input"
          class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light"
        
        />
      </div>
    <!-- <InputError :message="errorMessages"></InputError> -->
  </div>
</template>
<script>
export default {
    props:{
      type:{
        type:String,
        default:'text',
        required: false
      },
      Placeholder:{
        type:String,
        default:'',
        required: false
      },
      model:{
        type:String,
        required: true
      },
      label:{
        type:String,
        default:'',
        required: true
      },
      icon:{
        type:String,
        default:'',
        required: false
      },
      errorMessages:{
        type:String,
        default:'',
        required: false
      },
      tabindex:Number,
    },
  data() {
    return {
      
    }
  },
  mounted() {
      console.log('am mounted');
    },
}
</script>
<style lang="">
  
</style>
