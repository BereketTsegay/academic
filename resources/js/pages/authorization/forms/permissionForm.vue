<template>
    <!-- Modal content -->
    <div class="relative max-w-sm p-4 bg-white shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal body -->
            <Alert v-if="!!message" :message="message"></Alert>
            <form @submit.prevent="save">
                <div class="grid grid-cols-2 gap-4">
                    <div class="grid gap-2 col-span-2">
                        <InputField :errors="errors.name??[]"
                            label="Permission Name"
                            type="text"
                            placeholder="Permission Name"
                            :modelValue="record.name??''"
                            icon="hands-holding-circle"
                            @input="($event)=> record.name = $event.target.value">
                        </InputField>
                    </div>
                    <button type="submit" :disabled="!!isloading" class="w-full col-span-2 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Save
                    </button>
                </div>
            </form>
        </div>
</template>
<script>
import Alert from '../../../components/alert.vue';
import InputField from "../../../components/InputField.vue";
export default {
 props: {record:{type:Object,required:true}},
 components:{InputField, Alert},
 data() {
    return {
        errors:[],
        message:null,
    }
 },
 methods: {
    save(){
        axios.post('/api/admin/permissions/save',this.record).then(res => {
            this.$emit('updateData',res.data);
        }).catch(err => {
            this.errors = err.response.data.errors;
            this.message = err.response.data.message;
           
        });
    },

 },
}
</script>

<style lang="">

</style>
