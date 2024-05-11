import './bootstrap';

function activeButton(button) {
    const buttons = document.querySelectorAll('.button-option')
    buttons.forEach((button)=>{
        button.classList.remove('button-option_active')
    })
    button.classList.add('button-option_active');
}
