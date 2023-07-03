<div class="site-index my-5">
    <div class="container col-10">
        <div class="fs-3 text-center p-3 fw-bold"><?= Yii::t('app', 'Meeting Room Booking List') ?></div>
        <div class="d-flex justify-content-end  align-middle py-1">
            <div class="d-flex align-items-center">
                <span class="px-2"><?= Yii::t('app', 'Check In Date') ?> :</span>
                <input id="searchDateCheckin" type="date" placeholder="" class="py-1">
                <button type="button" class="btn btn-primary mx-2" id="submitSearchCheckin"><?= Yii::t('app', 'Search') ?></button>
            </div>
        </div>
        <div class="d-flex justify-content-between align-middle">
            <button id="addBtn" type="button" class="btn btn-primary" ><?= Yii::t('app', 'Add Booking') ?></button>
            <div class="d-flex align-items-center">
                <span class="px-2"><?= Yii::t('app', 'Check Out Date') ?> :</span>
                <input id="searchDateCheckout" type="date" placeholder="" class="py-1">
                <button type="button" class="btn btn-primary mx-2" id="submitSearchCheckout"><?= Yii::t('app', 'Search') ?></button>
            </div>
        </div>
        <table class="table table-bordered w-100 my-2 mb-5">
                <thead>
                    <tr class="text-center">
                        <th class="align-middle col-1">No</th>
                        <th class="align-middle col-1"><?= Yii::t('app', 'Check In') ?></th>
                        <th class="align-middle col-1"><?= Yii::t('app', 'Check Out') ?></th>
                        <th class="align-middle col-2"><?= Yii::t('app', 'Book By') ?></th>
                        <th class="align-middle col-2"><?= Yii::t('app', 'Phone Number') ?></th>
                        <th class="align-middle col-1"><?= Yii::t('app', 'Room Qty') ?></th>
                        <th class="align-middle col-1"><?= Yii::t('app', 'Total Price') ?></th>
                        <th class="align-middle col-1"></th>
                    </tr>
                </thead>
                <tbody id="bookingList">
                </tbody>
            </table>
        </div>  
    </div>

    <form id="formAddBookingDetail" class="needs-validation" novalidate>
        <div class="modal" id="formAddDetail" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?= Yii::t('app', 'Book Room') ?></h4>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="name" class="form-label "><?= Yii::t('app', 'Booker Name') ?></label>
                            <input type="text" class="form-control" required id="name" placeholder="<?= Yii::t('app', 'Enter Booker Name') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input vooker name.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                        <div>
                            <label for="phone" class="form-label pt-3"><?= Yii::t('app', 'Booker Phone Number') ?></label>
                            <input type="numeric" class="form-control" required id="phone" placeholder="<?= Yii::t('app', 'Enter Booker Phone Number') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input booker phone number.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                        <div>
                            <label for="checkinDate" class="form-label pt-3"><?= Yii::t('app', 'Check In Date') ?></label>
                            <input id="checkinDate" class="datepicker" type="date">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input booker phone number.') ?></div>
                        </div>
                        <div>
                            <label for="checkoutDate" class="form-label pt-3"><?= Yii::t('app', 'Check Out Date') ?></label>
                            <input id="checkoutDate" class="datepicker" type="date">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input booker phone number.') ?></div>
                        </div>
                        <div>
                            <label for="pax" class="form-label pt-3"><?= Yii::t('app', 'Pax') ?></label>
                            <input type="numeric" class="form-control" required id="pax" placeholder="<?= Yii::t('app', 'Enter Pax') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input the number of people.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                        <div>
                            <label for="roomQty" class="form-label pt-3"><?= Yii::t('app', 'Room Quantity') ?></label>
                            <input type="numeric" class="form-control" required id="roomQty" placeholder="<?= Yii::t('app', 'Enter Room Quantity') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input the number of rooms to book.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                        <div id="rtypeSelect"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="cancelAddBtn">Cancel</button>
                        <button type="button" class="btn btn-primary" id="submitAddBookingDetail"><?= Yii::t('app', 'Continue') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form id="formAddBookingRoom" class="needs-validation" novalidate>
        <div class="modal" id="formAddRoom" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?= Yii::t('app', 'Book Room') ?></h4>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="floorSelection" class="form-label "><?= Yii::t('app', 'Level Selection') ?> :</label>
                            <select class="form-control floorSelect" id="floorSelection"></select>
                        </div>
                        <div id="rtypeSelect"></div>
                        <div class="pt-2">Floor Map</div>
                        <div id="floorMap" class="border border-4 border-dark rounded mt-2"></div>
                        <div class="pt-2">Room</div>
                        <div id="roomList">
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#formAddDetail"id="cancelAddBtn">Cancel</button>
                        <button type="button" class="btn btn-primary" id="submitAddBookingRoom"><?= Yii::t('app', 'Continue') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    
    <div class="modal" id="detailAvb" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?= Yii::t('app', 'Available Room') ?></h4>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered w-100 my-2 mb-5">
                        <thead>
                            <tr class="text-center">
                                <th class="align-middle col-1">No</th>
                                <th class="align-middle col-1"><?= Yii::t('app', 'Floor') ?></th>
                                <th class="align-middle col-1"><?= Yii::t('app', 'Room Type') ?></th>
                                <th class="align-middle col-1"><?= Yii::t('app', 'Qty') ?></th>
                                <th class="align-middle col-1"><?= Yii::t('app', 'Regular Price') ?></th>
                                <th class="align-middle col-1"><?= Yii::t('app', 'Holiday Price') ?></th>
                                <th class="align-middle col-1"><?= Yii::t('app', 'Coffee Break Price') ?></th>
                                <th class="align-middle col-1"><?= Yii::t('app', 'Breakfast Price') ?></th>
                                <th class="align-middle col-1"><?= Yii::t('app', 'Lunch Price') ?></th>
                                <th class="align-middle col-1"><?= Yii::t('app', 'Dinner Price') ?></th>
                            </tr>
                        </thead>
                        <tbody id="avbList">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" id="continueBtnFromRSelect" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#formAddDetail"><?= Yii::t('app', 'Close') ?></button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="formRoomSelect" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?= Yii::t('app', 'Select Room') ?></h4>
                </div>
                <div class="modal-body">
                    <div>
                        <label for="floorSelectionMap" class="form-label "><?= Yii::t('app', 'Level Selection') ?> :</label>
                        <select class="form-control floorSelect" id="floorSelectionMap"></select>
                    </div>
                    <div class="pt-2">Floor Map</div>
                    <div id="chooseRoom" class="border border-4 border-dark rounded mt-2"></div>
                    <div class="pt-2">Room</div>
                    <div id="roomSelected">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="continueBtnFromRSelect" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#formAddRoom"><?= Yii::t('app', 'Continue') ?></button>
                </div>
            </div>
        </div>
    </div>

    <form id="formAddBookingPayment" class="needs-validation" novalidate>
        <div class="modal" id="formAddPayment" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?= Yii::t('app', 'Book Room') ?></h4>
                    </div>
                    <div class="modal-body">
                        <div class="fw-bold text-center"><?= Yii::t('app', 'Booking Summary') ?></div>
                        <div id="bookerNameText"></div>
                        <div id="bookerPhoneText"></div>
                        <div id="checkInText"></div>
                        <div id="checkOutText"></div>
                        <div id="roomQtyText"></div>
                        <div id="roomListSummary"></div>
                        
                    </div>
                    <div class="modal-footer justify-content-between">
                        <div class="col-6">
                            <div id="totalPriceText"></div>
                            <div >
                                <label for="paymentSelection" class="form-label "><?= Yii::t('app', 'Payment Method') ?> :</label>
                                <select class="floorSelect" id="paymentSelection"></select>
                            </div>
                        </div>
                        <div>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#formAddRoom" id="cancelAddBtn">Cancel</button>
                            <button type="button" class="btn btn-primary" id="submitAddBooking"><?= Yii::t('app', 'Process') ?></button>
                        </div>
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

    <div class="modal" id="editBooking" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?= Yii::t('app', 'Book Room') ?></h4>
                </div>
                <div class="modal-body">
                    <div class="fw-bold text-center"><?= Yii::t('app', 'Booking Summary') ?></div>
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
                            <label for="paymentSelectionEdit" class="form-label "><?= Yii::t('app', 'Payment Method') ?> :</label>
                            <select class="floorSelect" id="paymentSelectionEdit" disabled></select>
                        </div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-primary" id="checkoutBtn">Checkout</button>
                        <button type="button" class="btn btn-success"  data-bs-dismiss="modal"><?= Yii::t('app', 'Okay') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function()
    {
        var adminId = <?=$adminId?>;
        var bookingAll = <?=$bookingAll?>;
        var rtypeWithCountList = <?=$rtypeWithCountList?>;
        var rtypeAvbInFloor = <?=$rtypeAvbInFloor?>;
        var baseroomInFloorWithStatus = <?=$roomInFloorWithStatus?>;
        var floorListAll = <?=$floorListAll?>;
        var paymentMethod = <?=$paymentMethod?>;
        var rtypeWithPrice = <?=$rtypeWithPrice?>;
        var rtypeFacility = <?=$rtypeFacility?>;
        var selectedRtype = [], selectingRoom, currentSelect, roomselected, roomtypeselected, floorselected, roomInFloorWithStatus, totalPrice = 0, checkin, checkout, selectedRoomId = [], breakArr = [], breakfastArr = [], lunchArr = [], dinnerArr = [], priceArr = [], selection, floorForMap = [];
        var monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        roomInFloorWithStatus = [];
        roomInFloorWithStatus = $.extend( true, [], baseroomInFloorWithStatus );

        //search date
            $('#submitSearchCheckin').on('click', function()
            {
                if ($('#searchDateCheckin').val() != "" && $('#searchDateCheckout').val() == "" ) 
                {
                    $("#bookingList").empty();
                    dateSearch = new Date(new Date($('#searchDateCheckin').val()) - (7*60*60*1000));
                    dateSearch = dateSearch.getFullYear() + "-" + (dateSearch.getMonth()+1).toString().padStart(2,"0") + "-" + dateSearch.getDate();
                    numcount = 0;
                    for (let i = 0; i < bookingAll.length; i++) 
                    {
                        dateTrans = new Date(bookingAll[i].CHECK_IN);
                        dateTrans = dateTrans.getFullYear() + "-" + (dateTrans.getMonth()+1).toString().padStart(2,"0") + "-" + dateTrans.getDate();
                        console.log(dateTrans)
                        console.log(dateSearch)

                        if (dateTrans >= dateSearch)
                        {
                            $("#bookingList").append("\
                                        <tr class=\"text-center\">\
                                            <td class=\"align-middle col-1\">" + (numcount+1) + "</td>\
                                            <td class=\"align-middle col-1\">" + bookingAll[i].CHECK_IN + "</td>\
                                            <td class=\"align-middle col-1\">" + bookingAll[i].CHECK_OUT + "</td>\
                                            <td class=\"align-middle col-2\">" + bookingAll[i].BOOK_BY + "</td>\
                                            <td class=\"align-middle col-2\">" + bookingAll[i].BOOKER_PHONE + "</td>\
                                            <td class=\"align-middle col-1\">" + bookingAll[i].BOOK_QTY + "</td>\
                                            <td class=\"align-middle col-1\">" + bookingAll[i].TOTAL_PRICE + "</td>\
                                            <td class=\"align-middle col-1\"><button type='button' class='editBooking btn btn-primary' data-bs-toggle='modal' data-bs-target='#editBooking' value=" + i + ">View</button></td>\
                                        </tr>")
                            numcount++;
                        }
                    }
                }
                else if ($('#searchDateCheckin').val() != "" && $('#searchDateCheckout').val() != "" )
                {
                    $("#bookingList").empty();
                    dateSearchCheckin = new Date(new Date($('#searchDateCheckin').val()) - (7*60*60*1000));
                    dateSearchCheckin = dateSearchCheckin.getFullYear() + "-" + (dateSearchCheckin.getMonth()+1).toString().padStart(2,"0") + "-" + dateSearchCheckin.getDate();
                    dateSearchCheckout = new Date(new Date($('#searchDateCheckout').val()) - (7*60*60*1000));
                    dateSearchCheckout = dateSearchCheckout.getFullYear() + "-" + (dateSearchCheckout.getMonth()+1).toString().padStart(2,"0") + "-" + dateSearchCheckout.getDate();
                    numcount = 0;
                    for (let i = 0; i < bookingAll.length; i++) 
                    {
                        dateCheckin = new Date(bookingAll[i].CHECK_IN);
                        dateCheckin = dateCheckin.getFullYear() + "-" + (dateCheckin.getMonth()+1).toString().padStart(2,"0") + "-" + dateCheckin.getDate();
                        dateCheckout = new Date(bookingAll[i].CHECK_OUT);
                        dateCheckout = dateCheckout.getFullYear() + "-" + (dateCheckout.getMonth()+1).toString().padStart(2,"0") + "-" + dateCheckout.getDate();
                        console.log(dateCheckin)
                        console.log(dateCheckout)
                        console.log(dateSearchCheckin)
                        console.log(dateSearchCheckout)

                        if (dateCheckin >= dateSearchCheckin && dateCheckout <= dateSearchCheckout)
                        {
                            $("#bookingList").append("\
                                        <tr class=\"text-center\">\
                                            <td class=\"align-middle col-1\">" + (numcount+1) + "</td>\
                                            <td class=\"align-middle col-1\">" + bookingAll[i].CHECK_IN + "</td>\
                                            <td class=\"align-middle col-1\">" + bookingAll[i].CHECK_OUT + "</td>\
                                            <td class=\"align-middle col-2\">" + bookingAll[i].BOOK_BY + "</td>\
                                            <td class=\"align-middle col-2\">" + bookingAll[i].BOOKER_PHONE + "</td>\
                                            <td class=\"align-middle col-1\">" + bookingAll[i].BOOK_QTY + "</td>\
                                            <td class=\"align-middle col-1\">" + bookingAll[i].TOTAL_PRICE + "</td>\
                                            <td class=\"align-middle col-1\"><button type='button' class='editBooking btn btn-primary' data-bs-toggle='modal' data-bs-target='#editBooking' value=" + i + ">View</button></td>\
                                        </tr>")
                            numcount++;
                        }
                    }
                }
                else if ($('#searchDateCheckout').val() != "" && $('#searchDateCheckin').val() == "" ) 
                {
                    $("#bookingList").empty();
                    dateSearch = new Date(new Date($('#searchDateCheckout').val()) - (7*60*60*1000));
                    dateSearch = dateSearch.getFullYear() + "-" + (dateSearch.getMonth()+1).toString().padStart(2,"0") + "-" + dateSearch.getDate();
                    numcount = 0;
                    for (let i = 0; i < bookingAll.length; i++) 
                    {
                        dateTrans = new Date(bookingAll[i].CHECK_OUT);
                        dateTrans = dateTrans.getFullYear() + "-" + (dateTrans.getMonth()+1).toString().padStart(2,"0") + "-" + dateTrans.getDate();
                        console.log(dateTrans)
                        console.log(dateSearch)

                        if (dateTrans >= dateSearch)
                        {
                            $("#bookingList").append("\
                                        <tr class=\"text-center\">\
                                            <td class=\"align-middle col-1\">" + (numcount+1) + "</td>\
                                            <td class=\"align-middle col-1\">" + bookingAll[i].CHECK_IN + "</td>\
                                            <td class=\"align-middle col-1\">" + bookingAll[i].CHECK_OUT + "</td>\
                                            <td class=\"align-middle col-2\">" + bookingAll[i].BOOK_BY + "</td>\
                                            <td class=\"align-middle col-2\">" + bookingAll[i].BOOKER_PHONE + "</td>\
                                            <td class=\"align-middle col-1\">" + bookingAll[i].BOOK_QTY + "</td>\
                                            <td class=\"align-middle col-1\">" + bookingAll[i].TOTAL_PRICE + "</td>\
                                            <td class=\"align-middle col-1\"><button type='button' class='editBooking btn btn-primary' data-bs-toggle='modal' data-bs-target='#editBooking' value=" + i + ">View</button></td>\
                                        </tr>")
                            numcount++;
                        }
                    }
                }
                else
                {
                    $("#bookingList").empty();
                    for (let i = 0; i < bookingAll.length; i++) 
                    {
                        $("#bookingList").append("\
                                            <tr class=\"text-center\">\
                                                <td class=\"align-middle col-1\">" + (i+1) + "</td>\
                                                <td class=\"align-middle col-1\">" + bookingAll[i].CHECK_IN + "</td>\
                                                <td class=\"align-middle col-1\">" + bookingAll[i].CHECK_OUT + "</td>\
                                                <td class=\"align-middle col-2\">" + bookingAll[i].BOOK_BY + "</td>\
                                                <td class=\"align-middle col-2\">" + bookingAll[i].BOOKER_PHONE + "</td>\
                                                <td class=\"align-middle col-1\">" + bookingAll[i].BOOK_QTY + "</td>\
                                                <td class=\"align-middle col-1\">" + bookingAll[i].TOTAL_PRICE + "</td>\
                                                <td class=\"align-middle col-1\"><button type='button' class='editBooking btn btn-primary' data-bs-toggle='modal' data-bs-target='#editBooking' value=" + i + ">View</button></td>\
                                            </tr>")
                    }
                }
            });

            $('#submitSearchCheckout').on('click', function()
            {
                if ($('#searchDateCheckout').val() != "" && $('#searchDateCheckin').val() == "" ) 
                {
                    $("#bookingList").empty();
                    dateSearch = new Date(new Date($('#searchDateCheckout').val()) - (7*60*60*1000));
                    dateSearch = dateSearch.getFullYear() + "-" + (dateSearch.getMonth()+1).toString().padStart(2,"0") + "-" + dateSearch.getDate();
                    numcount = 0;
                    for (let i = 0; i < bookingAll.length; i++) 
                    {
                        dateTrans = new Date(bookingAll[i].CHECK_OUT);
                        dateTrans = dateTrans.getFullYear() + "-" + (dateTrans.getMonth()+1).toString().padStart(2,"0") + "-" + dateTrans.getDate();
                        console.log(dateTrans)
                        console.log(dateSearch)

                        if (dateTrans >= dateSearch)
                        {
                            $("#bookingList").append("\
                                        <tr class=\"text-center\">\
                                            <td class=\"align-middle col-1\">" + (numcount+1) + "</td>\
                                            <td class=\"align-middle col-1\">" + bookingAll[i].CHECK_IN + "</td>\
                                            <td class=\"align-middle col-1\">" + bookingAll[i].CHECK_OUT + "</td>\
                                            <td class=\"align-middle col-2\">" + bookingAll[i].BOOK_BY + "</td>\
                                            <td class=\"align-middle col-2\">" + bookingAll[i].BOOKER_PHONE + "</td>\
                                            <td class=\"align-middle col-1\">" + bookingAll[i].BOOK_QTY + "</td>\
                                            <td class=\"align-middle col-1\">" + bookingAll[i].TOTAL_PRICE + "</td>\
                                            <td class=\"align-middle col-1\"><button type='button' class='editBooking btn btn-primary' data-bs-toggle='modal' data-bs-target='#editBooking' value=" + i + ">View</button></td>\
                                        </tr>")
                            numcount++;
                        }
                    }
                }
                else if ($('#searchDateCheckin').val() != "" && $('#searchDateCheckout').val() != "" )
                {
                    $("#bookingList").empty();
                    dateSearchCheckin = new Date(new Date($('#searchDateCheckin').val()) - (7*60*60*1000));
                    dateSearchCheckin = dateSearchCheckin.getFullYear() + "-" + (dateSearchCheckin.getMonth()+1).toString().padStart(2,"0") + "-" + dateSearchCheckin.getDate();
                    dateSearchCheckout = new Date(new Date($('#searchDateCheckout').val()) - (7*60*60*1000));
                    dateSearchCheckout = dateSearchCheckout.getFullYear() + "-" + (dateSearchCheckout.getMonth()+1).toString().padStart(2,"0") + "-" + dateSearchCheckout.getDate();
                    numcount = 0;
                    for (let i = 0; i < bookingAll.length; i++) 
                    {
                        dateCheckin = new Date(bookingAll[i].CHECK_IN);
                        dateCheckin = dateCheckin.getFullYear() + "-" + (dateCheckin.getMonth()+1).toString().padStart(2,"0") + "-" + dateCheckin.getDate();
                        dateCheckout = new Date(bookingAll[i].CHECK_OUT);
                        dateCheckout = dateCheckout.getFullYear() + "-" + (dateCheckout.getMonth()+1).toString().padStart(2,"0") + "-" + dateCheckout.getDate();
                        console.log(dateCheckin)
                        console.log(dateCheckout)
                        console.log(dateSearchCheckin)
                        console.log(dateSearchCheckout)

                        if (dateCheckin >= dateSearchCheckin && dateCheckout <= dateSearchCheckout)
                        {
                            $("#bookingList").append("\
                                        <tr class=\"text-center\">\
                                            <td class=\"align-middle col-1\">" + (numcount+1) + "</td>\
                                            <td class=\"align-middle col-1\">" + bookingAll[i].CHECK_IN + "</td>\
                                            <td class=\"align-middle col-1\">" + bookingAll[i].CHECK_OUT + "</td>\
                                            <td class=\"align-middle col-2\">" + bookingAll[i].BOOK_BY + "</td>\
                                            <td class=\"align-middle col-2\">" + bookingAll[i].BOOKER_PHONE + "</td>\
                                            <td class=\"align-middle col-1\">" + bookingAll[i].BOOK_QTY + "</td>\
                                            <td class=\"align-middle col-1\">" + bookingAll[i].TOTAL_PRICE + "</td>\
                                            <td class=\"align-middle col-1\"><button type='button' class='editBooking btn btn-primary' data-bs-toggle='modal' data-bs-target='#editBooking' value=" + i + ">View</button></td>\
                                        </tr>")
                            numcount++;
                        }
                    }
                }
                else if ($('#searchDateCheckin').val() != "" && $('#searchDateCheckout').val() == "" ) 
                {
                    $("#bookingList").empty();
                    dateSearch = new Date(new Date($('#searchDateCheckin').val()) - (7*60*60*1000));
                    dateSearch = dateSearch.getFullYear() + "-" + (dateSearch.getMonth()+1).toString().padStart(2,"0") + "-" + dateSearch.getDate();
                    numcount = 0;
                    for (let i = 0; i < bookingAll.length; i++) 
                    {
                        dateTrans = new Date(bookingAll[i].CHECK_IN);
                        dateTrans = dateTrans.getFullYear() + "-" + (dateTrans.getMonth()+1).toString().padStart(2,"0") + "-" + dateTrans.getDate();
                        console.log(dateTrans)
                        console.log(dateSearch)

                        if (dateTrans >= dateSearch)
                        {
                            $("#bookingList").append("\
                                        <tr class=\"text-center\">\
                                            <td class=\"align-middle col-1\">" + (numcount+1) + "</td>\
                                            <td class=\"align-middle col-1\">" + bookingAll[i].CHECK_IN + "</td>\
                                            <td class=\"align-middle col-1\">" + bookingAll[i].CHECK_OUT + "</td>\
                                            <td class=\"align-middle col-2\">" + bookingAll[i].BOOK_BY + "</td>\
                                            <td class=\"align-middle col-2\">" + bookingAll[i].BOOKER_PHONE + "</td>\
                                            <td class=\"align-middle col-1\">" + bookingAll[i].BOOK_QTY + "</td>\
                                            <td class=\"align-middle col-1\">" + bookingAll[i].TOTAL_PRICE + "</td>\
                                            <td class=\"align-middle col-1\"><button type='button' class='editBooking btn btn-primary' data-bs-toggle='modal' data-bs-target='#editBooking' value=" + i + ">View</button></td>\
                                        </tr>")
                            numcount++;
                        }
                    }
                }
                else
                {
                    $("#bookingList").empty();
                    for (let i = 0; i < bookingAll.length; i++) 
                    {
                        $("#bookingList").append("\
                                            <tr class=\"text-center\">\
                                                <td class=\"align-middle col-1\">" + (i+1) + "</td>\
                                                <td class=\"align-middle col-1\">" + bookingAll[i].CHECK_IN + "</td>\
                                                <td class=\"align-middle col-1\">" + bookingAll[i].CHECK_OUT + "</td>\
                                                <td class=\"align-middle col-2\">" + bookingAll[i].BOOK_BY + "</td>\
                                                <td class=\"align-middle col-2\">" + bookingAll[i].BOOKER_PHONE + "</td>\
                                                <td class=\"align-middle col-1\">" + bookingAll[i].BOOK_QTY + "</td>\
                                                <td class=\"align-middle col-1\">" + bookingAll[i].TOTAL_PRICE + "</td>\
                                                <td class=\"align-middle col-1\"><button type='button' class='editBooking btn btn-primary' data-bs-toggle='modal' data-bs-target='#editBooking' value=" + i + ">View</button></td>\
                                            </tr>")
                    }
                }
            });

            $("#searchDateCheckin").on('change', function()
            {
                if ($("#searchDateCheckin").val() != "") 
                {
                    tempDate = new Date( new Date($("#searchDateCheckin").val()).getTime() + (1000 * 60 * 60 * 24)).toISOString().substring(0, 10) 
                    $("#searchDateCheckout").attr('min', tempDate );
                } 
                else 
                {
                    $("#searchDateCheckout").attr('min', null);
                }
            });

            $("#searchDateCheckout").on('change', function()
            {
                if ($("#searchDateCheckout").val() != "") 
                {
                    tempDate = new Date( new Date($("#searchDateCheckout").val()).getTime() - (1000 * 60 * 60 * 24)).toISOString().substring(0, 10) 
                    console.log(tempDate)
                    $("#searchDateCheckin").attr('max', tempDate);
                }
                else
                {
                    $("#searchDateCheckin").attr('max', null);
                }
            });

        //console log data
            console.log("bookingAll")
            console.log(bookingAll)
            console.log("rtypeWithCountList")
            console.log(rtypeWithCountList)
            console.log("rtypeAvbInFloor")
            console.log(rtypeAvbInFloor)
            console.log("baseroomInFloorWithStatus")
            console.log(baseroomInFloorWithStatus)
            console.log("rtypeWithPrice")
            console.log(rtypeWithPrice)
            console.log("floorListAll")
            console.log(floorListAll)
        

        //setup selections

            var floorSelectionHtml = "";
            $("#floorSelection").empty();
            $("#floorSelectionMap").empty();
            for (let i = 0; i < floorListAll.length; i++) 
            {
                floorSelectionHtml = floorSelectionHtml + "<option value='" + floorListAll[i].NAME + "," + floorListAll[i].ID + "," + i + "'>" + floorListAll[i].NAME + "</option>";
            }
            $("#floorSelection").html(floorSelectionHtml);
            $("#floorSelectionMap").html(floorSelectionHtml);
            VirtualSelect.init({
                ele: '#floorSelection',
            });
            VirtualSelect.init({
                ele: '#floorSelectionMap',
            });

            var paymentMethodHtml = "";
            $("#paymentSelection").empty();
            for (let i = 0; i < paymentMethod.length; i++) 
            {
                paymentMethodHtml = paymentMethodHtml + "<option value='" + paymentMethod[i].NAME + "," + paymentMethod[i].ID + "," + i + "'>" + paymentMethod[i].NAME + "</option>";
            }
            $("#paymentSelection").html(paymentMethodHtml);
            var paymentMethodEditHtml = "";
            for (let i = 0; i < paymentMethod.length; i++) 
            {
                paymentMethodEditHtml = paymentMethodEditHtml + "<option value='" + paymentMethod[i].NAME + "," + paymentMethod[i].ID + "'>" + paymentMethod[i].NAME + "</option>";
            }
            $("#paymentSelectionEdit").html(paymentMethodEditHtml);
            VirtualSelect.init({
                ele: '#paymentSelection',
            });
            VirtualSelect.init({
                ele: '#paymentSelectionEdit',
            });
            document.querySelector('#paymentSelection').setValue("");
            document.querySelector('#paymentSelectionEdit').setValue("");

        //list booking

            for (let i = 0; i < bookingAll.length; i++) 
            {
                $("#bookingList").append("\
                                    <tr class=\"text-center\">\
                                        <td class=\"align-middle col-1\">" + (i+1) + "</td>\
                                        <td class=\"align-middle col-1\">" + bookingAll[i].CHECK_IN + "</td>\
                                        <td class=\"align-middle col-1\">" + bookingAll[i].CHECK_OUT + "</td>\
                                        <td class=\"align-middle col-2\">" + bookingAll[i].BOOK_BY + "</td>\
                                        <td class=\"align-middle col-2\">" + bookingAll[i].BOOKER_PHONE + "</td>\
                                        <td class=\"align-middle col-1\">" + bookingAll[i].BOOK_QTY + "</td>\
                                        <td class=\"align-middle col-1\">" + bookingAll[i].TOTAL_PRICE + "</td>\
                                        <td class=\"align-middle col-1\"><button type='button' class='editBooking btn btn-primary' data-bs-toggle='modal' data-bs-target='#editBooking' value=" + i + ">View</button></td>\
                                    </tr>")
            }

        //no booking if empty logic

            $("#addBtn").on('click', function()
            {
                $(".loading").modal('toggle');
                flag = true, tempFloor = "", tempRoom = "", status = "";
                
                for (let i = 0; i < floorListAll.length; i++) 
                {
                    if (floorListAll[i].ROOM == null) 
                    {
                        status = "no room";
                        tempFloor = floorListAll[i].NAME;
                        flag = false;
                        break;
                    }
                    lengroom = floorListAll[i].ROOM.split(",").length;
                    if (floorListAll[i].ROOM_MAP != null) 
                    {
                        lengmap = floorListAll[i].ROOM_MAP.split(",").length;
                    }
                    else
                    {
                        lengmap = 0;
                    }
                    if (floorListAll[i].ROOM != null && (lengroom != floorListAll[i].QTY || lengmap != floorListAll[i].QTY)) 
                    {

                        status = "no room";
                        tempFloor = floorListAll[i].NAME;
                        flag = false;
                        break;
                    }
                }
                if (flag) 
                {
                    for (let i = 0; i < rtypeWithPrice.length; i++) 
                    {
                        if (rtypeWithPrice[i].PRICE_ID == null) 
                        {
                            status = "no price";
                            console.log(rtypeWithPrice[i])
                            tempRoom = rtypeWithPrice[i].NAME;
                            flag = false;
                            break;
                        }
                    }
                }
                if (flag) 
                {
                    go = true;
                    for (let i = 0; i < baseroomInFloorWithStatus.length; i++) 
                    {
                        temp = baseroomInFloorWithStatus[i].RTYPE_SELECT.split(',')
                        for (let j = 0; j < temp.length; j++) 
                        {
                            if (temp[j] == '-') 
                            {
                                tempFloor = baseroomInFloorWithStatus[i].NAME;
                                status = "no rtype"
                                flag = false;
                                go = false;
                                break;
                            }
                        }
                        if (!go) 
                        {
                            break;
                        }
                    }
                }
                if (!flag) 
                {
                    if (status == "no price") 
                    {
                        alert("<?= Yii::t('app', 'There are no price assigned to room type') ?> " + tempRoom )
                    }
                    else if (status == "no room")
                    {
                        alert("<?= Yii::t('app', 'There are room with missing detail at floor') ?> " + tempFloor)
                    }
                    else if (status == "no rtype")
                    {
                        alert("<?= Yii::t('app', 'There are room with no room type at floor') ?> " + tempFloor)
                    }
                }
                else
                {
                    $("#formAddBookingDetail").removeClass('was-validated');
                    $("#formAddDetail").modal('toggle');
                    $("#name").val("");
                    $("#phone").val("");
                    $("#checkinDate").val("");
                    $("#checkoutDate").val("");
                    $("#roomQty").val("");
                    $("#rtypeSelect").empty();
                    var date = new Date().toISOString().substring(0, 10);
                    $("#checkinDate").attr('min', date );
                    $("#checkinDate").attr('max', null);
                    var date = new Date( new Date().getTime() + (1000 * 60 * 60 * 24) ).toISOString().substring(0, 10);
                    $("#checkoutDate").attr('min', date );
                }
                $(".loading").modal('toggle');
            });

        //date logic
            var date = new Date().toISOString().substring(0, 10);
            $("#checkinDate").attr('min', date );
            var date = new Date( new Date().getTime() + (1000 * 60 * 60 * 24) ).toISOString().substring(0, 10);
            $("#checkoutDate").attr('min', date );

            $("#checkinDate").on('change', function()
            {
                tempDate = new Date( new Date($("#checkinDate").val()).getTime() + (1000 * 60 * 60 * 24)).toISOString().substring(0, 10) 
                $("#checkoutDate").attr('min', tempDate );
            });

            $("#checkoutDate").on('change', function()
            {
                tempDate = new Date( new Date($("#checkoutDate").val()).getTime() - (1000 * 60 * 60 * 24)).toISOString().substring(0, 10) 
                $("#checkinDate").attr('max', tempDate );
            });

            $(":input[type='date']").on("focus", function(e) 
            {
                $(this).prop("readonly", true);             
            });

            $(":input[type='date']").on("blur", function() {
                $(this).prop("readonly", false);
            });

        //number only logic

            $(":input[type='numeric']").keypress("click",function(e) 
            {    
                var charCode = (e.which) ? e.which : event.keyCode    
                if (String.fromCharCode(charCode).match(/[^0-9]/g))  
                {
                    return false;                        
                }  
            });

            $("#roomList").on("keypress", ":input[type='numeric']", function(e) 
            {    
                var charCode = (e.which) ? e.which : event.keyCode    
                if (String.fromCharCode(charCode).match(/[^0-9]/g))  
                {
                    return false;                        
                }  
            });

            $("#rtypeSelect").on("keypress", ":input[type='numeric']", function(e) 
            {    
                var charCode = (e.which) ? e.which : event.keyCode    
                if (String.fromCharCode(charCode).match(/[^0-9]/g))  
                {
                    return false;                        
                }  
            });

        //room type select show
        
            $("#roomQty").on('input', function()
            {
                $("#rtypeSelect").empty();
                $("#rtypeSelect").append("<button type=\"button\" class=\"btn btn-primary mt-3 viewDetailAvb\" data-bs-toggle=\"modal\" data-bs-target=\"#detailAvb\"><?= Yii::t('app', 'View Detail') ?></button>")
                for (let i = 0; i < rtypeWithCountList.length; i++) 
                {
                    $("#rtypeSelect").append("\
                                        <div>\
                                            <label for=\"" + rtypeWithCountList[i].NAME + "Qty\" class=\"form-label pt-3\">" + rtypeWithCountList[i].NAME + " <?= Yii::t('app', 'Room Quantity') ?> Max : " + rtypeWithCountList[i].AVB + "</label>\
                                            <input type=\"numeric\" class=\"form-control\" id=\"" + rtypeWithCountList[i].NAME.replace(" ", "_") + "Qty\" placeholder=\"<?= Yii::t('app', 'Enter Room Quantity') ?>\">\
                                            <div class=\"invalid-feedback\"><?= Yii::t('app', 'Please input the number of rooms to book.') ?></div>\
                                            <div class=\"valid-feedback\"></div>\
                                        </div>");
                    $("#"+ rtypeWithCountList[i].NAME.replace(" ", "_") + "Qty").val(0)
                }
                
            });

        //view detail avb
            
            $("#rtypeSelect").on("click", ".viewDetailAvb", function()
            {
                $("#avbList").empty();
                for (let i = 0; i < rtypeAvbInFloor.length; i++)
                {
                    $("#avbList").append("\
                                    <tr class=\"text-center\">\
                                        <td class=\"align-middle col-1\">" + (i+1) + "</td>\
                                        <td class=\"align-middle col-1\">" + rtypeAvbInFloor[i].FLOOR_NAME + "</td>\
                                        <td class=\"align-middle col-1\">" + rtypeAvbInFloor[i].NAME + "</td>\
                                        <td class=\"align-middle col-2\">" + rtypeAvbInFloor[i].ROOM_AVB + "</td>\
                                        <td class=\"align-middle col-2\">" + rtypeAvbInFloor[i].REGULAR_PRICE + "</td>\
                                        <td class=\"align-middle col-2\">" + rtypeAvbInFloor[i].HOLIDAY_PRICE + "</td>\
                                        <td class=\"align-middle col-2\">" + rtypeAvbInFloor[i].BREAK_PRICE + "</td>\
                                        <td class=\"align-middle col-2\">" + rtypeAvbInFloor[i].BREAKFAST_PRICE + "</td>\
                                        <td class=\"align-middle col-2\">" + rtypeAvbInFloor[i].LUNCH_PRICE + "</td>\
                                        <td class=\"align-middle col-2\">" + rtypeAvbInFloor[i].DINNER_PRICE + "</td>\
                                    </tr>")
                }
            });
            

        //submitAddBookingDetail logic

            $("#submitAddBookingDetail").on('click', function()
            {
                tempQty = 0, totalQty = 0;
                if ($("#name").val() == "" || $("#phone").val() == "" || $("#checkinDate").val() == "" || $("#checkoutDate").val() == "" || $("#roomQty").val() == "" || $("#pax").val() == "" ) 
                {
                    $("#formAddBookingDetail").addClass('was-validated')
                    alert('<?= Yii::t('app', 'All input must be filled!') ?>');
                } 
                else if ($("#name").val().length > 256 ) 
                {
                    alert('<?= Yii::t('app', 'Input too long! Max: 256 Char') ?>');
                }
                else if ($("#phone").val().length > 12 ) 
                {
                    alert('<?= Yii::t('app', 'Input too long! Max: 12 Numbers') ?>');
                }
                else
                {
                    flag = true;
                    selectedRtype = [];
                    for (let i = 0; i < rtypeWithCountList.length; i++) 
                    {
                        num = $("#"+ rtypeWithCountList[i].NAME.replace(" ", "_") + "Qty").val() == "" ? 0 : parseInt($("#"+ rtypeWithCountList[i].NAME.replace(" ", "_") + "Qty").val());
                        tempQty = tempQty + num;
                        totalQty = totalQty + parseInt(rtypeWithCountList[i].AVB);
                        for (let j = 0; j < num; j++) {
                            selectedRtype.push(rtypeWithCountList[i].NAME)
                        }
                        if (num > rtypeWithCountList[i].AVB) 
                        {
                           alert(rtypeWithCountList[i].NAME + '<?= Yii::t('app', ' room quantity exceeded the amount of rooms available') ?>');
                           flag = false;
                           break;
                        }
                    }
                    if (tempQty > $("#roomQty").val() && flag)
                    {
                        alert('<?= Yii::t('app', 'The sum of room inputted in each room type exceeded the amount of rooms booked') ?>');
                    }
                    else if ($("#roomQty").val() > tempQty && flag)
                    {
                        alert('<?= Yii::t('app', 'The sum of room inputted in each room type is below the amount of rooms booked') ?>');
                    }
                    else if (totalQty < $("#roomQty").val() && flag)
                    {
                        alert('<?= Yii::t('app', 'Total room booked exceeded the total room available in this hotel') ?>');
                    }
                    else if (flag)
                    {
                        searchFloorCanHoldAll();
                        continueToBookingRoom();
                    }
                }
            });

            function continueToBookingRoom() 
            {
                for (let i = 0; i < floorListAll.length; i++) 
                {
                    if (floorListAll[i].NAME == floorForMap[0] && floorForMap[1] == floorListAll[i].ID) 
                    {
                        document.querySelector('#floorSelection').setValue( floorForMap[0] + "," + floorForMap[1] + "," + i);
                    }
                }
                $("#roomList").empty();
                roomIndexInArr = 0;
                for (let i = 0; i < $("#roomQty").val(); i++) 
                {
                    if (roomtypeselected != undefined) 
                    {
                        for (let j = 0; j < roomtypeselected.length; j++) 
                        {
                            if (selectedRtype[i] == roomtypeselected[j]) 
                            {
                                roomIndexInArr = j;
                                roomtypeselected[j] = 'abc';
                                break;
                            }
                        }
                    }
                    else
                    {
                        roomIndexInArr = i;
                    }
                    $("#roomList").append("\
                                    <div class=\"border border-4 border-dark rounded mt-2 p-3\">\
                                        <label for=\"roomType" + (i+1) + "\" class=\"form-label \"><?= Yii::t('app', 'Room Type') ?> " + (i+1) + "</label>\
                                        <input type=\"text\" class=\"form-control\" id=\"roomType" + (i+1) + "\" disabled value=\"Deluxe\">\
                                        <label for=\"selectedRoom" + (i+1) + "\" class=\"form-label pt-2\"><?= Yii::t('app', 'Selected Room') ?> " + (i+1) + "</label>\
                                        <div class=\"d-grid\">\
                                            <button type=\"button\" class=\"btn btn-primary rtypeBtn\" data-bs-toggle=\"modal\" data-bs-target=\"#formRoomSelect\" id=\"selectedRoom" + (i+1) + "\" value=\"" + selectedRtype[i] + ',' + roomIndexInArr + "\"><?= Yii::t('app', 'Select Room') ?></button>\
                                        </div>\
                                        <label for=\"breakQty" + roomIndexInArr + "\" class=\"form-label pt-2\"><?= Yii::t('app', 'Coffee Break Quantity') ?></label>\
                                        <input type=\"numeric\" class=\"form-control\" id=\"breakQty" +  roomIndexInArr + "\" placeholder=\"<?= Yii::t('app', 'Enter Coffee Break Quantity') ?>\">\
                                        <label for=\"breakfastQty" + roomIndexInArr +  "\" class=\"form-label pt-2\"><?= Yii::t('app', 'Breakfast Quantity') ?></label>\
                                        <input type=\"numeric\" class=\"form-control\" id=\"breakfastQty" +  roomIndexInArr + "\" placeholder=\"<?= Yii::t('app', 'Enter Breakfast Quantity') ?>\">\
                                        <label for=\"lunchQty" + roomIndexInArr + "\" class=\"form-label pt-2\"><?= Yii::t('app', 'Lunch Quantity') ?></label>\
                                        <input type=\"numeric\" class=\"form-control\" id=\"lunchQty" +  roomIndexInArr + "\" placeholder=\"<?= Yii::t('app', 'Enter Lunch Quantity') ?>\">\
                                        <label for=\"dinnerQty" + roomIndexInArr +  "\" class=\"form-label pt-2\"><?= Yii::t('app', 'Dinner Quantity') ?></label>\
                                        <input type=\"numeric\" class=\"form-control\" id=\"dinnerQty" +  roomIndexInArr + "\" placeholder=\"<?= Yii::t('app', 'Enter Dinner Quantity') ?>\">\
                                    </div>\
                                ");
                    $("#roomType" + (i+1)).val(selectedRtype[i]);
                    $("#breakQty" +  roomIndexInArr).val(0);
                    $("#breakfastQty" +  roomIndexInArr).val(0);
                    $("#lunchQty" +  roomIndexInArr).val(0);
                    $("#dinnerQty" +  roomIndexInArr).val(0);
                }
                $("#formAddDetail").modal('toggle');
                $("#formAddRoom").modal('toggle');
            }

        //submitAddBookingRoom logic

            $("#continueBtnFromRSelect").on('click', function()
            {
                setFloorMapMainMenu();
            });

            $("#floorSelection").on('change', function()
            {
                setFloorMapMainMenu();
            });

            $("#roomList").on('click', '.rtypeBtn', function()
            {
                temp = $(this).attr('value').split(',');
                selectingRoom = temp[0];
                currentSelect = temp[1];
                floorSelectionMapHtml = "";
                temp = [];
                for (let i = 0; i < roomInFloorWithStatus.length; i++) 
                {
                    rName = roomInFloorWithStatus[i].ROOM.split(',');
                    rType = roomInFloorWithStatus[i].RTYPE_SELECT.split(',');
                    rStatus = roomInFloorWithStatus[i].ROOM_STATUS.split(',');
                    floorSel = 0;
                    for (let j = 0; j < rName.length; j++) 
                    {
                        if (rType[j] == selectingRoom && rStatus[j] == 'selected' && roomselected[currentSelect] == rName[j]) 
                        {
                            temp.push(floorListAll[i].NAME)
                            temp.push(floorListAll[i].ID)
                            temp.push(i)
                        }
                    }
                }
                document.querySelector("#floorSelectionMap").setValue(temp[0] + "," + temp[1] + "," + temp[2])
                setFloorMap();
            });

            $("#floorSelectionMap").on('change', function()
            {
                setFloorMap();
            });

            $("#chooseRoom").on('click', '.roomAvbMap', function()
            {
                temp = $(this).attr('id').split(',');
                tempVal = $("#floorSelectionMap").val().split(',');
                selector = tempVal[2];
                for (let j = 0; j < floorListAll.length; j++) 
                {
                    rnameStr='', rtypeStr='', rstatusStr='';
                    if (floorListAll[j] != undefined) 
                    {
                        rName = roomInFloorWithStatus[j].ROOM.split(',');
                        rType = roomInFloorWithStatus[j].RTYPE_SELECT.split(',');
                        rStatus = roomInFloorWithStatus[j].ROOM_STATUS.split(',');
                        for (let i = 0; i < rName.length; i++) 
                        {
                            if (temp[0] == rName[i] && temp[1] == rType[i])
                            {
                                rStatus[i] = 'selected';
                            }
                            else if (roomselected[currentSelect] == rName[i])
                            {
                                roomselected[currentSelect] = temp[0];
                                rStatus[i] = 'available';
                            }
                            else
                            {
                                rStatus[i] = rStatus[i];
                            }
                            rnameStr = rnameStr + rName[i];
                            rtypeStr = rtypeStr + rType[i];
                            rstatusStr = rstatusStr + rStatus[i];
                            if ((i+1) != rName.length) 
                            {
                                rnameStr = rnameStr + ',';
                                rtypeStr = rtypeStr + ',';
                                rstatusStr = rstatusStr + ',';
                            }
                        }
                        roomInFloorWithStatus[j].ROOM = rnameStr;
                        roomInFloorWithStatus[j].RTYPE_SELECT = rtypeStr;
                        roomInFloorWithStatus[j].ROOM_STATUS = rstatusStr;
                    }
                }
                $("#roomSelected").empty();
                $("#roomSelected").append("\
                                    <div class=\"border border-4 border-dark rounded mt-2 p-3\">\
                                        <label for=\"roomType\" class=\"form-label \"><?= Yii::t('app', 'Room Type') ?></label>\
                                        <input type=\"text\" class=\"form-control\" id=\"roomType\" disabled value=\"Deluxe\">\
                                        <label for=\"roomName\" class=\"form-label pt-2\"><?= Yii::t('app', 'Room Name') ?></label>\
                                        <input type=\"text\" class=\"form-control\" id=\"roomName\" disabled>\
                                    </div>\
                                ");
                $("#roomType").val(temp[1])
                $("#roomName").val(temp[0])
                setFloorMap();
            });

            function setFloorMapMainMenu()
            {
                $("#floorMap").empty();
                tempVal = $("#floorSelection").val().split(',');
                selector = tempVal[2];
                floorMapHtml = "";
                roomList = "";
                counter = 1;
                if (floorListAll[selector] != undefined) 
                {
                    rName = roomInFloorWithStatus[selector].ROOM.split(',');
                    rType = roomInFloorWithStatus[selector].RTYPE_SELECT.split(',');
                    rStatus = roomInFloorWithStatus[selector].ROOM_STATUS.split(',');
                    for (let i = 0; i < floorListAll[selector].FLOOR_ROW; i++) {
                        temp = "";
                        for (let j = 0; j < floorListAll[selector].FLOOR_COLUMN; j++) 
                        {
                            if (rStatus[(counter-1)] != 'selected') 
                            {
                                temp = temp + "<div id='roomBoxMap'>\
                                                    <p class='textRoom'>Room " + rName[(counter-1)] + "</p>\
                                                    <p class='textRoom'>" + rType[(counter-1)] + "</p>\
                                                </div>"
                            }
                            else if (rStatus[(counter-1)] == 'selected') 
                            {
                                temp = temp + "<div class=\"roomSelectedMap\">\
                                                    <p class='textRoom'>Room " + rName[(counter-1)] + "</p>\
                                                    <p class='textRoom'>" + rType[(counter-1)] + "</p>\
                                                </div>"
                            }
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
                }
            }

            function setFloorMap()
            {
                $("#chooseRoom").empty();
                tempVal = $("#floorSelectionMap").val().split(',');
                selector = tempVal[2];
                floorMapHtml = "";
                roomList = "";
                counter = 1;
                index = "";
                if (floorListAll[selector] != undefined) 
                {
                    rName = roomInFloorWithStatus[selector].ROOM.split(',');
                    rType = roomInFloorWithStatus[selector].RTYPE_SELECT.split(',');
                    rStatus = roomInFloorWithStatus[selector].ROOM_STATUS.split(',');
                    rMap = roomInFloorWithStatus[selector].ROOM_MAP.split(',');
                    for (let i = 0; i < floorListAll[selector].FLOOR_ROW; i++) {
                        temp = "";
                        for (let j = 0; j < floorListAll[selector].FLOOR_COLUMN; j++) 
                        {
                            if ( rType[(counter-1)] == selectingRoom && rStatus[(counter-1)] == 'available' ) 
                            {
                                temp = temp + "<div class='roomAvbMap' id='" + rName[(counter-1)] + "," + rType[(counter-1)] + "," + floorListAll[selector].NAME +  "'>\
                                                    <p class='textRoom'>Room " + rName[(counter-1)] + "</p>\
                                                    <p class='textRoom'>" + rType[(counter-1)] + "</p>\
                                                </div>"
                            }  
                            else if (rType[(counter-1)] == selectingRoom && rStatus[(counter-1)] == 'selected' && roomselected[currentSelect] == rName[(counter-1)]) 
                            {
                                temp = temp + "<div class='roomSelectedMap'>\
                                                    <p class='textRoom'>Room " + rName[(counter-1)] + "</p>\
                                                    <p class='textRoom'>" + rType[(counter-1)] + "</p>\
                                                </div>"
                                
                                index = rMap[(counter-1)];
                            }
                            else if ( rStatus[(counter-1)] == 'selected')
                            {
                                temp = temp + "<div class='roomShadowSelectedMap'>\
                                                    <p class='textRoom'>Room " + rName[(counter-1)] + "</p>\
                                                    <p class='textRoom'>" + rType[(counter-1)] + "</p>\
                                                </div>"
                            }
                            else 
                            {
                                temp = temp + "<div class='roomNAvbMap'>\
                                                    <p class='textRoom'>Room " + rName[(counter-1)] + "</p>\
                                                    <p class='textRoom'>" + rType[(counter-1)] + "</p>\
                                                </div>"
                            }
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
                    $("#chooseRoom").html(floorMapHtml);
                }
                $("#roomSelected").empty();
                if (index == "")
                {
                    $("#roomSelected").append("\
                                        <div class=\"border border-4 border-dark rounded mt-2 p-3\">\
                                            <label for=\"roomType\" class=\"form-label \"><?= Yii::t('app', 'Room Type') ?></label>\
                                            <input type=\"text\" class=\"form-control\" id=\"roomType\" disabled >\
                                            <label for=\"roomName\" class=\"form-label pt-2\"><?= Yii::t('app', 'Room Name') ?></label>\
                                            <input type=\"text\" class=\"form-control\" id=\"roomName\" disabled>\
                                        </div>\
                                        ");
                }
                else
                {
                    $("#roomSelected").append("\
                                        <div class=\"border border-4 border-dark rounded mt-2 p-3\">\
                                            <label for=\"roomType\" class=\"form-label \"><?= Yii::t('app', 'Room Type') ?></label>\
                                            <input type=\"text\" class=\"form-control\" id=\"roomType\" disabled >\
                                            <label for=\"roomName\" class=\"form-label pt-2\"><?= Yii::t('app', 'Room Name') ?></label>\
                                            <input type=\"text\" class=\"form-control\" id=\"roomName\" disabled>\
                                            <div class='imgContainer pt-2 justify-content-center'>\
                                                <img class='imgRoomMap' src='../../web/images/" + index + "'>\
                                            </div>\
                                        </div>\
                                    ");
                }
                $("#roomType").val(selectingRoom)
                if (roomselected != undefined) 
                {
                    $("#roomName").val(roomselected[currentSelect])
                }
            }

            $("#submitAddBookingRoom").on('click', function() 
            {
                selectedRoomId = [], breakArr = [], breakfastArr = [], lunchArr = [], dinnerArr = [], priceArr = [], totalPrice = 0; 
                checkin = new Date($("#checkinDate").val());
                checkout = new Date($("#checkoutDate").val());
                hari = checkout.getTime() - checkin.getTime();
                hari = Math.abs( hari / (1000 * 60 * 60 * 24));
                checkin = checkin.getDate() + "-" + monthNames[checkin.getMonth()] + "-" + checkin.getFullYear();
                checkout = checkout.getDate() + "-" + monthNames[checkout.getMonth()] + "-" + checkout.getFullYear();
                $("#bookerNameText").html("<?= Yii::t('app', 'Booker Name') ?> : " + $("#name").val());
                $("#bookerPhoneText").html("<?= Yii::t('app', 'Booker Phone') ?> : " + $("#phone").val());
                $("#checkInText").html("<?= Yii::t('app', 'Check In') ?> : " + checkin);
                $("#checkOutText").html("<?= Yii::t('app', 'Check Out') ?> : " + checkout);
                $("#roomQtyText").html("<?= Yii::t('app', 'Room Qty') ?> : " + $("#roomQty").val());
                $("#roomListSummary").empty();
                if (floorselected != undefined) 
                {
                    select = 0;
                    for (let i = 0; i < roomInFloorWithStatus.length; i++) 
                    {
                        if (roomInFloorWithStatus[i].ID == floorselected[select]) 
                        {
                            rId = roomInFloorWithStatus[i].ROOM_ID.split(',');
                            rName = roomInFloorWithStatus[i].ROOM.split(',');
                            rType = roomInFloorWithStatus[i].RTYPE_SELECT.split(',');
                            rTypeId = roomInFloorWithStatus[i].RTYPE_SELECT_ID.split(','); 
                            rStatus = roomInFloorWithStatus[i].ROOM_STATUS.split(',');
                            for (let j = 0; j < rName.length; j++) 
                            {
                                if (rStatus[j] == 'selected') 
                                {
                                    indexFacility = 0;
                                    for (let k = 0; k < rtypeFacility.length; k++) 
                                    {
                                        if (rtypeFacility[k].ID == rTypeId[j] && rtypeFacility[k].NAME == rType[j]) 
                                        {
                                            indexFacility = k;
                                            break;
                                        }
                                    }
                                    cbreak = 0, breakfast = 0, lunch = 0, dinner = 0;
                                    for (let k = 0; k < $("#roomQty").val(); k++) 
                                    { 
                                        temp = $("#selectedRoom" + (k+1)).attr('value').split(',');
                                        selector = temp[1];
                                        if (roomselected[selector]  == rName[j])      
                                        {
                                            if ($("#breakQty"+selector).val() != "") 
                                            {
                                                cbreak = parseInt($("#breakQty"+selector).val());
                                            }
                                            else
                                            {
                                                cbreak = 0;
                                            }
                                            if ($("#breakfastQty"+selector).val() != "") 
                                            {
                                                breakfast = parseInt($("#breakfastQty"+selector).val());
                                            }
                                            else
                                            {
                                                breakfast = 0;
                                            }
                                            if ($("#lunchQty"+selector).val() != "") 
                                            {
                                                lunch = parseInt($("#lunchQty"+selector).val());
                                            }
                                            else
                                            {
                                                lunch = 0;
                                            }
                                            if ($("#dinnerQty"+selector).val() != "") 
                                            {
                                                dinner = parseInt($("#dinnerQty"+selector).val());
                                            }
                                            else
                                            {
                                                dinner = 0;
                                            }
                                        }                                   
                                    }
                                    price = 0, breakprice = "", breakfastprice = "", lunchprice = "",dinnerprice = "", holiday = 0, normal = 0, holidayprice = "", normalprice = "";
                                    for (let k = 0; k < rtypeWithPrice.length; k++) 
                                    {
                                        if ( rtypeWithPrice[k].NAME == rType[j] && rtypeWithPrice[k].ID == rTypeId[j] ) 
                                        {
                                            breakprice = cbreak + " x " + rtypeWithPrice[k].BREAK_PRICE + " = " + (cbreak * rtypeWithPrice[k].BREAK_PRICE);
                                            breakfastprice = breakfast + " x " + rtypeWithPrice[k].BREAKFAST_PRICE + " = " + (breakfast * rtypeWithPrice[k].BREAKFAST_PRICE);
                                            lunchprice = lunch + " x " + rtypeWithPrice[k].LUNCH_PRICE + " = " + (lunch * rtypeWithPrice[k].LUNCH_PRICE);
                                            dinnerprice = dinner + " x " + rtypeWithPrice[k].DINNER_PRICE + " = " + (dinner * rtypeWithPrice[k].DINNER_PRICE);
                                            price = price + (cbreak * rtypeWithPrice[k].BREAK_PRICE);
                                            price = price + (breakfast * rtypeWithPrice[k].BREAKFAST_PRICE);
                                            price = price + (lunch * rtypeWithPrice[k].LUNCH_PRICE);
                                            price = price + (dinner * rtypeWithPrice[k].DINNER_PRICE);
                                            for (let l = 0; l < hari; l++) 
                                            {
                                                jumlah = new Date($("#checkinDate").val()).getDay() + l;
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
                                    totalPrice = totalPrice + price;
                                    selectedRoomId.push(rId[j]);
                                    priceArr.push(price);
                                    breakArr.push(cbreak);
                                    lunchArr.push(lunch);
                                    dinnerArr.push(dinner);
                                    breakfastArr.push(breakfast);
                                    $("#roomListSummary").append("\
                                            <div class=\"border border-4 border-dark rounded mt-2 p-3\">\
                                                <div><?= Yii::t('app', 'Room Name') ?>  : " + rName[j] + "</div>\
                                                <div><?= Yii::t('app', 'Floor') ?> : " + roomInFloorWithStatus[i].NAME +  "</div>\
                                                <div><?= Yii::t('app', 'Room Type') ?> : " + rType[j] + " </div>\
                                                <div><?= Yii::t('app', 'Room Facility') ?> : " + (rtypeFacility[indexFacility].FACILITY_NAME == null ? '<?= Yii::t('app', 'No Facility') ?>': rtypeFacility[indexFacility].FACILITY_NAME) + "</div>\
                                                <div><?= Yii::t('app', 'Aditional') ?> : " + cbreak + " <?= Yii::t('app', 'coffee break') ?>, " + breakfast + " <?= Yii::t('app', 'breakfast') ?>, " + lunch + " <?= Yii::t('app', 'lunch') ?>, " + dinner + " <?= Yii::t('app', 'dinner') ?> </div>\
                                                <div><?= Yii::t('app', 'Price') ?> : IDR " + price + " </div>\
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
                            }
                            select++;
                        }
                    }
                }
                else
                {
                    for (let i = 0; i < roomInFloorWithStatus.length; i++) 
                    {
                        if (roomInFloorWithStatus[i].ID == floorIdAuto) 
                        {
                            rId = roomInFloorWithStatus[i].ROOM_ID.split(',');
                            rName = roomInFloorWithStatus[i].ROOM.split(',');
                            rType = roomInFloorWithStatus[i].RTYPE_SELECT.split(',');
                            rTypeId = roomInFloorWithStatus[i].RTYPE_SELECT_ID.split(',');
                            rStatus = roomInFloorWithStatus[i].ROOM_STATUS.split(',');
                            for (let j = 0; j < rName.length; j++) 
                            {
                                if (rStatus[j] == 'selected') 
                                {
                                    indexFacility = 0;
                                    for (let k = 0; k < rtypeFacility.length; k++) 
                                    {
                                        if (rtypeFacility[k].ID == rTypeId[j] && rtypeFacility[k].NAME == rType[j]) 
                                        {
                                            indexFacility = k;
                                            break;
                                        }
                                    }
                                    cbreak = 0, breakfast = 0, lunch = 0, dinner = 0;
                                    for (let k = 0; k < $("#roomQty").val(); k++) 
                                    { 
                                        temp = $("#selectedRoom" + (k+1)).attr('value').split(',');
                                        selector = temp[1];
                                        if (roomselected[selector]  == rName[j])      
                                        {
                                            if ($("#breakQty"+selector).val() != "") 
                                            {
                                                cbreak = parseInt($("#breakQty"+selector).val());
                                            }
                                            else
                                            {
                                                cbreak = 0;
                                            }
                                            if ($("#breakfastQty"+selector).val() != "") 
                                            {
                                                breakfast = parseInt($("#breakfastQty"+selector).val());
                                            }
                                            else
                                            {
                                                breakfast = 0;
                                            }
                                            if ($("#lunchQty"+selector).val() != "") 
                                            {
                                                lunch = parseInt($("#lunchQty"+selector).val());
                                            }
                                            else
                                            {
                                                lunch = 0;
                                            }
                                            if ($("#dinnerQty"+selector).val() != "") 
                                            {
                                                dinner = parseInt($("#dinnerQty"+selector).val());
                                            }
                                            else
                                            {
                                                dinner = 0;
                                            }
                                        }                                   
                                    }
                                    price = 0, breakprice = "", breakfastprice = "", lunchprice = "",dinnerprice = "", holiday = 0, normal = 0, holidayprice = "", normalprice = "";
                                    for (let k = 0; k < rtypeWithPrice.length; k++) 
                                    {
                                        if ( rtypeWithPrice[k].NAME == rType[j] && rtypeWithPrice[k].ID == rTypeId[j] ) 
                                        {
                                            breakprice = cbreak + " x " + rtypeWithPrice[k].BREAK_PRICE + " = " + (cbreak * rtypeWithPrice[k].BREAK_PRICE);
                                            breakfastprice = breakfast + " x " + rtypeWithPrice[k].BREAKFAST_PRICE + " = " + (breakfast * rtypeWithPrice[k].BREAKFAST_PRICE);
                                            lunchprice = lunch + " x " + rtypeWithPrice[k].LUNCH_PRICE + " = " + (lunch * rtypeWithPrice[k].LUNCH_PRICE);
                                            dinnerprice = dinner + " x " + rtypeWithPrice[k].DINNER_PRICE + " = " + (dinner * rtypeWithPrice[k].DINNER_PRICE);
                                            price = price + (cbreak * rtypeWithPrice[k].BREAK_PRICE);
                                            price = price + (breakfast * rtypeWithPrice[k].BREAKFAST_PRICE);
                                            price = price + (lunch * rtypeWithPrice[k].LUNCH_PRICE);
                                            price = price + (dinner * rtypeWithPrice[k].DINNER_PRICE);
                                            for (let l = 0; l < hari; l++) 
                                            {
                                                jumlah = new Date($("#checkinDate").val()).getDay() + l;
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
                                    totalPrice = totalPrice + price;
                                    selectedRoomId.push(rId[j]);
                                    priceArr.push(price);
                                    breakArr.push(cbreak);
                                    lunchArr.push(lunch);
                                    dinnerArr.push(dinner);
                                    breakfastArr.push(breakfast);
                                    $("#roomListSummary").append("\
                                            <div class=\"border border-4 border-dark rounded mt-2 p-3\">\
                                                <div><?= Yii::t('app', 'Room Name') ?>  : " + rName[j] + "</div>\
                                                <div><?= Yii::t('app', 'Floor') ?> : " + roomInFloorWithStatus[i].NAME +  "</div>\
                                                <div><?= Yii::t('app', 'Room Type') ?> : " + rType[j] + " </div>\
                                                <div><?= Yii::t('app', 'Room Facility') ?> : " + (rtypeFacility[indexFacility].FACILITY_NAME == null ? '<?= Yii::t('app', 'No Facility') ?>': rtypeFacility[indexFacility].FACILITY_NAME) + "</div>\
                                                <div><?= Yii::t('app', 'Aditional') ?> : " + cbreak + " <?= Yii::t('app', 'coffee break') ?>, " + breakfast + " <?= Yii::t('app', 'breakfast') ?>, " + lunch + " <?= Yii::t('app', 'lunch') ?>, " + dinner + " <?= Yii::t('app', 'dinner') ?> </div>\
                                                <div><?= Yii::t('app', 'Price') ?> : IDR " + price + " </div>\
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
                                
                            }
                            break;
                        }
                    }
                }      
                $("#totalPriceText").html('<?= Yii::t('app', 'Total Price') ?> : IDR ' + totalPrice);
                $("#formAddRoom").modal('toggle');
                $("#formAddPayment").modal('toggle');
            });

        //logic autofill lantai

            var floorIdAuto = 0;

            function searchFloorCanHoldAll() 
            {
                floorForMap = [];
                roomInFloorWithStatus = [];
                roomInFloorWithStatus = $.extend( true, [], baseroomInFloorWithStatus );
                console.log("baseroomInFloorWithStatus")
                console.log(baseroomInFloorWithStatus)
                console.log("roomInFloorWithStatus")
                console.log(roomInFloorWithStatus)
                countingRtype = 0, totalRoom = 0;
                tempRtype = "";
                rtypeSelect = [], rtypeNeeded = [];
                for (let i = 0; i < selectedRtype.length; i++) 
                {
                    if (i == 0 ) 
                    {
                        tempRtype = selectedRtype[i];
                        rtypeSelect.push(selectedRtype[i]);
                        countingRtype++;
                    }
                    else if (selectedRtype[i] != tempRtype)
                    {
                        tempRtype = selectedRtype[i];
                        rtypeSelect.push(selectedRtype[i])
                        rtypeNeeded.push(countingRtype);
                        countingRtype = 1;
                    }
                    else
                    {
                        countingRtype++;
                    }
                    totalRoom++;
                }
                rtypeNeeded.push(countingRtype);
                get = false;
                for (let i = 0; i < roomInFloorWithStatus.length; i++) 
                {
                    tempNeeded = [];
                    for (let x = 0; x < rtypeNeeded.length; x++) {
                        tempNeeded.push(rtypeNeeded[x])
                    }
                    tempQty = totalRoom;
                    rtypeAvb = roomInFloorWithStatus[i].RTYPE_SELECT.split(',');
                    rtypeStatus = roomInFloorWithStatus[i].ROOM_STATUS.split(',');
                    rtypeRoom = roomInFloorWithStatus[i].ROOM.split(',');
                    tempAvb = rtypeAvb;
                    tempStatus = rtypeStatus;
                    j=0,k=0;
                    roomselected = [];
                    flag = true;
                    while ( flag ) 
                    {
                        if (tempAvb[j] == rtypeSelect[k] && tempStatus[j] == 'available') 
                        {
                            if (tempNeeded[k] > 0) 
                            {
                                tempAvb[j] = 'abc'
                                roomselected.push(rtypeRoom[j]);
                                tempNeeded[k]--;
                                if (j < tempAvb.length-1) 
                                {
                                    j++;
                                }
                                else
                                {
                                    j = 0;
                                }
                            }
                            else
                            {
                                if (k < rtypeSelect.length-1) 
                                {
                                    j = 0;
                                    k++;
                                }
                                else
                                {
                                    get = true;
                                    flag = false;
                                }
                            }
                        }
                        else
                        {
                            if (j < tempAvb.length-1 && tempNeeded[k] > 0) 
                            {
                                j++;
                            }
                            else if (tempNeeded[k] == 0 && k == rtypeSelect.length-1)
                            {
                                get = true;
                                flag = false;
                            }
                            else if (tempNeeded[k] == 0 && k < rtypeSelect.length-1)
                            {
                                j=0;
                                k++;
                            }
                            else 
                            {
                                flag = false;
                            }
                        }
                    }
                    if (get) 
                    {
                        floorIdAuto = roomInFloorWithStatus[i].ID;
                        break;
                    }
                }
                if (get) 
                {
                    rnameStr='', rtypeStr='', rstatusStr='';
                    for (let i = 0; i < roomInFloorWithStatus.length; i++) 
                    {
                        if (roomInFloorWithStatus[i].ID == floorIdAuto) 
                        {
                            rName = roomInFloorWithStatus[i].ROOM.split(',');
                            rType = roomInFloorWithStatus[i].RTYPE_SELECT.split(',');
                            rStatus = roomInFloorWithStatus[i].ROOM_STATUS.split(',');
                            for (let j = 0; j < rName.length; j++) 
                            {
                                for (let k = 0; k < roomselected.length; k++) 
                                {
                                    if (roomselected[k] == rName[j])
                                    {
                                        rStatus[j] = 'selected';
                                        break;
                                    }
                                }
                                rnameStr = rnameStr + rName[j];
                                rtypeStr = rtypeStr + rType[j];
                                rstatusStr = rstatusStr + rStatus[j];
                                if ((j+1) != rName.length) 
                                {
                                    rnameStr = rnameStr + ',';
                                    rtypeStr = rtypeStr + ',';
                                    rstatusStr = rstatusStr + ',';
                                }
                            }
                            roomInFloorWithStatus[i].ROOM = rnameStr;
                            roomInFloorWithStatus[i].RTYPE_SELECT = rtypeStr;
                            roomInFloorWithStatus[i].ROOM_STATUS = rstatusStr;
                            floorForMap.push(roomInFloorWithStatus[i].NAME);
                            floorForMap.push(roomInFloorWithStatus[i].ID);
                            break;
                        }
                    }
                    setFloorMapMainMenu();
                }
                else
                {
                    searchFloorSeperate(); 
                }
            }

            function searchFloorSeperate()
            {
                // setup list kamar dipesen
                    countingRtype = 0, totalRoom = 0;
                    tempRtype = "";
                    rtypeSelect = [], rtypeNeeded = [];
                    for (let i = 0; i < selectedRtype.length; i++) 
                    {
                        if (i == 0 ) 
                        {
                            tempRtype = selectedRtype[i];
                            rtypeSelect.push(selectedRtype[i]);
                            countingRtype++;
                        }
                        else if (selectedRtype[i] != tempRtype)
                        {
                            tempRtype = selectedRtype[i];
                            rtypeSelect.push(selectedRtype[i])
                            rtypeNeeded.push(countingRtype);
                            countingRtype = 1;
                        }
                        else
                        {
                            countingRtype++;
                        }
                        totalRoom++;
                    }
                    rtypeNeeded.push(countingRtype);

                // logic cari kamar
                    jarak = 9999, floorselected = [], roomselected = [], roomtypeselected = [];
                    for (let i = 0; i < roomInFloorWithStatus.length-1; i++) 
                    {
                        tempFloorSelected = [], tempRoomSelected = [], tempRoomTypeSelected = [];
                        tempjarak = 0;
                        tempFloorSelected.push(roomInFloorWithStatus[i].ID);
                        rtypeAvb = roomInFloorWithStatus[i].RTYPE_SELECT.split(',');
                        rtypeStatus = roomInFloorWithStatus[i].ROOM_STATUS.split(',');
                        rtypeRoom = roomInFloorWithStatus[i].ROOM.split(',');
                        tempNeeded = [];
                        for (let x = 0; x < rtypeNeeded.length; x++) 
                        {
                            tempNeeded.push(rtypeNeeded[x])
                        }
                        flag = true;
                        k=0, l=0;
                        tempAvb = rtypeAvb;
                        tempStatus = rtypeStatus;
                        while ( flag ) 
                        {
                            if (tempAvb[l] == rtypeSelect[k] && tempStatus[l] == 'available') 
                            {
                                if (tempNeeded[k] > 0) 
                                {
                                    tempRoomTypeSelected.push(rtypeAvb[l]);
                                    tempAvb[l] = 'abc'
                                    tempRoomSelected.push(rtypeRoom[l]);
                                    tempNeeded[k]--;
                                    l++;
                                }
                                else
                                {
                                    if (k < rtypeSelect.length-1) 
                                    {
                                        l = 0;
                                        k++;
                                    }
                                    else
                                    {
                                        flag = false;
                                    }
                                }
                            }
                            else
                            {
                                if (l < tempAvb.length-1) 
                                {
                                    l++;
                                }
                                else if (tempNeeded[k] == 0)
                                {
                                    flag = false;
                                }
                                else if (l = tempAvb.length-1 && k < rtypeSelect.length-1)
                                {
                                    l = 0;
                                    k++;
                                }
                                else 
                                {
                                    flag = false;
                                }
                            }
                        }
                        done = false;
                        for (let j = i+1; j < roomInFloorWithStatus.length; j++) 
                        {
                            tempjarak++
                            tempFloorSelected.push(roomInFloorWithStatus[j].ID);
                            rtypeAvb = roomInFloorWithStatus[j].RTYPE_SELECT.split(',');
                            rtypeStatus = roomInFloorWithStatus[j].ROOM_STATUS.split(',');
                            rtypeRoom = roomInFloorWithStatus[j].ROOM.split(',');
                            flag = true;
                            k=0, l=0;
                            tempAvb = rtypeAvb;
                            tempStatus = rtypeStatus;
                            while ( flag ) 
                            {
                                if (tempNeeded[k] == 0)
                                {
                                    if (k == rtypeSelect.length-1) 
                                    {
                                        flag = false;
                                        done = true;
                                    }
                                    else 
                                    {
                                        k++;
                                    }
                                }
                                if (tempAvb[l] == rtypeSelect[k] && tempStatus[l] == 'available') 
                                {
                                    if (tempNeeded[k] > 0) 
                                    {
                                        tempRoomTypeSelected.push(rtypeAvb[l]);
                                        tempAvb[l] = 'abc'
                                        tempRoomSelected.push(rtypeRoom[l]);
                                        tempNeeded[k]--;
                                        if (l == tempAvb.length-1 && k < rtypeSelect.length-1)
                                        {
                                            l = 0;
                                            k++;
                                        }
                                        else
                                        {
                                            l++
                                        }
                                    }
                                    else
                                    {
                                        if (k < rtypeSelect.length-1) 
                                        {
                                            l = 0;
                                            k++;
                                        }
                                        else
                                        {
                                            flag = false;
                                        }
                                    }
                                }
                                else
                                {
                                    if (l < tempAvb.length-1) 
                                    {
                                        l++;
                                    }
                                    else if (tempNeeded[k] == 0)
                                    {
                                        flag = false;
                                    }
                                    else if (l = tempAvb.length-1 && k < rtypeSelect.length-1)
                                    {
                                        l = 0;
                                        k++;
                                    }
                                    else 
                                    {
                                        flag = false;
                                    }
                                }
                                for (let m = 0; m < tempNeeded.length; m++) 
                                {
                                    done = true;
                                    if (tempNeeded[m] != 0) {
                                        done = false;
                                        break;
                                    }                                
                                }
                            }
                            if (done) {
                                break;
                            }
                        }
                        if (tempjarak < jarak && tempRoomSelected.length == $("#roomQty").val()) 
                        {
                            floorselected = tempFloorSelected;
                            roomselected = tempRoomSelected;
                            roomtypeselected = tempRoomTypeSelected;
                            jarak = tempjarak;
                            // console.log("roomselected");
                            // console.log(roomselected);
                            // console.log("roomtypeselected");
                            // console.log(roomtypeselected);
                            // console.log("floorselected");
                            // console.log(floorselected);
                            // console.log("jarak");
                            // console.log(jarak);
                        }
                    }

                countFloor = 0;
                tempRoomSelected = [];
                for (let i = 0; i < roomselected.length; i++) {
                    tempRoomSelected.push(roomselected[i])
                }
                for (let i = 0; i < roomInFloorWithStatus.length; i++) 
                {
                    rnameStr = '', rtypeStr = '', rstatusStr = '';
                    if (roomInFloorWithStatus[i].ID == floorselected[countFloor]) 
                    {
                        rName = roomInFloorWithStatus[i].ROOM.split(',');
                        rType = roomInFloorWithStatus[i].RTYPE_SELECT.split(',');
                        rStatus = roomInFloorWithStatus[i].ROOM_STATUS.split(',');
                        for (let j = 0; j < rName.length; j++) 
                        {
                            for (let k = 0; k < tempRoomSelected.length; k++) 
                            {
                                if (tempRoomSelected[k] == rName[j] && rStatus[j] == 'available')
                                {
                                    if (floorForMap.length < 1) 
                                    {
                                        floorForMap.push(roomInFloorWithStatus[i].NAME);
                                        floorForMap.push(roomInFloorWithStatus[i].ID);
                                    }
                                    rStatus[j] = 'selected';
                                    tempRoomSelected[k] = 'null'
                                    break;
                                }
                            }
                            rnameStr = rnameStr + rName[j];
                            rtypeStr = rtypeStr + rType[j];
                            rstatusStr = rstatusStr + rStatus[j];
                            if ((j+1) != rName.length) 
                            {
                                rnameStr = rnameStr + ',';
                                rtypeStr = rtypeStr + ',';
                                rstatusStr = rstatusStr + ',';
                            }
                            
                            
                        }
                        roomInFloorWithStatus[i].ROOM = rnameStr;
                        roomInFloorWithStatus[i].RTYPE_SELECT = rtypeStr;
                        roomInFloorWithStatus[i].ROOM_STATUS = rstatusStr;
                        countFloor++;
                    }
                    if (countFloor == floorselected.length) 
                    {
                        break;
                    }
                }
                setFloorMapMainMenu();
            }

        //submit all

            $("#submitAddBooking").on('click', function()
            {
                if ( $("#paymentSelection").val() == "") 
                {
                    alert("<?= Yii::t('app', 'Please select payment method!') ?> ")
                }
                else
                {
                    temp = $("#paymentSelection").val().split(',');
                    transDate = new Date();
                    transDate = transDate.getDate() + "-" + monthNames[transDate.getMonth()] + "-" + transDate.getFullYear();
                    var data = {
                        // transaction
                        totalPrice : totalPrice,
                        transactionDate : transDate,
                        paymentId : temp[1],
                        // book
                        bookBy : $("#name").val(),
                        bookerPhone : $("#phone").val(),
                        checkIn : checkin,
                        checkOut : checkout,
                        bookQty : $("#roomQty").val(),
                        // book detail
                        roomIdArr : selectedRoomId,
                        priceArr : priceArr,
                        breakfastArr : breakfastArr,
                        dinnerArr : dinnerArr,
                        lunchArr : lunchArr,
                        breakArr : breakArr,
                        //room status
                        roomStatus : 'booked',
                        adminId : adminId
                    };
                    $.ajax({
                        type : 'POST',
                        data : data,
                        dataType : 'JSON',
                        beforeSend : openLoading(),
                        url : '<?= Yii::$app->getUrlManager()->createUrl('meeting-booking/booking-add') ?>',
                        success : function(result)
                        {
                            if (result.errNum == 0) 
                            {
                                $(".loading").modal('toggle');
                                alert("<?= Yii::t('app', 'Booking Added') ?>")
                                location.reload();
                            }
                            else
                            {
                                console.log(result)
                            }
                        }
                    });
                }
            });

            function openLoading() 
            {
                $("#formAddPayment").modal('toggle');
                $(".loading").modal('toggle');
            }

        //edit form

            $("#bookingList").on('click', '.editBooking', function()
            {
                selection =  $(this).attr('value');
                $("#bookerNameTextEdit").html("<?= Yii::t('app', 'Booker Name') ?> : " + bookingAll[selection].BOOK_BY);
                $("#bookerPhoneTextEdit").html("<?= Yii::t('app', 'Booker Phone') ?> : " + bookingAll[selection].BOOKER_PHONE);
                $("#bookerStatusTextEdit").html("<?= Yii::t('app', 'Book Status') ?> : " + (bookingAll[selection].BOOK_STATUS == 'booked' ? 'Booked' : 'Done'));
                $("#checkInTextEdit").html("<?= Yii::t('app', 'Check In') ?> : " + bookingAll[selection].CHECK_IN);
                $("#checkOutTextEdit").html("<?= Yii::t('app', 'Check Out') ?> : " + bookingAll[selection].CHECK_OUT);
                $("#roomQtyTextEdit").html("<?= Yii::t('app', 'Room Qty') ?> : " + bookingAll[selection].BOOK_QTY);
                $("#roomListSummaryEdit").empty();
                floorName = bookingAll[selection].FLOOR_NAME.split(',');
                rtypeId = bookingAll[selection].RTYPE_ID.split(',');
                cbreak = bookingAll[selection].BREAK_QTY.split(',');
                breakfast = bookingAll[selection].BREAKFAST_QTY.split(',');
                lunch = bookingAll[selection].LUNCH_QTY.split(',');
                dinner = bookingAll[selection].DINNER_QTY.split(',');
                rId = bookingAll[selection].ROOM_ID.split(',');
                rName = bookingAll[selection].ROOM_NAME.split(',');
                rPrice = bookingAll[selection].ROOM_PRICE.split(',');
                rType = bookingAll[selection].RTYPE_NAME.split(',');
                checkin = new Date(bookingAll[selection].CHECK_IN);
                checkout = new Date(bookingAll[selection].CHECK_OUT);
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
                    price = 0, breakprice = "", breakfastprice = "", lunchprice = "",dinnerprice = "", holiday = 0, normal = 0, holidayprice = "", normalprice = "";
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
                                jumlah = new Date(bookingAll[selection].CHECK_IN).getDay() + l;
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
                $("#totalPriceTextEdit").html('<?= Yii::t('app', 'Total Price') ?> : IDR ' + bookingAll[selection].TOTAL_PRICE);
                today = new Date();
                checkindate = new Date(bookingAll[selection].CHECK_IN);
                if (bookingAll[selection].BOOK_STATUS != 'booked' || today < checkindate) 
                {
                    $("#checkoutBtn").hide()
                }
                document.querySelector('#paymentSelectionEdit').setValue(bookingAll[selection].PAYMENT_NAME + "," + bookingAll[selection].PAYMENT_ID );
            });

            $("#checkoutBtn").on('click', function()
            {
                roomId = bookingAll[selection].ROOM_ID.split(',');
                var data = {
                    transactionId : bookingAll[selection].ID,
                    bookId : bookingAll[selection].BOOK_ID,
                    roomId : roomId,
                    adminId : adminId
                };
                $.ajax({
                    type : 'POST',
                    data : data,
                    dataType : 'JSON',
                    beforeSend : openLoadingEdit(),
                    url : '<?= Yii::$app->getUrlManager()->createUrl('meeting-booking/booking-status-update') ?>',
                    success : function(result)
                    {
                        if (result.errNum == 0) 
                        {
                            $(".loading").modal('toggle');
                            alert("<?= Yii::t('app', 'Booking Status Updated') ?>")
                            location.reload();
                        }
                        else
                        {
                            console.log(result)
                        }
                    }
                });
            });

            function openLoadingEdit() 
            {
                $("#editBooking").modal('toggle');
                $(".loading").modal('toggle');
            }
    })
</script>