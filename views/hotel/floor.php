<div class="site-index my-5">
    <div class="container col-10">
        <div class="fs-3 text-center p-3 fw-bold"><?= Yii::t('app', 'Hotel Floor') ?></div>
        <div class="">
            <button id="addBtn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formAdd"><?= Yii::t('app', 'Add Floor') ?></button>
        </div>
        <table class="table table-bordered w-100 my-2 mb-5">
                <thead>
                    <tr class="text-center">
                        <th class="align-middle col-1">No</th>
                        <th class="align-middle col-3"><?= Yii::t('app', 'Floor Name') ?></th>
                        <th class="align-middle col-3"><?= Yii::t('app', 'Room Quantity') ?></th>
                        <th class="align-middle col-3"><?= Yii::t('app', 'Room Available') ?></th>
                        <th class="align-middle col-1"></th>
                    </tr>
                </thead>
                <tbody id="floorList">
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal loading" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog loadingback">
            <div class="modal-content loadingback2">
                <div class="loader"></div>
            </div>
        </div>
    </div> 

    <form id="formAddFloor" class="needs-validation" novalidate>
        <div class="modal" id="formAdd" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?= Yii::t('app', 'Add New Floor') ?></h4>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="name" class="form-label "><?= Yii::t('app', 'Floor Name') ?></label>
                            <input type="text" class="form-control" required id="name" placeholder="<?= Yii::t('app', 'Enter Floor Name') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input floor name.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                        <div>
                            <label for="level" class="form-label pt-3"><?= Yii::t('app', 'Floor Level') ?></label>
                            <input type="numeric" class="form-control" required id="level" placeholder="<?= Yii::t('app', 'Enter Floor Level') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input floor level.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                        <div>
                            <label for="roomTypeSelection" class="form-label pt-3"><?= Yii::t('app', 'Room Type Selection') ?></label>
                            <select class="form-control rtypeSelection" multiple id="roomTypeSelection" ></select>
                        </div>
                        <div>
                            <label for="row" class="form-label pt-3"><?= Yii::t('app', 'Room Quantity (Row)') ?></label>
                            <input type="numeric" class="form-control" required id="row" placeholder="<?= Yii::t('app', 'Enter Room Quantity (Row)') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input the number of rooms in one row.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                        <div>
                            <label for="column" class="form-label pt-3"><?= Yii::t('app', 'Room Quantity (Column)') ?></label>
                            <input type="numeric" class="form-control" required id="column" placeholder="<?= Yii::t('app', 'Enter Room Quantity (Column)') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input the number of rooms in one column.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                        <div id="maxQty" class="pt-2"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="cancelAddBtn">Cancel</button>
                        <button type="button" class="btn btn-primary" id="submitAddFloor"><?= Yii::t('app', 'Add Floor') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form id="formEditFloor" class="needs-validation" novalidate>
        <div class="modal edit" id="formEdit" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?= Yii::t('app', 'Edit Floor') ?></h4>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="nameEdit" class="form-label "><?= Yii::t('app', 'Floor Name') ?></label>
                            <input type="text" class="form-control" required id="nameEdit" placeholder="<?= Yii::t('app', 'Enter Floor Name') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input floor name.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                        <div>
                            <label for="levelEdit" class="form-label pt-3"><?= Yii::t('app', 'Floor Level') ?></label>
                            <input type="numeric" class="form-control" required id="levelEdit" placeholder="<?= Yii::t('app', 'Enter Floor Level') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input floor level.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                        <div>
                            <label for="roomTypeSelectionEdit" class="form-label pt-3"><?= Yii::t('app', 'Room Type Selection') ?></label>
                            <select class="form-control rtypeSelectionEdit" required multiple id="roomTypeSelectionEdit" ></select>
                        </div>
                        <div>
                            <label for="rowEdit" class="form-label pt-3"><?= Yii::t('app', 'Room Quantity (Row)') ?></label>
                            <input type="numeric" class="form-control" required id="rowEdit" placeholder="<?= Yii::t('app', 'Enter Room Quantity (Row)') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input the number of rooms in one row.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                        <div>
                            <label for="columnEdit" class="form-label pt-3"><?= Yii::t('app', 'Room Quantity (Column)') ?></label>
                            <input type="numeric" class="form-control" required id="columnEdit" placeholder="<?= Yii::t('app', 'Enter Room Quantity (Column)') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input the number of rooms in one column.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="pt-2"> <?= Yii::t('app', 'Floor Map') ?></div>
                        <div id="floorMap" class="border border-4 border-dark rounded mt-2"></div>
                        <div class="pt-2"><?= Yii::t('app', 'Room Asignment') ?></div>
                        <div id="roomAssign"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal"><?= Yii::t('app', 'Delete') ?></button>
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal" id="cancelAddBtn">Cancel</button>
                        <button type="button" class="btn btn-primary" id="submitEditFloor"><?= Yii::t('app', 'Edit Floor') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </form>

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
                    <button type="button" class="btn btn-danger" id="submitDelete"><?= Yii::t('app', 'Delete') ?></button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="canceldeleteBtn">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function()
    {
        var adminId = <?=$adminId?>;
        var floorListRoom = <?=$floorListRoom?>;
        var floorListAll = <?=$floorListAll?>;
        var rtypeList = <?=$rtypeList?>;
        var selectorView, selectorRoom, rtypeSelection, allrtype, selectorFloorList;
        console.log(floorListRoom)
        console.log(floorListAll)

    //setup rtype selection
        for (let i = 0; i < rtypeList.length; i++) {
            allrtype = allrtype + "<option value='" + rtypeList[i].NAME + "," + rtypeList[i].ID + "'>" + rtypeList[i].NAME + "</option>";
        }
        $("#roomTypeSelection").html(allrtype);
        VirtualSelect.init({
            ele: '#roomTypeSelection',
        });
        $("#roomTypeSelectionEdit").html(allrtype);
        VirtualSelect.init({
            ele: '#roomTypeSelectionEdit',
        });
        document.querySelector('#roomTypeSelection').setValue("")

    //setup list
        for (let i = 0; i < floorListAll.length; i++) 
        {
            avbQty = 0;
            if (floorListRoom[i] != undefined) 
            {
                statusR = floorListRoom[i].ROOM_STATUS.split(',');
                for (let j = 0; j < statusR.length; j++) 
                {
                    if (statusR[j] == 'available') 
                    {
                        avbQty++;
                    }
                    
                }
            }
            $("#floorList").append("\
                        <tr class=\"text-center\">\
                            <td class=\"align-middle col-1\">" + ( i + 1 ) + "</td>\
                            <td class=\"align-middle col-3 text-break\">" + floorListAll[i].NAME + "</td>\
                            <td class=\"align-middle col-3 text-break\">" + floorListAll[i].QTY + "</td>\
                            <td class=\"align-middle col-3 text-break\">" + avbQty + "</td>\
                            <td class=\"align-middle col-1\"><button type='button' class='editFloor btn btn-primary' data-bs-toggle='modal' data-bs-target='#formEdit' value=" + i + "><?= Yii::t('app', 'View') ?></button></td>\
                        </tr>\
            ");
            
        }  

    // reset logic
        
        $("#addBtn").on('click', function()
        {
            $("#name").val("");
            $("#level").val("");
            $("#column").val("");
            document.querySelector('#roomTypeSelection').setValue("");
            $("#row").val("");
            $("#maxQty").html("");
        });

    // number only

        $(":input[type='numeric']").keypress("click",function(e) 
        {    
            var charCode = (e.which) ? e.which : event.keyCode    
            if (String.fromCharCode(charCode).match(/[^0-9]/g))  
            {
                return false;                        
            }
        }); 

    // max qty logic
        
        $("#column").on("input",function() 
        {
            if ($("#row").val() != "") 
            {
                $("#maxQty").html("Max Qty : " + ( parseInt($("#column").val()) * parseInt($("#row").val()) )) 
            }
        })

        $("#row").on("input",function() 
        {
            if ($("#column").val() != "") 
            {
                $("#maxQty").html("Max Qty : " + ( parseInt($("#column").val()) * parseInt($("#row").val()) )) 
            }
        })

    // add logic

        $("#addBtn").on("click", function()
        {
            if (rtypeList.length < 1) 
            {
                alert("<?= Yii::t('app', 'No Room Type Available') ?>");
                $("#formAdd").modal('toggle');
            }
            $("#formAddFloor").removeClass('was-validated');
        });

        $("#submitAddFloor").on("click", function()
        {
            if ($("#name").val() == "" || $("#level").val() == "" || $("#row").val() == "" || $("#column").val() == "" || $("#roomTypeSelection").val().length < 1) 
            {
                $("#formAddFloor").addClass('was-validated');
                alert('<?= Yii::t('app', 'All input must be filled!') ?>');
            } 
            else if ($("#name").val().length > 256 ) 
            {
                alert('<?= Yii::t('app', 'Input too long! Max: 256 Char') ?>');
            }
            else
            {
                temp = $("#roomTypeSelection").val();
                rtypeIdArr = "", rtypeNameArr = "";
                for (let i = 0; i < temp.length; i++) 
                {
                    temprtype = temp[i].split(',');
                    rtypeIdArr = rtypeIdArr + temprtype[1];
                    rtypeNameArr = rtypeNameArr + temprtype[0];
                    if (i != temp.length-1) 
                    {
                        rtypeIdArr = rtypeIdArr + ",";
                        rtypeNameArr = rtypeNameArr + ",";
                    }
                }
                var data = {
                    name : $("#name").val(),
                    level : $("#level").val(),
                    row : $("#row").val(),
                    rtypeIdArr : rtypeIdArr,
                    rtypeNameArr : rtypeNameArr,
                    column : $("#column").val(),
                    qty : 0,
                    adminId : adminId,
                };
                $.ajax({
                    type : 'POST',
                    data : data,
                    dataType : 'JSON',
                    url : '<?= Yii::$app->getUrlManager()->createUrl('hotel-floor/add-floor') ?>',
                    success : function(result)
                    {
                        if (result.errNum == 0) 
                        {
                            alert("<?= Yii::t('app', 'Floor Added') ?>");
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

    // edit logic
        
        $("#floorList").on("click", '.editFloor', function()
        {
            selector = $(this).val();
            selectorFloorList = selector;
            rtypeIdSelectedFloor = floorListAll[selector].RTYPE_ID.split(",");
            rtypeNameSelectedFloor = floorListAll[selector].RTYPE_NAME.split(",");
            rtypeSelectedFloor = [];
            for (let i = 0; i < rtypeIdSelectedFloor.length; i++) 
            {
                rtypeSelectedFloor.push(rtypeNameSelectedFloor[i] + "," + rtypeIdSelectedFloor[i]);
            }
            document.querySelector("#roomTypeSelectionEdit").setValue(rtypeSelectedFloor)
            
            if (floorListAll[selector].RTYPE_NAME != null) 
            {       
                selectorView = selector;
                $("#nameEdit").val(floorListAll[selector].NAME) ;
                $("#levelEdit").val(floorListAll[selector].FLOOR_LEVEL) ;
                $("#rowEdit").val(floorListAll[selector].FLOOR_ROW) ;
                $("#columnEdit").val(floorListAll[selector].FLOOR_COLUMN) ;
                
                //setup map
                    floorMapHtml = "";
                    roomList = "";
                    counter = 1;
                    for (let i = 0; i < floorListAll[selector].FLOOR_ROW; i++) {
                        temp = "";
                        for (let j = 0; j < floorListAll[selector].FLOOR_COLUMN; j++) {
                            temp = temp + "<div id='roomBox'> <?= Yii::t('app', 'Room') ?> " + counter + "</div>"
                            counter++;                    
                        }
                        if ($("#columnEdit").val() > 4) 
                        {
                            floorMapHtml = floorMapHtml + "<div>" + temp + "</div>";
                        }
                        else
                        {
                            floorMapHtml = floorMapHtml + "<div id='row'>" + temp + "</div>";
                        }
                    }
                    $("#floorMap").html(floorMapHtml);
                
                // rtype selection
                    rtypeSelection = "";
                    availRtype = floorListAll[selector].RTYPE_NAME.split(',');
                    availRtypeId = floorListAll[selector].RTYPE_ID.split(',');
                    for (let i = 0; i < availRtype.length; i++) 
                    {
                        rtypeSelection = rtypeSelection + "<option value='" + availRtype[i] + "," + availRtypeId[i] + "'>" + availRtype[i] + "</option>";
                    }

                // set input
                    totalQty = counter-1;
                    $("#roomAssign").empty();
                    for (let i = 0; i < totalQty; i++) 
                    {
                        $("#roomAssign").append("\
                                    <div class=\"py-2 border border-4 border-dark rounded mt-2 px-3\">\
                                        <p class=\"p-0\"><?= Yii::t('app', 'Room') ?> " + (i+1) + "</p>\
                                        <div>\
                                            <label for=\"roomName" + (i+1) + "\" class=\"form-label\"><?= Yii::t('app', 'Room Name') ?></label>\
                                            <input type=\"numeric\" class=\"form-control\" required id=\"roomName" + (i+1) + "\" placeholder=\"<?= Yii::t('app', 'Enter Room Name') ?>\">\
                                            <div class=\"invalid-feedback\"><?= Yii::t('app', 'Please input room name.') ?></div>\
                                            <div class=\"valid-feedback\"></div>\
                                        </div>\
                                        <div class=\"pt-2\">\
                                            <label for=\"roomType" + (i+1) + "\" class=\"form-label \"><?= Yii::t('app', 'Room Type Selection') ?></label>\
                                            <select name=\"roomType\" class=\"form-control roomSelect\" required id=\"roomType" + (i+1) + "\">\
                                            </select>\
                                        </div>\
                                    </div>")
                        $("#roomType" + (i+1)).html(rtypeSelection);
                        VirtualSelect.init({
                            ele: '#roomType' + (i+1),
                        });
                        if (floorListRoom[selector] != undefined) 
                        {
                            rname = floorListRoom[selector].ROOM.split(',');
                            rtype = floorListRoom[selector].RTYPE_SELECT.split(',');
                            rtype_id = floorListRoom[selector].RTYPE_SELECT_ID.split(',');
                            document.querySelector('#roomType' + (i+1)).setValue(rtype[i] + "," + rtype_id[i] );
                            $("#roomName"+(i+1)).val(rname[i])
                        }
                        else
                        {
                            document.querySelector('#roomType' + (i+1)).setValue("");
                            $("#roomName"+(i+1)).val("") 
                        }
                    }
            } 
            else 
            {
                $(".edit").modal('toggle');
                alert('<?= Yii::t('app', 'Please choose room type for this floor first!') ?>');
            }
            
        });

        $("#columnEdit").on("input", function() 
        {
            if ($("#rowEdit").val() != "") 
            {
                //setup map
                    floorMapHtml = "";
                    $("#floorMap").html(floorMapHtml)
                    counter = 1;
                    for (let i = 0; i < $("#rowEdit").val(); i++) 
                    {
                        temp = "";
                        for (let j = 0; j < $("#columnEdit").val(); j++) 
                        {
                            temp = temp + "<div id='roomBox'> Room " + counter + "</div>"
                            counter++;                    
                        }
                        if ($("#columnEdit").val() > 4) 
                        {
                            floorMapHtml = floorMapHtml + "<div>" + temp + "</div>";
                        }
                        else
                        {
                            floorMapHtml = floorMapHtml + "<div id='row'>" + temp + "</div>";
                        }
                    }
                    $("#floorMap").html(floorMapHtml)

                // rtype selection
                    rtypeSelection = "";
                    availRtype = floorListAll[selectorFloorList].RTYPE_NAME.split(',');
                    availRtypeId = floorListAll[selectorFloorList].RTYPE_ID.split(',');
                    for (let i = 0; i < availRtype.length; i++) {
                        rtypeSelection = rtypeSelection + "<option value='" + availRtype[i] + "," + availRtypeId[i] + "'>" + availRtype[i] + "</option>";
                    }

                // set input
                    totalQty = counter-1;
                    $("#roomAssign").empty();
                    for (let i = 0; i < totalQty; i++) {
                        $("#roomAssign").append("\
                                    <div class=\"py-2 border border-4 border-dark rounded mt-2 px-3\">\
                                        <p class=\"p-0\"><?= Yii::t('app', 'Room') ?> " + (i+1) + "</p>\
                                        <div>\
                                            <label for=\"roomName" + (i+1) + "\" class=\"form-label\"><?= Yii::t('app', 'Room Name') ?></label>\
                                            <input type=\"numeric\" class=\"form-control\" required id=\"roomName" + (i+1) + "\" placeholder=\"<?= Yii::t('app', 'Enter Room Name') ?>\">\
                                            <div class=\"invalid-feedback\"><?= Yii::t('app', 'Please input room name.') ?></div>\
                                            <div class=\"valid-feedback\"></div>\
                                        </div>\
                                        <div class=\"pt-2\">\
                                            <label for=\"roomType" + (i+1) + "\" class=\"form-label \"><?= Yii::t('app', 'Room Type Selection') ?></label>\
                                            <select name=\"roomType\" class=\"form-control roomSelect\" id=\"roomType" + (i+1) + "\">\
                                            </select>\
                                        </div>\
                                    </div>")
                        $("#roomType" + (i+1)).html(rtypeSelection);
                            VirtualSelect.init({
                            ele: '#roomType' + (i+1),
                        });
                        if (floorListAll[selector].ROOM != null) 
                        {
                            console.log('room')
                            rname = floorListAll[selector].ROOM.split(',');
                            rtype = floorListAll[selector].RTYPE_SELECT.split(',');
                            rtype_id = floorListAll[selector].RTYPE_SELECT_ID.split(',');
                            document.querySelector('#roomType' + (i+1)).setValue(rtype[i] + "," + rtype_id[i] );
                            $("#roomName"+(i+1)).val(rname[i])
                        }
                        else
                        {
                            document.querySelector('#roomType' + (i+1)).setValue("");
                            $("#roomName"+(i+1)).val("") 
                        }
                    }
            }
        });

        $("#rowEdit").on("input", function() 
        {
            if ($("#columnEdit").val() != "") 
            {
                //setup map
                    floorMapHtml = "";
                    $("#floorMap").html(floorMapHtml)
                    counter = 1;
                    for (let i = 0; i < $("#rowEdit").val() ; i++) {
                        temp = "";
                        for (let j = 0; j < $("#columnEdit").val(); j++) {
                            temp = temp + "<div id='roomBox'> Room " + counter + "</div>"
                            counter++;                    
                        }
                        if ($("#columnEdit").val() > 4) 
                        {
                            floorMapHtml = floorMapHtml + "<div>" + temp + "</div>";
                        }
                        else
                        {
                            floorMapHtml = floorMapHtml + "<div id='row'>" + temp + "</div>";
                        }
                    }
                    $("#floorMap").html(floorMapHtml)

                // rtype selection
                    rtypeSelection = "";
                    availRtype = floorListAll[selectorFloorList].RTYPE_NAME.split(',');
                    availRtypeId = floorListAll[selectorFloorList].RTYPE_ID.split(',');
                    for (let i = 0; i < availRtype.length; i++) {
                        rtypeSelection = rtypeSelection + "<option value='" + availRtype[i] + "," + availRtypeId[i] + "'>" + availRtype[i] + "</option>";
                    }

                // set input
                    totalQty = counter-1;
                    $("#roomAssign").empty();
                    for (let i = 0; i < totalQty; i++) {
                        $("#roomAssign").append("\
                                    <div class=\"py-2 border border-4 border-dark rounded mt-2 px-3\">\
                                        <p class=\"p-0\"><?= Yii::t('app', 'Room') ?> " + (i+1) + "</p>\
                                        <div>\
                                            <label for=\"roomName" + (i+1) + "\" class=\"form-label\"><?= Yii::t('app', 'Room Name') ?></label>\
                                            <input type=\"numeric\" class=\"form-control\" required id=\"roomName" + (i+1) + "\" placeholder=\"<?= Yii::t('app', 'Enter Room Name') ?>\">\
                                            <div class=\"invalid-feedback\"><?= Yii::t('app', 'Please input room name.') ?></div>\
                                            <div class=\"valid-feedback\"></div>\
                                        </div>\
                                        <div class=\"pt-2\">\
                                            <label for=\"roomType" + (i+1) + "\" class=\"form-label \"><?= Yii::t('app', 'Room Type Selection') ?></label>\
                                            <select name=\"roomType\" class=\"form-control roomSelect\" id=\"roomType" + (i+1) + "\">\
                                            </select>\
                                        </div>\
                                    </div>")
                        $("#roomType" + (i+1)).html(rtypeSelection);
                            VirtualSelect.init({
                            ele: '#roomType' + (i+1),
                        });
                        if (floorListAll[selector].ROOM != null) 
                        {
                            rname = floorListAll[selector].ROOM.split(',');
                            rtype = floorListAll[selector].RTYPE_SELECT.split(',');
                            rtype_id = floorListAll[selector].RTYPE_SELECT_ID.split(',');
                            document.querySelector('#roomType' + (i+1)).setValue(rtype[i] + "," + rtype_id[i] );
                            $("#roomName"+(i+1)).val(rname[i])
                        }
                        else
                        {
                            document.querySelector('#roomType' + (i+1)).setValue("");
                            $("#roomName"+(i+1)).val("") 
                        }
                    }
            }
        });

        $("#submitEditFloor").on("click",function()
        {
            if ($("#nameEdit").val() == "" || $("#levelEdit").val() == "" || $("#rowEdit").val() == "" || $("#columnEdit").val() == "" || $("#roomTypeSelectionEdit").val().length < 1) 
            {
                $("#formEditFloor").addClass('was-validated')
                alert('<?= Yii::t('app', 'All input must be filled!') ?>');
            } 
            else if ($("#nameEdit").val().length > 256 ) 
            {
                alert('<?= Yii::t('app', 'Input too long! Max: 256 Char') ?>');
            }
            else
            {
                EditFloor();
            }
        });

        $("#submitDelete").on("click", function()
        {
            $("#deleteConfirmationModal").modal('toggle');
            $(".loading").modal('toggle');
            flag = "go";
            flagger = 0;
            availStatus = [];
            if (floorListAll[selectorFloorList].ROOM != null) 
            {
                availStatus = floorListAll[selectorFloorList].ROOM_STATUS.split(',');
            }
            else 
            {
                flagger = 2;
            }
            qtyMax = parseInt($("#rowEdit").val()) * parseInt($("#columnEdit").val());
            for (let i = 0; i < qtyMax; i++) 
            {
                if (availStatus[i] == 'booked' && flagger != 2)
                {
                    flag = "no";
                    $(".loading").modal('toggle');
                    $("#formEdit").modal('toggle');
                    alert('<?= Yii::t('app', 'Room Still Booked') ?>');
                    break;
                }
            }
            if (flag == 'go') 
            {
                DeleteFloor();
            }
        });

        function ShowLoadingScreen()
        {
            $("#editConfirmationModal").modal('toggle');
            $(".loading").modal('toggle');
            editFloor = setInterval(ajaxEdit, 500);
            setTimeout(function() 
            { 
                clearInterval( editFloor ); 
            }, 501);
        }

        function EditFloor()
        {
            flag = "go";
            flagger = 0;
            availStatus = [];
            if (floorListAll[selectorFloorList].ROOM != null) 
            {
                availStatus = floorListAll[selectorFloorList].ROOM_STATUS.split(',');
            }
            else 
            {
                flagger = 2;
            }
            qtyMax = parseInt($("#rowEdit").val()) * parseInt($("#columnEdit").val());
            for (let i = 0; i < qtyMax; i++) 
            {
                if ($("#roomName"+(i+1)).val().length > 256)
                {
                    $(".loading").modal('toggle');
                    $("#formEdit").modal('toggle');
                    $("#formEditFloor").addClass('was-validated')
                    alert('<?= Yii::t('app', 'All room input must be filled!') ?>');
                    flag = "no";
                    break;
                }
                else if (availStatus[i] == 'booked' && $("#rowEdit").val() != floorListAll[selectorView].ROW && $("#columnEdit").val() != floorListAll[selectorView].COLUMN && flagger != 2)
                {
                    flag = "no";
                    alert('<?= Yii::t('app', 'Room Still Booked') ?>');
                    break;
                }
            }
            if (flag == "go") 
            {
                $("#formEdit").modal('toggle');
                $("#editConfirmationModal").modal('toggle');
            }
        }

        function ajaxEdit()
        {
            qtyMax = parseInt($("#rowEdit").val()) * parseInt($("#columnEdit").val());
            temp = $("#roomTypeSelectionEdit").val();
            rtypeIdArr = "", rtypeNameArr = "";
            for (let i = 0; i < temp.length; i++) 
            {
                temprtype = temp[i].split(',');
                rtypeIdArr = rtypeIdArr + temprtype[1];
                rtypeNameArr = rtypeNameArr + temprtype[0];
                if (i != temp.length-1) 
                {
                    rtypeIdArr = rtypeIdArr + ",";
                    rtypeNameArr = rtypeNameArr + ",";
                }
            }
            var data = {
                id : floorListAll[selectorFloorList].ID,
                name : $("#nameEdit").val(),
                level : $("#levelEdit").val(),
                row : $("#rowEdit").val(),
                column : $("#columnEdit").val(),
                rtypeIdArr : rtypeIdArr,
                rtypeNameArr : rtypeNameArr,
                qty : qtyMax,
                adminId : adminId,
            };
            $.ajax({
                type : 'POST',
                data : data,
                dataType : 'JSON',
                url : '<?= Yii::$app->getUrlManager()->createUrl('hotel-floor/edit-floor') ?>',
                async: false,
                success : function(result)
                {
                    if (result.errNum == 0) 
                    {
                        if (floorListAll[selectorFloorList].ROOM != null) 
                        {
                            //ubah ketika room sudah pernah ada
                            looplimit = 0;
                            existinglength = floorListAll[selectorFloorList].ROOM_ID.split(",").length;
                            if (qtyMax < existinglength) 
                            {
                                looplimit = existinglength;
                            }
                            else
                            {
                                console.log(existinglength)
                                looplimit = qtyMax;
                            }
                            idArr = floorListAll[selectorFloorList].ROOM_ID.split(",");
                            for (let i = 0; i < looplimit; i++) 
                            {
                                //if yang baru lebih kecil dari yang udah ada (jumlah kamar dikurangin)
                                if (i >= qtyMax && qtyMax < existinglength) 
                                {
                                    var data = {
                                        id : idArr[i],
                                        adminId : adminId,
                                    };
                                    $.ajax({
                                        type : 'POST',
                                        data : data,
                                        dataType : 'JSON',
                                        url : '<?= Yii::$app->getUrlManager()->createUrl('hotel-floor/remove-room') ?>',
                                        success : function(result)
                                        {
                                            if (result.errNum == 1)
                                            {
                                                alert("Error Code (" + result.errNum + ")  : " + result.errStr);
                                            }
                                        }
                                    });
                                }
                                //if yang baru lebih gede dari yang udah ada (jumlah kamar ditambahin)
                                else if (i >= existinglength && qtyMax > existinglength)
                                {
                                    temp = $("#roomType"+(i+1)).val().split(',');
                                    if (temp[0] == "" || temp[1] == undefined || $("#roomName"+(i+1)).val() == "") 
                                    {
                                        var data = {
                                            floorId : floorListAll[selectorFloorList].ID,
                                            rtypeId : temp[1],
                                            rtypeName : temp[0],
                                            name : $("#roomName"+(i+1)).val(),
                                            status : 'unavailable',
                                            adminId : adminId,
                                        };
                                    }
                                    else
                                    {
                                        var data = {
                                            floorId : floorListAll[selectorFloorList].ID,
                                            rtypeId : temp[1],
                                            rtypeName : temp[0],
                                            name : $("#roomName"+(i+1)).val(),
                                            status : 'available',
                                            adminId : adminId,
                                        };
                                    }
                                    console.log(data)
                                    $.ajax({
                                        type : 'POST',
                                        data : data,
                                        dataType : 'JSON',
                                        url : '<?= Yii::$app->getUrlManager()->createUrl('hotel-floor/add-room') ?>',
                                        async: false,
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
                                    temp = $("#roomType"+(i+1)).val().split(',');
                                    var data = {
                                        roomId : idArr[i],
                                        floorId : floorListAll[selectorFloorList].ID,
                                        rtypeId : temp[1],
                                        rtypeName : temp[0],
                                        name : $("#roomName"+(i+1)).val(),
                                        status : 'available',
                                        adminId : adminId,
                                    };
                                    $.ajax({
                                        type : 'POST',
                                        data : data,
                                        dataType : 'JSON',
                                        url : '<?= Yii::$app->getUrlManager()->createUrl('hotel-floor/edit-room') ?>',
                                        async: false,
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
                        }
                        else
                        {
                            for (let i = 0; i < qtyMax; i++) 
                            {
                                temp = $("#roomType"+(i+1)).val().split(',');
                                console.log(temp)
                                var data = {
                                    floorId : floorListAll[selectorFloorList].ID,
                                    rtypeId : temp[1],
                                    rtypeName : temp[0],
                                    name : $("#roomName"+(i+1)).val(),
                                    status : 'available',
                                    adminId : adminId,
                                };
                                $.ajax({
                                    type : 'POST',
                                    data : data,
                                    dataType : 'JSON',
                                    url : '<?= Yii::$app->getUrlManager()->createUrl('hotel-floor/add-room') ?>',
                                    async: false,
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
                        alert("<?= Yii::t('app', 'Floor Edited') ?>");
                        $(".loading").modal('toggle');
                        location.reload();
                    }
                    else if (result.errNum == 1)
                    {
                        alert("Error Code (" + result.errNum + ")  : " + result.errStr);
                    }
                }
            });
        }

        $("#submitEdit").on('click', function()
        {
            ShowLoadingScreen();
        });
        
        function DeleteFloor()
        {
            var data = {
                id : floorListAll[selectorFloorList].ID,
                adminId : adminId,
            };
            $.ajax({
                type : 'POST',
                data : data,
                dataType : 'JSON',
                url : '<?= Yii::$app->getUrlManager()->createUrl('hotel-floor/remove-floor') ?>',
                async: false,
                success : function(result)
                {
                    if (result.errNum == 1)
                    {
                        alert("Error Code (" + result.errNum + ")  : " + result.errStr);
                    }
                    else if (result.errNum == 0)
                    {
                        alert("Floor Deleted");
                        $(".loading").modal('toggle');
                        location.reload();
                    }
                }
            });
        }
    })
</script>