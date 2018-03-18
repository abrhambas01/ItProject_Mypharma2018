@extends('layouts.admin')

@section('title', 'Welcome Admin')

@section('content')


{{-- If User has an information Show the Modal for Displaying --}}
{{-- if logged on user currently has an information show the modal where to update teh form  --}}

@if(is_null($users_information))

<script>
  provideInformation();
</script>



@else


<script>

  console.log('0');

</script>

@endif 



@include('admin.content.dashboard-widgets')

@include('admin.modals.add_medicine_modal')

@include('admin.modals.register_barangay_modal')

@include('admin.modals.add_user_modal')






@endsection

@section('js')

{{ HTML::script('assets/js/plugins/chartjs/Chart.bundle.min.js') }}
{{ HTML::script('assets/js/pages/be_pages_dashboard.js') }}

<script src="http://api.mygeoposition.com/api/geopicker/api.js" type="text/javascript"></script>


<script type="text/javascript">
  function lookupGeoData() {            
    myGeoPositionGeoPicker({
      startAddress     : 'Cebu City Hall',
      returnFieldMap   : {
       'geoposition1a' : '<LAT>',
       'geoposition1b' : '<LNG>',
       'geoposition1c' : '<CITY>',
       'full_address' : '<ADDRESS>'
     }
   });
  }
</script>





@endsection   