let userConnected = null;
let credential = null;

///// Function générique permettant de faire les requêtes sur le serveur Rocket.chat avec un proxy /////
const requestToRocket = async (searchUrl, method, json = {}, authNeeded = false) => {
    const proxyurl = "https://cors-anywhere.herokuapp.com/"; //proxy pour dev
    let url = "https://plateformecitoyenne.rocket.chat/api/v1/" + searchUrl;

    let raw = '';
    if (method === 'POST') {
        raw = JSON.stringify(json);
    }

    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    if (authNeeded && credential !== null && credential.token && credential.id) { // si une authentification est nécessaire et que l'on a déjà les credentials
        myHeaders.append("X-Auth-Token", credential.token);
        myHeaders.append("X-User-Id", credential.id);
    } else if (authNeeded) {
        await login (userToConnect);
        myHeaders.append("X-Auth-Token", credential.token);
        myHeaders.append("X-User-Id", credential.id);
    }

    let requestOptions = {
        method: method,
        headers: myHeaders,
        redirect: 'follow'
    };

    if (method === 'POST') {
        requestOptions = {
            method: method,
            headers: myHeaders,
            body: raw,
            redirect: 'follow'
        };
    }

    return fetch(proxyurl + url, requestOptions)
        .then(response => response.json())
        .catch(error => console.log('Erreur : ', error));
}

const login = async (user) => {
    return await requestToRocket('login', 'POST', user)
        .then(r=> {
        if(r.status === 'success') {
            userConnected = r.data;
            credential = {token: r.data.authToken, id: r.data.me._id};
        }
    })
        .catch(r => console.log(r));
}

const getAllRoomOfUser = async () => {
    return await requestToRocket('rooms.get', 'GET', {}, true);
}

const getRoomWithUser = async (username) => {
    return await requestToRocket('im.create', 'POST', {username: username}, true);
}

const getRoomListHtml = (roomObject, classAttributes = '') => {
    const id = roomObject._id;
    let lastMessage = '';
    let name = '';

    // if (roomObject.lastMessage) {
    //     lastMessage = roomObject.lastMessage.msg;
    // }

    if (roomObject.name) {
        name = roomObject.name;
    } else if(userConnected !== null) {
        const usernames = roomObject.usernames;
        usernames.forEach((username) => {
            if (username !== userConnected.username) {
                name = username;
            }
        });
    }
    return "<li id='" + id + "' class='room " + classAttributes + "' data-click='chat'><div class='wrap' data-click='chat'><div class='meta' data-click='chat'><p class='name' data-click='chat'>" + name + "</p></div></div></li>";
}

const getRoomMessages = async (roomId) => {
    const url = 'im.history?roomId=' + roomId;
    return await requestToRocket(url, 'GET', {}, true)
}

const getRoomUnreadMessages = async (roomId) => {
    const url = 'im.history?roomId=' + roomId;
    return await requestToRocket(url, 'GET', {}, true)
}

const getMessageHtml = (messageObject, type, classAttributes = '') => {
    if (type === 'sent') {
        return "<li id='" + messageObject._id + "' class='sent'" + classAttributes + "'><p>" + messageObject.msg + "</p></li>";
    } else if (type === 'replies') {
        return "<li id='" + messageObject._id + "' class='replies'" + classAttributes + "'><p>" + messageObject.msg + "</p></li>";
    }
}

const sendMessage = async (message, roomId) => {
    return await requestToRocket('chat.postMessage', 'POST', {roomId: roomId, text: message}, true);
}

const getRoomName = (room, userConnected) => {
    if (room.name) {
        return room.name;
    } else if (room.usernames) {
        room.usernames.forEach(user => {
            if(user !== userConnected.me.username) {
                return user;
            }
        });
    }
    return '';
}

const selectRoom = async (roomId, roomName = '') => {
    const activeRoom = f.query('.room.active');
    const selectedRoom = f.query(".room#" + roomId);
    const wrapperRoomName = f.query('#room-name');
    const wrapperMessages = f.query('#messages-wrapper');
    const inputRoomId = f.query("input[name='roomId']");

    activeRoom.classList.remove('active');
    selectedRoom.classList.add('active');
    inputRoomId.value = roomId;

    await getRoomMessages(roomId)
        .then(r => {
            if(r.success) {
                const messages = r.messages.reverse(); // récupère le tableau de message inversé (message le plus vieux en premier)

                let messageList = '';
                messages.forEach((message) => {
                    if (message.u._id === userConnected.me._id) {
                        messageList += getMessageHtml(message, 'sent');
                    } else {
                        messageList += getMessageHtml(message, 'replies');
                    }
                });
                wrapperMessages.innerHTML = messageList;
                // wrapperRoomName.innerHTML = roomName.length > 0 ? roomName : getRoomName(room);
                wrapperRoomName.innerHTML = roomName;
            } else {
                return r.errorType;
            }
            })
        .catch(r => console.log(r))
}

const openChat = async (username = null) => {
    let roomList = [];
    await getAllRoomOfUser()
        .then(r => {
            if (r.success) {
                // récupère les conversations privées (room sans nom, avec 2 participants)
                const roomRaw = r.update;
                roomList = roomRaw.filter(room => {
                    return room.usersCount === 2 && room.name === undefined
                });
            }
        });
    let roomToLoad = null;
    if (username !== null) { // si une room est spécifiquement demandée, on la charge
        await getRoomWithUser(username)
            .then(r => {
                if (r.success) {
                    roomToLoad = r.room;
                }
            });
    }

    const wrapperRooms = f.query('#contacts');
    let oneRoomIsActivated = username !== null; // si on doit ouvrir une room en particulier on empêche l'activation d'une autre room
    let roomListHTML = '';
    roomList.forEach((room) => {
        if (roomToLoad !== null && room._id === roomToLoad._id) { // si on doit ouvrir une room en particulier
            roomListHTML += getRoomListHtml(room, 'active');
        } else if (room.name === undefined && !oneRoomIsActivated) { // sinon on ouvre la room ayant le message le plus récent
            oneRoomIsActivated = true;
            roomToLoad = room;
            roomListHTML += getRoomListHtml(room, 'active');
        } else if (room.name === undefined) {
            roomListHTML += getRoomListHtml(room, '');
        }
    });
    wrapperRooms.innerHTML = roomListHTML;

    await selectRoom(roomToLoad._id, '', userConnected);
}

const postMessageToRocket = async () => {
    const wrapperMessages = f.query('#messages-wrapper');
    const inputMessage = f.query('#message-input');
    const message = inputMessage.value;
    const roomId = f.query("input[name='roomId']").value;
    const messageToPost = {msg: message, id: 'newMessage'};

    inputMessage.value = '';
    wrapperMessages.innerHTML += getMessageHtml(messageToPost, 'sent', '');

    await sendMessage(message, roomId);

    // if(messageSent.success === true) {
    //     updateNewMessageWithStatus()
    // }
}

const getNewMessages = async () => {
    const wrapperMessages = f.query('#messages-wrapper');
    const roomId = f.query("input[name='roomId']").value;

    if(roomId) {
        await getRoomUnreadMessages(roomId)
            .then(r => {
                if (r.success) {
                    const messages = r.messages.reverse(); // récupère le tableau de message inversé (message le plus vieux en premier)

                    let messageList = '';
                    messages.forEach((message) => {
                        if (message.u._id === userConnected.me._id) {
                            messageList += getMessageHtml(message, 'sent');
                        } else {
                            messageList += getMessageHtml(message, 'replies');
                        }
                    });
                    wrapperMessages.innerHTML = messageList;
                } else {
                    return r.errorType;
                }
            })
            .catch(r => console.log(r))
    }

    console.log('fetching messages...')
}

const fetchMessages = setInterval(() => getNewMessages(), 30000);