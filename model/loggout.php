<?php

class LoggOutModel {

    public function loggOut() {
        return session_destroy();
    }
}