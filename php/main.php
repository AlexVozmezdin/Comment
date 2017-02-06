<?php
require("config.php");

$parentId = $_POST['parentId'];
$name = $_POST['name'];
$comment_text = $_POST['comment'];

$comment = Commentiki::create([
    'name' => $name,
    'comment' => $comment_text,
    'parent_id' => $parentId
]);


if($comment){
    echo json_encode([
        'created' => true,
        'id' => $comment->id
    ]);
}
else{
    echo json_encode([
        'created' => false
    ]);
}

?>
