@extends('admin')
@section('content')
  <div class="container-fluid">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <strong>Payment List</strong>
            </div>
            <div class="card-body">
              <form id="mainForm" name="mainForm" class="form" method="POST">
                {{ csrf_field() }}
                <table class="table table-responsive-sm table-bordered">
                  <thead>
                  <tr>
                    <th width="20">No</th>
                    <th width="100">Name</th>
                    <th width="100">Type</th>
                    <th width="100">Price(CAD)</th>
                    <th width="100"> Pay Image</th>
                    <th width="100"> Pay Type</th>
                    <th width="100">Date</th>
                    <th width="100">Registrant</th>
                    <th width="80">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @if (count($activities) === 0)
                    <tr>
                      <td colspan="9">
                        There is nothing.
                      </td>
                    </tr>
                  @else
                    <?php
                    $index = ($activities->currentPage() - 1) * $activities->perPage() + 1;
                    foreach ($activities as $activity) {
                    ?>
                    <tr>
                      <td><?= $index ?></td>
                      <td>
                        <a href="/admin/assessment_category/detail/{{ $activity->assessment_id }}">{{ $activity->first_name }} {{ $activity->last_name }}</a>
                      </td>
                      <?php
                      $type = $activity->assessment_type;
                      $str_type = "";
                      switch ($type) {
                        case 0:
                          $str_type = "Visa";
                          break;
                        case 1:
                          $str_type = "Study";
                          break;
                      }

                      $str_pay_type = "";
                      if ($activity->pay_type == 0) {
                        $str_pay_type = "Upload Bill";
                      } else {
                        $str_pay_type = "With Paypal";
                      }
                      ?>
                      <td>{{ $str_type }}</td>
                      <td>{{ $activity->pay_price }}</td>
                      <td>
                        <a href="{{ asset('upload_data').'/'.$activity->pay_realimage }}" target="_blank">{{ $activity->pay_image }}</a>
                      </td>
                      <td>{{ $str_pay_type }}</td>
                      <td>{{ $activity->updated_at }}</td>
                      <td>{{ $activity->user_name }}</td>
                      <td>
                        <a href="javascript:;" class="btn btn-primary btn-edit" activity-id="{{ $activity->id }}" assessment-id="{{ $activity->assessment_id }}">Accept</a>
{{--                        <a href="javascript:;" class="btn btn-danger btn-delete" activity-id="{{ $activity->id }}" data-target="modal">Reject</a>--}}
                      </td>
                    </tr>
                    <?php
                    $index++;
                    }
                    ?>
                  @endif
                  </tbody>
                </table>
                @include('common.paginator', ['paginator' => $activities])
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal Window for adding and edting --}}
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Select Document Type</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form name="editForm" id="editForm" method="post">
          {{csrf_field()}}
          <input type="hidden" name="activity_id" value="">
          <input type="hidden" name="assessment_id" value="">
          <div class="modal-body">
            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="inName">Docs Type</label>
              <div class="col-md-8">
                <select id="doc_type" name="doc_type" class="form-control">
                  <option value="0">University Docs</option>
                  <option value="1">College Docs</option>
                  <option value="2">Schools Docs</option>
                  <option value="3">Visa Docs</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-sm-12" id="check_group_university">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="university_0" value="1"> All documents should be officially translated, scanned in JPG format and send to us through Email address: info@radsam.ca
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="university_1" value="1"> The birth certificate and national ID of student and all family members.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="university_2" value="1"> Scan of the current and previous passport of the student and all family members.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="university_3" value="1"> The High School diploma and transcripts.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="university_4" value="1"> Bachelor degree and transcripts.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="university_5" value="1"> Resume(CV) of the Student in English.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="university_6" value="1"> IELTS Academic certificate (if applicable)
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="university_7" value="1"> The Police clearance certificate of the student and all family members.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="university_8" value="1"> The residential and commercial property ownership certificates.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="university_9" value="1"> The residential and commercial lease agreements.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="university_10" value="1"> The vehicle ownership certificates.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="university_11" value="1"> Bank statement letter for four past months.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="university_12" value="1"> The article of incorporation and/or business license for self-employed applicants.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="university_13" value="1"> The employment letter verification and two last pay stubs for employed applicants.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="university_14" value="1"> Colorful photography of the student, 3.5 cm * 4.5 cm with white background.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="university_15" value="1"> The military certificate for male applicants.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="university_16" value="1"> An English Word file of the student and all family members information includes full name, date of birth, address, postal code, education, cell phone, email, job title, employer name.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="university_17" value="1"> An English Word file of the student’s travel history includes city, departure date, leave date, purpose of visit, hotel name, base on the passport stamps for the past 5 years.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="university_18" value="1"> Previous visa refusal letters of Canada or the Unites States of America.
                  </label>
                </div>
              </div>
              <div class="form-group col-sm-12" id="check_group_college">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="college_0" value="1"> All documents should be officially translated, scanned in JPG format and send to us through Email address: info@radsam.ca
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="college_1" value="1"> The birth certificate and national ID of student and all family members.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="college_2" value="1"> Scan of the current and previous passport of the student and all family members.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="college_3" value="1"> The High School diploma and transcripts.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="college_4" value="1"> Bachelor degree and transcripts.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="college_5" value="1"> Resume(CV) of the Student in English.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="college_6" value="1"> IELTS Academic certificate (if applicable)
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="college_7" value="1"> The Police clearance certificate of the student and all family members.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="college_8" value="1"> The residential and commercial property ownership certificates.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="college_9" value="1"> The residential and commercial lease agreements.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="college_10" value="1"> The vehicle ownership certificates.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="college_11" value="1"> Bank statement letter for four past months.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="college_12" value="1"> The article of incorporation and/or business license for self-employed applicants.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="college_13" value="1"> The employment letter verification and two last pay stubs for employed applicants.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="college_14" value="1"> Colorful photography of the student, 3.5 cm * 4.5 cm with white background.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="college_15" value="1"> The military certificate for male applicants.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="college_16" value="1"> An English Word file of the student and all family members information includes full name, date of birth, address, postal code, education, cell phone, email, job title, employer name.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="college_17" value="1"> An English Word file of the student’s travel history includes city, departure date, leave date, purpose of visit, hotel name, base on the passport stamps for the past 5 years.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="college_18" value="1"> Previous visa refusal letters of Canada or the Unites States of America.
                  </label>
                </div>
              </div>
              <div class="form-group col-sm-12" id="check_group_school">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="school_0" value="1"> All documents should be officially translated, scanned in JPG format and send to us through Email address: info@radsam.ca
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="school_1" value="1"> The birth certificate and national ID card of student parents.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="school_2" value="1"> Scan of the current and previous passport of the student and parents.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="school_3" value="1"> Two latest school transcripts.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="school_4" value="1"> Vaccination card.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="school_5" value="1"> Resume(CV) of the Student in English with the scan of all certificates
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="school_6" value="1"> The Police clearance certificate of the student and parents.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="school_7" value="1"> The residential and commercial property ownership certificates under the name the name of student and parents.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="school_8" value="1"> The residential and commercial lease agreements under the name the name of student and parents.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="school_9" value="1"> The vehicle ownership certificates under the name the name of student and parents.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="school_10" value="1"> Bank statement letter for four past months.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="school_11" value="1"> The article of incorporation and/or business license for self-employed parents.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="school_12" value="1"> The employment letter verification and two last pay stubs for employed parents.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="school_13" value="1"> The student and parents Colorful photography of the student, 3.5 cm * 4.5 cm with white background.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="school_13" value="1"> An English Word file of the student and all family members information includes full name, date of birth, address, postal code, education, cell phone, email, job title, employer name.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="school_13" value="1"> An English Word file of the student’s travel history includes city, departure date, leave date, purpose of visit, hotel name, base on the passport stamps for the past 5 years.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="school_13" value="1"> Previous visa refusal letters of Canada or the Unites States of America.
                  </label>
                </div>
              </div>
              <div class="form-group col-sm-12" id="check_group_visa">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="visa_0" value="1"> All documents should be officially translated, scanned in JPG format and send to us through Email address: info@radsam.ca
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="visa_1" value="1"> The official invitation letter or the full information of the inviter who is a Canadian permanent resident or citizen.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="visa_2" value="1"> The Police clearance certificate of the student and all family members.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="visa_3" value="1"> The residential and commercial property ownership certificates.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="visa_4" value="1"> The residential and commercial lease agreements.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="visa_5" value="1"> The vehicle ownership certificates.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="visa_6" value="1"> Bank statement letter for four past months.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="visa_7" value="1"> The article of incorporation and/or business license for self-employed applicants.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="visa_8" value="1"> The employment letter verification and two last pay stubs for employed applicants.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="visa_10" value="1"> Colorful photography of the student, 3.5 cm * 4.5 cm with white background.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="visa_11" value="1"> The military certificate for male applicants.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="visa_12" value="1"> An English Word file of the student and all family members information includes full name, date of birth, address, postal code, education, cell phone, email, job title, employer name.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="visa_13" value="1"> An English Word file of the student’s travel history includes city, departure date, leave date, purpose of visit, hotel name, base on the passport stamps for the past 5 years.
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="visa_14" value="1"> Previous visa refusal letters of Canada or the Unites States of America.
                  </label>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <strong class="col-12 form-col-form-label">Message</strong>
            </div>
            <div class="form-group row">
              <label class="col-md-2 col-form-label" for="inputMsgTitle">title</label>
              <div class="col-md-10">
                <input type="text" class="form-control" id="msg_title" name="msg_title" placeholder="title" required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-2 col-form-label" for="txtMsgContent">content</label>
              <div class="col-md-10">
                <textarea id="msg_content" rows="5" class="form-control" name="msg_content" placeholder="message.." required></textarea>
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

  <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Reject</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form name="rejectForm" id="rejectForm" method="post">
          {{csrf_field()}}
          <input type="hidden" name="activity_id" id="activity_id" value="">
          <div class="modal-body">
            <div class="form-group row">
              <strong class="col-12 form-col-form-label">Message</strong>
            </div>
            <div class="form-group row">
              <label class="col-md-2 col-form-label" for="inputMsgTitle">title</label>
              <div class="col-md-10">
                <input type="text" class="form-control" id="msg_title" name="msg_title" placeholder="title" required>
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
            <button type="submit" class="btn btn-primary">Send</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>

    @endsection

    @section('myscript')
      <script src="{{ asset('js/views/admin/payment_list.js') }}"></script>
@endsection
