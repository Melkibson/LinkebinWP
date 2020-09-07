function addAnim(selector){
    let section = document.querySelectorAll(selector);
        section.forEach( item => {
            item.classList.add('anim');
    })
}
function showForm(selector1, selector2){
    let section = document.querySelector(selector1);
    let button = document.querySelectorAll(selector2);

    let register = document.querySelector('.container-register');
    let login = document.querySelector('.container-login');
    let forgot = document.querySelector('.container-forgot');

    button.forEach(item => {
        item.addEventListener('click', (e) => {
            if (item.classList.contains('btn-login')){
                section.classList.add('anim');
                addAnim('.line');
            } 
            
            if (item.id === 'forgot'){
                login.style.transform = 'translateY(-100%)';
                forgot.style.transform = 'translateY(-100%)';
            } else if (item.id === 'register'){
                register.style.transform = 'translateY(100%)';
                login.style.transform = 'translateY(100%)';
            } else {
                login.style.transform = 'translateY(0%)';
                forgot.style.transform = 'translateY(100%)';
                register.style.transform = 'translateY(-100%)';
            }
            e.preventDefault();
            console.log(item);
        })
    })

}

window.addEventListener('load', function() {
    showForm('.section-login', '.btn-login, #forgot, #register, #back');  
});

