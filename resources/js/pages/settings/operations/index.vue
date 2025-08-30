<template>
    <div>
        <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
            <li class="me-1">
                <router-link to="/settings/operations" class="inline-block p-2 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800
                 dark:hover:text-gray-300">Parties</router-link>
            </li>
            <li class="me-1">
                <router-link to="/settings/operations/vessels"  class="inline-block p-2 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300">Vessels</router-link>
            </li>
            <!-- <li class="me-1">
                <router-link to="/settings/items/units" class="inline-block p-2 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300">Units</router-link>
            </li>
            <li class="me-1">
                <router-link to="/settings/items/brands" class="inline-block p-2 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300">Brands</router-link>
            </li> -->
           
        </ul>

        <div>
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
export default {
    name:"Operations"
}
</script>
<style lang="">
    
</style>