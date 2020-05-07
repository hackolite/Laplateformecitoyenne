<link rel="stylesheet" type="text/css" href="/style/chat.css" xmlns="http://www.w3.org/1999/html">

<div id="chat" class="">
    <div class="content">
        <div class="contact-profile">
            <p>Maker 2</p>
        </div>
        <ul id="messages-wrapper" class="messages">
            <li>Chargement...</li>
        </ul>
        <div class="message-input">
            <textarea rows="1" placeholder="Votre message"></textarea>
            <button class="submit" data-click="chat"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
        </div>
    </div>
    <div id="sidepanel">
        <div id="head" class="openContact" data-click="chat">
            Conversations
        </div>
        <div id="profile">
            <div id="spinnerOpenChat" class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
            <div class="close_btt" title="Fermer" data-click="chat">+</div>
        </div>
        <ul id="contacts">
        </ul>
    </div>
</div>
