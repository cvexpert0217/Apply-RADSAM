@extends('user')
@section('content')
  <div class="container-fluid">
    <div class="animated fadeIn">
      <input type="hidden" name="id" value="<?php echo $activity_id; ?>">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <strong>Select University</strong>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                  <div class="row">
                    @foreach ($universities as $university)
                      <div class="col-md-4">
                        <div class="card">
                          <div class="card-header-right">
                            <div class="university-price"><strong>{{ $university->tuition }}$</strong></div>
                          </div>
                          <div class="card-body">
                            <div class="row">
                              <div class="university-img"><img src="{{ asset('img/favicon.png') }}"></div>
                              <div>
                                <div class="university-title"><strong>{{ $university->university_name }}</strong></div>
                                <div class="university-kind">
                                  <span>
                                    @if($university->university_type == 0)
                                      university
                                    @elseif($university->university_type == 1)
                                      college
                                    @else
                                      school
                                    @endif
                                  </span>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="university-date"><strong>Start Date: {{ $university->start_date }}</strong></div>
                            </div>
                          </div>
                          <div class="card-footer-right">
                            <button data-id="{{ $university->university_id }}" class="btn btn-lg btn-flickr text btn-apply">Apply</button>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('myscript')
  <script src="{{ asset('js/views/user/university.js') }}"></script>
@endsection