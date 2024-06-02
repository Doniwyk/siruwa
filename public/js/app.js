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

const previewBeforeUpload = (id) => {
    const input = document.querySelector('#' + id + ' input')
    input.addEventListener('change', ({
        target
    }) => {
        let file, url, imagePreview;
        const image = document.querySelector('#' + id + ' img')

        file = target.files[0];
        if (image) {
            url = URL.createObjectURL(file);
            image.src = url;
            return
        }

        if (!target.files.length) {
            return
        }

        url = URL.createObjectURL(file);

        imagePreview = document.createElement("img");
        imagePreview.src = url;
        imagePreview.classList.add('object-contain', 'h-full', 'w-full')

        document.querySelector('#' + id + ' div').innerHTML = '';
        document.querySelector('#' + id + '-preview').appendChild(imagePreview)
    })

}