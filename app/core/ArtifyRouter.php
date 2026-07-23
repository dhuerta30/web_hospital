<?php

namespace App\core;

class ArtifyRouter
{
    private $wheres = [];
    private $routes = [];
    private $namedRoutes = [];
    private $currentRouteKey;
    private $middlewares = [];

    public function middleware($middlewares)
    {
        if (!is_array($middlewares)) {
            $middlewares = [$middlewares];
        }

        $this->middlewares[
            $this->currentRouteKey
        ] = $middlewares;

        return $this;
    }

    public function where($regex)
    {
        if ($this->currentRouteKey === null) {
            throw new \LogicException(
                "No route available to apply where()."
            );
        }

        $this->wheres[
            $this->currentRouteKey
        ] = $regex;

        return $this;
    }

    public function get($uri, $action)
    {
        return $this->addRoute(
            'GET',
            $uri,
            $action
        );
    }

    public function post($uri, $action)
    {
        return $this->addRoute(
            'POST',
            $uri,
            $action
        );
    }

    public function put($uri, $action)
    {
        return $this->addRoute(
            'PUT',
            $uri,
            $action
        );
    }

    public function delete($uri, $action)
    {
        return $this->addRoute(
            'DELETE',
            $uri,
            $action
        );
    }

    private function addRoute(
        $method,
        $uri,
        $action
    ) {
        if (!in_array($method, [
            'GET',
            'POST',
            'PUT',
            'DELETE'
        ])) {
            throw new \InvalidArgumentException(
                "Invalid HTTP method: $method"
            );
        }

        $routeKey = count(
            $this->routes
        );

        $this->routes[$routeKey] = [
            'method' => $method,
            'uri' => $this->formatUri(
                $uri
            ),
            'action' => $action
        ];

        $this->currentRouteKey =
            $routeKey;

        return $this;
    }

    public function name($name)
    {
        if ($this->currentRouteKey === null) {
            throw new \LogicException(
                "No route available to name."
            );
        }

        $this->namedRoutes[$name] =
            $this->routes[
                $this->currentRouteKey
            ]['uri'];

        return $this;
    }

    public function url(
        $name,
        $params = []
    ) {
        if (
            !isset(
                $this->namedRoutes[$name]
            )
        ) {
            throw new \InvalidArgumentException(
                "Route '$name' not found."
            );
        }

        $uri =
            $this->namedRoutes[$name];

        if (
            preg_match_all(
                '/\{(\w+)\}/',
                $uri,
                $matches
            )
        ) {
            foreach (
                $matches[1]
                as $param
            ) {
                if (
                    !isset(
                        $params[$param]
                    )
                ) {
                    throw new \InvalidArgumentException(
                        "Missing parameter '$param' for route '$name'."
                    );
                }

                $uri = str_replace(
                    "{{$param}}",
                    $params[$param],
                    $uri
                );
            }
        }

        return '/' . $uri;
    }

    private function formatUri($uri)
    {
        return trim(
            $uri,
            '/'
        );
    }

    public function dispatch(
        Request $request
    ) {
        /*
        |--------------------------------------------------------------------------
        | Método HTTP
        |--------------------------------------------------------------------------
        */

        $requestMethod =
            $request->getMethod();

        /*
        |--------------------------------------------------------------------------
        | URI solicitada
        |--------------------------------------------------------------------------
        */

        $requestUri = parse_url(
            $_SERVER['REQUEST_URI'],
            PHP_URL_PATH
        );

        $requestUri = trim(
            $requestUri,
            '/'
        );

        /*
        |--------------------------------------------------------------------------
        | BASE_URL
        |--------------------------------------------------------------------------
        */

        if (
            !empty(
                $_ENV['BASE_URL']
            ) &&
            $_ENV['BASE_URL'] !== '/'
        ) {
            $base = trim(
                $_ENV['BASE_URL'],
                '/'
            );

            if (
                $requestUri === $base ||
                str_starts_with(
                    $requestUri,
                    $base . '/'
                )
            ) {
                $requestUri = trim(
                    substr(
                        $requestUri,
                        strlen($base)
                    ),
                    '/'
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Buscar ruta
        |--------------------------------------------------------------------------
        */

        foreach (
            $this->routes as $routeKey => $route
        ) {

            if (
                $route['method']
                !== $requestMethod
            ) {
                continue;
            }

            $regex =
                $this->convertToRegex(
                    $route['uri'],
                    $routeKey
                );

            if (
                !preg_match(
                    $regex,
                    $requestUri,
                    $matches
                )
            ) {
                continue;
            }

            $this->currentRouteKey =
                $routeKey;

            /*
            |--------------------------------------------------------------------------
            | Parámetros GET y POST
            |--------------------------------------------------------------------------
            */

            $params = array_merge(
                $matches,
                $request->all()
            );

            /*
            |--------------------------------------------------------------------------
            | Obtener nombres de parámetros
            |--------------------------------------------------------------------------
            |
            | Ejemplo:
            |
            | /pagina/{titulo}
            |
            | El router captura:
            |
            | $matches[1] =
            | "Quienes-Somos"
            |
            | Y lo transforma en:
            |
            | $params['titulo'] =
            | "Quienes-Somos"
            |
            */

            preg_match_all(
                '/\{(\w+)\??\}/',
                $route['uri'],
                $routeParams
            );

            foreach (
                $routeParams[1]
                as $index => $paramName
            ) {

                $matchIndex =
                    $index + 1;

                if (
                    isset(
                        $matches[$matchIndex]
                    )
                ) {
                    $params[
                        $paramName
                    ] =
                        $matches[
                            $matchIndex
                        ];
                }
            }

            /*
            |--------------------------------------------------------------------------
            | Parámetros especiales Restp
            |--------------------------------------------------------------------------
            */

            if (
                isset(
                    $params['Restp']
                )
            ) {

                if (
                    count($matches) === 3
                ) {
                    $params['tabla'] =
                        $matches[1];

                    $params['token'] =
                        $matches[2];

                } elseif (
                    count($matches) === 4
                ) {
                    $params['tabla'] =
                        $matches[1];

                    $params['filtro_url'] =
                        $matches[2];

                    $params['token'] =
                        $matches[3];
                }

                unset(
                    $params[0],
                    $params[1],
                    $params[2],
                    $params[3],
                    $params['param1'],
                    $params['param2'],
                    $params['param3']
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Crear nuevo Request
            |--------------------------------------------------------------------------
            */

            $newRequest =
                new Request(
                    $requestMethod,
                    $_SERVER['REQUEST_URI']
                );

            $newRequest->initialize(
                $params
            );

            /*
            |--------------------------------------------------------------------------
            | Ejecutar middlewares
            |--------------------------------------------------------------------------
            */

            $this->runMiddlewareStack(
                $route,
                $newRequest
            );

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | 404
        |--------------------------------------------------------------------------
        */

        http_response_code(
            404
        );

        Redirect::to(
            "error"
        );
    }

    private function convertToRegex(
        $routeUri,
        $routeKey
    ) {
        $segments = explode(
            '/',
            trim(
                $routeUri,
                '/'
            )
        );

        $regex = '';

        $where =
            $this->wheres[
                $routeKey
            ] ?? '[^/]+';

        foreach (
            $segments as $index => $segment
        ) {

            $prefix =
                $index === 0
                    ? ''
                    : '/';

            /*
            |--------------------------------------------------------------------------
            | Parámetro opcional
            |--------------------------------------------------------------------------
            */

            if (
                preg_match(
                    '/^\{(\w+)\?\}$/',
                    $segment
                )
            ) {
                $regex .=
                    '(?:'
                    . $prefix
                    . '('
                    . $where
                    . ')'
                    . ')?';

            /*
            |--------------------------------------------------------------------------
            | Parámetro obligatorio
            |--------------------------------------------------------------------------
            */

            } elseif (
                preg_match(
                    '/^\{(\w+)\}$/',
                    $segment
                )
            ) {
                $regex .=
                    $prefix
                    . '('
                    . $where
                    . ')';

            /*
            |--------------------------------------------------------------------------
            | Texto fijo
            |--------------------------------------------------------------------------
            */

            } else {
                $regex .=
                    $prefix
                    . preg_quote(
                        $segment,
                        '#'
                    );
            }
        }

        return '#^'
            . $regex
            . '$#';
    }

    private function executeAction(
        $action,
        Request $request
    ) {
        /*
        |--------------------------------------------------------------------------
        | Closure
        |--------------------------------------------------------------------------
        */

        if (
            $action instanceof \Closure
        ) {
            return $action(
                $request,
                ...array_values(
                    $request->all()
                )
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Callable
        |--------------------------------------------------------------------------
        */

        if (
            is_array($action) &&
            is_callable($action)
        ) {
            return call_user_func(
                $action,
                $request
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Controller@method
        |--------------------------------------------------------------------------
        */

        if (
            is_string($action) &&
            strpos(
                $action,
                '@'
            ) !== false
        ) {

            list(
                $controller,
                $method
            ) =
                explode(
                    '@',
                    $action
                );

            $controller =
                "App\\Controllers\\"
                . $controller;

            if (
                !class_exists(
                    $controller
                ) ||
                !method_exists(
                    $controller,
                    $method
                )
            ) {
                http_response_code(
                    404
                );

                Redirect::to(
                    "error"
                );

                return;
            }

            $controllerInstance =
                new $controller();

            return
                $controllerInstance
                ->$method(
                    $request
                );
        }

        throw new \InvalidArgumentException(
            'Invalid route action.'
        );
    }

    private function runMiddlewareStack(
        $route,
        Request $request
    ) {
        $middlewares =
            $this->middlewares[
                $this->currentRouteKey
            ] ?? [];

        $action =
            function ($req) use ($route) {
                return $this->executeAction(
                    $route['action'],
                    $req
                );
            };

        $pipeline =
            array_reduce(
                array_reverse(
                    $middlewares
                ),
                function (
                    $next,
                    $middlewareClass
                ) {
                    return function (
                        $request
                    ) use (
                        $middlewareClass,
                        $next
                    ) {

                        if (
                            !class_exists(
                                $middlewareClass
                            ) &&
                            strpos(
                                $middlewareClass,
                                '\\'
                            ) === false
                        ) {
                            $middlewareClass =
                                'App\\core\\middleware\\'
                                . $middlewareClass;
                        }

                        $middleware =
                            new $middlewareClass();

                        return
                            $middleware->handle(
                                $request,
                                $next
                            );
                    };
                },
                $action
            );

        return $pipeline(
            $request
        );
    }
}