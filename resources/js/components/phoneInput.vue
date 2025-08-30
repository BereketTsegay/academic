<template>

<div class="flex relative">
        <button @click="toggle=!toggle" data-dropdown-toggle="dropdown-phone" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600" type="button">
            <!-- <span class="h-4 w-4 me-2">{{selected_country.flag}}</span> -->
            {{'(' + selected_country.code + ')'}}
        </button>
        <div v-if="toggle" class="z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-full dark:bg-gray-700 phone_list">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-phone-button">
                <li v-for="code in codes" :key="code.id">
                    <button type="button" @click="()=>{selected_country=code; toggle=false}" class="inline-flex w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
                        <div class="inline-flex items-center">
                            <!-- <span class="h-4 w-4 me-2">{{code.flag}}</span> -->
                            {{ code.name + '(' + code.code + ')'}}
                        </div>
                    </button>
                </li>
            </ul>
        </div>
        <label for="phone-input" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Phone number:</label>
        <div class="relative w-full">
            <input
            type="text"
            @input="$emit('phone_number',{code : selected_country.id, phone:phone_number})"
            @keyup="$emit('phone_number',{code : selected_country.id, phone:phone_number})"
            v-model="phone_number" id="phone-input"
            class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-0 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"  placeholder="phone number">
        </div>
    </div>
</template>
<script>
export default {
    props:['phone'],
    data() {
        return {
            phone_number :null,
            selected_country:{},
            prefix : null,
            codes:[],
            toggle:false,
        }
    },
    created(){
        if(this.phone) this.phone_number=this.phone;
    },
    mounted(){
      this.getCodes();
    },
    methods:{
        getCodes(){
            axios.get('/api/auth/country_code').then(res=>{this.codes = res.data.payload;
             this.selected_country=this.codes[66];
            });
        },
        // updateModel(){
        //     console.log(this.selected_country.code+this.phone_number);
        //    this.$emit('updated:phone',this.selected_country.code+this.phone_number);
        // },
    },
    watch:{
        phone_number(newVal){
            this.$emit('updated:phone',this.selected_country.code+newVal);
        }
    },
}
</script>
<style>
 .phone_list{
    position: absolute;
    top: 2.65rem;
    width: inherit;
    height: 21rem;
    overflow-y: scroll;
 }
</style>
