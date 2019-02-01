<?php

define('carry', '{carry}');

function chain($object)
{
    return new class ($object)
    {
        protected $lastReturn = null;

        public function __construct($object)
        {
            $this->wrapped = $object;
        }

        public function tap($callback)
        {
            $callback($this->wrapped);

            return $this;
        }

        public function __toString()
        {
            return (string)$this->lastReturn;
        }

        public function __call($method, $params)
        {
            if (($index = array_search('{carry}', $params)) !== false) {
                $params[$index] = $this->lastReturn;
            }

            $this->lastReturn = $this->wrapped->{$method}(...$params);

            return $this;
        }

        public function __invoke()
        {
            return $this->lastReturn;
        }
    };
}
