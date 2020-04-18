# Copyright 2014 SolidBuilds.com. All rights reserved
#
# Authors: Ling Thio <ling.thio@gmail.com>

from flask import Blueprint, redirect, render_template
from flask import request, url_for,jsonify
from flask_user import current_user, login_required, roles_required
from rocketchat_API.rocketchat import RocketChat
from app import db
from app.models.user_models import UserProfileForm
from app.commands.init_db import add_marker
from app import rocketChatAuth
from flask_cors import CORS, cross_origin



main_blueprint = Blueprint('main', __name__, template_folder='templates')
# CORS(main_blueprint)
cors = CORS(main_blueprint, resources={r"/*": {"origins": "*"}})


# The Home page is accessible to anyone
@main_blueprint.route('/')
def home_page():
    return render_template('main/home_page.html')


# The User page is accessible to authenticated users (users that have logged in)
@main_blueprint.route('/member')
@login_required  # Limits access to authenticated users
def member_page():
    #email = request.form.get('email')
    #name = request.form.get('name')
    email = request.form.get('username')
    password = request.form.get('password')

    print("ID : ",current_user.id)
    print("email : ",current_user.email)
    print("name : ",current_user.first_name)
    print("password : ",current_user.password)

    responsecode = rocketChatAuth.createNewUser(username=current_user.first_name+current_user.last_name,email=current_user.email, name=current_user.first_name, password=current_user.password)
    print(responsecode)
    #return render_template('main/map.html')
    return redirect(url_for('main.map'))

@main_blueprint.route('/map')
def map():
    print("map")
    return render_template('main/map.html')

@main_blueprint.route('/rocket_chat_iframe')
def rocket_chat_iframe():
    print("rocket_chat_iframe")

    if current_user.is_authenticated:
        authToken = rocketChatAuth.loginUser(current_user.email,current_user.password)
        print("rocket_chat_iframe send : ",authToken)
        return "<script>window.parent.postMessage({event: 'login-with-token',loginToken: "+authToken+"}, https://laplateformecitoyenne.rocket.chat');</script>"
    else :
        print("User not authenticated")


@main_blueprint.route('/rocket_chat_auth_get')
def rocket_chat_auth_get():
    print("rocket_chat_auth_get")

    if current_user.is_authenticated:
        authToken = rocketChatAuth.loginUser(current_user.email,current_user.password)
        print("rocket_chat_iframe send : ",authToken)
        return authToken
    else :
        print("User not authenticated")


# The Admin page is accessible to users with the 'admin' role
@main_blueprint.route('/admin')
@roles_required('admin')  # Limits access to users with the 'admin' role
def admin_page():
    return render_template('main/admin_page.html')



@main_blueprint.route('/main/profile', methods=['GET', 'POST'])
@login_required
def user_profile_page():
    # Initialize form
    form = UserProfileForm(request.form, obj=current_user)
    # Process valid POST
    if request.method == 'POST' and form.validate():
        # Copy form fields to user_profile fields
        form.populate_obj(current_user)

        # Save user_profile
        db.session.commit()

        # Redirect to home page
        return redirect(url_for('main.home_page'))

    # Process GET or invalid POST
    return render_template('main/user_profile_page.html',
                           form=form)

@main_blueprint.route('/addmarker')
@login_required
def addmarker():
    form = UserProfileForm(request.form, obj=current_user)

    return render_template('main/addmarker.html',form=form)


@main_blueprint.route('/addmarker',methods=["POST"])
@login_required
def addmarker_post():
    type="medical"
    fabricMask = request.form.get('fabricMask') or 0
    surgicalMask = request.form.get('surgicalMask') or 0
    constructionMask = request.form.get('constructionMask') or 0
    glasses = request.form.get('glasses')  or 0
    blouse = request.form.get('blouse') or 0
    visor = request.form.get('visor') or 0


    print("Add new point:",fabricMask,surgicalMask,constructionMask,glasses,blouse,visor)

    add_marker(type,fabricMask,surgicalMask,constructionMask,glasses,blouse,visor,current_user.id)

    return redirect(url_for('main.home_page'))
