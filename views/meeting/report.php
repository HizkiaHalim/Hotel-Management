<div class="site-index my-5">
    <div class="container col-10">
        <div class="fs-3 text-center p-3 fw-bold"><?= Yii::t('app', 'Meeting Room Report') ?></div>
        <div class="d-flex justify-content-end  align-middle">
            <div class="d-flex">
                <input id="searchDate" type="date" placeholder="" class="form-control">
                <button type="button" class="btn btn-primary mx-2" id="submitSearch"><?= Yii::t('app', 'Search') ?></button>
            </div>
        </div>
        <div class="tableTransaction">
            <table class="table table-bordered my-2 mb-5 ">
                <thead>
                    <tr class="text-center">
                        <th class="align-middle col-1">No</th>
                        <th class="align-middle col-1"><?= Yii::t('app', 'Transaction Date') ?></th>
                        <th class="align-middle col-1"><?= Yii::t('app', 'Booker Name') ?></th>
                        <th class="align-middle col-2"><?= Yii::t('app', 'Booker Phone') ?></th>
                        <th class="align-middle col-2"><?= Yii::t('app', 'Check In') ?></th>
                        <th class="align-middle col-2"><?= Yii::t('app', 'Check Out') ?></th>
                        <th class="align-middle col-1"><?= Yii::t('app', 'Room Qty') ?></th>
                        <th class="align-middle col-1"><?= Yii::t('app', 'Total Price') ?></th>
                        <th class="align-middle col-1"><?= Yii::t('app', 'Payment Method') ?></th>
                        <th class="align-middle col-3"><?= Yii::t('app', 'Booked Room Name') ?></th>
                        <th class="align-middle col-1"></th>
                    </tr>
                </thead>
                <tbody id="transactionList">
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal" id="viewTrans" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?= Yii::t('app', 'Transaction Detail') ?></h4>
                </div>
                <div class="modal-body">
                    <div class="fw-bold text-center"><?= Yii::t('app', 'Transaction Summary') ?></div>
                    <div id="transactionDateTextEdit"></div>
                    <div id="bookerNameTextEdit"></div>
                    <div id="bookerPhoneTextEdit"></div>
                    <div id="bookerStatusTextEdit"></div>
                    <div id="checkInTextEdit"></div>
                    <div id="checkOutTextEdit"></div>
                    <div id="roomQtyTextEdit"></div>
                    <div id="roomListSummaryEdit"></div>
                    
                </div>
                <div class="modal-footer justify-content-between">
                    <div class="col-5">
                        <div id="totalPriceTextEdit"></div>
                        <div>
                            <label for="paymentSelectionEdit" class="form-label "><?= Yii::t('app', 'Payment Method') ?> : </label>
                            <select class="floorSelect" id="paymentSelectionEdit" disabled></select>
                        </div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-success"  data-bs-dismiss="modal"><?= Yii::t('app', 'Okay') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal loading" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog loadingback">
            <div class="modal-content loadingback2">
                <div class="loader"></div>
            </div>
        </div>
    </div> 
</div>

<script>
    $(function()
    {
        var adminId = <?=$adminId?>;
        var transList = <?=$transList?>;
        var rtypeFacility = <?=$rtypeFacility?>;
        var paymentMethod = <?=$paymentMethod?>;
        var rtypeWithPrice = <?=$rtypeWithPrice?>;
        var selection;
        var monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        console.log(rtypeWithPrice)

        var paymentMethodEditHtml = "";
        for (let i = 0; i < paymentMethod.length; i++) 
        {
            paymentMethodEditHtml = paymentMethodEditHtml + "<option value='" + paymentMethod[i].NAME + "," + paymentMethod[i].ID + "'>" + paymentMethod[i].NAME + "</option>";
        }
        $("#paymentSelectionEdit").html(paymentMethodEditHtml);
        VirtualSelect.init({
            ele: '#paymentSelectionEdit',
        });

        $(":input[type='date']").on("focus", function(e) 
        {
            $(this).prop("readonly", true);             
        });
        
        $(":input[type='date']").on("blur", function() {
            $(this).prop("readonly", false);
        });

        $('#submitSearch').on('click', function()
        {
            $("#rentTable").empty();
            if ($('#searchDate').val() != "") 
            {
                $("#transactionList").empty();
                dateSearch = new Date(new Date($('#searchDate').val()) - (7*60*60*1000));
                dateSearch = dateSearch.getFullYear() + "-" + (dateSearch.getMonth()+1).toString().padStart(2,"0") + "-" + dateSearch.getDate();
                numcount = 0;
                for (let i = 0; i < transList.length; i++) 
                {
                    dateTrans = new Date(transList[i].TRANSACTION_DATE);
                    dateTrans = dateTrans.getFullYear() + "-" + (dateTrans.getMonth()+1).toString().padStart(2,"0") + "-" + dateTrans.getDate();
                    console.log(dateTrans)
                    console.log(dateSearch)

                    if (dateTrans == dateSearch)
                    {
                        $("#transactionList").append("\
                                <tr class=\"text-center\">\
                                    <td class=\"align-middle col-1\">" + (numcount+1) + "</td>\
                                    <td class=\"align-middle col-1\">" + transList[i].TRANSACTION_DATE + "</td>\
                                    <td class=\"align-middle col-1\">" + transList[i].BOOK_BY + "</td>\
                                    <td class=\"align-middle col-2\">" + transList[i].BOOKER_PHONE + "</td>\
                                    <td class=\"align-middle col-2\">" + transList[i].CHECK_IN + "</td>\
                                    <td class=\"align-middle col-2\">" + transList[i].CHECK_OUT + "</td>\
                                    <td class=\"align-middle col-1\">" + transList[i].BOOK_QTY + "</td>\
                                    <td class=\"align-middle col-1\">" + transList[i].TOTAL_PRICE + "</td>\
                                    <td class=\"align-middle col-1\">" + transList[i].PAYMENT_NAME + "</td>\
                                    <td class=\"align-middle col-3 text-break\">" + transList[i].ROOM_NAME + "</td>\
                                    <td class=\"align-middle col-1\"><button type='button' class='viewTrans btn btn-primary' data-bs-toggle='modal' data-bs-target='#viewTrans' value=" + i + ">View</button></td>\
                                </tr>")
                        numcount++;
                    }
                }
            }
            else
            {
                $("#transactionList").empty();
                for (let i = 0; i < transList.length; i++) 
                {
                    $("#transactionList").append("\
                                        <tr class=\"text-center\">\
                                            <td class=\"align-middle col-1\">" + (i+1) + "</td>\
                                            <td class=\"align-middle col-1\">" + transList[i].TRANSACTION_DATE + "</td>\
                                            <td class=\"align-middle col-1\">" + transList[i].BOOK_BY + "</td>\
                                            <td class=\"align-middle col-2\">" + transList[i].BOOKER_PHONE + "</td>\
                                            <td class=\"align-middle col-2\">" + transList[i].CHECK_IN + "</td>\
                                            <td class=\"align-middle col-2\">" + transList[i].CHECK_OUT + "</td>\
                                            <td class=\"align-middle col-1\">" + transList[i].BOOK_QTY + "</td>\
                                            <td class=\"align-middle col-1\">" + transList[i].TOTAL_PRICE + "</td>\
                                            <td class=\"align-middle col-1\">" + transList[i].PAYMENT_NAME + "</td>\
                                            <td class=\"align-middle col-3 text-break\">" + transList[i].ROOM_NAME + "</td>\
                                            <td class=\"align-middle col-1\"><button type='button' class='viewTrans btn btn-primary' data-bs-toggle='modal' data-bs-target='#viewTrans' value=" + i + ">View</button></td>\
                                        </tr>")
                }
            }
        });

        for (let i = 0; i < transList.length; i++) 
        {
            $("#transactionList").append("\
                                <tr class=\"text-center\">\
                                    <td class=\"align-middle col-1\">" + (i+1) + "</td>\
                                    <td class=\"align-middle col-1\">" + transList[i].TRANSACTION_DATE + "</td>\
                                    <td class=\"align-middle col-1\">" + transList[i].BOOK_BY + "</td>\
                                    <td class=\"align-middle col-2\">" + transList[i].BOOKER_PHONE + "</td>\
                                    <td class=\"align-middle col-2\">" + transList[i].CHECK_IN + "</td>\
                                    <td class=\"align-middle col-2\">" + transList[i].CHECK_OUT + "</td>\
                                    <td class=\"align-middle col-1\">" + transList[i].BOOK_QTY + "</td>\
                                    <td class=\"align-middle col-1\">" + transList[i].TOTAL_PRICE + "</td>\
                                    <td class=\"align-middle col-1\">" + transList[i].PAYMENT_NAME + "</td>\
                                    <td class=\"align-middle col-3 text-break\">" + transList[i].ROOM_NAME + "</td>\
                                    <td class=\"align-middle col-1\"><button type='button' class='viewTrans btn btn-primary' data-bs-toggle='modal' data-bs-target='#viewTrans' value=" + i + ">View</button></td>\
                                </tr>")
        }
        
        $("#transactionList").on('click', '.viewTrans', function()
        {
            selection =  $(this).attr('value');
            $("#transactionDateTextEdit").html("<?= Yii::t('app', 'Transaction Date') ?> : " + transList[selection].TRANSACTION_DATE);
            $("#bookerNameTextEdit").html("<?= Yii::t('app', 'Booker Name') ?> : " + transList[selection].BOOK_BY);
            $("#bookerPhoneTextEdit").html("<?= Yii::t('app', 'Booker Phone') ?> : " + transList[selection].BOOKER_PHONE);
            $("#bookerStatusTextEdit").html("<?= Yii::t('app', 'Book Status') ?> : " + (transList[selection].BOOK_STATUS == 'booked' ? 'Booked' : 'Done'));
            $("#checkInTextEdit").html("<?= Yii::t('app', 'Check In') ?> : " + transList[selection].CHECK_IN);
            $("#checkOutTextEdit").html("<?= Yii::t('app', 'Check Out') ?> : " + transList[selection].CHECK_OUT);
            $("#roomQtyTextEdit").html("<?= Yii::t('app', 'Room Qty') ?> : " + transList[selection].BOOK_QTY);
            $("#roomListSummaryEdit").empty();
            floorName = transList[selection].FLOOR_NAME.split(',');
            rtypeId = transList[selection].RTYPE_ID.split(',');
            cbreak = transList[selection].BREAK_QTY.split(',');
            breakfast = transList[selection].BREAKFAST_QTY.split(',');
            lunch = transList[selection].LUNCH_QTY.split(',');
            dinner = transList[selection].DINNER_QTY.split(',');
            rId = transList[selection].ROOM_ID.split(',');
            rName = transList[selection].ROOM_NAME.split(',');
            rPrice = transList[selection].ROOM_PRICE.split(',');
            rType = transList[selection].RTYPE_NAME.split(',');
            checkin = new Date(transList[selection].CHECK_IN);
            checkout = new Date(transList[selection].CHECK_OUT);
            hari = checkout.getTime() - checkin.getTime();
            hari = Math.abs( hari / (1000 * 60 * 60 * 24));
            for (let i = 0; i < rName.length; i++) 
            {
                for (let j = 0; j < rtypeFacility.length; j++) 
                {
                    if (rtypeFacility[j].ID == rtypeId[i] && rtypeFacility[j].NAME == rType[i]) 
                    {
                        indexFacility = j;
                        break;
                    }
                }
                totalPrice = 0, price = 0, breakprice = "", breakfastprice = "", lunchprice = "",dinnerprice = "", holiday = 0, normal = 0, holidayprice = "", normalprice = "";
                for (let k = 0; k < rtypeWithPrice.length; k++) 
                {
                    if ( rtypeWithPrice[k].NAME == rType[i] && rtypeWithPrice[k].ID == rtypeId[i] ) 
                    {
                        breakprice = cbreak[i] + " x " + rtypeWithPrice[k].BREAK_PRICE + " = " + (cbreak[i] * rtypeWithPrice[k].BREAK_PRICE);
                        breakfastprice = breakfast[i] + " x " + rtypeWithPrice[k].BREAKFAST_PRICE + " = " + (breakfast[i] * rtypeWithPrice[k].BREAKFAST_PRICE);
                        lunchprice = lunch[i] + " x " + rtypeWithPrice[k].LUNCH_PRICE + " = " + (lunch[i] * rtypeWithPrice[k].LUNCH_PRICE);
                        dinnerprice = dinner[i] + " x " + rtypeWithPrice[k].DINNER_PRICE + " = " + (dinner[i] * rtypeWithPrice[k].DINNER_PRICE);
                        price = price + (cbreak[i] * rtypeWithPrice[k].BREAK_PRICE);
                        price = price + (breakfast[i] * rtypeWithPrice[k].BREAKFAST_PRICE);
                        price = price + (lunch[i] * rtypeWithPrice[k].LUNCH_PRICE);
                        price = price + (dinner[i] * rtypeWithPrice[k].DINNER_PRICE);
                        for (let l = 0; l < hari; l++) 
                        {
                            jumlah = new Date(transList[selection].CHECK_IN).getDay() + l;
                            if ( (jumlah%6) == 0 || (jumlah%7) == 0) 
                            {
                                holiday++;
                                price = price + parseInt(rtypeWithPrice[k].HOLIDAY_PRICE);
                            }
                            else
                            {
                                normal++;
                                price = price + parseInt(rtypeWithPrice[k].REGULAR_PRICE);
                            }
                        }
                        holidayprice = holiday + " x " + rtypeWithPrice[k].HOLIDAY_PRICE + " = " + (holiday * rtypeWithPrice[k].HOLIDAY_PRICE);
                        normalprice = normal + " x " + rtypeWithPrice[k].REGULAR_PRICE + " = " + (normal * rtypeWithPrice[k].REGULAR_PRICE);
                        break;
                    } 
                }
                $("#roomListSummaryEdit").append("\
                                            <div class=\"border border-4 border-dark rounded mt-2 p-3\">\
                                                <div><?= Yii::t('app', 'Room Name') ?> : " + rName[i] + "</div>\
                                                <div><?= Yii::t('app', 'Floor') ?> : " + floorName[i] +  "</div>\
                                                <div><?= Yii::t('app', 'Room Type') ?> : " + rType[i] + " </div>\
                                                <div><?= Yii::t('app', 'Room Facility') ?> : " + (rtypeFacility[indexFacility].FACILITY_NAME == null ? '<?= Yii::t('app', 'No Facility') ?>': rtypeFacility[indexFacility].FACILITY_NAME) + "</div>\
                                                <div><?= Yii::t('app', 'Aditional') ?> : " + cbreak[i] + " <?= Yii::t('app', 'coffee break') ?>, " + breakfast[i] + " <?= Yii::t('app', 'breakfast') ?>, " + lunch[i] + " <?= Yii::t('app', 'lunch') ?>, " + dinner[i] + " <?= Yii::t('app', 'dinner') ?> </div>\
                                                <div><?= Yii::t('app', 'Price') ?> : IDR " + rPrice[i] + " </div>\
                                                <div><?= Yii::t('app', 'Detail Price') ?> : </div>\
                                                <div><?= Yii::t('app', 'Holiday Price') ?> : " + holidayprice + " </div>\
                                                <div><?= Yii::t('app', 'Normal Price') ?> : " + normalprice + " </div>\
                                                <div><?= Yii::t('app', 'Break Price') ?> : " + breakprice + " </div>\
                                                <div><?= Yii::t('app', 'Breakfast Price') ?> : " + breakfastprice + " </div>\
                                                <div><?= Yii::t('app', 'Lunch Price') ?> : " + lunchprice + " </div>\
                                                <div><?= Yii::t('app', 'Dinner Price') ?> : " + dinnerprice + " </div>\
                                            </div>\
                                            ")
            }
            $("#totalPriceTextEdit").html(' <?= Yii::t('app', 'Total Price') ?> : IDR ' + transList[selection].TOTAL_PRICE);
            document.querySelector('#paymentSelectionEdit').setValue(transList[selection].PAYMENT_NAME + "," + transList[selection].PAYMENT_ID );
        });

        function openLoadingEdit() 
        {
            $("#viewTrans").modal('toggle');
            $(".loading").modal('toggle');
        }
    })
</script>