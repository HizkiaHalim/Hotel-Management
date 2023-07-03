<div class="site-index my-5">
    <div class="container col-10">
        <div class="fs-3 text-center p-3 fw-bold"><?= Yii::t('app', 'User List') ?></div>
        <div class="">
            <button id="addBtn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formAdd"><?= Yii::t('app', 'Add User') ?></button>
        </div>
        <table class="table table-bordered w-100 my-2 mb-5">
                <thead>
                    <tr class="text-center">
                        <th class="align-middle col-1">No</th>
                        <th class="align-middle col-1"><?= Yii::t('app', 'First Name') ?></th>
                        <th class="align-middle col-1"><?= Yii::t('app', 'Last Name') ?></th>
                        <th class="align-middle col-1"><?= Yii::t('app', 'Identity Number') ?></th>
                        <th class="align-middle col-1"><?= Yii::t('app', 'Email') ?></th>
                        <th class="align-middle col-1"><?= Yii::t('app', 'Phone Number') ?></th>
                        <th class="align-middle col-2"><?= Yii::t('app', 'Address') ?></th>
                        <th class="align-middle col-1"></th>
                    </tr>
                </thead>
                <tbody id="userList">
                </tbody>
            </table>
        </div>
    </div>
    
    <form id="formAddUser" class="needs-validation" novalidate>
        <div class="modal" id="formAdd" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?= Yii::t('app', 'Add New User') ?></h4>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="fname" class="form-label "><?= Yii::t('app', 'First Name') ?></label>
                            <input type="text" class="form-control" required id="fname" placeholder="<?= Yii::t('app', 'Enter User First Name') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input user first name.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                        <div>
                            <label for="lname" class="form-label pt-3"><?= Yii::t('app', 'Last Name') ?></label>
                            <input type="text" class="form-control" required id="lname" placeholder="<?= Yii::t('app', 'Enter User Last Name') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input user last name.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                        <div>
                            <label for="ktp" class="form-label pt-3"><?= Yii::t('app', 'Identity Number') ?></label>
                            <input type="numeric" class="form-control" required id="ktp" placeholder="<?= Yii::t('app', 'Enter User Identity Number') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input user identity number.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                        <div>
                            <label for="email" class="form-label pt-3"><?= Yii::t('app', 'Email') ?></label>
                            <input type="email" class="form-control" required id="email" placeholder="<?= Yii::t('app', 'Enter User Email') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input user email.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                        <div>
                            <label for="phoneNum" class="form-label pt-3"><?= Yii::t('app', 'Phone Number') ?></label>
                            <input type="numeric" class="form-control" required id="phoneNum" placeholder="<?= Yii::t('app', 'Enter User Phone Number') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input user phone number.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                        <div>
                            <label for="address" class="form-label pt-3"><?= Yii::t('app', 'Address') ?></label>
                            <input type="text" class="form-control" required id="address" placeholder="<?= Yii::t('app', 'Enter User Address') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input user address.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                        <div>
                            <label for="password" class="form-label pt-3"><?= Yii::t('app', 'Password') ?></label>
                            <input type="password" class="form-control" required id="password" placeholder="<?= Yii::t('app', 'Enter User Password') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input user password.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                        <div>
                            <label for="confirmPass" class="form-label pt-3"><?= Yii::t('app', 'Confirm Password') ?></label>
                            <input type="password" class="form-control" required id="confirmPass" placeholder="<?= Yii::t('app', 'Enter User Password') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input user passsword.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="pt-3" >
                            <span> <?= Yii::t('app', 'Admin Status') ?></span>
                            <div class="btn-group" role="group">
                                <input type="radio" value="Admin" class="btn-check" name="adminStatus" id="admin" autocomplete="off" checked>
                                <label class="btn btn-outline-primary" for="admin">Admin</label>
            
                                <input type="radio" value="SuperAdmin" class="btn-check" name="adminStatus" id="superadmin" autocomplete="off">
                                <label class="btn btn-outline-primary" for="superadmin">Super Admin</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="cancelAddBtn">Cancel</button>
                        <button type="button" class="btn btn-primary" id="submitAddUser"><?= Yii::t('app', 'Add User') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form id="formEditUser" class="needs-validation" novalidate>
        <div class="modal" id="formEdit" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?= Yii::t('app', 'Edit User') ?></h4>
                        <button type="button" class="btn btn-primary" id="resetUserForm">Reset</button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="fnameEdit" class="form-label "><?= Yii::t('app', 'First Name') ?></label>
                            <input type="text" class="form-control" required id="fnameEdit" placeholder="<?= Yii::t('app', 'Enter User First Name') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input user first name.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                        <div>
                            <label for="lnameEdit" class="form-label pt-3"><?= Yii::t('app', 'Last Name') ?></label>
                            <input type="text" class="form-control" required id="lnameEdit" placeholder="<?= Yii::t('app', 'Enter User Last Name') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input user last name.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                        <div>
                            <label for="ktpEdit" class="form-label pt-3"><?= Yii::t('app', 'Identity Number') ?></label>
                            <input type="numeric" class="form-control" required id="ktpEdit" placeholder="<?= Yii::t('app', 'Enter User Identity Number') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input user identity number.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                        <div>
                            <label for="emailEdit" class="form-label pt-3"><?= Yii::t('app', 'Email') ?></label>
                            <input type="email" class="form-control" required id="emailEdit" placeholder="<?= Yii::t('app', 'Enter User Email') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input user email.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                        <div>
                            <label for="phoneNumEdit" class="form-label pt-3"><?= Yii::t('app', 'Phone Number') ?></label>
                            <input type="numeric" class="form-control" required id="phoneNumEdit" placeholder="<?= Yii::t('app', 'Enter User Phone Number') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input user phone number.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                        <div>
                            <label for="addressEdit" class="form-label pt-3"><?= Yii::t('app', 'Address') ?></label>
                            <input type="text" class="form-control" required id="addressEdit" placeholder="<?= Yii::t('app', 'Enter User Address') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input user address.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                        <div>
                            <label for="passwordEdit" class="form-label pt-3"><?= Yii::t('app', 'Password') ?></label>
                            <input type="password" class="form-control" required id="passwordEdit" placeholder="<?= Yii::t('app', 'Enter User Password') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input user password.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                        <div>
                            <label for="confirmPassEdit" class="form-label pt-3"><?= Yii::t('app', 'Confirm Password') ?></label>
                            <input type="password" class="form-control" required id="confirmPassEdit" placeholder="<?= Yii::t('app', 'Enter User Password') ?>">
                            <div class="invalid-feedback"><?= Yii::t('app', 'Please input user passsword.') ?></div>
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="pt-4" id="editLevel">
                            <span> <?= Yii::t('app', 'Admin Status') ?></span>
                            <div class="btn-group" role="group" >
                                <input type="radio" value="Admin" class="btn-check" name="adminStatusEdit" id="Admin" autocomplete="off" >
                                <label class="btn btn-outline-primary" for="Admin">Admin</label>
            
                                <input type="radio" value="SuperAdmin" class="btn-check" name="adminStatusEdit" id="SuperAdmin" autocomplete="off">
                                <label class="btn btn-outline-primary" for="SuperAdmin">Super Admin</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger deleteUser" data-bs-target="#deleteConfirmationModal" data-bs-toggle="modal"><?= Yii::t('app', 'Delete') ?></button>
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal" id="cancelEditBtn">Cancel</button>
                        <button type="button" class="btn btn-primary" id="submitEditForm"><?= Yii::t('app', 'Edit User') ?></button>
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
                    <p><?= Yii::t('app', "*Delete Process Will Begin After You Press 'Delete User' Button") ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="submitDelete"><?= Yii::t('app', 'Delete User') ?></button>
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
                    <button type="button" class="btn btn-primary" id="submitEditUser"><?= Yii::t('app', 'Edit User') ?></button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    
</div>

<script>
    $(function()
    {
        var userList = <?=$userList?>;
        var adminLevel = '<?=$adminLevel?>';
        var adminId = <?=$adminId?>;
        var selectorView = 0;
        
        if (adminLevel != "SuperAdmin")
        {
            $("#addBtn").hide();
            $("#editLevel").hide();
        }

        for (let i = 0; i < userList.length; i++) 
        {
            $("#userList").append("\
                    <tr class='text-center'>\
                        <td class='align-middle'>" + (i+1) + "</td>\
                        <td class=\"align-middle text-break\">" + userList[i].F_NAME + "</td>\
                        <td class=\"align-middle text-break\">" + userList[i].L_NAME + "</td>\
                        <td class=\"align-middle text-break\">" + userList[i].IDENTITY_NUM.toString().padStart(16,"0") + "</td>\
                        <td class=\"align-middle text-break\">" + userList[i].EMAIL + "</td>\
                        <td class=\"align-middle\">" + userList[i].PHONE_NUM.toString().padStart(10,"0") + "</td>\
                        <td class=\"align-middle text-break\">" + userList[i].ADDRESS + "</td>\
                        <td class=\"align-middle\"><button type='button' class='editUser btn btn-primary' data-bs-toggle='modal' data-bs-target='#formEdit' value=" + i + "><?= Yii::t('app', 'View User') ?></button></td>\
                    </tr>"
            );
        }

        $("#addBtn").on('click', function()
        {
            $("#fname").val("");
            $("#lname").val("");
            $("#ktp").val("");
            $("#email").val("");
            $("#phoneNum").val("");
            $("#address").val("");
            $("#password").val("");
            $("#confirmPass").val("");
        });


    //Delete logic

        $("#submitDelete").on('click', function()
        {
            var data = {
                    id : userList[selectorView].ID,
                    adminId : adminId,
                };
                $.ajax({
                    type : 'POST',
                    data : data,
                    dataType : 'JSON',
                    url : '<?= Yii::$app->getUrlManager()->createUrl('hotel-user/delete-user') ?>',
                    success : function(result)
                    {
                        if (result.errNum == 0) 
                        {
                            console.log(result);
                            alert("<?= Yii::t('app', 'User Deleted') ?>");
                            if (userList[selectorView].ID != adminId) 
                            {
                                location.reload();
                            }
                            else
                            {
                                window.location.href ='<?= Yii::$app->getUrlManager()->createUrl('hotel-login/login') ?>'
                            }
                        }
                        else
                        {
                            alert(result.email[0])
                        }
                    }
                }) 
        });

    //Edit logic

        $("#userList").on("click", ".editUser", function()
        {
            selector = $(this).val();
            selectorView = selector;
            console.log(userList[selector].ID)
            $('#fnameEdit').val(userList[selector].F_NAME);
            $('#lnameEdit').val(userList[selector].L_NAME);
            $('#ktpEdit').val(userList[selector].IDENTITY_NUM);
            $('#emailEdit').val(userList[selector].EMAIL);
            $('#phoneNumEdit').val(userList[selector].PHONE_NUM);
            $('#addressEdit').val(userList[selector].ADDRESS);
            $(":radio[name='adminStatusEdit'][id='" + userList[selector].ADMIN_LEVEL + "']").prop('checked', true);
            if (adminLevel != "SuperAdmin" && adminId != userList[selectorView].ID) 
            {
                $(".deleteUser").hide();
            }
            else
            {
                $(".deleteUser").show();
            }
        });

        $("#resetUserForm").on("click",function()
        {
            $('#fnameEdit').val(userList[selectorView].F_NAME);
            $('#lnameEdit').val(userList[selectorView].L_NAME);
            $('#ktpEdit').val(userList[selectorView].IDENTITY_NUM);
            $('#emailEdit').val(userList[selectorView].EMAIL);
            $('#phoneNumEdit').val(userList[selectorView].PHONE_NUM);
            $('#addressEdit').val(userList[selectorView].ADDRESS);
            $('#passwordEdit').val("");
            $('#confirmPassEdit').val("");
            $("input[name='adminStatusEdit']:radio[value='" + userList[selectorView].ADMIN_LEVEL + "']").prop('checked', true);
        })

        $("#submitEditUser").on("click",function()
        {
            var data = {
                    id : userList[selectorView].ID,
                    fname : $("#fnameEdit").val(),
                    lname : $("#lnameEdit").val(),
                    email : $("#emailEdit").val(),
                    ktp : $("#ktpEdit").val(),
                    phoneNum : $("#phoneNumEdit").val(),
                    address : $("#addressEdit").val(),
                    password : $("#passwordEdit").val(),
                    admin_level : $(":radio[name=adminStatusEdit]:checked").val(),
                    adminId : adminId,
                };
            $.ajax({
                type : 'POST',
                data : data,
                dataType : 'JSON',
                url : '<?= Yii::$app->getUrlManager()->createUrl('hotel-user/edit-user') ?>',
                success : function(result)
                {
                    if (result.errNum == 0) 
                    {
                        console.log(result);
                        alert("<?= Yii::t('app', 'User Edited') ?>");
                        location.reload();
                    }
                    else if (result.errNum == 1)
                    {
                        alert("Error Code (" + result.errNum + ")  : " + result.errStr);
                    }
                    else
                    {
                        alert(result.email[0]);
                    }
                }
            }) 
        })

        $("#submitEditForm").on("click",function()
        {
            if ($("#fnameEdit").val() == "" || $("#lnameEdit").val() == "" || $("#ktpEdit").val() == "" || $("#emailEdit").val() == "" || $("#phoneNumEdit").val() == "" || $("#addressEdit").val() == "" || $("#passwordEdit").val() == "" || $("#confirmPassEdit").val() == "" || $(":radio[name=adminStatusEdit]:checked").val() == undefined) 
            {
                $("#formEditUser").addClass('was-validated');
                alert('<?= Yii::t('app', 'All input must be filled!') ?>');

            } 
            else if ($("#ktpEdit").val().length != 16)
            {
                alert('<?= Yii::t('app', 'Identity Number must be 16 Numbers') ?>');
            }
            else if ($("#phoneNumEdit").val().length > 12)
            {
                alert('<?= Yii::t('app', 'Phone Number too long! Max: 12 Numbers') ?>');
            }
            else if ($("#fnameEdit").val().length > 256  || $("#lnameEdit").val().length > 256 || $("#emailEdit").val().length > 256 || $("#addressEdit").val().length > 256 || $("#passwordEdit").val().length > 256  || $("#confirmPassEdit").val().length > 256 )
            {
                alert('<?= Yii::t('app', 'Input too long! Max: 256 Characters') ?>');
            }
            else if ($("#passwordEdit").val() != $("#confirmPassEdit").val())
            {
                alert('<?= Yii::t('app', 'Password and Confirm Password not match') ?>');
            }
            else
            {
                $("#formEdit").modal('toggle')
                $("#editConfirmationModal").modal('toggle')
            }
        });

    //Number only

        $("#ktp").keypress("click",function(e) 
        {    
            var charCode = (e.which) ? e.which : event.keyCode    
            if (String.fromCharCode(charCode).match(/[^0-9]/g))  
            {
                return false;                        
            }  
        }); 

        $("#phoneNum").keypress("click",function(e) 
        {    
            var charCode = (e.which) ? e.which : event.keyCode    
            if (String.fromCharCode(charCode).match(/[^0-9]/g))  
            {
                return false;                        
            }  
        }); 

        $("#ktpEdit").keypress("click",function(e) 
        {    
            var charCode = (e.which) ? e.which : event.keyCode    
            if (String.fromCharCode(charCode).match(/[^0-9]/g))  
            {
                return false;                        
            }  
        }); 

        $("#phoneNumEdit").keypress("click",function(e) 
        {    
            var charCode = (e.which) ? e.which : event.keyCode    
            if (String.fromCharCode(charCode).match(/[^0-9]/g))  
            {
                return false;                        
            }  
        }); 

    //Submit add logic

        $("#submitAddUser").on("click",function()
        {
            if ($("#fname").val() == "" || $("#lname").val() == "" || $("#ktp").val() == "" || $("#email").val() == "" || $("#phoneNum").val() == "" || $("#address").val() == "" || $("#password").val() == "" || $("#confirmPass").val() == "" || $(":radio[name=adminStatus]:checked").val() == undefined) 
            {
                $("#formAddUser").addClass('was-validated');
                alert('<?= Yii::t('app', 'All input must be filled!') ?>');

            } 
            else if ($("#ktp").val().length != 16)
            {
                alert('<?= Yii::t('app', 'Identity Number must be 16 Numbers') ?>');
            }
            else if ($("#phoneNum").val().length > 12)
            {
                alert('<?= Yii::t('app', 'Phone Number too long! Max: 12 Numbers') ?>');
            }
            else if ($("#fname").val().length > 256  || $("#lname").val().length > 256 || $("#email").val().length > 256 || $("#address").val().length > 256 || $("#password").val().length > 256  || $("#confirmPass").val().length > 256 )
            {
                alert('<?= Yii::t('app', 'Input too long! Max: 256 Characters') ?>');
            }
            else if ($("#password").val() != $("#confirmPass").val())
            {
                alert('<?= Yii::t('app', 'Password and Confirm Password not match') ?>');
            }
            else
            {
                var data = {
                    fname : $("#fname").val(),
                    lname : $("#lname").val(),
                    email : $("#email").val(),
                    ktp : $("#ktp").val(),
                    phoneNum : $("#phoneNum").val(),
                    address : $("#address").val(),
                    password : $("#password").val(),
                    admin_level : $(":radio[name=adminStatus]:checked").val(),
                    adminId : adminId,
                };
                $.ajax({
                    type : 'POST',
                    data : data,
                    dataType : 'JSON',
                    url : '<?= Yii::$app->getUrlManager()->createUrl('hotel-user/add-user') ?>',
                    success : function(result)
                    {
                        if (result.errNum == 0) 
                        {
                            console.log(result);
                            alert("<?= Yii::t('app', 'User Added') ?>");
                            location.reload();
                        }
                        else if (result.errNum == 1)
                        {
                            alert("Error Code (" + result.errNum + ")  : " + result.errStr);
                        }
                        else
                        {
                            alert(result.email[0]);
                        }
                    }
                }) 
            }
        });
    })
</script>