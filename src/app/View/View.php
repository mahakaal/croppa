<?php

namespace Croppa\View;

use Croppa\Service\ImageManipulationService;
use Croppa\Service\ImageManipulationServiceInterface;
use Croppa\Service\LoggerService;

class View
{
    /** @var ImageManipulationServiceInterface */
    private ImageManipulationServiceInterface $manipulationService;

    public function __construct()
    {
        $this->manipulationService = new ImageManipulationService();
    }

    /**
     * @param array $queryParams
     * @return \Imagick|null
     */
    public function process(array $queryParams): ?\Imagick
    {
        $source = $this->getValueFromArray($queryParams, 'source');
        $operation = $this->getValueFromArray($queryParams, 'operation');
        $height = $this->getValueFromArray($queryParams, 'height', 0);
        $width = $this->getValueFromArray($queryParams, 'width', 0);
        $filename = __DIR__ . "/../../public/img/". $source;

        try {
            $image = $this->getImage($filename);
            if (!$image instanceof \Imagick) {
                return null;
            }

            $result = null;
            switch ($operation) {
                case 'original':
                    $result = $this->manipulationService->resize($image, $image->getImageHeight(), $image->getImageWidth());;
                    break;
                case 'crop':
                    $result = $this->manipulationService->crop($image, $height, $width);
                    break;
                case 'resize':
                    $result = $this->manipulationService->resize($image, $height, $width);
                    break;
                default:
                    break;
            }
        } catch (\ImagickException|\Exception $exception) {
            $message = sprintf(
                "Error while performing %s operation. Parameters: %s. Exception %s",
                $operation, json_encode($queryParams), $exception->getMessage()
            );
            LoggerService::log($message, 'error');
            return null;
        }

        return $result;
    }

    /**
     * @param array $array
     * @param string $key
     * @param mixed $defaultValue
     * @return mixed|string
     */
    protected function getValueFromArray(array $array, string $key, mixed $defaultValue = ''): mixed
    {
        return $array[$key] ?? $defaultValue;
    }

    /**
     * @param string $filename
     * @return \Imagick|null
     * @throws \ImagickException
     */
    protected function getImage(string $filename): ?\Imagick
    {
        return (file_exists($filename) && !is_dir($filename)) ? new \Imagick($filename) : null;
    }
}