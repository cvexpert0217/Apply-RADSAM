@extends('admin')
@section('content')
  <div class="container-fluid">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-md-12">
          <form action="{{ route('assessment_category.save') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{$category->id}}"/>
            <div class="card">
              <div class="card-header">
                <strong>Assessment Form</strong>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="form-group col-sm-1">
                  </div>
                  <div class="form-group col-sm-10">
                    <div class="row">
                      <strong for="profile">Profile<span style="color: red;"> *</span></strong>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" class="form-control" id="first_name" value="{{$category->first_name}}" readonly>
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" class="form-control" id="last_name" value="{{$category->last_name}}" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm-1">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-1">
                  </div>
                  <div class="form-group col-sm-10">
                    <div class="row">
                      <strong for="mobile_phone">Mobile Phone<span style="color: red;"> *</span></strong>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <input type="text" name="mobile_phone" class="form-control" id="mobile_phone" value="{{$category->mobile_phone}}" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm-1">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-1">
                  </div>
                  <div class="form-group col-sm-10">
                    <div class="row">
                      <strong for="email">Email<span style="color: red;"> *</span></strong>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <input type="text" name="email" class="form-control" id="email" value="{{$category->email}}" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm-1">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-1">
                  </div>
                  <div class="form-group col-sm-10">
                    <div class="row">
                      <strong for="gender">Gender<span style="color: red;"> *</span></strong>
                    </div>
                      <div class="radio">
                        <label for="male">
                          <input type="radio" id="male" name="gender" value="0" <?php  echo $category->gender == 0?'checked':''?> disabled> Male
                        </label>
                      </div>
                      <div class="radio">
                        <label for="female">
                          <input type="radio" id="female" name="gender" value="1" <?php  echo $category->gender == 1?'checked':''?> disabled> Female
                        </label>
                      </div>
                  </div>
                  <div class="form-group col-sm-1">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-1">
                  </div>
                  <div class="form-group col-sm-10">
                    <div class="row">
                      <strong for="birthday">Date of birth<span style="color: red;"> *</span></strong>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-3">
                        <input type="date" name="birthday" class="form-control" id="birthday" value="{{ $category->birthday }}" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm-1">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-1">
                  </div>
                  <div class="form-group col-sm-10">
                    <div class="row">
                      <strong for="married_status">Married Status<span style="color: red;"> *</span></strong>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <select id="married_status" name="married_status" class="form-control" disabled>
                          <option value="0" <?php  echo $category->married_status == 0?'selected':''?>>Single</option>
                          <option value="1" <?php  echo $category->married_status == 1?'selected':''?>>Married</option>
                          <option value="2" <?php  echo $category->married_status == 2?'selected':''?>>Divorced</option>
                          <option value="3" <?php  echo $category->married_status == 3?'selected':''?>>Widowed</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm-1">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-1">
                  </div>
                  <div class="form-group col-sm-10">
                    <div class="row">
                      <strong for="skype_id">Skype ID</strong>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <input type="text" name="skype_id" class="form-control" id="skype_id" value="{{ $category->skype_id }}" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm-1">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-1">
                  </div>
                  <div class="form-group col-sm-10">
                    <div class="row">
                      <strong for="instagram_id">Instagram ID</strong>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <input type="text" name="instagram_id" class="form-control" id="instagram_id" value="{{ $category->instagram_id }}" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm-1">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-1">
                  </div>
                  <div class="form-group col-sm-10">
                    <div class="row">
                      <strong for="citizenship">Citizenship of</strong>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <select id="citizenship" name="citizenship" class="form-control" disabled>
                          @foreach ($country_list as $idx => $country)
                            <option value="{{ $idx }}" {{ $category->citizenship == $idx?'selected':'' }}>{{ $country }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm-1">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-1">
                  </div>
                  <div class="form-group col-sm-10">
                    <div class="row">
                      <strong for="address">Address<span style="color: red;"> *</span></strong>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-12">
                        <label for="street_address">Street Address</label>
                        <input type="text" name="street_address" class="form-control" id="street_address" value="{{ $category->street_address }}" readonly>
                      </div>
                      <div class="form-group col-sm-12">
                        <label for="address_line2">Address Line 2</label>
                        <input type="text" name="address_line2" class="form-control" id="address_line2" value="{{ $category->address_line2 }}" readonly>
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="city">City</label>
                        <input type="text" name="city" class="form-control" id="city" value="{{ $category->city }}" readonly>
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="state_province_region">State / Province / Region</label>
                        <input type="text" name="state_province_region" class="form-control" id="state_province_region" value="{{ $category->state_province_region }}" readonly>
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="zip_postal_code">ZIP / Postal Code</label>
                        <input type="text" name="zip_postal_code" class="form-control" id="zip_postal_code" value="{{ $category->zip_postal_code }}" readonly>
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="country">Country</label>
                        <select id="country" name="country" class="form-control" disabled>
                          @foreach ($country_list as $idx => $country)
                            <option value="{{ $idx }}" {{ $category->country == $idx?'selected':'' }}>{{ $country }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm-1">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-1">
                  </div>
                  <div class="form-group col-sm-10">
                    <div class="row">
                      <strong for="passport_expire_date">Passport expire date<span style="color: red;"> *</span></strong>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-3">
                        <input type="date" class="form-control" id="passport_expire_date" name="passport_expire_date" value="{{ $category->passport_expire_date }}" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm-1">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-1">
                  </div>
                  <div class="form-group col-sm-10">
                    <div class="row">
                      <strong for="education_level">The highest level of education<span style="color: red;"> *</span></strong>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <select id="education_level" name="education_level" class="form-control" disabled>
                          <option value="0" {{ $category->education_level == 0? 'selected':'' }}>High School</option>
                          <option value="1" {{ $category->education_level == 1? 'selected':'' }}>Associate Degree</option>
                          <option value="2" {{ $category->education_level == 2? 'selected':'' }}>Bachelor's Degree</option>
                          <option value="3" {{ $category->education_level == 3? 'selected':'' }}>Graduate or Professional Degree</option>
                          <option value="4" {{ $category->education_level == 4? 'selected':'' }}>Some College</option>
                          <option value="5" {{ $category->education_level == 5? 'selected':'' }}>Master</option>
                          <option value="6" {{ $category->education_level == 6? 'selected':'' }}>Phd</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm-1">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-1">
                  </div>
                  <div class="form-group col-sm-10">
                    <div class="row">
                      <strong for="university">University</strong>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <input type="text" name="university" class="form-control" id="university" value="{{ $category->university }}" readonly="">
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm-1">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-1">
                  </div>
                  <div class="form-group col-sm-10">
                    <div class="row">
                      <strong for="major">Major Field<span style="color: red;"> *</span></strong>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <input type="text" name="major" class="form-control" id="major" value="{{ $category->major }}" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm-1">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-1">
                  </div>
                  <div class="form-group col-sm-10">
                    <div class="row">
                      <strong for="from">From<span style="color: red;"> *</span></strong>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-3">
                        <input type="date" name="from" class="form-control" id="from" value="{{ $category->from }}" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm-1">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-1">
                  </div>
                  <div class="form-group col-sm-10">
                    <div class="row">
                      <strong for="to">To</strong>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-3">
                        <input type="date" name="to" class="form-control" id="to" value="{{ $category->to }}" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm-1">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-1">
                  </div>
                  <div class="form-group col-sm-10">
                    <div class="row">
                      <strong for="gpa_score">GPA score<span style="color: red;"> *</span></strong>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <input type="number" name="gpa_score" class="form-control" id="gpa_score" value="{{ $category->gpa_score }}" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm-1">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-1">
                  </div>
                  <div class="form-group col-sm-10">
                    <div class="row">
                      <strong for="english_proficiency">Do you have English language proficiency such as IELTS, TOEFL, GRE or GMAT? (Please note: certificate has to be valid and received in tow last years)<span style="color: red;"> *</span></strong>
                    </div>
                    <div class="radio">
                      <label for="ep-yes">
                        <input type="radio" id="ep-yes" name="english_proficiency" value="0" {{ $category->english_proficiency == 0?'checked':'' }} disabled> Yes
                      </label>
                    </div>
                    <div class="radio">
                      <label for="ep-no">
                        <input type="radio" id="ep-no" name="english_proficiency" value="1" {{ $category->english_proficiency == 1?'checked':'' }} disabled> No
                      </label>
                    </div>
                  </div>
                  <div class="form-group col-sm-1">
                  </div>
                </div>
                <div class="row" id="english_proficiency_indicate" {{ $category->english_proficiency == 0? '': 'hidden' }}>
                  <div class="form-group col-sm-1">
                  </div>
                  <div class="form-group col-sm-10">
                    <div class="row">
                      <strong for="indicate">please indicate<span style="color: red;"> *</span></strong>
                    </div>
                    <div class="radio">
                      <label for="academic">
                        <input type="radio" id="academic" class="indicate" name="indicate" value="0" {{ $category->indicate == 0?'checked':'' }} disabled> Academic
                      </label>
                    </div>
                    <div class="radio">
                      <label for="general">
                        <input type="radio" id="general" class="indicate" name="indicate" value="1"  {{ $category->indicate == 1?'checked':'' }} disabled> General
                      </label>
                    </div>
                  </div>
                  <div class="form-group col-sm-1">
                  </div>

                  <!-- ////// when english proficiency is true. -->
                  <div class="row" id="english_proficiency_true" {{ ($category->indicate == 0 || $category->indicate == 1)? '' : 'hidden' }}>
                    <div class="form-group col-sm-1">
                    </div>
                    <div class="form-group col-sm-10">
                      <div class="row">
                        <strong for="overall">Over all<span style="color: red;"> *</span></strong>
                      </div>
                      <div class="row">
                        <div class="form-group col-sm-6">
                          <input type="number" name="indicate_overall" class="form-control" id="overall" min="0" max="10" value="{{ $category->indicate_overall }}" disabled>
                          <span>Please enter a value between 0 and 10.</span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group col-sm-1">
                    </div>
                    <div class="form-group col-sm-1">
                    </div>
                    <div class="form-group col-sm-10">
                      <div class="row">
                        <strong for="writing">writing<span style="color: red;"> *</span></strong>
                      </div>
                      <div class="row">
                        <div class="form-group col-sm-6">
                          <input type="number" name="indicate_writing" class="form-control" id="writing" min="0" max="10" value="{{ $category->indicate_writing }}" disabled>
                          <span>Please enter a value between 0 and 10.</span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group col-sm-1">
                    </div>
                    <div class="form-group col-sm-1">
                    </div>
                    <div class="form-group col-sm-10">
                      <div class="row">
                        <strong for="listening">listening<span style="color: red;"> *</span></strong>
                      </div>
                      <div class="row">
                        <div class="form-group col-sm-6">
                          <input type="number" name="indicate_listening" class="form-control" id="listening" min="0" max="10" value="{{ $category->indicate_listening }}" disabled>
                          <span>Please enter a value between 0 and 10.</span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group col-sm-1">
                    </div>
                    <div class="form-group col-sm-1">
                    </div>
                    <div class="form-group col-sm-10">
                      <div class="row">
                        <strong for="reading">reading<span style="color: red;"> *</span></strong>
                      </div>
                      <div class="row">
                        <div class="form-group col-sm-6">
                          <input type="number" name="indicate_reading" class="form-control" id="reading" min="0" max="10" value="{{ $category->indicate_reading }}" disabled>
                          <span>Please enter a value between 0 and 10.</span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group col-sm-1">
                    </div>
                    <div class="form-group col-sm-1">
                    </div>
                    <div class="form-group col-sm-10">
                      <div class="row">
                        <strong for="speaking">speaking<span style="color: red;"> *</span></strong>
                      </div>
                      <div class="row">
                        <div class="form-group col-sm-6">
                          <input type="number" name="indicate_speaking" class="form-control" id="speaking" min="0" max="10" value="{{ $category->indicate_speaking }}" disabled>
                          <span>Please enter a value between 0 and 10.</span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group col-sm-1">
                    </div>
                  </div>

                </div>
                <div class="row">
                  <div class="form-group col-sm-1">
                  </div>
                  <div class="form-group col-sm-10">
                    <div class="row">
                      <strong for="french_proficiency">Do you have French language proficiency?<span style="color: red;"> *</span></strong>
                    </div>
                    <div class="radio">
                      <label for="fp-yes">
                        <input type="radio" id="fp-yes" name="french_proficiency" value="0" {{ $category->french_proficiency == 0?'checked':'' }} disabled> Yes
                      </label>
                    </div>
                    <div class="radio">
                      <label for="fp-no">
                        <input type="radio" id="fp-no" name="french_proficiency" value="1"  {{ $category->french_proficiency == 1?'checked':'' }} disabled> No
                      </label>
                    </div>
                  </div>
                  <div class="form-group col-sm-1">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-1">
                  </div>
                  <div class="form-group col-sm-10">
                    <div class="row">
                      <strong for="latest_job_title">The latest job title<span style="color: red;"> *</span></strong>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <input type="text" name="latest_job_title" class="form-control" id="latest_job_title" value="{{ $category->latest_job_title }}" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm-1">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-1">
                  </div>
                  <div class="form-group col-sm-10">
                    <div class="row">
                      <strong for="work_experience_years">Years of work experience:<span style="color: red;"> *</span></strong>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <select id="work_experience_years" name="work_experience_years" class="form-control" disabled>
                          <option value="0" {{ $category->work_experience_years == 0?'selected':'' }}>less than one year</option>
                          <option value="1" {{ $category->work_experience_years == 1?'selected':'' }}>1 year</option>
                          <option value="2" {{ $category->work_experience_years == 2?'selected':'' }}>2 years</option>
                          <option value="3" {{ $category->work_experience_years == 3?'selected':'' }}>3 years</option>
                          <option value="4" {{ $category->work_experience_years == 4?'selected':'' }}>4 years</option>
                          <option value="5" {{ $category->work_experience_years == 5?'selected':'' }}>Over 5 years</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm-1">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-1">
                  </div>
                  <div class="form-group col-sm-10">
                    <div class="row">
                      <strong for="applid">Have you ever been apply for studying or immigrating abroad?<span style="color: red;"> *</span></strong>
                    </div>
                    <div class="radio">
                      <label for="ah-yes">
                        <input type="radio" id="ah-yes" name="applid" value="0" {{ $category->applid == 0?'checked':'' }} disabled> Yes
                      </label>
                    </div>
                    <div class="radio">
                      <label for="ah-no">
                        <input type="radio" id="ah-no" name="applid" value="1" {{ $category->applid == 1?'checked':'' }} disabled> No
                      </label>
                    </div>
                  </div>
                  <div class="form-group col-sm-1">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-1">
                  </div>
                  <div class="form-group col-sm-10">
                    <div class="row">
                      <strong for="requested_services">Requested services:<span style="color: red;"> *</span></strong>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-12">
                        <label for="street_address">Street Address</label>
                        <?php
                        $service_list = explode(',', $category->requested_services);
                        ?>
                        <div class="checkbox">
                          <label for="educational_consultation">
                            <input type="checkbox" id="educational_consultation" name="educational_consultation" value="1" {{ ($service_list[0] == 1)? 'checked': '' }} disabled> Educational consultation
                          </label>
                        </div>
                        <div class="checkbox">
                          <label for="apply_admission">
                            <input type="checkbox" id="apply_admission" name="apply_admission" value="1" {{ ($service_list[1] == 1)? 'checked': '' }} disabled> Apply for Admission
                          </label>
                        </div>
                        <div class="checkbox">
                          <label for="credential">
                            <input type="checkbox" id="credential" name="credential" value="1" {{ ($service_list[2] == 1)? 'checked': '' }} disabled> Credential assessment/Equivalent
                          </label>
                        </div>
                        <div class="checkbox">
                          <label for="apply_fund">
                            <input type="checkbox" id="apply_fund" name="apply_fund" value="1" {{ ($service_list[3] == 1)? 'checked': '' }} disabled> Apply for fund/Scholarship
                          </label>
                        </div>
                        <div class="checkbox">
                          <label for="apply_accommodations">
                            <input type="checkbox" id="apply_accommodations" name="apply_accommodations" value="1" {{ ($service_list[4] == 1)? 'checked': '' }} disabled> Apply for housing accommodations
                          </label>
                        </div>
                        <div class="checkbox">
                          <label for="apply_insurance">
                            <input type="checkbox" id="apply_insurance" name="apply_insurance" value="1" {{ ($service_list[5] == 1)? 'checked': '' }} disabled> Apply for student health insurance
                          </label>
                        </div>
                        <div class="checkbox">
                          <label for="help_permits">
                            <input type="checkbox" id="help_permits" name="help_permits" value="1" {{ ($service_list[6] == 1)? 'checked': '' }} disabled> Help to get study and work permits
                          </label>
                        </div>
                        <div class="checkbox">
                          <label for="travel_consultation">
                            <input type="checkbox" id="travel_consultation" name="travel_consultation" value="1" {{ ($service_list[7] == 1)? 'checked': '' }} disabled> Travel arrangement consultation
                          </label>
                        </div>
                        <div class="checkbox">
                          <label for="airport_transfer">
                            <input type="checkbox" id="airport_transfer" name="airport_transfer" value="1" {{ ($service_list[8] == 1)? 'checked': '' }} disabled> Airport transfer
                          </label>
                        </div>
                        <div class="checkbox">
                          <label for="help_registration">
                            <input type="checkbox" id="help_registration" name="help_registration" value="1" {{ ($service_list[9] == 1)? 'checked': '' }} disabled> Help for registration
                          </label>
                        </div>
                        <div class="checkbox">
                          <label for="help_bank">
                            <input type="checkbox" id="help_bank" name="help_bank" value="1" {{ ($service_list[10] == 1)? 'checked': '' }} disabled> Help to open bank accounts
                          </label>
                        </div>
                        <div class="checkbox">
                          <label for="help_driving">
                            <input type="checkbox" id="help_driving" name="help_driving" value="1" {{ ($service_list[11] == 1)? 'checked': '' }} disabled> Help to get driving licence
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm-1">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-1">
                  </div>
                  <div class="form-group col-sm-10">
                    <div class="row">
                      <strong for="annual_budget">Annual budget studying and living in Canada<span style="color: red;"> *</span></strong>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <select id="annual_budget" name="annual_budget" class="form-control" disabled>
                          <option value="1" {{ $category->annual_budget == 0?'selected':'' }}>Less than 30k $ CAD</option>
                          <option value="2" {{ $category->annual_budget == 1?'selected':'' }}>between 30 $ - 50k $ CAD</option>
                          <option value="3" {{ $category->annual_budget == 2?'selected':'' }}>between 50k $ - 150k $ CAD</option>
                          <option value="4" {{ $category->annual_budget == 3?'selected':'' }}>150k $ - 250$ k</option>
                          <option value="5" {{ $category->annual_budget == 4?'selected':'' }}>More than 250$k</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm-1">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-1">
                  </div>
                  <div class="form-group col-sm-10">
                    <div class="row">
                      <strong for="our_job">How did you hear about us</strong>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <select id="our_job" name="our_job" class="form-control" disabled>
                          <option value="0" {{ $category->our_job == 0? 'selected':'' }}>Agents</option>
                          <option value="1" {{ $category->our_job == 1? 'selected':'' }}>Friends</option>
                          <option value="2" {{ $category->our_job == 2? 'selected':'' }}>Email marketing</option>
                          <option value="3" {{ $category->our_job == 3? 'selected':'' }}>Newspapers</option>
                          <option value="4" {{ $category->our_job == 4? 'selected':'' }}>Magazines</option>
                          <option value="5" {{ $category->our_job == 5? 'selected':'' }}>Facebook</option>
                          <option value="6" {{ $category->our_job == 6? 'selected':'' }}>Instagram</option>
                          <option value="7" {{ $category->our_job == 7? 'selected':'' }}>Internet search</option>
                          <option value="8" {{ $category->our_job == 8? 'selected':'' }}>Schools</option>
                          <option value="9" {{ $category->our_job == 9? 'selected':'' }}>Seminars</option>
                          <option value="10" {{ $category->our_job == 10? 'selected':'' }}>Fairs</option>
                          <option value="11" {{ $category->our_job == 11? 'selected':'' }}>Other</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm-1">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-1">
                  </div>
                  <div class="form-group col-sm-10">
                    <div class="row">
                      <strong for="agent_name">Agent name</strong>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <input type="text" name="agent_name" class="form-control" id="agent_name" value="{{ $category->agent_name }}" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm-1">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-1">
                  </div>
                  <div class="form-group col-sm-10">
                    <div class="row">
                      <strong for="resume_filename">Upload Resume</strong>
                    </div>
                    <div class="card-body">
                      <a href="{{ asset('upload_data').'/'.$category->resume_realname }}" download>{{ $category->resume_filename }}</a>
                    </div>
                  </div>
                  <div class="form-group col-sm-1">
                  </div>
                </div>
              </div>
              <div class="card-footer-right">
                <div class="col-sm-12">
                  <button type="button" class="btn btn-default" onclick="onCancel()">Cancel</button>
                </div>
              </div>
            </div>
            <input type="text" name="assessment_type" value="1" hidden>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

<script type="text/javascript">
  function onCancel() {
    history.back();
  }
</script>