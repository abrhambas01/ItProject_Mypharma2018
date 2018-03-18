@extends('layouts.admin')


@section('title', 'Medicines Profile')		


@section('content')

<main id="main-container">
	<!-- Page Content -->
	<div class="content">
		<h2 class="content-heading">Medicine Dosage : change this </small></h2>
		<div class="block">
			<!-- Navigation -->
			<div class="block-content block-content-full border-b clearfix">
				<div class="btn-group float-right">
					<a class="btn btn-secondary" href="">
						<i class="fa fa-arrow-left text-primary mr-5"></i> Prev
					</a>
					<a class="btn btn-secondary" href="javascript:void(0)">
						Next <i class="fa fa-arrow-right text-primary ml-5"></i>
					</a>
				</div>
				<a class="btn btn-secondary" href="{{ route('barangays.index') }}">
					<i class="fa fa-th-large text-primary mr-5 "></i> All Barangays
				</a>
			</div>
			<!-- END Navigation -->

			<!-- Project -->
			<div class="block-content block-content-full">
				<div class="row py-20">
					<div class="col-sm-6 invisible" data-toggle="appear">
						<!-- Image Slider (.js-slider class is initialized in Codebase() -> uiHelperSlick()) -->
						<!-- For more info and examples you can check out http://kenwheeler.github.io/slick/ -->
						<div class="js-slider slick-nav-black slick-dotted-inner slick-dotted-white" data-dots="true" data-arrows="true">
							
							<div>
								<img class="img-fluid" src="{{ asset('storage/barangay_halls/'.$barangay->barangay_hall_picture) }}" alt="Project Promo 1">
							</div>

						</div>
						<!-- END Image Slider -->

						<!-- Project Info -->
						<table class="table table-striped table-borderless mt-20">
							<tbody>
								

								<tr>
									<td class="font-w600">Category</td>
									<td>{{ $barangay->lat }}</td>
								</tr>

								<tr>
									<td class="font-w600">Longitude</td>
									<td>{{ $barangay->lng }}</td>
								</tr>


								<tr>
									<td class="font-w600">Facebook Profile</td>
									<td>
										<a href="{{ $barangay->facebook_profile }}">{{ $barangay->facebook_profile }}</a>
									</td>
								</tr>

							</tbody>

							
						</table>
						<!-- END Project Info -->
					</div>
					<div class="col-sm-6 nice-copy">
						<!-- Project Description -->
						<h3 class="mb-10">Introduction</h3>
						<p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
						<h3 class="mt-20 mb-10">Research</h3>
						<p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
						<p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
						<!-- END Project Description -->
					</div>
				</div>
			</div>
		</div>
	</div>
</main>


@endsection