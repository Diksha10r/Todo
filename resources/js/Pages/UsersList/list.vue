<template>
    <div>
        <layout>
            <div class="container mx-auto">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div mb-10></div>
                            <table class="table table-fixed striped hovered ">
                                
                                    <tr>
                                        <th class="w-1/2">Id</th>
                                        <th class="w-1/4">Name</th>
                                        <th class="w-1/4">Email</th>
                                        <th class="w-1/4">No. of tasks assigned</th>
                                    </tr>
                                
                                    <tr v-for="ul in user_list" :key="ul.id">
                                        <td>{{ul.id}}</td>
                                        <td>{{ul.name}}</td>
                                        <td>{{ul.email}}</td>
                                        <td>{{ul.alltask}}</td>
                                    </tr>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </layout>
    </div>
</template>


<script >

import Layout from './../../Shared/layout.vue'

export default{
    props: ['user_list', 'errors'],
        data() {
            return {
                
                task_name: '',
                user_name:'',
                user_id:'',
                employeeList:[],
                id:'',
            }
        },
        methods: {

            reset: function () {
                this.form = {
                    task_name: null,
                    user_name: null,
                }
            },
          get_task: function() {
            const formData=new FormData()
            formData.append("id", "1")
            this.$inertia.post('/dashboard', formData)
            this.employeeList=data;
          },
        
            save: function () {
                const formData = new FormData();
                formData.append("task_name", this.task_name);
                formData.append("user_name", this.user_name);
                this.$inertia.post('/dashboard', formData)
                this.reset();
            },
            

        },
        components:{
            Layout,
            // InertiaLink : () => import('../app.js')
        },
    
    
    
}
</script>