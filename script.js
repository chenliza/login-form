const loginForm = document.getElementById("loginForm");

const emailInput = document.getElementById("email");

const passwordInput =
    document.getElementById("password");

const togglePasswordBtn =
    document.getElementById("togglePassword");

const emailError =
    document.getElementById("emailError");

const passwordError =
    document.getElementById("passwordError");


// Show / Hide Password

if (togglePasswordBtn) {

    togglePasswordBtn.addEventListener(
        "click",
        function () {

            if (passwordInput.type === "password") {

                passwordInput.type = "text";

                togglePasswordBtn.textContent = "Hide";

            } else {

                passwordInput.type = "password";

                togglePasswordBtn.textContent = "Show";
            }
        }
    );
}


// Login Form Validation

if (loginForm) {

    loginForm.addEventListener(
        "submit",
        function (event) {

            event.preventDefault();

            emailError.textContent = "";
            passwordError.textContent = "";

            let isValid = true;


            // Email Validation

            const email =
                emailInput.value.trim();

            if (email === "") {

                emailError.textContent =
                    "Please enter your email.";

                isValid = false;

            } else if (
                !email.includes("@")
            ) {

                emailError.textContent =
                    "Please enter a valid email.";

                isValid = false;
            }


            // Password Validation

            const password =
                passwordInput.value;

            if (password === "") {

                passwordError.textContent =
                    "Please enter your password.";

                isValid = false;

            } else if (password.length < 6) {

                passwordError.textContent =
                    "Password must be at least 6 characters.";

                isValid = false;
            }


            // Send Form to PHP

            if (isValid) {

                loginForm.submit();

            }

        }
    );
}