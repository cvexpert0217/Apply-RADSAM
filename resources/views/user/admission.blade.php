@extends('user')
@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <form action="{{ route('admission.confirm') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                <input type="hidden" name="activity_id" value="<?php echo $activity_id; ?>">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Confirm Admission</strong>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <div class="confirm-admission">
                                                <div class="col-md-12">
                                                    <img style="width: 100%; height: 100%;" src="{{ asset($file_url) }}">
                                                </div>
                                                <div class="col-md-12" style="margin-top: 20px;">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-md-1"></div>
                                </div>
                            </div>
                            <div class="card-footer-right">
                                <button type="submit" class="btn btn-lg btn-primary">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection