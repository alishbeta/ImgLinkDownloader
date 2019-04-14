<?php

namespace AlishBeta\ImgLinkDownloader;

use AlishBeta\ImgLinkDownloader\Exception\ImgFileIsNotImageExceprion;
use AlishBeta\ImgLinkDownloader\Exception\ImgNotFoundException;
use AlishBeta\ImgLinkDownloader\Exception\ImgNotSupportedException;
use AlishBeta\ImgLinkDownloader\Exception\ImgSaveErrorException;

/**
 * Class Downloader
 * @package AlishBeta\ImgLinkDownloader
 */
class Downloader
{
    /**
     * @var
     */
    public $img;
    /**
     * @var array
     */
    private $ext = ["jpg", "png", "gif"];
    /**
     * @var array
     */
    private $mime = ["image/jpeg", "image/png", "image/gif"];

    /**
     * @param $img_url
     * @param string $path
     * @return bool|string
     * @throws \Exception
     */
    public function getImg($img_url, $path = '')
    {
        //Get pathinfo
        $image = pathinfo($img_url);

        //if file extention not in $ext array throw exception
        if (!in_array($image['extension'], $this->ext))
            throw new ImgNotSupportedException();

        //throw exception if can not get image
        if (!$data = file_get_contents($img_url))
            throw new ImgNotFoundException();

        file_put_contents($file = $path . $image['basename'], $data);

        //throw exception if can not save image
        if (!file_exists($file))
            throw new ImgSaveErrorException();

        $mime = getimagesize($file)['mime'];

        //throw exception if file is not image
        if (!in_array($mime, $this->mime)){
            unlink($file);
            throw new ImgFileIsNotImageExceprion();
        }

        return $file;
    }

}