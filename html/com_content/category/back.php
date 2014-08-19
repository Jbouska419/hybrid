<?php
defined('_JEXEC') or die;
?>
<section id="background-category">
	<div id="background-container">
		<h2>Background Files</h2>
		<div class="site-wrapper">
			<?php foreach ($this->lead_items as &$item) : ?>
				<article id="item">
					<?php
					$this->item = & $item;
					echo $this->loadTemplate('item');
					?>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
