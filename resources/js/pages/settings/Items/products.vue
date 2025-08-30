<template>
    <div>
       <BnDataTable  title="Product" :isLoading="isLoading" @paginate="($event)=>getData(null,$event)" :pagination="paginationdata" @search="($event)=>getData($event,1)" :data="products" @add="add()" @refresh="getData()" :columns="columns" @edit="($event)=>edit($event)" @delete="($event)=>destroy($event)" @view="($event)=>view($event)"></BnDataTable>
       <BnModal v-if="!!createToggle" :toggle="createToggle" @close="createToggle= !createToggle" title="Item Form">
            <productForm :product="selectedData" @saved="($event)=>updated($event)"></productForm>
       </BnModal>
    </div>
</template>
<script>
import BnDataTable from '../../../components/Bn-DataTable.vue';
import viewModal from '../../../components/brandView.vue';
import BnModal from '../../../components/Bn-Modal.vue';
import productForm from './products/productForm.vue';

export default {
    name: 'products',
    data() {
        return {
            isLoading:false,
            selectedData:{},
            paginationdata:{},
            createToggle:false,
            products: [],
            columns: [
                {
                    name: 'Name',
                    field: 'name',
                },
                {
                    name: 'Category',
                    field: 'cateory_id',
                    options:{
                        type: 'object',
                        dataset : 'category',
                        display_field:'name',
                    }
                },
                {
                    name: 'Is Active',
                    field: 'is_active',
                    options:{
                        type: 'boolean',
                        values:{true:'Active', false:'Disabled'}
                    }
                }
            ]
        };
    },
    components: { BnDataTable, BnModal, productForm ,viewModal},
    mounted(){
        this.getData();
    },
    methods: {
        getData(query='',page=1){

            this.isLoading=true;
            var request_str = '/api/auth/products?page='+page;
            if(!!query) {request_str= request_str +'&query='+query;  console.log(request_str);}
            axios.get(request_str)
            .then(data=>{
                var res = data.data;
                this.products = res.data;
                this.paginationdata.current_page = res.current_page;
                this.paginationdata.from = res.from;
                this.paginationdata.to = res.to;
                this.paginationdata.last_page = res.last_page;
                this.paginationdata.total = res.total;
                this.paginationdata.prev_page_url = res.prev_page_url;
                this.paginationdata.next_page_url = res.next_page_url;


            }).finally(()=>setTimeout(()=>{
                this.isLoading=false;
            },'1000'));
        },
        updated(rec){
            var found =this.products.findIndex((element) => element.id == rec.id);
            found > -1 ? this.products[found]=Object.assign({},rec) : this.products.push(rec);
            this.selectedData={},
            this.createToggle=!this.createToggle;
            console.log(this.createToggle);
        },
        add(){
           this.selectedData= Object.assign({},{});
           this.createToggle=true;
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
    }
}
</script>
<style lang="">

</style>
