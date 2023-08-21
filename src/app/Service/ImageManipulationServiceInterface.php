<?php

namespace Croppa\Service;

interface ImageManipulationServiceInterface
{

    /**
     * @param \Imagick $image
     * @param int $height
     * @param int $width
     * @return \Imagick
     */
    public function resize(\Imagick $image, int $height, int $width): \Imagick;

    /**
     * @param \Imagick $image
     * @param int $height
     * @param int $width
     * @return \Imagick
     */
    public function crop(\Imagick $image, int $height, int $width): \Imagick;
}