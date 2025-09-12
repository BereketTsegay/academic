<template>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4">
    <div class="pb-4 bg-white dark:bg-gray-900">
        <label for="table-search" class="sr-only">Search</label>
        <div class="relative mt-1">
            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                <fa-icon icon="search" class="w-5 h-5 text-gray-500 dark:text-gray-400"></fa-icon>
            </div>
            <input @input="search()" type="text" v-model="q" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
        </div>
    </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="p-4">
                    <div class="flex items-center">
                        <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-all-search" class="sr-only">checkbox</label>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    <fa-icon icon="cogs" class="w-4 h-4"></fa-icon>
                </th>
            </tr>
        </thead>
        <tbody v-if="roles.users?.length>0">
            <tr v-for="user,index in roles.users" :key="index" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-4 p-4">
                    <div class="flex items-center">
                        <input id="checkbox-table-search-1" :checked="inroled.indexOf(user.id)" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                    </div>
                </td>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ user.name }}
                </th>

            </tr>
        </tbody>
        <tbody v-else>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td colspan="3" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                    No user found in this role.
                </td>

            </tr>
        </tbody>
    </table>
</div>

</template>
<script>
import axios from 'axios';
import faIcon from '../../../components/faIcon.vue';
export default {
    props:{id:Number || String},
    components:{faIcon},
data() {
        return {
            roles:[],
            isLoading : false,
            inroled:[],
            q:'',
        }
    },
 mounted(){
    this.getdata();
    },
 methods: {
        getdata(){
            this.isLoading = true;
            axios.get('/api/admin/roles/show?id='+this.id)
            .then(res=>{
                this.roles = res.data;
                this.inroled = this.roles.users?.map(r=>r.id);
            }).catch(err => alert(err.responce))
            .finally(()=>this.isLoading=false);
        },
        search(){
            this.isLoading = true;
            if(this.q.length>2 || this.q.length==0){
                axios.get('/api/admin/users/search?&q='+this.q)
                .then(res=>{
                    this.roles = res.data;
                    this.inroled = this.roles.users?.map(r=>r.id);
                }).catch(err => alert(err.responce))
                .finally(()=>this.isLoading=false);
            }
        }
    },
}
</script>
<style lang="">

</style>
