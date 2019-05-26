@extends('admin')
@section('content')
	<div class="container-fluid">
		<div class="animated fadeIn">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<strong>University List</strong>
						</div>
						<div class="card-body">
							<form id="mainForm" name="mainForm" class="form" method="POST">
								{{ csrf_field() }}

								<table class="table table-responsive-sm table-bordered">
									<thead>
									<tr>
										<th width="10">No</th>
										<th width="150">Name</th>
										<th width="150">University</th>
										<th width="100">Start Date</th>
										<th width="50">Tuition(CAD)</th>
										<th width="100">Type</th>
										<th width="100">Date</th>
										<th width="100">Registrant</th>
										<th width="120">Action</th>
									</tr>
									</thead>
									<tbody>
									@if (count($activities) === 0)
										<tr>
											<td colspan="10">
												There is nothing.
											</td>
										</tr>
									@else
										<?php
										$index = ($activities->currentPage() - 1) * $activities->perPage() + 1;
										foreach ($activities as $activity) {
										?>
										<tr>
											<td><?= $index ?></td>
											<td>
												<a href="/admin/assessment_category/detail/{{ $activity->assessment_id }}">{{ $activity->first_name }} {{ $activity->last_name }}</a>
											</td>
											<td>{{ $activity->university_name }}</td>
											<td>{{ $activity->start_date }}</td>
											<td>{{ $activity->tuition }}</td>
											<?php
											$type = $activity->type;
											$str_type = "";
											switch ($type) {
												case 0:
													$str_type = "University";
													break;
												case 1:
													$str_type = "College";
													break;
												case 2:
													$str_type = "School";
													break;
											}
											?>
											<td>{{ $str_type }}</td>
											<td>{{ $activity->created_at }}</td>
											<td>{{ $activity->user_name }}</td>
											<td>
												<a href="javascript:;" class="btn btn-primary btn-edit btn-accept" data-id="{{ $activity->id }}">Accept</a>
												<a href="javascript:;" class="btn btn-danger btn-delete btn-reject" data-id="{{ $activity->id }}">Reject</a>
											</td>
										</tr>
										<?php
										$index++;
										}
										?>
									@endif
									</tbody>
								</table>
								@include('common.paginator', ['paginator' => $activities])
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="acceptModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form id="accept_form">
					{{csrf_field()}}
					<div class="modal-body">
						<input type="hidden" id="activity_id" name="activity_id">
						<div class="row">
							<div class="col-12">
								<button type="button" class="btn btn-success btn-right btn-edit btn-new-fee">New Fee</button>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<table class="table table-responsive-sm" id="tableFee">
									<thead>
									<tr>
										<th>Name of service</th>
										<th width="150px">Price</th>
										<th width="100px">Quantity</th>
										<th width="200px">Total</th>
										<th width="20px"></th>
									</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-md-3 col-form-label" for="sumPrice">Total Price without HST</label>
							<div class="col-md-2">
								<input type="text" class="form-control" id="sumPrice" name="sumPrice" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3 col-form-label" for="hst">HST</label>
							<div class="col-md-2">
								<input type="text" class="form-control" id="hst" name="hst">
							</div>
							<label class="col-form-label">%</label>
						</div>
						<div class="form-group row">
							<label class="col-md-3 col-form-label" for="pay_price">Total Price with HST</label>
							<div class="col-md-2">
								<input type="text" class="form-control" id="pay_price" name="pay_price" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3 col-form-label" for="totalPrice">Payment Account</label>
							<div class="col-md-2">
								<input type="text" class="form-control" id="pay_account" name="pay_account" required>
							</div>
						</div>

						<div class="form-group row">
							<strong class="col-12 form-col-form-label">Message</strong>
						</div>
						<div class="form-group row">
							<label class="col-md-2 col-form-label" for="inputMsgTitle">title</label>
							<div class="col-md-10">
								<input type="text" class="form-control" id="msg_titel" name="msg_title" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-2 col-form-label" for="txtMsgContent">content</label>
							<div class="col-md-10">
								<textarea id="msg_content" name="msg_content" rows="5" class="form-control" placeholder="message.." required></textarea>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary btn-accept">Accept</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Reject</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form name="rejectForm" id="rejectForm">
					{{csrf_field()}}
					<div class="modal-body">
						<input type="hidden" id="inputActivityId">
						<div class="form-group row">
							<strong class="col-12 form-col-form-label">Message</strong>
						</div>
						<div class="form-group row">
							<label class="col-md-2 col-form-label" for="inputMsgTitle">title</label>
							<div class="col-md-10">
								<input type="text" class="form-control" id="inputMsgTitle" placeholder="title" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-2 col-form-label" for="txtMsgContent">content</label>
							<div class="col-md-10">
								<textarea id="txtMsgContent" rows="5" class="form-control" placeholder="message.." required></textarea>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary btn-confirm-reject">Send</button>
						<button type="button" class="btn btn-secondary btn-close" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection

@section('myscript')
	<script src="{{ asset('js/views/admin/university_list.js') }}"></script>
@endsection
