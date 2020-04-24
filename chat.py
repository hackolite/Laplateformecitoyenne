import websocket
import json
from random import randint
import string
import random
from rocketchat_API.rocketchat import RocketChat
from rocketchat_API.rocketchat import RocketChat
from rocketchat_API.rocketchat import RocketChat
import random, string
import requests
#requetes de l'API REST de rocketchat, différent de websocket
rocketChatServer = 'http://laplateformecitoyenne.com:3000'
rocket = RocketChat("laplateformecitoyenne", "bidultoto", server_url=rocketChatServer)
rep = rocket.login("laureote-loic@hotmail.fr","bidultoto").json()
authToken = rep["data"]["authToken"]
userId = rep["data"]["userId"]
print(userId,",", authToken)
headers = {
    'X-User-Id': userId,
    'X-Auth-Token': authToken,
    'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8',
}
response = requests.get('http://laplateformecitoyenne.com:3000/api/v1/rooms.get', headers=headers)
resp = response.json()
print(resp)
for i in resp['update']:
    if i["name"] == "cheufi":
        print(i["_id"])
        room_id = i["_id"]
def randomString(stringLength=8):
    letters = string.ascii_lowercase
    return ''.join(random.choice(letters) for i in range(stringLength))
#connection a son compte administrateur pour avoir les droits
rocket = RocketChat("laureote-loic@hotmail.fr", "bidultoto", server_url="http://laplateformecitoyenne.com:3000")
#générer un fake compte de quelqu'un qui veux se connnecter: mail, username, name
email = randomString(stringLength=8) + "@hotmail.fr"
username  = randomString(stringLength=8)
name = randomString(stringLength=8)
print("CREER USER:",username)
response = rocket.users_create(username=username,email=email, name=name, password="password")
rep = rocket.login(email,"password").json()
#A la creation de l'utilisateur, il y a un token qui est créé pour qu'il puisse se logger.
authToken = rep["data"]["authToken"]
print("GENERATION TOKEN UTILISATEUR :", authToken)
connection_dict = {"msg": "connect","version": "1", "support": ["1"]}
login_dict  = {"msg": "method","method": "login","id": "login","params": [{ "resume":authToken}]}
channel_connection_message_stream_dict = {"msg": "sub","id": "sub"+randomString(8),"name": "stream-room-messages","params":[room_id,False]}
#channel_subscription_dict = {"msg": "method","method": "subscriptions/get","id": "42","params": [ { "$date": 1595071250591} ]}
#send_message_dict = '{"msg": "method","method": "sendMessage","id": "send","params": [{"_id":{},"rid": "wEofXojPWApx5CPWr","msg": "Hey comrad!"}]}'
flag = 1
import time
def on_message(ws, message):
    global flag
    '''
        This method is invoked when ever the client
        receives any message from server
    '''
    print("received message as {}".format(message))
    y = json.loads(message)
    print(message)
    #a renvoyer en permanence pour garder la connection
    if y["msg"] == "ping" :
        print("send pong")
        ws.send(json.dumps({"msg":"pong"}))
        #_id = y["id"]
        #print(_id)
        #if (randint(0,1) == 1) and (flag == 0):
        print("SUB message =", y)
        try :
           obj5 = {"msg": "method","method": "sendMessage","id": '42',"params": [{"_id":randomString(8),"rid": room_id,"msg":randomString(40),"u":{"_id": authToken,"username": username}}]}
        except Exception as e:
              print(e)
        print("send message")
        ws.send(json.dumps(obj5))
    if randint(0,3) == 2:
        #have to be tried only once, and not right after the beginning
        if flag == 1:
            print("connection requests")
            ws.send(json.dumps(login_dict))
            flag = 0
    if y["msg"] == "connected" :
        print("subscribe")
        ws.send(json.dumps(channel_connection_message_stream_dict))
    #quelquefois "sub or no sub" difficile a comprendre si ça fonctionne
    #if y["msg"] == "nosub" or y["msg"] == "sub" or y["msg"]=="ready":
def on_error(ws, error):
    '''
        This method is invoked when there is an error in connectivity
    '''
    print("received error as {}".format(error))
def on_close(ws):
    '''
        This method is invoked when the connection between the
        client and server is closed
    '''
    print("Connection closed")
def on_open(ws):
    '''
        This method is invoked as soon as the connection between
		client and server is opened and only for the first time
    '''
    #ws.send("hello there")
    ws.send(json.dumps(connection_dict))
    print("sent message on open")

    
if __name__ == "__main__":
    #websocket.enableTrace(True)
    ws = websocket.WebSocketApp("ws://laplateformecitoyenne.com:3000/websocket",
                              on_message = on_message,
                              on_error = on_error,
                              on_close = on_close)
    ws.on_open = on_open
    #ws.send(json.dumps(obj))
    ws.run_forever()
