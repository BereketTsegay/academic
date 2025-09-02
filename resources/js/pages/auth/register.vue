<template>

      <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                  User - Registeration
              </h1>
              <Alert v-if="!!message" :message="message"></Alert>
              <form @submit.prevent="authenticate" class="flex flex-col gap-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="grid gap-2">
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Full Name
                            </label>
                            <div>
                                <input
                                v-model="user.name"
                                placeholder="Full Name"
                                :class="{'border-red-600 text-red-600 dark:border-red-600 dark:text-red' : !!errors.name?.length , 'border-gray-300 text-gray-900 dark:border-gray-600 dark:text-white' : errors.name?.length <= 0}"
                                class="bg-gray-50 border   text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700  dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                />
                               
                            </div>
                             <p v-show="!!errors.name?.length" class="text-sm text-red-600 dark:text-red-500">
                                <span v-for="error,index in errors.name" :key="index">{{ error }}</span>
                            </p>
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
                                :class="{'border-red-600 text-red-600 dark:border-red-600 dark:text-red' : !!errors.email?.length , 'border-gray-300 text-gray-900 dark:border-gray-600 dark:text-white' : !!errors.email?.length <= 0}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                />
                                 
                            </div>
                             <p v-show="!!errors.email?.length" class="text-sm text-red-600 dark:text-red-500">
                                <span v-for="error,index in errors.email" :key="index">{{ error }}</span>
                            </p>
                        </div>
                        <div class="grid gap-2">
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Telephone
                            </label>
                            <div>
                                <input
                                v-model="user.tele"
                                placeholder="Telephone"
                                :class="{'border-red-600 text-red-600 dark:border-red-600 dark:text-red' : !!errors.tele?.length , 'border-gray-300 text-gray-900 dark:border-gray-600 dark:text-white' : errors.tele?.length <= 0}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                />
                            </div>
                            <p v-show="!!errors.tele?.length" class="text-sm text-red-600 dark:text-red-500">
                                <span v-for="error,index in errors.email" :key="index">{{ error }}</span>
                            </p>
                        </div>
                        <div class="grid gap-2">
                        <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Gender
                            </label>
                            <div>
                                <select id="gender" placeholder="Select Gender" v-model="user.gender" 
                                :class="{'border-red-600 text-red-600 dark:border-red-600 dark:text-red' : !!errors.gender?.length , 'border-gray-300 text-gray-900 dark:border-gray-600 dark:text-white' : errors.gender?.length <= 0}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Select gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Famale">Female</option>
                                </select>
                            </div>
                            <p v-show="!!errors.gender?.length" class="text-sm text-red-600 dark:text-red-500">
                                <span v-for="error,index in errors.email" :key="index">{{ error }}</span>
                            </p>
                        </div>
                        <div class="grid col-span-2 gap-2">
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Address
                            </label>
                            <div>
                                <textarea id="address" v-model="user.address" rows="4" 
                                :class="{'border-red-600 text-red-600 dark:border-red-600 dark:text-red' : !!errors.address?.length , 'border-gray-300 text-gray-900 dark:border-gray-600 dark:text-white' : !!errors.address?.length <= 0}"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your Address ..."></textarea>
                            </div>
                            <p v-show="!!errors.address?.length" class="text-sm text-red-600 dark:text-red-500">
                                <span v-for="error,index in errors.email" :key="index">{{ error }}</span>
                            </p>
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
                                :class="{'border-red-600 text-red-600 dark:border-red-600 dark:text-red' : !!errors.password?.length , 'border-gray-300 text-gray-900 dark:border-gray-600 dark:text-white' : !!errors.password?.length <= 0}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                />
                            </div>
                            <p v-show="!!errors.password?.length" class="text-sm text-red-600 dark:text-red-500">
                                <span v-for="error,index in errors.email" :key="index">{{ error }}</span>
                            </p>
                        </div>
                        <div class="grid gap-2">
                        <label for="password_confirmation" 
                       
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Confrim Password
                            </label>
                            <div>
                                <input
                                v-model="user.password_confirmation"
                                id="password_confirmation"
                                type="password"
                                placeholder="Confirm password"
                                 :class="{'border-red-600 text-red-600 dark:border-red-600 dark:text-red' : !!errors.password?.length , 'border-gray-300 text-gray-900 dark:border-gray-600 dark:text-white' : errors.password?.length <= 0}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                />
                            </div>
                            <p v-show="!!errors.password?.length" class="text-sm text-red-600 dark:text-red-500">
                                <span v-for="error,index in errors.email" :key="index">{{ error }}</span>
                            </p>
                        </div>
                        

                    
                        <button type="submit" :disabled="!!isloading" class="w-full col-span-2 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
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

export default {
    name: 'register',
    components:{Alert},
    data() {
        return {
            user: {},
            isloading:false,
            errors:[],
            message:null,
        };
    },
    methods: {
        authenticate() {
            this.isloading=true;
            this.errors = [];
            this.message = null;
           axios.post('/api/auth/register',this.user)
           .then(res => {
                this.$store.commit('login',res.data);
                this.$router.push('/dashboard');
           })
           .catch(err => {
                this.errors = err.response.data.errors;
                this.message = err.response.data.message;
           })
           .finally(()=> this.isloading=false);
        }
    },
    computed: {
        authError() {
            return this.$store.getters.authError;
        }
    },
}
</script>
<style lang="">

</style>
