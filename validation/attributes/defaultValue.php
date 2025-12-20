<?php

namespace Validation\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class DefaultValue{
    public mixed $value;

    public function __construct(mixed $value) {
        $this->value = $value;
    }
}