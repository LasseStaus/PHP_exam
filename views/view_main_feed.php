<?php
// Top
require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_user_top.php');

if (!isset($_SESSION['user_uuid'])) {
    header('Location: /login');
    exit();
}
// Main part of the page
try {

    $db_path = $_SERVER['DOCUMENT_ROOT'] . '/db/posts.db';
    $db = new PDO("sqlite:$db_path");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $q = $db->prepare('SELECT * FROM posts ORDER BY post_timestamp DESC');
    $q->execute();
    $posts = $q->fetchAll();

?>


    <div class="button-create-post-container">
        <button class="create-post">
            <i class="fas fa-plus"></i> Create Post
        </button>
    </div>

    <div class="content-container feed-grid">

        <div class="post-container">
            <div id="posts">
                <?php
                foreach ($posts as $post) {

                ?>
                    <div class="single-post" id="<?= $post['post_uuid'] ?>">
                        <div class="single-post-container">

                            <div class="post-header">
                                <img src="/uploads/<?= $post['post_user_profile_image'] ?>" class="profile-picture" alt="">
                                <div>
                                    <h4 class="post-creator"><?= $post['post_creator_name'] ?> <?= $post['post_creator_last_name'] ?></h4>
                                    <p class="timestamp"><?= $post['post_timestamp'] ?> </p>
                                </div>
                            </div>

                            <h3><?= $post['post_title'] ?></h3>
                            <p><?= $post['post_text'] ?></p>

                            <?php
                            if ($post['post_image'] != 'no-image') {

                            ?>
                                <div class="img-container">
                                    <img src="post-uploads/<?= $post['post_image'] ?>" alt="Picture from  <?= $post['post_creator_name'] ?>">

                                </div>
                            <?php
                            }
                            ?>
                            <P class="like-counter"><?= $post['post_likes'] ?> likes</P>
                            <div class="option-container" data-post-id="<?= $post['post_uuid'] ?>">


                                <button onclick="like()" class="button post like ">Like</button>
                                <button onclick="dislike()" class="button post hide dislike ">dislike</button>
                                <button class="button post">Comment</button><button class="button post">Share</button>
                                <!--       <form action="/posts//1" method="POST">
                                    <input type="submit" value="like">
                                </form> -->



                                <!--     <button onclick="dislike()" class="button post">dislike</button> -->
                                <!--                                 <button onclick="like()" class="button post">Like</button><button class="button post">Comment</button><button class="button post">Share</button>
 -->
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>

    </div>

    <div id="create-post-wrapper">

        <div class="create-post-container">

            <div class="form-container">
                <i class="fas fa-times cancel"></i>

                <h2>What do you wish to share today?</h2>
                <div class="post-header">
                    <img src="/uploads/<?= $_SESSION['user_image'] ?>" class="profile-picture" alt="">
                    <div>
                        <h4 class="post-creator"><?= $_SESSION['user_name'] ?> <?= $_SESSION['user_last_name'] ?></h4>

                    </div>
                </div>

                <form style="color:black" method="POST" action="/check-post/<?= $_SESSION['user_uuid'] ?>" enctype="multipart/form-data">


                    <input type="text" name="post_title" placeholder="Title of post ">
                    <textarea name="post_text" id="" cols="30" rows="4" placeholder="Type your message here!"></textarea>
                    <img class="img-show-input" src="post-uploads/no-post-image.png" alt="your image" />
                    <input class="file-to-upload file" type="file" name="file-to-upload" class="img-input" onchange="loadFile(event)">
                    <button type="submit">Create Post<div>
                </form>

            </div>

        </div>
    </div>


    <script>
        async function handle_like_or_dislike(post_id) {



            let conn = await fetch(`/find-liked-post/${post_id}`, {
                method: "POST",

            })
            console.log("Lol", conn)
            if (!conn.ok) {
                alert('uppps....')
            }
            let users = await conn.json();
            console.log(users)
        }
        async function like() {
            /* console.log(id, "tis"); */

            let button = event.target
            let button_parent = button.parentNode.parentNode.parentNode;

            let post_id = button_parent.id;
            console.log("liking post.. id: ", post_id)
            /*   post_id = parseInt(post_id) */
            console.log(post_id, button_parent);
            /*        let post_id_from_data_attr = button_parent.getAttribute("data-post-id") */
            /*          console.log(post_id_from_data_attr); */
            let conn = await fetch(`/posts/${post_id}/1`, {
                method: "POST"
            })

            if (!conn.ok) {
                alert("sorry, we are updating our servers")
                return
            }

            updateLikes(button, 1);

            button_parent.querySelector(".like").classList.add('hide')
            button_parent.querySelector(".dislike").classList.remove('hide')
        }


        function updateLikes(button, like) {
            let button_parent2 = button.parentNode.parentNode;
            let p = button_parent2.querySelector("p.like-counter");
            console.log(p)
            let number = parseInt(p.textContent);
            console.log(number)
            let newNumber = number + like;
            console.log(newNumber)
            p.textContent = newNumber + " likes";
            console.log(p)

            /*          button.textContent = "Liked"; */

        }
        async function dislike() {
            console.log("hallo")

            let button = event.target
            let button_parent = button.parentNode.parentNode.parentNode;

            let post_id = button_parent.id;
            console.log("disliking post.. id: ", post_id)


            let conn = await fetch(`/posts/${post_id}/0`, {
                method: "POST"
            })
            // if( conn.status != 200 ){ alert("something went wrong") }
            if (!conn.ok) {
                alert("sorry, we are updating our servers")
                return
            }
            updateLikes(button, -1);
            button_parent.querySelector(".like").classList.remove('hide')
            button_parent.querySelector(".dislike").classList.add('hide')
        }
    </script>

    <script src="/js/toggers_feed.js"></script>
<?php

} catch (PDOException $ex) {
    echo $ex;
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_bottom.php');
