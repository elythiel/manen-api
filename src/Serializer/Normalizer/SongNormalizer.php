<?php

namespace App\Serializer\Normalizer;

use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class SongNormalizer implements NormalizerInterface, CacheableSupportsMethodInterface
{
    /** @var ObjectNormalizer */
    private $normalizer;

    public function __construct(ObjectNormalizer $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        $data = $this->normalizer->normalize($object, $format, $context);

        if(!is_null($data['authors'])) {
            $data['authors'] = array_map('trim', explode(',', $data['authors']));
        }
        if(!is_null($data['guests'])) {
            $data['guests'] = array_map('trim', explode(',', $data['guests']));
        }

        return $data;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof \App\Entity\Song;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}
