<?php

namespace Croppa\Service;

class ImageManipulationService implements ImageManipulationServiceInterface
{

    /**
     * @inheritDoc
     * @throws \ImagickException
     */
    public function resize(\Imagick $image, int $height, int $width): \Imagick
    {
        if (0 >= $height && 0 >= $width) {
            return $image;
        }

        $image->resizeImage($width, $height, $image::FILTER_CATROM, .3,);
        return $image;
    }

    /**
     * @inheritDoc
     * @throws \ImagickException
     */
    public function crop(\Imagick $image, int $height, int $width): \Imagick
    {
        if (
            (0 >= $height && 0 >= $width) ||
            ($height > $image->getImageHeight() && $width > $image->getImageWidth())
        ) {
            return $image;
        }

        $image->cropImage($width, $height, 0, 0);
        return $image;
    }
}