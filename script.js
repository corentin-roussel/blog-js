//*********************** FUNCTIONS ***********************//

const displayErrorsSignup = (dataJSON) => {

    const errorLoginDiv = document.getElementById('errorLogin');
    errorLoginDiv.innerHTML = "";

    const errorPassDiv = document.getElementById('errorPass');
    errorPassDiv.innerHTML = "";

    if(dataJSON['errorLogin']) {
        const paraErrorLogin = document.createElement("p");
        paraErrorLogin.textContent = dataJSON['errorLogin'];
        errorLoginDiv.appendChild(paraErrorLogin);
    }
    if(dataJSON['errorLoginExist']) {
        const paraErrorLoginExist = document.createElement("p");
        paraErrorLoginExist.textContent = dataJSON['errorLoginExist'];
        errorLoginDiv.appendChild(paraErrorLoginExist);
    }
    if(dataJSON['errorPassMatch']) {
        const paraErrorPassMatch = document.createElement("p");
        paraErrorPassMatch.textContent = dataJSON['errorPassMatch'];
        errorPassDiv.appendChild(paraErrorPassMatch);
    }
    if(dataJSON['errorPassLong']) {
        const paraErrorPassLong = document.createElement("p");
        paraErrorPassLong.textContent = dataJSON['errorPassLong'];
        errorPassDiv.appendChild(paraErrorPassLong);
    }
    if(dataJSON['okReg']) {
        alert(dataJSON['okReg']);
    }

}

const displayErrorsSignin = (dataJSON) => {
    const errorLoginDiv = document.getElementById('errorLogin');
    errorLoginDiv.innerHTML = "";

    const errorPassDiv = document.getElementById('errorPass');
    errorPassDiv.innerHTML = "";
    
    if(dataJSON['errorLogin']) {
        const paraErrorLogin = document.createElement("p");
        paraErrorLogin.textContent = dataJSON['errorLogin'];
        errorLoginDiv.appendChild(paraErrorLogin);
    }

    if(dataJSON['errorPass']) {
        const paraErrorPass = document.createElement("p");
        paraErrorPass.textContent = dataJSON['errorPass'];
        errorPassDiv.appendChild(paraErrorPass);
    }

    if(dataJSON['okConn']) {
        alert(dataJSON['okConn']);
    }
}

const fetchForm = async (lequel) => {

    const response = await fetch('back.php?' + lequel + '=1');
    const form = await response.text();

    console.log(form)

    return form;

}

const displayForm = (form) => {

    divForm.innerHTML = "";
    divForm.innerHTML = form;

}

const whenSubmit = async(form, lequel, e) => {

    e.preventDefault();
    const formData = new FormData(form);

    const response = await fetch('back.php?' + lequel + '=1', { method: "POST", body: formData });
    const dataJSON = await response.json();

    if(lequel === 'signup') {
        displayErrorsSignup(dataJSON);
    }

    if(lequel === 'signin') {
        displayErrorsSignin(dataJSON);
    }

}

//********************* END FUNCTIONS *********************//



const switchInscription = document.getElementById('switchInscription');
const switchConnexion = document.getElementById('switchConnexion');
const divForm = document.getElementById('divForm');
const divButtons = document.getElementById('buttons');
const main = document.getElementById('main');

switchInscription.addEventListener('click', async() => {

    form = await fetchForm('inscription');

    displayForm(form)

    //main.removeChild(divButtons);
    
    const signupForm = document.getElementById('signupForm');

    signupForm.addEventListener('submit', (e) => {

        whenSubmit(signupForm, 'signup', e);

    })
})

switchConnexion.addEventListener('click', async() => {

    form = await fetchForm('connexion');

    displayForm(form)

    //main.removeChild(divButtons);
        
    const signinForm = document.getElementById('signinForm');
    
    signinForm.addEventListener('submit', (e) => {

        whenSubmit(signinForm, 'signin', e);

    })
})