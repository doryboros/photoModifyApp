<?php


namespace MyApp\ImageSaver;


use MyApp\Http\Request;

class ImageSaver
{

    /**
     *
     */
    private const PROJECT_ROOT='/var/www/my-application/';
    /**
     *
     */
    private const UPLOADS_FOLDER_ROOT=self::PROJECT_ROOT . "uploads/";

    /**
     * ImageSaver constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {

    }

    /**
     * @param $inputPath
     * @param $outputPath
     * @param $size
     */
    public function saveTierWithoutWateramrk($inputPath, $outputPath, $size)
    {
        if($size == 'S')
        {
            $width=80;
        }
        if($size == 'M')
        {
            $width= 120;
        }

        $command = ($size !== 'L') ?
             "php " . __DIR__ . "/../../cli/myCommandLineTool.php" .
             " --input-file=" . self::UPLOADS_FOLDER_ROOT . $inputPath .
             " --output-file=" . self::UPLOADS_FOLDER_ROOT . $outputPath .
             " --width=" . $width
            :"php " . __DIR__ . "/../../cli/myCommandLineTool.php" .
            " --input-file=" . self::UPLOADS_FOLDER_ROOT . $inputPath .
            " --output-file=" . self::UPLOADS_FOLDER_ROOT . $outputPath;

        $this->executeCli($command);
    }

    /**
     * @param $inputPath
     * @param $outputPath
     * @param $size
     */
    public function saveTierWithWateramrk($inputPath, $outputPath, $size)
    {
        if($size == 'S')
        {
            $width=100;
        }
        if($size == 'M')
        {
            $width= 200;
        }

        $command = ($size !== 'L') ?
            "php " . __DIR__ . "/../../cli/myCommandLineTool.php".
             " --input-file=" . self::UPLOADS_FOLDER_ROOT . $inputPath .
            " --output-file=" . self::UPLOADS_FOLDER_ROOT . $outputPath .
            " --width=" . $width .
            " --watermark=/var/www/my-application/watermark.jpg"
            :"php " . __DIR__ . "/../../cli/myCommandLineTool.php" .
            " --input-file=" . self::UPLOADS_FOLDER_ROOT . $inputPath .
            " --output-file=" . self::UPLOADS_FOLDER_ROOT . $outputPath .
            " --watermark=/var/www/my-application/watermark.jpg";
        var_dump($command);

        $this->executeCli($command);
    }

    /**
     * Execute CLI
     * @param $command
     */
    private function executeCli($command)
    {
        $lastLine = exec($command, $output, $returned);
    }

}