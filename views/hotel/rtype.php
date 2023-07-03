<div class="site-index my-5">
    <div class="container col-10">
        <div class="fs-3 text-center p-3 fw-bold"><?= Yii::t('app', 'Hotel Room Type') ?></div>
        <div class="">
            <button id="addBtn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formAdd"><?= Yii::t('app', 'Add Room Type') ?></button>
        </div>
        <table class="table table-bordered w-100 my-2 mb-5">
                <thead>
                    <tr class="text-center">
                        <th class="align-middle col-1">No</th>
                        <th class="align-middle col-2"><?= Yii::t('app', 'Room Type') ?></th>
                        <th class="align-middle col-3"><?= Yii::t('app', 'Facility') ?></th>
                        <th class="align-middle col-1"></th>
                    </tr>
                </thead>
                <tbody id="rtypeList">
                </tbody>
            </table>
        </div>
    </div>

    <form id="formEditRtype" class="needs-validation" novalidate>
        <div class="modal" id="formEdit" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?= Yii::t('app', 'Edit Room Type') ?></h4>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="nameEdit" class="form-label "><?= Yii::t('app', 'Room Type Name') ?></label>
                            <input type="text" class="form-control" required id="nameEdit" placeholder="<?= Yii::t('app', 'Enter Room Type Name') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input room type name.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="pt-2">
                            <label for="facilityEdit" class="form-label "><?= Yii::t('app', 'Facility Selection') ?></label>
                            <select class="form-control facilitySelect" required id="facilityEdit" multiple>
                            </select>
                        </div>
                        <div class="form-check form-switch pt-2">
                            <input class="form-check-input" type="checkbox" id="inputToggleEdit">
                            <label class="form-check-label" for="inputToggleEdit"><?= Yii::t('app', 'Input Price') ?></label>
                        </div>
                        <div id="priceListEdit">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal"><?= Yii::t('app', 'Delete') ?></button>
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal" id="cancelEditBtn">Cancel</button>
                        <button type="button" class="btn btn-primary" id="submitEditRtype"><?= Yii::t('app', 'Edit') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form id="formAddRtype" class="needs-validation" novalidate>
        <div class="modal" id="formAdd" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?= Yii::t('app', 'Add New Room Type') ?></h4>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="name" class="form-label "><?= Yii::t('app', 'Room Type Name') ?></label>
                            <input type="text" class="form-control" required id="name" placeholder="<?= Yii::t('app', 'Enter Room Type Name') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input room type name.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="pt-2">
                            <label for="facilityAdd" class="form-label "><?= Yii::t('app', 'Facility Selection') ?></label>
                            <select class="form-control facilitySelect" required id="facilityAdd" multiple>
                            </select>
                        </div>
                        <div class="form-check form-switch pt-2">
                            <input class="form-check-input" type="checkbox" id="inputToggleAdd">
                            <label class="form-check-label" for="inputToggleAdd"><?= Yii::t('app', 'Input Price') ?></label>
                        </div>
                        <div id="priceList">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="cancelAddBtn">Cancel</button>
                        <button type="button" class="btn btn-primary" id="submitAddRtype"><?= Yii::t('app', 'Add') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="modal loading" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog loadingback">
            <div class="modal-content loadingback2">
                <div class="loader"></div>
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
</div>

<link rel="stylesheet" href="../css/virtual-select.min.css" />
<script src="../js/virtual-select.min.js"></script>

<script>
    $(function()
    {
        var adminId = <?=$adminId?>;
        var rtypeList = <?=$rtypeList?>;
        var facilityList = <?=$facilityList?>;
        var floorSelection, floorSelectionEdit, selectorView = 0, facilitySelection;

        for (let i = 0; i < rtypeList.length; i++) {
            $("#rtypeList").append("\
                        <tr class=\"text-center\">\
                            <td class=\"align-middle col-1\">" + ( i + 1 ) + "</td>\
                            <td class=\"align-middle col-2 text-break\">" + rtypeList[i].NAME + "</td>\
                            <td class=\"align-middle col-1 text-break\">" + (rtypeList[i].FACILITY_NAME == null ? "No Facility" : rtypeList[i].FACILITY_NAME) + "</td>\
                            <td class=\"align-middle col-1\"><button type='button' class='editRtype btn btn-primary' data-bs-toggle='modal' data-bs-target='#formEdit' value=" + i + ">View</button></td>\
                        </tr>\
            ");
            
        }

        for (let i = 0; i < facilityList.length; i++) {
            facilitySelection = facilitySelection + "<option id='" + facilityList[i].NAME + "Add' value='" + facilityList[i].ID + "," + facilityList[i].NAME + "'>" + facilityList[i].NAME + "</option>";
        }
        
        $("#facilityAdd").html(facilitySelection);
        $("#facilityEdit").html(facilitySelection);

        VirtualSelect.init({
            ele: '#facilityAdd',
        });
        VirtualSelect.init({
            ele: '#facilityEdit',
        });

    //hide show price input logic
        
        $("#inputToggleAdd").on('change', function()
        {
            if ($("#inputToggleAdd").is(':checked')) 
            {
                $("#priceList").show()
            }
            else
            {
                $("#priceList").hide()
            }
        });

        $("#inputToggleEdit").on('change', function()
        {
            if ($("#inputToggleEdit").is(':checked')) 
            {
                $("#priceListEdit").show()
            }
            else
            {
                $("#priceListEdit").hide()
            }
        });

    //only number logic

        $("#priceList").on("keypress", ":input[type='numeric']", function(e) 
        {
            var charCode = (e.which) ? e.which : event.keyCode    
            if (String.fromCharCode(charCode).match(/[^0-9]/g))  
            {
                return false;                        
            }  
        })

        $("#priceListEdit").on("keypress", ":input[type='numeric']", function(e) 
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
            $("#name").val("");
            $("#priceList").empty();
        });

    //select floor logic

        $("#name").on('input', function()
        {
            $("#priceList").empty()
            $("#priceList").append("\
                    <div class='border border-4 border-dark rounded mt-2 p-4'>\
                        <p class='fw-bold my-0'>" + $("#name").val() + "</p>\
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
                            <label for=\"extrabedPrice\" class=\"form-label \"><?= Yii::t('app', 'Extrabed Price') ?></label>\
                            <input type=\"numeric\" class=\"form-control\" required id=\"extrabedPrice\" placeholder=\"<?= Yii::t('app', 'Enter Room Extrabed Price') ?>\">\
                            <div class=\"invalid-feedback\"><?= Yii::t('app', 'Please input room extrabed price.') ?></div>\
                            <div class=\"valid-feedback\"></div>\
                        </div>\
                        <div class='pt-2'>\
                            <label for=\"breakfastPrice\" class=\"form-label \"><?= Yii::t('app', 'Breakfast Price') ?></label>\
                            <input type=\"numeric\" class=\"form-control\" required id=\"breakfastPrice\" placeholder=\"<?= Yii::t('app', 'Enter Room Breakfast Price') ?>\">\
                            <div class=\"invalid-feedback\"><?= Yii::t('app', 'Please input room breakfast price.') ?></div>\
                            <div class=\"valid-feedback\"></div>\
                        </div>\
                    </div>\
                    ")
            
            
            if ($("#inputToggleAdd").is(':checked')) 
            {
                $("#priceList").show()
            }
            else
            {
                $("#priceList").hide()
            }
        });


    //edit logic

        $("#rtypeList").on("click", ".editRtype", function()
        {
            $("#inputToggleEdit").removeAttr('checked')
            selector = $(this).val();
            selectorView = selector;
            $('#nameEdit').val(rtypeList[selector].NAME);
            if (rtypeList[selector].FACILITY_NAME != null) 
            {
                tempName = rtypeList[selector].FACILITY_NAME.split(",");
                tempId = rtypeList[selector].FACILITY_ID.split(",");
                valueSelect = [];
                for (let i = 0; i < tempName.length; i++) 
                {
                    valueSelect.push(tempId[i] + "," + tempName[i])  
                }
                document.querySelector('#facilityEdit').setValue(valueSelect)
            }
            else
            {
                document.querySelector('#facilityEdit').setValue("")
            }
            if (rtypeList[selectorView].REGULAR_PRICE != null) 
            {
                $("#inputToggleEdit").attr('checked', 'true')
                $("#priceListEdit").empty()
                $("#priceListEdit").append("\
                        <div class='border border-4 border-dark rounded mt-2 p-4'>\
                            <p class='fw-bold my-0'>" + $("#nameEdit").val() + "</p>\
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
                                <label for=\"extrabedPriceEdit\" class=\"form-label \"><?= Yii::t('app', 'Extrabed Price') ?></label>\
                                <input type=\"numeric\" class=\"form-control\" required id=\"extrabedPriceEdit\" placeholder=\"<?= Yii::t('app', 'Enter Room Extrabed Price') ?>\">\
                                <div class=\"invalid-feedback\"><?= Yii::t('app', 'Please input room extrabed price.') ?></div>\
                                <div class=\"valid-feedback\"></div>\
                            </div>\
                            <div class='pt-2'>\
                                <label for=\"breakfastPriceEdit\" class=\"form-label \"><?= Yii::t('app', 'Breakfast Price') ?></label>\
                                <input type=\"numeric\" class=\"form-control\" required id=\"breakfastPriceEdit\" placeholder=\"<?= Yii::t('app', 'Enter Room Breakfast Price') ?>\">\
                                <div class=\"invalid-feedback\"><?= Yii::t('app', 'Please input room breakfast price.') ?></div>\
                                <div class=\"valid-feedback\"></div>\
                            </div>\
                        </div>\
                        ")
                $("#normalPriceEdit").val(rtypeList[selectorView].REGULAR_PRICE);
                $("#holidayPriceEdit").val(rtypeList[selectorView].HOLIDAY_PRICE);
                $("#extrabedPriceEdit").val(rtypeList[selectorView].EXTRABED_PRICE);
                $("#breakfastPriceEdit").val(rtypeList[selectorView].BREAKFAST_PRICE);
            }
            
        });

        $("#submitEdit").on('click', function()
        {
            var facilityName = "", facilityId = "";
            arr = $("#facilityEdit").val()
            for (let i = 0; i < arr.length; i++) {
                temp = arr[i].split(',');
                facilityName = facilityName + temp[1];
                facilityId = facilityId + temp[0];
                if (i != arr.length-1) 
                {
                    facilityName = facilityName + ",";
                    facilityId = facilityId + ",";
                }
            }
            var data = {
                id:  rtypeList[selectorView].ID,
                name : $("#nameEdit").val(),
                facilityName : facilityName,
                facilityId : facilityId,
                adminId : adminId,
            };
            $.ajax({
                type : 'POST',
                data : data,
                dataType : 'JSON',
                url : '<?= Yii::$app->getUrlManager()->createUrl('hotel-rtype/edit-rtype') ?>',
                beforeSend : openLoadingEdit(),
                success : function(result)
                {
                    if (result.errNum == 0) 
                    {
                        if ($("#inputToggleEdit").is(':checked')) 
                        {
                            if (rtypeList[selectorView].PRICE_ID != null) 
                            {
                                var data = {
                                    id : rtypeList[selectorView].PRICE_ID,
                                    rtypeId : rtypeList[selectorView].ID,
                                    regularPrice : $("#normalPriceEdit").val(),
                                    holidayPrice : $("#holidayPriceEdit").val(),
                                    extrabedPrice : $("#extrabedPriceEdit").val(),
                                    breakfastPrice : $("#breakfastPriceEdit").val(),
                                    adminId : adminId,
                                };
                                $.ajax({
                                    type : 'POST',
                                    data : data,
                                    dataType : 'JSON',
                                    url : '<?= Yii::$app->getUrlManager()->createUrl('hotel-price/edit-price') ?>',
                                    success : function(result)
                                    {
                                        if (result.errNum == 1)
                                        {
                                            alert("Error Code (" + result.errNum + ")  : " + result.errStr);
                                        }
                                    }
                                });
                            }
                            else
                            {
                                var data = {
                                rtypeId : rtypeList[selectorView].ID,
                                regularPrice : $("#normalPriceEdit").val(),
                                holidayPrice : $("#holidayPriceEdit").val(),
                                extrabedPrice : $("#extrabedPriceEdit").val(),
                                breakfastPrice : $("#breakfastPriceEdit").val(),
                                adminId : adminId,
                                };
                                $.ajax({
                                    type : 'POST',
                                    data : data,
                                    dataType : 'JSON',
                                    url : '<?= Yii::$app->getUrlManager()->createUrl('hotel-price/add-price') ?>',
                                    success : function(result)
                                    {
                                        if (result.errNum == 1)
                                        {
                                            alert("Error Code (" + result.errNum + ")  : " + result.errStr);
                                        }
                                    }
                                });
                            }
                        }
                        $(".loading").modal('toggle');
                        alert("<?= Yii::t('app', 'Room Type Edited') ?>");
                        location.reload();
                    }
                    else if (result.errNum == 1)
                    {
                        alert("Error Code (" + result.errNum + ")  : " + result.errStr);
                        $(".loading").modal('toggle');
                        $("#formEdit").modal('toggle');
                    }
                }
            });
        });

        $("#submitEditRtype").on('click', function()
        {
            if ($("#nameEdit").val() == "")
            {
                $("#formEditRtype").addClass('was-validated')
                alert('<?= Yii::t('app', 'All input must be filled!') ?>');
            }
            else
            {
                flag = "go";
                if ($("#inputToggleEdit").is(':checked')) 
                {
                    if ($("#normalPriceEdit").val() == "" || $("#holidayPriceEdit").val() == "" || $("#extrabedPriceEdit").val() == "" || $("#breakfastPriceEdit").val() == "")
                    {
                        $("#formEditRtype").addClass('was-validated')
                        alert('<?= Yii::t('app', 'All price input must be filled!') ?>');
                        flag = "no";
                    }  
                }
                if (flag = "go") 
                {
                    $("#formEdit").modal('toggle')
                    $("#editConfirmationModal").modal('toggle')
                }
            }
        });

        $("#deleteBtn").on('click', function()
        {
            var data = {
                id:  rtypeList[selectorView].ID,
                adminId : adminId,
            };
            $.ajax({
                type : 'POST',
                data : data,
                dataType : 'JSON',
                url : '<?= Yii::$app->getUrlManager()->createUrl('hotel-rtype/delete-rtype') ?>',
                beforeSend : openLoadingDelete(),
                success : function(result)
                {
                    if (result.errNum == 0) 
                    {
                        if (rtypeList[selectorView].PRICE_ID != null) 
                        {
                            var data = {
                                id : rtypeList[selectorView].PRICE_ID,
                                adminId : adminId,
                            };
                            $.ajax({
                                type : 'POST',
                                data : data,
                                dataType : 'JSON',
                                url : '<?= Yii::$app->getUrlManager()->createUrl('hotel-price/delete-price') ?>',
                                success : function(result)
                                {
                                    if (result.errNum == 1)
                                    {
                                        alert("Error Code (" + result.errNum + ")  : " + result.errStr);
                                    }
                                }
                            });
                        }
                        $(".loading").modal('toggle');
                        alert("<?= Yii::t('app', 'Room Type Deleted') ?>");
                        location.reload();
                    }
                    else if (result.errNum == 1)
                    {
                        alert("Error Code (" + result.errNum + ")  : " + result.errStr);
                    }
                }
            });
        });

    //add rtype logic

        $("#submitAddRtype").on('click', function()
        {
            if ($("#name").val() == "") 
            {
                $("#formAddRtype").addClass('was-validated')
                alert('<?= Yii::t('app', 'All input must be filled!') ?>');
            }
            else
            {
                flag = "go";
                if ($("#inputToggleAdd").is(':checked')) 
                {
                    if ($("#normalPrice").val() == "" || $("#holidayPrice").val() == "" || $("#extrabedPrice").val() == "" || $("#breakfastPrice").val() == "")
                    {
                        $("#formAddRtype").addClass('was-validated')
                        alert('<?= Yii::t('app', 'All price input must be filled!') ?>');
                        flag = "no";
                    }  
                }
                if (flag == "go") 
                {
                    var facilityName = "", facilityId = "";
                    arr = $("#facilityAdd").val()
                    for (let i = 0; i < arr.length; i++) {
                        temp = arr[i].split(',');
                        facilityName = facilityName + temp[1];
                        facilityId = facilityId + temp[0];
                        if (i != arr.length-1) {
                            facilityName = facilityName + ",";
                            facilityId = facilityId + ",";
                        }
                    }
                    var data = {
                        name : $("#name").val(),
                        facilityName : facilityName,
                        facilityId : facilityId,
                        adminId : adminId,
                    };
                    $.ajax({
                        type : 'POST',
                        data : data,
                        dataType : 'JSON',
                        beforeSend : openLoadingSubmit(),
                        url : '<?= Yii::$app->getUrlManager()->createUrl('hotel-rtype/add-rtype') ?>',
                        success : function(result)
                        {
                            if (result.errNum == 0) 
                            {
                                if ($("#inputToggleAdd").is(':checked')) 
                                {
                                    var data = {
                                        rtypeId : result.outRtypeId,
                                        regularPrice : $("#normalPrice").val(),
                                        holidayPrice : $("#holidayPrice").val(),
                                        extrabedPrice : $("#extrabedPrice").val(),
                                        breakfastPrice : $("#breakfastPrice").val(),
                                        adminId : adminId,
                                    };
                                    $.ajax({
                                        type : 'POST',
                                        data : data,
                                        dataType : 'JSON',
                                        url : '<?= Yii::$app->getUrlManager()->createUrl('hotel-price/add-price') ?>',
                                        success : function(result)
                                        {
                                            if (result.errNum == 1)
                                            {
                                                alert("Error Code (" + result.errNum + ")  : " + result.errStr);
                                            }
                                        }
                                    });
                                }
                                $(".loading").modal('toggle');
                                alert("<?= Yii::t('app', 'Room Type Added') ?>");
                                location.reload();
                            }
                            else if (result.errNum == 1)
                            {
                                alert("Error Code (" + result.errNum + ")  : " + result.errStr);
                                $(".loading").modal('toggle');
                                $("#formAdd").modal('toggle');
                            }
                        }
                    });
                }
            }
        });

        function openLoadingEdit() 
        {
            $("#editConfirmationModal").toggle();
            $(".loading").modal('toggle');
        }

        function openLoadingDelete() 
        {
            $("#deleteConfirmationModal").toggle();
            $(".loading").modal('toggle');
        }

        function openLoadingSubmit() 
        {
            $("#formAdd").modal('toggle');
            $(".loading").modal('toggle');
        }

    })
</script>