
<div id="map" class='visible'>
	<div id="mapid"></div>

	<nav class='on_info'>
		<div id="search">

			<span class='img img_info' data-click="map_info"></span>
			<input type="text"name='pays' placeholder="<?php echo search('pays'); ?>">
			<div class="option pays"></div>
			<input type="text" name='city' placeholder="<?php echo search('ville').' / '.search('code postal'); ?>">
			<span class='img img_search'></span>

		</div>
		<div id="info">
			<p>
			<?php
				echo search("LPC(.+).</span>", null, false);
			?>
			</p>
		</div>
	</nav>
	<bottom>

		<div class="legend">
			<p> <?php echo search("afficher"); ?> :</p>
			<ul>
				<li>
					<span class="checkbox on blue makers"></span>
					<span class="text"><?php echo search("Makers");?></span>
				</li>
				<li>
					<span class="checkbox on green medicals"></span>
					<span class="text"><?php echo search("mediCals");?></span>
				</li>
			</ul>
		</div>

        <div id="openChat" class="btt_submit empty blue" data-click="chat">
            <?php echo search("chat"); ?>
            <span id="chatUnreadMessage" hidden>*</span>
        </div>

		<div class="btt_submit fill green" data-click="recevoir">
			<?php echo search("recevoir"); ?>
		</div>
		<div class="btt_submit fill blue" data-click="donner">
			<?php echo search("give") ?>
		</div>

	</bottom>
</div>
