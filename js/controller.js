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
			location, type, ready, settings, responseText, error
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
		if(xhr.readyState == 4){
			if(xhr.status == 200 ){
				if(e.responseText == true){
					e.ready(xhr.responseText);
				}else{
					e.ready(xhr.response);
				}
			
			}else{
				e.error(xhr.status);
			}
		}

	};

	if(e.type == "GET"){
		xhr.send(null);
	}
	else{
		xhr.send(e.settings);
	}
	
};


f.switcher = function(elmt, a, b){
	try{

		var rg = new RegExp(a);
		if(rg.test(elmt.className)){
			elmt.classList.remove(a);
			elmt.classList.add(b);
		}else{
			elmt.classList.remove(b);
			elmt.classList.add(a);
		}
		return true;
	}catch(err){
		return false;
	}
};

var onReady = function(){

f.box = function(text, type='red'){
	// par défault, c'est le box d'erreur
	const box = f.query('#_box');

	if(!/on/.test(box.className)){
		// si on non présent on le rajoute
		box.classList.add("on");
		box.classList.remove("off");
	}
	const rg = new RegExp(type);
	if(!rg.test(box.className)){
		box.classList.add(type);

		if(type == 'red' || type == 'green'){
			box.classList.remove("blue");
		}
		if(type == 'red' || type == 'blue'){
			box.classList.remove("green");
		}
		if(type == 'green' || type == 'blue'){
			box.classList.remove("red");
		}
	}

	f.switcher(box, 'on', 'on');

	box.querySelector('p.mssg').innerHTML = text;

};

f.trycatch = function(callback, callbackErr=null){

	try{
		callback();
	}catch(err){
		if(callbackErr != null){
			callbackErr(err);
		}
	}

};

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
			if(/hidden/.test(page[i].className)){
				// on affiche l'onglet et on cache le bottom de la map, et on 'allume' le bouton
				p = ['shown', 'hidden', 'on', 'off'];
			}else{
				p = ['hidden', 'shown', 'off', 'on'];
			}

			page[i].classList.add(p[0]);
			page[i].classList.remove(p[1]);

		}else if(/shown/.test(page[i].className)){
			// on cache toutes les autres fenêtres non cachées
			page[i].classList.add('hidden');
			page[i].classList.remove('shown');
			page[i].querySelector('form').reset(); 
			// on supprime les données saisies pour sécuriser

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

		if(!/shown/.test(left.className)){
			// si le left n'est pas affiché par défault
			left.classList.add('shown');
			left.classList.remove('hidden');

			right.classList.add('hidden');
			right.classList.remove('shown');
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

f.page.load.recevoir 
= f.page.load.donner 
= f.page.load.signup 
= f.page.load.signin 
= f.page.load.account = function(e){
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

	if(/hidden/.test(bloc1.className)){
		p = ['shown', 'hidden'];
	}else{
		p = ['hidden', 'shown'];
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

	// pour valider les formulaires
	try{
		const form = e.target.getAttribute('data-form');

		if(/sign/.test(form)){

			// si formulaire de log
			let url = "";
			if(form == "signup"){
				url="/login";
			}
			else if(form == "signin"){
				url="/register";
			}else{
				return;
			}

			f.page.form.log(e, url, form);
		}

		if(/recevoir|donner/.test(form)){
			let url = '/'+form;
			f.page.form.carte(e, url, form);
		}
	}

	catch(err){
		f.box("[FORM]: " + err);
	}


};

f.page.form = {};
f.page.form.log = function(e, url, form){
	// listage de tous les champs du formulaire afin de les passer en paramètres
	let inputs = f.query('#' + e.target.getAttribute('data-form') + ' input', true);

	// données à envoyer au serveur
	let settings = ''; 
	let valider = true;
	for(var i = 0; i < inputs.length; i++){

		if(inputs[i].name == 'cgu'){
			if(inputs[i].checked != true){
				// on bloque si une checkbox n'est pas check
				f.box(mssg.cgu);
				return
			}
		}
		
		if(/text|email|password/.test(inputs[i].type)){
			// si champs de complétition
		 	if(inputs[i].value == ""){
		 		// si vide erreur
				inputs[i].classList.add('empty');
				valider = false;
			}else if(/empty/.test(inputs[i].className)){
				// si champs erreur, mais correct cette fois-ci
				inputs[i].classList.remove('empty');
			}
		}

		let prefixe = '';
		if(i != 0){
			prefixe = '&';
		}
		settings += prefixe +  inputs[i].name + "=" + inputs[i].value;
	}

	if(valider == false){ return; } 
	// on attend que tous les champs soient analysés avant de stopper

	f.AJAX({
		location: url,
		settings: settings,
		type: 'POST',
		ready: function(rep){
			try{
				// on appelle la fonction associer qui va traiter les données reçu par le serveur
				rep = JSON.parse(rep);
				f.page.form[form](rep);
			}catch(err){
				f.box(mssg.serveur.error);
				console.error(err);
			}
		},
		error: function(err){
			f.box(mssg.account.error + ": " + err);
		}
	});
};

f.page.form.signin = function(rep){
	// quand le serveur a retourné une réponse

	let settings = "";

	// on décortique les paramètres
	for(var param in rep){
		if(param != "statuscode"){
			// on ne prend pas le status code pour la connexion
			settings += '&' + param + "=" + rep[param];
		}
	}
	settings = settings.substr(1, settings.length); // le premier & n'est pas inclue

	if(rep.statuscode == 200){
		// si statuscode 200, on crée une nouvelle session
		f.AJAX({
			location: '/serveur/connect.php',
			type: 'POST',
			settings: settings,
			ready: function(s){
				if(s == 'connect'){
					// on réactualise la page

					// on supprime les paramatre GET lié à une déconnexion
					// vu que l'on va se connecter et pas se déco sur phyton
					let url = document.location.href;
					url = url.replace(/(&|\?)?logout=?(.+)?&?/, '');
					url = url.replace(/(&|\?)?id=?(.+)?&?/, '');
					document.location.href = url;
				}else{
					f.box(mssg.account.error + ": " + s);
				}
			}

		});
	}else{
		f.box(mssg.account.noexist);
	}

};

f.page.form.signup = function(rep){
	f.box(mssg.indisponible);
};

f.page.form.carte = function(e, url, form){

	let inputs = f.query('#' + form + ' input', true);
	// on récup l'identifiant du compte
	let settings = "";
	let valider = true;

	f.trycatch(function(){
		settings += "id=" + f.query("#account .info").id;
		settings += "&form=" + form;

		for(var i = 0; i < inputs.length; i++){

			if(/^([0-9]+)$/.test(inputs[i].value)){
				// on s'assure qu'il n'y a que des nombres
				inputs[i].classList.remove('empty');
				settings += "&" + inputs[i].name + "=" + inputs[i].value;
			}else{
				// sinon on le met en surbrillance
				inputs[i].classList.add('empty');
				// et on annule l'envoie de données
				valider = false;
			}

		}

		if(valider == true){
			console.log("hh");
			f.AJAX({
				location: url,
				settings: settings,
				type: 'POST',
				ready: function(rep){

					f.trycatch(()=>{
						rep = JSON.parse(rep);
						if(rep.statuscode == 200){
							f.box(mssg.form.valid, 'blue');
						}
					}, (err)=>{
						// soit serveur envoie de mauvaise données, soit probleme de compte
						f.box(mssg.serveur.error);
						console.error(err);
					});
					
				},
				error: function(err){
					f.box(mssg.form.error + " \n" + err);
				}
			});

		}

	}, function(err){
		// si id non existant, c'est qu'il n'y a pas le form d'account, donc non connecté
		f.box(mssg.compterequit);
	});
		

};


f.page.load.box = function(e){
	// afficher/cacher le message de box
	f.switcher(e.target.parentNode, 'on', 'off');
};


f.page.load.map_info = function(e){
	// message d'info afficher sous la barre de recherche sur la map

	let nav = e.target.parentNode.parentNode;
	// si message d'info cacher, on l'affiche
	f.switcher(nav, 'on_info', 'off_info');
};


f.page.load.checkbox = function(e){
	var label = e.target.parentNode;
	f.switcher(label, 'on', 'off');
};


o.carte.box.checker = function(e){

	f.switcher(e.target, 'on', 'off');

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
f.trycatch(function(){
	o.carte.box.maker.addEventListener('click', o.carte.box.checker);
	o.carte.box.medical.addEventListener('click', o.carte.box.checker);
}, function(err){
	console.warn(err);
});


document.addEventListener('click', function(e){

	let elmt = e.target;
	let attr = e.target.getAttribute('data-click');
// gestion des cliques
	if(attr){

		f.clickEvent(e, attr);

	}

});


f.trycatch(function(){
	// animation logo
	const title = f.query('#title');

	setTimeout(()=>{
		title.classList.add('on');

		setTimeout(()=>{
			f.switcher(title, 'on', 'off');
		}, 4500);
	}, 2500);



});

// on déconnecte la session sur python et on affiche un message de confirmation
f.trycatch(function(){
	if(logout[0] == 'auto'){
		f.box(mssg.logout.auto, 'blue');
	}else if(logout[0] == 'expired'){
		f.box(mssg.logout.expired);
	}

	f.AJAX({
		location: '/logout',
		type: 'POST',
		settings: 'id=' + logout[1],
		ready: function(){},
		error: function(){}
	})

});

};
