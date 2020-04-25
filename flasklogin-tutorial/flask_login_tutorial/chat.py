"""Routes for user chat."""
import json
from flask import redirect, render_template, flash, Blueprint, request, url_for,jsonify
from flask_login import login_required, current_user, login_user
from flask import current_app as app
from .assets import compile_auth_assets
from .forms import LoginForm, SignupForm
from .models import db, User
from .import login_manager
from flask_cors import CORS, cross_origin
import random,string
from sqlalchemy import or_
from rocketchat_API.rocketchat import RocketChat




chat_bp = Blueprint('chat_bp', __name__,
                    template_folder='templates',
                    static_folder='static')

#connection a son compte administrateur pour avoir les droits
rocket = RocketChat("laureote-loic@hotmail.fr", "bidultoto", server_url="http://laplateformecitoyenne.com:3000")

@chat_bp.route('/start_chat', methods=['POST'])
@cross_origin(origin='http://127.0.0.1/',headers=['Content- Type','Authorization'])  #allow CORS request form the origin
def start_chat():
    senderId = request.form.get('senderId') or 0
    receiverId = request.form.get('receiverId') or 0

    print("Starting conversation between id ",senderId,"and id ",receiverId)
    sending_user = User.query.filter_by(id=senderId).first()
    receiving_user = User.query.filter_by(id=receiverId).first()

    if (sending_user and receiving_user):
        print("Starting conversation between ",sending_user.first_name,"and ",receiving_user.first_name)
        return json.dumps({"statuscode" : 200, "desc" : "starting conversation"})

    else :
        return json.dumps({"statuscode" : 500, "error" : "Couldn't find the two users"})



def createUser(name,email,password):
    global rocket
    username=name+"_"+randomString()
    print("CREER USER:",username)
    response = rocket.users_create(username=username,email=email, name=name, password=password)
    print("Response USER:",response.json())

    return [response.json()["success"],username]


def loginUser(name,email,password):
    global rocket
    rep = rocket.login(email,password).json()
    authToken = rep["data"]["authToken"]
    login_dict  = {"msg": "method","method": "login","id": "login","params": [{ "resume":authToken}]}
    ws.send(json.dumps(login_dict))



def randomString(stringLength=8):
    numbers = string.digits
    return ''.join(random.choice(numbers) for i in range(stringLength))
