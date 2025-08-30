<template>
      <form class="p-4 md:p-5" @submit.prevent="submit">
        <div v-if="message" class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Success!</span> {{ message }}.
            </div>
        </div>
                <div class="grid gap-4 mb-4 grid-cols-4">
                    <div class="col-span-4 sm:col-span-4">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" v-model="brand.name" id="name"
                        :class="{'dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600':!!has_error.name}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Brand Name">
                        <p v-if="!!has_error.name" id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">Error!</span> {{ has_error.name }}.</p>
                    </div>
                </div>
                <button
                type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Save
                </button>
            </form>
</template>
<script>

export default {
    props:['brand'],
    data() {
        return {
            has_error:{},
            message:null,
        }
    },
    mounted(){

    },
    methods:{
        submit(){
            if(this.validateForm()) return;
            // console.log(this.brand.name);
            axios.post('/api/auth/brand',this.brand).then(res=>{
               this.clearErrorMessage();
                if(res.data.success) this.$emit('saved',res.data.payload);

            }).catch((exe)=>{

                if(exe.response.status == 422){
                    this.message = exe.response.data.message;
                    this.has_error =  exe.response.data.errors;
                }
            }).finally(()=>{

                });
        },
        clearErrorMessage(){
            this.message=null;
            this.has_error={};
        },
        validateForm(){
            this.clearErrorMessage();
            //name
            if(!this.brand.name) {
                this.has_error.name="Name is required";
                this.message = "Please fix the errors";
            }

            return !!Object.keys(this.has_error).length;
        }
    }

}
</script>
<style lang="">

</style>
