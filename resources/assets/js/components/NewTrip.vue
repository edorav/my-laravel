<template>

<form ref="form" class="f1">
    <input type="hidden" name="_token" v-model="csrfToken">
    
        <div v-if="step === 1">
            <h4>Set Cities:</h4>
            <label for="f1-email">Citt&agrave;</label>
            <div class="form-group">
                  <vue-google-autocomplete
                      id="map"
                      classname="form-control"
                      placeholder="Start typing"
                      v-on:placechanged="getAddressData"
                      types="(cities)"
                  >
                  </vue-google-autocomplete>
            </div>
            <div class="form-group">
                <label for="f1-first-name">Dal</label>
                <input type="date" name="from"  v-model="input.from" placeholder="Label..." class="f1-first-name form-control" >
            </div>
            <div class="form-group">
                <label for="f1-first-name">Al</label>
                <input type="date" name="to"  v-model="input.to" placeholder="Label..." class="f1-first-name form-control" >
            </div>
            
            <button class="btn btn-previous" @click.prevent="addTripDay()"> Add City </button>

            <div v-for="(data, index) in tripDay">
              {{ data.city.locality }}
              {{ data.from }}
              {{ data.to }}
            </div>

            
            <div class="f1-buttons">
                <button type="button" class="btn btn-previous" @click.prevent="prev()">Previous</button>
                <button type="button" class="btn btn-next" @click.prevent="next()">Next</button>
            </div>
        </div>

        <div v-if="step === 2">
            <h4>Social media profiles:</h4>
            <autocomplete
              :url="friendshipRoute"
              :classes="{ wrapper: 'form-group', input: 'f1-email form-control', list: 'data-list', item: 'data-list-item' }"
              anchor="firstname"
              label="writer"
              :customHeaders="customHeaders"
              :on-select="getData">
            </autocomplete>
            <div >
              <ul v-for="(friend, index) in trip.friends">
                <li> {{ friend.fullname }} </li>
              </ul>
            </div>
            <div class="f1-buttons">
                <button type="button" class="btn btn-previous" @click.prevent="prev()">Previous</button>
                <button type="submit" class="btn btn-submit" @click.prevent="submit()">Submit</button>
            </div>
        </div>
    <pre> {{tripParent}} </pre>
    <pre> {{input}} </pre>
    <pre> {{form}} </pre>
  </form>

    

</template>

<script>

import Autocomplete from 'vue2-autocomplete-js';
import VueGoogleAutocomplete from 'vue-google-autocomplete';

  export default{
    components: { Autocomplete , VueGoogleAutocomplete },
    props: {
        csrfToken: {
          type: String,
          required: true,
        },
        storeUsersRoute: {
          type: String,
          required: true,
        },
        storeCitiesRoute: {
          type: String,
          required: true,
        },
        friendshipRoute: {
          type: String,
          required: true
        },
        apiToken: {
          type: String,
          required: true
        },
        tripParent: {
          type: Object,
          required: true
        }
    },
    mounted() {
      this.customHeaders = { 
          Accept : 'application/json', 
          Authorization: 'Bearer ' + this.apiToken 
      };
    },
    data: () => ({
        step:1,
        customHeaders: null,

        input: {
          city: {},
          from: null,
          to: null
        },

        
        tripDay: []
        

        
    }),
    methods:{
      getData(obj){

        this.trip.friends.push({
          id: obj.id,
          fullname: obj.firstname + ' ' + obj.lastname
        });

      },

      addTripDay(){
        this.tripDay.push( this.input )
      },

      getAddressData( addressData, placeResultData, id ) {
            this.input.city = addressData;
      },

      prev() {
        this.steps[this.step - 1].active = false;
        this.steps[this.step - 2].active = true;
        this.steps[this.step - 2].activated = false;
        this.step--;
        this.classProgress= 'step-progress-' + this.step;
      },

      next() {
        this.steps[this.step].active = true;
        this.steps[this.step - 1 ].active = false;
        this.steps[this.step - 1 ].activated = true;
        this.step++;
        this.classProgress= 'step-progress-' + this.step;
      },

      getHeaders(){
        return {
          headers :{ 
            Accept : 'application/json', 
            Authorization: 'Bearer ' + this.apiToken 
          }
        }
      },

      submit() {

        axios.post( this.storeCitiesRoute , this.trip , this.getHeaders() )
                .then(response => {
                    this.form.name = '';
                    this.form.scopes = [];
                    this.form.errors = [];

                    this.tokens.push(response.data.token);

                    //this.showAccessToken(response.data.accessToken);
                })
                .catch(error => {
                    if (typeof error.response.data === 'object') {
                        this.form.errors = _.flatten(_.toArray(error.response.data.errors));
                    } else {
                        this.form.errors = ['Something went wrong. Please try again.'];
                    }
                });
      }
      
    }
}
</script>