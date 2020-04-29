<div id="info">
	<style>
		#info{
		    left: 50%;
		    transform: translate(-50%);
		    top: 112px;
		    font-size: 18px;
		    width: 80%;
		    max-width: 800px;
		    min-width: 300px;
		    border-radius: 7px;
		    text-align: center;
		}
		#info img{
			width: 80%;
		}
	</style>
	<p>
	<?php
		echo search("LPC(.+).</span>", null, false);
	?>
	</p>

	<div class="container">
		<h2><span class="green"><?php echo ucfirst(search("connectons-nous")); ?></span></h2>
		<img src="img/home.png" >
	</div>

</div>