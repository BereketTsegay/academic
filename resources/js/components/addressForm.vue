<template lang="">
   <section class="bg-white dark:bg-gray-900">
  <div class="p-4 mx-auto max-w-2xl">
      <form @submit.prevent="submit">
          <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
              <div class="sm:col-span-2">
                  <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                  <input
                    type="email"
                    name="email"
                    v-model="address.email"
                    id="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Email Address">
              </div>
              <div class="sm:col-span-2">
                  <label for="tele" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telephone</label>
                  <phoneInput
                  id="tele" :phone="address.tele"
                  @phone_number="($event)=>{

                        address.phone_code_id=$event.code;
                        address.tele=$event.phone;
                  }">
                  </phoneInput>
              </div>
              <div class="sm:col-span-2">
                  <label for="pobox" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Po Box</label>
                  <input type="text" name="pobox" id="pobox" v-model="address.pobox"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                  placeholder="PO Box">
              </div>
              <div class="sm:col-span-2">
                  <label for="country" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>
                  <select @change="getCities(address.country)" id="country" v-model="address.country" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                      <option>Select Country</option>
                      <option :value="country.id" v-for="country in countries" :key="country.id">
                        {{ country.name }}
                      </option>

                  </select>
              </div>
              <div class="sm:col-span-2">
                  <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                  <select id="city" v-model="address.city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                      <option selected="">Select City</option>
                      <option :value="city.id" v-for="city in cities" :key="city.id">
                        {{ city.name }}
                      </option>

                  </select>
              </div>
              <div class="sm:col-span-2">
                  <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                  <textarea id="description" v-model="address.address" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Full Address"></textarea>
              </div>
              <div class="sm:col-span-2">
                    <input
                    v-model="address.is_default"
                    id="is_default"
                    type="checkbox"
                    :checked="address.is_default"
                    :value="address.is_default"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="is_default" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-500">Make default Address</label>
              </div>
          </div>
          <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-secondary-800">
              Save
          </button>
      </form>
  </div>
</section>
</template>
<script>
import phoneInput from './phoneInput.vue';
import { emailValidation } from '../library/validations';
export default {
    components:{phoneInput},
    props:['address','party_id'],
    name:"addre",
    data() {
        return {
            cities:[],
            countries:[],
            addresType:'App/Party',
        }
    },
    created() {
        this.getCountries();
        if(!!this.address.country) this.getCities(this.address.country);
        this.address.addressable_id=this.party_id;
        if(!this.address.addressable_type) this.address.addressable_type = this.addresType;
    },
    methods: {
        getCountries(){
            axios.get('/api/auth/countries').then(res=>{this.countries = res.data.payload;
                if(!this.address.country) {this.address.country = this.countries['293'].id;
                    this.getCities(this.address.country);
                }
            });
        },
        getCities(country){
            axios.get('/api/auth/cities/'+country).then(res=>this.cities = res.data.payload);
        },
        submit(){

            axios.post('/api/auth/party/'+this.party_id+'/address',this.address).then((res)=>{
                this.$emit('saveAdd',res.data.payload);
            }).catch((err)=>{
                console.log(err.data.message);
            });

        }
    },

}
</script>
<style lang="">

</style>
