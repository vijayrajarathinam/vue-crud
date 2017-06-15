<template>
    <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th >title</th>
                        <th >description</th>
                        <th >created_at</th>
                        <th >options</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="post in posts">
                        <td> 
                           {{post.title}}
                        </td>
                        <td>
                           {{post.description}} 
                        </td>
                        <td>
                           {{post.created_at}}
                        </td>
                        <td>
                <router-link :to="`/edit/${post.id}`" tag='button' class='btn btn-info' id="tooltip-top" data-placement='top' data-toggle='tooltip' data-original-title='Edit'  data-rel="tooltip"  title=""><i class='fa fa-pencil'></i></router-link>                                                                       
                <button @click='remove(post)' class='btn btn-danger' data-original-title="Full Details" id="tooltip-top" data-placement="top" data-toggle="tooltip" title=""><i class="fa fa-trash"></i></button>
                        </td>
                    </tr> 

                </tbody>
            </table>
        </div>
</template>

<script>
    import axios from 'axios'
    export default {
        data(){
            return{
                posts:{}
            }
        },created(){
            axios.get('/api/posts').then((response)=>{
                //console.log(response.data.posts);
                this.posts=response.data.posts;
            })
        },methods:{
            remove(post){
             let ok =confirm('are you sure you want to delete?');
             if(ok){
             axios.delete('/api/posts/'+post.id).then((response)=>{
                 //this.$router.push('/');
                 const idx=this.posts.indexOf(post);
                 this.posts.splice(idx,1);
             }).catch((error)=>{
                 console.log(error);
             });
             }   
            }
        }
    }
</script>
