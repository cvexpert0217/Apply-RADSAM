@extends('admin')
@section('content')
	<div class="container-fluid">
		<div class="animated fadeIn">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<strong>Assement List</strong>
						</div>
						<div class="card-body">
							<form id="mainForm" name="mainForm" class="form" method="POST">
								{{ csrf_field() }}
								<table class="table table-responsive-sm table-bordered">
									<colgroup>
										<col width="80px">
										<col>
										<col>
										<col>
										<col>
										<col width="200px">
									</colgroup>
									<thead>
									<tr>
										<th width="100">No</th>
										<th width="300">Name</th>
										<th width="200">Type</th>
										<th width="400">Date</th>
										<th width="200">Registrant</th>
										<th width="200">Action</th>
									</tr>
									</thead>
									<tbody>
									@if (count($list) === 0)
										<tr>
											<td colspan="15">
												There is nothing.
											</td>
										</tr>
									@else
										<?php
										$index = ($list->currentPage() - 1) * $list->perPage() + 1;
										foreach ($list as $item) {
										$str_assessment_type = '';
										switch ($item->assessment_type) {
											case 0:
												$str_assessment_type = 'Visa';
												break;
											case 1:
												$str_assessment_type = 'Study';
												break;
										}
										?>
										<tr>
											<td>{{ $index }}</td>
											<td>
												<a href="/admin/assessment_category/detail/{{ $item->assessment_id }}">{{ $item->first_name }} {{ $item->last_name }}</a>
											</td>
											<td>{{ $str_assessment_type }}</td>
											<td>{{ $item->created_at }}</td>
											<td>{{ $item->user_name }}</td>
											<td>
												<a href="javascript:;" class="btn btn-primary btn-open-accept" data-activity-id="{{ $item->id }}">Accept</a>
												<a href="javascript:;" class="btn btn-danger btn-open-reject" data-activity-id="{{ $item->id }}">Reject</a>
											</td>
										</tr>
										<?php
										$index ++;
										}
										?>
									@endif
									</tbody>
								</table>
								@include('common.paginator', ['paginator' => $list])
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="acceptStudyModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form id="accept_study_form" name="accept_study_form">
					{{csrf_field()}}
					<div class="modal-body">
						<input type="hidden" id="inputActivityId">
						<div class="form-group row">
							<label class="col-md-2 col-form-label" for="selectFilter">Filter</label>
							<div class="col-md-4">
								<select id="selectFilter" class="form-control">
									<option value="0">University</option>
									<option value="1">Colleges</option>
									<option value="2">Schools</option>
								</select>
							</div>
							<label class="col-md-2 col-form-label" for="inputStartDate">Start Date</label>
							<div class="col-md-4">
								<input type="date" id="inputStartDate" class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<table class="table table-responsive-sm" id="tableUniversity">
									<thead>
									<tr>
										<th>ID</th>
										<th>Name</th>
										<th>Tutions</th>
										<th>Start Date</th>
										<th>Type</th>
										<th>Suggest</th>
									</tr>
									</thead>
									<tbody>
									<tr>
										<td>1</td>
										<td>Humber/Computer</td>
										<td>2000$</td>
										<td>2019/05/05</td>
										<td>Colleges</td>
										<td>
											<input type="checkbox" class="form-control">
										</td>
									</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="form-group row">
							<strong class="col-12 form-col-form-label">Message</strong>
						</div>
						<div class="form-group row">
							<label class="col-md-2 col-form-label" for="inputMsgTitle">title</label>
							<div class="col-md-10">
								<input type="text" class="form-control" id="inputMsgTitle" required>
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
						<button type="submit" class="btn btn-primary btn-accept-study">Accept</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="acceptVisaModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form id="accept_visa_form">
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
								<input type="text" class="form-control" id="sumPrice" name="sumPrice" readonly required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3 col-form-label" for="hst">HST</label>
							<div class="col-md-2">
								<input type="text" class="form-control" id="hst" name="hst" required>
							</div>
							<label class="col-form-label">%</label>
						</div>
						<div class="form-group row">
							<label class="col-md-3 col-form-label" for="totalPrice">Total Price with HST</label>
							<div class="col-md-2">
								<input type="text" class="form-control" id="pay_price" name="pay_price" readonly required>
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
						<button type="submit" class="btn btn-primary">Accept</button>
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
								<input type="text" class="form-control" id="inputMsgTitle" required>
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
						<button type="submit" class="btn btn-primary btn-send">Send</button>
						<button type="button" class="btn btn-secondary btn-close" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection

@section('myscript')
	<script src="{{ asset('js/views/admin/assessment_list.js') }}"></script>
@endsection
