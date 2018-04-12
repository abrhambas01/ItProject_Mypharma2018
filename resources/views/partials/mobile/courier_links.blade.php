<router-link to="/" exact tag="li">
  <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>Home
</router-link>


<router-link to="/pickup/parcels" exact tag="li">
  <a class="no-child">
    <i class="ion-ios-box-outline"></i>Parcels to Pick up
    <span class="badge">{{ $parcelsToPickUp }} </span>
  </a>
</router-link>

<router-link to="/deliveries/today" tag="li">
  <a class="no-child">
    <i class="ion-bag"></i>Todays Deliveries
    <span class="badge">{{ $todaysDeliveries }} </span>
  </a>
</router-link>


<router-link to="/deliveries/pending" tag="li">
  <a class="no-child">
    <i class="ion-ios-paper-outline"></i>Pending Deliveries
    <span class="badge">{{ $pendingDeliveries }} </span>
  </a>
</router-link>



<li>

  <div class="collapsible-header">
    <i class="ion-chevron-down"></i> Account 
  </div>
  
  <div class="collapsible-body">
    <ul class="collapsible">

      <router-link to="/profile" tag="li">
        <a class="no-child">
          <i class="ion-person"></i>Profile
        </a>
      </router-link>



      <router-link to="/profile/update" tag="li">
        <a class="no-child">
          <i class="ion-compose"></i>Update Profile
        </a>
      </router-link>



    </ul>
  </div>  

</li>

<router-link to="/lock" tag="li">
  <a class="no-child">
    <i class="ion-locked"></i>Lock
  </a>
</router-link>

<li><a href="/logout" class="no-child"><i class="ion-log-out"></i>Logout</a></li>




{{-- <li><a href="http://www.codnauts.com/themes/jetpack/shop.html" class="no-child"><i class="ion-ios-cart-outline"></i> Shop</a></li> --}}

{{-- 
      <router-link to="/" tag="li" class="no-child" exact >
        <a href="/"><i class="ion-ios-home-outline"></i>Home</a>
      </router-link>


      <router-link to="/today" tag="li" class="no-child">
        <a href=""><i class="ion-ios-cart-outline"></i>Today Deliveries<span class="badge">5</span></a>
      </router-link>


      <router-link to="/archived" tag="li" class="no-child">
        <a href=""><i class="ion-ios-paper-outline"></i>Pending Deliveries<span class="badge">5</span></a>
      </router-link> --}}

{{-- 
     
  --}}