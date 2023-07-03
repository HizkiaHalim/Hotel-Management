<div class="site-index my-5">
    <div class="container col-10">
        <div class="fs-3 text-center p-3 fw-bold"><?= Yii::t('app', 'Payment Method') ?></div>
        <div class="">
            <button id="addBtn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formAdd"><?= Yii::t('app', 'Add Method') ?></button>
        </div>
        <table class="table table-bordered w-100 my-2 mb-5">
                <thead>
                    <tr class="text-center">
                        <th class="align-middle col-1">No</th>
                        <th class="align-middle "><?= Yii::t('app', 'Payment Method') ?></th>
                        <th class="align-middle col-1"></th>
                    </tr>
                </thead>
                <tbody id="methodList">
                </tbody>
            </table>
        </div>
    </div>

    <form id="formAddMethod" class="needs-validation" novalidate>
        <div class="modal" id="formAdd" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?= Yii::t('app', 'Add New Payment Method') ?></h4>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="name" class="form-label "><?= Yii::t('app', 'Name') ?></label>
                            <input type="text" class="form-control" required id="name" placeholder="<?= Yii::t('app', 'Enter Payment Method Name') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input payment method name.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="cancelAddBtn">Cancel</button>
                        <button type="button" class="btn btn-primary" id="submitAddMethod"><?= Yii::t('app', 'Add Payment Method') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form id="formEditMethod" class="needs-validation" novalidate>
        <div class="modal" id="formEdit" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?= Yii::t('app', 'Edit Payment Method') ?></h4>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="nameEdit" class="form-label "><?= Yii::t('app', 'Name') ?></label>
                            <input type="text" class="form-control" required id="nameEdit" placeholder="<?= Yii::t('app', 'Enter Payment Method Name') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input payment method name.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-toggle='modal' data-bs-target='#deleteConfirmationModal' id="cancelAddBtn"><?= Yii::t('app', 'Delete') ?></button>
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal" id="cancelAddBtn">Cancel</button>
                        <button type="button" class="btn btn-primary" id="submitEditMethod"><?= Yii::t('app', 'Edit Payment Method') ?></button>
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
                    <p><?= Yii::t('app', "*Delete Process Will Begin After You Press 'Delete Method' Button") ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="submitDelete"><?= Yii::t('app', 'Delete Method') ?></button>
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
        var paymethod = <?=$paymethod?>;
        var adminId = <?=$adminId?>;
        var selector = 0;

        for (let i = 0; i < paymethod.length; i++) 
        {
           $("#methodList").append("\
                            <tr class=\"text-center\">\
                                <td class='align-middle'>" + (i+1) + "</td>\
                                <td class=\"align-middle text-break\">" + paymethod[i].NAME + "</td>\
                                <td class=\"align-middle\"><button type='button' class='editMethod btn btn-primary' data-bs-toggle='modal' data-bs-target='#formEdit' value=" + i + "><?= Yii::t('app', 'View') ?></button></td>\
                            <tr>")       
        }

        $("#addBtn").on('click', function()
        {
            $("#name").val("")
        })

        //Add Logic

            $("#submitAddMethod").on('click',function()
            {
                if ($("#name").val() == "" )
                {
                    $("#formAddMethod").addClass('was-validated')
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
                        url : '<?= Yii::$app->getUrlManager()->createUrl('hotel-paymethod/add-paymethod') ?>',
                        success : function(result)
                        {
                            if (result.errNum == 1)
                            {
                                alert("Error Code (" + result.errNum + ")  : " + result.errStr);
                            }
                            else
                            {
                                alert('<?= Yii::t('app', 'Payment Method Added') ?>');
                                location.reload();
                            }
                        }
                    });
                }
            });

        //Edit Logic
            $("#methodList").on('click', '.editMethod', function()
            {
                temp = $(this).val();
                selector = temp;
                $("#nameEdit").val(paymethod[temp].NAME);
            });
            
            $("#submitEdit").on('click', function()
            {
                var data = {
                    id: paymethod[selector].ID,
                    name : $("#nameEdit").val(),
                    adminId : adminId,
                };
                $.ajax({
                    type : 'POST',
                    data : data,
                    dataType : 'JSON',
                    url : '<?= Yii::$app->getUrlManager()->createUrl('hotel-paymethod/edit-paymethod') ?>',
                    success : function(result)
                    {
                        if (result.errNum == 1)
                        {
                            alert("Error Code (" + result.errNum + ")  : " + result.errStr);
                        }
                        else
                        {
                            alert('<?= Yii::t('app', 'Payment Method Edited') ?>');
                            location.reload();
                        }
                    }
                });
            })

            $("#submitEditMethod").on('click', function()
            {
                if ($("#nameEdit").val() == "" )
                {
                    $("#formEditMethod").addClass('was-validated')
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
                    id : paymethod[selector].ID,
                    adminId : adminId,
                };
                $.ajax({
                    type : 'POST',
                    data : data,
                    dataType : 'JSON',
                    url : '<?= Yii::$app->getUrlManager()->createUrl('hotel-paymethod/delete-paymethod') ?>',
                    success : function(result)
                    {
                        if (result.errNum == 0) 
                        {
                            alert("<?= Yii::t('app', 'Payment Method Deleted') ?>");
                            location.reload();
                        }
                        else
                        {
                            console.log(result);
                        }
                    }
                }) 
            });
    })
</script>