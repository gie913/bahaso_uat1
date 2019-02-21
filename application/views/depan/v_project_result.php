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
              <div class="box-tools pull-right">
     
     
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
              <table id="table_project" class="table table-bordered table-striped">
                <thead>
                <tr>
				<th></th>
                  <th> UAT Project Name </th>
                  <th> Platform </th>
                  <th> Version </th>
				  <th> AVG Score</th>
				  <th> Result </th>
                   <th>Download</th>
				  <th> QA </th>
                </tr>
                </thead>
                <tbody>
				
                </tbody>
                <tfoot>
                <tr>
				<th></th>
                    <th> UAT Project Name </th>
                  <th> Platform </th>
                  <th> Version </th>
				  <th> AVG Score</th>
				  <th> Result </th>
                   <th>Download</th>
				  <th> QA </th>
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
	  
	 