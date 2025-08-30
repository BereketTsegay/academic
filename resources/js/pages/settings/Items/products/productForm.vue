<template>
      <form class="p-4 md:p-5" @submit.prevent="submit">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2 sm:col-span-1">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" v-model="product.name" id="name"
                        :class="{'dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600':!!error.name}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="product Name">
                        <p v-if="!!error.name" id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">Error!</span> {{ erorr.name }}.</p>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="product" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                       <div class="flex">
                        <select id="product" v-model="product.category_id" placeholder="Select type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option v-for="(category,index) in categories" :key="index" :value="category.id">{{category.name}}</option>
                        </select>
                        <div class="button-primary text-sm text-blue-600 flex items-center justify-center cursor-pointer px-4" @click="showCategory=true">Add</div>
                       </div>
                        <p v-if="!!error.category_id" id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">Error!</span> {{ erorr.name }}.</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="product" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unit</label>
                        <select id="product" v-model="product.unit_id" placeholder="Select type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option v-for="(unit,index) in units" :key="index" :value="unit.id">{{unit.name}}</option>
                        </select>
                        <p v-if="!!error.unit_id" id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">Error!</span> {{ erorr.name }}.</p>
                    </div>
                    <div class="col-span-2">
                        <input :checked="!!product.is_active" id="type-checkbox" :value="!!product.is_active" v-model='product.is_active' type="checkbox" value=""
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="type-checkbox" class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Enabled / Diabled</label>

                    </div>
                </div>
                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                   {{ product.id?'Update': 'Create' }}
                </button>
                <BnModal v-if="!!showCategory" :toggle="showCategory" @close="showCategory= !showCategory" title="Add New Category">
                    <categoryForm :category="{}"  @saved="($event)=>updatedCategory($event)"></categoryForm>
                </BnModal>
                
      </form>
</template>
<script>
import axios from 'axios';
import { Form, Field } from 'vee-validate';
import categoryForm from '../category/categoryForm.vue';
import BnModal from '../../../../components/Bn-Modal.vue';
export default {
    props:['product'],
    components:{Form,Field, categoryForm, BnModal},
    data() {
        return {
            error:{},
            categories:[],
            showCategory:false,
            units:[],
        }
    },
    mounted(){
        if(!product.id) product.is_active=1;
        axios.get('/api/auth/categories/').then(response => this.categories=response.data.data);
        axios.get('/api/auth/units/').then(response => this.units=response.data.data);
    },
    methods:{
        submit(){

            if(!this.validateForm()) {
                return;
            }
            axios.post('/api/auth/product',this.product).then(res=>{
                if(res.data.success) this.$emit('saved',res.data.payload);
            })
        },
        updatedCategory(newdata){
            this.categories.push(newdata);
            this.product.category_id = newdata.id;
            this.showCategory=false;
        },
        validateForm(){
            //name
            if(this.product.name=='') {
                this.error.name="Name is required";
            }
            if(!!this.product.category_id) this.error.category_id="Category is required, please selecet one for the dropdown";
            if(!!this.product.unit_id) this.error.unit_id="Unit is required, please selecet one for the dropdown";
            return !!Object.keys(this.error).length;
        }
    }

}
</script>
<style lang="">

</style>
