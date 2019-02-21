<?php 

header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Cache-control: private");
header("Content-Type: application/vnd.ms-excel; name=’excel’");
$tgl=date('dmY');
header("Content-disposition:  attachment; filename=download_project_". $project_name. date('ymd').".xls");

echo "<h2>". $project_name ."</h2>";
echo "<h4>". $project_status ." (". round($avg,2) ."%) </h4>";
echo "<h5>";
$testers="";
if($project_tester->num_rows()>0)
		{	
			foreach($project_tester->result_array() as $tester)
			{
			$testers .= $tester['mstadmin_name'] ." (". $tester['result1_score'] ." %), ";
			}
		}
echo rtrim($testers,",");

echo "<table class='table table-bordered table-hover' border='1'>
                <thead>
                <tr style='background-color:yellow'>
				<th width='50px'> No</th>
                <th width='200px'> Feature</th>
				<th width='300px'> Actions</th>
				<th width='300px'> Type</th>
               <th width='300px'> Cases</th>
                <th width='500px'> Expectation</th>
				<th width='100px'> Type</th>
				<th width='50px'> Important</th>
				<th width='50px'> Status</th>
				<th width='100px'> Note</th>
				<th width='30px'> Comment</th>
				<th width='200px'> backlog</th>
				</tr>
                </thead>
                <tbody>";
		if($load_project_data->num_rows()>0)
		{	
		$no=1;
		foreach($load_project_data->result_array() as $data)
		{	
		
		$hasil = $this->m_main->show_result3($token,$data['case1_id']);
		$status="";		
				if($hasil->num_rows()>0)
				{
					$row = $hasil->result_array();
					if($row[0]['result_status']==1)
					{
						$status="<b>Accepted</a>";
					}
					else if($row[0]['result_status']==2)
					{
						$status="<b> Rejected</b>";
					}
					$note 	= $row[0]['result_note'];
				}	
				
				else
				{
					$status = "";
					$note="";
				}
			
            echo "    <tr>
			<td> ". $no ."</td>
			<td>". $data['feature1_name']." </td>
			<td>". $data['action1_type']." Case </td>
				<td>". $data['action1_name']."  </td>
				<td> ". $data['case1_desc']." </td>
				<td>". $data['case1_expectation']."  </td>
				<td>". $data['case1_type']."  </td>
				<td>". $data['case1_important']."  </td>
				<td> ". $status ."</td>
				<td>". $note ." </td>
				<td>".  $row[0]['result_comment'] ." </td>
				<td>".  $this->m_main->notes($data['case1_id']) ." </td>
					</tr>";
				
	
		$no++;
		}
		}
		
echo "        </tbody>
              
              </table>";

	