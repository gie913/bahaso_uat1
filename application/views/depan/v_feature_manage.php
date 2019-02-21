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

		<?php
		
		if($project_status=='1')
		{
			$button_accept_type	= "btn-success";
			$button_reject_type	= "btn-default";		
		}	
		
		else if($project_status=='2')
		{
			$button_accept_type	= "btn-default";
			$button_reject_type	= "btn-danger";
		}	
		else
		{
			$button_accept_type	= "btn-default";
			$button_reject_type	= "btn-default";
		}
		
		?>
		
		<?php if($totalTester>0) { ?>
		 <div class="col-xs-12">
		<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Give result for this test</h3>
              <div class="box-tools pull-right">
                
				 <a  class="btn btn-link" href="<?php echo base_url()."project";?>" ><i class="fa fa-chevron-left"></i> Back
                </a>
				
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
			  
			    <div class="col-md-3" >
				
				<span style="font-size:2em"><?php echo round($avg,2) ?>%</span> <small> (from <?php echo $totalTester?> testers)</small>
				
				</div>		
			  
			  
                <div class="col-md-9">
				<button type="button" class="btn <?php echo $button_accept_type;?>" title="" onclick="checklist(1)"><i class="fa fa-check"></i> Accept this Test
                </button>
				
				<button type="button" class="btn <?php echo $button_reject_type;?> title="" onclick="checklist(2)"><i class="fa fa-remove"></i> Reject this Test
                </button>
				 
                </div>
                <!-- /.col -->
               
                <!-- /.col -->
              </div>
		</div>
</div>
</div>
		<?php } ?>
		
        <div class="col-xs-12">
          <div class="box">
           
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <td> Feature Name</th>
                  <td> Description</th>
                  <td> Action</th>             
                </tr>
                </thead>
                <tbody>
				<tr>
				<form action="<?php echo base_url()."feature/save"; ?>" method="post">
				<td><input type="hidden" name="token" class="form-control" required value="<?php echo $token;?>"><input type="text" name="name" class="form-control" required style="width:300px"></td>
                  <td> <textarea type="text" name="desc" cols="50" class="form-control" ></textarea></td>
                  <td><button type="submit" class="btn btn-primary"> Save</button></td> 
				</form>
				</tr>
				 <?php
		   if($load_feature->num_rows()>0)
		   {
			foreach($load_feature->result_array() as $feature){
		   ?> 
			
                <tr>
				<form action="<?php echo base_url()."feature/update"; ?>" method="post">
                  <td>
				  <input type="hidden" name="id" class="form-control" required value="<?php echo $feature['feature1_id']?>">
				  <input type="hidden" name="token" class="form-control" required value="<?php echo $token;?>">
				  		<span style="display:none"> <?php echo $feature['feature1_name'] ?></span>
						<span style="display:none"> <?php echo $feature['feature1_desc'] ?></span>
			<input type="text" name="name" class="form-control" required value="<?php echo $feature['feature1_name']?>" style="width:300px"></td>
                  <td>
				  <textarea type="text" name="desc" cols="50" class="form-control" >  <?php echo $feature['feature1_desc'] ?></textarea>
		
				</td>
				   <td>
				   <a class="btn btn-info" href="<?php echo base_url()."action/manage/".$feature['feature1_id']."/".$token;?>">List Action <?php echo $this->m_main->show_total_actions($feature['feature1_id']); ?></a> 
				   <button type="submit" class="btn btn-primary">Update</button> 
				   <a class="btn btn-danger" onclick="return confirm('Are you sure to delete <?php echo $feature['feature1_name']?>?')" href="<?php echo base_url()."feature/delete/".$feature['feature1_id']."/". $token;?>">Delete</a> </td>
				</form>               
			   </tr>
				
		<?php
		   }
		   }
		?>				
                </tbody>
                <tfoot>
                <tr>
                  <tr>
                  <th> Feature Name</th>
                  <th> Description</th>
                  <th> Action</th>
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
	  <script>
	  function checklist(status)
	  {
		window.location=('<?php echo base_url()."project/checklist/".$token."/"; ?>'+status);  
	  }
	  </script>
	  