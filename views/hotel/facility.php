<div class="site-index my-5">
    <div class="container col-10">
        <div class="fs-3 text-center p-3 fw-bold"><?= Yii::t('app', 'Hotel Facility') ?></div>
        <div class="">
            <button id="addBtn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formAdd"><?= Yii::t('app', 'Add Facility') ?></button>
        </div>
        <table class="table table-bordered w-100 my-2 mb-5">
                <thead>
                    <tr class="text-center">
                        <th class="align-middle col-1">No</th>
                        <th class="align-middle"><?= Yii::t('app', 'Facility') ?></th>
                        <th class="align-middle col-1"></th>
                    </tr>
                </thead>
                <tbody id="facilityList">
                </tbody>
            </table>
        </div>
    </div>

    <form id="formAddFacility" class="needs-validation" novalidate>
        <div class="modal" id="formAdd" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?= Yii::t('app', 'Add New Facility') ?></h4>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="name" class="form-label "><?= Yii::t('app', 'Facility Name') ?></label>
                            <input type="text" class="form-control" required id="name" placeholder="<?= Yii::t('app', 'Enter Facility Name') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input facility name.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="cancelAddBtn">Cancel</button>
                        <button type="button" class="btn btn-primary" id="submitAddFacility"><?= Yii::t('app', 'Add Facility') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form id="formEditFacility" class="needs-validation" novalidate>
        <div class="modal" id="formEdit" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?= Yii::t('app', 'Edit Facility') ?></h4>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="nameEdit" class="form-label "><?= Yii::t('app', 'Facility Name') ?></label>
                            <input type="text" class="form-control" required id="nameEdit" placeholder="<?= Yii::t('app', 'Enter Facility Name') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input facility name.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-toggle='modal' data-bs-target='#deleteConfirmationModal' id="cancelAddBtn"><?= Yii::t('app', 'Delete') ?></button>
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal" id="cancelAddBtn">Cancel</button>
                        <button type="button" class="btn btn-primary" id="submitEditFacility"><?= Yii::t('app', 'Edit Facility') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="modal" id="deleteConfirmationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?= Yii::t('app', 'Delete Confirmation') ?></h4>
                </div>
                <div class="modal-body">
                    <p><?= Yii::t('app', 'Are You Sure ?') ?></p>
                    <p><?= Yii::t('app', "*Delete Process Will Begin After You Press 'Delete Facility' Button") ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="submitDelete"><?= Yii::t('app', 'Delete Facility') ?></button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="canceldeleteBtn">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal" id="editConfirmationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?= Yii::t('app', 'Edit Confirmation') ?></h4>
                </div>
                <div class="modal-body">
                    <p><?= Yii::t('app', 'Are You Sure ?') ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="submitEdit"><?= Yii::t('app', 'Edit') ?></button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function()
    {
        var facilityList = <?=$facilityList?>;
        var adminId = <?=$adminId?>;
        var selector = 0;

        for (let i = 0; i < facilityList.length; i++) 
        {
           $("#facilityList").append("\
                            <tr class=\"text-center\">\
                                <td class='align-middle'>" + (i+1) + "</td>\
                                <td class=\"align-middle text-break\">" + facilityList[i].NAME + "</td>\
                                <td class=\"align-middle\"><button type='button' class='editFacility btn btn-primary' data-bs-toggle='modal' data-bs-target='#formEdit' value=" + i + "><?= Yii::t('app', 'View') ?></button></td>\
                            <tr>")       
        }

        //Add Logic

            $("#submitAddFacility").on('click',function()
            {
                if ($("#name").val() == "" )
                {
                    $("#formAddFacility").addClass('was-validated')
                    alert('<?= Yii::t('app', 'All input must be filled!') ?>');
                } 
                else if ($("#name").val().length > 256 )
                {
                    alert('<?= Yii::t('app', 'Input too long! Max: 256 Character') ?>');
                }
                else
                {
                    var data = {
                        name : $("#name").val(),
                        adminId : adminId,
                    };
                    $.ajax({
                        type : 'POST',
                        data : data,
                        dataType : 'JSON',
                        url : '<?= Yii::$app->getUrlManager()->createUrl('hotel-facility/add-facility') ?>',
                        success : function(result)
                        {
                            if (result.errNum == 1)
                            {
                                alert("Error Code (" + result.errNum + ")  : " + result.errStr);
                            }
                            else
                            {
                                alert('<?= Yii::t('app', 'Facility Added') ?>');
                                location.reload();
                            }
                        }
                    });
                }
            });

        //Edit Logic

            $("#facilityList").on('click', '.editFacility', function()
            {
                temp = $(this).val();
                selector = temp;
                $("#nameEdit").val(facilityList[temp].NAME);
            });

            $("#submitEdit").on('click', function()
            {
                var data = {
                    id: facilityList[selector].ID,
                    name : $("#nameEdit").val(),
                    adminId : adminId,
                };
                $.ajax({
                    type : 'POST',
                    data : data,
                    dataType : 'JSON',
                    url : '<?= Yii::$app->getUrlManager()->createUrl('hotel-facility/edit-facility') ?>',
                    success : function(result)
                    {
                        if (result.errNum == 1)
                        {
                            alert("Error Code (" + result.errNum + ")  : " + result.errStr);
                        }
                        else
                        {
                            alert('<?= Yii::t('app', 'Facility Edited') ?>');
                            location.reload();
                        }
                    }
                });
            });
            
            $("#submitEditFacility").on('click', function()
            {
                if ($("#nameEdit").val() == "" )
                {
                    $("#formEditFacility").addClass('was-validated')
                    alert('<?= Yii::t('app', 'All input must be filled!') ?>');
                } 
                else if ($("#nameEdit").val().length > 256 )
                {
                    alert('<?= Yii::t('app', 'Input too long! Max: 256 Character') ?>');
                }
                else
                {
                    $("#formEdit").modal('toggle');
                    $("#editConfirmationModal").modal('toggle');
                    
                }
            });

        //Delete
            $("#submitDelete").on('click', function()
            {
                var data = {
                    id : facilityList[selector].ID,
                    adminId : adminId,
                };
                $.ajax({
                    type : 'POST',
                    data : data,
                    dataType : 'JSON',
                    url : '<?= Yii::$app->getUrlManager()->createUrl('hotel-facility/delete-facility') ?>',
                    success : function(result)
                    {
                        if (result.errNum == 0) 
                        {
                            alert("<?= Yii::t('app', 'Facility Deleted') ?>");
                            location.reload();
                        }
                        else
                        {
                            console.log(result);
                        }
                    }
                }) 
            });
    });
</script>