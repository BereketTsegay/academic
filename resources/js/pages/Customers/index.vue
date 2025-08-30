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
       <DataTable  title="Parties"
       :isLoading="isLoading"
       @paginate="($event)=>getData(null,$event)"
       :pagination="paginationdata"
       @search="($event)=>getData($event,1)"
       :data="parties" @add="add()" @refresh="getData()" :columns="columns" @edit="($event)=>edit($event)" @delete="($event)=>destroy($event)" @view="($event)=>view($event)"></DataTable>
       <BnModal v-if="!!createToggle" :toggle="createToggle" @close="createToggle= !createToggle" title="Party Form">
            <partyForm :party="selectedData" @updateData="($event)=>updated($event)"></partyForm>
       </BnModal>
       <BnModal v-if="!!showView" :toggle="showView" @close="showView= !showView" :title="'View ' + selectedData.name">
           <brand-view :data="selectedData"></brand-view>
       </BnModal>
       <Confrim v-if="deleteModal" @close="deleteModal=false" :message="selectedData.name" @confirmed="deleteData"></Confrim>
    </div>
</template>
<script>
import DataTable from '../../components/Bn-DataTable.vue';
import BnModal from '../../components/Bn-Modal.vue';
import Confrim from '../../components/confrim.vue';
import partyForm from '../settings/operations/parties/partyForm.vue';
import brandView from '../../components/brandView.vue';

export default {
    components:{ DataTable, BnModal, partyForm, Confrim,brandView },
    data(){
        return{
            parties:[],
            isLoading:false,
            selectedData:{},
            paginationdata:{},
            createToggle:false,
            deleteModal:false,
            showView:false,
            message:'',
            columns:[
                {
                    name:'Name',
                    field:'name',
                },
                {
                    name:'Role',
                    field:'role',
                },
            ],
        }
    },
    created() {
        this.getData();
    },
    methods: {
        getData(query='',page=1){

            this.isLoading=true;
            var request_str = '/api/auth/parties?page='+page+'&role_id=7';
            if(!!query) {request_str= request_str +'&query='+query;}
            axios.get(request_str)
            .then(data=>{
                var res = data.data.payload;
                this.parties = res.data;
                this.paginationdata.current_page = res.current_page;
                this.paginationdata.from = res.from;
                this.paginationdata.to = res.to;
                this.paginationdata.last_page = res.last_page;
                this.paginationdata.total = res.total;
                this.paginationdata.prev_page_url = res.prev_page_url;
                this.paginationdata.next_page_url = res.next_page_url;


            }).finally(()=>setTimeout(()=>{
                this.isLoading=false;
            },'300'));
        },
        updated(rec){
            console.log('am i initailated');
            var found =this.parties.findIndex((element) => element.id == rec.id);
            !!found ? this.parties[found]=rec : this.parties.push(rec);
            this.selectedData={},
            this.createToggle=!this.createToggle;
        },
        add(){
           this.selectedData= Object.assign({},{role_id:7});
           this.createToggle=true;
        },
        edit(data){
            this.selectedData= Object.assign({},data);
            this.createToggle=true;
        },
        destroy(data){
            this.selectedData= Object.assign({},data);
            this.deleteModal=true;
        },
        deleteData(){
            axios.delete('/api/auth/party/'+this.selectedData.id)
            .then((res)=>{
                this.message=res.data.payload;
                var found =this.parties.findIndex((element) => element.id == this.selectedData.id);
               if(found){
                this.parties.splice(found,1);
                this.selectedData={};
               }

            })
            .finally(()=>this.deleteModal=false);
        },
        view(data){
            this.selectedData= Object.assign({},data);
            this.showView=true;
        }
    }
}
</script>
<style lang="">

</style>
