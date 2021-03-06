<?php

namespace Sanatorium\Inputs\Handlers\Attributes;

use Platform\Attributes\Handlers\DataHandler;
use Platform\Attributes\Handlers\DataHandlerInterface;

class AttributesDataHandler extends DataHandler implements DataHandlerInterface
{
    /**
     * {@inheritDoc}
     */
    public function prepare(array $data)
    {
        $options = [];

        $input = array_get($data, 'options', []);

        if ( !empty($input) && is_string( $input ) ) {
            $options = json_decode($input);
        } else {
            $options = array_get($data, 'options', []);
        }

        $build = [];

        foreach ($options as $option) {
            if ( !isset($option['value']) || !isset($option['label']) ) {
                continue;
            }

            if (! $option['value'] && ! $option['label']) {
                continue;
            }

            if ( !is_string($option['value']) || !is_string($option['label']) ) {
                continue;
            }

            $build[trim($option['value'])] = trim($option['label']);
        }

        $options = $build;

        return array_merge(array_except($data, 'options'), compact('options'));
    }
}
