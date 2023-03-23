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
            await response.text();
        });
    };

    const supprUser = document.getElementsByClassName('suppr');

    for(let supprButton of supprUser) {

        supprButton.addEventListener('click', async() => {

            const response = await fetch('back.php?deleteUser=1&idUserDel=' + supprButton.name);
            await response.text();

            supprButton.parentNode.parentNode.removeChild(supprButton.parentNode);

        });
    };
})

displayChangeCom.addEventListener('click', async() => {

    await displayCom();

    const modifComButtons = document.getElementsByClassName('modif');

    let temp = 1;
    
    for(let modif of modifComButtons) {
        
        const divFromModif = document.getElementById('divCom' + temp);

        temp++;

        modif.addEventListener('click', async() => {
            const response = await fetch('back.php?modifCom=1&idCom=' + modif.name);
            const formModifText = await response.text();

            let formModif = document.createRange().createContextualFragment(formModifText);

            divFromModif.appendChild(formModif);
        
            const fromModif = document.getElementById(modif.name);

            fromModif.addEventListener('submit', async(e) => {

                e.preventDefault();

                const formModifData = new FormData(fromModif);

                const responseForm = await fetch('back.php?ifModifCom=1&idComm=' + modif.name , {method: "POST", body: formModifData});
                await responseForm.text();

                displayCom();

            })

        })
    }

    const supprComButtons = document.getElementsByClassName('suppr');

    for(let supprCom of supprComButtons) {

        supprCom.addEventListener('click', async() => {

            const response = await fetch('back.php?deleteCom=1&idCom=' + supprCom.name);
            await response.text();

            supprCom.parentNode.parentNode.removeChild(supprCom.parentNode);
        })
    }
})

displayChangeArt.addEventListener('click', async() => {

    await displayArt();

    const modifArtButtons = document.getElementsByClassName('modif');

    let temp = 1;
    
    for(let modif of modifArtButtons) {
        
        const divFromModif = document.getElementById('divArt' + temp);

        temp++;

        modif.addEventListener('click', async() => {
            const response = await fetch('back.php?modifArt=1&idArt=' + modif.name);
            const formModifText = await response.text();

            let formModif = document.createRange().createContextualFragment(formModifText);

            divFromModif.appendChild(formModif);
        
            const fromModif = document.getElementById(modif.name);

            fromModif.addEventListener('submit', async(e) => {

                e.preventDefault();

                const formModifData = new FormData(fromModif);

                const responseForm = await fetch('back.php?ifModifArt=1&idArt=' + modif.name , {method: "POST", body: formModifData});
                await responseForm.text();

                displayArt();

            })
        })
    }

    const supprArtButtons = document.getElementsByClassName('suppr');

    for(let supprArt of supprArtButtons) {

        supprArt.addEventListener('click', async() => {

            const response = await fetch('back.php?deleteArt=1&idArt=' + supprArt.name);
            await response.text();

            supprArt.parentNode.parentNode.removeChild(supprArt.parentNode);

        })
    }


})

displayChangeCat.addEventListener('click', async() => {

    await displayCat();

    const modifCatButtons = document.getElementsByClassName('modif-cat');

    let temp = 1;
    
    for(let modif of modifCatButtons) {
        
        const divLigne = document.getElementById('ligne' + temp);

        temp++;

        modif.addEventListener('click', async() => {

            const response = await fetch('back.php?modifCat=1&idCat=' + modif.name);
            const formModifText = await response.text();

            let formModif = document.createRange().createContextualFragment(formModifText);

            divLigne.appendChild(formModif);
        
            const fromMod = document.getElementById(modif.name);

            fromMod.addEventListener('submit', async(e) => {

                e.preventDefault();

                const formModifData = new FormData(fromMod);

                const responseForm = await fetch('back.php?ifModifCat=1&idCat=' + modif.name , {method: "POST", body: formModifData});
                await responseForm.text();

                displayCat();

            })
        })
    }

    const supprCatButtons = document.getElementsByClassName('suppr-cat');

    for(let supprCat of supprCatButtons) {

        supprCat.addEventListener('click', async() => {

            const response = await fetch('back.php?deleteCat=1&idCat=' + supprCat.name);
            await response.text();

            supprCat.parentNode.parentNode.removeChild(supprCat.parentNode);

        })
    }

    const addCatForm = document.getElementById('addCatForm');

    addCatForm.addEventListener('submit', async(e) => {

        e.preventDefault();

        const formAddCatData = new FormData(addCatForm);

        const responseAddCat = await fetch('back.php?createCat=1', {method: "POST", body: formAddCatData});
        await responseAddCat.text();

        displayCat();
    })
})