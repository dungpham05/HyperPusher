<?php

class Container
{
    protected $instances = [];

    /**
     * Đăng ký một class hay interface với Container
     *
     * @param $abstract
     * @param $concrete
     */
    public function bind($abstract, $concrete = NULL)
    {
        if (is_null($concrete)) {
            $concrete = $abstract;
        }
        $this->instances[$abstract] = $concrete;
    }

    /**
     * Lấy ra instance từ Container
     *
     * @param $abstract
     * @return mixed|object
     * @throws Exception
     */
    public function make($abstract, $parameters = [])
    {
        if (!isset($this->instances[$abstract])) {
            $this->bind($abstract);
        }

        return $this->resolve($this->instances[$abstract], $parameters);
    }

    /**
     * Sử dụng Reflection và đệ quy (hàm resolveDependencies)
     * để inspect class và lấy các class dependency của nó cho đến hết
     *
     * @param $concrete
     * @return mixed|object
     * @throws ReflectionException
     */
    protected function resolve($concrete, $parameters)
    {
        if ($concrete instanceof Closure) {
            return $concrete($this, $parameters);
        }

        $reflector = new ReflectionClass($concrete);

        if (!$reflector->isInstantiable()) {
            throw new Exception("Class {$concrete} is not instantiable");
        }

        $constructor = $reflector->getConstructor();

        if (is_null($constructor)) {
            return $reflector->newInstance();
        }

        $parameters = $constructor->getParameters();
        $dependencies = $this->resolveDependencies($parameters);

        return $reflector->newInstanceArgs($dependencies);
    }

    /**
     * Sử dụng Reflection và đệ quy để
     * inspect class và lấy các class dependency của nó cho đến hết
     * @param $parameters
     * @return array
     * @throws Exception
     */
    protected function resolveDependencies($parameters)
    {
        $dependencies = [];
 
        foreach ($parameters as $parameter) {
            $dependency = $parameter->getType()->getName();

            if (is_null($dependency)) {
                if ($parameter->isDefaultValueAvailable()) {
                    $dependencies[] = $parameter->getDefaultValue();
                } else {
                    throw new Exception("Can not resolve dependency {$parameter->name}");
                }
            } else {
                $dependencies[] = $this->make($dependency);
            }
        }

        return $dependencies;
    }
}
