<?php


namespace MyApp\ImageSaver;


class ImageDownload
{

    private $fullFilePath;

    /**
     * ImageDownload constructor.
     * @param $fullFilePath
     */
    public function __construct($fullFilePath)
    {
        $this->fullFilePath = $fullFilePath;
    }

    public function downloadPhoto($fullFilePath)
    {
        if (file_exists($fullFilePath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($fullFilePath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($fullFilePath));
            flush();
            readfile($fullFilePath);
        }
    }

}