<template>

      <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700 overflow-y-scroll">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                  User - Registeration
              </h1>
              <Alert v-if="!!authError" :message="authError"></Alert>
              <form @submit.prevent="authenticate" class="flex flex-col gap-6">
            <div class="grid gap-6">
                <div class="grid gap-2">
                   <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Full Name
                    </label>
                    <div>
                        <input
                        v-model="user.name"
                        placeholder="Full Name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        />
                    </div>
                </div>
                <div class="grid gap-2">
                   <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Email
                    </label>
                    <div>
                        <input
                        v-model="user.email"
                        type="email"
                        placeholder="Email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        />
                    </div>
                </div>
                <div class="grid gap-2">
                   <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Telephone
                    </label>
                    <div>
                        <input
                        v-model="user.tele"
                        placeholder="Telephone"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        />
                    </div>
                </div>
                <div class="grid gap-2">
                   <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Address
                    </label>
                    <div>
                        <textarea id="address" v-model="user.address" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your Address ..."></textarea>
                    </div>
                </div>
                <div class="grid gap-2">
                   <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Gender
                    </label>
                    <div>
                        <select id="gender" v-model="user.gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Select gender</option>
                            <option value="Male">Male</option>
                            <option value="Famale">Female</option>
                        </select>
                    </div>
                </div>
                <div class="grid gap-2">
                   <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Password
                    </label>
                    <div>
                        <input
                        v-model="user.password"
                        type="password"
                        placeholder="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        />
                    </div>
                </div>
                <div class="grid gap-2">
                   <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Confrim Password
                    </label>
                    <div>
                        <input
                        v-model="user.confrim_password"
                        id="confirm_password"
                        type="password"
                        placeholder="Confirm password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        />
                    </div>
                </div>

               
                <button type="submit" :disabled="!!isloading" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Register
                </button>
            </div>

            <div class="text-center text-sm text-muted-foreground">
                Already have an account?
                <router-link to="auth/login" class="underline underline-offset-4" :tabindex="6">Log in</router-link> 
            </div>
        </form>
          </div>
      </div>


</template>
<script>
import Alert from '../../components/alert.vue';
import { login } from '../../library/auth';
// import InputForm from '../../components/ui/input/InputForm.vue';

export default {
    name: 'register',
    components:{Alert},
    data() {
        return {
            user: {},
            isloading:false,
        };
    },
    methods: {
        authenticate() {
            console.log(this.user);
        }
    },
    computed: {
        authError() {
            return this.$store.getters.authError;
        }
    },
    components: { Alert }
}
</script>
<style lang="">

</style>
