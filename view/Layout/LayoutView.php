<?php

namespace view;

class LayoutView
{

  private $isLoggedIn;

  public function __construct()
  {
   $this->isLoggedIn = new \model\logginModel();
  }

  public function render($v, \view\DateTimeView $dtv)
  {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>L3</title>
        </head>
        <body>
          <h1>Assignment 3</h1>
          ' . $this->link($this->isLoggedIn->isUserLoggin()) . '
          ' . $this->renderIsLoggedIn($this->isLoggedIn->isUserLoggin()) . '
          <div class="container">
              ' . $v->response($this->isLoggedIn->isUserLoggin()) . '
              
              ' . $dtv->show() . '
              ' . $this->WhatToDoWithSnipp($this->isLoggedIn->isUserLoggin()) . '
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

  private function WhatToDoWithSnipp($isLoggedIn)
  {
    if ($isLoggedIn) {
      return '
       <a href="index.php?addsnipp"> addSnipp </a>
       <a href="index.php?removeSnipp"> removesnipp</a>  
       <a href="index.php?ShowSnipps"> see snipps</a>
      '
      ;
    } else {
      return '<a href="index.php?ShowSnipps"> see snipps</a>';
    }
  }
}
  