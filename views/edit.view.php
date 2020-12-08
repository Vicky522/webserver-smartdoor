

<h1>Edit</h1>

<h4>Device</h4>
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
                        <form action="/edit" method="POST"  class="col-12 justify-content-center">
                            <div asp-validation-summary="ModelOnly" class="text-danger"></div>
                            <input type="hidden" name="DeviceId"  value= <?php echo $device->device_id?> />
                            <input type="hidden" asp-for="CreatedBy" />
                            <input type="hidden" asp-for="ReadAPIKey" />
                            <input type="hidden" asp-for="WriteAPIKey" />
                            <div class="form-group row justify-content-center">
                                <label asp-for="Name" class="control-label col-4">Name</label>
                                <input name="Name" id="ChipId" class="form-control col-5" value= <?php echo $device->name?>>
                                <span asp-validation-for="Name" class="text-danger"></span>
                            </div> 
                            <div class="form-group row justify-content-center">
                                <label asp-for="ChipId" class="control-label col-4">Chip ID</label>
                                <input name="ChipId" id="ChipId" class="form-control col-5" value= <?php echo $device->chip_id?>>
                                <span asp-validation-for="ChipId" class="text-danger"></span>
                            </div>
                            <div class="form-group row justify-content-center">
                                <label asp-for="Description" class="control-label col-4">Description</label>
                                <input name="Description" id="Description" class="form-control col-5" value= <?php echo $device->description?>>
                                <span asp-validation-for="Description" class="text-danger"></span>
                            </div>

                            <div class="form-group row justify-content-center">
                                <input type="submit" value="Save" class="btn btn-primary btn-icon-split btn-lg  col-3 " />
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

