<?php if ( !empty($errors) ) { ?>
	<ul class='error-list'>
		<?php foreach ($errors as $error) { ?>
			<li class='error'><?=$error?></li>
		<?php } ?>
	</ul>
<?php } ?>