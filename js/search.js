document.addEventListener('mouseup', function (e) {
    let container = document.getElementById('search_results');

    console.log(container)

    if (!container.contains(e.target)) {
        container.style.display = 'none';
        hide_results();
        /*   document.querySelector("input.search-input").value = ""; */

    }
});

let clearInputButton = document.querySelector("button.clear-input")
// People prof. exp. use this approach
let search_timer // used to stop the search_timer
function search() {


    if (search_timer) {
        clearTimeout(search_timer)
    }
    if (event.target.value.length >= 2) {

        search_timer = setTimeout(async function () {

            let conn = await fetch('/search', {
                method: "POST",
                body: new FormData(document.querySelector("#search-form"))
            })
            if (!conn.ok) {
                alert('uppps....')
            }
            let users = await conn.json()
            console.log(users)
            console.log("tisser")



            // populate the results
            document.querySelector("#search_results").innerHTML = ""

            let result_div = `
                    <div class="search-result-amount">
                  <h3> ${users.length} Results </h3>
                  </div>`
            document.querySelector("#search_results").insertAdjacentHTML('beforeend', result_div)


            users.forEach(user => {
                console.log()
                let user_div = `
                <div class="user">
                <div class="container">
                  <img src="/uploads/${user.user_image}" alt="Image uploaded by ${user.user_name}">
                  <div class="user-name"> ${user.user_name} ${user.user_last_name}</div>

                  <a class="button user" href="/view-user-profile/${user.user_uuid}">
                    Go to Profile <i class="fas fa-long-arrow-alt-right"></i>
                  </a>
      
      
                </div>
              </div>`
                document.querySelector("#search_results").insertAdjacentHTML('beforeend', user_div)
            })

            clearInputButton.style.display = "block"
            show_results()
        }, 200)
    } else {
        hide_results()
    }
}

function show_results() {
    let searchForm = document.querySelector('.search-input')
    /*    console.log(event.target.value, "lol") */
    if (searchForm.value.length >= 2) {
        document.querySelector("#search_results").style.display = "grid"
        document.querySelector("#users").style.display = "none"
        // display search_results div
        // populate/render the individual results
    }
}

function hide_results() {
    // hide search_results div
    document.querySelector("#search_results").style.display = "none"
    document.querySelector("#users").style.display = "grid"
}

function clear_input() {
    hide_results();
    document.querySelector("input.search-input").value = "";
    clearInputButton.style.display = "none"

}