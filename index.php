<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <style>
        .hidden {
            display: none;
        }
    </style>

    <title>Inicio de sesión</title>
    <style>
        .hidden {
            display: none;
        }

        #status {
            position: fixed;
            top: 10px;
            right: 10px;
        }
    </style>
</head>

<body>
    <?php session_start(); ?>

    <?php if (isset($_SESSION['email'])): ?>
        <div id="status">
            <span id="emailDisplay"><?php echo $_SESSION['email']; ?></span>
            <div style="display: inline-block; width: 10px; height: 10px; background-color: green;"></div>
            <button id="logoutBtn">Cerrar sesión</button>
        </div>
    <?php endif; ?>

    <form id="loginForm" action="login.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" id="pass" name="pass" required>
        <br>
        <button type="submit" id="iniciarSesion">Iniciar sesión</button>
    </form>

    <div id="status" class="hidden">
        <span id="emailDisplay"></span>
        <div style="display: inline-block; width: 10px; height: 10px; background-color: green;"></div>
    </div>

    <script>
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);

        if (urlParams.has("email")) {
            document.getElementById("loginForm").style.display = "none";
            document.getElementById("status").classList.remove("hidden");
            document.getElementById("emailDisplay").textContent = urlParams.get("email");
        }
    </script>

    <button id="registroBtn">Registrarse</button>

    <form id="registroForm" class="hidden" action="registro.php" method="POST">
        <label for="registerEmail">Email:</label>
        <input type="email" id="registerEmail" name="email" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <label for="passwordConfirm">Verificar contraseña:</label>
        <input type="password" id="passwordConfirm" name="passwordConfirm" required>
        <br>
        <label for="mayorDeEdad">Soy mayor de 18 años:</label>
        <input type="checkbox" id="mayorDeEdad" name="mayorDeEdad">
        <br>
        <label for="aceptarCondiciones">Acepto las condiciones de la página:</label>
        <input type="checkbox" id="aceptarCondiciones" name="aceptarCondiciones">
        <br>
        <button type="submit" id="registrarseAhora">Registrarse ahora</button>
    </form>

    <script>
        document.getElementById("registroBtn").addEventListener("click", function () {
            this.style.display = this.style.display = "none";
            document.getElementById("registroForm").classList.remove("hidden");
        });

        document.getElementById("registroForm").addEventListener("submit", function (event) {
            const email = document.getElementById("registerEmail").value;
            const password = document.getElementById("password").value;
            const passwordConfirm = document.getElementById("passwordConfirm").value;
            const mayorDeEdad = document.getElementById("mayorDeEdad").checked;
            const aceptarCondiciones = document.getElementById("aceptarCondiciones").checked;

            if (password !== passwordConfirm) {
                event.preventDefault();
                alert("Las contraseñas no coinciden.");
            }

            if (!email.includes("@")) {
                event.preventDefault();
                alert("El email no es correcto.");
            }

            if (!mayorDeEdad && !aceptarCondiciones) {
                event.preventDefault();
                alert("Debes ser mayor de edad y aceptar las condiciones de la página.");
            } else if (!mayorDeEdad) {
                event.preventDefault();
                alert("Debes ser mayor de edad.");
            } else if (!aceptarCondiciones) {
                event.preventDefault();
                alert("Debes aceptar las condiciones de la página.");
            }
        });
    </script>

    <!-- Incluye el archivo main.js -->
    <script src="main.js"></script>
</body>
</html>

