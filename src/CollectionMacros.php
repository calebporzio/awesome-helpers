<?php


namespace Calebporzio\AwesomeHelpers;


class CollectionMacros
{
    public function toAssoc ()
    {
        return function (){
            return $this->reduce(function ($assoc, $keyValuePair) {
                list($key, $value) = $keyValuePair;
                $assoc[$key] = $value;
                return $assoc;
            }, new static);
        };
    }
}
