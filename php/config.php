<?php
require 'vendor/autoload.php';

use \Illuminate\Database\Capsule\Manager as Capsule;
use \Illuminate\Events\Dispatcher;
use \Illuminate\Container\Container;



$container = new Container;
$capsule = new Capsule;

$capsule->addConnection([
'driver'    => 'mysql',
'host'      => 'localhost',
'database'  => 'icomments',
'username'  => 'root',
'password'  => '',
'charset'   => 'utf8',
'collation' => 'utf8_unicode_ci',
'prefix'    => '',
]);

$capsule->setEventDispatcher(new Dispatcher($container));
$capsule->setAsGlobal();
$capsule->bootEloquent();

/**
 *
 */
class Commentiki extends Illuminate\Database\Eloquent\Model
{

    protected $fillable = ['name', 'comment', 'parent_id'];

    public static $mediaTemplate;

    public static function boot(){
        parent::boot();
        self::$mediaTemplate = file_get_contents(__DIR__.'/template.php');
    }

    public function outputComment()
    {
        $media = self::$mediaTemplate;
        $media = str_replace("{{id}}", $this->id, $media);
        $media = str_replace("{{name}}", $this->name, $media);
        $media = str_replace("{{comment}}", $this->comment, $media);

        $nestedComments = $this->outputNestedComments();

        $media = str_replace("{{nested}}", $nestedComments, $media);

        return $media;
    }

    public function outputNestedComments()
    {
        $media = '';
        if($this->children()->count() > 0){
            foreach ($this->children as $comment) {
                $media = $media.$comment->outputComment();
            }
        }

        return $media;
    }

    public function children()
    {
        return $this->hasMany('Commentiki', 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo('Commentiki', 'parent_id', 'id');
    }
}
?>
