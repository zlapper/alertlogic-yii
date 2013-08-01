<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8">
		<title>The Movie Database Search</title>
		<meta name="description" content="">
		<meta name="author" content="Daniel Garcia">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/vendor/normalize.css" />
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/vendor/foundation.min.css" />

		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/fonts/foundation_icons_general/stylesheets/general_foundicons.css" />
		<!--[if lte IE 7]>
			<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/fonts/foundation_icons_general/stylesheets/general_foundicons_ie7.css" />
		<![endif]-->

		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/styles.css" />

		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/custom.modernizr.js"></script>
	</head>
	<body>
		<?php echo $content; ?>

		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/jquery-1.10.1.min.js"></script>
		<!-- // <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/foundation.min.js"></script> -->
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/jquery.lazyload.min.js"></script>
		<script type="text/javascript">
			$("img").lazyload();
		</script>
	</body>
</html>