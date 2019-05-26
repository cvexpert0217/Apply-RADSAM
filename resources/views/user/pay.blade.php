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
										  <tr><td colspan="4"></td></tr>
										  <tr>
											  <td>Total Price with out HST</td>
											  <td colspan="3">{{ $total_out_hst }}</td>
										  </tr>
										  <tr>
											  <td>HST</td>
											  <td colspan="3">HST <?php echo $hst ?>%</td>
										  </tr>
										  <tr>
											  <td>Total Price with HST</td>
											  <td colspan="3">{{ $total_in_hst }}</td>
										  </tr>
										  <tr>
											  <td>Payment Account</td>
											  <td colspan="3">{{ $pay_account }}</td>
										  </tr>
									  @endif
									  </tbody>
									</table>
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
@endsection

@section('myscript')
	<script src="{{ asset('js/views/user/pay.js') }}"></script>
@endsection