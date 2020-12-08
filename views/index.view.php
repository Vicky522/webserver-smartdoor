
<?php 

	$devices = $view['view_data']['devices'];
	$array = get_object_vars($devices[0]);
    $properties = array_keys($array);
  
?>
<div class="container-fluid">

    <div class="row">
        <div class="col-6">
            <h2 class="h3 mb-2 text-gray-800 text-info">Audit </h2>
        </div>
      
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>
                                <?php echo "ID" ?>
                            </th>  
                            <th>
                                <?php echo "Name" ?>
                            </th>
                            <th>
                                <?php echo "Timestamp" ?>
                            </th>
                          
                        
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($devices as $device) {  ?>
                            <tr>
                                <?php foreach($device as $name => $value) {
                                    if ( $value== NULL)
                                        continue;?>
                                    <td>
                                        <?php echo $value ?>
                                    </td>
                                <?php }?>
                                
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


    <script src="~/js/toatr.js"></script>
    <script src="~/js/demo/datatables-demo.js"></script>


