<div class="col-md-6 col-md-offset-2">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Profile</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="<?php echo base_url()?>akun/update_profile">
              <div class="box-body">
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" placeholder="" name="username" disabled readonly name="username" value="<?php echo $this->session->userdata('username') ?>">
                </div>
				<div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" placeholder="Enter Your Name" Required name="nama" value="<?php echo $this->session->userdata('name') ?>">
                </div>
			  <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="name" placeholder="Enter Your Password" Required name="password" value="">
                </div>
			  
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->

        </div>