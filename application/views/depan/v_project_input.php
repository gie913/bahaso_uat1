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
              <h3 class="box-title"><?php echo $project_name;?>
			  </h3>
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
                <th width="10%"> Feature</th>
				<th width="88%"> Action</th>
               
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
					
				$load_action	= $this->m_main->show_action_by_idfeature2($feature['feature1_id'],$type);
				if($load_action->num_rows()>0)
				{	
				$no1=1;
				foreach($load_action->result_array() as $action)
				{		
					?>
					
					<tr>
					<td width="5%"><h4><?php echo $no1;?></h4></td>
					<td width="10%"><h4><small><label class="label label-<?php echo ($action['action1_type']=="positive"?"success":"danger");?>"><?php echo $action['action1_type'];?></label></small><br><?php echo $action['action1_name'];?></h4></td>
					<td width="85%">
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
						$button_yes_class="btn-success btn-sm active";
						$button_no_class="btn-default btn-sm notActive";
					}
					else if($row[0]['result2_status']==2)
					{
						$button_yes_class="btn-default btn-sm notActive";
						$button_no_class="btn-danger btn-sm Active";
					}
					$note 	= $row[0]['result2_note'];
					$status = $row[0]['result2_status'];
				}	
				
				else
				{
						$button_yes_class="btn-default btn-sm notActive";
						$button_no_class="btn-default btn-sm notActive";
						$note 	= "";
						$status = "";
				}
				
				?>
					
					<form action="<?php echo base_url()?>listcase/saveresult" method="post" id="form<?php echo $no.$no1.$no2;?>">
					<div class="form-group">
    			<div class="input-group">
    				<div id="radioBtn" class="btn-group">
    					<a class="btn <?php echo $button_yes_class; ?>" data-toggle="nilai" id="ya<?php echo $no.$no1.$no2;?>" data-title="Y" onclick="pilih('1','nilai<?php echo $no.$no1.$no2; ?>','ya<?php echo $no.$no1.$no2;?>','tidak<?php echo $no.$no1.$no2;?>','form<?php echo $no.$no1.$no2;?>')">YES</a>
    					<a class="btn <?php echo $button_no_class; ?>" data-toggle="nilai" id="tidak<?php echo $no.$no1.$no2;?>" data-title="N" onclick="pilih('2','nilai<?php echo $no.$no1.$no2; ?>','ya<?php echo $no.$no1.$no2;?>','tidak<?php echo $no.$no1.$no2;?>','form<?php echo $no.$no1.$no2;?>')">NO</a>
    				</div>
					</div>
					<div class="form-group">
    				<input type="hidden" name="status" id="nilai<?php echo $no.$no1.$no2; ?>" value="<?php echo $status; ?>">
					<input type="hidden" name="token" value="<?php echo $token;?>">
					<input type="hidden" name="idfeature" value="<?php echo $feature['feature1_id'];?>">
					<input type="hidden" name="idaction" value="<?php echo $action['action1_id'];?>">
					<input type="hidden" name="idcase" value="<?php echo $case['case1_id'];?>">
					<textarea name="note" class="note" id="note<?php echo $no.$no1.$no2 ?>"placeholder="Notes" cols="30" rows="3"><?php echo $note;?></textarea>
					</div>
					<button type="button" class="btn btn-primary" onclick="kirimdata('form<?php echo $no.$no1.$no2;?>')"> Save</button>
                        <button type="button" class="btn btn-link upload_image" data-id="<?php echo $case['case1_id'];?>"> Upload Image </button>


		</form>
					
					
					
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
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
     </div>




<div class="modal fade" id="modal_upload_image">
    <div class="modal-dialog">
        <form class="form-horizontal" id="form_comment" action="<?php echo base_url() ?>project/insert_image" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><span id='type1'></span> Images</h4>
                </div>
                <div class="modal-body">
                    <p>
                        <input type="hidden" class="form-control" id="result2_id" name="result2_id">
                        <input type="hidden" class="form-control" id="action1_id" name="action1_id">
                        <input type="hidden" class="form-control" id="feature1_id" name="feature1_id">
                        <input type="hidden" class="form-control" id="project1_id" name="project1_id">
                        <input type="hidden" class="form-control" id="case1_id" name="case1_id">
                        <input type="hidden" class="form-control" id="project1_token" name="project1_token">
                    <div id="images"> </div>
                    <div class="form-group">
                        <label class="col-md-3"> Upload Image</label><span class="col-md-9"><input type="file" name="result3_image" accept="image/x-png,image/gif,image/jpeg" class="uImg" data-target="#preview_image"> </span>
                    </div>
                    <img id="preview_image" height="200px">
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="send" class="btn btn-primary" >Send</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->




<script type="text/javascript">
function pilih(isi,target,classya,classtidak,formObj){
    var sel = isi;
    var tog = target;
    $('#'+tog).prop('value', sel);
    
	if(sel=='1')
	{
		$('#'+classya).removeClass('notActive').addClass('active');
		$('#'+classya).removeClass('btn-default').addClass('btn-success');
		$('#'+classtidak).removeClass('active').addClass('notActive');
		$('#'+classtidak).removeClass('btn-danger').addClass('btn-default');		
	}	
	else if(sel=='2')
	{
		$('#'+classya).removeClass('active').addClass('notActive');
		$('#'+classya).removeClass('btn-success').addClass('btn-default');
		$('#'+classtidak).removeClass('notActive').addClass('active');
		$('#'+classtidak).removeClass('btn-default').addClass('btn-danger');
	}	
	
	$.ajax({
        url: '<?php echo base_url()."listcase/saveresult";?>',
       /* beforeSend: function(){
            $(responseDIV).html(image_load);
        },*/ 
        data: $('#'+formObj).serialize(), 
        type: "post", 
        dataType: "html",
		success: function(response){		
		//	$(responseDIV).html(response); //tempat klo sukses
			if(response=='berhasil')
			{
			$.notify("Data saved", "success");
			}
			else
			{
			$.notify("Error!", "error");
			}
        },
        error: function(){
			alert("Terjadi kesalahan!");
		},
	});
    return false;
}

  function change_url()
	  {
		var type	=  document.getElementById("case_type").value; 
		var curr_url	=  '<?php echo base_url();?>project/input/<?php echo $token?>/'+type;
		 window.location=(curr_url);
		  //alert(base_url+feature_id+'/'+token);
	  }


$(function () {

    $('#send').hide();
$('.upload_image').click(function(){
    var data_id = $(this).attr('data-id')
    $('#modal_upload_image').modal('show');
    $.ajax({
        type : 'POST',
        url  : "<?php echo base_url()?>project/show_images",
        data : { case1_id: data_id} ,
        success :  function(response)
        {
            var dt = JSON.parse(response);
            $('#case1_id').val( dt['case1_id'] );
            $('#feature1_id').val( dt['feature1_id'] );
            $('#action1_id').val( dt['action1_id'] );
            $('#project1_id').val( dt['project1_id'] );
            $('#result2_id').val( dt['result2_id'] );
            $('#project1_token').val( dt['project1_token'] );
            $('#images').html( dt['images'] );
        }
    });
});


    function readURL(input,preview_target) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $(preview_target).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".uImg").change(function() {
        $('#send').show();
        var target = $(this).attr("data-target");
        readURL(this,target);
    });


});
</script>	  
	  

	