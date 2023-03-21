let comment_place = document.querySelector("#place");
let displayComment = document.querySelector("#displayComment");



const fetchFormComm = async () => {
    const response = await fetch("commentaire.php")
    const formComm = await response.text()

    return formComm;
}

const displayFormComm = (formComm) => {
    comment_place.innerHTML = ""
    comment_place.innerHTML = formComm
}

const insertComm = async (form, e) => {

    e.preventDefault();
    let formComment = new FormData(form)

    const response = await fetch("article-commentaire.php" + window.location.search + "&commentaires=ok" , {body: formComment ,method: "POST"})
    const dataJSON = await response.json()

    displayErrorComm(dataJSON);
}

const displayErrorComm = (dataJSON) => {

    let comm_error = document.querySelector("#errorComm");
    comm_error.innerHTML = "";

    const errorComments = document.createElement("small");
    comm_error.appendChild(errorComments);

    if(dataJSON['errorComment']) {
        const commentProblem = document.createElement("div");
        commentProblem.innerHTML = dataJSON['errorComment'];
        errorComments.appendChild(commentProblem);

    }
    if(dataJSON['success']) {
        alert(dataJSON['success']);
    }
}





const likesCountArticle = async() => {

    const articleId = window.location.search.split('=')[1];

    const response = await fetch('back.php?likeCount=1&idArticle=' + articleId);
    const numLike = await response.text();

    return numLike.trim();

}

const isLiked = async() => {

    const articleId = window.location.search.split('=')[1];

    const response = await fetch('back.php?isLiked=1&idArticle=' + articleId);
    const isLiked = await response.text();

    return isLiked.trim();

}

const displayLikes = async() => {

    const divNum = document.getElementById('displayNum');
    const likeNumString = await likesCountArticle();

    const likeNum = document.createRange().createContextualFragment(likeNumString);
    divNum.appendChild(likeNum);

}

const displayHeartIcon = async() => {
    
    const divLikes = document.getElementById('likesDisplay');
    const isLikedResult = await isLiked();

    if(isLikedResult == 1){

        const likeIcon = document.createRange().createContextualFragment('<i class="fa-solid fa-heart" id="heartIcon"></i>');
        divLikes.appendChild(likeIcon);

    }else if(isLikedResult == 0){

        const likeIcon = document.createRange().createContextualFragment('<i class="fa-regular fa-heart" id="heartIcon"></i>');
        divLikes.appendChild(likeIcon);
    }
}

const ifClickLike = async() => {
    
    const isLikedResult = await isLiked();
    const articleId = window.location.search.split('=')[1];
    

    if(isLikedResult == 1){

        await fetch('back.php?unlike=1&articleId=' + articleId);

    }else{

        await fetch('back.php?like=1&articleId=' + articleId);

    }
}






window.addEventListener("load", async () => {
    formComm = await fetchFormComm();
    displayFormComm(formComm);
    displayComm();
    const commentForm = document.querySelector("#formComm")
    let comment = document.querySelector("#comment");


    commentForm.addEventListener("submit", (e) => {
        insertComm(commentForm, e);
        displayComm();
        comment.value = ""
    })


    

    await displayLikes();
    await displayHeartIcon();
    const divLikes = document.getElementById('likesDisplay');
    const divNum = document.getElementById('displayNum');
    const heartIcon = document.getElementById('heartIcon');
    
    heartIcon.addEventListener('click', async() => {

        divNum.innerHTML = "";
        
        const isLikedResult = await isLiked();

        await ifClickLike();
        await displayLikes();

        if(isLikedResult == 1){

            heartIcon.className = "fa-regular fa-heart";

        }else{

            heartIcon.className = "fa-solid fa-heart";

        }

    })

})


const formatDate = (date) => {
    let mySQLDate = date
    let jsDate = new Date(date);
    let day = jsDate.getDate()
    let month = jsDate.getMonth()
    let year = jsDate.getFullYear()

    let hour = jsDate.getHours()
    let minutes = jsDate.getMinutes()
    let seconds = jsDate.getSeconds()

    return displayDate(day) + "-" + displayDate(month) + "-" + year + " a " + displayDate(hour) + ":" + displayDate(minutes) + ":" + displayDate(seconds)
}
const displayDate = (date) => {
    return (date < 10) ? '0' + date : date
}

const comment = (reponse) => {
    displayComment.innerHTML = "";

    for(let comm of reponse)
    {
        const dateFormat = formatDate(comm.date_creation)

        let title = document.createElement("h3")
        title.innerHTML = "Fait par " + comm.login + " le " + dateFormat ;
        title.setAttribute("class", "title-comment")
        displayComment.append(title)

        let contenu = document.createElement("p")
        contenu.innerHTML = comm.contenu;
        contenu.setAttribute("class", "para-comment")
        displayComment.append(contenu)

        let br = document.createElement("hr")
        br.setAttribute("class", "br-comment")
        displayComment.append(br)
    }
}


const displayComm = async() => {
    const response = await fetch("article-commentaire.php"+ window.location.search +"&commentaire=display")
    const json = await response.json()
    let display = comment(json)

}