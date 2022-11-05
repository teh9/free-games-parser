<?php

namespace app\interfaces;

interface File
{
    public function readFile ();

    public function saveFile (array $params);
}
