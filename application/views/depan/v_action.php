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
              <h3 class="box-title">
			  Feature : <select class=/"form-control" onchange="change_url()" id="feature_position">
			  <?php 
			  foreach($feature_list->result_array() as $list_feature)
			  {
				  if($list_feature['feature1_id']==$idfeature)
				  {
					 $sel="selected" ;
				  }			
				  else
				  {
					$sel="";					
				  } 
				  echo "<option value='". $list_feature['feature1_id'] ."' ".$sel .">". $list_feature['feature1_name'] ."</option>";
			  }
			  ?>
			 
			  </select>
			  </h3>
              <div class="box-tools pull-right">
			  <a  class="btn btn-link" href="<?php echo base_url()."feature/manage/".$token;?>" ><i class="fa fa-chevron-left"></i> Back
                </a>


                  <button  class="btn btn-default" onclick="bottomFunction()" ><i class="fa fa-angle-down"></i> Go to Bottom
                  </button>


                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_add" title="Add Data" ><i class="fa fa-plus"></i> Add Action
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead>
                <tr>
				<td width="3%"> No</td>
                  <td width="7%"> Action</th>
                  <td width="90%">List of Case </th>             
                </tr>
                </thead>
                <tbody>
				 <?php
		   if($load_action->num_rows()>0)
		   {
			  $no=1;
			  $total_action = $load_action->num_rows();
			foreach($load_action->result_array() as $action){
				
		   ?> 
                <tr>
       
					<td width="5%"> <?php echo $no;?>

                    <?php


                        $this->m_main->update_order($action['action1_id'],$no);

                        if($no==1)
                        {
                            $next_no = $no+1;
                           echo "<br><a href='". base_url() ."action/move/". $action['action1_id']."/". $action['action1_order']."/". $next_no ."/". $idfeature ."/".$token."' class='btn btn-info btn-xs'> <i class='fa fa-chevron-down'></i>";
                        }
                        else if($no>1 && $no<$total_action)
                        {
                            $next_no = $no+1;
                            $prev_no = $no-1;
                            echo "<br><a href='". base_url() ."action/move/". $action['action1_id']."/". $action['action1_order']."/". $prev_no ."/". $idfeature ."/".$token."' class='btn btn-info btn-xs'> <i class='fa fa-chevron-up'></i>";
                            echo "<a href='". base_url() ."action/move/". $action['action1_id']."/". $action['action1_order']."/". $next_no ."/". $idfeature ."/".$token."' class='btn btn-info btn-xs'> <i class='fa fa-chevron-down'></i>";

                        }
                        else if($no==$total_action)
                        {
                            $prev_no = $no-1;
                            echo "<br><a href='". base_url() ."action/move/". $action['action1_id']."/". $action['action1_order']."/". $prev_no ."/". $idfeature ."/".$token."' class='btn btn-info btn-xs'> <i class='fa fa-chevron-up'></i>";
                        }

                        ?>

                    </td>
				 <td width="10%">	
				<?php if($action['action1_type']=="positive")$lbl="success"; else $lbl="danger"; ?>
					<label class="label label-<?php echo $lbl;?>"><?php echo $action['action1_type']; ?></label>
				 <h3> <?php echo $action['action1_name'];?></h3>
				 <a href="<?php echo base_url()."action/delete/".$action['action1_id']."/".$idfeature."/".$token; ?>" class="btn btn-danger btn-sm"  onclick="return confirm('Are you sure to delete <?php echo $action['action1_name']?>?')">
				  <i class="fa fa-trash"></i>
				  </a>
				  <button class="btn btn-info btn-sm" onclick="callModal(<?php echo "'". $action['action1_id'] ."', '". $action['action1_name'] ."'"?>)">
				  <i class="fa fa-edit" ></i>
				  </button>
		
				</td>
				  <td width="85%">
				  
				  <button class="btn btn-primary" onclick="callModal2(<?php echo "'". $action['action1_id'] ."', '". $action['action1_name'] ."','". $action['action1_type']  ."'";?>)"> <i class="fa fa-plus"> </i> Add Case </button>
				  <br><?php
					$load_case		= $this->m_main->show_case_by_idaction($action['action1_id']);
					 if($load_case->num_rows()>0)
					{?>				 
				 <table class="table table-striped table-bordered" width="100%">
					<thead>
					<tr>
					<th width="5%">
					No
					</th>
					<th width="32%">
					Case
					</th>
					<th width="32%">
					Expectation
					</th>
					<th width="10%">
					Type
					</th>
					<th width="10%">
					Important
					</th>
					<th width="11">
				
					</th>
					</tr>
					</thead>
					<tbody>
					<?php 
					
					$no2=1;
					foreach($load_case->result_array() as $case){
					?>
					
					<tr>
					<td>
					<?php echo $no2;?>
					</td>
					<td>
					<?php echo $case['case1_desc'];?>
					</td>
					<td>
					<?php echo $case['case1_expectation'];?>
					</td>
					<td>
					<?php echo $case['case1_type'];?>
					</td>
					<td>
					<?php echo $case['case1_important'];?>
					</td>
					<td>
					
					<button class="btn btn-primary btn-sm"  onclick="callModal3(<?php echo "'". $case['case1_id'] ."'".","."'". $action['action1_name'] ."'".","."'". $case['case1_desc'] ."'".","."'". $case['case1_expectation'] ."'".","."'". $case['case1_type'] ."'".","."'". $case['case1_important'] ."'";?>)" >
				  <i class="fa fa-pencil"></i>
				  </button>
					
					<a href="<?php echo base_url()."listcase/delete/".$case['case1_id']."/".$idfeature."/".$token; ?>" class="btn btn-danger btn-sm"  onclick="return confirm('Are you sure to delete this case ?')">
				  <i class="fa fa-trash"></i>
				  </a>
				
				
					</td>
					</tr>
					<?php 
				$no2++;	}
					
					
					?>
					</tbody>
				  </table>
				  <?php
					}
				  ?>
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
				  <th> No</th>
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







    <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>


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
                  <label for="actionname" class="col-sm-3 control-label">Action Name</label>
                  <div class="col-sm-8">
                    <textarea class="form-control" id="actionname" name="name" placeholder="Action Name" required ></textarea>
					 <input type="hidden" class="form-control" id="token" name="token" value="<?php echo $token;?>">
					 	<input type="hidden" class="form-control" id="idfeature" name="idfeature"   value="<?php echo $idfeature;?>">
                  </div>
                </div>			  

				 <div class="form-group">
                  <label for="actionname" class="col-sm-3 control-label">Type</label>
                  <div class="col-sm-8">
                    <select class="form-control" id="actiontype" name="type"> 
					<option value="positive">Positive Scenario</option>
					<option value="negative">Negative Scenario</option>
					</select>
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
	  
	  
	   <!-- modal add -->
	  <div class="modal fade" id="modal_edit">
          <div class="modal-dialog">
		  	<form class="form-horizontal" action="<?php echo base_url() ?>action/update" method="post">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Action</h4>
              </div>
              <div class="modal-body">
                <p>
				
                <div class="form-group">
                  <label for="actionname" class="col-sm-4 control-label">Action Name</label>
                  <div class="col-sm-8">
				   <input type="hidden" class="form-control" id="id1" name="id" placeholder="" required >
                      <textarea class="form-control" id="actionname1" name="name" placeholder="Action Name" required=""></textarea>

					 <input type="hidden" class="form-control" id="token" name="token" value="<?php echo $token;?>">
					 	 <input type="hidden" class="form-control" id="idfeature" name="idfeature"   value="<?php echo $idfeature;?>">
                  </div>
                </div>			  

				<div class="form-group">
                  <label for="actionname" class="col-sm-4 control-label">Type</label>
                  <div class="col-sm-8">
                    <select class="form-control" id="actiontype1" name="type"> 
					<option value="positive">Positive Scenario</option>
					<option value="negative">Negative Scenario</option>
					</select>
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

	  
	   <!-- modal add -->
	  <div class="modal fade" id="modal_AddCase">
          <div class="modal-dialog">
		  	<form class="form" role="form" action="<?php echo base_url() ?>listcase/save" method="post">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Case</span></h4>
              </div>
              <div class="modal-body">
                <p>
				
				 <div class="form-group">
                
				<h3>Action : <span id="actionname2"></span></h3>
				<input type="hidden" class="form-control" id="idaction2" name="idaction" placeholder="" required >
				<input type="hidden" id="token" name="token" value="<?php echo $token;?>">
				<input type="hidden" id="idfeature" name="idfeature"   value="<?php echo $idfeature;?>">
                 
			
                </div>	
				
                <div class="form-group">
                  <label>Case </label>
                  <textarea class="form-control" rows="2" name="case" placeholder="Type case ..." id="editor1"></textarea>
                </div>			  

				  <div class="form-group">
                  <label>Expectation </label>
                  <textarea class="form-control" rows="3" name="expectation" placeholder="Type Expectation ..." id="editor2"></textarea>
                </div>	
						
				<!-- radio -->
                <div class="form-group">
                  <div class="radio">
                    <label>
                      <input type="radio" name="type" id="optionsRadios1" value="Rule Test" checked>
                      Rule Test
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="type" id="optionsRadios2" value="Bug Test">
                     Bug Test
                    </label>
                  </div>
                </div>

				
				 <!-- checkbox -->
                <div class="form-group">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="important" value="important" checked>
                      Important
                    </label>
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
	  
	  

	    <!-- modal Edit -->
	  <div class="modal fade" id="modal_EditCase">
          <div class="modal-dialog">
		  	<form class="form" role="form" action="<?php echo base_url() ?>listcase/update" method="post">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Case   </span></h4>
              </div>
              <div class="modal-body">
                <p>
				
				 <div class="form-group">
				<h3>Action : <span id="actionname3"></span></h3>
				<input type="hidden" class="form-control" id="idcase" name="idcase" placeholder="" required >
				<input type="hidden" id="token3" name="token" value="<?php echo $token;?>">
				<input type="hidden" id="idfeature3" name="idfeature"   value="<?php echo $idfeature;?>">	
                </div>	
				
                <div class="form-group">
                  <label>Case </label>
                  <textarea class="form-control" rows="2" name="case" placeholder="Type case ..." id="editor3"></textarea>
             
				</div>			  

				  <div class="form-group">
                  <label>Expectation </label>
                  <textarea class="form-control" rows="3" name="expectation" placeholder="Type Expectation ..." id="editor4"></textarea>
                </div>	
						
				<!-- radio -->
                <div class="form-group">
                  <div class="radio">
                    <label>
                      <input type="radio" name="type" id="optionsRadios3" value="Rule Test" checked>
                      Rule Test
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="type" id="optionsRadios4" value="Bug Test">
                     Bug Test
                    </label>
                  </div>
                </div>

				
				 <!-- checkbox -->
                <div class="form-group">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="important" value="important" id="important3">
                      Important
                    </label>
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
	  function callModal(id,name,type)
	  {
		  	$('#modal_edit').modal('show');
			$('#id1').val(id);
	//	var type =	$('#actiontype1').val(type);
			$('#actionname1').val(name);
			if(type.toLowerCase()=="positif")
			{
			$( "#actiontype1" ).prop( "selected", true );
			}
	
			else if(type.toLowerCase()=="negatif")
			{
			$( "#actiontype1" ).prop("selected", true );
			}
			
	  }
	  
	  function callModal2(id,name)
	  {
		  	$('#modal_AddCase').modal('show');
			$('#idaction2').val(id);
			$('#actionname2').html(name);
	  }
	  
	    function callModal3(id,name,desc,expectation,type,important)
		{	
		/*$.ajax({
		type: "POST",
		dataType: 'json',
		url: "listcase/showcase",
		data:'idcase='+id,
		success: function(response){
			var data 	= JSON.parse(response);
			$("#editor3").val(data['case1_desc']);
			$("#editor4").val(data[1]);
			$("#optionsRadios3").val(data[2]);
			$("#optionsRadios4").val(data[2]);
			$("#important3").val(data[3]);
			$("#case_test").html(data['case1_desc']);
		},
		error:  function() {
			alert('error; ' + eval(error));
		}
		});	*/
		
			$('#modal_EditCase').modal('show');
			$('#idcase').val(id);
			$('#actionname3').html(name);
			CKEDITOR.instances.editor3.setData(desc);
			CKEDITOR.instances.editor4.setData(expectation);
			if(type.toLowerCase()=="rule test")
			{
			$( "#optionsRadios3" ).prop( "checked", true );
			$( "#optionsRadios4" ).prop( "checked", false );
			}
	
			else if(type.toLowerCase()=="bug test")
			{
			$( "#optionsRadios3" ).prop( "checked", false );
			$( "#optionsRadios4" ).prop( "checked", true );
			}
			
			if(important.toLowerCase()=="important")
			{
				$("#important3").prop( "checked", true );
			}
			else
			{
				$("#important3").prop( "checked", false );
			}
			
	  }
	     
	  function change_url()
	  {
		var feature_id	=  document.getElementById("feature_position").value; 
		var token		=  '<?php echo $this->uri->segment(4);?>';
		var base_url	=  '<?php echo base_url();?>action/manage/';
		 window.location=(base_url+feature_id+'/'+token);
		  //alert(base_url+feature_id+'/'+token);
	  }

      window.scrollTo(0,document.body.scrollHeight);
	  </script>


	  