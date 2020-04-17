from rocketchat import RocketChat
from pprint import pprint
from rocketchat_API.rocketchat import RocketChat
from secrets import *
import os


rocketChatServer = 'http://laplateformecitoyenne.rocket.chat'

ADMIN_ID = os.environ['ADMIN_ID']
ADMIN_PASS = os.environ['ADMIN_PASS']

rocket = RocketChat(ADMIN_ID, ADMIN_PASS, server_url=rocketChatServer)

def createNewUser(username,email,name,password):
    print("Creating new user")
    response = rocket.users_create(username=username,email=email, name=name, password=password).json()
    pprint(response)

    # Return false if the user wasn't created
    return response["success"]


def loginUser(email,password):
    rep = rocket.login(email,password).json()

    if rep["success"]:
        authToken = rep["data"]["authToken"]
        return authToken
    else : return False
