let form_profile = document.querySelector("#formProfile")
let button_profile = document.querySelector("#submitProfile")
const submitProfile = async (form) => {

    const formProfile = new FormData(form);

    const response = await fetch('profil.php?profile=ok', { method: "POST", body: formProfile});
    const dataJSON = await response.json();

    displayErrorProfile(dataJSON);

}

const displayErrorProfile = (dataJSON) => {
    const errorLogin = document.querySelector("#errorLoginProfile");

    const errorPassword = document.querySelector("#errorPassProfile");

    if(dataJSON["errorLoginExist"]) {
        const errorLoginExist = document.createElement("p");
        errorLoginExist.innerHTML = dataJSON["errorLoginExist"];
        errorLogin.appendChild(errorLoginExist);
    }
    if(dataJSON["errorLogin"]) {
        const  errorLoginUpdate = document.createElement("p");
        errorLoginUpdate.innerHTML = dataJSON["errorLogin"];
        errorLogin.append(errorLoginUpdate);
    }
    if(dataJSON["okLoginEdit"]) {
        alert(dataJSON["okLoginEdit"]);
    }

    if(dataJSON["errorPassLong"]) {
        const errorPassLong = document.createElement("p");
        errorPassLong.innerHTML = dataJSON["errorPassLong"];
        errorPassword.appendChild(errorPassLong);
    }
    if(dataJSON["errorPassConfirm"]) {
        const errorPassConfirm = document.createElement("p");
        errorPassConfirm.innerHTML = dataJSON["errorPassConfirm"];
        errorPassword.appendChild(errorPassConfirm);
    }
    if(dataJSON["errorPassDiff"]) {
        const errorPassDiff = document.createElement("p");
        errorPassDiff.innerHTML = dataJSON["errorPassDiff"];
        errorPassword.appendChild(errorPassDiff);
    }
    if(dataJSON["errorPassWrong"]) {
        const errorPassWrong = document.createElement("p");
        errorPassWrong.innerHTML = dataJSON["errorPassWrong"];
        errorPassword.appendChild(errorPassWrong);
    }
    if(dataJSON["okPassEdit"]) {
        alert(dataJSON['okPassEdit']);
    }
}

form_profile.addEventListener("submit", (e) => {
    e.preventDefault();
    submitProfile(form_profile);

})