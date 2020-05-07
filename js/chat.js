const userToConnect = {user: "clement.b17@laposte.net", password: "4jd#3xh5XB%dUC8MU6J"};
const userToChatWith = {username: 'User2'};
let userConnected;
let credential;

const requestToRocket = (searchUrl, method, json = {}, credential = {}) => {
    const proxyurl = "https://cors-anywhere.herokuapp.com/"; //proxy pour dev
    let url = "https://plateformecitoyenne.rocket.chat/api/v1/" + searchUrl;

    let raw = '';
    if (method === 'POST') {
        raw = JSON.stringify(json);
    }

    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    if (credential.token && credential.id) { // si une authentification est nécessaire
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
}

const getAllRoomWithUserConnected = async (credential) => {
    return await requestToRocket('rooms.get', 'GET', {}, credential);
}

const getRoomWithUser = async (credential, userToChatWith) => {
    return await requestToRocket('im.create', 'POST', userToChatWith, credential);
}

const getRoomHtml = (roomObject, userConnected, classAttributes = '') => {
    console.log("-> roomObject", roomObject);
    const id = roomObject._id;
    let lastMessage = '';
    let name = '';

    if(roomObject.lastMessage) {
        lastMessage = roomObject.lastMessage.msg;
    }

    if(roomObject.name) {
        name = roomObject.name;
    } else {
        const usernames = roomObject.usernames;
        usernames.forEach((username) => {
           if(username !== userConnected.username) {
               name = username;
           }
        });
    }
    return "<li id='"+id+"' class=\"contact\"><div class=\"wrap\"><div class=\"meta\"><p class=\"name\">"+name+"</p><p class=\"preview\">"+lastMessage+"</p></div></div></li>";
}

const getMessagesFromRoom = async (credential, roomId) => {
    const url = 'im.history?roomId=' + roomId;
    return await requestToRocket(url, 'GET', {}, credential)
}

const getMessageHtml = (messageObject, type, classAttributes = '') => {
    if(type === 'sent') {
        return "<li id='"+messageObject._id+"' class='sent "+classAttributes+"'><p>"+ messageObject.msg +"</p></li>";
    } else if(type === 'replies') {
        return "<li id='"+messageObject._id+"' class='replies "+classAttributes+"'><p>"+ messageObject.msg +"</p></li>";
    }
}

const sendMessage = async (message, roomId, credential) => {
    return await requestToRocket('chat.postMessage', 'POST', {roomId: roomId, text: message}, credential);
}

const openChat = async (userToChat = {}) => {
    userConnected = await login(userToConnect);
    const wrapperMessages = f.query('#messages-wrapper');
    const wrapperRooms = f.query('#contacts');

    let room;
    if (userConnected.status === 'success') {
        credential = {token: userConnected.data.authToken, id: userConnected.data.me._id};
        room = await getRoomWithUser(credential, userToChatWith);
    }

    let requestRoomsUserSubscription;
    if (userConnected.status === 'success') {
        requestRoomsUserSubscription = await getAllRoomWithUserConnected(credential);
    }

    let roomList = '';
    if(requestRoomsUserSubscription.success === true) {
        const roomsUserSubscription = requestRoomsUserSubscription.update;
        roomsUserSubscription.forEach((room) => {
            roomList += getRoomHtml(room, userConnected, '');
        });
        wrapperRooms.innerHTML = roomList;
    }

    let requestMessages;
    if (room.success) {
        requestMessages = await getMessagesFromRoom(credential, room.room._id);
    }

    if(requestMessages.success) {
        const messages = requestMessages.messages.reverse(); // recupère le tableau de message inversé (message le plus vieux en premier)
        wrapperMessages.innerHTML= '';

        let messageList = '';
        messages.forEach((message) => {
            if(message.u._id === userConnected.data.me._id) {
                messageList += getMessageHtml(message, 'sent');
            } else {
                messageList += getMessageHtml(message, 'replies');
            }
        });
        wrapperMessages.innerHTML = messageList;
    }
}

const postMessageToRocket = async (userToChat, message) => {
    userConnected = await login(userToConnect);
    let wrapperMessages = f.query('#messages-wrapper');

    let room;
    if (userConnected.status === 'success') {
        credential = {token: userConnected.data.authToken, id: userConnected.data.me._id};
        room = await getRoomWithUser(credential, userToChatWith);
    }

    let postMessageRequest;
    if (room.success) {
        const messageToPost = {msg: message, id:'newMessage'};
        wrapperMessages.innerHTML += getMessageHtml(messageToPost, 'sent', '');
        postMessageRequest = await sendMessage(message, room.room._id, credential);
    }

    // if(messageSent.success === true) {
    //     updateNewMessageWithStatus()
    // }
}