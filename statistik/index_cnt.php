<?php global $TPL_LANG; ?>

<p><?php $TPL_LANG->echoText('statistik.intro.desc'    );?></p>
<p><?php $TPL_LANG->echoText('statistik.intro.desc.rfc');?></p>


	<table class="statOverview">
		<tr>
			<td><a href="numbers.php"><?php $TPL_LANG->echoText('statistik.stat.numbers' );?></a></td>
			<td><a href="top20.php"  ><?php $TPL_LANG->echoText('statistik.stat.top20'   );?></a></td>
			<td><a href="nachName"   ><?php $TPL_LANG->echoText('statistik.stat.byName'  );?></a></td>
			<td><a href="nachFarbe"  ><?php $TPL_LANG->echoText('statistik.stat.byColour');?></a></td>
		</tr>
		<tr><?php // IMAGES ?>
			<td><a href="numbers.php"><img   src="<?php echo $TPL_PATHS->getClientRoot();  ?>/img/statistik/numbers.png" alt="<?php   $TPL_LANG->echoText('statistik.stat.numbers');?>" width="144"/></a></td>
			<td><a href="top20.php"><img src="<?php echo $TPL_PATHS->getClientRoot();  ?>/img/statistik/top20.png"   alt="<?php   $TPL_LANG->echoText('statistik.stat.top20');  ?>" width="144"/></a></td>
			<td><a href="nachName"><img  src="<?php echo $TPL_PATHS->getClientRoot();  ?>/img/statistik/byName.png"  alt="<?php   $TPL_LANG->echoText('statistik.stat.byName'); ?>" width="144"/></a></td>
			<td><a href="nachFarbe"><img src="<?php echo $TPL_PATHS->getClientRoot();  ?>/img/statistik/byValue.png" alt="<?php   $TPL_LANG->echoText('statistik.stat.byColour'); ?>" width="144"/></a></td>
		</tr>
		<tr>
			<td><?php $TPL_LANG->echoText('statistik.stat.numbers.desc' ); ?></td>
			<td><?php $TPL_LANG->echoText('statistik.stat.top20.desc'   ); ?></td>
			<td><?php $TPL_LANG->echoText('statistik.stat.byName.desc'  ); ?></td>
			<td><?php $TPL_LANG->echoText('statistik.stat.byColour.desc'); ?></td>
		</tr>
	</table>