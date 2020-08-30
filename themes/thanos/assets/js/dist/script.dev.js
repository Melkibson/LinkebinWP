"use strict";

// Password validation
function init() {
  function showLogin(selector1, selector2) {
    section = document.querySelector(selector1);
    button = document.querySelector(selector2);

    button.onclick = function () {
      section.classList.add('anim');
    };
  }

  var password = document.getElementById("password");
  var confirmedPassword = document.getElementById("password2");
  var letter = document.getElementById("letter");
  var capital = document.getElementById("capital");
  var number = document.getElementById("number");
  var length = document.getElementById("length");
  var match = document.getElementById("match"); // Functions for validation

  function validatePassword(password, id, variable) {
    if (password.value.match(variable)) {
      id.classList.remove("invalid");
      id.classList.add("valid");
    } else {
      id.classList.remove("valid");
      id.classList.add("invalid");
    }
  }

  function checkConfirmedPassword(confirmedPassword, password, id) {
    if (password.value.match(confirmedPassword.value)) {
      id.classList.remove("invalid");
      id.classList.add("valid");
      id.innerHTML = 'Les mots de passe correspondent';
    }

    if (confirmedPassword.value !== password.value) {
      id.classList.remove("valid");
      id.classList.add("invalid");
      id.innerHTML = 'Les mots de passe ne correspondent pas';
    }
  }

  function displayAndHide(childId, parentId) {
    childId.onfocus = function () {
      document.getElementById(parentId).style.display = "block";
    };

    childId.onblur = function () {
      document.getElementById(parentId).style.display = "none";
    };
  } // Show the message box when errors are found


  displayAndHide(password, 'message'); // Hide the message box when no errors are found

  displayAndHide(confirmedPassword, 'message-pwd'); // Check password required parameters

  password.onkeyup = function () {
    var lowerCaseLetters = /[a-z]/g;
    validatePassword(password, letter, lowerCaseLetters);
    var upperCaseLetters = /[A-Z]/g;
    validatePassword(password, capital, upperCaseLetters);
    var numbers = /[0-9]/g;
    validatePassword(password, number, numbers);

    if (password.value.length >= 8) {
      length.classList.remove("invalid");
      length.classList.add("valid");
    } else {
      length.classList.remove("valid");
      length.classList.add("invalid");
    }
  };

  confirmedPassword.onkeypress = function () {
    checkConfirmedPassword(confirmedPassword, password, match);
  };
} // Run script after the page is loaded


document.addEventListener('readystatechange', function () {
  if (document.readyState === "complete") {
    init();
  }
});