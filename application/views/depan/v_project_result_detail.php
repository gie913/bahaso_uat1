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
					<td><h4> <small><label class="label label-<?php echo ($action['action1_type']=="positive"?"success":"danger");?>"><?php echo $action['action1_type'];?></label></small><br><?php echo $action['action1_name'];?></h4></td>
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
				$hasil = $this->m_main->show_result2($user_id,$case['case1_id']);
				
				if($hasil->num_rows()>0)
				{
					$row = $hasil->result_array();
					if($row[0]['result2_status']==1)
					{
						$status="<span class='label label-success' ><i class='fa fa-check'></i> Accepted</span>";
					
					}
					else if($row[0]['result2_status']==2)
					{
						$status="<a class='label label-danger' onclick=\"callModal('". $row[0]['result2_id'] ."','".  $no.$no1.$no2 ."','add')\"><i class='fa fa-remove'></i> Rejected</a>";
					}
					$note 	= $row[0]['result2_note'];
				}	
				
				else
				{
					$status = "";
					$note="";
				}
			
					if($row[0]['result2_comment'])
					{
					$comment= "<label class='label label-info' data-toggle='tooltip' title='". $row[0]['result2_comment'] ."'><i class='fa fa-info'></i></label>";	
					}

					else
					{
					$comment= "";
					}	
					
					echo $status. " <div id='".$no.$no1.$no2."'> " . $comment . " </div>".$note;
					
					
					
					
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
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
     </div>

<div style="position: fixed; bottom: 10px; right: 15px; width: 30px; height: 30px; color: rgb(238, 238, 238); line-height: 30px; text-align: center; background-color: rgb(34, 45, 50); cursor: pointer; border-radius: 5px; z-index: 99999; opacity: 0.7;" onclick="topFunction()" id="scroll1"><i class="fa fa-chevron-up"></i></div>
 <div class="modal fade" id="modal1">
          <div class="modal-dialog">
		  	<form class="form-horizontal" id="form_comment" action="<?php echo base_url() ?>project/update" method="post">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span id='type1'></span> Comment</h4>
              </div>
              <div class="modal-body">
                <p>
				<input type="hidden" class="form-control" id="idresult" name="idresult">
				<input type="hidden" class="form-control" id="idobject" name="idobject">
                <div class="form-group">
                  <label for="projectname" class="col-sm-2 control-label">Comment</label>
                  <div class="col-sm-12">
                    <textarea class='form-control' placeholder="Comment" required rows="5" name="comment"></textarea>
                  </div>
                </div>
			 

				</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="sendComment()">Send</button>
              </div>
            </div>
            <!-- /.modal-content -->
		  </form>
		  </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->








<script>
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        //document.getElementById("scroll1").style.display = "block";
		$("#scroll1").fadeIn(2000);
    } else {
       // document.getElementById("scroll1").style.display = "none";
	   $("#scroll1").fadeOut(2000);
    }
}
function topFunction() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}	


  function callModal(idresult,idobject,type)
	  {
		  	$('#modal1').modal('show');
			$('#type1').html(type);
			$('#idresult').val(idresult);
			$('#idobject').val(idobject);
			$('#platform1').val(platform);
	  }

	function sendComment(){
		var idobject	= $('input[name="idobject"]').val();
		$.ajax({
        url: '<?php echo base_url()."listcase/comment";?>',
        data: $('#form_comment').serialize(), 
        type: "post", 
        dataType: "html",
		success: function(response){	
			var data 	= JSON.parse(response);	
			if(data['alert']=='berhasil')
			{
			$.notify("Data saved", "success");
			$('#modal1').modal('toggle');
			$('#'+idobject).append(data['comment']);
			}
			else
			{
			$.notify("Error!", "error");
			$('#modal1').modal('toggle');
			}
        },
        error: function(){
			alert("Terjadi kesalahan!");
		},
	});
    return false;
	  }
	  
	  
	  

</script>
 