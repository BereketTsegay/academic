<template lang="">
     <div class="flex items-center ms-3"  v-if="!!currentUser">
                <notification-bell>
                <div>
                    <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                    </button>
                </div>
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
                    <div class="px-4 py-3" role="none">
                        <p class="text-sm text-gray-900 dark:text-white" role="none">

                        </p>
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                        {{currentUser.name}}
                        </p>
                    </div>
                    <ul class="py-1" role="none">
                        <li>
                        <a href="/academia" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Academia</a>
                        </li>
                        <li>
                        <a href="/user/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Profile</a>
                        </li>
                        <li>
                        <a href="/user/settings" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Settings</a>
                        </li>
                        <li class="border-t-1 border-gray-700 dark:border-gray-600">
                        <a class="block px-4 py-2 text-sm cursor-pointer text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" @click.prevent="logout" role="menuitem">Sign out</a>
                        </li>
                    </ul>
                </div>
            </div>
</template>
<script>
import NotificationBell from "../auth/notificationsBell.vue";
export default {
    components : {NotificationBell},
    methods: {
        logout(){
            this.$store.commit('logout');
            this.$router.push('/');
        }
    },
    computed:{
        currentUser(){
            return this.$store.getters.currentUser;
        }
    }
}
</script>
<style lang="">

</style>
