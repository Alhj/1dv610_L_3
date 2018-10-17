<?php


class LayoutView
{


  public function render($isLoggedIn, $v, DateTimeView $dtv)
  {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $this->link($isLoggedIn) . '
          ' . $this->renderIsLoggedIn($isLoggedIn) . '
          <div class="container">
              ' . $v->response() . '
              
              ' . $dtv->show() . '
              <a href="index.php?ShowSnipps">see code snipps</a>
          </div>
         </body>
      </html>
    ';
  }

  public function RegisterViewOrNot()
  {
    return isset($_GET["register"]);
  }

  private function renderIsLoggedIn($isLoggedIn)
  {
    if ($isLoggedIn) {
      return '<h2>Logged in</h2>';
    } else {
      return '<h2>Not logged in</h2>';
    }
  }

  private function link($isLoggedIn)
  {
    if ($isLoggedIn) {
      return '';
    } else {
      if (isset($_GET["register"]) or isset($_GET["showSnipps"])) {
        return '<a href="index.php">Back to login</a>';
      } else {
        return '<a href="index.php?register">Register a new user</a>';
      }
    }
  }

  private function addOr()
  {
    if ($isloggid) {
      return '<a href="index.php?addsnipp"';
    } else {
      return '<a href="index?">';
    }
  }
}
  