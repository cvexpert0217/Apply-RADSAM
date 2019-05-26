@extends('admin')
@section('content')
	<div class="container-fluid">
		<div class="animated fadeIn">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<strong>University Category</strong>
						</div>
						<div class="card-body">
							<form id="mainForm" name="mainForm" class="form" method="POST">
								{{ csrf_field() }}

								<input type="hidden" name="id" value="">

								<a href="javascript:;" class="btn btn-success btn-right btn-edit" data-id="0">Add New</a>
								<table class="table table-responsive-sm table-bordered">
									<colgroup>
										<col width="40px">
										<col>
										<col>
										<col>
										<col>
										<col>
										<col width="150px">
									</colgroup>
									<thead>
										<tr>
											<th>No</th>
											<th>Name</th>
											<th>Start Date</th>
											<th>Tuition(CAD)</th>
											<th>Type</th>
											<th>Date</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@if (count($categories) === 0)
											<tr>
												<td colspan="7">
													There is nothing.&nbsp;
												</td>
											</tr>
										@else
											<?php
												$index = ($categories->currentPage() - 1) * $categories->perPage() + 1;
												foreach ($categories as $category) {
											?>
												<tr>
													<td><?= $index ?></td>
													<td><?= $category->name ?></td>
													<td><?= $category->start_date; ?></td>
													<td><?= $category->tuition; ?></td>
													<?php
														$type = $category->type;
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
													<td><?= $str_type; ?></td>
													<td><?= $category->created_at; ?></td>
													<td>
														<a href="javascript:;" class="btn btn-primary btn-edit" data-id="{{ $category->id }}">Edit</a>
														<a href="javascript:;" class="btn btn-danger btn-delete" data-id="{{ $category->id }}">Delete</a>
													</td>
												</tr>
											<?php 
													$index++;
												}
											?>
										@endif
									</tbody>
								</table>
								@include('common.paginator', ['paginator' => $categories])
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- Modal Window for adding and edting --}}
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">University Information</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form name="editForm" id="editForm" method="post" action="{{ url('/admin/university_category/save') }}">

					{{csrf_field()}}

					<input type="hidden" name="id" value="">

					<div class="modal-body">
						<div class="form-group row">
							<label class="col-md-4 col-form-label" for="inName">Name</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="inName" name="name" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-form-label" for="inStartDate">Start Date</label>
							<div class="col-md-8">
								<input type="date" class="form-control" id="inStartDate" name="start_date" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-form-label" for="inTuition">Tuition</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="inTuition" name="tuition" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-form-label" for="inType">Type</label>
							<div class="col-md-8">
								<select id="inType" name="type" class="form-control" required>
									<option value="0">University</option>
									<option value="1">College</option>
									<option value="2">School</option>
								</select>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary btn-save">Save</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Delete University</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Are you sure you want to delete this university?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger btn-confirm-delete">Delete</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('myscript')
	<script src="{{ asset('js/views/admin/university_category.js') }}"></script>
@endsection
