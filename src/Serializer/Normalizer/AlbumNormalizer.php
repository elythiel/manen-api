<?php

namespace App\Serializer\Normalizer;

use App\Entity\Album;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\UrlHelper;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class AlbumNormalizer implements NormalizerInterface, CacheableSupportsMethodInterface
{
    /** @var ObjectNormalizer */
    private $normalizer;

    /** @var UrlHelper */
    private $urlHelper;

    /** @var string */
    private $imagePath;

    public function __construct(
        ObjectNormalizer $normalizer,
        UrlHelper $urlHelper,
        ParameterBagInterface $params
    ) {
        $this->normalizer = $normalizer;
        $this->urlHelper = $urlHelper;
        $this->imagePath = $params->get('album_images');
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        $data = $this->normalizer->normalize($object, $format, $context);

        $data['image'] = $this->urlHelper->getAbsoluteUrl($this->imagePath.'/'.$data['image']);

        return $data;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof Album;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}
