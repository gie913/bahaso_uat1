
        <div class="col-md-12">
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
	  
	
	  
	