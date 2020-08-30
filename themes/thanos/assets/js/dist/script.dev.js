"use strict";

function showLogin(selector1, selector2) {
  var section = document.querySelector(selector1);
  var button = document.querySelector(selector2);
  button.addEventListener('click', function () {
    section.classList.add('anim');
  });
}

window.addEventListener('load', function () {
  // Password validation
  showLogin('.section-login', '.btn-login');
});