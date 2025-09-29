<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use VanXuan\PdfToText\PdfToText;

class TextCaptureTest extends TestCase
{
    public function testTextCapture()
    {
        $pdf_file   =  "examples/text-capture/sample-report.pdf";
        $xml_file   =  "examples/text-capture/sample-report.xml";
        $pdf        =  new PdfToText($pdf_file, PdfToText::PDFOPT_CAPTURE);
        $pdf->SetCaptures($xml_file);
        $captures   =  $pdf->GetCaptures();

        $this->assertNotEmpty($captures->Title);
        $this->assertEquals('REPORT HEADER', trim($captures->Title[1]));

        $this->assertCount(10, $captures->ReportLines);
        
        $line1 = $captures->ReportLines[0];
        $this->assertEquals('L1C1  L1C2  L1C3', trim($line1->Column1));
        $line2 = $captures->ReportLines[1];
        $this->assertEquals('L2C1  L2C2  L2C3', trim($line2->Column1));
    }
}
