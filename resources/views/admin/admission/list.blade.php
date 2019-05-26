@extends('admin')
@section('content')
  <div class="container-fluid">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <strong>Admission List</strong>
            </div>
            <div class="card-body">
              <form id="mainForm" name="mainForm" class="form" method="POST">
                {{ csrf_field() }}
                <table class="table table-responsive-sm table-bordered">
                  <thead>
                  <tr>
                    <th width="30">No</th>
                    <th width="200">Name</th>
                    <th width="100">Type</th>
                    <th width="200">University</th>
                    <th width="150">Pay Price(CAD)</th>
                    <th width="400">Upload Docs</th>
                    <th width="200">Date</th>
                    <th width="100">Registrant</th>
                  </tr>
                  </thead>
                  <tbody>
                  @if (count($admissions) === 0)
                    <tr>
                      <td colspan="7">
                        There is nothing.
                      </td>
                    </tr>
                  @else
                    <?php
                    $index = ($admissions->currentPage() - 1) * $admissions->perPage() + 1;
                    foreach ($admissions as $item) {
                    ?>
                    <tr>
                      <td><?= $index ?></td>
                      <td>
                        <a href="/admin/assessment_category/detail/{{ $item->assessment_id }}">{{ $item->first_name }} {{ $item->last_name }}</a>
                      </td>
                      <?php
                      $type = $item->assessment_type;
                      $str_type = "";
                      switch ($type) {
                        case 0:
                          $str_type = "Visa";
                          break;
                        case 1:
                          $str_type = "Study";
                          break;
                      }
                      ?>
                      <td>{{ $str_type }}</td>
                      <td>{{ $item->university_name }}</td>
                      <td>{{ $item->fee_price }}</td>
                      <td>{{ $item->docs_name }}</td>
                      <td>{{ $item->updated_at }}</td>
                      <td>{{ $item->user_name }}</td>
                    </tr>
                    <?php
                    $index++;
                    }
                    ?>
                  @endif
                  </tbody>
                </table>
                @include('common.paginator', ['paginator' => $admissions])
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('myscript')
  <script src="{{ asset('js/views/admin/admission_list.js') }}"></script>
@endsection