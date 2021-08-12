<template>
    <div>
         <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a  class="navbar-brand" href="/" role="button">Todo_App</a>
                <!-- <inertia-link class="navbar-brand" href='/'>Todo_App</inertia-link> -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item" >
                            <!-- <inertia-link class="navbar-brand" href='/users/list'>Users</inertia-link> -->
                            <a class="nav-link text-black-700 text-lg" href="/users/list" role="button"> 
                                Users  
                            </a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown" >
                                <a id="navbarDropdown" v-model="u.name" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>   
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#" @click="handleLogout">
                                        Logout
                                    </a>
                                </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
           <slot/>
        </main>
    </div>
</template>
<script>

import axios from 'axios';

export default {
    props:['list','user', 'user_id' ,'user_details'],
    methods: {
        async handleLogout(){
            await axios.post('/logout',{});
            window.location.href="/";

        }
    },
    // components:{
    //     InertiaLink : () => import('../app.js')
    // }
}
</script>