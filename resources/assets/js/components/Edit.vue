<template>
    <div class="container">
        <form class="form-horizontal col-md-4 " @submit.prevent='editPost'>
    <div class="form-group">
      <label class="control-label col-sm-2" for="title">Title:</label>
      <div class="col-sm-10">
       <input type="text" class="form-control" id="title" placeholder="Enter title" v-model='posts.title'>
           <p class="form-text text-muted" v-if='error.title'>{{error.title[0]}} </p>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="description">Desc:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="description" placeholder="Enter description" v-model='posts.description'>
         <p class="form-text text-muted"  v-if='error.description'>{{error.description[0]}}</p>
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button class="btn btn-primary" >Submit</button>
      </div>
    </div>        
    </form>
    </div>
</template>

<script>
    //import {post} from '../router/api'
    import axios from 'axios'
    export default {
         data(){
           return{
               posts:{
                   title:'',
                   description:''
               },error:{}
           }  
         },
         created(){
             //`/api/recipes/${this.$route.params.id}`
             axios.get(`/api/posts/${this.$route.params.id}`).then((response)=>{
                 this.posts.title = response.data.posts.title;
                 this.posts.description = response.data.posts.description;
                 //this.$router.push('/');
             }).catch((error)=>{
                 console.log(error.response);
             });
         },
         methods:{
            editPost(){
              axios.put(`/api/posts/${this.$route.params.id}`,this.posts).then((response)=>{
                          //console.log(response.data.success);
//                         this.posts = '';
//                         this.error = '';
                         this.$router.push('/');
                      }).catch((error)=>{
                         this.error = error.response.data; 
                      }); 
            }
           }    
         }
 
</script>
