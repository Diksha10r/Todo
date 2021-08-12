<template>
    <div>
        <layout>
            <div class="container mx-auto">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                            <form>
                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="">
                                        <div class="mb-12">
                                            <label for="exampleFormControlInput1" class="block text-gray-700 text-lg font-bold mb-3">Awesome Todo List</label>
                                            <input type="text" class="shadow appearance-none border rounded xl:w-2/3 sm:w-1/8 md:w-1/7 py-3 px-4 text-gray-700 text-lg leading-tight focus:outline-none focus:shadow-outline mr-4" id="exampleFormControlInput1" placeholder="Enter Tasks"  v-model="task_name">
                                            <!-- <div v-if="$page.errors.task_name" class="text-red-500">{{ $page.errors.task_name[0] }}</div> -->
                                            <!-- <div v-for="d in data1" :key="d.id"> -->
                                            <select  class="shadow appearance-none xl:w-1/5 sm:w-1/7 md:w-1/7 bg-200 border border-gray-200 text-gray-700 text-lg py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 mr-4"  id="grid-state"  v-model="user_name">
                                                <!-- <option>{{ d.name }}</option> -->
                                                <option v-for="u in user" :key="u.id">{{u.id +' '+ u.name }}</option>
                                                <!-- <option>2</option> -->
                                            </select>
                                            <!-- {{ d.name }} -->
                                            <!-- </div>  -->
                                                <button wire:click.prevent="store()" type="button" class="shadow inline-flex justify-center xl:w-1/7 sm:w-1/8 md:w-1/7 rounded-md border border-transparent px-4 py-3 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" @click="save()">
                                                    Save
                                                </button>
                                        </div>
                                    </div>
                                    <div class="overflow-auto h-72">
                                        <div v-for="d in list" :key="d.task_id" class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert" >
                                            <div class="flex flex-wrap"  >
                                                <div class="xl:w-1/8" >
                                                    <input class="mr-2 leading-tight" v-if="d.completed=='no'"  type="checkbox" role="button" @click="update(d.task_id, d.task_name)">
                                                </div>

                                                <div class="xl:w-1/8"  >
                                                    <input class="mr-2 leading-tight" v-if="d.completed=='yes'" checked  disabled type="checkbox" role="button" @click="update(d.task_id, d.task_name)">
                                                </div>
                                                
                                                <div class="xl:w-3/4">
                                                    <input v-if="d.completed=='no'"  class="appearance-none bg-transparent border-none w-full text-gray-700 text-lg mr-3 py-1 px-2 leading-tight focus:outline-none mr-1" v-model="d.task_name" type="text">
                                                </div>

                                                <div class="xl:w-3/4">
                                                    <input  v-if="d.completed=='yes'" class="line-through appearance-none bg-transparent border-none w-full text-gray-500 text-lg mr-3 py-1 px-2 leading-tight focus:outline-none mr-1" v-model="d.task_name" type="text">
                                                </div>
                                               
                                                <div class="xl:w-1/5">
                                                    <button  type="button" @click="deletetask(d.task_id)" class="inline-flex float-right w-2 rounded-md border border-gray-300 px-4 py-2 bg-red-500 text-base leading-6 font-medium text-black-700 shadow-sm hover:bg-red-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                                    X
                                                    </button>
                                                </div>
                                            </div>
      
                                        </div>   
                                    </div> 
                                </div>
                            </form>
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
    // props:['name','surname'],

    components:{
        Layout
    },
    
    props: ['list', 'user', 'errors', 'data'],
        data() {
            return {
                task_name: '',
                user_name:'',
                user_id:'',
                check_task:false,
                employeeList:[],
                id:'',
                disable:false,
            }
        },
        methods: {

            reset: function () {
                
                this.task_name= '';
                this.user_name= '';
                
            },

            get_task: function() {
                const formData=new FormData()
                formData.append("id", "1")
                this.$inertia.post('/dashboard', formData)
                this.employeeList=data;
            },
       
            save: function () {
                var name= this.user_name.split(' ');
                console.log(name);
                var userId=0;
                const formData = new FormData();
                formData.append("task_name", this.task_name);
                for(var i=0; i<name.length; i++){
                    if((name[i]) == name[0]){
                        userId=Number.parseInt(name[i]);
                    }  
                }
                formData.append("user_id", userId);
                this.$inertia.post('/dashboard/store', formData)
                this.reset();
                
            },
            
            update: function (taskid, taskname) {
                    const formData = new FormData();
                    formData.append("task_id", taskid);
                    formData.append("task_name", taskname);
                    formData.append("status", "1");
                    formData.append("completed", "yes");
                     
                    this.$inertia.post('/dashboard/update', formData);
                    this.reset();
                    
                
            },

            deletetask: function (taskid) {
                if (!confirm('Are you sure want to remove?')) return;
                 
                const formData = new FormData();
                formData.append("task_id", taskid);
                formData.append("status", "0");

                this.$inertia.post('/dashboard/delete' ,formData);
                this.reset();
                
            }

        },
        created(){
            // this.user_id=this.$session.get('user_id');
        },
    
}
</script>