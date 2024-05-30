document.addEventListener("DOMContentLoaded", () => {
    const messageContainer = document.getElementById("message-container");

    if (messageContainer) {
        setTimeout(() => {
            messageContainer.style.display = "none";
        }, 5000); //50 sec
    }
});
