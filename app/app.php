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
    return $app['twig']->render('index.html.twig', array('restaurants' => $restaurants_found, 'not_found' => $temp_var));
    });

    $app->post("/cuisine_search", function() use ($app) {
    $all_cuisines = Cuisine::getAll();
    $restaurants_found = array();
    $cuisines_found = array();
    $cuisines_not_found = array();
    $not_found_message = array();
    $search_term_holder1 = $_POST['cuisine'];
    $search_term_holder2 = explode(",", $search_term_holder1);
    foreach ($search_term_holder2 as $term) {
      $search_term1 = strtolower($term);
      $search_term = str_replace(' ', '', $search_term1);
      $numberOfTerms = count($all_cuisines);
      for ($i=0; $i < $numberOfTerms ; $i++) {
        $cuisine_name = $all_cuisines[$i]->getName();
        if ($cuisine_name == $search_term) {
          array_push($cuisines_found, $all_cuisines[$i]);
          break;
        }elseif ($i == ($numberOfTerms-1)) {
          array_push($cuisines_not_found, $search_term);
        }
      }
    }
    foreach ($cuisines_found as $cuisine) {
      $restaurants_matching_search_term = $cuisine->getRestaurants();
      foreach ($restaurants_matching_search_term as $restaurant) {
        array_push($restaurants_found, $restaurant);
      }
    }
    $not_found_check = empty($cuisines_not_found);
    if ($not_found_check == false) {
        $not_found_message = "No results found for:";
        return $app['twig']->render('index.html.twig', array('restaurants' => $restaurants_found, 'not_found' => $not_found_message, 'not_found_terms' => $cuisines_not_found));
    }

    return $app['twig']->render('index.html.twig', array('restaurants' => $restaurants_found, 'not_found' => $not_found_message));
    });
    $app->get("/add_cuisine", function() use ($app) {

        return $app['twig']->render('new_cuisine.html.twig');
    });
    $app->post("/save_new_cuisine", function() use ($app) {
        $cuisine = $_POST['cuisine'];
        $id = null;
        $new_cuisine = new Cuisine($cuisine, $id);
        $new_cuisine->save();
        return $app->redirect('/');
    });
    return $app;
?>
