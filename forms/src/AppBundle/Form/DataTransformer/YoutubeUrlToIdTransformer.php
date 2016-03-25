<?php

namespace AppBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class YoutubeUrlToIdTransformer implements DataTransformerInterface
{
    const YOUTUBE_VIDEO_URL = 'https://www.youtube.com/watch?v=';

    /**
     * @inheritdoc
     */
    public function transform($value)
    {
        if (null === $value || '' === $value) {
            return '';
        }

        return self::YOUTUBE_VIDEO_URL.$value;
    }

    /**
     * @inheritdoc
     */
    public function reverseTransform($value)
    {
        if ('' === $value) {
            return null;
        }

        return str_replace(self::YOUTUBE_VIDEO_URL, '', $value);
    }
}
