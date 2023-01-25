<?php

namespace Cafewebcode\Webrouter;

/**
 * Class Cafewebcode Dispatch
 *
 * @author Cleyber F. Matos <https://github.com/cleyber2010/>
 * @package Cafewebcoce\Webrouter
 */
abstract class Dispatch
{
    /** @var string  */
    protected string $urlProject;

    /** @var string */
    protected string $route;

    /** @var array|null */
    protected ?array $routes;

    /** @var string|null */
    protected ?string $path;

    /** @var string */
    protected string $httpMethod;

    /** @var string $group */
    protected string $group;

    /** @var string $namespace */
    protected string $namespace;

    /** @var string */
    protected string $separator;

    public function __construct(string $urlProject, string $separator = "@")
    {
        $this->urlProject = $urlProject;
        $this->path = filter_input(INPUT_GET, "route", FILTER_DEFAULT);
        $this->httpMethod = $_SERVER["REQUEST_METHOD"];
        $this->separator = $separator;
    }
}