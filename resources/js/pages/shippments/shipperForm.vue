<template>
    <!-- Modal content -->
    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5" style="min-width: 44em;">
            <!-- Modal body -->
            <ALERTCOMPONENT v-if="!!hasErrors" message="Please Corrent the messages"></ALERTCOMPONENT>
            <form @submit.prevent="save">
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="name"
                        :class="{'text-red-600 dark:text-red-400':!!errors.container_name}"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contaienr Name</label>
                        <input type="text" v-model="shippment.container_name" id="name"
                        :class="{'dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600':!!errors.container_name}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Container Name">
                        <p v-if="!!errors.container_name" class="mt-2 text-xs text-red-600 dark:text-red-400">
                           {{ errors.container_name }}
                        </p>
                    </div>
                    <div>
                        <label for="Container_number"
                        :class="{'text-red-600 dark:text-red-400':!!errors.container_number.length}"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Container Number</label>
                        <input type="text" name="Container_number" id="Container_number"
                        maxlength="11"
                        v-model="shippment.container_number"
                        :class="{'dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600':!!errors.container_number.length}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="ERMSU12345678">
                        <template v-if="!!errors.container_number.length">
                            <p class="mt-2 text-xs text-red-600 dark:text-red-400" v-for="(errr, index) in errors.container_number" :key="index+'err'" >
                           {{ errr }}
                        </p>
                        </template>

                    </div>
                    <div>
                        <label for="booking_number"
                        :class="{'text-red-600 dark:text-red-400':!!errors.booking_number.length}"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Booking Number</label>
                        <input type="text" v-model="shippment.booking_number" id="booking_number"
                        maxlength="10"
                        :class="{'dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600':!!errors.booking_number.length}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="DXB0834541 ">
                        <template v-if="!!errors.booking_number.length">
                            <p class="mt-2 text-xs text-red-600 dark:text-red-400" v-for="(errr, index) in errors.booking_number" :key="index+'err'" >
                           {{ errr }}
                        </p>
                        </template>
                    </div>
                    <div>
                        <label for="seal_number"
                        :class="{'text-red-600 dark:text-red-400':!!errors.seal_number}"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seal Number</label>
                        <input type="text"
                         maxlength="8"
                         minlength="5"
                        v-model="shippment.seal_number" id="seal_number"
                        :class="{'dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600':!!errors.seal_number}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="L4825236">

                        <template v-if="!!errors.seal_number">
                            <p class="mt-2 text-xs text-red-600 dark:text-red-400">
                                {{ errors.seal_number }}
                            </p>
                        </template>
                    </div>
                    <div>
                        <label for="container_size" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Size</label>
                        <select required id="container_size" v-model="shippment.container_size" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="20ST">20 Standard</option>
                            <option value="40HC">40 High cube cargo</option>
                            <option value="40ST">40 Standard</option>
                        </select>
                    </div>

                    <div class="flex items-center">
                        <div class="ml-4">
                            <input  id="checkbox-1" type="checkbox" :value="shippment.is_soc" v-model="shippment.is_soc"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" >
                            <label for="checkbox-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">IS SOC</label>
                        </div>
                        <div class="ml-4">
                            <input  id="checkbox-1" :value="shippment.is_group" type="checkbox" v-model="shippment.is_group"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" >
                            <label for="checkbox-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">IS Group</label>
                        </div>
                    </div>
                    <div>
                        <taginput
                        placeholder="Vessels"
                        :tagsSet="shippment.vessel_id??[]"
                        @inputUpdate="($event)=>dataAheds($event)"
                        @hadishMezgebebKfet ="addVessel=true"
                        :data="vessels"
                        value="id"
                        :hasError="errors.vessel_id"
                        displayName="name"
                        ></taginput>
                        <!-- <template v-if="!!errors.vessel_id">
                            <p class="mt-2 text-xs text-red-600 dark:text-red-400" >
                           {{ errors.vessel_id }}
                        </p>
                        </template>-->
                    </div>
                    <div>
                        <label for="voyage" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Voyage Number</label>
                        <input type="text" v-model="shippment.voyge_number" id="voyage"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="L4825236">
                    </div>
                    <div>
                        <label for="ETD" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of Departure (Source)</label>
                        <input type="date" v-model="shippment.ETD" id="ETD"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Date of Departurn form port">
                    </div>
                    <div>
                        <label for="ETA" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of Arival at (POD)</label>
                        <input type="date" v-model="shippment.ETA" id="ETA"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Date of Departurn form port">
                    </div>
                    <div>
                        <label for="transitor_party_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Transitor</label>
                        <select id="transitor_party_id"
                        v-model="shippment.transitor_party_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option v-for="transitor in transitors" :key="transitor+'transitor'" :value="transitor.id">{{ transitor.name }}</option>
                        </select>
                    </div>
                    <div>
                        <label for="shippingline_party_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shipping Line</label>
                        <select id="shippingline_party_id"
                        v-model="shippment.shippingline_party_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option v-for="shippingline in shippinglines" :key="shippingline.id+'shippingline'" :value="shippingline.id">{{ shippingline.name }}</option>
                        </select>
                    </div>
                    <div>
                        <label for="customer_party_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Customer</label>
                        <select id="customer_party_id"
                        v-model="shippment.customer_party_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option v-for="customer in customers" :key="customer.id+'loadingcustomer'" :value="customer.id">{{ customer.name }}</option>
                        </select>
                    </div>
                    <div>
                        <label for="maritime_party_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Maritime</label>
                        <select id="maritime_party_id"
                        v-model="shippment.maritime_party_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option v-for="maritime in maritimes" :key="maritime+'maritime'" :value="maritime.id">{{ maritime.name }}</option>
                        </select>
                    </div>
                    <div>
                        <label for="team_party_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Loader</label>
                        <div class="relative full">
                            <select id="team_party_id"
                            v-model="shippment.team_party_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option v-for="team in teams" :key="team.id+'team'" :value="team.id">{{ team.name }}</option>
                            </select>
                            <button type="button"
                            @click="addTeamMemeber=true"
                            class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                <span class="sr-only">Search</span>
                            </button>
                        </div>
                    </div>

                </div>
                <div class="flex items-center space-x-4">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                       Save
                    </button>
                </div>
            </form>
            <BNmodal v-if="addVessel" title="Add New Vessel" @close="addVessel=false">
                <vesselForm :vessel="{}" @updateData="($event)=>{vessels.push($event); addVessel=false;}"></vesselForm>
            </BNmodal>
            <BNmodal v-if="addTeamMemeber" title="Add New Team Member" @close="addTeamMemeber=false">
                <party-form :party="{'role_id':9}" @updateData="($event)=>{teams.push($event); addTeamMemeber=false;}"></party-form>
            </BNmodal>
        </div>
</template>
<script>
import {required,inputLengh,regexValidation} from "../../library/validations.js";
import ALERTCOMPONENT from "../../components/alert.vue";
import vesselForm from '../settings/operations/vessel/vesselForm.vue';
import taginput from "../../components/taginput.vue";
import BNmodal from "../../components/Bn-Modal.vue";
import partyForm from "../settings/operations/parties/partyForm.vue";
import axios from "axios";
export default {
 props: {shippment:{type:Object,required:true}},
 components:{ALERTCOMPONENT,taginput,vesselForm,BNmodal,partyForm},
 data() {
    return {
        vessels:[],
        transitors:[],
        maritimes:[],
        shippinglines:[],
        addVessel:false,
        addTeamMemeber:false,
        ports:[],
        hasErrors:false,
        errors:{
            container_number:[],
            booking_number:[],
        },
        customers:[],
        teams:[],
    }
 },
 created(){
    this.getParites();
    this.getPorts();
    this.getVessels();
 },
 methods: {
    save(){
        this.shippment.container_name = this.shippment.container_name.toUpperCase();
        this.shippment.container_number = this.shippment.container_number.toUpperCase();
        this.shippment.booking_number = this.shippment.booking_number.toUpperCase();
        this.shippment.seal_number = this.shippment.seal_number.toUpperCase();

        if(this.validate())
        axios.post('/api/auth/shippment',this.shippment).then(res => {
            this.$emit('updateData',res.data);
        }).catch(err => console.log(err));
    },
    getParites(){
        axios.get('/api/auth/getParties').then(res=>{
            var parties = res.data.payload;
            this.transitors = parties["Transitor"]??[];
            this.maritimes = parties["Maritime"]??[];
            this.shippinglines = parties["Shipping Line"]??[];
            this.customers = parties["Customer"]??[];
            this.teams = parties["Team"]??[];

            //defaut settings

            this.shippment.loading_port_id=5;
            this.shippment.destination_port_id=497;
            this.shippment.maritime_party_id=6;
            this.shippment.shippingline_party_id=3;
        });
    },
    validate(){
        this.clearErros();
        var flag = true;
        if(!required(this.shippment.container_name)) {
            this.errors.container_name="Container name is required";
            flag=false;
        }
        if(!required(this.shippment.container_number)) {
            this.errors.container_number.push("Container Number is required");
            flag=false;
            //check if it has the lenght

        }else{
            if(!inputLengh(this.shippment.container_number,11)){
            this.errors.container_number.push("Container number is not correct");
            flag=false;
            }
            //check the pattern
            if(!regexValidation(/^[A-Z]{4}[0-9]{7}$/,this.shippment.container_number)){
            this.errors.container_number.push("Container number is not correct Please check again");
            flag=false;

            }
        }
        if(!required(this.shippment.vessel_id)) {
            this.errors.vessel_id="Please select vessel";
            flag=false;
        }
        if(!required(this.shippment.booking_number)) {
            this.errors.booking_number.push("Booking Number is required");
            flag=false;
        }else
            // if(!inputLengh(this.shippment.booking_number,10)){
            //     this.errors.booking_number.push("Booking number length must be of 10 Characters Starting with DXB follwed by 7 digits");
            //     flag=false;
            // }
            if(!regexValidation(/^[Dd][Xx][Bb][0-9]{7}$/,this.shippment.booking_number)){
                this.errors.booking_number.push("Booking number is not correct Characters Starting with DXB follwed by 7 digits");
                flag=false;
            }

        if(!required(this.shippment.seal_number)) {
            this.errors.seal_number="Seal Number is required";
            flag=false;
        }
        else if(!regexValidation(/^[A-Za-z0-9]{5,9}$/,this.shippment.seal_number)){
            this.errors.seal_number="Seal Number should be between 5 and 9 Characters";
        }

        if(!required(this.shippment.vessel_id)) {
            this.errors.vessel_id="Please select a vessel";
            flag=false;
        }
        if(!flag) this.hasErrors=true;
        return flag;
    },
    getPorts(){
        axios.get('/api/auth/ports').then(res=> this.ports = res.data.payload);
    },
    getVessels(){
        axios.get('/api/auth/getVessels').then(res=> this.vessels = res.data.payload);
    },
    clearErros(){
        this. hasErrors = false;
        this.errors={
            container_number:[],
            booking_number:[],
        }
    },
    dataAheds(rec){
        // this.shippment.vessel_id = rec.length>=1 ? rec.map(e => e.id):[];
            this.shippment.vessel_id = rec;
        }
 },
}
</script>

<style lang="">

</style>
