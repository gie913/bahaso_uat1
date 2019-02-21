<div class="row">

<div class="col-md-12">


	 <?php if($this->session->has_userdata('alert_status')) { ?>
		<div class="alert <?php echo $this->session->userdata('alert_type'); ?> alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon <?php echo $this->session->userdata('alert_icon'); ?>"></i> <?php echo $this->session->userdata('alert_heading'); ?></h4>
             <?php echo $this->session->userdata('alert_label'); ?>
              </div>
		<?php 
			$alert = array(
				'alert_status',
				'alert_type',
				'alert_icon',
				'alert_heading',
				'alert_label'
			);
			$this->session->unset_userdata($alert);
		}
		?>	  

        <div class="col-xs-12">
          <div class="box">
           <div class="box-header with-border">
              <h3 class="box-title">Table of Projects</h3>
				
			   <?php if($this->session->has_userdata('userid')) { ?>	
			 <div class="box-tools pull-right">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_add" title="Add Data" ><i class="fa fa-plus"></i> Add Data
                </button>
              </div>
			   <?php } ?>
			  
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			<div class="table-responsive">
              <table id="table_project" class="table table-bordered table-striped">
                <thead>
                <tr>
				<th></th>
                  <th> Project Name</th>
                  <th> Platform</th>
                  <th> Version</th>
                  <th>View</th>  
				   <th>Download</th>
				   <?php if($this->session->has_userdata('userid')) { ?>		
				 <th>Write Result</th>
				  <th>Status</th>
				  <th> Other Action</th>
				   <?php } ?>
                </tr>
                </thead>
                <tbody>
					
                </tbody>
                <tfoot>
                <tr>
				<th></th>
                    <th> Project Name</th>
                  <th> Platform</th>
                  <th> Version</th>
				   
                  <th>View</th>
				   <th>Download</th>
				   <?php if($this->session->has_userdata('userid')) { ?>		
				 <th>Write Result</th>
				  <th>Status</th>
				  <th> Other Action</th>
				   <?php } ?>
                </tr>
                </tr>
                </tfoot>
              </table>
            </div>
			</div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
	  
	  <!-- modal add -->
	  <div class="modal fade" id="modal_add">
          <div class="modal-dialog">
		  	<form class="form-horizontal" action="<?php echo base_url() ?>project/save" method="post">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Project</h4>
              </div>
              <div class="modal-body">
                <p>
                <div class="form-group">
                  <label for="projectname" class="col-sm-4 control-label">UAT Project Name</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="projectname" name="projectname" placeholder="Project Name" required >
                  </div>
                </div>
			    <div class="form-group">
                  <label for="version" class="col-sm-4 control-label">Version</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="version" name="version" placeholder="Version" required >
                  </div>
                </div>
			  
			    <div class="form-group">
                  <label for="platform" class="col-sm-4 control-label"> Platform</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="platform" name="platform" placeholder="Platform" required >
                  </div>
                </div>

				</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
		  </form>
		  </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
	  
	  
	  
	     <?php if($this->session->has_userdata('userid')) { ?>
	  
	   <div class="modal fade" id="modal_edit">
          <div class="modal-dialog">
		  	<form class="form-horizontal" action="<?php echo base_url() ?>project/update" method="post">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Project</h4>
              </div>
              <div class="modal-body">
                <p>
				<input type="hidden" class="form-control" id="id1" name="id" placeholder="Project Name" required >
                <div class="form-group">
                  <label for="projectname" class="col-sm-4 control-label">UAT Project Name</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="projectname1" name="projectname" placeholder="Project Name" required >
                  </div>
                </div>
			    <div class="form-group">
                  <label for="version" class="col-sm-4 control-label">Version</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="version1" name="version" placeholder="Version" required >
                  </div>
                </div>
			  
			    <div class="form-group">
                  <label for="platform" class="col-sm-4 control-label"> Platform</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="platform1" name="platform" placeholder="Platform" required >
                  </div>
                </div>

				</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
		  </form>
		  </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
	  
	  
	  <script type="text/javascript">
	  function callModal(id,name,version,platform)
	  {
		  	$('#modal_edit').modal('show');
			$('#id1').val(id);
			$('#projectname1').val(name);
			$('#version1').val(version)
			$('#platform1').val(platform)
	  }
	  </script>
		 <?php } ?>