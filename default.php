<?php

/**
 * We see quite often images' orientation rotated
 * once we have uploaded them successfully.
 *
 * This solution simply gets the change back.
 *
 * It requires imagick extension
 *
 * @param string $imagePath
 *
 * @throws ImagickException
 */
function respect_image_orientation($imagePath)
{
    if (!is_file($imagePath)) {
        return;
    }

    $image = new \Imagick($imagePath);

    switch ($image->getImageOrientation()) {
        case \Imagick::ORIENTATION_BOTTOMRIGHT:
            $image->rotateimage("#000", 180); // rotate 180 degrees
            break;

        case \Imagick::ORIENTATION_RIGHTTOP:
            $image->rotateimage("#000", 90); // rotate 90 degrees CW
            break;

        case \Imagick::ORIENTATION_LEFTBOTTOM:
            $image->rotateimage("#000", -90); // rotate 90 degrees CCW
            break;
    }

    $image->setImageOrientation(\Imagick::ORIENTATION_TOPLEFT);
    $image->writeImage($imagePath);
}
