<div class="mainbox">
	<article class="link">
		<h1><a href="?shuffle=no"><img src="/img/common/icon_link.png" alt="link_icon"><img src="/img/common/menu_link.png" alt="about"><span class="hide">about</span></a></h1>
		<section>
			<dl>
			<?php foreach($linkList as $link){ ?>
				<hr />
				<dt><?php echo $link['title']; ?></dt>
				<dd><p><a href="<?php echo $link['url'];?>"><img src="<?php echo $link['banner']; ?>" width = "200px" height="auto" /></a><br /><span><?php echo $link['description']; ?></span></dd>
			<?php } ?>
			</dl>
		</section>
	</article>
</div>
