<div class="site-index my-auto">
    <div class="container col-4 loginForm border border-4 border-primary rounded py-4">
        <div id="logoHotel" class="d-flex">
            <img id="imgLogo" src="<?= Yii::$app->getUrlManager()->createUrl('/images/hotelLogo.jpeg') ?>">
        </div>
        <p class="fs-3 text-center pt-4"><?= Yii::t('app', 'Login') ?></p>
        <form id="formLogin" class="needs-validation" novalidate>
            <div>
                <label for="email" class="form-label pt-1"><?= Yii::t('app', 'Email') ?></label>
                <input type="email" class="form-control" id="email" required placeholder="<?= Yii::t('app', 'Enter Your Email') ?>">
                <div class="invalid-feedback"><?= Yii::t('app', 'Please input email.') ?></div>
                <div class="valid-feedback"></div>
            </div>
            <div>
                <label for="password" class="form-label pt-1"><?= Yii::t('app', 'Password') ?></label>
                <input type="password" class="form-control" id="password" required placeholder="<?= Yii::t('app', 'Enter Your Password') ?>">
                <div class="invalid-feedback"><?= Yii::t('app', 'Please input password.') ?></div>
                <div class="valid-feedback"></div>
            </div>
        </form>
        <div class="row justify-content-center pt-4">
            <div class="col-5 d-grid">
                <button id="submitBtn" class="btn btn-primary"><?= Yii::t('app', 'Login') ?></button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function()
    {
        $("#submitBtn").on("click",function()
        {
            if ($("#email").val() == "" || $("#password").val() == "" ) 
            {
                $("#formLogin").addClass('was-validated')
                alert('<?= Yii::t('app', 'All input must be filled!') ?>');
            } 
            else if ($("#email").val().length > 256 || $("#password").val().length > 256 ) 
            {
                alert('<?= Yii::t('app', 'Input too long! Max: 256 Char') ?>');
            }
            else
            {
                var data = {
                    email : $("#email").val(),
                    password : $("#password").val(),
                };
                $.ajax({
                    type : 'POST',
                    data : data,
                    dataType : 'JSON',
                    url : '<?= Yii::$app->getUrlManager()->createUrl('hotel-login/verify-login') ?>',
                    success : function(result)
                    {
                        if (result == 0) 
                        {
                            window.location.href ='<?= Yii::$app->getUrlManager()->createUrl('hotel-user/user') ?>'
                        }
                        else if (result == 1)
                        {
                            alert('<?= Yii::t('app', 'Wrong Email or Password') ?>');
                        }
                    }
                });
            }
        });

    });
</script>

<!-- 
    catatan:
    
    senin deadline
    
    blom test:




SELECT * FROM HIZ_HOTEL_PAYMETHOD
SELECT * FROM HIZ_HOTEL_FACILITY
SELECT * FROM HIZ_HOTEL_ROOM
SELECT * FROM HIZ_HOTEL_RTYPE
SELECT * FROM HIZ_HOTEL_PRICE
SELECT * FROM HIZ_HOTEL_BOOK;
SELECT * FROM HIZ_HOTEL_BOOKDETAIL;
SELECT * FROM HIZ_HOTEL_TRANSACTION;

ALTER TABLE HIZ_HOTEL_BOOK ADD BOOK_STATUS VARCHAR2(256);
UPDATE HIZ_HOTEL_BOOK SET BOOK_STATUS = 'booked' where id = 8
DELETE FROM HIZ_HOTEL_BOOKDETAIL WHERE ID BETWEEN 10 AND 13;

column NAME format a30;
column FLOOR_LEVEL format a30;
column FLOOR_ROW format a30;
column FLOOR_COLUMN format a30;
column QTY format a30;
column ROOM_TYPE format a30;
column ROOM_NAME format a30;
column ROOM format a30;
column RTYPE_ID format a30;
column ROOM_FACILITY format a30;
column RTYPE_SELECT format a30;
column ROOM_STATUS format a30;
column RTYPE_SELECT_ID format a30;
column FLOOR_NAME format a30;
column FACILITY_NAME format a30;
column BOOK_BY format a30;
column ROOM_ID format a30;
column EXTRABED_QTY format a30;
column BREAKFAST_QTY format a30;
column ROOM_PRICE format a30;
column BOOKER_PHONE format a30;

 -->