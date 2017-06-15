import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import Example from './components/Example.vue'
import Create from './components/Create.vue'
import Edit from './components/Edit.vue'

let routes=[
    {path:'/',component:Example},
    {path:'/create',component:Create},
    {path:'/edit/:id',component:Edit,name:'edit'},
    
];

export default new VueRouter({
//        mode:'history',
        routes
});