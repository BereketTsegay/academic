<template lang="">
    <Alert v-if="!!message" :message="message"></Alert>
    <form @submit.prevent="save" class="flex flex-col gap-6 overflow-y-scroll h-full p-6">
        <div class="grid grid-cols-2 gap-4">
            <div class="grid gap-2">
                <InputField :errors="errors.name" label="Full Name" type="text" placeholder="Full Name" :modelValue="user.name??''" icon="i-cursor" @input="($event)=> user.name = $event.target.value" />
            </div>
            <!-- <div class="grid gap-2">
                <InputField :errors="errors.email" label="Email" type="email" placeholder="Youremail@domain.com" :modelValue="user.email??''" icon="at" @input="($event)=> user.email = $event.target.value" />
            </div> -->
            <div class="grid gap-2">
                <InputField :errors="errors.tele" label="tele" type="tel" placeholder="Telephon" :modelValue="user.tele??''" icon="phone" @input="($event)=> user.tele = $event.target.value" />
            </div>
            <div class="grid gap-2">
            <SelectField :errors="errors.gender" label="Gender" :options="genderOptions"
            placeholder="Telephon" :modelValue="user.gender??''" icon="venus-mars" @input="($event)=> user.gender = $event.target.value"/>
            </div>
            <div class="grid col-span-2 gap-2">
            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Address
                </label>
                <div>
                    <textarea id="address" v-model="user.address" rows="4"
                    :class="{'border-red-600 text-red-600 dark:border-red-600 dark:text-red' : !!errors.address?.length , 'border-gray-300 text-gray-900 dark:border-gray-600 dark:text-white' : !!errors.address?.length <= 0}"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your Address ..."></textarea>
                </div>
                <p v-show="!!errors.address?.length" class="text-sm text-red-600 dark:text-red-500">
                    <span v-for="error,index in errors.email" :key="index">{{ error }}</span>
                </p>
            </div>
            <div class="grid gap-2">
                <SelectField :errors="errors.gender" label="Gender" :options="rols" optionLabel="name" optionValue="id"
                placeholder="Telephon" :modelValue="user.gender??''" icon="brifcase" @input="($event)=> user.gender = $event.target.value" />
            </div>

            <button type="submit" :disabled="!!isLoading" class="w-full col-span-2 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Register
            </button>
        </div>
    </form>
</template>
<script>
import axios from 'axios';
import InputField from '../../../components/InputField.vue';
import SelectField from '../../../components/selectField.vue';
export default {
    props:['user'],
    components:{InputField, SelectField},
    data() {
        return {
            errors:[],
            message : null,
            isLoading:false,
            rols:[],
            genderOptions:[{label:"Male",value:"Male"},{label:"Female", value:"Female"}],
        }
    },
    mounted() {
        this.getRols();
    },
    methods:{
        save(){
            this.isLoading=true;
            axios.post('/api/admin/users/store',this.user)
            .then(res => this.$emit('save',res.data))
            .catch(err => {
                this.errors = err.response.data.errors;
                this.message = err.response.data.message;
            }).finaly(()=> this.isLoading=false);
        },
        getRols(){
            axios.get('/api/admin/roles/roles')
            .then(res => this.rols = res.data)
            .catch(err => this.message = err.response.message);
        }
    }
}
</script>
<style lang="">

</style>
