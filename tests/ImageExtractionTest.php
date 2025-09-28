<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use VanXuan\PdfToText\PdfToText;

class ImageExtractionTest extends TestCase
{
    public function testExtraction()
    {
        $inputFile =  'tests/assets/image-extraction-sample.pdf';
        $output_image =  tempnam('/tmp', 'testimg') . '.jpg';
        $pdf  =  new PdfToText($inputFile, PdfToText::PDFOPT_DECODE_IMAGE_DATA);
        
        $this->assertCount(1, $pdf->Images);

        // Get next image and generate a filename for it(there will be a file named "sample.x.jpg"
        // for each image found in file "sample.pdf")
        $img  =  $pdf->Images[0];   // This is an object of type PdfImage
        $imgindex  =  sprintf("%02d", 1);
        
        
        // Allocate a color entry for "white". Note that the ImageResource property of every PdfImage object
        // is a real image resource that can be specified to any of the image*() Php functions
        $textcolor =  imagecolorallocate($img->ImageResource, 0, 0, 255);
        
        // Put the string "Hello world" on top of the image. 
        imagestring($img->ImageResource, 5, 0, 0, "Hello world #$imgindex", $textcolor);
        
        // Save the image(the default is IMG_JPG, but you can specify another IMG_* image type by specifying it
        // as the second parameter)
        $img->SaveAs($output_image);

        $writtenResult = file_get_contents($output_image);
        $this->assertNotEmpty($writtenResult);

        $expectedFile =  'tests/assets/baseline-sample.01.jpg';
        $expectedResult = file_get_contents($expectedFile);

        $this->assertTrue($writtenResult == $expectedResult);
    }
}