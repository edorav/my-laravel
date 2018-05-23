<template>

<div id="googleMap" style="min-width: 500px; min-height: 500px;">
</div>


</template>

<script>


  export default{
    props: {
        tripDays: {
          type: Array,
          required: true,
        },
        /*
        apiRoute: {
          type: String,
          required: true,
        },
        apiToken: {
          type: String,
          required: true
        },*/

    },
    mounted() {
        console.log(this.tripDays);
        this.map = new google.maps.Map(document.getElementById('googleMap'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 2
        });

        for ( var i = 0; i < this.tripDays.length; i++) {  
            this.marker = new google.maps.Marker({
                position: new google.maps.LatLng(
                                    this.tripDays[i].latitude, 
                                    this.tripDays[i].longitude
                                ),
                map: this.map
            });

            /*google.maps.event.addListener(this.marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(this.tripDays[i][0]);
                    infowindow.open(this.map, marker);
                }
            })(this.marker, i));*/
        }

      
    },
    data: () => ({
      map : null,

        
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
        console.log('qua');
        this.pagenumber++;
        axios.post( this.apiRoute , { pagenumber : this.pagenumber} ,  this.getHeaders() )
        .then(response => {
            //console.log(response.data.data );
            this.trips = this.trips.concat( response.data.data );
          
            console.log($state);
            $state.loaded();
        })
        .catch(error => {
          console.log(error);
        });
      },
      
    }
}
</script>


