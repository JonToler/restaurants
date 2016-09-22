<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Restaurant.php";
    require_once __DIR__."/../src/Cuisine.php";

    //Add symfony debug component and turn it on.
    use Symfony\Component\Debug\Debug;
    Debug::enable();

    // Initialize application
    $app = new Silex\Application();

    // Set Silex debug mode in $app object
    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=best_restaurant';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
    $restaurants_found = array();
    $temp_var = array();
    return $app['twig']->render('index.html.twig', array('restaurants' => $restaurants_found, 'temp' => $temp_var));
    });

    $app->post("/cuisine_search", function() use ($app) {
    $search_term = $_POST['cuisine'];
    // $cuisine_result = $GLOBALS['DB']->query("SELECT * FROM cuisine WHERE name = '{$search_term}'");

    $all_cuisines = Cuisine::getAll();
    $found_it = null;
    $temp_var = "found";
    $restaurants_found = array();
    foreach ($all_cuisines as $cuisine) {
        $cuisine_name = $cuisine->getName();
        if ($cuisine_name == $search_term) {
            $found_it = $cuisine;
        }
    }
    if ($found_it == null) {
        $temp_var = "not found";
    }
    // $new_name = $cuisine_result['name'];
    // $new_id = $cuisine_result['id'];
    // $returned_cuisine = new Cuisine($new_name, $new_id);
    // $returned_cuisine2 = Cuisine::find($returned_cuisine->getId());
    if ($found_it != null) {
        $restaurants_found = $found_it->getRestaurants();
    }



    return $app['twig']->render('index.html.twig', array('restaurants' => $restaurants_found, 'temp' => $temp_var));
    });
    return $app;
?>
