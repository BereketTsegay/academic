<template>
    <div>
       <BnDataTable
       title="Users"
       :isLoading="isLoading"
       @paginate="($event)=>getData(null,$event)"
       :pagination="paginationdata"
       @search="($event)=>getData($event,1)"
       :data="dataset"
       @add="add()"
       @refresh="getData()"
       :columns="columns"
       @edit="($event)=>edit($event)"
       @delete="($event)=>destroy($event)"
       @view="($event)=>view($event)"></BnDataTable>
       <!-- <BnModal v-if="!!createToggle" :toggle="createToggle" @close="createToggle=false" title="User Update form">
            <userForm :user="selectedData" @save="($event)=>updated($event)"></userForm>
       </BnModal> -->
    </div>
</template>
<script>
import BnDataTable from '../../components/Bn-DataTable.vue';
import BnModal from '../../components/Bn-Modal.vue';
import userForm from './forms/userForm.vue';


export default {
    components:{
        BnDataTable,
        BnModal,
        userForm,
    },
    data() {
        return {
            dataset:[],
            isLoading:false,
            selectedData:{},
            paginationdata:{},
            createToggle:false,
            deleteModal:false,
            showView:false,
            message:'',
            columns:[
                {
                    name:'Id',
                    field:'id',
                },
                {
                    name:'full Name',
                    field:'name',
                },
                {
                    name: 'Role(s)',
                    field: 'roles',
                    options:{
                        component: 'userRoleUpdate',
                    }
                },
                {
                    name: 'Permission(s)',
                    field: 'permissions',
                    options:{
                        type: 'Array',
                        dataset : 'permissions',
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
            var found =this.dataset.findIndex((element) => element.id == rec.id);

            found > -1 ? this.dataset[found]=Object.assign({},rec) : this.dataset.push(rec);
            this.selectedData={},
            this.createToggle=!this.createToggle;
        },
            getData(query='',page=1){
                this.isLoading= true;
                var request_str = '/api/admin/users?page='+page;
                if(!!query) {request_str= request_str +'&query='+query;}
                axios
                .get(request_str)
                .then((data)=>
                        {
                            var res = data.data;
                            this.dataset = res.data
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
<style>

</style>
