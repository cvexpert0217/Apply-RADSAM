@extends('user')
@section('content')
  <div class="container-fluid">
    <div class="animated fadeIn">
    <form action="{{ route('upload.register') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
    <input type="hidden" name="activity_id" value="<?php echo $activity_id; ?>">
    {{ csrf_field() }}
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <strong>Upload</strong>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div>
                        <table class="table table-responsive-sm">
                          <thead>
                            <tr>
                                <th width="1000">Name</th>
                                <th width="300">FileName</th>
                                <th>Upload Docs</th>
                            </tr>
                          </thead>
                          <tbody>
                          @if(count($docs) === 0)
                              <tr>
                                  <td>&nbsp;
                                  </td>
                              </tr>
                          @else
                              @foreach($docs as $doc)
                                  <tr>
                                      <td data-doc-name="{{ $doc->docs_req_id }}"><?php echo '<script>
                                        jQuery(document).ready(function(){getDocName('.$doc->docs_type.','.$doc->docs_req_id.');})</script>'; ?></td>
                                      <td><span></span></td>
                                      <td>
                                          <input type="file" name="{{ $doc->doc_id }}" data-id="{{ $doc->doc_id }}" accept=".doc, .docx" hidden>
                                          <a href="#" class="btn btn-primary btn-upload">Open File</a>
                                      </td>
                                  </tr>
                              @endforeach
                          @endif
                          </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-1"></div>
              </div>
            </div>
            <div class="card-footer-right">
                <button id="btn-register" type="submit" class="btn btn-lg btn-primary">Register</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    </div>
  </div>
@endsection

@section('myscript')
    <script src="{{ asset('js/views/user/upload_doc.js') }}"></script>
@endsection