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

async function getDataPembayaran(id_pembayaran) {
    const url = `/admin/data-pembayaran/${id_pembayaran}/show`;
    const response = await fetch(url);
    const data = await response.json();

    showPopupPembayaran(data, id_pembayaran);
}

function showPopupPembayaran(data, id_pembayaran) {
    const routeForm = `/admin/data-pembayaran/${id_pembayaran}/validate`;
    const modal = document.querySelector("#payment-modal_parent");
    const form = document.querySelector("#payment-modal_parent form");
    const img = document.querySelector("#payment-modal_parent form img");
    const inputMetode = document.querySelector("#metode");
    const inputMetodeDisplay = document.querySelector("#metode_display");
    const inputJumlah = document.querySelector("#jumlah");
    const inputJumlahDisplay = document.querySelector("#jumlah_display");

    form.action = routeForm;
    img.src = data.urlBuktiPembayaran;
    inputMetode.value = data.metode;
    inputMetodeDisplay.value = data.metode;
    inputJumlah.value = data.jumlah;
    inputJumlahDisplay.value = data.jumlah;

    modal.classList.toggle("hidden");
    modal.addEventListener("click", (event) => {
        if (event.target == modal) {
            closePopup("#payment-modal_parent");
        }
    });
}

function closePopup(id_modal) {
    const modal = document.querySelector(id_modal);
    modal.classList.add("hidden");
}
function closeForm(formId, modalId) {
    const sectionPopup = document.querySelector(modalId);
    const popUp = document.querySelector(formId);

    popUp.classList.add("hidden");
    sectionPopup.classList.add("hidden");
}

async function showPopupToContinueDocumentProccess(id_document, action) {
    const routeForm = `/admin/data-dokumen/${id_document}/status`;
    const modal = document.querySelector("#document-modal_parent");
    const form = modal.querySelector("form");
    const button = modal.querySelector("button");

    form.action = routeForm;
    button.value = action;

    if (action == "batalkan") {
        button.innerText = "Batalkan";
        button.classList.remove("bg-main");
        button.classList.add("bg-red-600");
    } else {
        button.classList.remove("bg-red-600");
        button.classList.add("bg-main");
        button.innerText = "Lanjutkan";
    }

    modal.classList.toggle("hidden");

    modal.addEventListener("click", (event) => {
        if (event.target == modal) {
            closePopup("#document-modal_parent");
            return;
        }
    });
}

const previewBeforeUpload = (id) => {
    const input = document.querySelector("#" + id + " input");
    input.addEventListener("change", ({ target }) => {
        let file, url, imagePreview;
        const image = document.querySelector("#" + id + " img");

        file = target.files[0];
        if (image) {
            url = URL.createObjectURL(file);
            image.src = url;
            return;
        }

        if (!target.files.length) {
            return;
        }

        url = URL.createObjectURL(file);

        imagePreview = document.createElement("img");
        imagePreview.src = url;
        imagePreview.classList.add("object-contain", "h-full", "w-full");

        console.log("#" + id + "-preview");

        document.querySelector("#" + id + " div").innerHTML = "";
        document.querySelector("#" + id + "-preview").appendChild(imagePreview);
    });
};

async function showRiwayatPembayaranModal(idRiwayat) {
    const modal_parent = document.querySelector(
        "#riwayat-payment-modal_parent"
    );
    const modal = modal_parent.querySelector("#riwayat-payment-modal");
    const status = modal.querySelector("#riwayat-status");
    const metodeInput = modal.querySelector("#riwayat-metode_pembayaran");
    const jumlahInput = modal.querySelector("#riwayat-jumlah_pembayaran");
    const buktiPembayaran = modal.querySelector("img");
    const animatePulseDiv = modal.querySelector(".animate-pulse");

    metodeInput.innerText = "";
    jumlahInput.innerText = "";
    buktiPembayaran.src = "";

    buktiPembayaran.classList.add("hidden");
    animatePulseDiv.classList.remove("hidden");

    modal_parent.classList.remove("hidden");

    const data = await getDataRiwayatPembayaran(idRiwayat);

    if (data.status == "Ditolak") {
        status.classList.add("text-red-600");
    } else {
        status.classList.add("text-main");
    }
    status.innerText = data.status;
    metodeInput.value = data.metode;
    jumlahInput.value = data.jumlah;
    buktiPembayaran.src = data.urlBuktiPembayaran;

    buktiPembayaran.addEventListener("load", () => {
        buktiPembayaran.classList.remove("hidden");
        animatePulseDiv.classList.add("hidden");
    });

    modal_parent.addEventListener("click", ({ target }) => {
        if (target == modal_parent) {
            modal_parent.classList.add("hidden");
        }
    });
}
async function getDataRiwayatPembayaran(idRiwayat) {
    const url = `/admin/data-pembayaran/${idRiwayat}/history`;
    const response = await fetch(url);
    const data = await response.json();

    return data;
}

function showModal(id_modal_parent, id_modal) {
    const modalParent = document.querySelector(id_modal_parent);
    const modal = modalParent.querySelector(id_modal);

    modalParent.classList.remove("hidden");
    modalParent.addEventListener("click", ({ target }) => {
        if (target == modalParent) {
            modalParent.classList.add("hidden");
        }
    });
}