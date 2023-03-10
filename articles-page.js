//***************************** FUNCTIONS ****************************//

const firstDoArticles = async() => {

    const response = await fetch('back.php?displayArt=1&numPage=1');
    const listeArt = await response.text();

    displayArticlesDiv.innerHTML = listeArt;

}

const firstDoPagination = async() => {

    const response = await fetch('back.php?displayPagination=1');
    const listePagination = await response.text();

    displayPaginationDiv.innerHTML = listePagination;

    prepClickPagination();

    
    console.log(numPage);

}

const whenFilterArticles = async(e, form, numPage) => {

    e.preventDefault();

    displayArticlesDiv.innerHTML = ""

    const formData = new FormData(form);

    const response = await fetch('back.php?displayArt=1&numPage=' + numPage, {method: "POST", body: formData});
    const listeArt = await response.text();

    displayArticlesDiv.innerHTML = listeArt;

}

const whenFilterPagination = async(e, form) => {

    e.preventDefault();

    displayPaginationDiv.innerHTML = ""

    const formData = new FormData(form);

    const response = await fetch('back.php?displayPagination=1', {method: "POST", body: formData});
    const listePagination = await response.text();

    displayPaginationDiv.innerHTML = listePagination;

    prepClickPagination();

}

const prepClickPagination = async() => {

    const paginationNum = document.getElementsByClassName('paginationNum');

    for (const num of paginationNum) {
        num.addEventListener('click', async(e) => {

            e.preventDefault();
            numPage = num.innerText;

            // displayArticlesDiv.innerHTML = "";
        
            // const response = await fetch('back.php?displayArt=1&numPage=' + numPage, {method: "POST", body: formData});
            // const listeArt = await response.text();
        
            // displayArticlesDiv.innerHTML = listeArt;

        })
    }

}


//*************************** END FUNCTIONS **************************//


const filterForm = document.getElementById('listeArticleForm');
const filterButton = document.getElementById('filter');

const displayArticlesDiv = document.getElementById('flex-article');
const displayPaginationDiv = document.getElementById('pagination');

let numPage = 1;

firstDoArticles();
firstDoPagination();

filterForm.addEventListener('submit', async(e) => {

    whenFilterArticles(e, filterForm, numPage);
    whenFilterPagination(e, filterForm);

})

