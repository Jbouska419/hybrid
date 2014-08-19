<?php
defined('_JEXEC') or die;
?>
<div id="mob-category">
	<div id="mob-container">
		<h2>Meet the Mob</h2>
		<div class="mob-wrapper">
			<?php foreach ($this->lead_items as &$item) : ?>
			<div id="member">
				<?php
				$this->item = & $item;
				echo $this->loadTemplate('item');
				?>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
