<?php

namespace Megaezz\LaravelDatabasePrefix;

trait HasDatabasePrefix
{
    public function __construct(array $attributes = [])
    {
        if (isset($this->database)) {
            $this->table = $this->database . '.' . $this->getTable();
        } else {
            $this->table = $this->getConnection()->getDatabaseName() . '.' . $this->getTable();
        }

        parent::__construct($attributes);
    }
}
