<?php

namespace Test;

class User
{
    public function index(?array $data)
    {
        echo "Controller User Method Index";

        var_dump($data);
    }
}