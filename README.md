# pug-phalcon
Pug Template Engine for Phalcon

To use Pug with your Phalcon application, just add to composer.json, in the require section:

```json
"pug-php/pug-phalcon": "^1.0"
```

Or use the command line:
```sh
composer require pug-php/pug-phalcon
```

Then register the template:

```php
require '../vendor/autoload.php';

// ...
$di = new FactoryDefault();

// Setting up the view component
$di['view'] = function() {
    $view = new View();
    $view->setViewsDir('../app/views/');
    $view->registerEngines(array(
        ".pug" => function($view, $di) {
            return new \Phalcon\Mvc\View\Engine\Pug($view, $di, array(
                'cache' => '/tmp/myproject/pug',
                'prettyprint' => APP_ENV == 'development',
            ));
        }
    ));

    return $view;
};
```

Now you can add pug files in the views directory:

app/views/index.pug:

```jade
doctype html
html
  head
    title pug-phalcon
  body
    p Generetad with pug-phalcon
```
