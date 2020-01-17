// Password validation
function init() {
    var password = document.getElementById("password");
    var confirmedPassword = document.getElementById("password2");
    var letter = document.getElementById("letter");
    var capital = document.getElementById("capital");
    var number = document.getElementById("number");
    var length = document.getElementById("length");
    var match = document.getElementById("match");

    function validatePassword(password, id, variable) {
        if (password.value.match(variable)) {
            id.classList.remove("invalid");
            id.classList.add("valid");
        } else {
            id.classList.remove("valid");
            id.classList.add("invalid");
        }
    }

    function checkConfirmedPassword(confirmedPassword, password) {

        if ((password.value.match(confirmedPassword.value))) {
            match.classList.remove("invalid");
            match.classList.add("valid");
            match.innerHTML = 'Les mots de passe correspondent'

        }

        if (confirmedPassword.value !== password.value) {
            match.classList.remove("valid");
            match.classList.add("invalid");
            match.innerHTML = 'Les mots de passe ne correspondent pas'
        }
    }

// When the user clicks on the password field, show the message box
    password.onfocus = function () {
        document.getElementsByClassName("message").style.display = "block";
    };


// When the user clicks outside of the password field, hide the message box
    password.onblur = function () {
        document.getElementsByClassName("message").style.display = "none";
    };


// When the user starts to type something inside the password field
    password.onkeyup = function () {
        // Validate lowercase letters
        var lowerCaseLetters = /[a-z]/g;
        validatePassword(password, letter, lowerCaseLetters);

        // Validate capital letters
        var upperCaseLetters = /[A-Z]/g;
        validatePassword(password, capital, upperCaseLetters);

        // Validate numbers
        var numbers = /[0-9]/g;
        validatePassword(password, number, numbers);

        // Validate length

        if (password.value.length >= 8) {
            length.classList.remove("invalid");
            length.classList.add("valid");
        } else {
            length.classList.remove("valid");
            length.classList.add("invalid");
        }
    };

    confirmedPassword.onkeyup = function () {
        checkConfirmedPassword(confirmedPassword, password)
    };
}

document.addEventListener('readystatechange', function() {
    if (document.readyState === "complete") {

        init();
    }
});
