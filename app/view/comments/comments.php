<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'mysql';
$DATABASE_NAME = 'fitavate';

// Connect to MySQL database
$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Function to show elapsed time
function time_elapsed_string($datetime, $full = false){
  $now = new DateTime;
  $ago = new DateTime($datetime);
  $diff = $now->diff($ago);
  $diff->w = floor($diff->d /7);
  $diff->d -= $diff->w *7;
  $string = array('y' => 'year', 'm' => 'month', 'w' => 'week', 'd' => 'day', 'h' => 'hour', 'i' => 'minute', 's' => 'second');
  foreach ($string as $k => &$v) {
    if ($diff->$k) {
      $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
    } else {
      unset($string[$k]);
    }
  }
  if (!$full) {
    $string = array_slice($string, 0, 1);
  }
  return $string ? implode(', ', $string) . ' ago' : 'just now';
}

// Function to show comments
function show_comments($conn, $comments, $parent_id = -1) {
  $html = '';
  if ($parent_id != -1) {
    usort($comments, function($a, $b) {
      return strtotime($a['submit_date']) - strtotime($b['submit_date']);
    });
  }
  foreach ($comments as $comment) {
    if ($comment['parent_id'] == $parent_id) {
      $html .= '
      <div class="comment">
        <div>
          <h3 class="name">' . htmlspecialchars($comment['name'], ENT_QUOTES) . '</h3>
          <span class="date">' . time_elapsed_string($comment['submit_date']) . '</span>
        </div>
        <p class="content">' . nl2br(htmlspecialchars($comment['content'], ENT_QUOTES)) . '</p>
        <a class="reply_comment_btn" href="#" data-comment-id="' . $comment['id'] . '">Reply</a>
        ' . show_write_comment_form($comment['id']) . '
        <div class="replies">
          ' . show_comments($conn, $comments, $comment['id']) . '
        </div>
      </div>
      ';
    }
  }
  return $html;
}

// Function to show comment form
function show_write_comment_form($parent_id = -1) {
  $html = '
    <div class="write_comment" data-comment-id="' . $parent_id . '">
      <form method="POST" action="">
        <input name="parent_id" type="hidden" value="' . $parent_id . '">
        <input name="name" type="text" placeholder="Your Name" required><br><br>
        <textarea name="content" placeholder="Write your comment here..." required></textarea><br><br>
        <button type="submit">Submit comment</button>
      </form>
    </div>
  ';
  return $html;
}

// Check if page ID is set
if (isset($_GET['page_id'])) {
  // Check if comment form
  if (isset($_POST['name']) && isset($_POST['content'])) {
    $name = $_POST['name'];
    $content = $_POST['content'];
    $parent_id = $_POST['parent_id'];
    $sql = "INSERT INTO comments (name, content, parent_id) VALUES ('$name', '$content', '$parent_id')";
    if (mysqli_query($conn, $sql)) {
    header("Location: index.php?page_id=" . $_GET['page_id']);
    } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    }
    
    // Get comments from database
    $sql = "SELECT * FROM comments WHERE page_id = " . $_GET['page_id'] . " ORDER BY submit_date DESC";
    $result = mysqli_query($conn, $sql);
    $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    // Show comments
    echo show_comments($conn, $comments);
    //} else {
    //echo "Page ID not set.";
    }
// Display the comments and the comment form
?>
<?= show_write_comment_form() ?>
<?= show_comments($comments->fetch_all(MYSQLI_ASSOC)) ?>