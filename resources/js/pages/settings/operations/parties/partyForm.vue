<template>
    <form class="p-4 md:p-5" @submit.prevent="saveData">
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
                <input type="text" v-model="party.name" id="name"
                :class="{'dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600':!!has_error.name}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Party Name">
                <p v-if="!!has_error.name" id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">Error!</span> {{ has_error.name }}.</p>
            </div>
        </div>
        <div class="grid gap-4 mb-4 grid-cols-4">
            <div class="col-span-4 sm:col-span-4">
                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an option</label>
                <select required id="countries" v-model="party.role_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                </select>
                <p v-if="!!has_error.role_id" id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">Error!</span> {{ has_error.role_id }}.</p>
            </div>
        </div>

        <button
        type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
           Save
        </button>
        <button
            v-if="!!party.id"
            type="button"
            @click.prevent="()=>{selectedAddr={};addAddress=true; }"
            class="text-gray-500 ml-2 inline-flex items-center bg-white-700 hover:bg-white-800 focus:ring-4 focus:outline-none focus:ring-white-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-white-600 dark:hover:bg-white-700 dark:focus:ring-white-800"
        >
            Add Address
        </button>
        <hrLine message="Addresses" v-if="party.address"></hrLine>
        <BnModal v-if="!!addAddress" :toggle="addAddress" @close="addAddress= !addAddress" title="Address Form">
            <address-form @saveAdd="($event)=>pushAddress($event)" :party_id="party.id" :address="selectedAddr"></address-form>
       </BnModal>
       <addressView @deleteAddress="($event)=>addreDelete($event)" @addressDefault="($event)=>makeDefaultAddress($event)" class="mt-2" v-for="(addre,index) in party.address" :address="addre" @edit_address="($event)=>{selectedAddr = $event; addAddress=true}" :key="index"></addressView>

    </form>
</template>
<script>
import addressForm from '../../../../components/addressForm.vue';
import BnModal from '../../../../components/Bn-Modal.vue';
import addressView from '../../../../components/AddressViewCard.vue';
import hrLine from '../../../../components/hrLine.vue';
export default {
    props:['party'],
    components:{addressForm,BnModal,addressView,hrLine},
    data() {
        return {
            has_error:{},
            message:null,
            roles:[],
            addAddress:false,
            selectedAddr:{},
        }
    },
    mounted(){
        this.getroles();
        if(!this.party.address) this.party.address=[];
    },
    methods:{
        saveData(){
            if(this.validateForm()) return;
            // console.log(this.party.name);
            axios.post('/api/auth/party',this.party).then(res=>{
               this.clearErrorMessage();
                this.$emit('updateData',res.data.payload);

            }).catch((exe)=>{

                if(exe.response.status == 422){
                    this.message = exe.response.data.message;
                    this.has_error =  exe.response.data.errors;
                }
            }).finally(()=>{

                });
        },
        getroles(){
            axios.get('/api/auth/roles').then(res=>{ this.roles=res.data.payload})
        },
        clearErrorMessage(){
            this.message=null;
            this.has_error={};
        },
        validateForm(){
            this.clearErrorMessage();
            //name
            if(!this.party.name) {
                this.has_error.name="Name is required";
                this.message = "Please fix the errors";
            }

            return !!Object.keys(this.has_error).length;
        },
        pushAddress($event){
            let is_available = this.party.address.findIndex((ele)=> {return ele.id==$event.id});
            if(is_available > -1) this.party.address[is_available] = $event;
            else this.party.address.push($event);
            this.addAddress=false;
        },

        makeDefaultAddress(data){
            axios.post('/api/auth/address/'+data)
            .then(res=>{
                this.party.address = res.data.payload;
            }).catch(exe=> console.log(exe));
        },
        addreDelete(data){
            axios.delete('/api/auth/address/'+data).then((res)=>{
                //remvoe the address in the fornt
                let is_available = this.party.address.findIndex((ele)=> {return ele.id==data});
                this.party.address.splice(is_available,1);
            }).catch(err=> console.log(err));
        }
    }

}
</script>
<style lang="">

</style>
