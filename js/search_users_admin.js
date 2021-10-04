document.addEventListener('mouseup', function (e) {
    var container = document.getElementById('search_results_admin');
    console.log(container)
    if (!container.contains(e.target)) {
        container.style.display = 'none';
        hide_results();
    }
});


// People prof. exp. use this approach
let search_timer // used to stop the search_timer

let clearInputButton = document.querySelector("button.clear-input")
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

            document.querySelector("#search_results_admin").innerHTML = ""

            let result_div = `
                    <div class="search-result-amount grid-2">
                  <h3> ${users.length} Results </h3>
                  </div>`
            document.querySelector("#search_results_admin").insertAdjacentHTML('beforeend', result_div)
            // populate the results
            users.forEach(user => {
                console.log()
                let user_div = `
                <div class="admin-user">
                <div class="admin-user-container">
      
      
      
                  <img src="/uploads/${user.user_image}" alt="Image uploaded by ${user.user_name}">
                  <p>
                    ID:
                    <span> ${user.user_uuid} </span>
                  </p>
                  <p>
                    Name: <span> ${user.user_name}</span>
                  </p>
                  <p>
                    Last name:
                    <span> ${user.user_last_name} </span>
                  </p>
                  <p>
                    Email:
                    <span> ${user.user_email} </span>
                  </p>
                  <p>
                    Phone nr:
                    <span> ${user.user_phone}</span>
                  </p>
      
                  <!--   <a href="/users/block/${user.user_email}" class="button alert">ahref block</a> -->
                  <button onclick="block_user('${user.user_email}')">
                    BLOCK THIS USER
                  </button>
                  <button class="alert" onclick="delete_user('${user.user_uuid}')">
                    DELETE USER COMPLETELY
                  </button>
                </div>
              </div>`
                document.querySelector("#search_results_admin").insertAdjacentHTML('beforeend', user_div)
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
    if (searchForm.value.length >= 2) {


        document.querySelector("#search_results_admin").style.display = "grid"
        document.querySelector("#admin-users").style.display = "none"
        // display search_results div
        // populate/render the individual results


    }
}

function hide_results() {
    // hide search_results div
    document.querySelector("#search_results_admin").style.display = "none"
    document.querySelector("#admin-users").style.display = "grid"
} function clear_input() {
    hide_results();
    document.querySelector("input.search-input").value = "";
    clearInputButton.style.display = "none"

}