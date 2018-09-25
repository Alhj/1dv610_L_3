<?php


class AddUserView {

    public function show () {
        echo '<!DOCTYPE html>
        <html>
          <head>
            <meta charset="utf-8">
            <title>Login Example</title>
          </head>
          <body>
            <h1>Assignment 2</h1>
            ' . $this->renderIsLoggedIn($isLoggedIn) . '
            <a href="index.php?get">test</a>
            <div class="container">
                ' . $v->response() . '
                
                ' . $dtv->show() . '
            </div>
           </body>
        </html>
      ';
    }
}