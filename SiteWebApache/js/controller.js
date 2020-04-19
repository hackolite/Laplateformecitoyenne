var f = {};
var o = {};


/*
###### FONCTION DE BASE ####
*/

f.query = function(elmt, all=false){
	if(all == true){
		return document.querySelectorAll(elmt);
	}
	return document.querySelector(elmt);
};

f.AJAX = function (e){
	/*
		e = {
			location, type, ready, settings, responseText
		}

	*/
	var xhr = new XMLHttpRequest();

	if(e.type == "GET"){
		e.location += "?" + e.settings;
	}

	xhr.open(e.type, e.location);
	
	if(e.type=="POST"){
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	}

	xhr.onreadystatechange = function(){
		if(xhr.status == 200 && xhr.readyState == 4){
			if(e.responseText == true){
				e.ready(xhr.responseText);
			}else{
				e.ready(xhr.response);
			}
			
			//console.log(xhr.responseText);
		}
	};

	if(e.type == "GET"){
		xhr.send(null);
	}
	else{
		xhr.send(e.settings);
	}
	
};



var onReady = function(){

/*
##### VARIABLE ####
*/

o.carte = {};
try{
	o.carte.box = {
		maker: f.query('.checkbox.makers'),
		medical: f.query('.checkbox.medicals')
	};
}catch(err){
	console.warn(err);
}

/*
##### FONCTION EVENT #####
*/

f.clickEvent = function(e, v = null){

	// fonction déclenchée par un clique
	// permettant de restribuer vers les fonctions associées

	if(v == null){
		v = e.target.getAttribute('data-click');
	}

	try{
		f.page.load[v](e);

	}catch(err){
		//console.error(err);
	}

};

f.page = {};
f.page.load = {};

f.page.load.action = function(e, action){

	// affichage de la popup de droite
	var page = f.query('.formulaire', true);

	var bottom = f.query("#map bottom");
	var btt = f.query('header .'+action);
	var p = [];

	for(var i = 0; i < page.length; i++){

		if(page[i].id == action){

			// si la page correspond à l'action
			if(/hide/.test(page[i].className)){
				// on affiche l'onglet et on cache le bottom de la map, et on 'allume' le bouton
				p = ['visible', 'hide', 'on', 'off'];
			}else{
				p = ['hide', 'visible', 'off', 'on'];
			}

			page[i].classList.add(p[0]);
			page[i].classList.remove(p[1]);

		}else if(/visible/.test(page[i].className)){
			// on cache toutes les autres fenêtres non cachées
			page[i].classList.add('hide');
			page[i].classList.remove('visible');
			let _btt = f.query('header .' + page[i].id);
			if(_btt != null){
				// on s'assure qu'il y a la présence d'un bouton dans l'en-tête qui a été mise en surbrillance ou non
				_btt.classList.add('off');
				_btt.classList.remove('on');
			}
		}


		// peut importe les cas, on mettra la première page de chaque formulaire
		let left = page[i].querySelector('.form.left');
		let right = page[i].querySelector('.form.right');

		if(!/visible/.test(left.className)){
			// si le left n'est pas affiché par défault
			left.classList.add('visible');
			left.classList.remove('hide');

			right.classList.add('hide');
			right.classList.remove('visible');
		}

	}

	// afficher/cacher le bottom de la carte contenant les boutons
	bottom.classList.add(p[1]);
	bottom.classList.remove(p[0]);
	// mise en surbrillance ou non du boutons sur l'en-tete
	if(btt != null){
		btt.classList.add(p[2]);
		btt.classList.remove(p[3]);
	}

};

f.page.load.recevoir = f.page.load.donner = f.page.load.signup = f.page.load.signin = function(e){
	// on assigne les fonctions recevoir et donner à la même fonction
	f.page.load.action(e, e.target.getAttribute('data-click'));
};


f.page.load.next = function(e){

	// permet de switcher entre les éléments du formaulaire

	var bloc1 = e.target.parentNode.parentNode;


	if(/left/.test(bloc1.className)){
		var bloc2 = bloc1.parentNode.querySelector('.form.right');
	}else{
		var bloc2 = bloc1.parentNode.querySelector('.form.left');
	}

	// les div left ou right de chaque onglet respectif du bouton déclencheur
	var p = [];

	if(/hide/.test(bloc1.className)){
		p = ['visible', 'hide'];
	}else{
		p = ['hide', 'visible'];
	}

	bloc1.classList.add(p[0]);
	bloc1.classList.remove(p[1]);

	bloc2.classList.add(p[1]);
	bloc2.classList.remove(p[0]);

	// on remonte le scroll en haut lors du changement de page du formulaire
	var y = bloc1.parentNode.parentNode.scrollTop
	var formulaire = bloc1.parentNode.parentNode
	var t = setInterval(function(){
		if(y > 0){
			formulaire.scrollTo(0, y);
			y-=10;
		}else{
			clearInterval(t);
		}
	}, 10);



};


f.page.load.submit = function(e){
	// listage de tous les champs du formulaire afin de les passer en paramètres
	let inputs = f.query('#' + e.target.getAttribute('data-form') + ' input', true);
// pour valider les formulaires
try{
// location, type, ready, settings, responseText
console.log(inputs)


}

	catch(err){
		alert("Oops...\nNous sommes actuellement en phase de test, cette fonctionnalité n'est malheuresement pas encore disponible 😥"
		+"\nNous vous invitons à revenir quand nous serons prêt ! Merci de votre soutien !"
		+"\n\nOops...\nWe are currently in testing phase, this fonctionnality are unfortunately not available 😥"
		+"\nWe invite you to come back when we are ready ! Thank you for your support !");
	}



};

f.page.load.map_info = function(e){
	// message d'info afficher sous la barre de recherche sur la map

	let nav = e.target.parentNode.parentNode;
	let p = [];

	if(/off/.test(nav.className)){
		// si message d'info cacher, on l'affiche
		p = ['on', 'off'];
	}else{
		p = ['off', 'on'];
	}

	nav.classList.add(p[0] + "_info");
	nav.classList.remove(p[1] + "_info");

};


f.page.load.checkbox = function(e){

	var label = e.target.parentNode;
	var p = [];


	if(/off/.test(label.className)){
		p = ['on', 'off'];
	}else{
		p = ['off', 'on'];
	}

		console.log(p);

	label.classList.add(p[0]);
	label.classList.remove(p[1]);

};


o.carte.box.checker = function(e){
	if(/on/.test(e.target.className)){
		var v = ['on','off'];
		// si allumer, on l'éteint
	}else{
		var v = ['off','on'];
		// on affiche les points correpondant s de la carte
	}

	e.target.classList.remove(v[0]);
	e.target.classList.add(v[1]);

	try{
		let type = [];
		if(/on/.test(o.carte.box.maker.className)){
			type.push('maker');
		}
		if(/on/.test(o.carte.box.medical.className)){
			type.push('medical');
		}

		getMarkers(type);

	}catch(err){
		console.warn(err);
	}



};

/*
#### EVENT CALL ASSIGNEMENT ###
*/
try{

	o.carte.box.maker.addEventListener('click', o.carte.box.checker);
	o.carte.box.medical.addEventListener('click', o.carte.box.checker);
}catch(err){
	console.warn(err);
}

document.addEventListener('click', function(e){

	let elmt = e.target;
	let attr = e.target.getAttribute('data-click');
// gestion des cliques
	if(attr){

		f.clickEvent(e, attr);

	}

});


};
