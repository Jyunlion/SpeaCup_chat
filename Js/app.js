const chatButton = document.querySelector( '.chatbox__button' );
const chatContent = document.querySelector( '.chat-area' );
const icons = {
    isClicked: '<img src="./images/icons/chatbox-icon.svg" />',
    isNotClicked: '<img src="./images/icons/chatbox-icon.svg" />'
}
// @ts-ignore
const chatbox = new InteractiveChatbox( chatButton, chatContent, icons );
chatbox.display();
chatbox.toggleIcon( false, chatButton );
