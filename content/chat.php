<link rel="stylesheet" type="text/css" href="/style/chat.css" xmlns="http://www.w3.org/1999/html">

<div id="chat" class="">
    <div class="content">
        <div id="room-name" class="contact-profile">
        </div>
        <div id="spinnerConversation" class="spinner loading">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
        <ul id="messages-wrapper" class="messages">
            <li>Chargement...</li>
        </ul>
        <div class="message-input">
            <label for="message-input" aria-hidden="true" hidden>Taper votre message</label>
            <input id="message-input" name="message" placeholder="Message"/>
            <input type="hidden" name="roomId"/>
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
            <li class="spinner loading">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </li>
        </ul>
    </div>
</div>