@extends('user')
@section('content')
  <div class="container-fluid">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-md-12">
          <form action="{{ route('assessment.register') }}" method="post" enctype="multipart/form-data" class="form-assessment">
            {{ csrf_field() }}
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
                        <input type="text" name="first_name" class="form-control" id="first_name" required>
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" class="form-control" id="last_name" required>
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
                        <input type="text" name="mobile_phone" class="form-control" id="mobile_phone" required>
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
                      </div>
                      <input type="email" name="email" class="form-control" id="email" required>
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
                        <input type="radio" id="male" name="gender" value="0" checked> Male
                      </label>
                    </div>
                    <div class="radio">
                      <label for="female">
                        <input type="radio" id="female" name="gender" value="1"> Female
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
                        <input type="date" name="birthday" class="form-control" id="birthday" required>
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
                        <select id="married_status" name="married_status" class="form-control" required>
                          <option value="0">Single</option>
                          <option value="1">Married</option>
                          <option value="2">Divorced</option>
                          <option value="3">Widowed</option>
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
                        <input type="text" name="skype_id" class="form-control" id="skype_id">
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
                        <input type="text" name="instagram_id" class="form-control" id="instagram_id">
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
                        <select id="citizenship" name="citizenship" class="form-control">
                          @foreach ($country_list as $idx => $country)
                            <option value="{{ $idx }}">{{ $country }}</option>
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
                        <input type="text" name="street_address" class="form-control" id="street_address" required>
                      </div>
                      <div class="form-group col-sm-12">
                        <label for="address_line2">Address Line 2</label>
                        <input type="text" name="address_line2" class="form-control" id="address_line2" required>
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="city">City</label>
                        <input type="text" name="city" class="form-control" id="city" required>
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="state_province_region">State / Province / Region</label>
                        <input type="text" name="state_province_region" class="form-control" id="state_province_region" required>
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="zip_postal_code">ZIP / Postal Code</label>
                        <input type="text" name="zip_postal_code" class="form-control" id="zip_postal_code" required>
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="country">Country</label>
                        <select id="country" name="country" class="form-control" required>
                          @foreach ($country_list as $idx => $country)
                            <option value="{{ $idx }}">{{ $country }}</option>
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
                        <input type="date" class="form-control" id="passport_expire_date" name="passport_expire_date" required>
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
                        <select id="education_level" name="education_level" class="form-control" required>
                          <option value="0">High School</option>
                          <option value="1">Associate Degree</option>
                          <option value="2">Bachelor's Degree</option>
                          <option value="3">Graduate or Professional Degree</option>
                          <option value="4">Some College</option>
                          <option value="5">Master</option>
                          <option value="6">Phd</option>
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
                        <input type="text" name="university" class="form-control" id="university">
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
                        <input type="text" name="major" class="form-control" id="major" required>
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
                        <input type="date" name="from" class="form-control" id="from" required>
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
                        <input type="date" name="to" class="form-control" id="to" required>
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
                        <span class="numeric-invalid invalid"></span>
                        <input type="number" name="gpa_score" class="form-control" id="gpa_score" required>
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
                        <input type="radio" id="ep-yes" name="english_proficiency" value="0"> Yes
                      </label>
                    </div>
                    <div class="radio">
                      <label for="ep-no">
                        <input type="radio" id="ep-no" name="english_proficiency" value="1" checked> No
                      </label>
                    </div>
                  </div>
                  <div class="form-group col-sm-1">
                  </div>
                </div>
                <div class="row" id="english_proficiency_indicate" hidden="true">
                  <div class="form-group col-sm-1">
                  </div>
                  <div class="form-group col-sm-10">
                    <div class="row">
                      <strong for="indicate">please indicate<span style="color: red;"> *</span></strong>
                    </div>
                    <div class="radio">
                      <label for="academic">
                        <input type="radio" id="academic" class="indicate" name="indicate" value="0"> Academic
                      </label>
                    </div>
                    <div class="radio">
                      <label for="general">
                        <input type="radio" id="general" class="indicate" name="indicate" value="1"> General
                      </label>
                    </div>
                  </div>
                  <div class="form-group col-sm-1">
                  </div>
                </div>

                <!-- ////// when english proficiency is true. -->
                <div class="row" id="english_proficiency_true" hidden="true">
                  <div class="form-group col-sm-1">
                  </div>
                  <div class="form-group col-sm-10">
                    <div class="row">
                      <strong for="overall">Over all<span style="color: red;"> *</span></strong>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <input type="number" name="indicate_overall" class="form-control" id="overall" min="0" max="10">
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
                        <input type="number" name="indicate_writing" class="form-control" id="writing" min="0" max="10">
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
                        <input type="number" name="indicate_listening" class="form-control" id="listening" min="0" max="10">
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
                        <input type="number" name="indicate_reading" class="form-control" id="reading" min="0" max="10">
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
                        <input type="number" name="indicate_speaking" class="form-control" id="speaking" min="0" max="10">
                        <span>Please enter a value between 0 and 10.</span>
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
                      <strong for="french_proficiency">Do you have French language proficiency?<span style="color: red;"> *</span></strong>
                    </div>
                    <div class="radio">
                      <label for="fp-yes">
                        <input type="radio" id="fp-yes" name="french_proficiency" value="0"> Yes
                      </label>
                    </div>
                    <div class="radio">
                      <label for="fp-no">
                        <input type="radio" id="fp-no" name="french_proficiency" value="1" checked> No
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
                        <input type="text" name="latest_job_title" class="form-control" id="latest_job_title" required>
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
                        <select id="work_experience_years" name="work_experience_years" class="form-control" required>
                          <option value="0">less than one year</option>
                          <option value="1">1 year</option>
                          <option value="2">2 years</option>
                          <option value="3">3 years</option>
                          <option value="4">4 years</option>
                          <option value="5">Over 5 years</option>
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
                        <input type="radio" id="ah-yes" name="applid" value="0"> Yes
                      </label>
                    </div>
                    <div class="radio">
                      <label for="ah-no">
                        <input type="radio" id="ah-no" name="applid" value="1" checked> No
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
                      <div class="form-group col-sm-12 checkbox-group">
                        <label for="street_address">Which programs would you like to apply? Please specify 3 fields/Majors</label><br/>
                        <span class="checkbox-group-invalid invalid"></span>
                        <div class="checkbox">
                          <label for="educational_consultation">
                            <input class="checkbox" type="checkbox" id="educational_consultation" name="educational_consultation" value="1"> Educational consultation
                          </label>
                        </div>
                        <div class="checkbox">
                          <label for="apply_admission">
                            <input class="checkbox" type="checkbox" id="apply_admission" name="apply_admission" value="1"> Apply for Admission
                          </label>
                        </div>
                        <div class="checkbox">
                          <label for="credential">
                            <input class="checkbox" type="checkbox" id="credential" name="credential" value="1"> Credential assessment/Equivalent
                          </label>
                        </div>
                        <div class="checkbox">
                          <label for="apply_fund">
                            <input class="checkbox" type="checkbox" id="apply_fund" name="apply_fund" value="1"> Apply for fund/Scholarship
                          </label>
                        </div>
                        <div class="checkbox">
                          <label for="apply_accommodations">
                            <input class="checkbox" type="checkbox" id="apply_accommodations" name="apply_accommodations" value="1"> Apply for housing accommodations
                          </label>
                        </div>
                        <div class="checkbox">
                          <label for="apply_insurance">
                            <input class="checkbox" type="checkbox" id="apply_insurance" name="apply_insurance" value="1"> Apply for student health insurance
                          </label>
                        </div>
                        <div class="checkbox">
                          <label for="help_permits">
                            <input class="checkbox" type="checkbox" id="help_permits" name="help_permits" value="1"> Help to get study and work permits
                          </label>
                        </div>
                        <div class="checkbox">
                          <label for="travel_consultation">
                            <input class="checkbox" type="checkbox" id="travel_consultation" name="travel_consultation" value="1"> Travel arrangement consultation
                          </label>
                        </div>
                        <div class="checkbox">
                          <label for="airport_transfer">
                            <input class="checkbox" type="checkbox" id="airport_transfer" name="airport_transfer" value="1"> Airport transfer
                          </label>
                        </div>
                        <div class="checkbox">
                          <label for="help_registration">
                            <input type="checkbox" id="help_registration" name="help_registration" value="1"> Help for registration
                          </label>
                        </div>
                        <div class="checkbox">
                          <label for="help_bank">
                            <input class="checkbox" type="checkbox" id="help_bank" name="help_bank" value="1"> Help to open bank accounts
                          </label>
                        </div>
                        <div class="checkbox">
                          <label for="help_driving">
                            <input class="checkbox" type="checkbox" id="help_driving" name="help_driving" value="1"> Help to get driving licence
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
                        <select id="annual_budget" name="annual_budget" class="form-control" required>
                          <option value="1">Less than 30k $ CAD</option>
                          <option value="2">between 30 $ - 50k $ CAD</option>
                          <option value="3">between 50k $ - 150k $ CAD</option>
                          <option value="4">150k $ - 250$ k</option>
                          <option value="5">More than 250$k</option>
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
                        <select id="our_job" name="our_job" class="form-control">
                          <option value="0">Agents</option>
                          <option value="1">Friends</option>
                          <option value="2">Email marketing</option>
                          <option value="3">Newspapers</option>
                          <option value="4">Magazines</option>
                          <option value="5">Facebook</option>
                          <option value="6">Instagram</option>
                          <option value="7">Internet search</option>
                          <option value="8">Schools</option>
                          <option value="9">Seminars</option>
                          <option value="10">Fairs</option>
                          <option value="11">Other</option>
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
                        <input type="text" name="agent_name" class="form-control" id="agent_name">
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
                    <div class="card">
                      <div class="card-body">
                        <div style="text-align: center;">
                          <div >Drop files here or</div>
                          <div ><button type="button" id="btn-upload" class="btn btn-primary btn-lg">Select files</button></div>
                          <input type="file" id="resume_filename" name="resume_filename" accept="application/pdf,.pdf,image/jpeg,.jpg,image/png,.png" style="opacity: 0;">
                        </div>
                      </div>
                    </div>
                    fileName: <input id="file_name" name="file_name" readonly="true">
                  </div>
                  <div class="form-group col-sm-1">
                  </div>
                </div>
              </div>
              <div class="card-footer-right">
                <div class="col-sm-11">
                  <button type="submit" class="btn btn-lg btn-pinterest text btn-asseesment-submit">
                    <span>SEND REQUEST</span>
                  </button>
                </div>
                <div class="form-group col-sm-1">
                </div>
              </div>
            </div>
            <input type="text" name="assessment_type" value="0" hidden>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('myscript')
  <script src="{{ asset('js/views/user/home.js') }}"></script>
@endsection