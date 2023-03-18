document.getElementById("registroBtn")?.addEventListener("click", function () {
    // ...
});

document.getElementById("registroForm")?.addEventListener("submit", function (event) {
    // ...
});

document.getElementById("logoutBtn")?.addEventListener("click", function () {
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            window.location.href = "index.php";
        }
    };
    xhr.open("GET", "logout.php", true);
    xhr.send();
});

