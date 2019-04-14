<?php
namespace AlishBeta\ImgLinkDownloader\Test;

use AlishBeta\ImgLinkDownloader\Downloader;
use AlishBeta\ImgLinkDownloader\Exception\ImgNotFoundException;
use PHPUnit\Framework\TestCase;

class DownloaderTest extends TestCase
{
    private $downloader;

    protected function setUp(){
        $this->downloader = new Downloader();
    }

    protected function tearDown(){
        $this->downloader = NULL;
    }

    /**
     * @expectedException PHPUnit\Framework\Error\Error
     */
    public function testImgNotFoundException(){
        $return = $this->downloader->getImg('http://rylik.ru/uploads/posts/2015-12/thumbs/1449608532_8_.jpg');
    }

    /**
     * @expectedException AlishBeta\ImgLinkDownloader\Exception\ImgNotSupportedException
     */
    public function testImgNotSupportedException(){
        $return = $this->downloader->getImg('http://static.wixstatic.com/media/ca2a5a_9062aaf5f7fe4f1290ca8cd48d6e3eb8.jpg/v1/fill/w_1024,h_683,al_c,q_90/ca2a5a_9062aaf5f7fe4f1290ca8cd48d6e3eb8.webp');
    }

    public function testExpectOutput()
    {
        $this->expectOutputString('1449608532_8.jpg');
        print $this->downloader->getImg('http://rylik.ru/uploads/posts/2015-12/thumbs/1449608532_8.jpg');
    }

    public function testExpectOutputWithPath()
    {
        $this->expectOutputString('img/1449608532_8.jpg');
        print $this->downloader->getImg('http://rylik.ru/uploads/posts/2015-12/thumbs/1449608532_8.jpg', 'img/');
    }
}