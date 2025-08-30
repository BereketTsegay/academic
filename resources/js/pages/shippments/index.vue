<template>
    <div>
       <div v-if="message" class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Success!</span> {{ message }}.
            </div>
        </div>
        <button @click="createBatch=true">Create New Batch</button>
       <DataTable  title="Container"
       :isLoading="isLoading"
       @paginate="($event)=>getData(null,$event)"
       :pagination="paginationdata"
       @search="($event)=>getData($event,1)"
       :data.sync="containers"
       @add="add()"
       @refresh="getData()"
       :columns="columns"
       @edit="($event)=>edit($event)"
       @delete="($event)=>destroy($event)"
       @view="($event)=>view($event)"></DataTable>
       <BnModal v-if="!!createToggle" :toggle="createToggle" @close="createToggle= !createToggle" title="Contaiener Form">
            <shipperForm :shippment="selectedData" @updateData="($event)=>updated($event)"></shipperForm>
       </BnModal>
       <BnModal v-if="!!showView" :toggle="showView" @close="showView= !showView" :title="'View ' + selectedData.name">
           <brand-view :data="selectedData"></brand-view>
       </BnModal>
       <Confrim v-if="deleteModal" @close="deleteModal=false" :message="selectedData.name" @confirmed="deleteData"></Confrim>

       <BnModal v-if="!!createBatch" :toggle="createBatch" @close="createBatch= !createBatch" title="Create New Batch">
           <BatchForm :batch="batch"></BatchForm>
       </BnModal>
    </div>
</template>
<script>
import BnModal from '../../components/Bn-Modal.vue';
import DataTable from '../../components/Bn-DataTable.vue';
import Confrim from '../../components/confrim.vue';
import brandView from '../../components/brandView.vue';
import shipperForm from './shipperForm.vue';
import axios from 'axios';
import BatchForm from './batchForm.vue';
export default {
    components:{BnModal, DataTable, Confrim, brandView, shipperForm,BatchForm},
    data() {
        return {
            containers:[],
            isLoading:false,
            selectedData:{},
            paginationdata:{},
            createToggle:false,
            deleteModal:false,
            showView:false,
            message:'',
            createBatch:false,
            batch:{},
            columns:[
                {
                    name:'Container',
                    field:'container_number',
                },
                {
                    name:'Booking Number',
                    field:'booking_number',
                },
                {
                    name:'Seal Number',
                    field:'seal_number',
                },
                {
                    name:'Size',
                    field:'container_size',
                },
                {
                    name:'SOC',
                    field:'is_soc',
                    options:{
                        type: 'boolean',
                        values:{true:'Yes', false:'No'}
                    }
                },
                {
                    name:'Group',
                    field:'is_group',
                    options:{
                        type: 'boolean',
                        values:{true:'Yes', false:'No'}
                    }
                },
                {
                    name:'Transitor',
                    field:'transitor_party_id',
                    options:{
                        type: 'object',
                        dataset : 'transitor',
                        display_field:'name',
                    }
                },
            ],

        }
    },
    created() {
        this.getData();
    },
    methods: {
            add(){
                this.selectedData={};
                this.createToggle=true;
            },
            updated(rec){
            var found =this.containers.findIndex((element) => element.id == rec.id);

            found > -1 ? this.containers[found]=Object.assign({},rec) : this.containers.push(rec);
            this.selectedData={},
            this.createToggle=!this.createToggle;
        },
            getData(query='',page=1){
                this.isLoading= true;
                var request_str = '/api/auth/shippments?page='+page;
                if(!!query) {request_str= request_str +'&query='+query;}
                axios
                .get(request_str)
                .then((data)=>
                        {
                            var res = data.data;
                            this.containers = res.data
                            this.paginationdata.current_page = res.current_page;
                            this.paginationdata.from = res.from;
                            this.paginationdata.to = res.to;
                            this.paginationdata.last_page = res.last_page;
                            this.paginationdata.total = res.total;
                            this.paginationdata.prev_page_url = res.prev_page_url;
                            this.paginationdata.next_page_url = res.next_page_url;

                        }
                    )
                .catch(exe => {console.log(exe);})
                .finally(()=> this.isLoading = false);
            },
        edit(data){
            this.selectedData= Object.assign({},data);
            this.createToggle=true;
        },
        destroy(data){
            console.log(data);
        },
        view(data){
            console.log(data);
        }
        },

}
</script>
<style lang="">

</style>
