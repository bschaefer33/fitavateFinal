<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" type="text/css" href="comments.css">
</head>
<body>
    <div class="comments"></div>
    <script>
      const comments_page_id = 1;
      fetch("comments.php?page_id=" + comments_page_id).then(response => response.text()).then(data => {
        document.querySelector(".comments").innerHTML = data;
        document.querySelectorAll(".comments .write_comment_btn, .comments .reply_comment_btn").forEach(element =>{
          element.onclick = event => {
            event.preventDefault();
            document.querySelectorAll(" .comments .write_comment").forEach(element =>element.style.display = 'none');
            document.querySelector("div[data-comment-id='" + element.getAttribute("data-comment-id") +"']").style.display = 'block';
            document.querySelector(" div[data-comment-id='" + element.getAttribute("data-comment-id") + "'] input[name='name']").focus();
          };
        });
        document.querySelectorAll(".comments .write_comment form").forEach(element =>{
          element.onsubmit = event =>{
            event.preventDefault();
            fetch("comments.php?page_id=" + comments_page_id, {
              method: 'POST',
              body: new FormData(element)
            }).then(response => response.text()).then(data =>{
              element.parentElement.innerHTML = data;
            });
          };
        });
      });//End of fetch
    </script>
  </div><!--End of content home-->
</body>
</html>