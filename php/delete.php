<?php
require("config.php");


$deleted_id = $_POST['deleted_id'];
Commentiki::find($deleted_id)->delete();
$deleted_array = Commentiki::where('parent_id','=', $deleted_id)->get();
foreach ($deleted_array as $del) {
    Commentiki::find($del->id)->delete();
}

?>
