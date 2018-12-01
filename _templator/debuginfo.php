<?php require_once('languagepack.php'); ?>
<hr />

<h3>DEBUG INFO _TEMPLATOR</h3>

<ul>
<li>TPL_PAGE_TITLE : <?= $TPL_PAGE_TITLE[getLanguage()]; ?></li>
<li>TPL_DIR_NAME   : <?= $TPL_DIR_NAME[getLanguage()] ?></li>

<li>PHP: Included files: <?=var_dump(get_included_files()) ?></li>

<li>TPL_PATHS->getClientRoot() : <?=$TPL_PATHS->getClientRoot(); ?></li>
<li>TPL_PATHS->getCanonicalClientPath() :  <?=$TPL_PATHS->getCanonicalClientPath();?></li>
</ul>


<hr />