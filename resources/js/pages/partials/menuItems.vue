<template lang="">
    <ul class="space-y-2 font-medium">
            <li v-for="menu,index in menus" :key="index">
               <router-link :to="menu.href" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <i v-if="!!menu.icon" :class="`fa-solid fa-${menu.icon}`"></i>
                  <span class="ms-3">{{menu.label}}</span>
               </router-link>
            </li>
    </ul>
</template>
<script>
export default {

    props:{
        menus:{
            type: Array,
            required : true
        },
    },

}
</script>
<style lang="">

</style>
