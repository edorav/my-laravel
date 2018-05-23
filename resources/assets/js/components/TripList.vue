<template>

<div>

  <div v-for="trip in trips" class="card mb-5">
      <div class="card-header">Trips {{ trip.id }}</div>

      <div class="card-body">
          {{ trip.label }}

          <ul class="list-group list-group-flush">
            <li class="list-group-item" v-for="user in trip.users">{{user.firstname}} {{user.lastname}}</li>
          </ul>
      </div>
  </div>
  <infinite-loading 
    @infinite="infiniteHandler"
    spinner="spiral"
  ></infinite-loading>
</div>


</template>

<script>
// https://github.com/PeachScript/vue-infinite-loading
import InfiniteLoading from 'vue-infinite-loading';

  export default{
    components: { InfiniteLoading },
    props: {
        apiRoute: {
          type: String,
          required: true,
        },
        apiToken: {
          type: String,
          required: true
        },

    },
    mounted() {
      console.log( this.apiRoute , this.apiToken );
      
    },
    data: () => ({
      pagenumber: 0,
      lastPage: -1,
      trips: [],

        
    }),
    methods:{

      getHeaders(){
        return {
          headers :{ 
            Accept : 'application/json', 
            Authorization: 'Bearer ' + this.apiToken 
          }
        }
      },


      infiniteHandler($state) {
        console.log( this.pagenumber , this.lastPage);
        if ( this.pagenumber == this.lastPage ){
          $state.loaded();
        }else{

          this.pagenumber++;

          axios.post( this.apiRoute , { pagenumber : this.pagenumber} ,  this.getHeaders() )
          .then(response => {
              //console.log(response.data.data );
              this.trips = this.trips.concat( response.data.data );
              
              this.lastPage = response.data.last_page;
              //console.log($state);
              $state.loaded();
          })
          .catch(error => {
            //console.log(error);
          });
        }
      },
      
    }
}
</script>