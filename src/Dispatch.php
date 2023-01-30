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

    /** @var array  */
    protected array $data;

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
        $this->urlProject = rtrim($urlProject, "/");
        $this->path = filter_input(INPUT_GET, "route", FILTER_DEFAULT);
        $this->httpMethod = $_SERVER["REQUEST_METHOD"];
        $this->separator = $separator;
    }

    public function group(?string $group): Dispatch
    {
        $this->group = $group;
        return $this;
    }

    public function namespace(?string $namespace): Dispatch
    {
        $this->namespace = ($namespace ? ucfirst($namespace) . "\\" : null);
        return $this;
    }

    public function addRoute(string $method, string $route, string $handler): ?array
    {
        $route = rtrim($route, "/");

        preg_match_all("/\{\s*([a-zA-Z0-9_-]*)\}/", $route, $keys, PREG_SET_ORDER);

        foreach ($keys as $value) {
            $this->data[$value[0]] = $value[1];
        }

        var_dump($this->data);
        return [];
    }
}