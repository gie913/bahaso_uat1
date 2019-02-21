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
              <h3 class="box-title">Table of Users</h3>
				
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
                <table id="table-default"  class="table table-striped table-bordered">
                    <thead>
                    <th></th>
                    <th> Username </th>
                    <th> Name </th>
                    <th> Access </th>
                    <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($qdata->result_array() as $data){ ?>
                        <tr>
                            <td> </td>
                            <td><?php echo $data['mstadmin_username'] ?></td>
                            <td><?php echo $data['mstadmin_name'] ?></td>
                            <td><?php echo ($data['mstadmin_akses']==1)?"Admin":"User"; ?></td>
                            <td>
                                <button  data-id="<?php echo $data['mstadmin_id'] ?>" class="btn btn-info btn-xs btn_mdl_edit">Edit</button>
                                <a onclick="deleteConfirm('<?php echo site_url('users/do_delete/'.$data['mstadmin_id']) ?>')" class="btn btn-danger btn-xs">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
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
            <form class="form-horizontal" action="<?php echo base_url() ?>users/do_insert" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add users</h4>
                    </div>
                    <div class="modal-body">
                        <p>

                        <div class="form-group">
                            <label for="mstadmin_username" class="col-md-3 control-label">Username</label>
                            <div class="col-md-9">
                                <input type="text" name="mstadmin_username" required value="" class="form-control" id="mstadmin_username" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mstadmin_password" class="col-md-3 control-label">Password</label>
                            <div class="col-md-9">
                                <input type="password" name="mstadmin_password" required value="" class="form-control" id="mstadmin_password" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mstadmin_name" class="col-md-3 control-label">Name</label>
                            <div class="col-md-9">
                                <input type="text" name="mstadmin_name" value="" required class="form-control" id="mstadmin_name" />
                            </div>
                        </div>
                        <select name="mstadmin_akses" class="form-control" id="mstadmin_akses">
                            <option value="1">Admin</option>
                            <option value="2">User</option>
                        </select>

                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </form>
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <!-- modal Edit -->
    <div class="modal fade" id="modal_edit">
        <div class="modal-dialog">
            <form class="form-horizontal" action="<?php echo base_url() ?>users/do_update" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Edit users</h4>
                    </div>
                    <div class="modal-body">
                        <p>

                                <input type="hidden" name="mstadmin_id" value="" class="form-control" id="mstadmin_id2" />

                        <div class="form-group">
                            <label for="name" class="col-md-3 control-label">Username</label>
                            <div class="col-md-9">
                                <input type="text" name="mstadmin_username" value="" class="form-control" id="mstadmin_username2" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-3 control-label">Password</label>
                            <div class="col-md-9">
                                <input type="password" name="mstadmin_password"  value="" class="form-control" id="mstadmin_password2" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-3 control-label">Name</label>
                            <div class="col-md-9">
                                <input type="text" name="mstadmin_name" value="" class="form-control" id="mstadmin_name2" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-3 control-label">Access</label>
                            <div class="col-md-9">
                                <select name="mstadmin_akses" class="form-control" id="mstadmin_akses2">
                                    <option value="1">Admin</option>
                                    <option value="2">User</option>
                                </select>

                            </div>
                        </div>

                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </form>
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <!-- Delete Confirmation-->
    <div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Data yang dihapus tidak akan bisa dikembalikan.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a id="btn-delete" class="btn btn-danger" href="#">Delete</a>
                </div>
            </div>
        </div>
    </div>


    <script>
        function deleteConfirm(url){
            $('#btn-delete').attr('href', url);
            $('#modal_delete').modal();
        }

        $(function () {
            var t = $('#table-default').DataTable({
                "columnDefs": [ {
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                } ],
                "order": [[ 1, 'desc' ]]
            } );

            t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();

            $("#table-default").on("click", "button.btn_mdl_edit", function() {
                var id = $(this).attr("data-id");
                $('#id2').val(id);
                $.ajax({
                    type : 'POST',
                    url  : "<?php echo base_url()?>users/get_detail",
                    //data : data,
                    data : {id:id} ,
                    success : function(data)
                    {
                        var dt = JSON.parse(data);
                        $('#modal_edit').modal('show');
                        $('#mstadmin_id2').val( dt['data'][0]['mstadmin_id'] );
                        $('#mstadmin_username2').val( dt['data'][0]['mstadmin_username'] );
                        $('#mstadmin_password2').val();
                        $('#mstadmin_name2').val( dt['data'][0]['mstadmin_name'] );
                        $('#mstadmin_akses2').val( dt['data'][0]['mstadmin_akses'] );
                        /* kalo mau checked box
                         if((dt['data'][0]['is_ho'])==1) {
                             $('#is_ho2').prop('checked', true);
                         }
                         */

                        console.log(dt['data'])

                    }
                });

                return true;
            });

        });
    </script>
