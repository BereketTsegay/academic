<template lang="">
    <ul class="space-y-2 font-medium">
            <li>
               <router-link :to="href" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <i :class='fa fa-{icon}'></i>
                  <span class="ms-3">{{label}}</span>
               </router-link>
            </li>
        </ui>
</template>
<script>
export default {

    props:[
        
    ]
    
}
</script>
<style lang="">
    
</style>