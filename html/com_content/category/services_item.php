<?php
defined('_JEXEC') or die;

$images = json_decode($this->item->images);
$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
?>
	<div class="title">
		<a href="<?php echo $link; ?>"><?php echo $this->item->title; ?></a>
	</div>
	<div class="newspaper">
		<img src="<?php echo $images->{'image_intro'}; ?>" alt="<?php echo $images->{'image_intro_alt'}; ?>" title="<?php echo $images->{'image_intro_caption'}; ?>" />
		<p><?php echo $this->item->metadesc; ?></p>
	</div>
