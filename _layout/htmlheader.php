<?php echo '<?xml version="1.0" encoding="utf-8"?>' ; ?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $TPL_LANG->getLanguage();?>" lang="<?php echo $TPL_LANG->getLanguage(); ?>">
	<head>
		<meta charset   ="utf-8" />
		<meta http-equiv="Content-Script-Type" content="text/javascript"/>
		<meta http-equiv="Content-Style-Type"  content="text/css"       />

		<meta name="author"         content="philipp gressly freimann (phi @ http://colour.name)" />
		<meta name="keywords"       content="<?php global $TPL_PAGE_TITLE; 
global $TPL_LANG; 
if(isset ($TPL_PAGE_TITLE[$TPL_LANG->getLanguage()])) 
{echo $TPL_PAGE_TITLE[$TPL_LANG->getLanguage()] . ', ' ;}
 ?><?php echo $TPL_LANG->getText('header.keywords'); ?>" />
		<meta name="description"    content="<?php echo $TPL_LANG->getText('header.description');?>" />
		<meta name="identifier-url" content="http://www.colour.name" />

		<link href="<?php global $TPL_PATHS; echo $TPL_PATHS->getClientRoot(); ?>/img/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
		<link rel="stylesheet" type="text/css" href="<?php echo $TPL_PATHS->getClientRoot(); ?>/_layout/css/farbnamen.css" />

<?php include $TPL_PATHS->getServerRoot() . "_templator/custom_css.php"; ?>
<?php include $TPL_PATHS->getServerRoot() . "_templator/custom_js.php" ; ?>

		<title>
<?php /* global $TPL_LANG; */ echo $TPL_LANG->getPageTitle(); /*$TPL_PAGE_TITLE[$TPL_LANG->getLanguage()]; */ ?>
		</title>
	</head>