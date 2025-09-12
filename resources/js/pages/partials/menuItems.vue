<template lang="">
    <ul class="space-y-2 font-medium">


           <li v-for="menu,index in menus" :key="index">
             <template v-if="!!menu.subRoute">

                    <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"

                    :data-collapse-toggle="menu.label.replaceAll(' ', '')">
                        <i v-if="!!menu.icon" :class="`fa-solid fa-${menu.icon}`"></i>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{menu.label}}</span>
                       <i v-if="!!menu.icon" class="fa-solid fa-chevron-down"></i>
                    </button>
                    <ul :id="menu.label.replaceAll(' ', '')" class="hidden py-2 space-y-2">
                        <li v-for="sub,index in menu.subRoute" :key="index+sub.label">
                            <router-link :to="sub.href" class=" flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                <span class="ms-3">{{sub.label}}</span>
                            </router-link>
                        </li>
                    </ul>

            </template>
                <template v-else>
                    <router-link :to="menu.href" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <fa-icon v-if="!!menu.icon" :iconName="menu.icon" />
                        <span class="ms-3">{{menu.label}}</span>
                    </router-link>
                </template>
            </li>
    </ul>
</template>
<script>
import faIcon from '../../components/faIcon.vue'
export default {
  components: { faIcon },

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
