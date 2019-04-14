# ImgLinkDownloader
Для уснановки набираем в терминале: composer require alishbeta/img-link-downloader dev-master
Использование:
$downloader = new \AlishBeta\ImgLinkDownloader\Downloader();
$downloader->getImg($img_url, $path = '');
