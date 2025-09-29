<template>

        <div class="grid gap-2">
            <SelectField
             :errors="errors.name"
             label="Roles"
             :options="rols"
             optionLabel="name"
             optionValue="id"
             placeholder="Role"
             isMultiple="true"
             :modelValue="user.role_id??''"
             icon="briefcase"
             @input="($event)=> user.role_id = $event.target.value">
            </SelectField>
        </div>
</template>
<script>
import SelectField from './selectField.vue';
export default {
    components:{SelectField},
    name:'userRoleUpdate',
    props:['user'],
    data() {
        return {
            errors:[],
            rols:[],
        }
    },
    mounted() {
        this.getRols();
    },
    methods:{
        getRols(){
            //fetch roles from api and assign to rols
            axios.get('/api/admin/roles/roles')
            .then(res => this.rols = res.data)
            .catch(err => this.message = err.response.message);
        }
    },
}
</script>
<style>

</style>
