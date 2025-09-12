<template>
<section class="bg-gray-50 dark:bg-gray-900">


        <!-- Start coding here -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden" style="position: relative;">
            <span class="text-lg text-gray-500 dark:text-white capitalize p-4">{{ title }}</span>
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

                                <div class="inline-flex rounded-md shadow-xs" role="group">
                                    <button v-for="action,index in [{event:'edit',icon:'pen'},{event:'delete',icon:'trash'},{event:'view',icon:'eye'}]"
                                    :key="index" type="button"
                                    @click="checkEvent(action,record)"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                                        <FaIcon v-if="!!action.icon" :class="{'text-red-500':action.event=='delete'}" :iconName="action.icon"></FaIcon>
                                    </button>
                                    </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <nodataFound v-else @add="$emit('add')"></nodataFound>
            <table-footer :paginate="pagination" @paginate="($event)=>$emit('paginate',$event)"></table-footer>
        </div>
        <Confrim message="record" v-if="deleteModal" @close="deleteModal=false" @confirmed="$emit('delete',record)"></Confrim>
    </section>
</template>
<script>
import tableHeader from './tableHeader.vue';
import tableFooter from './tableFooter.vue';
import Loader from './loader.vue';
import nodataFound from './nodataFound.vue';
import dropdownMenu from './dropdownMenu.vue';

import { capitalizeFirstLetter } from '../library/general';
import FaIcon from './faIcon.vue';
import Confrim from './confrim.vue';

export default {
    name:'dataTable',
    props:{data:{ type : Array, required:true, default:[]},columns:Array,title:String,pagination:Object,isLoading:Boolean,dropdown:false},
    components:{ tableHeader, tableFooter, Loader , nodataFound, dropdownMenu, FaIcon, Confrim},
    data() {
        return {
            deleteModal:false,
        }
    },
    methods: {
        capitalize(word){
            return capitalizeFirstLetter(word)
        },
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
        checkEvent(action,rec){
            if(action.event == 'delete') {
                this.deleteModal=true;
                return;
            }
            this.$emit(action.event,rec);
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
