
<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Item.php";

    $app = new Silex\Application();
    $app['debug']=true;
    $server = 'mysql:host=localhost:8889;dbname=item';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server,$username,$password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('inventory.html.twig', array('tasks' => Item::getAll()));
    });

    $app->post("/display", function() use ($app) {
        $item_name = $_POST['item'];
        $category = $_POST['category'];
        $new_item = new Item ($item_name,$category);
        $new_item->save();
        return $app['twig']->render('display.html.twig', array('items' => Item::getAll()));
    });

    $app->post("/delete_tasks", function() use ($app) {

        return $app['twig']->render('delete_tasks.html.twig');
    });


    return $app;
?>
