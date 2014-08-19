<?php
defined('_JEXEC') or die;
?>
<section id="services-category">
	<div id="services-container">
		<h2>Website Mafia Services</h2>
			<div class="newspaper-wrapper">
			<?php foreach ($this->lead_items as &$item) : ?>
				<article id="services">
					<?php
					$this->item = & $item;
					echo $this->loadTemplate('item');
					?>
				</article>
			<?php endforeach; ?>
			</div>
	</div>
</section>
