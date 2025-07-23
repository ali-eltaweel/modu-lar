<?php

namespace Modular\Annotations;

use Attraction\Annotation;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final class Provider extends Annotation {

    public final function __construct(public readonly string $name) {}
}
