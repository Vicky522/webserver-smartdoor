

<h2 class="h3 mb-2 text-gray-800 text-info">Details of device </h2>
<hr />
<?php $device =  $view['view_data']['device'] ?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow mb-4  ">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"></h6>
                </div>
                <div class="card-body">
                    <div class="row ">
                        <form action="/detail" class="col-12 justify-content-center">
                            
                            <div class="form-group row justify-content-center">
                                <label asp-for="Name" class="control-label col-4">Name</label>
                                <input asp-for="Name" class="form-control col-5" readonly  value= <?php echo $device->name?>>
                                <span asp-validation-for="Name" class="text-danger"></span>
                            </div>
                            <div class="form-group row justify-content-center">
                                <label asp-for="ChipId" class="control-label col-4">Chip Id</label>
                                <input asp-for="ChipId" class="form-control col-5" readonly value= <?php echo $device->chip_id?>>
                                <span asp-validation-for="ChipId" class="text-danger"></span>
                            </div>
                            <div class="form-group row justify-content-center">
                                <label asp-for="Description" class="control-label col-4">Description</label>
                                <input asp-for="Description" class="form-control col-5" readonly value= <?php echo $device->description?>>
                                <span asp-validation-for="Description" class="text-danger"></span>
                            </div>
 

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div>
    <a asp-action="Index">Back to List</a>
</div>

