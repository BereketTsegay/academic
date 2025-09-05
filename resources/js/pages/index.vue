<template>
    

    <div style="position: relative; width: 100%!important;">
        <navigation></navigation>
        <sidenav></sidenav>
        <div class="p-4 sm:ml-64">
            <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
                <router-view></router-view>
            </div>
        </div>
    </div>





</template>

<script>
import navigation from "./partials/header.vue";
import sidenav from "./partials/sidenav.vue";
import { initFlowbite } from "flowbite";
export default {
    components:{
        navigation, sidenav
    },
    mounted() {
            initFlowbite();
    }
}
</script>
<style lang="">
    
</style>