const url = 'wss://plateformecitoyenne.rocket.chat/websocket';
const ws = new WebSocket(url);

const now = Date.now();
let roomToLoad = null;
let userConnected = null;
let subscriptions = null;
let rooms = null;

// Websocket functions
const pong = () => {
    const message = {
        "msg": "pong",
    }
    ws.send(JSON.stringify(message));
}

const getSubscriptions = () => {
    const message = {
        "msg": "method",
        "method": "subscriptions/get",
        "id": "subscriptions",
        "params": []
    }
    ws.send(JSON.stringify(message));
}

const subscribeToRoom = (roomId) => {
    const message = {
        "msg": "sub",
        "id": "subscribeToRoom-"+roomId,
        "name": "stream-room-messages",
        "params":[
            roomId,
            false
        ]
    }
    ws.send(JSON.stringify(message));
}

const getAllRoomOfUser = () => {
    const message = {
        "msg": "method",
        "method": "rooms/get",
        "id": "rooms",
        "params": []
    }
    ws.send(JSON.stringify(message));
}

const getRoomHistory = (roomId) => {
    const message = {
        "msg": "method",
        "method": "loadHistory",
        "id": "history",
        "params": [ roomId, null, 50, { "$date": now } ]
    };
    ws.send(JSON.stringify(message));
}

const sendMessage = (text, roomId) => {
    const message = {
        "msg": "method",
        "method": "sendMessage",
        "id": "sendMessage",
        "params": [
            {
                "rid": roomId,
                "msg": text
            }
        ]
    };
    ws.send(JSON.stringify(message));
}

// Handler functions
const getRoomHtmlForContactWrapper = (roomObject, classAttributes = '') => {
    const id = roomObject._id;
    let lastMessage = '';
    let name = '';

    if (roomObject.lastMessage) {
        lastMessage = DOMPurify.sanitize(roomObject.lastMessage.msg);
    }

    if (roomObject.name) {
        name = DOMPurify.sanitize(roomObject.name);
    } else if(userConnected !== null) {
        const usernames = roomObject.usernames;
        usernames.forEach((username) => {
            if (username !== userConnected.username) {
                name = DOMPurify.sanitize(username);
            }
        });
    }
    return "<li id='" + id + "' class='room " + classAttributes + "' data-click='chat'><div class='wrap' data-click='chat'><div class='meta' data-click='chat'><p class='name' data-click='chat'>" + name + "</p><p class='preview'>"+ lastMessage +"</p></div></div></li>";
}

const getMessageHtml = (messageObject, type, classAttributes = '') => {
    if (type === 'sent') {
        return "<li id='" + messageObject._id + "' class='sent'" + classAttributes + "'><p>" + DOMPurify.sanitize(messageObject.msg) + "</p></li>";
    } else if (type === 'replies') {
        return "<li id='" + messageObject._id + "' class='replies'" + classAttributes + "'><p>" + DOMPurify.sanitize(messageObject.msg) + "</p></li>";
    }
}

const pushMessage = (roomId, message) => {
    const wrapperMessages = f.query('#messages-wrapper');
    const roomIdCurrentConversation = f.query("input[name='roomId']").value;

    if(roomId === roomIdCurrentConversation) {
        wrapperMessages.innerHTML += getMessageHtml(message, 'replies');
    }
}

// Functional functions
const selectRoom = (roomId = '') => {
    const activeRoom = f.query('.room.active');
    const selectedRoom = f.query(".room#" + roomId);
    const inputRoomId = f.query("input[name='roomId']");
    const roomName = f.query(".room#" + roomId + " .name").innerHTML;
    const wrapperRoomName = f.query('#room-name');

    const spinnerConversation = f.query('#spinnerConversation');
    spinnerConversation.classList.add('loading');

    if(activeRoom) {
        activeRoom.classList.remove('active');
    }
    if(selectedRoom) {
        selectedRoom.classList.add('active');
    }
    inputRoomId.value = roomId;
    wrapperRoomName.innerHTML = roomName;

    getRoomHistory(roomId);
    subscribeToRoom(roomId);

    spinnerConversation.classList.remove('loading');
}

const postMessageToRocket = () => {
    const wrapperMessages = f.query('#messages-wrapper');
    const inputMessage = f.query('#message-input');
    const message = inputMessage.value;
    const roomId = f.query("input[name='roomId']").value;
    const messageToPost = {msg: message, id: 'newMessage'};

    inputMessage.value = '';
    wrapperMessages.innerHTML += getMessageHtml(messageToPost, 'sent', '');

    sendMessage(message, roomId);
}

const connectChat = (username, password) => {
    const pingMessage = {
        "msg": "connect",
        "version": "1",
        "support": ["1"]
    };

    const login = {
        "msg": "method",
        "method": "login",
        "id": "login",
        "params": [
            {
                "user": {"username": username},
                "password": {
                    "digest": password,
                    "algorithm": "sha-256"
                }
            }
        ]
    };

    ws.onopen = () => {
        ws.send(JSON.stringify(pingMessage));
        ws.send(JSON.stringify(login));
        getAllRoomOfUser();
        getSubscriptions();
    }

    ws.onerror = (error) => {
        console.log(`WebSocket error: ${error}`);
    }

    ws.onmessage = (e) => {
        const data = JSON.parse(e.data);
        if(data.msg === 'ping') { // heart beating...
            pong();
        }

        if(data.msg === 'changed') {
            const roomId = data.fields.eventName;
            const messages = data.fields.args.filter((message) => message.u._id !== userConnected.id); // tableau de messages des autres utilisateurs seulement
            messages.forEach((message) => {
                pushMessage(roomId, message);
            });
        }

        switch (data.id) {
            case 'login':
                userConnected = data.result;
                break;

            case 'rooms':
                rooms = data.result.filter(room => {
                    return room.t === 'd' && room.usersCount === 2 // filtre sur les conversations privées
                });

                let oneRoomIsActivated = roomToLoad !== null; // si on doit ouvrir une room en particulier on empêche l'activation d'une autre room
                let roomListHTML = '';
                rooms.forEach((room) => {
                    if (roomToLoad !== null && room._id === roomToLoad._id) { // si on doit ouvrir une room en particulier
                        roomListHTML += getRoomHtmlForContactWrapper(room, 'active');
                    } else if (!oneRoomIsActivated) { // sinon on ouvre la room ayant le message le plus récent
                        oneRoomIsActivated = true;
                        roomToLoad = room;
                        roomListHTML += getRoomHtmlForContactWrapper(room, 'active');
                    } else if (room.name === undefined) {
                        roomListHTML += getRoomHtmlForContactWrapper(room, '');
                    }
                });
                const wrapperRooms = f.query('#contacts');
                wrapperRooms.innerHTML = roomListHTML;
                selectRoom(roomToLoad._id, '', userConnected);
                break;

            case 'history':
                const messages = data.result.messages.reverse(); // tableau de message inversé (message le plus vieux en premier)
                let messageList = '';
                messages.forEach((message) => {
                    if (message.u._id === userConnected.id) {
                        messageList += getMessageHtml(message, 'sent');
                    } else {
                        messageList += getMessageHtml(message, 'replies');
                    }
                });
                const wrapperMessages = f.query('#messages-wrapper');
                wrapperMessages.innerHTML = messageList;
                break;

            case 'subscriptions':
                subscriptions = data.result;
                break;
            case 'subscribeToRoom':
                break;
        }
    }
}
