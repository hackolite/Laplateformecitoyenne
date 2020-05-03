<div id="info">
<link rel="stylesheet" type="text/css" href="/style/home.css">
	<p>
	<?php
		echo search("LPC(.+).</span>", null, false);
	?>
	</p>

	<div class="container">
		<h2><span data-click="signin"><?php echo ucfirst(search("connectons-nous")); ?></span></h2>
		<div id="anim" data-click="signin">
			<img src="img/logo/anim1.png" >
		</div>
		<img src="img/home.png" >
	</div>

</div>

<div class="banniere">
	<ul class="social_btt">
		<?php
			$pre = "/img/social_logo/";
			$social_list = ["Facebook", "LinkedIn", "Instagram", "Twitter", "Share"];
			$social_link =[
				"/link/?link=fb", "/link/?link=lk", "/link/?link=insta", "", "/"
			];
			for($i = 0; $i < sizeof($social_list); $i++):
		?>
		<li>
			<a href="<?php echo $social_link[$i];?>" target="_blank">
				<img <?php echo 'src="'.$pre.$social_list[$i].'" alt="'.$social_list[$i].'"';?> >
			</a>
		</li>
		<?php
			endfor;
		?>
	</ul>

	<div class="white_space"></div>
</div>

<div class="banniere box_center">
	<h3>La Plateforme Citoyenne <?php echo search("en chiffres");?>:</h3>
	<section class="box">
		<h3><?php echo search("members"); ?></h3>
		<p>6 4782</p>
		<p>6 4782</p>
	</section>
	<section class="box">
		<h3><?php echo search("donations"); ?></h3>
		<p>518K</p>
		<p>518K</p>
	</section>

	
</div>

<div class="banniere box_center">
	<h3><?php echo search("our partners"); ?>:</h3>

	<section class="box">
		<h3>360 medics</h3>
		<a href="/link/?link=360medics" target="_blank">
			<img src="/img/logo/360medics.png" width="170px">
		</a>
	</section>
	<div class="white_space"></div>
</div>