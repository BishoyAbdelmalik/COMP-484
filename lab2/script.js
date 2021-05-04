function sendJSON(data) {

    // let result = document.querySelector('.result');
    // let name = document.querySelector('#name');
    // let email = document.querySelector('#email');

    // Creating a XHR object
    let xhr = new XMLHttpRequest();
    let url = "login.php";

    // open a connection
    xhr.open("POST", url, true);

    // Set the request header i.e. which type of content you are sending
    xhr.setRequestHeader("Content-Type", "application/json");

    // Create a state change callback
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {

            // Print received data from server
            // result.innerHTML = this.responseText;
            console.log(this.responseText);

        }
    };

    // Sending data with the request
    xhr.send(data);
}

function change_choice(e) {
    let clicked = e.target
    let choices = Array.from(choice)
    if (!Array.from(clicked.classList).includes("current")) {
        for (let index = 0; index < choices.length; index++) {
            choices[index].classList.toggle("current")
        }
        document.getElementById("sign-in").classList.toggle("d-none")
        document.getElementById("sign-up").classList.toggle("d-none")
    }

}
let choice;
window.addEventListener("load", () => {
    choice = document.getElementsByClassName("choice")
    Array.from(choice).forEach(e => e.addEventListener("click", change_choice))
    let username = document.getElementById("username");
    let password = document.getElementById("password");
    document.getElementById("sign-in").addEventListener("click", () => {
        sendJSON(JSON.stringify({ "username": username.value, "password": password.value, "type": "sign-in" }));
    })
    document.getElementById("sign-up").addEventListener("click", () => {
        sendJSON(JSON.stringify({ "username": username.value, "password": password.value, "type": "sign-up" }));
    })
})