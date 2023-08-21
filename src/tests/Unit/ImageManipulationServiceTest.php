<?php

describe("Testing Image Manipulation Service", function () {
    it("Checks Resize", function () {
        $service = getImageManipulationService();
        $image = getImage();
        $resizedImage = $service->resize($image, 200, 400);

        expect($resizedImage->getImageHeight())->toBe(200)
            ->and($resizedImage->getImageWidth())->toBe(400);
    });

    it("Checks Resize - with one parameter 0", function () {
        $service = getImageManipulationService();
        $image = getImage();
        $originalWidth = $image->getImageWidth();
        $resizedImage = $service->resize($image, 200, 0);

        expect($resizedImage->getImageHeight())->toBe(200)
            ->and($resizedImage->getImageWidth())->toBeLessThan($originalWidth);
    });

    it("Check Resize - input 0,0 should return the same", function () {
        $service = getImageManipulationService();
        $image = getImage();
        $resizedImage = $service->resize($image, 0, 0);

        expect($resizedImage->getImageHeight())->toBe($image->getImageHeight())
            ->and($resizedImage->getImageWidth())->toBe($image->getImageWidth());
    });

    it("Checks Crop", function () {
        $service = getImageManipulationService();
        $image = getImage();
        $croppedImage = $service->crop($image, 20, 40);

        expect($croppedImage->getImageHeight())->toBe(20)
            ->and($croppedImage->getImageWidth())->toBe(40);
    });

    it("Checks Crop - with one parameter 0", function () {
        $service = getImageManipulationService();
        $image = getImage();
        $originalHeight = $image->getImageHeight();
        $croppedImage = $service->crop($image, 0, 40);

        expect($croppedImage->getImageWidth())->toBe(40)
            ->and($croppedImage->getImageHeight())->toBe($originalHeight);
    });

    it("Checks Crop - input 0,0 should return the same", function () {
        $service = getImageManipulationService();
        $image = getImage();
        $croppedImage = $service->crop($image, 0, 0);

        expect($croppedImage->getImageHeight())->toBe($image->getImageHeight())
            ->and($croppedImage->getImageWidth())->toBe($image->getImageWidth());
    });
});