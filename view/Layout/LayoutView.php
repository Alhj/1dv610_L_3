<?php

namespace view;

class LayoutView
{

  private $isLoggedIn;

  public function __construct()
  {
   $this->isLoggedIn = new \model\loggin();
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
          ' . $this->WhatToDoWithSnipp($this->isLoggedIn->isUserLoggin()) . '
          <div class="container">
              ' . $v->response($this->isLoggedIn->isUserLoggin()) . '
              
              ' . $dtv->show() . '
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
       <a href="index.php?addCodeSnippet"> add codeSnippet </a>
       <br>
       <a href="index.php?removeCodeSnippet"> remove codesnippet</a>
       <br>  
       <a href="index.php?ShowCodeSnippets"> see code snippets</a>
      '
      ;
    } else {
      return '<a href="index.php?ShowCodeSnippets"> see code snippets</a>';
    }
  }
}
  