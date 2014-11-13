<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/source/jquery.fancybox.pack.js"></script>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Надходження', 'url'=>array('/admin/orders/create')),
                                array('label'=>'Видача', 'url'=>array('/admin/orders/extradition')),
                                array('label'=>'Накладні', 'url'=>array('/admin/orders')),
                                array('label'=>'Видано ТП', 'url'=>array('/admin/products/technicalsupport')),
                                array('label'=>'Пошук по номеру', 'url'=>array('/admin/products/movinghistory')),
                                array('label'=>'Пошук по адресу', 'url'=>array('/admin/orders/search')),
                                array('label'=>'Сформувати звіт', 'url'=>array('/admin/orders/report')),
                                array('label'=>'Здати в ремонт', 'url'=>array('/admin/orders/repair')),
				array('label'=>'Store', 'url'=>array('/admin/products/store'), 'itemOptions'=>array('class'=>'visited'),
                                'items'=>array(
//                                    array('label'=>'Залишок на складі', 'url'=>array('/admin/products/store')),
                                    array('label'=>'Повернуто', 'url'=>array('/admin/products/remove')),
                                    array('label'=>'Ремонт', 'url'=>array('/admin/products/repair')),
                                    array('label'=>'Заміна по гарантії', 'url'=>array('/admin/products/warranty')),
                                )),
                                //array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				//array('label'=>'Contact', 'url'=>array('/site/contact')),
				//array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				//array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->
<script>
    $(document).ready(function(){
                $('.visited').mouseover(function() {
                    $("ul:hidden").addClass('selected');
                    $("ul:hidden").show(100);
                });
                $('.selected').mouseout(function() {
                    $(".selected").hide(500);
                });
    });
</script>
</body>
</html>
