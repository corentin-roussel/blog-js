const displayUser = async() => {

    const response = await fetch('back.php?utilisateurs=1');
    const listeUser = await response.text();

    displayDiv.innerHTML = "";
    displayDiv.innerHTML = listeUser;

}

const displayCom = async() => {

    const response = await fetch('back.php?commentaires=1');
    const listeCom = await response.text();

    displayDiv.innerHTML = "";
    displayDiv.innerHTML = listeCom;

}

const displayArt = async() => {

    const response = await fetch('back.php?articles=1');
    const listeArt = await response.text();

    displayDiv.innerHTML = "";
    displayDiv.innerHTML = listeArt;

}

const displayCat = async() => {

    const response = await fetch('back.php?categories=1');
    const listeCat = await response.text();

    displayDiv.innerHTML = "";
    displayDiv.innerHTML = listeCat;

}




const displayChangeUser = document.getElementById('changeUser');
const displayChangeCom = document.getElementById('changeCom');
const displayChangeArt = document.getElementById('changeArt');
const displayChangeCat = document.getElementById('changeCat');

const displayDiv = document.getElementById('contenu');


displayChangeUser.addEventListener('click', async() => {

    await displayUser();

    const formChangeUser = document.getElementsByClassName('form');

    for(let form of formChangeUser) {

        form.addEventListener('submit', async(e) => {

            e.preventDefault();
            
            const formData = new FormData(form);

            const response = await fetch('back.php?changeRole=1&idUserChange=' + form.id, {method: "POST", body: formData});
            const data = await response.text();
        });
        
    };

    const supprUser = document.getElementsByClassName('suppr');

    for(let supprButton of supprUser) {

        supprButton.addEventListener('click', async() => {

            const response = await fetch('back.php?deleteUser=1&idUserDel=' + supprButton.name);
            const retour = await response.text();

            displayUser();

        })
    }
})

displayChangeCom.addEventListener('click', async() => {

    await displayCom();

    const modifComButtons = document.getElementsByClassName('modif');

    let temp = 1;
    
    for(let modif of modifComButtons) {
        
        const divFromModif = document.getElementById(temp);

        temp++;

        modif.addEventListener('click', async() => {
            const response = await fetch('back.php?modifCom=1&idCom=' + modif.name);
            const formModif = await response.text();

            console.log(formModif);

            divFromModif.innerHTML = formModif;
        
            const fromModif = document.getElementById(modif.name);

            fromModif.addEventListener('submit', async(e) => {

                e.preventDefault();

                const formModifData = new FormData(fromModif);

                const responseForm = await fetch('back.php?ifModif=1&idComm=' + modif.name , {method: "POST", body: formModifData});
                const message = await responseForm.text();

                displayCom();

            })

        })
    }

    const supprComButtons = document.getElementsByClassName('suppr');

    for(let supprCom of supprComButtons) {

        console.log(supprCom);

        supprCom.addEventListener('click', async() => {

            const response = await fetch('back.php?deleteCom=1&idCom=' + supprCom.name);
            const retour = await response.text();

            console.log(retour)

            displayCom();

        })
    }
})

displayChangeArt.addEventListener('click', async() => {

    await displayArt();
    
})







displayChangeCat.addEventListener('click', async() => {

    await displayCat();
    
})