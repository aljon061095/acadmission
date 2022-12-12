 <!-- Update Instructor Modal-->
 <div class="modal fade" id="update_instructor_<?php echo $instructor['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Update Instructor</h5>
                 <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>
             <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                 <div class="modal-body">
                     <div class="row mb-3">
                         <div class="col-sm-3 mb-3 mb-sm-0">
                             <img class="w-100 rounded-circle" src="images/male_avatar.svg" id="cimg">
                         </div>
                         <div class="col-sm-9 mt-3 mb-3 mb-sm-0">
                             <label for="" class="control-label">Profile</label>
                             <input type="file" class="form-control form-control-user" name="profile" onchange="displayImg(this,$(this))" required>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label for="first_name">First Name</label>
                                 <input type="hidden" name="id" value="<?php echo $instructor["id"]; ?>"/>
                                 <input type="text" name="first_name" value="<?php echo $instructor["first_name"]; ?>" class="form-control" id="first_name" required>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label for="last_name">Last Name</label>
                                 <input type="text" name="last_name" value="<?php echo $instructor["last_name"]; ?>" class="form-control" id="last_name" required>
                             </div>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label for="last_name">Email Address</label>
                                 <input type="email" name="email_address" value="<?php echo $instructor["email_address"]; ?>" class="form-control" id="email_address" required>
                             </div>
                         </div>

                         <div class="col-md-12">
                             <div class="form-group">
                                 <label for="username">Username</label>
                                 <input type="text" name="username" value="<?php echo $instructor["username"]; ?>" class="form-control" id="username" required>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="submit" name="update_instructor" class="btn btn-primary">Update</button>
                 </div>
             </form>
         </div>
     </div>
 </div>