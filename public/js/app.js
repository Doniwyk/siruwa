function activeButton(button) {
    const buttons = document.querySelectorAll(".button-option");
    buttons.forEach((button) => {
        button.classList.remove("button-option_active");
    });
    button.classList.add("button-option_active");
}

function togglePassword(idInputField) {
    const input = document.querySelector(idInputField);
    const typeInput = input.type;
    input.type = typeInput == "text" ? "password" : "text";
}

