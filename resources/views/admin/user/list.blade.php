@extends('admin')
@section('content')
	<div class="container-fluid">
		<div class="animated fadeIn">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<strong>Users</strong>
						</div>
						<div class="card-body">
							<form id="mainForm" name="mainForm" class="form" method="POST">
								{{ csrf_field() }}

								<input type="hidden" name="id" value="">
								
								<table class="table table-responsive-sm table-bordered">
									<colgroup>
										<col width="80px">
										<col>
										<col>
										<col>
										<col width="200px">
									</colgroup>
									<thead>
										<tr>
											<th>No</th>
											<th>Name</th>
											<th>Email</th>
											<th>Use Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@if (count($users) === 0)
											<tr>
												<td colspan="5">
													&nbsp;There is nothing.
												</td>
											</tr>
										@else
											<?php
												$firstIndex = ($users->currentPage() - 1) * $users->perPage();
											?>
											@foreach ($users as $user)
												<tr>
													<td>{{ $firstIndex + $loop->index + 1 }}</td>
													<td>{{ $user->name }}</td>
													<td>{{ $user->email }}</td>
													<td>
														@if ($user->use_status == 0)
															<span class="badge badge-secondary">Inactive</span>
														@else
															<span class="badge badge-success">Active</span>
														@endif
													</td>
													<td>
														@if ($user->use_status == 0)
															<a href="#" class="btn btn-success btn-status" data-id="{{ $user->id }}" data-status="1">Enable</a>
														@else
															<a href="#" class="btn btn-danger btn-status" data-id="{{ $user->id }}" data-status="0">Disable</a>
														@endif
														<a href="#" class="btn btn-secondary btn-delete" data-id="{{ $user->id }}">Delete</a>
													</td>
												</tr>
											@endforeach
										@endif
									</tbody>
								</table>
								@include('common.paginator', ['paginator' => $users])
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Delete User</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Are you sure you want to delete this user?</p>
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
	<script src="{{ asset('js/views/admin/user.js') }}"></script>
@endsection
