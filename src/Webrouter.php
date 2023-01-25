<?php

namespace Cafewebcode\Webrouter;

/**
 * Class Cafewebcode Webrouter
 *
 * @author Cleyber F. Matos <https://github.com/cleyber2010/>
 * @package Cafewebcode\Webrouter
 */

class Webrouter extends Dispatch
{
    public function __construct(string $urlProject, string $separator = "@")
    {
        parent::__construct($urlProject, $separator);
    }
}