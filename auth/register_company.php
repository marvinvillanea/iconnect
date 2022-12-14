 <div id="modalUser" class="modal fade" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="false" >
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
           <div class="stepwizard" >
             <div class="stepwizard-row setup-panel">
               <div class="stepwizard-step">
                 <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                 <p>General information</p>
               </div>
               <div class="stepwizard-step">
                 <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                 <p>Company</p>
               </div>
               <div class="stepwizard-step">
                 <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                 <p>Account</p>
               </div>
             </div>
           </div>
         </div>
         <div class="modal-body">
           <div class="container" style="width:100%;">



             <form action="" class="form register_company" enctype="multipart/form-data">
              <input type="hidden" name="account_type" value="<?= $type ?>">
               <div class="row setup-content" id="step-1">
                 <div class="col-md-12 ">
                   <div class="col-md-12">
                     <h3> Step 1</h3>
                     <div class="form-group">
                       <label class="control-label">First Name</label>
                       <input maxlength="100" required="required" class="form-control" placeholder="Enter First Name" type="text" name="fname" value="">
                     </div>
                     <div class="form-group">
                       <label class="control-label">Last Name</label>
                       <input maxlength="100" required="required" class="form-control" placeholder="Enter Last Name" type="text" name="lname" value="">
                     </div>
                     <div class="form-group">
                       <label class="control-label">Contact No.</label>
                       <input maxlength="11" required="required" class="form-control" placeholder="Enter Mobile Number" type="text" name="cnum" value="">
                     </div>
                     <div class="form-group">
                       <label class="control-label">Birhdate.</label>
                       <input  required="required" class="form-control"  type="date" name="bday" value="" >
                     </div>
                      <div class="form-group">
                       <label class="control-label">Age.</label>
                       <input required="required" class="form-control" placeholder="Enter Age" type="text" name="age" value="">
                     </div>
                    <div class="form-group">
                       <label class="control-label">Address.</label>
                       <input  required="required" class="form-control" placeholder="Enter Address" type="text" name="address" value="">
                     </div>
                     <label class="control-label">Upload One Valid ID. </label>Supported Ext.(jpg,jpeg,png)
                       <input  required="required" class="form-control"  type="file" name="valid_photo" value="" >
                     </div>
                   </div>
                   <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
                 </div>
               </div>

               <div class="row setup-content" id="step-2">
                 <div class="col-xs-12">
                   <div class="col-md-12">
                     <h3> Step 2</h3>
                     <div class="form-group">
                       <label class="control-label">Company name</label>
                       <input maxlength="100" required="required" class="form-control" placeholder="Enter Company Name" name="company_name" value="" type="text" >
                     </div>
                     <div class="form-group">
                       <label class="control-label">Company address</label>
                       <input maxlength="100" required="required" class="form-control" name="company_address" placeholder="Company address"  value="" type="text" >
                     </div>
                     <div class="form-group">
                       <label class="control-label">Company contact no.</label>
                       <input m name="company_cnum" placeholder="Company contact no." maxlength="11" required="required" class="form-control"   value="" type="text" >
                     </div>
                     <div class="form-group">
                        <label class="control-label">Company position</label>
                         <input  required="required" class="form-control"  name="company_position" placeholder="Company position"  value="" type="text" >
                    </div>
                     <div class="form-group">
                        <label class="control-label">Deparment</label>
                        <input class="form-control" type="text" name="deparment" placeholder="Department" required="required" value="">
                    </div>
                     <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Back</button>
                     <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
                   </div>
                 </div>
               </div>

               <div class="row setup-content" id="step-3">
                 <div class="col-xs-12">
                   <div class="col-md-12">
                     <h3> Step 3</h3>
                     <div class="form-group">
                       <label class="control-label">Email</label>
                       <input  required="required" class="form-control" placeholder="Enter Email" type="text" name="email" value="">
                     </div>
                     <div class="form-group">
                       <label class="control-label">Password</label>
                       <input  required="required" class="form-control" type="password" name="password" value="">
                     </div>
                      <p class="terms">By clicking Agree & Join, you agree to the <span class="company_name">LocalMJob</span> <a onclick="showMOdalAgreement()">User Agreement</a> and <a onclick="showMOdalAgreement()">Privacy Policy</a>.</p>
                      <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Back</button>
                     <button class="btn btn-primary  btn-lg pull-right" type="submit">Agree & Join</button>
                   </div>
                 </div>
               </div>


             </form>

           </div>
         </div>
         <div class="modal-footer">
         </div>
       </div>
       <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
   </div>