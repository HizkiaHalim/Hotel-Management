<div class="site-index my-5">
    <div class="container col-10">
        <div class="fs-3 text-center p-3 fw-bold"><?= Yii::t('app', 'Meeting Room Price List') ?></div>
        <div class="">
            <button id="addBtn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formAdd"><?= Yii::t('app', 'Add Price') ?></button>
        </div>
        <table class="table table-bordered w-100 my-2 mb-5">
                <thead>
                    <tr class="text-center">
                        <th class="align-middle col-1">No</th>
                        <th class="align-middle col-1"><?= Yii::t('app', 'Room Type') ?></th>
                        <th class="align-middle col-2"><?= Yii::t('app', 'Normal Price') ?></th>
                        <th class="align-middle col-2"><?= Yii::t('app', 'Holiday Price') ?></th>
                        <th class="align-middle col-2"><?= Yii::t('app', 'Coffee Break Price') ?></th>
                        <th class="align-middle col-2"><?= Yii::t('app', 'Breakfast Price') ?></th>
                        <th class="align-middle col-2"><?= Yii::t('app', 'Lunch Price') ?></th>
                        <th class="align-middle col-2"><?= Yii::t('app', 'Dinner Price') ?></th>
                        <th class="align-middle col-1"></th>
                    </tr>
                </thead>
                <tbody id="priceList">
                </tbody>
            </table>
        </div>
    </div>

    <form id="formAddPrice" class="needs-validation" novalidate>
        <div class="modal" id="formAdd" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?= Yii::t('app', 'Add Price') ?></h4>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="priceAdd" class="form-label "><?= Yii::t('app', 'Room Type') ?></label>
                            <select name="floor" class="form-control " id="priceAdd" required>
                            </select>
                        </div>
                        <div id="priceListForm">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="cancelAddBtn">Cancel</button>
                        <button type="button" class="btn btn-primary" id="submitAddPrice"><?= Yii::t('app', 'Add') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form id="formEditPrice" class="needs-validation" novalidate>
        <div class="modal" id="formEdit" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?= Yii::t('app', 'Edit Price') ?></h4>
                    </div>
                    <div class="modal-body">
                        <div id="priceListEditForm">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal"><?= Yii::t('app', 'Delete') ?></button>
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal" id="cancelEditBtn">Cancel</button>
                        <button type="button" class="btn btn-primary" id="submitEditPrice"><?= Yii::t('app', 'Edit') ?></button>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="deleteBtn"><?= Yii::t('app', 'Delete') ?></button>
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
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="canceleditBtn">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="../css/virtual-select.min.css" />
<script src="../js/virtual-select.min.js"></script>

<script>
    $(function()
    {   
        var adminId = <?=$adminId?>;
        var rtypeList = <?=$rtypeList?>;
        var priceList = <?=$priceList?>;
        var rtypeSelection, rtypeSelectionAdd, selectorView = 0;

        console.log(rtypeList)

        for (let i = 0; i < priceList.length; i++) {
            $("#priceList").append("\
                        <tr class=\"text-center\">\
                            <td class=\"align-middle col-1\">" + ( i + 1 ) + "</td>\
                            <td class=\"align-middle col-1 text-break\">" + priceList[i].ROOM_TYPE + "</td>\
                            <td class=\"align-middle col-1 text-break\">" + priceList[i].REGULAR_PRICE + "</td>\
                            <td class=\"align-middle col-1 text-break\">" + priceList[i].HOLIDAY_PRICE + "</td>\
                            <td class=\"align-middle col-1 text-break\">" + priceList[i].BREAK_PRICE + "</td>\
                            <td class=\"align-middle col-1 text-break\">" + priceList[i].BREAKFAST_PRICE + "</td>\
                            <td class=\"align-middle col-1 text-break\">" + priceList[i].LUNCH_PRICE + "</td>\
                            <td class=\"align-middle col-1 text-break\">" + priceList[i].DINNER_PRICE + "</td>\
                            <td class=\"align-middle col-1\"><button type='button' class='editPrice btn btn-primary' data-bs-toggle='modal' data-bs-target='#formEdit' value=" + i + ">View</button></td>\
                        </tr>\
                    ");
            
        }

        for (let i = 0; i < rtypeList.length; i++) 
        {
            if (rtypeList[i].REGULAR_PRICE == null) {
                rtypeSelectionAdd = rtypeSelectionAdd + "<option id='" + rtypeList[i].ID + "Add' value='" + rtypeList[i].NAME + "'>" + rtypeList[i].NAME + "</option>";
            }
        }

        $("#priceAdd").html(rtypeSelectionAdd);

        VirtualSelect.init({
            ele: '#priceAdd',
        });


    //only number logic

        $("#priceListForm").on("keypress", ":input[type='numeric']", function(e) 
        {
            var charCode = (e.which) ? e.which : event.keyCode    
            if (String.fromCharCode(charCode).match(/[^0-9]/g))  
            {
                return false;                        
            }  
        })

        $("#priceListEditForm").on("keypress", ":input[type='numeric']", function(e) 
        {
            var charCode = (e.which) ? e.which : event.keyCode    
            if (String.fromCharCode(charCode).match(/[^0-9]/g))  
            {
                return false;                        
            }  
        })
        
    //clear logic

        $("#addBtn").on('click', function()
        {
            document.querySelector('#priceAdd').setValue("");
            $("#priceListForm").empty()
        });

    //add price logic

        $("#priceAdd").on('change', function()
        {
            $("#priceListForm").empty()
            if ($("#priceAdd").val().length > 0) {
                $("#priceListForm").append("\
                        <div class='border border-4 border-dark rounded mt-2 p-4'>\
                            <p class='fw-bold my-0'><?= Yii::t('app', 'Room Type') ?> : " + $("#priceAdd").val() + "</p>\
                            <div class='pt-2'>\
                                <label for=\"normalPrice\" class=\"form-label \"><?= Yii::t('app', 'Normal Price') ?></label>\
                                <input type=\"numeric\" class=\"form-control\" required id=\"normalPrice\" placeholder=\"<?= Yii::t('app', 'Enter Room Normal Price') ?>\">\
                                <div class=\"invalid-feedback\"><?= Yii::t('app', 'Please input room normal price.') ?></div>\
                                <div class=\"valid-feedback\"></div>\
                            </div>\
                            <div class='pt-2'>\
                                <label for=\"holidayPrice\" class=\"form-label \"><?= Yii::t('app', 'Holiday Price') ?></label>\
                                <input type=\"numeric\" class=\"form-control\" required id=\"holidayPrice\" placeholder=\"<?= Yii::t('app', 'Enter Room Holiday Price') ?>\">\
                                <div class=\"invalid-feedback\"><?= Yii::t('app', 'Please input room holiday price.') ?></div>\
                                <div class=\"valid-feedback\"></div>\
                            </div>\
                            <div class='pt-2'>\
                                <label for=\"breakPrice\" class=\"form-label \"><?= Yii::t('app', 'Coffee Break Price') ?></label>\
                                <input type=\"numeric\" class=\"form-control\" required id=\"breakPrice\" placeholder=\"<?= Yii::t('app', 'Enter Room Coffee Break Price') ?>\">\
                                <div class=\"invalid-feedback\"><?= Yii::t('app', 'Please input room coffee break price.') ?></div>\
                                <div class=\"valid-feedback\"></div>\
                            </div>\
                            <div class='pt-2'>\
                                <label for=\"breakfastPrice\" class=\"form-label \"><?= Yii::t('app', 'Breakfast Price') ?></label>\
                                <input type=\"numeric\" class=\"form-control\" required id=\"breakfastPrice\" placeholder=\"<?= Yii::t('app', 'Enter Room Breakfast Price') ?>\">\
                                <div class=\"invalid-feedback\"><?= Yii::t('app', 'Please input room breakfast price.') ?></div>\
                                <div class=\"valid-feedback\"></div>\
                            </div>\
                            <div class='pt-2'>\
                                <label for=\"lunchPrice\" class=\"form-label \"><?= Yii::t('app', 'Lunch Price') ?></label>\
                                <input type=\"numeric\" class=\"form-control\" required id=\"lunchPrice\" placeholder=\"<?= Yii::t('app', 'Enter Room Lunch Price') ?>\">\
                                <div class=\"invalid-feedback\"><?= Yii::t('app', 'Please input room lunch price.') ?></div>\
                                <div class=\"valid-feedback\"></div>\
                            </div>\
                            <div class='pt-2'>\
                                <label for=\"dinnerPrice\" class=\"form-label \"><?= Yii::t('app', 'Dinner Price') ?></label>\
                                <input type=\"numeric\" class=\"form-control\" required id=\"dinnerPrice\" placeholder=\"<?= Yii::t('app', 'Enter Room Dinner Price') ?>\">\
                                <div class=\"invalid-feedback\"><?= Yii::t('app', 'Please input room dinner price.') ?></div>\
                                <div class=\"valid-feedback\"></div>\
                            </div>\
                        </div>\
                        ")
            }
        });

        $("#submitAddPrice").on('click', function()
        {
            if ($("#priceAdd").val() == "")
            {
                alert('<?= Yii::t('app', 'Please select room type!') ?>');
            }
            else if ($("#normalPrice").val() == "" || $("#holidayPrice").val() == "" || $("#breakPrice").val() == "" || $("#breakfastPrice").val() == "" || $("#lunchPrice").val() == "" || $("#dinnerPrice").val() == "")
            {
                alert('<?= Yii::t('app', 'Please fill all the price input!') ?>');
            }
            else
            {
                tempId = 0;
                for (let i = 0; i < rtypeList.length; i++) 
                {
                    if (rtypeList[i].NAME == $("#priceAdd").val()) 
                    {
                        tempId = i;
                        break;
                    }                    
                }
                var data = {
                    rtypeId : rtypeList[tempId].ID,
                    regularPrice : $("#normalPrice").val(),
                    holidayPrice : $("#holidayPrice").val(),
                    breakPrice : $("#breakPrice").val(),
                    breakfastPrice : $("#breakfastPrice").val(),
                    lunchPrice : $("#lunchPrice").val(),
                    dinnerPrice : $("#dinnerPrice").val(),
                    adminId : adminId,
                };
                $.ajax({
                    type : 'POST',
                    data : data,
                    dataType : 'JSON',
                    url : '<?= Yii::$app->getUrlManager()->createUrl('meeting-price/add-price') ?>',
                    success : function(result)
                    {
                        if (result.errNum == 0) 
                        {
                            alert("<?= Yii::t('app', 'Room Price Added') ?>");
                            location.reload();
                        }
                        else if (result.errNum == 1)
                        {
                            alert("Error Code (" + result.errNum + ")  : " + result.errStr);
                        }
                    }
                });
            }
        });
      
    //edit price logic
        
        $("#priceList").on('click', ".editPrice", function()
        {
            $("#priceListEditForm").empty()
            selector = $(this).val();
            selectorView = selector;
            $("#priceListEditForm").append("\
                    <div class='border border-4 border-dark rounded mt-2 p-4'>\
                        <p class='fw-bold my-0'><?= Yii::t('app', 'Room Type') ?> : " + priceList[selectorView].ROOM_TYPE + "</p>\
                        <div class='pt-2'>\
                            <label for=\"normalPriceEdit\" class=\"form-label \"><?= Yii::t('app', 'Normal Price') ?></label>\
                            <input type=\"numeric\" class=\"form-control\" required id=\"normalPriceEdit\" placeholder=\"<?= Yii::t('app', 'Enter Room Normal Price') ?>\">\
                            <div class=\"invalid-feedback\"><?= Yii::t('app', 'Please input room normal price.') ?></div>\
                            <div class=\"valid-feedback\"></div>\
                        </div>\
                        <div class='pt-2'>\
                            <label for=\"holidayPriceEdit\" class=\"form-label \"><?= Yii::t('app', 'Holiday Price') ?></label>\
                            <input type=\"numeric\" class=\"form-control\" required id=\"holidayPriceEdit\" placeholder=\"<?= Yii::t('app', 'Enter Room Holiday Price') ?>\">\
                            <div class=\"invalid-feedback\"><?= Yii::t('app', 'Please input room holiday price.') ?></div>\
                            <div class=\"valid-feedback\"></div>\
                        </div>\
                        <div class='pt-2'>\
                            <label for=\"breakPriceEdit\" class=\"form-label \"><?= Yii::t('app', 'Coffee Break Price') ?></label>\
                            <input type=\"numeric\" class=\"form-control\" required id=\"breakPriceEdit\" placeholder=\"<?= Yii::t('app', 'Enter Room Coffee Break Price') ?>\">\
                            <div class=\"invalid-feedback\"><?= Yii::t('app', 'Please input room coffee break price.') ?></div>\
                            <div class=\"valid-feedback\"></div>\
                        </div>\
                        <div class='pt-2'>\
                            <label for=\"breakfastPriceEdit\" class=\"form-label \"><?= Yii::t('app', 'Breakfast Price') ?></label>\
                            <input type=\"numeric\" class=\"form-control\" required id=\"breakfastPriceEdit\" placeholder=\"<?= Yii::t('app', 'Enter Room Breakfast Price') ?>\">\
                            <div class=\"invalid-feedback\"><?= Yii::t('app', 'Please input room breakfast price.') ?></div>\
                            <div class=\"valid-feedback\"></div>\
                        </div>\
                        <div class='pt-2'>\
                            <label for=\"lunchPriceEdit\" class=\"form-label \"><?= Yii::t('app', 'Lunch Price') ?></label>\
                            <input type=\"numeric\" class=\"form-control\" required id=\"lunchPriceEdit\" placeholder=\"<?= Yii::t('app', 'Enter Room Lunch Price') ?>\">\
                            <div class=\"invalid-feedback\"><?= Yii::t('app', 'Please input room lunch price.') ?></div>\
                            <div class=\"valid-feedback\"></div>\
                        </div>\
                        <div class='pt-2'>\
                            <label for=\"dinnerPriceEdit\" class=\"form-label \"><?= Yii::t('app', 'Dinner Price') ?></label>\
                            <input type=\"numeric\" class=\"form-control\" required id=\"dinnerPriceEdit\" placeholder=\"<?= Yii::t('app', 'Enter Room Dinner Price') ?>\">\
                            <div class=\"invalid-feedback\"><?= Yii::t('app', 'Please input room dinner price.') ?></div>\
                            <div class=\"valid-feedback\"></div>\
                        </div>\
                    </div>\
                    ")
            $("#normalPriceEdit").val(priceList[selectorView].REGULAR_PRICE);
            $("#holidayPriceEdit").val(priceList[selectorView].HOLIDAY_PRICE);
            $("#breakPriceEdit").val(priceList[selectorView].BREAK_PRICE);
            $("#breakfastPriceEdit").val(priceList[selectorView].BREAKFAST_PRICE);
            $("#lunchPriceEdit").val(priceList[selectorView].LUNCH_PRICE);
            $("#dinnerPriceEdit").val(priceList[selectorView].DINNER_PRICE);
            
        });

        $("#submitEdit").on('click', function()
        {
            var data = {
                id : priceList[selectorView].ID,
                rtypeId : priceList[selectorView].RTYPE_ID,
                regularPrice : $("#normalPriceEdit").val(),
                holidayPrice : $("#holidayPriceEdit").val(),
                breakPrice : $("#breakPriceEdit").val(),
                breakfastPrice : $("#breakfastPriceEdit").val(),
                lunchPrice : $("#lunchPriceEdit").val(),
                dinnerPrice : $("#dinnerPriceEdit").val(),
                adminId : adminId,
            };
            
            $.ajax({
                type : 'POST',
                data : data,
                dataType : 'JSON',
                url : '<?= Yii::$app->getUrlManager()->createUrl('meeting-price/edit-price') ?>',
                success : function(result)
                {
                    if (result.errNum == 0) 
                    {
                        alert("<?= Yii::t('app', 'Price Edited') ?>");
                        location.reload();
                    }
                    else if (result.errNum == 1)
                    {
                        alert("Error Code (" + result.errNum + ")  : " + result.errStr);
                    }
                }
            });
        })

        $("#submitEditPrice").on('click', function()
        {
            if ($("#normalPriceEdit").val() == "" || $("#holidayPriceEdit").val() == "" || $("#breakPrice").val() == "" || $("#breakfastPrice").val() == "" || $("#lunchPrice").val() == "" || $("#dinnerPrice").val() == "")
            {
                alert('<?= Yii::t('app', 'Please fill all the price input!') ?>');
            }
            else
            {
                $("#formEdit").modal('toggle');
                $("#editConfirmationModal").modal('toggle');
            }
        })

        $("#deleteBtn").on('click', function()
        {
            var data = {
                id : priceList[selectorView].ID,
                adminId : adminId,
            };
            $.ajax({
                type : 'POST',
                data : data,
                dataType : 'JSON',
                url : '<?= Yii::$app->getUrlManager()->createUrl('meeting-price/delete-price') ?>',
                success : function(result)
                {
                    if (result.errNum == 1)
                    {
                        alert("Error Code (" + result.errNum + ")  : " + result.errStr);
                    }
                    else
                    {
                        alert("<?= Yii::t('app', 'Price Deleted') ?>");
                        location.reload();
                    }
                }
            });
        })
    })
</script>