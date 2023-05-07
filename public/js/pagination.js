let pagina = 2;
window.onscroll = () =>{
    console.log("estoy scrolleando");

    let bottomOfPage = document.body.offsetHeight - window.innerHeight <= window.scrollY+1;
    if(bottomOfPage){
        console.log("estoy paginando");
        fetch(`/games/pagination?page=${pagina}`,{
            method: 'get'
        })
            .then(response => response.text() )
            .then(html => {
                document.getElementById("row").innerHTML += html;
                pagina++;
            })
            .catch(error => console.log(error))
    }
}

