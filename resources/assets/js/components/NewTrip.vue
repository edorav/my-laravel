<template>

<form ref="form" class="f1">
    <input type="hidden" name="_token" v-model="csrfToken">
    
    <h3>Register To Our App</h3>
    <p>Fill in the form to get instant access</p>
    <div class="f1-steps">
        <div class="f1-progress">
            <div class="f1-progress-line" :class="classProgress"></div>
        </div>
        <div :class="steps[0]">
            <div class="f1-step-icon"><i class="fa fa-plus"></i></div>
            <p>about</p>
        </div>
        <div :class="steps[1]">
            <div class="f1-step-icon"><i class="fa fa-calendar"></i></div>
            <p>account</p>
        </div>
        <div :class="steps[2]">
            <div class="f1-step-icon"><i class="fa fa-users"></i></div>
            <p>social</p>
        </div>
    </div>
        
        <div v-if="step === 1">
            <h4>Tell us who you are:</h4>
            <div class="form-group">
                <label for="f1-first-name">Nome</label>
                <input type="text" name="label" placeholder="Label..." v-model="trip.label" class="f1-first-name form-control" >
            </div>
            <div class="f1-buttons">
                <button type="button" class="btn btn-next" @click.prevent="next()">Next</button>
            </div>
        </div>

        <div v-if="step === 2">
            <h4>Set up your account:</h4>
            <div v-for="(city, index) in trip.cities">
              <div class="form-group">
                  <label for="f1-email">Citt&agrave;</label>
                  <vue-google-autocomplete
                      id="map"
                      classname="form-control"
                      placeholder="Start typing"
                      v-on:placechanged="getAddressData"
                      types="(cities)"
                  >
                  </vue-google-autocomplete>
                  <input type="text" name="email" v-model="trip.cities[index].name" placeholder="Email..." class="f1-email form-control" id="f1-email">
              </div>
              <div class="form-group">
                  <label for="f1-first-name">Dal</label>
                  <input type="date" name="from"  v-model="trip.cities[index].from" placeholder="Label..." class="f1-first-name form-control" >
              </div>
              <div class="form-group">
                  <label for="f1-first-name">Al</label>
                  <input type="date" name="to"  v-model="trip.cities[index].to" placeholder="Label..." class="f1-first-name form-control" >
              </div>
            </div>
            <button class="btn btn-previous" @click.prevent="addCity()"> Add City </button>
            <div class="f1-buttons">
                <button type="button" class="btn btn-previous" @click.prevent="prev()">Previous</button>
                <button type="button" class="btn btn-next" @click.prevent="next()">Next</button>
            </div>
        </div>

        <div v-if="step === 3">
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
    
    <pre> {{trip}} </pre>
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
        submitRoute: {
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
        classProgress: 'step-progress-1',
        steps: [
          {
            // First Step
            active: true,
            'activated': false,
            'f1-step': true,
          },
          {
            // Second Step
            active: false,
            'activated': false,
            'f1-step': true,
          },
          {
            // Third Step
            active: false,
            'activated': false,
            'f1-step': true,
          },
        ],

        trip:{
          label:null,
          cities: [{
            name: null,
            from: null,
            to: null,
          }],
          friends: [],
        },
    }),
    methods:{
      getData(obj){

        this.trip.friends.push({
          id: obj.id,
          fullname: obj.firstname + ' ' + obj.lastname
        });

      },

      addCity(){
        this.trip.cities.push({
          name: null,
          from: null,
          to: null,
        })
      },

      getAddressData( addressData, placeResultData, id ) {
            this.form.address = addressData;
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
        console.log( this.getHeaders());
        axios.post( this.submitRoute , this.trip , this.getHeaders() )
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