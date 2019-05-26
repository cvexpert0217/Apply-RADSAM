@extends('user')
@section('content')
      <div class="container-fluid">
        <div class="animated fadeIn">
		<input type="hidden" name="study_id" value="<?php echo $activity_id; ?>">
		<input type="hidden" name="university_id" value="<?php echo $university_id; ?>">
			{{ csrf_field() }}
          <div class="row">
            <div class="col-md-12">
              	<div class="card">
	                <div class="card-header">
	                  	<strong>Policy</strong>
	                </div>
	                <div class="card-body">
	                  	<div class="row">
	                		<div class="col-md-1"></div>
	                		<div class="col-md-10">
	                			<div class="card">
	                				<div class="card-body">
	                					<div class="policy-detail">
	                						FOXIT SOFTWARE INC. LICENSE AGREEMENT FOR DESKTOP SOFTWARE APPLICATIONS<br><br>

											IMPORTANT-READ CAREFULLY: This Foxit Software Inc. ("Foxit") License Agreement ("License" or "Agreement") is a legal agreement between You (either an individual or an entity, who will be referred to in this License as "You" or "Your") and Foxit for the use of desktop software applications, and which may include associated media, printed materials, and other components and software modules including but not limited to drivers ("Product"). The Product also includes any software updates and upgrades that Foxit may provide to You or make available to You, or that You obtain after the date You obtain Your initial copy of the Product, to the extent that such items are not accompanied by a separate license agreement or terms of use. BY INSTALLING, COPYING, DOWNLOADING, ACCESSING OR OTHERWISE USING THE PRODUCT, YOU AGREE TO BE BOUND BY THE TERMS OF THIS FOXIT LICENSE AGREEMENT. IF YOU DO NOT AGREE TO THE TERMS OF THIS AGREEMENT YOU HAVE NO RIGHTS TO THE PRODUCT AND SHOULD NOT INSTALL, COPY, DOWNLOAD, ACCESS OR USE THE PRODUCT. 
											The Product is protected by copyright laws as well as other intellectual property laws. The Product is licensed and not sold. 
											1. GRANT OF LICENSE. Foxit grants You a non-exclusive, nontransferable license to install and use the Product subject to all the terms and conditions set forth here within. 
											1.1.Â Single-Use Perpetual License. You may permit a single authorized end user to install the Product on a single computer for use by that end user only. Remote access to the paid products (such as Foxit PhantomPDF, Microsoft Active DirectoryÂ®Â Rights Management Services (âRMSâ), DocuSign feature in Foxit Reader and Foxit Redactor for Office) are not permitted without the express written consent of Foxit. 
											1.2. Subscription License. The Product is licensed on a monthly or annual subscription basis, You may only apply the subscription license on the Permitted Number of Compatible Computer(s) as long as you maintain a currently paid-up subscription of the Product. 
											2. ADDITIONAL LIMITATIONS. You may not reverse engineer, decompile, or disassemble the Product, except and only to the extent that it is expressly permitted by applicable law notwithstanding this limitation. You may not rent, lease, lend or transfer the Product, or host the Product for third parties without the express written consent of Foxit. The Product is licensed as a single integral product; its component parts may not be separated for use on more than one computer. The Product may include copy protection technology to prevent the unauthorized copying of the Product or may require original media for use of the Product on the computer. It is illegal to make unauthorized copies of the Product or to circumvent any copy protection technology included in the Product. The software may not be resold either by You or a third party customer without the prior written permission of Foxit. All rights not expressly granted to You are retained by Foxit. 
											3. Third Party Software. The Product may contain third party software that Foxit can grant sublicense to use or in the case of the Microsoft Corporation AD RMS Client Foxit grants a limited use license, all which is protected by copyright law and other applicable laws.
											IMPORTANT-READ CAREFULLY: This Foxit Software Inc. ("Foxit") License Agreement ("License" or "Agreement") is a legal agreement between You (either an individual or an entity, who will be referred to in this License as "You" or "Your") and Foxit for the use of desktop software applications, and which may include associated media, printed materials, and other components and software modules including but not limited to drivers ("Product"). The Product also includes any software updates and upgrades that Foxit may provide to You or make available to You, or that You obtain after the date You obtain Your initial copy of the Product, to the extent that such items are not accompanied by a separate license agreement or terms of use. BY INSTALLING, COPYING, DOWNLOADING, ACCESSING OR OTHERWISE USING THE PRODUCT, YOU AGREE TO BE BOUND BY THE TERMS OF THIS FOXIT LICENSE AGREEMENT. IF YOU DO NOT AGREE TO THE TERMS OF THIS AGREEMENT YOU HAVE NO RIGHTS TO THE PRODUCT AND SHOULD NOT INSTALL, COPY, DOWNLOAD, ACCESS OR USE THE PRODUCT. 
											The Product is protected by copyright laws as well as other intellectual property laws. The Product is licensed and not sold. 
											1. GRANT OF LICENSE. Foxit grants You a non-exclusive, nontransferable license to install and use the Product subject to all the terms and conditions set forth here within. 
											1.1.Â Single-Use Perpetual License. You may permit a single authorized end user to install the Product on a single computer for use by that end user only. Remote access to the paid products (such as Foxit PhantomPDF, Microsoft Active DirectoryÂ®Â Rights Management Services (âRMSâ), DocuSign feature in Foxit Reader and Foxit Redactor for Office) are not permitted without the express written consent of Foxit. 
											1.2. Subscription License. The Product is licensed on a monthly or annual subscription basis, You may only apply the subscription license on the Permitted Number of Compatible Computer(s) as long as you maintain a currently paid-up subscription of the Product. 
											2. ADDITIONAL LIMITATIONS. You may not reverse engineer, decompile, or disassemble the Product, except and only to the extent that it is expressly permitted by applicable law notwithstanding this limitation. You may not rent, lease, lend or transfer the Product, or host the Product for third parties without the express written consent of Foxit. The Product is licensed as a single integral product; its component parts may not be separated for use on more than one computer. The Product may include copy protection technology to prevent the unauthorized copying of the Product or may require original media for use of the Product on the computer. It is illegal to make unauthorized copies of the Product or to circumvent any copy protection technology included in the Product. The software may not be resold either by You or a third party customer without the prior written permission of Foxit. All rights not expressly granted to You are retained by Foxit. 
											3. Third Party Software. The Product may contain third party software that Foxit can grant sublicense to use or in the case of the Microsoft Corporation AD RMS Client Foxit grants a limited use license, all which is protected by copyright law and other applicable laws.
	                					</div>
	                				</div>
	                			</div>
	                			<div class="confirm-policy">
	                				<div class="confirm-policy">
			                            <label for="confirm-policy">		                              
			                              <input type="checkbox" id="confirm-policy-study" name="educational-consultation" value="1">
			                              <span>I am confirm all</span>			                              
		                            	</label>
										<button disabled="true" class="btn btn-lg btn-primary btn-confirm-policy-study">Next</button>
		                            </div>
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
	<script src="{{ asset('js/views/user/policy.js') }}"></script>
@endsection