@extends('layouts.admin')


@section('title', 'Edit Barangay') 

@section('content')
<h2 class="content-heading">Edit Barangay</h2>
<div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">Update The Fields Below</h3>
        <div class="block-options">
            <button type="button" class="btn-block-option">
                <i class="si si-wrench"></i>
            </button>
        </div>
    </div>
    <div class="block-content">
        <div class="row justify-content-center py-20">
            <div class="col-xl-6">
                <!-- jQuery Validation (.js-validation-material class is initialized in js/pages/be_forms_validation.js) -->
                <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                {{-- <form class="js-validation-material" action="{{ route('updateProfile') }}" method="post"> --}}

                    {{ Form::model($barangay, ['route' => ['barangays.update', $barangay->id ], 'method' => 'PUT']) }}



                    <div class="form-group">
                        <div class="form-material">

                            {{ Form::label('name', "Barangay Name:") }}

                            {{ Form::text('name', null, ['class' => 'form-control']) }}

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-material">

                            {{ Form::label('facebook_profile', "Facebook Profile") }}

                            {{ Form::text('facebook_profile', null, ['class' => 'form-control']) }}

                            
                        </div>
                    </div>


    
                    <div class="form-group row">
                        <div class="col-md-9">
                            <div class="form-material">
                                <input type="file" class="form-control barangay_hall_photo" id="barangay_hall_photo" name="barangay_hall_photo" placeholder="(PHP)">
                                <span class="danger">*If you don't have an image a default picture is uploaded.</span>
                                <label for="material-text">Update the Barangay Hall Photo </label>
                            </div>
                        </div>
                    </div>



                    <div class="form-group">
                        <button type="submit" class="btn btn-alt-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection


@section('js')


@endsection