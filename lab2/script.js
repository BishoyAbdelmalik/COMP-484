function login($username) {
    let content = document.getElementById("content")
    let h1 = document.createElement("h1")
    h1.innerHTML = `Welcome ${username.value}!`
    content.appendChild(h1)

    for (let i = 0; i < 2; i++) {
        let br = document.createElement("br")
        content.appendChild(br)
    }

    let button = document.createElement("button")
    button.innerHTML = "Change background"
    button.classList.add("btn")
    button.classList.add("btn-primary")
    button.setAttribute("id", "change_background");
    content.appendChild(button)
    for (let i = 0; i < 3; i++) {
        let br = document.createElement("br")
        content.appendChild(br)
    }



}

function adminLogin($username) {
    let content = document.getElementById("content")
    let h1 = document.createElement("h1")
    h1.innerHTML = `Welcome ${username.value}!`
    content.appendChild(h1)
    let br = document.createElement("br")
    content.appendChild(br)


    let table = document.createElement("div")

    table.setAttribute("id", "table");

    content.appendChild(table)
    let request = new XMLHttpRequest()
    request.open('GET', "users.php")
    request.onload = function() {
        console.log(request.response)
        table.innerHTML = request.response
    };
    request.send()
    br = document.createElement("br")
    content.appendChild(br)

}

function logout() {
    console.log("logout")
    let content = document.getElementById("content")
    content.innerHTML = ""
    let loginDiv = document.getElementsByClassName("login")[0]
    loginDiv.classList.toggle("d-none")
    document.body.style.backgroundColor = "";
    sendJSON(JSON.stringify({ "username": " ", "password": " ", "type": "sign-out" }))

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
            if (this.responseText.length == 0) {
                return;
            }
            let json = JSON.parse(this.responseText)
            console.log(json)
            if (json["status"] === "sign-in success") {
                let content = document.getElementById("content")
                let loginDiv = document.getElementsByClassName("login")[0]
                loginDiv.classList.toggle("d-none")
                console.log("login")
                $username = json["username"]

                if (json["isAdmin"]) {
                    adminLogin($username)
                } else {
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
                document.getElementsByClassName("choice")[0].click()
                error.innerHTML = '<span class="text-success">User created you can sign in now</span>'

            } else {
                let error = document.getElementById("error")
                error.innerHTML = json["status"]
            }

        }
    };

    // Sending data with the request
    xhr.send(data);
}

function change_choice(e) {
    let error = document.getElementById("error")
    error.innerHTML = ""

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
let choice
let red = 100
let green = 100
let blue = 100
window.addEventListener("load", () => {
    choice = document.getElementsByClassName("choice")
    Array.from(choice).forEach(e => e.addEventListener("click", change_choice))
    let username = document.getElementById("username")
    let password = document.getElementById("password")
    let error = document.getElementById("error")
    document.getElementById("sign-in").addEventListener("click", () => {
        error.innerHTML = ""
        sendJSON(JSON.stringify({ "username": username.value, "password": password.value, "type": "sign-in" }))
    })
    document.getElementById("sign-up").addEventListener("click", () => {
        error.innerHTML = ""
        sendJSON(JSON.stringify({ "username": username.value, "password": password.value, "type": "sign-up" }))
    })
    document.addEventListener('click', function(e) {
        if (e.target && e.target.id == 'logout') {
            //do something
            logout()
        }
        if (e.target && e.target.id == 'change_background') {
            //do something
            red = red + Math.floor(Math.random() * 50)
            red = (red > 255) ? 100 : red
            green = green + Math.floor(Math.random() * 50)
            green = (green > 255) ? 100 : green
            blue = blue + Math.floor(Math.random() * 50)
            blue = (blue > 255) ? 100 : blue
            document.body.style.backgroundColor = `rgb(${red},${green},${blue})`;

            console.log("change background")
        }
    });
})