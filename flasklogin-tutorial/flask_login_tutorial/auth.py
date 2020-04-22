"""Routes for user authentication."""
from flask import redirect, render_template, flash, Blueprint, request, url_for
from flask_login import login_required, current_user, login_user
from flask import current_app as app
from .assets import compile_auth_assets
from .forms import LoginForm, SignupForm
from .models import db, User
from .import login_manager
from flask_cors import CORS, cross_origin
import json
from flask import request, url_for,jsonify
from geopy.geocoders import MapBox
import random


# Blueprint Configuration
auth_bp = Blueprint('auth_bp', __name__,
                    template_folder='templates',
                    static_folder='static')
compile_auth_assets(app)


@auth_bp.route('/signup', methods=['POST'])
@cross_origin(origin='http://127.0.0.1/',headers=['Content- Type','Authorization'])  #allow CORS request form the origin
def signup():
    """
    User sign-up page.
    GET: Serve sign-up page.
    POST: If submitted credentials are valid, redirect user to the logged-in homepage.
    """
    print("yesy")
    if request.method == 'POST':
        name = request.form['username']
        email = request.form['email']
        postal = request.form['postal']
        password = request.form['mdp']
        existing_user = User.query.filter_by(email=email).first()  # Check if user exists
        API_KEY = "pk.eyJ1IjoiaGFja29saXRlIiwiYSI6ImNqaHQ3NmV4cDA3YTgzdm9uemwwdGQ5eTgifQ.wzyI9hf1DxLdK6jfwrUmjQ"
        geolocator = MapBox(api_key=API_KEY)
        
        location = geolocator.geocode(postal,country="FR")
        latitude = location.latitude + random.random()/10000
        longitude = location.latitude + random.random()/10000


        if existing_user is None:
                user = User(first_name=name, email=email, postal=postal, latitude=latitude, longitude=longitude, type="maker")
                user.set_password(password)
                db.session.add(user)
                db.session.commit()  # Create new user
                return json.dumps({"statuscode" : 200, "id" : 1, "postal":postal, "email":email, "username" : name})
        else :
            return {"statuscode": 200, "username":"recorded"}


@auth_bp.route('/signin', methods=['POST'])
@cross_origin(origin='http://127.0.0.1/',headers=['Content- Type','Authorization'])  #allow CORS request form the origin
def login():
    """
    User login page.
    GET: Serve Log-in page.
    POST: If form is valid and new user creation succeeds, redirect user to the logged-in homepage.
    """
    if current_user.is_authenticated:
        return {"statuscode": "200", "username" :"connected yet"}

    if request.method == 'POST':
            email = request.form['email']
            password = request.form['mdp']
            user = User.query.filter_by(email=email).first()  # Validate Login Attempt
            if user and user.check_password(password=password):
                login_user(user)
            else:
                
               return json.dumps({"statuscode" : 200, "username" : "something is wrong "})
             
    return json.dumps({"statuscode" : 200, "id" : user.id, "postal":user.postal, "email":user.email, "username" : user.first_name})



@auth_bp.route('/user_need',methods=["GET"])
@cross_origin(origin='http://127.0.0.1/',headers=['Content- Type','Authorization'])  #allow CORS request form the origin
def get_user():
    """Return all the users form the DB. If no parameters specified for type, medic and maker are returned"""
    # /user_need?type=maker return all maker
    # /user_need?type=medical return all hospital etc..
    # /user_need return all users
    print(request.form)
    type = request.args.get("type") or None;


    if type != None:
        users = User.query.filter_by(type=type).all()
        return jsonify(json_list=[i.serialize for i in users])
    else:
        users = User.query.all()
        return jsonify(json_list=[i.serialize for i in users])





@auth_bp.route('/update_user_need',methods=["POST"])
def update_user_need():
    """Creer un point a un endroit designé par un nom de ville. Ce point est associé a un email.
    Si l'utilisateur a deja un point cela va l'update, sinon cela va creer un nouveau point"""
    name = request.form.get('name') or "None"
    email = request.form.get('email') or "None"
    type = request.form.get('type') or "None"
    town = request.form.get('town') or "Paris"
    fabricMask = request.form.get('fabricMask') or 0
    surgicalMask = request.form.get('surgicalMask') or 0
    constructionMask = request.form.get('constructionMask') or 0
    glasses = request.form.get('glasses')  or 0
    blouse = request.form.get('blouse') or 0
    visor = request.form.get('visor') or 0

    print(type,town,fabricMask,surgicalMask,constructionMask,glasses,blouse,visor)

    
    user = User.query.filter_by(email=current_user.email).first()


    # Ajout d'un legere difference de coordonnée pour ne pas superposer les points
    # !!!!!  Pas eu le temps de tester ca !!!!!!!
    # Si vous voulez utilisez ca, remplacez les location.latitude par latitude
    # WARNING: !!!!!!!!!!!!!



    # WARNING: !!!!!!!!!!!!!


    if user:
        print("User found")
        user.name=name
        user.email=email
        user.type=type
        user.latitude=location.latitude
        user.longitude=location.longitude
        user.fabricMask=fabricMask
        user.surgicalMask=surgicalMask
        user.constructionMask=constructionMask
        user.glasses=glasses
        user.blouse=blouse
        user.visor=visor
        db.session.commit()
        return redirect(url_for('main.home_page'))

    else :
        user = User(name=name,email=email,type=type,latitude=location.latitude,longitude=location.longitude,fabricMask=fabricMask,surgicalMask=surgicalMask,constructionMask=constructionMask,glasses=glasses,blouse=blouse,visor=visor)
        db.session.add(user)
        db.session.commit()



@login_manager.user_loader
def load_user(user_id):
    """Check if user is logged-in on every page load."""
    if user_id is not None:
        return User.query.get(user_id)
    return None


@login_manager.unauthorized_handler
def unauthorized():
    """Redirect unauthorized users to Login page."""
    flash('You must be logged in to view that page.')
    return redirect(url_for('auth_bp.login'))