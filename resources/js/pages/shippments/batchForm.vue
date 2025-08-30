<template>
    <!-- Modal content -->
    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5" style="min-width: 32em;">
            <!-- Modal body -->
            <ALERTCOMPONENT v-if="!!hasErrors" message="Please Corrent the messages"></ALERTCOMPONENT>
            <form @submit.prevent="save">
                <div class="grid">
                    <div>
                        <label for="name"
                        :class="{'text-red-600 dark:text-red-400':!!errors.voage_number}"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Voage Number</label>
                        <input type="text" v-model="batch.voage_number" id="name"
                        :class="{'dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600':!!errors.voage_number}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Container Name">
                        <p v-if="!!errors.voage_number" class="mt-2 text-xs text-red-600 dark:text-red-400">
                           {{ errors.voage_number }}
                        </p>
                    </div>
                </div>
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="Date of Departure"
                            :class="{'text-red-600 dark:text-red-400':!!errors.DOP}"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of Departure</label>
                            <input type="date" v-model="batch.DOP" id="name"
                            :class="{'dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600':!!errors.DOP}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Container Name">
                            <p v-if="!!errors.DOP" class="mt-2 text-xs text-red-600 dark:text-red-400">
                            {{ errors.DOP }}
                            </p>
                        </div>
                        <div>
                            <label for="Date of Arriaval"
                                :class="{'text-red-600 dark:text-red-400':!!errors.DOA}"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Date of Arrival
                            </label>
                            <input type="date" v-model="batch.DOA" id="name"
                                :class="{'dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600':!!errors.DOA}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Container Name">
                            <p v-if="!!errors.DOA" class="mt-2 text-xs text-red-600 dark:text-red-400">
                            {{ errors.DOA }}
                            </p>
                        </div>
                    
                    </div>
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="loading_port_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Loading Port</label>
                            <select id="loading_port_id"
                            v-model="batch.loading_port_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option v-for="port in ports" :key="port.id+'loadingport'" :value="port.id">{{ port.name }}</option>
                            </select>
                        </div>
                        <div>
                            <label for="destination_port_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Destination Port</label>
                            <select id="destination_port_id"
                            v-model="batch.destination_port_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option v-for="port in ports" :key="port.id+'destinationgport'" :value="port.id">{{ port.name }}</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <div class="grid">
                            <taginput
                                placeholder="Vessels"
                                :tagsSet="batch.vessel_id??[]"
                                @inputUpdate="($event)=>dataAheds($event)"
                                @hadishMezgebebKfet ="addVessel=true"
                                :data="vessels"
                                value="id"
                                :hasError="errors.vessel_id"
                                displayName="name"
                            ></taginput>
                        </div>
                    </div>
                    <div class="flex mt-4 items-center space-x-4">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                       Save
                    </button>
                </div>
         </form>
         <BNmodal v-if="addVessel" title="Add New Vessel" @close="addVessel=false">
                <vesselForm :vessel="{}" @updateData="($event)=>{vessels.push($event); addVessel=false;}"></vesselForm>
         </BNmodal>
    </div>
                

</template>
<script>
import axios from 'axios';
import ALERTCOMPONENT from '../../components/alert.vue';
import vesselForm from '../settings/operations/vessel/vesselForm.vue';
import BnModal from '../../components/Bn-Modal.vue';
import taginput from '../../components/taginput.vue';
export default {
    components:{ALERTCOMPONENT,vesselForm,BnModal,taginput},
    props:{batch:{type:Object,required:true}},
    data() {
        return {
            errors:{},
            vessels:[],
            ports:[],
            addVessel:false,
            
        }
    },
    created(){
        this.getVessels();
        this.getPorts();
    },
    methods:{
        save(){
            if(validate()) return;
            axios.post('/api/auth/batch/store',this.batch)
            .then(res => this.$emit('updated',res.data))
            .catch(err => console.log(err))
            .finally(()=>this.isloading=false);
        },
        validate(){
            if(this.batch.voage_number="") {
                this.errors.voage_number = "voage number is required";
            }
            if(this.batch.DOP="") this.errors.DOP = "Date of departuren is required";
            if(this.batch.DOA="") this.errors.DOA = "Date of Arrival is required";
            if(this.batch.vassel_id.length < 0) this.errors.vessel_id.push = "Pls select Vessel, it is requried";
        },
        dataAheds(rec){
            this.batch.vessel_id = rec;
        },
        getVessels(){
        axios.get('/api/auth/getVessels').then(res=> this.vessels = res.data.payload);
        },
        getPorts(){
            axios.get('/api/auth/ports').then(res=> this.ports = res.data.payload);
        },
    }
}
</script>
<style lang="">
    
</style>