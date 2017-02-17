<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">
	<channel>
		<title><?= xml($title) ?></title>
		<link><?= xml($link) ?></link>

		<?php if($description): ?>
		<description><![CDATA[<?= xml($description) ?>]]></description>
		<itunes:summary><![CDATA[<?= xml($description) ?>]]></itunes:summary>
		<?php endif ?>

		<?php if($subtitle): ?>
		<itunes:subitle><?= xml($subtitle) ?></itunes:subtitle>
		<?php endif ?>

		<?php if($author): ?>
		<itunes:author><?= xml($author) ?></itunes:author>
		<?php endif ?>

		<?php if($category): ?>
		<category><?= xml($category) ?><?php ecco($subcategory, '\\' . xml($subcategory)) ?></category>
		<itunes:category text="<?= xml($category) ?>">
			<?php if($subcategory): ?>
			<itunes:category text="<?= xml($subcategory) ?>"/>
			<?php endif ?>
		<itunes:category>
		<?php endif ?>

		<itunes:explicit><?= xml($explicit) ?></itunes:explicit>

		<?php if($image): ?>
		<itunes:image href="<?= xml($image) ?>">
		<?php endif ?>

		<language><?= xml($language) ?></language>
		<copyright><?= xml($copyright) ?><copyright>

		<generator><?= c::get('podcast.generator', 'Sermon Library for Kirby'); ?></generator>
		<lastBuildDate><?= $lastBuildDate ?></lastBuildDate>
		<pubDate><?= $pubDate ?></pubDate>
		<docs><?= xml($docs) ?></docs>

		<?php if($owner_email): ?>
		<webMaster><?= xml($owner_email) ?></webMaster>
		<itunes:owner>
			<itunes:name><?= xml($owner_name) ?></itunes:name>
			<itunes:email><?= xml($owner_email) ?></itunes:email>
		</itunes:owner>
		<?php endif ?>

		<?php foreach($items as $item): ?>
		<item>
			<title><?= xml($item->title()) ?></title>
			<link><?= xml($item->url()) ?></link>
			<guid><?= xml($item->url()) ?></guid>

			<?php if($item->content()->has('subtitle')): ?>
			<itunes:subtitle><?= xml($item->subtitle()) ?></itunes:subtitle>
			<?php endif ?>

			<?php if($item->description()): ?>
			<description><![CDATA[<?= $item->description()->kirbytext() ?>]]></description>
			<itunes:summary><![CDATA[<?= $item->description()->kirbytext() ?>]]></itunes:summary>
			<?php endif ?>

			<?php $podcastAudio = $item->audio()->filterBy('extension', 'mp3')->first() ?>
			<enclosure url="<?= xml($podcastAudio->url()) ?>" length="<?= xml($podcastAudio->size()) ?>" type="<?= xml($podcastAudio->mime()) ?>"/>

			<pubDate><?= $item->date(DateTime::RFC822, $datefield) ?></pubDate>
			<itunes:author><?= xml($item->teacher()) ?></itunes:author>
			<itunes:explicit><?= xml($explicit) ?></itunes:explicit>

			<itunes:duration><?= xml($item->duration()) ?></itunes:duration>

			<?php if($item->content()-has('keywords')): ?>
			<itunes:keywords><?= xml($item->keywords()) ?></itunes:keywords>
			<?php endif ?>
		</item>
		<?php endforeach ?>
	</channel>
</rss>