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
function setActionAndSubmit(action) {
    let form = document.querySelector("form");
    let formAction = form.getAttribute("action");
    if (action === "tolak") {
        formAction += "?action=tolak&status=Ditolak";
    } else {
        formAction += "?action=terima&status=Proses";
    }
    form.setAttribute("action", formAction);
    form.submit();
}

function showPopup(formId, modalId) {
    const sectionPopup = document.querySelector(modalId);
    const popUp = document.querySelector(formId);

    sectionPopup.classList.remove("hidden");
    popUp.classList.remove("hidden");
}

function closeForm(formId, modalId) {
    const sectionPopup = document.querySelector(modalId);
    const popUp = document.querySelector(formId);

    popUp.classList.add("hidden");
    sectionPopup.classList.add("hidden");
}

