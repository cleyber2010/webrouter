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
    /** @var string */
    protected string $urlProject;

    /** @var array */
    protected array $data;

    /** @var mixed */
    protected mixed $route;

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

    /** @var string|null */
    protected ?string $error = null;

    public function __construct(string $urlProject, string $separator = "@")
    {
        $this->urlProject = rtrim($urlProject, "/");
        $this->path = filter_input(INPUT_GET, "route", FILTER_DEFAULT);
        $this->httpMethod = $_SERVER["REQUEST_METHOD"];
        $this->separator = $separator;
    }

    public function namespace(?string $namespace): Dispatch
    {
        $this->namespace = ($namespace ? ucfirst($namespace) . "\\" : null);
        return $this;
    }

    public function error(): ?string
    {
        return $this->error;
    }

    public function addRoute(string $method, string $route, string $handler): void
    {
        $route = rtrim($route, "/");
        $path = trim($this->path ?? "", "/");
        $routeAssoc = trim($route, "/");

        preg_match_all("/\{\s*([a-zA-Z0-9_-]*)\}/", $route, $keys, PREG_SET_ORDER);
        $arrDiff = array_values(array_diff_assoc(explode("/", $path), explode("/", $routeAssoc)));
        $count = 0;
        foreach ($keys as $value) {
            $this->data[$value[1]] = $arrDiff[$count++];
        }

        $action = explode("@", $handler)[1];
        $handler = $this->namespace . explode("@", $handler)[0];

        $arrRoute = function () use ($route, $handler, $method, $action) {
            return [
                "route" => $route,
                "handler" => $handler,
                "action" => $action,
                "method" => $method,
                "data" => $this->data
            ];
        };

        $route = preg_replace('~{([^}]*)}~', "([^/]+)", $route);

        $this->routes[$method][$route] = $arrRoute();

    }

    public function execute(): bool
    {
        if (empty($this->routes) || empty($this->routes[$this->httpMethod])) {
            $this->error = "501";
            return false;
        }

        $this->route = null;
        foreach ($this->routes[$this->httpMethod] as $key => $route) {
            if (preg_match("~^" . $key . "$~", $this->path, $found)) {
                $this->route = $route;
            }
        }

        if ($this->route) {
            $controller = $this->route["handler"];
            $method = $this->route["action"];
            if (class_exists($controller)) {
                $newControler = new $controller();
                if (method_exists($controller, $method)) {
                    $newControler->$method(($this->route["data"] ?? []));
                    return true;
                }

                $this->error = "405";
                return false;
            }

            $this->error = "400";
            return false;
        }

        $this->error = "404";
        return false;
    }

}