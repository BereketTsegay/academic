<template>

        <div class="grid gap-2">

            <SelectField
             :errors="errors.name"
             label="Roles"
             :options="rols"
             optionLabel="name"
             optionValue="id"
             placeholder="Role"
             :isMultiple="true"
             :modelValue="user.roles??[]"
             icon="briefcase"
             @input="($event)=> updateRoles($event)">
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
    created(){
        this.user.roles = this.user.roles.map(e=> e.id);
    },
    methods:{
        getRols(){
            //fetch roles from api and assign to rols
            axios.get('/api/admin/roles/roles')
            .then(res => this.rols = res.data)
            .catch(err => this.message = err.response.message);
        },
        updateRoles(value){
            console.log(value);
            //  axios.post('/api/admin/users/asignRole/'+this.user.id, {roles : this.user.roles})
            //  .then(res => this.user.roles = res.data)
            //  .catch(err => console.log(err.response.message))
            //  .finally();
        }
    },
}
</script>
<style>

</style>
