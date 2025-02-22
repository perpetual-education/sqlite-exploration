
<?php if ( !empty($people) ): ?>

	<ul>
		<?php foreach ($people as $person) { ?>
			<li>
				<article>
					<?=$person['name']?>
				</article>
			</li>
		<?php } ?>
	</ul>

<?php else: ?>

	<p>You haven't added any users yet.</p>

<?php endif; ?>

<!-- note - another way to write if/else syntax control flow -->