<template>

<form ref="form" :action="submitRoute" method="post" class="f1">
    <input type="hidden" name="_token" v-model="csrfToken">
    <input type="text" name="final_form" v-model="finalForm">
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
              :customHeaders="{ Accept : 'application/json', Authorization: 'Bearer 5af9ce0ed5c2c' }"
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

  export default{
    components: { Autocomplete },
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
        }
    },
    mounted() {
    },
    data: () => ({
        step:1,
        classProgress: 'step-progress-1',
        steps: [
          {
            active: true,
            'activated': false,
            'f1-step': true,
          },
          {
            active: false,
            'activated': false,
            'f1-step': true,
          },
          {
            active: false,
            'activated': false,
            'f1-step': true,
          },
        ],
        finalForm: null,
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
      submit() {
        this.finalForm = JSON.stringify({
          label: this.trip.label,
          friends: this.trip.friends,
          cities: this.trip.cities
        });
        this.submitForm();
      },
      submitForm(){
        this.$refs.form.submit();
      },
      addCity(){
        this.trip.cities.push({
          name: null,
          from: null,
          to: null,
        })
      }
    }
}
</script>