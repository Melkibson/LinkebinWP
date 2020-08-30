
   function showLogin(selector1, selector2){
    let section = document.querySelector(selector1);
    let button = document.querySelector(selector2);

    button.addEventListener('click', () => {
        section.classList.add('anim');
    })

}



window.addEventListener('load', function() {
    // Password validation
    showLogin('.section-login', '.btn-login');
});

