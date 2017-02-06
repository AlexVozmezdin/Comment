<?php
require("php/config.php");

$comments = Commentiki::with('children')->where('parent_id', 0)->get();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Комментарии</title>
       
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link rel="stylesheet"  type="text/css" href="css/style.css">
    </head>
    <body>
        <div class="container">
            <div class="row comments well">
                <?php foreach($comments as $comment): ?>
                    <?php echo $comment->outputComment(); ?>
                <?php endforeach; ?>
              <form class="comment-form" action="php/main.php" method="post">
                  <div class="form-group">
                      <label for="comment_title">Введите имя:</label>
                      <input type="text" id="comment_title" name="comment_title" class="form-control" value="" required>
                  </div>
                  <div class="form-group">
                      <label for="comment_body">Введите комментарий:</label>
                      <textarea name="comment_body" id="comment_body" class="form-control" rows="8" cols="40" required></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary pull-right" >Отправить</button>
              </form>
            </div>
        </div>
        
  
    <script type="text/javascript" src="js/index.js" ></script>
    </body>
</html>