<?php

namespace view;

class ShowAllCodeSnippets
{
    private $jsonInfo;

    public function render()
    {
        return $this->genereteShowAllCodeSnipsHTML();
    }

    private function genereteShowAllCodeSnipsHTML()
    {
        $string = '
        <a href="index.php">go back</a>
        <h2>View all Snips</h2>
        <br>
        ';
        if (!empty($this->jsonInfo)) {
            foreach ($this->jsonInfo as $user) {
                foreach($user->CodeSnipps as $codeSnippet)
                $string .= '
                <fieldset>
                    <h2> title: ' . $codeSnippet->title . '</h2>
                    <h4> author: ' . $user->User . '</h4>
                    <p>
                    ' . 'snipp: ' . $codeSnippet->CodeSnippet . '
                    </p>
                    <h4> codeType: ' . $codeSnippet->codeType . '</h4>
                </fieldset>
                <br>
                ';
            }
        } else {
            $string .= '<p>no code snipps has been add yet</p>';
        }
        return $string;
    }

    public function setJsonInfo($jsonInfoFromation)
    {
        $this->jsonInfo = $jsonInfoFromation;
    }
}