@extends('admin')
@section('content')
  <div class="container-fluid">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <strong>Assessment Category</strong>
            </div>
            <div class="card-body">
              <form id="mainForm" name="mainForm" class="form" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="">
                <table class="table table-responsive-sm table-bordered">
                  <thead>
                  <tr>
                    <th width="35">No</th>
                    <th width="80">Type</th>
                    <th width="200">Name</th>
                    <th width="200">Mobile</th>
                    <th width="200">Email</th>
                    <th width="200">Birthday</th>
                    <th width="200">Address</th>
                    <th width="200">Major/field</th>
                    <th width="200">Registrant</th>
                    <th width="300">Register Date</th>
                    <th width="400px">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @if (count($categories) === 0)
                    <tr>
                      <td colspan="15">
                        There is nothing.
                      </td>
                    </tr>
                  @else
                    <?php
                    $index = ($categories->currentPage() - 1) * $categories->perPage() + 1;
                    foreach ($categories as $category) {
                      $str_assessment_type = '';
                      switch ($category->assessment_type) {
                        case 0:
                          $str_assessment_type = 'Visa';
                          break;
                        case 1:
                          $str_assessment_type = 'Study';
                          break;
                      }
                    ?>
                    <tr>
                      <td>{{$index}}</td>
                      <td>{{$str_assessment_type}}</td>
                      <td>{{$category->first_name }} {{ $category->last_name}}</td>
                      <td>{{$category->mobile_phone}}</td>
                      <td>{{$category->email}}</td>
                      <td>{{$category->birthday}}</td>
                      <td>{{$category->street_address}}</td>
                      <td>{{$category->major}}</td>
                      <td>{{$category->user_name}}</td>
                      <td>{{$category->created_at}}</td>
                      <td>
                        <a href="/admin/assessment_category/edit/{{ $category->id }}" class="btn btn-primary btn-edit">Edit</a>
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
              </form>
              @include('common.paginator', ['paginator' => $categories])
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
          <h4 class="modal-title">Delete Assessment</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this assessment?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger btn-confirm-delete">Delete</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('myscript')
  <script src="{{ asset('js/views/admin/assessment_category.js') }}"></script>
@endsection
