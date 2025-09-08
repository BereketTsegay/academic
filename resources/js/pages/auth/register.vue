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
                            <!-- <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
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
                            </p> -->
                            <InputField :errors="errors.name" label="Full Name" type="text" placeholder="Full Name" :modelValue="user.name??''" icon="i-cursor" @input="($event)=> user.name = $event.target.value" />
                        </div>
                        <div class="grid gap-2">
                            <InputField :errors="errors.email" label="Email" type="email" placeholder="Youremail@domain.com" :modelValue="user.email??''" icon="at" @input="($event)=> user.email = $event.target.value" />
                        </div>
                        <div class="grid gap-2">
                            <InputField :errors="errors.tele" label="tele" type="tel" placeholder="Telephon" :modelValue="user.tele??''" icon="phone" @input="($event)=> user.tele = $event.target.value" />
                        </div>
                        <div class="grid gap-2">
                        <SelectField :errors="errors.gender" label="Gender" :options="genderOptions"
                        placeholder="Telephon" :modelValue="user.gender??''" icon="venus-mars" @input="($event)=> user.gender = $event.target.value"/>
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
                            <InputField :errors="errors.password" label="Password" type="password" placeholder="Password" :modelValue="user.password??''" icon="lock" @input="($event)=> user.password = $event.target.value" />
                        </div>
                        <div class="grid gap-2">
                            <InputField :errors="errors.password_confirmation" label="Confrim Password" type="password" placeholder="Confrim Password" :modelValue="user.password_confirmation??''" icon="check-double" @input="($event)=> user.password_confirmation = $event.target.value" />
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
import InputField from '../../components/InputField.vue';
import SelectField from '../../components/selectField.vue';
import { setAuthorization } from '../../library/general';

export default {
    name: 'register',
    components:{Alert,InputField,SelectField},
    data() {
        return {
            user: {},
            isloading:false,
            errors:[],
            message:null,
            genderOptions:[{label:"Male",value:"Male"},{label:"Female", value:"Female"}],
        };
    },
    methods: {
        authenticate() {
            this.isloading=true;
            this.errors = [];
            this.message = null;
           axios.post('/api/auth/register',this.user)
           .then(res => {
                this.$store.commit("loginSuccess", res.data);
                setAuthorization(res.data.access_token);

                this.$router.push('/academia');
           })
           .catch(err => {
                this.errors = err.response.data.errors;
                this.message = err.response.data.message;
                this.isloading=false;
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
