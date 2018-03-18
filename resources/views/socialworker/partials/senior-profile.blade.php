<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row heading-bg bg-blue">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h5 class="txt-light">myPharma</h5>
			</div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li><a href="#">Social Worker</a></li>
					<li><a href="#">Dashboard</a></li>
					<li class="active"><a href="#"><span>Senior Citizen Profile</span></a></li>
				</ol>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-sm-12">
				<div class="panel panel-default card-view">
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-dark">Senior Citizen Profile</h6>
						</div>
						<div class="clearfix"></div>
					</div>
					
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							@include('errors.list')
							@if(Session::has('message'))
							<div class="alert alert-success">{{ Session::get('message')}}</div>
							@endif		
							<p class="text-muted"><code></code> </p>
							<div  class="tab-struct mt-40">
								<ul role="tablist" class="nav nav-tabs" id="myTabs_1">
									<li class="active" role="presentation"><a aria-expanded="true"  data-toggle="tab" role="tab" id="home_tab_1" href="#personal_info">Personal Information</a></li>
									<li role="presentation" class=""><a  data-toggle="tab" id="profile_tab_2" role="tab" href="#medicine_list" aria-expanded="false">Medicine List</a></li>
									<li role="presentation" class=""><a  data-toggle="tab" id="profile_tab_3" role="tab" href="#pastmedicine_list" aria-expanded="false">Past Medicine List</a></li>
								</ul>
								<div class="tab-content" id="myTabContent_1">
									<div  id="personal_info" class="tab-pane fade active in" role="tabpanel">
										<div class="row">
											<div class="col-sm-12 col-xs-12">
												<div class="form-wrap">
													{!!Form::open(array('route'=>'updateSeniorCitizenProfile', 'seniorcitizen_id' => 'example-advanced-form', 'method' => 'PUT'))!!}

													{!! Form::token() !!}  
													<div class="form-body">
														<h6 class="txt-dark capitalize-font"><i class="icon-user mr-10"></i>Senior Citizen's Info</h6>
														<hr>
														<div class="row">
															<div class="col-md-3">
																<div class="form-group">
																	<label class="control-label mb-10">SCN</label>
																	<p class="form-control-static">{{$seniorcitizens->id}}</p>
																	<input type="hidden" name="budget" class="form-control" value="1000">
																	<input type="hidden" name="seniorcitizen_id" id="seniorcitizen_id" class="form-control" value="{{$seniorcitizens->id}}">
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label mb-10">First Name</label>

																	<p class="form-control-static"><input type="text" name="first_name" id="first_name" class="form-control pl-30" value="{{$seniorcitizens->first_name}}"></p>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label mb-10">Middle Name</label>
																	<p class="form-control-static"><input type="text" name="middle_name" id="middle_name" class="form-control pl-30" value="{{$seniorcitizens->middle_name}}"></p>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label mb-10">Last Name</label>
																	<p class="form-control-static"><input type="text" name="last_name" id="last_name" class="form-control pl-30" value="{{$seniorcitizens->last_name}}"></p>
																</div>
															</div>
															<!--/span-->
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label mb-10">Date Of Birth</label>
																	<p class="form-control-static">{{Carbon\Carbon::parse($seniorcitizens->dob)->format('m/d/Y')}}</p>
																</div>
															</div>
															<!--/span-->
														</div>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label mb-10">Address</label>
																	<p class="form-control-static">{{$seniorcitizens->address}}</p>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label mb-10">Gender</label>
																	<p class="form-control-static">{{$seniorcitizens->gender}}</p>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label mb-10">Telephone #</label>
																	<p class="form-control-static"><input type="text" name="telephone" id="telephone" class="form-control pl-30" value="{{$seniorcitizens->telephone}}"></p>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label mb-10">Mobile #</label>
																	<p class="form-control-static"><input type="text" name="mobile" id="mobile" class="form-control pl-30" value="{{$seniorcitizens->mobile}}"></p>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label mb-10">Caretaker's Name</label>
																	<p class="form-control-static"><input type="text" name="caretakers_name" id="caretakers_name" class="form-control pl-30" value="{{$seniorcitizens->caretakers_name}}"></p>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label mb-10">Caretaker's Number</label>
																	<p class="form-control-static"><input type="number" name="caretakers_number" id="caretakers_number" class="form-control pl-30" value="{{$seniorcitizens->caretakers_number}}"></p>
																</div>
															</div>
														</div>
													</div>
													<div class="form-actions mt-10">
														<center><button type="submit" class="btn btn-success  mr-10"> Update</button></center>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
								{!!Form::close()!!}
								<div  id="medicine_list" class="tab-pane fade " role="tabpanel">
									<h6 class="txt-dark capitalize-font"><i class="icon-user mr-10"></i>Senior Citizen's Medicine List</h6>
									<hr>
									<div class="row">
										<div class="col-sm-12 col-xs-12">
											<div class="form-wrap">
												<table class="table">
													<thead>
														<tr>	
															<th>Name</th>
															<th>Qty</th>				
															<th>Price</th>
														</tr>
													</thead>
													@foreach($seniorcitizens->medicines as $med)
													@if($med->pivot->status === 1)
													<tbody>
														<tr>
															<td>{{$med->name}}</td>
															<td>{{$med->pivot->qty}}</td>
															<td>{{$med->price}}</td>
															<td>{!!Form::open(array('route'=>['updateMedicineStatus', $med->pivot->medicine_id], 'onsubmit' => 'return ConfirmStatusChange()', 'method'=>'PUT'))!!}
																{{ link_to_route('addQuantity', 'Add Quantity', [$med->pivot->medicine_id] , ['class' => 'btn btn-primary'])}}
																|
																{!!Form::button('Remove', ['class'=>'btn btn-danger', 'type'=>'submit'])!!}
															</td>	
														</tr>
														{!!Form::close()!!}
													</tbody>
													@endif
													@endforeach
												</table>
												<div class="form-actions mt-10">
													{!!Form::open(array('route'=>'updateMedicineList', 'seniorcitizen_id' => 'example-advanced-form', 'method' => 'post'))!!}
													<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
														<div class="modal-dialog modal-lg">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																	<h5 class="modal-title" id="myLargeModalLabel">Medicine List</h5>
																</div>
																<div class="modal-body">
																	<div class="row">
																		<div class="col-sm-12 col-xs-12">
																			<table class="table table-bordered">
																				<thead>
																					<th>Medicine Name</th>
																					<th>Qty</th>
																					<th>Price</th>
																				</thead>
																				<tbody>
																					<tr>
																						<input type="hidden" id="status" name="status" value="pending">
																						<input type="hidden" name="id" id="id" value="{{$seniorcitizens->id}}">
																						<td>
																							<select name="medicine" class="form-control select2" id ="medicine">
																								<option value="0" selected="true" disabled="true">Select Medicine</option>
																								@foreach($medicines as $key => $m)
																								<option  value="{!! $key !!}">{!! $m !!}</option>
																								@endforeach
																							</select>
																						</td>
																						<td>
																							<input id="qty" type="number" name="qty" class="form-control required" required="" value="" />
																						</td>
																						<td>
																							<input id="price" type="text" name="price" class="form-control required" value="" disabled="true" />
																						</td>
																					</tr>
																					<tr>
																						<td>
																							<select name="medicine2" class="form-control select2" id ="medicine2">
																								<option value="0" selected="true" disabled="true">Select Medicine</option>
																								@foreach($medicines as $key => $m)
																								<option value="{!! $key !!}">{!! $m !!}</option>
																								@endforeach
																							</select>
																						</td>
																						<td>
																							<input id="qty2" type="number" name="qty2" class="form-control" value="" />
																						</td>
																						<td>
																							<input id="price2" type="text" name="price2" class="form-control required" value="" disabled="true" />
																						</td>
																					</tr>
																				</tbody>
																			</table>
																		</div>
																	</div>
																</div>
																<div class="modal-footer">
																	<center>{!!Form::submit('Add', array('class' => 'btn btn-primary'))!!}</center>
																</div>
															</div>
															{!!Form::hidden('_token', csrf_token())!!}
															{!!Form::close()!!}
															<!-- /.modal-content -->
														</div>
														<!-- /.modal-dialog -->
													</div>
													<center><button type="submit" class="btn btn-success  mr-10" data-toggle="modal" data-target=".bs-example-modal-lg" > Add Medicine</button></center>
												</div>
												<div class="spacer"></div>		
											</div>
										</div>
									</div>
								</div>
								<div  id="pastmedicine_list" class="tab-pane fade " role="tabpanel">
									<h6 class="txt-dark capitalize-font"><i class="icon-user mr-10"></i>Senior Citizen's Medicine History</h6>
									<hr>
									<div class="row">
										<div class="col-sm-12 col-xs-12">
											<div class="form-wrap">
												<table class="table">
													<thead>
														<tr>	
															<th>Name</th>
															<th class="column-spacer"></th>
															<th></th>
														</tr>
													</thead>
													@foreach($seniorcitizens->medicines as $med)
													@if($med->pivot->status === 0)
													<tbody>
														<tr>
															<td>{{$med->name}}</td>
															<td>{!!Form::open(array('route'=>['activateMedicineStatus', $med->pivot->medicine_id], 'onsubmit' => 'return ConfirmStatusChange1()', 'method'=>'PUT'))!!}

																{!!Form::button('Update', ['class'=>'btn btn-danger', 'type'=>'submit'])!!}
																{!!Form::close()!!}<td>
																</tbody>
																@endif
																@endforeach
															</table>
															<div class="spacer"></div>		
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

		<script type="text/javascript">

			function ConfirmStatusChange()
			{
				var x = confirm("Remove this medicine from the list?");
				if (x)
					return true;
				else
					return false;
			}
			function ConfirmStatusChange1()
			{
				var x = confirm("Confirm");
				if (x)
					return true;
				else
					return false;
			}
		</script>
		<script type="text/javascript">
			$(document).ready(function(){

				$("#courier").hide();
				$("#price");
				$("#price2");
				$('#medicine').on('change', function () {
					var medicine_id=$(this).val();
					var a=$(this).parent().parent();
            //console.log(dosage_id);
            var op="";
            $.ajax({
            	type:'get',
            	url:'{!!URL::route('findPrice')!!}',
            	data:{'id':medicine_id},
                dataType:'json',//return data will be json
                success:function(data){
                    // console.log("price");
                    console.log(data.price);

                    // here price is coloumn name in products table data.coln name

                    a.find('#price').val(data.price);
                },
                error:function(){
                }
            });
        });

				$('#medicine2').on('change', function () {
					var medicine_id=$(this).val();
					var a=$(this).parent().parent();
            //console.log(dosage_id);
            var op="";
            $.ajax({
            	type:'get',
            	url:'{!!URL::route('findPrice')!!}',
            	data:{'id':medicine_id},
                dataType:'json',//return data will be json
                success:function(data){
                    // console.log("price");
                    console.log(data.price);

                    // here price is coloumn name in products table data.coln name

                    a.find('#price2').val(data.price);
                },
                error:function(){
                }
            });
        });	
			});
		</script>