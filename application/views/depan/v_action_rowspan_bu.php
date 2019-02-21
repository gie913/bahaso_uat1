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
    
          <div class="box">
           <div class="box-header with-border">
              <h3 class="box-title"><?php echo $feature_name;?></h3>
              <div class="box-tools pull-right">
				   <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_add" title="Add Data" ><i class="fa fa-plus"></i> Add Data
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover">
                <thead>
                <tr>
				<td> No</td>
                  <td width="48%"> Action</th>
                  <td width="48%">List of Case </th>             
                </tr>
                </thead>
                <tbody>
				 <?php
		   if($load_action->num_rows()>0)
		   {
			  $no=1;
			foreach($load_action->result_array() as $action){
				
		   ?> 
                <tr>
                  
				  <?php 
					$index=0;  
				  if($index>0) // kalo ada jumalah casenya berarti kolom pertama di baris kedua, gak ada
				 {  
					echo "";		  
				 }
				else{		// kalo masih atau 1 berarti tampil
				  ?>
					<td> <?php echo $no;?></td>
				 <td rowspan="<?php echo $action['totalcase'];?>">	  
				  <?php echo $action['action1_name'];?> <a href="<?php echo base_url()."action/delete/".$action['action1_id']; ?>" class="btn btn-danger btn-sm"  onclick="return confirm('Are you sure to delete <?php echo $action['action1_name']?>?')">
				  <i class="fa fa-trash"></i>
				  </a>
				  <a href="#" class="btn btn-info btn-sm">
				  <i class="fa fa-edit"></i>
				  </a>
		
				</td>
				<?php
				}
				?>
                
				  <td>
				     <div class="box-body pad">
              <form action="<?php echo base_url() ?>case/save" method="post">
            <div class="box-body pad">               
			   <textarea class="textarea" placeholder="Type case"
                          style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="case"></textarea>
				 <textarea class="textarea" placeholder="Type Expectation"
                          style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="expectation"></textarea>		  
              <input type="hidden" name="idfeature" value="<?php echo $idfeature;?>">
			  <input type="hidden" name="token" value="<?php echo $token;?>">
			  <input type="hidden" name="idaction" value="<?php echo $action['action1_id'];?>">
			  <button type="submit" class="btn btn-primary">Save</button>
			  </form>
            </div>
				  
				  
				  
				  </td>
				              
			   </tr>
				
		<?php
		  if($action['totalcase']>1)
				  {  
					$index++;			  
				  }
			$no++;
		 }
		   }
		?>				
                </tbody>
                <tfoot>
                <tr>
                  <tr>
                  <th> Action</th>
               
                  <th> List Case</th>
                </tr>
                </tr>
                </tfoot>
              </table>
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
		  	<form class="form-horizontal" action="<?php echo base_url() ?>action/save" method="post">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Action</h4>
              </div>
              <div class="modal-body">
                <p>
				
                <div class="form-group">
                  <label for="actionname" class="col-sm-4 control-label">Action Name</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="actionname" name="name" placeholder="Action Name" required >
					 <input type="hidden" class="form-control" id="token" name="token" value="<?php echo $token;?>">
					 	 <input type="hidden" class="form-control" id="idfeature" name="idfeature"   value="<?php echo $idfeature;?>">
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
	  