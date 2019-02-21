<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 20/02/2019
 * Time: 13.04
 */

include("./vendor/autoload.php");
use Aws\S3\S3Client;
Class Aws3{

private $S3;
public  function __construct()
{
    $this->S3= S3Client::factory([
        'key'=>"AKIAJ5N4QR5YMI5T2J2Q",
        'secret'=>"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",
        'region' => "ap-southeast-1"]);
}

    /**
     * @return S3Client
     */
    public function sendFile($bucketName,$filename,$sourceFile)
    {
        $result = $this->S3->putObject(array(
            'Bucket'=>$bucketName,
            'Key'=>$filename,
            'SourceFile'=>$sourceFile,
           // 'ContentType'=>"image/*",
            'ContentType'=>"application/octet-stream",
            'StorageClass'=>"STANDARD",
            'ACL'=>"public-read"
        ));
        return $result['ObjectURL']."\n";
    }


}