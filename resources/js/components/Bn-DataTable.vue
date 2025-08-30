<template>
<section class="bg-gray-50 dark:bg-gray-900">


        <!-- Start coding here -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden" style="position: relative;">
            
           <table-header :title="title" @add="$emit('add')"  @refresh="$emit('refresh')" @search="($event)=>$emit('search',$event)"></table-header>
            <div class="overflow-x-auto" v-if="data.length>0">
                <Loader v-if="!!isLoading"></Loader>
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" v-for="column in columns" :key="column.name" class="px-4 py-3">{{ column.name }}</th>
                            <th scope="col" class="px-4 py-3">
                               <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>

                    <tbody style="position: relative;">
                        <tr class="border-b dark:border-gray-700" v-for="(record,ind) in data" :key="record.created_at">
                            <td v-for="(column,index) in columns" :key="index+ind" class="px-4 py-3">
                                <template v-if="!!column.options">
                                    <div>
                                        <div class="h-21 rounded-md min-w-10" :class="getClass(column,record)">
                                           {{ getSwitched(record,column)  }}
                                        </div>

                                    </div>
                                </template>
                                <template v-else>
                                    {{ record[column.field] }}
                                </template>
                            </td>
                            <td class="px-4 py-3 flex items-center justify-end">
                                <div :id="record.id" class="z-10 w-44 bg-white divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">

                                        <span class="action">
                                            <a v-on:click.prevent="$emit('edit',record)" class="py-2 px-4 hover:bg-gray-100 bg-white divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">Edit</a>
                                        </span>
                                        <span class="action">
                                            <a v-on:click.prevent="$emit('delete',record)" class="py-2 px-4 hover:bg-gray-100 bg-white divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">Delete</a>
                                        </span >
                                        <span class="action">
                                            <a v-on:click.prevent="$emit('view',record)" class="py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 bg-white divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">View</a>
                                        </span>


                                    <!-- Dropdown menu -->
                                    <div v-if="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
                                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                                        <li>
                                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                                        </li>
                                        <li>
                                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                                        </li>
                                        <li>
                                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
                                        </li>
                                        <li>
                                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sign out</a>
                                        </li>
                                        </ul>
                                    </div>

                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <nodataFound v-else @add="$emit('add')"></nodataFound>
            <table-footer :paginate="pagination" @paginate="($event)=>$emit('paginate',$event)"></table-footer>
        </div>

    </section>
</template>
<script>
import tableHeader from './tableHeader.vue';
import tableFooter from './tableFooter.vue';
import Loader from './loader.vue';
import nodataFound from './nodataFound.vue';

export default {
    name:'dataTable',
    props:{data:{ type : Array, required:true, default:[]},columns:Array,title:String,pagination:Object,isLoading:Boolean,dropdown:false},
    components:{ tableHeader, tableFooter, Loader , nodataFound},
    methods: {
        getClass(column,rec){

            var result="";

            switch(column.options.type){
                case 'boolean' :
                   result = !!rec[column.field] ?'text-center bg-green-100 text-green-500':'text-center bg-red-100 text-red-500';
                   break;
                case 'object' :
                    result = 'text-ellipsis md:text-clip';
                    break;
            }
            return result;

        },
        getRandomInt(min, max) {
            const minCeiled = Math.ceil(min);
            const maxFloored = Math.floor(max);
            return Math.floor(Math.random() * (maxFloored - minCeiled) + minCeiled); // The maximum is exclusive and the minimum is inclusive
        },
        getSwitched(record,column){
            var result="";

            switch(column.options.type){
                case   'boolean' :
                   result = !!record[column.field]?column.options?.values.true : column.options?.values.false ;
                   break;
                case 'object' :
                    result = record[column.options?.dataset][column.options?.display_field];
                    break;
            }
            return result;
        }
    },
}
</script>
<style>
    .action{
        cursor: pointer;
    }
</style>
