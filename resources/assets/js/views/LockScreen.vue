<template>
 <div class="page fullscreen bg-blur animated fadeinright">

  <!-- Clock -->
  <div class="clock center-align animated fadein delay-2">
    <h2>13:45</h2>
    <span>Monday, June 20</span>
  </div>

  <ul class="collection notify">
    <li class="collection-item white z-depth-1 dismissable animated fadeinup delay-2">
      <div class="notify-header">
        <img class="avatar circle" src="img/user4.jpg" alt="">
        <div class="notify-author">
          <span>Luke Mott</span>
          <span class="truncate">Parcel#2</span>
          <span class="small"></span>
        </div>
      </div>
    </li>


    <li class="collection-item white z-depth-1 dismissable animated fadeinup delay-2">
      <div class="notify-header">
        <img class="avatar circle" src="img/user4.jpg" alt="">
        <div class="notify-author">
          <span>Luke Mott</span>
          <span class="truncate">Parcel#2</span>
          <span class="small"></span>
        </div>
      </div>
    </li>
    
  </ul>

  <!-- Unlock -->
  <div class="animated bouncein delay-6">
    <div class="unlock">
      <router-link to="/" exact tag="li">
        <i class="ion-android-lock"></i>
      </router-link>
    </div>
  </div>

</div> 
<!-- End of Page Contents -->

</template>

<script>

import moment from 'moment';

export default {

  name: 'LockScreen',
  data () {

    return {
      parcels : [] ,
      currentTime : null
    };


  },

  methods : {

    fetchDeliveries(){

    },

    startTime(){
      
    }

  }
};
</script>

<style lang="css" scoped>
</style>