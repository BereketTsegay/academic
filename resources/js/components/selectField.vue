<template lang="">
    <div>
        <label for="" class="block mb-2 text-sm font-medium"
         :class="{' text-red-600  dark:text-red' : !!errors.length , ' text-gray-900  dark:text-white' : errors.length <= 0}"
        >
            {{label}}
        </label>
       <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                    <i v-if="!!icon" :class="`fa-solid fa-${icon}`" class="w-4 h-4 text-gray-500 dark:text-gray-400"></i>
                </div>

                <select :value.sync="modelValue"
                @input="$emit('input')"
                :placeholder="placeholder"
                :class="{'border-red-600 text-red-600 dark:border-red-600 dark:text-red' : !!errors.length , 'border-gray-300 text-gray-900 dark:border-gray-600 dark:text-white' : errors.length <= 0}"
                class="bg-gray-50 border   text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700  dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500"
>
                    <option selected>Select</option>
                    <option v-for="(option,index) in options" :key="index" :value="options.value">{{option.label}}</option>
                </select>
                
        </div>
            <p v-show="!!errors.length" class="text-sm text-red-600 dark:text-red-500">
            <span v-for="error,index in errors" :key="index">{{ error }}</span>
        </p>
    </div>
</template>
<script>
export default {
    props:{
        modelValue:{
            type: String || Number,
            required : true,
        },
        placeholder:{
            type: String,
            required : false,
        },
        options:{
            type: Array,
            required : true,
        },
        errors:{
            type: Array,
            default : [],
            required : false,
        },
        label:{
            type: String,
            required : true,
        },
        icon:{
            type: String,
            required : false,
        }
    },
}
</script>
<style lang="">
    
</style>