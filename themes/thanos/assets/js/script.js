function addAnim(selector){
    let section = document.querySelectorAll(selector);
        section.forEach( item => {
            item.classList.add('anim');
    })
}
function showForm(selector1, selector2, array){
    let section = document.querySelector(selector1);
    let buttons = document.querySelectorAll(selector2);

    let register = document.querySelector(array[0]);
    let login = document.querySelector(array[1]);
    let forgot = document.querySelector(array[2]);

    buttons.forEach(button => {
        button.addEventListener('click', (e) => {
            if (button.classList.contains('btn-login')){
                section.classList.add('anim');
                addAnim('.line');
            } else if(button.classList.contains('close')){
                section.classList.remove('anim');
            }
            
            if (button.id === 'forgot'){
                login.style.transform = 'translateY(-100%)';
                forgot.style.transform = 'translateY(-100%)';
            } else if (button.id === 'register'){
                register.style.transform = 'translateY(100%)';
                login.style.transform = 'translateY(100%)';
            } else {
                login.style.transform = 'translateY(0%)';
                forgot.style.transform = 'translateY(100%)';
                register.style.transform = 'translateY(-100%)';
            }
            e.preventDefault();
        })
    })

}

window.addEventListener('load', function() {
    let buttons = '.btn-login, #forgot, #register, #back, .close';
    let array = ['.container-register', '.container-login', '.container-forgot'];
    showForm('.section-login', buttons, array);  
});

