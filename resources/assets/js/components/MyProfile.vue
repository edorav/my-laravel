<template>

<form ref="form" class="f1">
    <!-- {{ user }} -->

    <input type="text" name="firstname" v-model="user.firstname" placeholder="Email..." class="form-control" id="f1-email">
    <input type="text" name="lastname" v-model="user.lastname" placeholder="Email..." class="form-control" id="f1-email">
            
    <croppa 
        v-model="myCroppa"
        :prevent-white-space="true"
        :width="150"
        :height="150"
        :initial-image="defaultImage"></croppa>
    <div class="btns">
    <button @click.prevent="myCroppa.zoomIn()">zoom in</button>
    <button @click.prevent="myCroppa.zoomOut()">zoom out</button>

    <button @click.prevent="uploadCroppedImage()">Submit</button>

  </div>
</form>

    

</template>

<script>

import 'vue-croppa/dist/vue-croppa.css'
import Croppa from 'vue-croppa'

  export default{
    components: { 
        croppa : Croppa.component
    },
    props: {
        defaultImage:{
            type: String,
            required: true
        },
        submitRoute: {
          type: String,
          required: true,
        },
        apiToken: {
          type: String,
          required: true
        },
        user: {
          type: Object,
          required: true
        }
    },
    mounted() {
    },
    data: () => ({
        myCroppa: {},
        customHeaders: null,

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

        uploadCroppedImage() {
            this.myCroppa.generateBlob((blob) => {
                // write code to upload the cropped image file (a file is a blob)
                console.log(blob);
                var fd = new FormData()
                fd.append('picture', blob)
                fd.append('firstname', this.user.firstname )
                fd.append('lastname', this.user.lastname )
                axios.post( this.submitRoute , fd , this.getHeaders() )
                            .then(response => {

                            })
            }, 'image/jpeg', 0.8) // 80% compressed jpeg file
        }
      
    }
}
</script>