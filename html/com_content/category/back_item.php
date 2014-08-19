<?php
defined('_JEXEC') or die;

$images = json_decode($this->item->images);
$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
$urls = json_decode($this->item->urls);
?>

		<div class="title">
			<a href="<?php echo $link; ?>"><?php echo $this->item->title; ?></a>
		</div>
		<div class="case-number">
			<p>Case #<?php echo $this->item->id; echo round(rand(1000, 9999)); ?></p>
		</div>
			<img src="<?php echo $images->{'image_intro'}; ?>" alt="<?php echo $images->{'image_intro_alt'}; ?>" title="<?php echo $images->{'image_intro_caption'}; ?>" />
		<div class="site-link">
			<p><a href="<?php echo $urls->{'urla'}; ?>"><?php echo $urls->{'urla'}; ?></a></p>
		</div>
		<div class="site-info">
			<p><?php echo $this->item->metadesc; ?></p>
		</div>
