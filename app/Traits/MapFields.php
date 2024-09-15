<?php

namespace App\Traits;

trait MapFields
{
    /**
     * Map field from request to model.
     *
     * @param array $fieldMapping
     * @param array $validatedData
     * @return array
     */
    public function mapFields(array $fieldMapping, array $validatedData): array
    {
        $mappedData = [];

        foreach ($fieldMapping as $key => $value) {
            if (array_key_exists($key, $validatedData)) $mappedData[$value] = $validatedData[$key];
        }
        
        return $mappedData;
    }
}