<template>
   <div id="alert-additional-content-3" :class="{'bg-green-50 text-green-800 bg-green-50 dark:bg-gray-800 border-green-300  dark:text-green-400 dark:border-green-800':address.is_default}"
    class="p-4 relative mb-4  rounded-lg border"
    role="alert">
        <div class="flex items-center">
            <div class="flex justify-end button-sec">

            <button type="button" v-if="!address.is_default" @click="$emit('addressDefault',address.id)" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-xs px-3 py-1.5 me-2 text-center inline-flex items-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Make Default
            </button>
            <button type="button" @click="$emit('edit_address',address)" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-xs px-3 py-1.5 me-2 text-center inline-flex items-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                <svg class="w-3 h-3 text-white-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.4" d="m10.8 17.8-6.4 2.1 2.1-6.4m4.3 4.3L19 9a3 3 0 0 0-4-4l-8.4 8.6m4.3 4.3-4.3-4.3m2.1 2.1L15 9.1m-2.1-2 4.2 4.2"/>
                </svg>
            </button>
            <button type="button"  @click="deleteModal=true" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-xs px-3 py-1.5 me-2 text-center inline-flex items-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                <svg class="w-3 h-3 text-white-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.4" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                </svg>
            </button>
        </div>
        </div>
        <div class="text-sm" >

                <div class="flex font-normal flex-col text-gray-700 text-italic dark:text-gray-400">
                    <span v-if="address.address" >Address : {{ address.address }} </span>
                    <span v-if="address.email" >Email : {{ address.email }}</span>
                    <span v-if="address.tele" >Phone : {{ address.tele }} </span>
                    <span v-if="address.pobox" >Po Box : {{ address.pobox }} </span>
                </div>
        </div>
        <Confrim v-if="deleteModal" @close="deleteModal=false" message="Delete Address" @confirmed="confirmDeletion"></Confrim>
    </div>
</template>
<script>
import Confrim from './confrim.vue';
export default {
    props:['address'],
    components:{Confrim},
    data() {
        return {
            deleteModal:false,
        }
    },

    methods:{
        confirmDeletion(){
            this.$emit('deleteAddress',this.address.id);
            this.confirmDeletion=false;
        }
    }

}
</script>
<style>
 .button-sec{
    position: absolute;
    top: -0.9rem;
    right: 0rem;
    width: fit-content;
 }
</style>
