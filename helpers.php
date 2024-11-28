<?php

/**
 * Get the base path
 *
 * @param string $path
 * @return string
 */
 function basePath($path = '') {
  return __DIR__ . '/' . $path;
 }

 /**
 * Load a view
 *
 * @param string $name
 * @return void
 */
function loadView($name, $data = []) {
  $viewPath = basePath("App/views/{$name}.view.php");

  if (file_exists($viewPath)) {
    extract($data);
    require $viewPath;
   } else {
    echo "View {$name} not found";
   }
}

/**
 * Load a partial
 *
 * @param string $name
 * @return void
 *
 */
function loadPartial($name, $data = []) {
  $partialPath = basePath("App/views/partials/{$name}.view.partial.php");

  if (file_exists($partialPath)) {
    extract($data);
    require $partialPath;
  } else {
    echo "Partial '{$partialPath} not found!";
  }
}

/**
 * Load a component
 *
 * @param string $name
 * @return void
 *
 */
function loadComponent($name, $data = []) {
  $componentPath = basePath("App/views/components/{$name}.php");

  if (file_exists($componentPath)) {
    extract($data);
    require $componentPath;
  } else {
    echo "Partial '{$componentPath} not found!";
  }
}

/**
 * Inspect a va;ie(s)
 *
 * @param mixed $value
 * @return void
 */
function inspect($value) {
  echo '<pre>';
  var_dump($value);
  echo '</pre>';
}

/**
 * Inspect a value(s) and die
 *
 * @param mixed $value
 * @return void
 */
function inspectAndDie($value) {
  echo '<pre>';
  var_dump($value);
  echo '</pre>';
  die();
}

/**
 * Formmat timestamp
 *
 * @param string $date
 * @return string
 */
function formatDate($date) {
  $date = new DateTime($date);
  $formattedDate = $date->format("d/m/Y");
  return $formattedDate;
}

/**
 * Redirect to a given url
 *
 * @param string $url
 * @return void
 */
function redirect($url) {
  header("Location: {$url}");
  exit;
}
