<template>

<form role="form" :action="submitRoute" method="post" class="f1">
    <input type="hidden" name="_token" v-model="csrfToken">
    <h3>Register To Our App</h3>
    <p>Fill in the form to get instant access</p>
    <div class="f1-steps">
        <div class="f1-progress">
            <div class="f1-progress-line" :class="classProgress"></div>
        </div>
        <div :class="steps[0]">
            <div class="f1-step-icon"><i class="fa fa-user"></i></div>
            <p>about</p>
        </div>
        <div :class="steps[1]">
            <div class="f1-step-icon"><i class="fa fa-key"></i></div>
            <p>account</p>
        </div>
        <div :class="steps[2]">
            <div class="f1-step-icon"><i class="fa fa-twitter"></i></div>
            <p>social</p>
        </div>
    </div>
        
        <fieldset v-if="step === 1">
            <h4>Tell us who you are:</h4>
            <div class="form-group">
                <label class="sr-only" for="f1-first-name">First name</label>
                <input type="text" name="label" placeholder="Label..." v-model="trip.label" class="f1-first-name form-control" >
            </div>
            <div class="form-group">
                <label class="sr-only" for="f1-last-name">Last name</label>
                <input type="text" name="f1-last-name" placeholder="Last name..." class="f1-last-name form-control" id="f1-last-name">
            </div>
            <div class="form-group">
                <label class="sr-only" for="f1-about-yourself">About yourself</label>
                <textarea name="f1-about-yourself" placeholder="About yourself..." 
                                        class="f1-about-yourself form-control" id="f1-about-yourself"></textarea>
            </div>
            <div class="f1-buttons">
                <button type="button" class="btn btn-next" @click.prevent="next()">Next</button>
            </div>
        </fieldset>

        <fieldset v-if="step === 2">
            <h4>Set up your account:</h4>
            <div class="form-group">
                <label class="sr-only" for="f1-email">Email</label>
                <input type="text" name="f1-email" placeholder="Email..." class="f1-email form-control" id="f1-email">
            </div>
            <div class="form-group">
                <label class="sr-only" for="f1-password">Password</label>
                <input type="password" name="f1-password" placeholder="Password..." class="f1-password form-control" id="f1-password">
            </div>
            <div class="form-group">
                <label class="sr-only" for="f1-repeat-password">Repeat password</label>
                <input type="password" name="f1-repeat-password" placeholder="Repeat password..." 
                                    class="f1-repeat-password form-control" id="f1-repeat-password">
            </div>
            <div class="f1-buttons">
                <button type="button" class="btn btn-previous" @click.prevent="prev()">Previous</button>
                <button type="button" class="btn btn-next" @click.prevent="next()">Next</button>
            </div>
        </fieldset>

        <fieldset v-if="step === 3">
            <h4>Social media profiles:</h4>
            <div class="form-group">
                <label class="sr-only" for="f1-facebook">Facebook</label>
                <input type="text" name="f1-facebook" placeholder="Facebook..." class="f1-facebook form-control" id="f1-facebook">
            </div>
            <div class="form-group">
                <label class="sr-only" for="f1-twitter">Twitter</label>
                <input type="text" name="f1-twitter" placeholder="Twitter..." class="f1-twitter form-control" id="f1-twitter">
            </div>
            <div class="form-group">
                <label class="sr-only" for="f1-google-plus">Google plus</label>
                <input type="text" name="f1-google-plus" placeholder="Google plus..." class="f1-google-plus form-control" id="f1-google-plus">
            </div>
            <div class="f1-buttons">
                <button type="button" class="btn btn-previous" @click.prevent="prev()">Previous</button>
                <button type="submit" class="btn btn-submit" @click.prevent="submit()">Submit</button>
            </div>
        </fieldset>
    
    <br/><br/>Debug: {{trip}}
    </form>

    

<!--
<div>

  <form method="post" :action="submitRoute">
   
  <form method="post" :action="submitRoute">
  <input type="hidden" name="_token" v-model="csrfToken">
  <div v-if="step === 1">

    <h1>Step One</h1>
    <p>
    <legend for="name">Label:</legend>
    <input id="name" name="label"   v-model="trip.label">
    </p>


    <button @click.prevent="next()" class="btn btn-primary">Next</button>
    
  </div>

  <div v-if="step === 2">
    <h1>Step Two</h1>
    <p>
    <legend for="street">Your Street:</legend>
    <input id="street" name="street" v-model="registration.street">
    </p>

    <p>
    <legend for="city">Your City:</legend>
    <input id="city" name="city" v-model="registration.city">
    </p>

    <p>
    <legend for="state">Your State:</legend>
    <input id="state" name="state" v-model="registration.state">
    </p>

    <button @click.prevent="prev()" class="btn btn-default">Previous</button>
    <button @click.prevent="next()" class="btn btn-primary">Next</button>

  </div>

  <div v-if="step === 3">
    <h1>Step Three</h1>
    
    <p>
    <legend for="numtickets">Number of Tickets:</legend>
    <input id="numtickets" name="numtickets" type="number" v-model="registration.numtickets">
    </p>

    <p>
    <legend for="shirtsize">Shirt Size:</legend>
    <select id="shirtsize" name="shirtsize" v-model="registration.shirtsize">
      <option value="S">Small</option>
      <option value="M">Medium</option>
      <option value="L">Large</option>
      <option value="XL">X-Large</option>
    </select>
    </p>

    <button @click.prevent="prev()" class="btn btn-primary">Previous</button>
    <button @click.prevent="submit()" class="btn btn-success">Save</button>
    
  </div>
  </form>

  <br/><br/>Debug: {{trip}}
</div>
-->
</template>

<script>
  export default{
    props: {
        csrfToken: {
            type: String,
            required: true,
        },
        submitRoute: {
            type: String,
            required: true,
        }
    },
    mounted() {
      console.log( this._props.csrf);

      //this.csrf = this._props.csrf;
    },
    /*props: ['csrf', 'submitroute'],*/
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
        trip:{
          label:null,
          email:null,
          street:null,
          city:null,
          state:null,
          numtickets:0,
          shirtsize:'XL'
        },
        registration:{
          name:null,
          email:null,
          street:null,
          city:null,
          state:null,
          numtickets:0,
          shirtsize:'XL'
        },
        sizes:['S','M','L','XL']
    }),
    methods:{
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
        alert('This is the post. Blah');
      }
    }
}
</script>