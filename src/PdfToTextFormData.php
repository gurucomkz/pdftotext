<?php
namespace VanXuan\PdfToText;

class PdfToTextFormData
{
    private $data = [];

    public function __construct()
    {
    }

    public function data(): array
    {
        return $this->data;
    }

    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }
}
