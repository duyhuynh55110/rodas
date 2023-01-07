<?php
namespace App\Libs;
use League\Fractal\Serializer\ArraySerializer;

/**
 * Custom class for fratal
 *
 */
class CustomFractalSerializer extends ArraySerializer
{
    public function collection(null|string $resourceKey, array $data): array
    {
        if ($resourceKey) {
            return [$resourceKey => $data];
        }

        return $data;
    }

    public function item(null|string $resourceKey, array $data): array
    {
        if ($resourceKey) {
            return [$resourceKey => $data];
        }
        return $data;
    }
}
