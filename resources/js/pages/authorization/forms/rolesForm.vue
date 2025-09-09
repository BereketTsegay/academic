<template>
    <!-- Modal content -->
    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5" style="min-width: 44em;">
            <!-- Modal body -->
            <Alert v-if="!!hasErrors" message="Please Corrent the messages"></Alert>
            <form @submit.prevent="save">
                <div class="grid grid-cols-2 gap-4">
                    <div class="grid gap-2">
                        <InputField :errors="errors.tele??[]"
                            label="tele"
                            type="tel"
                            placeholder="Telephon"
                            :modelValue="record.name??''"
                            icon="phone"
                            @input="($event)=> record.name = $event.target.value">
                        </InputField>
                    </div>
                    <div class="grid gap-2">
                            <button type="submit" class="text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    Save
                            </button>
                    </div>
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
    }
 },
 methods: {
    save(){
        axios.post('/api/admin/roles/save',this.record).then(res => {
            this.$emit('updateData',res.data);
        }).catch(err => {

        });
    },

 },
}
</script>

<style lang="">

</style>
