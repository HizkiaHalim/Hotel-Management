<?php
    use app\assets\AppAsset;
    
    use yii\bootstrap5\NavBar;

    AppAsset::register($this);

    $this->registerCsrfMetaTags();
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang = "<?= Yii::$app->language ?>" class = "h-100">
    <head>
        <?php $this->head() ?>
    </head>
    <body class="d-flex flex-column h-100 ">
    <?php $this->beginBody() ?>
        <header id = "header">
            <?php 
                NavBar::begin([]);
                NavBar::end();
            ?>
            <nav class="navbar navbar-dark bg-primary navbar-expand-md fixed-top justify-content-center">
                <div class="row navbarpanjang">
                    <ul class="navbar-nav">
                        <a class="navbar-brand" href='<?= Yii::$app->getUrlManager()->createUrl('hotel-user/user') ?>'>My Hotel</a>
                        <li class="nav-item px-4">
                            <a class="nav-link active" aria-current="page" href="<?= Yii::$app->getUrlManager()->createUrl('hotel-user/user') ?>"><?= Yii::t('app', 'User') ?></a>
                        </li>
                        <li class="nav-item px-4">
                            <a class="nav-link active" href="<?= Yii::$app->getUrlManager()->createUrl('hotel-paymethod/paymethod') ?>"><?= Yii::t('app', 'Payment Method') ?></a>
                        </li>

                        <li class="nav-item dropdown px-4">
                            <a class="nav-link dropdown-toggle active" href="#" id="hotelMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Hotel
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="hotelMenu">
                                <li><a class="dropdown-item" href="<?= Yii::$app->getUrlManager()->createUrl('hotel-floor/floor') ?>"><?= Yii::t('app', 'Floor') ?></a></li>
                                <li><a class="dropdown-item" href="<?= Yii::$app->getUrlManager()->createUrl('hotel-rtype/rtype') ?>"><?= Yii::t('app', 'Room Type') ?></a></li>
                                <li><a class="dropdown-item" href="<?= Yii::$app->getUrlManager()->createUrl('hotel-facility/facility') ?>"><?= Yii::t('app', 'Facility') ?></a></li>
                                <li><a class="dropdown-item" href="<?= Yii::$app->getUrlManager()->createUrl('hotel-price/price') ?>"><?= Yii::t('app', 'Price') ?></a></li>
                                <li><a class="dropdown-item" href="<?= Yii::$app->getUrlManager()->createUrl('hotel-booking/booking') ?>"><?= Yii::t('app', 'Booking') ?></a></li>
                                <li><a class="dropdown-item" href="<?= Yii::$app->getUrlManager()->createUrl('hotel-report/report') ?>"><?= Yii::t('app', 'Report') ?></a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown px-4">
                            <a class="nav-link dropdown-toggle active" href="#" id="meetingMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?= Yii::t('app', 'Meeting Room') ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="meetingMenu">
                                <li><a class="dropdown-item" href="<?= Yii::$app->getUrlManager()->createUrl('meeting-floor/floor') ?>"><?= Yii::t('app', 'Floor') ?></a></li>
                                <li><a class="dropdown-item" href="<?= Yii::$app->getUrlManager()->createUrl('meeting-rtype/rtype') ?>"><?= Yii::t('app', 'Room Type') ?></a></li>
                                <li><a class="dropdown-item" href="<?= Yii::$app->getUrlManager()->createUrl('meeting-facility/facility') ?>"><?= Yii::t('app', 'Facility') ?></a></li>
                                <li><a class="dropdown-item" href="<?= Yii::$app->getUrlManager()->createUrl('meeting-price/price') ?>"><?= Yii::t('app', 'Price') ?></a></li>
                                <li><a class="dropdown-item" href="<?= Yii::$app->getUrlManager()->createUrl('meeting-booking/booking') ?>"><?= Yii::t('app', 'Booking') ?></a></li>
                                <li><a class="dropdown-item" href="<?= Yii::$app->getUrlManager()->createUrl('meeting-report/report') ?>"><?= Yii::t('app', 'Report') ?></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class = "row navbarpendek">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown px-4">
                            <a class="nav-link dropdown-toggle active" href="#" id="hotelMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?= Yii::$app->session['username']?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="hotelMenu">
                                <li><a class="dropdown-item" href="<?= Yii::$app->getUrlManager()->createUrl('hotel-login/login') ?>"><?= Yii::t('app', 'Logout') ?></a></li>
                            </ul>
                        </li>
                        <select class="form-select" id="selectLang">
                            <option selected><?= Yii::t('app', 'Language') ?></option>
                            <option value='eng'>English</option>
                            <option value='idn'>Indonesia</option>
                        </select>
                    </ul>
                </div>      
            </nav>
        </header>
        
        <?= $content ?>

    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>

<script>
    $(function()
    {
        $("#selectLang").on('change',function()
        {
            var data = {
                lang : $("#selectLang").val(),
            };
            $.ajax
            ({
            type : 'POST',
            data : data,
            dataType : 'JSON',
            url : '<?= Yii::$app->getUrlManager()->createUrl('hotel-user/set-lang') ?>',
            success : function(result)
            {
                if (result == 0) {
                    alert("<?= Yii::t('app', 'Bahasa Berhasil Diubah') ?>");
                }
                location.reload();
            }
            })
        })
    })
</script>