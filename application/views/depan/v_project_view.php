<div class="row">
        <div class="col-md-12">
          <div class="box">
           <div class="box-header with-border">
              <h3 class="box-title"><?php echo $project_name;?> </h3>
               <select class="" onchange="change_url()" id="case_type">
			  <option value="positive" <?php echo ($type=="positive")?"selected":""?> >Positive Case</option>
			 <option value="negative" <?php echo ($type=="negative")?"selected":"";?> >Negative Case</option>			  
			  </select>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
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
		?>
                <tr>
				
					<td><h3> <?php echo $no;?></h3></td>
					<td><h3><?php echo $feature['feature1_name'];?></h3></td>
				
					
					<td> 
				<?php 
				$load_action	= $this->m_main->show_action_by_idfeature2($feature['feature1_id'],$type);
				if($load_action->num_rows()>0)
				{
				?>
					<table class="table table-striped table-bordered">
					<thead>
					<th width="2%">
					No
					</th>
					<th width="20%">
					Action
					</th>
					<th width="80%">
					Case and Expectation
					</th>
					</thead>
					<tbody>
					<?php	
				$no1=1;
				foreach($load_action->result_array() as $action)
				{		
					?>
					
					<tr>
					<td><h4><?php echo $no1;?></h4></td>
					<td><h4><small><label class="label label-<?php echo ($action['action1_type']=="positive"?"success":"danger");?>"><?php echo $action['action1_type'];?></label></small><br><?php echo $action['action1_name'];?></h4></td>
					<td>
					<?php 
					$load_case	= $this->m_main->show_case_by_idaction($action['action1_id']);
					if($load_case->num_rows()>0)
					{	
					?>
					<table width="100%" class="table table-bordered">
					<?php 
				
				$no2=1;
				foreach($load_case->result_array() as $case)
				{	
				?>
					
					<tr>
					<td width="5%">
					<?php echo $no2;?>
					</td>				
					
					<td width="35%">
					<?php echo $case['case1_desc'];?>
					</td>
					<td width="35%">
					<?php echo $case['case1_expectation'];?>
					</td>
					<td width="12%">
					<?php echo $case['case1_type'];?>
					</td>
					<td width="12%">
					<?php 
					
					if($case['case1_important']=="important")
					{
					echo "<span class='label label-warning'>".$case['case1_important']."</span>";
					}?>
					</td>
					</tr>
					<?php
				$no2++;}
				
					?>
					</table>
					<?php } ?>
					</td>
					</tr>
					
					<?php
				$no1++;}
					?>
					</tbody>
					</table>
				<?php } ?>
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
                 <th width="2%"> No</th>
                <th width="8%"> Feature</th>
				<th width="90%"> Action</th>
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
	   function change_url()
	  {
		var type	=  document.getElementById("case_type").value; 
		var curr_url	=  '<?php echo base_url();?>project/input/<?php echo $token?>/'+type;
		 window.location=(curr_url);
		  //alert(base_url+feature_id+'/'+token);
	  }
	</script>