<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use VanXuan\PdfToText\FormDefinitions;
use VanXuan\PdfToText\PdfToText;

class FormdataTest extends TestCase
{
    public function testCaptureFormDataWithoutXmlDefs()
    {
        $pdf_file   =  "examples/formdata-extraction/sample.pdf";

        $pdf = new PdfToText($pdf_file);

        $this->assertTrue($pdf->HasFormData());

        $w9  = $pdf->GetFormData();

        $rawData = $w9->data();
        $this->assertNotEmpty($rawData);
        $this->assertCount(17, $rawData);
    }
}
