function login($username) {
    let content = document.getElementById("content")
    let h1 = document.createElement("h1")
    h1.innerHTML = `Welcome ${username.value}!`
    content.appendChild(h1)

}

function logout() {
    console.log("logout")
    let content = document.getElementById("content")
    content.innerHTML = ""
    let loginDiv = document.getElementsByClassName("login")[0]
    loginDiv.classList.toggle("d-none")

}

function sendJSON(data) {

    // let result = document.querySelector('.result');
    // let name = document.querySelector('#name');
    // let email = document.querySelector('#email');

    // Creating a XHR object
    let xhr = new XMLHttpRequest()
    let url = "auth.php";

    // open a connection
    xhr.open("POST", url, true)

    // Set the request header i.e. which type of content you are sending
    xhr.setRequestHeader("Content-Type", "application/json")

    // Create a state change callback
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {

            // Print received data from server
            // result.innerHTML = this.responseText;
            let content = document.getElementById("content")
            let loginDiv = document.getElementsByClassName("login")[0]
            loginDiv.classList.toggle("d-none")
            let json = JSON.parse(this.responseText)
            console.log(json)
            if (json["status"] === "sign-in success") {
                console.log("login")
                if (json["isAdmin"]) {
                    adminLogin()
                } else {
                    $username = json["username"]
                    login($username)
                }
                let logout = document.createElement("button")
                logout.innerHTML = "sign out"
                logout.classList.add("btn")
                logout.classList.add("btn-link")
                logout.setAttribute("id", "logout");

                content.appendChild(logout)


            } else if (json["status"] === "user created") {
                console.log("User created")

            }

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
    document.addEventListener('click', function(e) {
        if (e.target && e.target.id == 'logout') {
            //do something
            logout()
        }
    });
})