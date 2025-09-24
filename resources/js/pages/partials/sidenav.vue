<template lang="">
   <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
      <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
         <menuItems :menus="menus"></menuItems>
      </div>
   </aside>
</template>
<script>
import menuItems from './menuItems.vue';
export default {
    components:{menuItems},
    data() {
        return {
            menus:[
                {
                    label: 'Dashboard',
                    href:'/academia',
                    icon:'gauge'
                },
                {
                    label: 'Authorization',
                    icon:'unlock',
                    subRoute:[
                        {
                            label: 'Roles',
                            href:'/academia/authorization/roles',
                        },
                        {
                            label: 'Permissions',
                            href:'/academia/authorization/permission',
                        },
                    ]
                },
                {
                    label: 'Academia',
                    icon:'user-graduate',
                    subRoute:[
                        {
                            label: 'Departments',
                            href:'/academia/school/departments',
                        },
                        {
                            label: 'Subjects',
                            href:'/academia/school/subjects',
                        },
                        {
                            label: 'Library',
                            href:'/academia/school/library',
                        },
                        {
                            label:' Classrooms',
                            href:'/academia/school/classrooms',
                        },
                    ]
                },
            ]
        }
    },
}
</script>
<style lang="">

</style>
