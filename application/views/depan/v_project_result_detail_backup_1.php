<style>
#radioBtn .notActive{
    color: #3276b1;
    background-color: #fff;
}
</style>


<div class="row">
        <div class="col-md-12">
          <div class="box">
           <div class="box-header with-border">
              <h2 class="box-title"><?php echo $project_name;?>
			  
			  <small> <?php echo $project_status?> <?php echo round($avg,2);?>% . Tested by : <?php echo $nama; ?> </small>
			  </h2>
             
			  <div class="box-tools pull-right">   
				 <a  class="btn btn-link" href="<?php echo base_url()."project";?>" ><i class="fa fa-chevron-left"></i> Back
                </a>
				 <a  class="btn btn-link" href="<?php echo base_url()."project/download/".$token."/".$user_id."/".$nama;?>" ><i class="fa fa-download"></i> Download
                </a>
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
			 
			 
			 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover">
                <thead>
                <tr>
				<th width="2%"> No</th>
                <th width="8%"> Feature</th>
				<th width="90%"> Action</th>
               
                </tr>
                </thead>
                <tbody>
		<?php
		if($load_feature->num_rows()>0)
		{	
		$no=1;
		foreach($load_feature->result_array() as $feature)
		{
			//$load_action	= $this->m_main->show_action_by_idfeature2($feature['feature1_id']);
		//	$no1=1;
			//foreach($load_action->result_array() as $action)
			//{		
		?>
                <tr>
				
					<td><h3> <?php echo $no;?></h3></td>
					<td><h3><?php echo $feature['feature1_name'];?></h3></td>
				
					
					<td> 
					
					<table class="table table-striped table-bordered">
					<thead>
					<th width="2%">
					No
					</th>
					<th width="10%">
					Action
					</th>
					<th width="90%">
					Case and Expectation
					</th>
					</thead>
					<tbody>
					<?php
				$load_action	= $this->m_main->show_action_by_idfeature2($feature['feature1_id']);
				if($load_action->num_rows()>0)
				{	
				$no1=1;
				foreach($load_action->result_array() as $action)
				{		
					?>
					
					<tr>
					<td><h4><?php echo $no1;?></h4></td>
					<td><h4><?php echo $action['action1_name'];?></h4></td>
					<td>
					<table width="100%" class="table table-bordered">
					<?php 
				$load_case	= $this->m_main->show_case_by_idaction($action['action1_id']);
				if($load_case->num_rows()>0)
				{	
				$no2=1;
				foreach($load_case->result_array() as $case)
				{	
				?>
					
					<tr>
					<td width="5%">
					<?php echo $no2;?>
					</td>				
					
					<td width="30%">
					<?php echo $case['case1_desc'];?>
					</td>
					<td width="30%">
					<?php echo $case['case1_expectation'];?>
					</td>
					<td width="10%">
					<?php echo $case['case1_type'];?>
					</td>
					<td width="10%">
					<?php 
					
					if($case['case1_important']=="important")
					{
					echo "<span class='label label-warning'>".$case['case1_important']."</span>";
					}?>
					</td>
					<td width="15%">
					
				<?php
				$hasil = $this->m_main->show_result3($token,$case['case1_id']);
				
				if($hasil->num_rows()>0)
				{
					$row = $hasil->result_array();
					if($row[0]['result_status']==1)
					{
						$status="<span class='label label-success'><i class='fa fa-check'></i> Accepted</span>";
					}
					else if($row[0]['result_status']==2)
					{
						$status="<span class='label label-danger'><i class='fa fa-remove'></i> Rejected</span>";
					}
					$note 	= $row[0]['result_note'];
				}	
				
				else
				{
					$status = "";
					$note="";
				}
			
					
					echo $status."<br>".$note;
					
					
					
					
				?>
					

					</td>
					</tr>
					<?php
				$no2++;}
				}
					?>
					</table>
					
					</td>
					</tr>
					
					<?php
				$no1++;}
				}
					?>
					</tbody>
					</table>
					
					</td>
					
					</tr>
				
		<?php //$no1++;} 
	
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




	