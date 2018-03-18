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
					<li class="active"><a href="#"><span>Request Medicine</span></a></li>

				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default card-view">
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-dark">Request Medicine</h6>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							{!!Form::open(array('route'=>'storeParcelInfo', 'id' => 'example-advanced-form', 'method' => 'post'))!!}
							<div class="table-wrap">
								<div class="table-responsive">
									<table id="datable_1" class="table table-hover display  pb-30" >
										<table class="table">
											<thead>
												<tr>
													<th>Name</th>
													<th>Qty</th>
													<th>Price</th>
													<th>Subtotal</th>
													<th class="column-spacer"></th>
												</tr>
											</thead>
											<input type="hidden" name="asd" value="{{$asd}}">
											<input type="hidden" name="" value="{{$total = 0}}">
											<input type="hidden" name="seniorid" id="seniorid" value="{{$seniorcitizens->id}}">
											{{$asd}}	
											@foreach($seniorcitizens->medicines as $med)
												
												@if($med->pivot->qty > 0)
											<tbody>
												<tr>
													<td class="medicinename"><input type="hidden" name="medid[]" value="{{$med->id}}">{{$med->name}}</td>
													<td class="qty"><input type="hidden" name="qty[]" value="{{$med->pivot->qty}}">{{$med->pivot->qty}}</td>
													<td class="price">{{$med->price}}</td>
													<td>{{$subtotal = $med->price * $med->pivot->qty}}</td>	
													<input type="hidden" value="{{$total += $subtotal}}">		

												</tr>
											</tbody>
												
												@endif
											@endforeach
										</table>
										<div align="center"><input type="hidden" name="rem" id="rem" value="{{$rem = $seniorcitizens->budget - $asd}}">Total : {{$rem = $seniorcitizens->budget - $asd}}</div>
										<br>
									</div>
									@include('errors.list')
									<fieldset>
										<div class="row">
											<center>{!!Form::submit('Process', array('class' => 'btn btn-primary'))!!}</center>
										</div>	
									</fieldset>
								</div>
								{!!Form::hidden('_token', csrf_token())!!}
								{!!Form::close()!!}
							</div>
						</div>
					</div>  
				</div>
			</div>

		</div>
	</div>
	{!!Form::close()!!}

	<script type="text/javascript">
		var quantity = document.getElementById('quantity').value;
		document.getElementById('butto').disable = true;
	</script>