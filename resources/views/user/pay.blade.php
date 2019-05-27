@extends('user')
@section('content')
	<div class="container-fluid">
        <div class="animated fadeIn">
		<form action="{{ route('pay.register') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
			<input type="hidden" name="activity_id" value="<?php echo $activity_id; ?>">
			<input type="hidden" name="assessment_id" value="<?php echo $assessment_id; ?>">
			<input type="hidden" name="pay_image" value="">
			<input type="hidden" name="pay_type" value="">
			{{ csrf_field() }}
			<div class="row">
            	<div class="col-md-12">
					<div class="card">
						<div class="card-header">
						  <strong>Payment</strong>
						</div>
						<div class="card-body">
					  		<div class="row">
							<div class="col-md-1"></div>
							<div class="col-md-10">
								<div>
									<table class="table table-responsive-sm">
									  <thead>
										<tr>
											<th width="400">Name of service</th>
											<th width="200">Price</th>
											<th width="200">Qt.</th>
											<th width="200">Total</th>
										</tr>
									  </thead>
									  <tbody>
									  @if(count($fees) === 0)
										  <tr>
											  <td>&nbsp;
											  </td>
										  </tr>
									  @else
										  @foreach($fees as $fee)
											  <tr>
												  <td>{{ $fee->fee_name }}</td>
												  <td>{{ $fee->price }}</td>
												  <td>{{ $fee->quantity }}</td>
												  <td>{{ $fee->price * $fee->quantity }}</td>
											  </tr>
										  @endforeach
									  @endif
									  </tbody>
									</table>
									<div style="margin-top: 30px;">
										<div class="form-group">
											<strong class="col-md-3 col-form-label">Total Price without HST : </strong>
											<label class="h5 text-info mb-0 mt-2">{{ $total_out_hst }}</label>
										</div>
										<div class="form-group">
											<strong class="col-md-3 col-form-label">HST : </strong>
											<label class="h5 text-info mb-0 mt-2">{{ $hst }}</label> %
										</div>
										<div class="form-group">
											<strong class="col-md-3 col-form-label">Total Price with HST : </strong>
											<label class="h5 text-primary mb-0 mt-2">{{ $total_in_hst }}</label>
										</div>
										<div class="form-group">
											<strong class="col-md-3 col-form-label">Payment Account : </strong>
											<label class="h5 text-danger mb-0 mt-2">{{ $pay_account }}</label>
										</div>
									</div>
								</div>
								<div class="card-footer-right">
									<input type="file" id="pay_image_file" name="pay_image_file" accept="image/jpeg,.jpg,image/png,.png" style="opacity: 0;">
									<button type="button" class="btn btn-lg btn-primary btn-pay-bill">Upload Bill</button>
									<button type="button" class="btn btn-lg btn-primary btn-pay-paypal">With Paypal</button>
								</div>
							</div>
							<div class="col-md-1"></div>
						  </div>
						</div>
					</div>
            	</div>
          	</div>
		</form>
		</div>
	</div>
	<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Information</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<label class="h5 text-danger mb-0 mt-2">You must upload capture image file that certificate your payment.</label>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary btn-confirm">Open File</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('myscript')
	<script src="{{ asset('js/views/user/pay.js') }}"></script>
@endsection