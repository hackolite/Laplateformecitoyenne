	</div>


<div id="bottom">
	<div id="btt_bottom" data-click="bottom">&copy LaPlateformeCitoyenne</div>
	<div style="margin-bottom: 45px;">&copy 2020 LaPlateformeCitoyenne - <?php echo search("all(.+)reserved"); ?></div>
	<ul>
		<h3><?php echo search("policy"); ?></h3>
		<li><a href="/link/?link=legal"><?php echo search("legal mention"); ?></a></li>
		<!--<li><a href="#"><?php echo search("Confidentialité"); ?></a></li>-->
	</ul>
	<ul>
		<h3><?php echo search("our partners"); ?></h3>
		<li><a href='/link/?link=adresse93075' target="_blank">adresse93075</a></li>
		<li><a href='/link/?link=360medics' target="_blank">360 medics</a></li>
	</ul>
	<ul>
		<h3>Contact</h3>
		<li><a href="tel:+33624321664">06 24 32 16 64</a></li>
		<li><a href="mailto:laplateformecitoyenne@gmail.com">E-MAIL</a></li>
	</ul>
	<ul>
		<h3><?php echo search("Social media"); ?></h3>
		<li><a href="/link/?link=fb" target="_blank">Facebook</a></li>
		<li><a href="/link/?link=lk" target="_blank">LinkedIn</a></li>
		<li><a href="/link/?link=insta" target="_blank">Instagram</a></li>
	</ul>
	<ul>
		<h3>Citoyen</h3>
		<li>
			<a href="#" data-click="signup" onclick="return false;"><?php echo search("s'inscrire"); ?> ?</a>
			<a href="#" data-click="signin" onclick="return false;"><?php echo ucfirst(search("connexion")); ?> ?</a>
		</li>
		<li><a href="#"><?php echo search("devenir partenaire");?> ?</a></li>
		<li><a href="#"><?php echo search("presse");?></a></li>
	</ul>


</div>


<script>
// on attend que la page est fini de se charger
/*var t = setInterval(function(){

	if(document.querySelector && document.addEventListener){
		// page prête

		onReady();

		clearInterval(t);
	}

}, 10);*/

document.addEventListener('DOMContentLoaded', (event) => {
	onReady();
});

</script>

<div class="white_space"></div>
</body>
</html>