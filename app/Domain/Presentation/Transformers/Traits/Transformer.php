<?php

namespace App\Domain\Presentation\Transformers\Traits;

use App\Domain\Presentation\Transformers\TransformerAbstract;
use Spatie\FlareClient\Http\Exceptions\InvalidData;

trait Transformer
{
    public function transform(
        $data,
        string $transformerName): array
    {
        $result = [
            'data' => [],
        ];
        $transformer = new $transformerName();

        if (!($transformer instanceof TransformerAbstract)) {
            throw new InvalidData();
        }

        if ($data instanceof \Iterator) {
            foreach ($data as $item) {
                $result['data'][] = $transformer->transform($item);
            }
        } else {
            $result['data'] = $transformer->transform($data);
        }

        return $result;
    }
}
