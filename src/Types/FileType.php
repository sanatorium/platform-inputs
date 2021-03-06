<?php

namespace Sanatorium\Inputs\Types;

use Cartalyst\Attributes\EntityInterface;
use Platform\Attributes\Models\Attribute;

class FileType extends MediaType
{
    /**
     * {@inheritDoc}
     */
    protected $identifier = 'file';

    /**
     * {@inheritDoc}
     */
    public function getEntityFormHtml(Attribute $attribute, EntityInterface $entity)
    {
        $mode = 'single';
        return view("sanatorium/inputs::types/media", compact('attribute', 'entity', 'mode'));
    }
}
