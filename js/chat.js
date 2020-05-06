const userToConnect = {user: "clement.b17@laposte.net", password: "4jd#3xh5XB%dUC8MU6J"};
const userToChatWith = {username: 'User2'};
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

const getRoomBetween = async (credential, userToChatWith) => {
    return await requestToRocket('im.create', 'POST', userToChatWith, credential);
}

const getMessagesFromRoom = async (credential, roomId) => {
    const url = 'im.history?roomId=' + roomId;
    return await requestToRocket(url, 'GET', {}, credential)
}

document.addEventListener('click', async (e) => {
    let elmt = e.target;
    let attr = elmt.getAttribute('id');

    if (attr.includes('startNewChat')) {
        const userConnected = await login(userToConnect);

        let room;
        if (userConnected.status === 'success') {
            credential = {token: userConnected.data.authToken, id: userConnected.data.me._id};
            console.log("-> credential", credential);
            room = await getRoomBetween(credential, userToChatWith);
        }

        let messages;
        if (room.success) {
            messages = await getMessagesFromRoom(credential, room.room._id);
            console.log("-> room.room._id", room.room._id);
            console.log("-> messages", messages);
        }
    }
});