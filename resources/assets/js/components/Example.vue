<template>
    <div>
    <div class="container">
    <form class="form-inline">
    <div class="form-group">
      <button class="btn btn-info" @click="prev()"><i class="fa fa-chevron-left"></i></button>
      <button class="btn btn-info" @click="next()"><i class="fa fa-chevron-right"></i></button>
      <label for="email">Displaying:</label>
      <p class="form-control-static">{{posts.from}} - {{posts.to}} of {{posts.total}} rows</p>
    </div>
<!--    <div class="form-group">
      <label for="pwd">Search:</label>
      <div class="form-group">
       <select class="form-control" id="pwd" name="pwd">
          <option v-for='column in columns' :value='column'>{{column}}</option>
      </select>      
      </div>
            
      <div class="form-group">
      <select class="form-control" id="pwd" name="pwd">
          <option>=</option>
      </select>
      </div>
    <div class="form-group">
      <input type="text" class="form-control" id="pwd" placeholder="" name="pwd">
    </div>
    </div>-->
    <!--<button type="submit" class="btn btn-default">Filter</button>-->
  </form>
    </div> 
    <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th @click="toggleOrder(column)" v-for='column in columns'>{{column}}
                            <span v-if="query.column===column">
                                <span v-if="query.direction=='desc'">&uarr;</span>
                                <span v-if="query.direction=='asc'">&darr;</span>
                            </span>    
                        </th>
<!--                        <th >title</th>
                        <th >description</th>
                        <th >created_at</th>
                        <th >options</th>-->
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="post in posts.data">
                        <td>{{post.id}}</td>
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
</div>
</template>

<script>
    import axios from 'axios'
    export default {
        data(){
            return{
                search:'',
                posts:{},
                columns:{},
                query:{
                    page: 1,
                    column:'id',
                    direction:'desc',
                    per_page: 10
                }
            }
        },created(){
            this.fetchIndexData();
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
            },
            fetchIndexData(){
               axios.get(`/api/posts?column=${this.query.column}&direction=${this.query.direction}&page=${this.query.page}&per_page=${this.query.per_page}`).then((response)=>{
                //console.log(response.data.posts);
                this.posts=response.data.posts;
                this.columns=response.data.columns;
                this.columns.push('options');
            }).catch(error=>{
                console.log(error);
            }) 
            },
            toggleOrder(column){
                if(column === this.query.column){
                    if(this.query.direction === 'desc'){
                        this.query.direction = 'asc';
                    }else{
                        this.query.direction = 'desc';
                    }
                }else{
                    this.query.column = column;
                    this.query.direction = 'asc';
                }
               this.fetchIndexData(); 
            },
            next(){
                if(this.posts.next_page_url){
                    this.query.page++;
                    this.fetchIndexData();
                }
            },prev(){
                if(this.posts.prev_page_url){
                    this.query.page--;
                    this.fetchIndexData();
                }
            }
        }
    }
</script>
