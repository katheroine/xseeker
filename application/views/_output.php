<div id="output">
<?php if(count($entry_items) != 0) { ?>
	<?php foreach($entry_items as $key => $entry_item) { ?>
		<div class="entry">
			<h1><a href="<?= $entry_item->link ?>"> <?= $entry_item->title ?> </a></h1>
			<p> <?= ViewHelper::emphasizeKeywordInContent($keyword, $entry_item->description) ?></p>
			<h2> <?= $entry_item->date ?> </h2>
		</div>
	<?php } ?>
<?php } else { ?>
	<div id="entry_not_found">Entry with keyword <span class="keyword"><?= $keyword ?></span> cannot be found.</div>
<?php } ?>
</div>