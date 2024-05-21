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

function showPopup(formId) {
    const sectionPopup = document.getElementById("modal-parent");
    const popUp = document.querySelector(formId);
    popUp.style.display = "flex";
    sectionPopup.style.display = "flex";
}

function closeForm(formId) {
    const sectionPopup = document.getElementById("modal-parent");
    const popUp = document.querySelector(formId);
    popUp.style.display = "none";
    sectionPopup.style.display = "none";
}

