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
		#info h2{
			cursor: pointer;
		}
		#info h2:hover span{
			color: #000;
		}
		@media (orientation: portrait) and (max-width: 1060px){
			#info{
				width: 100%;
				max-width: unset;
				font-size: 50px;
				top: 290px;
			}
			#info img{
				width: 100%;
			}
		}
	</style>
	<p>
	<?php
		echo search("LPC(.+).</span>", null, false);
	?>
	</p>

	<div class="container">
		<h2><span class="green" data-click="signin"><?php echo ucfirst(search("connectons-nous")); ?></span></h2>
		<img src="img/home.png" >
	</div>

</div>