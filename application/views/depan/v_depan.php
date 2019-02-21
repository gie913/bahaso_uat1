<div class="row">
        <div class="col-xs-12">
          <div class="box">
           <div class="box-header with-border">
              <h3 class="box-title">Table of Projects</h3>

              <div class="box-tools pull-right">
                <span data-toggle="tooltip" title="" class="badge bg-light-blue" data-original-title="3 New Messages">3</span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="Contacts">
                  <i class="fa fa-comments"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th> Project Name</th>
                  <th> Code</th>
                  <th> Platform</th>
                  <th> Version</th>
                  <th>View Feature</th>
                </tr>
                </thead>
                <tbody>
				 <?php
		   if($load_project->num_rows()>0)
		   {
			foreach($load_project->result_array() as $project){
		   ?> 
				
                <tr>
                  <td><?php echo $project['project1_name'] ?></td>
                  <td><?php echo $project['project1_code'] ?></td>
                  <td><?php echo $project['project1_platform'] ?></td>
                  <td> <?php echo $project['project1_version'] ?></td>
                  <td><a class="btn btn-info"> View </a> </td>
                </tr>
		<?php
		   }
		   }
		?>				
                </tbody>
                <tfoot>
                <tr>
                  <tr>
                  <th>Project Name</th>
                  <th>Project Code</th>
                  <th>Project Platform</th>
                  <th>Project Version</th>
                  <th>View Feature</th>
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