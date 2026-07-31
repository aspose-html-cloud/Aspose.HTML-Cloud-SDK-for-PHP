<?php
/*
* --------------------------------------------------------------------------------------------------------------------
* <copyright company="Aspose" file="ConversionApiTest.php">
*   Copyright (c) 2022 Aspose.HTML for Cloud
* </copyright>
* <summary>
*   Permission is hereby granted, free of charge, to any person obtaining a copy
*  of this software and associated documentation files (the "Software"), to deal
*  in the Software without restriction, including without limitation the rights
*  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
*  copies of the Software, and to permit persons to whom the Software is
*  furnished to do so, subject to the following conditions:
*
*  The above copyright notice and this permission notice shall be included in all
*  copies or substantial portions of the Software.
*
*  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
*  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
*  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
*  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
*  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
*  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
*  SOFTWARE.
* </summary>
* --------------------------------------------------------------------------------------------------------------------
*/

namespace Client\Invoker\Api;

use SplFileObject;

/**
 * ConversionApiTest Class Doc Comment
 *
 * @category Class
 * @package  Client\Invoker\Api
 */
class ConversionApiTest extends BaseTest
{
    /**
     * Test case for conversion a local file to a local file for html format
     *
     * Convert the HTML document from the local disk by its name to the specified format.
     * @param string     $out_format Resulting format. (required)
     * @param float|null $width Resulting width. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $height Resulting height. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $left_margin Left resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $right_margin Right resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $top_margin Top resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $bottom_margin Bottom resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     *
     * @dataProvider providerConversion
     *
     */
    public function testConvertLocalToLocalHtml(
        string $out_format,
        float $width = null,
        float $height = null,
        float $left_margin = null,
        float $right_margin = null,
        float $top_margin = null,
        float $bottom_margin = null
    ) {
        $src = self::$testFolder . "test1.html";
        $dst = self::$testResult
            . $width . 'X'. $height . 'X'
            . $left_margin . 'X'. $right_margin . 'X'
            . $top_margin . 'X'. $bottom_margin . '.' . $out_format;

        $options = [
            'width' => $width,
            'height' => $height,
            'left_margin' => $left_margin,
            'right_margin' => $right_margin,
            'top_margin' => $top_margin,
            'bottom_margin' => $bottom_margin
        ];

        //Request to server Api
        $result = self::$api_html->convertLocalToLocal($src, $dst, $options);

        $this->assertTrue($result->getCode() == 200,"Error code after conversion from html format");
        $this->assertTrue($result->getStatus() == 'completed',"Error status after conversion from html format");
        $this->assertTrue(file_exists($result->getFile()),"File not exists after conversion from html format");
    }

    /**
     * Test case for conversion a local file to a storage file for html format
     *
     * Convert the HTML document from the local disk by its name to the specified format.
     * @param string     $out_format Resulting format. (required)
     * @param float|null $width Resulting width. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $height Resulting height. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $left_margin Left resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $right_margin Right resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $top_margin Top resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $bottom_margin Bottom resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     *
     * @dataProvider providerConversion
     *
     */
    public function testConvertLocalToStorageHtml(
        string $out_format,
        float $width = null,
        float $height = null,
        float $left_margin = null,
        float $right_margin = null,
        float $top_margin = null,
        float $bottom_margin = null
    ) {
        $src = self::$testFolder . "test1.html";
        $dst = $width . 'X'. $height . 'X'
            . $left_margin . 'X'. $right_margin . 'X'
            . $top_margin . 'X'. $bottom_margin . '.' . $out_format;

        $options = [
            'width' => $width,
            'height' => $height,
            'left_margin' => $left_margin,
            'right_margin' => $right_margin,
            'top_margin' => $top_margin,
            'bottom_margin' => $bottom_margin
        ];

        //Request to server Api
        $result = self::$api_html->convertLocalToStorage($src, $dst, null, $options);

        $this->assertTrue($result->getCode() == 200,"Error code after conversion from html format");
        $this->assertTrue($result->getStatus() == 'completed',"Error status after conversion from html format");
        $res = self::$api_stor->objectExists($result->getFile());
        $this->assertTrue($res->getExists(),"File not exists after conversion from html format");
        $this->assertFalse($res->getIsFolder(),"File not exists after conversion from html format");
    }

    /**
     * Test case for conversion the file from storage to the local file for html format
     *
     * Convert the HTML document from the storage by its name to the specified format.
     * @param string     $out_format Resulting format. (required)
     * @param float|null $width Resulting width. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $height Resulting height. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $left_margin Left resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $right_margin Right resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $top_margin Top resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $bottom_margin Bottom resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     *
     * @dataProvider providerConversion
     *
     */
    public function testConvertStorageToLocalHtml(
        string $out_format,
        float $width = null,
        float $height = null,
        float $left_margin = null,
        float $right_margin = null,
        float $top_margin = null,
        float $bottom_margin = null
    ) {
        $name = "test1.html";
        $file = new SplFileObject(self::$testFolder . $name);
        $folder = self::$api_html->config['remoteFolder'];
        $storage_name = null;
        $src = $folder . "/" . $name;

        $response = self::$api_stor->uploadFile($folder, $file, $storage_name);
        $this->assertTrue(count($response->getUploaded()) == 1);
        $this->assertTrue(count($response->getErrors()) == 0);

        $dst = self::$testResult
            . $width . 'X'. $height . 'X'
            . $left_margin . 'X'. $right_margin . 'X'
            . $top_margin . 'X'. $bottom_margin . '.' . $out_format;

        $options = [
            'width' => $width,
            'height' => $height,
            'left_margin' => $left_margin,
            'right_margin' => $right_margin,
            'top_margin' => $top_margin,
            'bottom_margin' => $bottom_margin
        ];

        //Request to server Api
        $result = self::$api_html->convertStorageToLocal($src, $dst, null, $options);

        $this->assertTrue($result->getCode() == 200,"Error code after conversion from html format");
        $this->assertTrue($result->getStatus() == 'completed',"Error status after conversion from html format");
        $this->assertTrue(file_exists($result->getFile()),"File not exists after conversion from html format");
    }

    /**
     * Test case for conversion the file from storage to the storage for html format
     *
     * Convert the HTML document from the storage by its name to the specified format.
     * @param string     $out_format Resulting format. (required)
     * @param float|null $width Resulting width. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $height Resulting height. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $left_margin Left resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $right_margin Right resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $top_margin Top resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $bottom_margin Bottom resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     *
     * @dataProvider providerConversion
     *
     */
    public function testConvertStorageToStorageHtml(
        string $out_format,
        float $width = null,
        float $height = null,
        float $left_margin = null,
        float $right_margin = null,
        float $top_margin = null,
        float $bottom_margin = null
    ) {
        $name = "test1.html";
        $file = new SplFileObject(self::$testFolder . $name);
        $folder = self::$api_html->config['remoteFolder'];
        $storage_name = null;
        $src = $folder . "/" . $name;

        $response = self::$api_stor->uploadFile($folder, $file, $storage_name);
        $this->assertTrue(count($response->getUploaded()) == 1);
        $this->assertTrue(count($response->getErrors()) == 0);

        $dst = $folder . '/'
            . $width . 'X'. $height . 'X'
            . $left_margin . 'X'. $right_margin . 'X'
            . $top_margin . 'X'. $bottom_margin . '.' . $out_format;
        $options = [
            'width' => $width,
            'height' => $height,
            'left_margin' => $left_margin,
            'right_margin' => $right_margin,
            'top_margin' => $top_margin,
            'bottom_margin' => $bottom_margin
        ];

        //Request to server Api
        $result = self::$api_html->convertStorageToStorage($src, $dst, null, $options);

        $this->assertTrue($result->getCode() == 200,"Error code after conversion from html format");
        $this->assertTrue($result->getStatus() == 'completed',"Error status after conversion from html format");
        $res = self::$api_stor->objectExists($result->getFile());
        $this->assertTrue($res->getExists(),"File not exists after conversion from html format");
        $this->assertFalse($res->getIsFolder(),"File not exists after conversion from html format");
    }

    /**
     * Test case for conversion a website to a local file for html format
     *
     * Convert a website to the specified format.
     * @param string     $out_format Resulting format. (required)
     * @param float|null $width Resulting width. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $height Resulting height. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $left_margin Left resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $right_margin Right resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $top_margin Top resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $bottom_margin Bottom resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     *
     * @dataProvider providerConversion
     *
     */
    public function testConvertUrlToLocalHtmlToImage(
        string $out_format,
        float $width = null,
        float $height = null,
        float $left_margin = null,
        float $right_margin = null,
        float $top_margin = null,
        float $bottom_margin = null
    ) {
        $src = 'https://stallman.org/articles/anonymous-payments-thru-phones.html';
        $dst = self::$testResult
            . $width . 'X'. $height . 'X'
            . $left_margin . 'X'. $right_margin . 'X'
            . $top_margin . 'X'. $bottom_margin . 'testweb.' . $out_format;

        $options = [
            'width' => $width,
            'height' => $height,
            'left_margin' => $left_margin,
            'right_margin' => $right_margin,
            'top_margin' => $top_margin,
            'bottom_margin' => $bottom_margin
        ];

        //Request to server Api
        $result = self::$api_html->convertUrlToLocal($src, $dst, $options);

        $this->assertTrue($result->getCode() == 200,"Error code after conversion from html format");
        $this->assertTrue($result->getStatus() == 'completed',"Error status after conversion from html format");
        $this->assertTrue(file_exists($result->getFile()),"File not exists after conversion from html format");
    }

    /**
     * Test case for conversion a website to a storage file for html format
     *
     * Convert the website to the specified image format.
     * @param string     $out_format Resulting format. (required)
     * @param float|null $width Resulting width. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $height Resulting height. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $left_margin Left resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $right_margin Right resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $top_margin Top resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $bottom_margin Bottom resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     *
     * @dataProvider providerConversion
     *
     */
    public function testConvertUrlToStorageHtml(
        string $out_format,
        float $width = null,
        float $height = null,
        float $left_margin = null,
        float $right_margin = null,
        float $top_margin = null,
        float $bottom_margin = null
    ) {
        $src = 'https://stallman.org/articles/anonymous-payments-thru-phones.html';
        $dst = $width . 'X'. $height . 'X'
            . $left_margin . 'X'. $right_margin . 'X'
            . $top_margin . 'X'. $bottom_margin . 'URLTest.' . $out_format;
        $options = [
            'width' => $width,
            'height' => $height,
            'left_margin' => $left_margin,
            'right_margin' => $right_margin,
            'top_margin' => $top_margin,
            'bottom_margin' => $bottom_margin
        ];

        //Request to server Api
        $result = self::$api_html->convertUrlToStorage($src, $dst, null, $options);

        $this->assertTrue($result->getCode() == 200,"Error code after conversion from html format");
        $this->assertTrue($result->getStatus() == 'completed',"Error status after conversion from html format");
        $res = self::$api_stor->objectExists($result->getFile());
        $this->assertTrue($res->getExists(),"File not exists after conversion from html format");
        $this->assertFalse($res->getIsFolder(),"File not exists after conversion from html format");
    }

    /**
     * Test case for conversion a local file to a local file for epub format
     *
     * Convert the EPUB document from the local disk by its name to the specified format.
     * @param string     $out_format Resulting format. For PDF, XPS, DOC -in inches, for images in pixels. (required)
     * @param float|null $width Resulting width. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $height Resulting height. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $left_margin Left resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $right_margin Right resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $top_margin Top resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $bottom_margin Bottom resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     *
     * @dataProvider providerConversionEpub
     *
     */
    public function testConvertLocalToLocalEpub(
        string $out_format,
        float $width = null,
        float $height = null,
        float $left_margin = null,
        float $right_margin = null,
        float $top_margin = null,
        float $bottom_margin = null
    ) {
        $src = self::$testFolder . "georgia.epub";

        $dst = self::$testResult
            . $width . 'X'. $height . 'X'
            . $left_margin . 'X'. $right_margin . 'X'
            . $top_margin . 'X'. $bottom_margin . 'Epub.' . $out_format;

        $options = [
            'width' => $width,
            'height' => $height,
            'left_margin' => $left_margin,
            'right_margin' => $right_margin,
            'top_margin' => $top_margin,
            'bottom_margin' => $bottom_margin
        ];

        //Request to server Api
        $result = self::$api_html->convertLocalToLocal($src, $dst, $options);

        $this->assertTrue($result->getCode() == 200,"Error code after conversion from epub format");
        $this->assertTrue($result->getStatus() == 'completed',"Error status after conversion from epub format");
        $this->assertTrue(file_exists($result->getFile()),"File not exists after conversion from epub format");
    }

    /**
     * Test case for conversion a local file to a local file for Markdown format
     *
     * Convert the Markdown document from the local disk by its name to the specified format.
     * @param string     $out_format Resulting format. For PDF, XPS, DOC -in inches, for images in pixels. (required)
     * @param float|null $width Resulting width. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $height Resulting height. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $left_margin Left resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $right_margin Right resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $top_margin Top resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $bottom_margin Bottom resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     *
     * @dataProvider providerConversionMarkdown
     *
     */
    public function testConvertLocalToLocalMarkdown(
        string $out_format,
        float $width = null,
        float $height = null,
        float $left_margin = null,
        float $right_margin = null,
        float $top_margin = null,
        float $bottom_margin = null
    ) {
        $src = self::$testFolder . "README.md";

        $dst = self::$testResult
            . $width . 'X'. $height . 'X'
            . $left_margin . 'X'. $right_margin . 'X'
            . $top_margin . 'X'. $bottom_margin . 'MD.' . $out_format;

        $options = [
            'width' => $width,
            'height' => $height,
            'left_margin' => $left_margin,
            'right_margin' => $right_margin,
            'top_margin' => $top_margin,
            'bottom_margin' => $bottom_margin
        ];

        //Request to server Api
        $result = self::$api_html->convertLocalToLocal($src, $dst, $options);

        $this->assertTrue($result->getCode() == 200,"Error code after conversion from md format");
        $this->assertTrue($result->getStatus() == 'completed',"Error status after conversion md html format");
        $this->assertTrue(file_exists($result->getFile()),"File not exists after conversion from md format");
    }


    /**
     * Test case for conversion a local file to a local file for MHTML format
     *
     * Convert the MHTML document from the local disk by its name to the specified format.
     * @param string     $out_format Resulting format. For PDF, XPS, DOC -in inches, for images in pixels. (required)
     * @param float|null $width Resulting width. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $height Resulting height. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $left_margin Left resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $right_margin Right resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $top_margin Top resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     * @param float|null $bottom_margin Bottom resulting margin. For PDF, XPS, DOC -in inches, for images in pixels. (optional)
     *
     * @dataProvider providerConversionMHTML
     *
     */
    public function testConvertLocalToLocalMHTML(
        string $out_format,
        float $width = null,
        float $height = null,
        float $left_margin = null,
        float $right_margin = null,
        float $top_margin = null,
        float $bottom_margin = null
    ) {
        $src = self::$testFolder . "fileformatinfo.mht";

        $dst = self::$testResult
            . $width . 'X'. $height . 'X'
            . $left_margin . 'X'. $right_margin . 'X'
            . $top_margin . 'X'. $bottom_margin . 'MHTML.' . $out_format;

        $options = [
            'width' => $width,
            'height' => $height,
            'left_margin' => $left_margin,
            'right_margin' => $right_margin,
            'top_margin' => $top_margin,
            'bottom_margin' => $bottom_margin
        ];

        //Request to server Api
        $result = self::$api_html->convertLocalToLocal($src, $dst, $options);

        $this->assertTrue($result->getCode() == 200,"Error code after conversion from mhtml format");
        $this->assertTrue($result->getStatus() == 'completed',"Error status after conversion from mhtml format");
        $this->assertTrue(file_exists($result->getFile()),"File not exists after conversion from mhtml format");
    }

    /**
     * Test case for conversion a local file to a local file for SVG format
     *
     * Convert the SVG document from the local disk by its name to the specified format.
     * @param string      $out_format Resulting format. For PDF, XPS -  in inches, for images in pixels. (required)
     * @param float|null  $width Resulting width. For PDF, XPS - in inches, for images in pixels. (optional)
     * @param float|null  $height Resulting height. For PDF, XPS - in inches, for images in pixels. (optional)
     * @param float|null  $left_margin Left resulting margin. For PDF, XPS- in inches, for images in pixels. (optional)
     * @param float|null  $right_margin Right resulting margin. For PDF, XPS - in inches, for images in pixels. (optional)
     * @param float|null  $top_margin Top resulting margin. For PDF, XPS - in inches, for images in pixels. (optional)
     * @param float|null  $bottom_margin Bottom resulting margin. For PDF, XPS - in inches, for images in pixels. (optional)
     * @param string|null $background CSS background like '#FF0000'. (optional)
     *
     * @dataProvider providerConversionSVG
     *
     */
    public function testConvertLocalToLocalSVG(
        string $out_format,
        float $width = null,
        float $height = null,
        float $left_margin = null,
        float $right_margin = null,
        float $top_margin = null,
        float $bottom_margin = null,
        string $background = null
    ) {
        $src = self::$testFolder . "testpage1.svg";

        $dst = self::$testResult
            . $width . 'X'. $height . 'X'
            . $left_margin . 'X'. $right_margin . 'X'
            . $top_margin . 'X'. $bottom_margin . 'X_' . ltrim($background, '#') . '_SVG.' . $out_format;

        $options = [
            'width' => $width,
            'height' => $height,
            'left_margin' => $left_margin,
            'right_margin' => $right_margin,
            'top_margin' => $top_margin,
            'bottom_margin' => $bottom_margin,
            'background' => $background
        ];

        //Request to server Api
        $result = self::$api_html->convertLocalToLocal($src, $dst, $options);

        $this->assertTrue($result->getCode() == 200,"Error code after conversion from svg format");
        $this->assertTrue($result->getStatus() == 'completed',"Error status after conversion from svg format");
        $this->assertTrue(file_exists($result->getFile()),"File not exists after conversion from svg format");
    }

    public function testConvertLocalToLocalImgToSVG() {

        $formats = ['bmp', 'jpg', 'gif', 'png', 'tiff'];
        foreach ($formats as $f){
            $src = self::$testFolder . "car." . $f;
            $dst = self::$testResult. 'car_' . $f . '.svg';

            $result = self::$api_html->convertLocalToLocal($src, $dst);

            $this->assertTrue($result->getCode() == 200,"Error code after conversion from image to svg format");
            $this->assertTrue($result->getStatus() == 'completed',"Error status after conversion from image to svg format");
            $this->assertTrue(file_exists($result->getFile()),"File not exists after conversion from image to svg format");
        }
    }

    public function testConvertLocalToLocalImgToSVGWithOpts() {

        $formats = ['bmp', 'jpg', 'gif', 'png', 'tiff'];
        foreach ($formats as $f){
            $src = self::$testFolder . "car." . $f;
            $dst = self::$testResult. 'car_opts_' . $f . '.svg';

            $opts = [
                'error_threshold' => 30,
                'max_iterations' => 50,
                'colors_limit' => 3,
                'line_width' => 2.0,
            ];

            $result = self::$api_html->convertLocalToLocal($src, $dst, $opts);

            $this->assertTrue($result->getCode() == 200,"Error code after conversion from image to svg format");
            $this->assertTrue($result->getStatus() == 'completed',"Error status after conversion from image to svg format");
            $this->assertTrue(file_exists($result->getFile()),"File not exists after conversion from image to svg format");
        }
    }

    /**
     * Test case for conversion to image formats with a custom resolution (DPI).
     *
     * The `resolution` option is honored only for raster image outputs. This
     * test verifies the option is accepted by the server and the resulting
     * file is produced.
     */
    public function testConvertLocalToLocalHtmlWithResolution() {

        $src = self::$testFolder . "test1.html";

        $formats = ['png', 'jpeg', 'bmp', 'gif', 'tiff', 'webp'];
        foreach ($formats as $f) {
            $dst = self::$testResult . 'resolution_300.' . $f;

            $options = [
                'width'      => 800,
                'height'     => 1000,
                'resolution' => 300,
            ];

            $result = self::$api_html->convertLocalToLocal($src, $dst, $options);

            $this->assertTrue($result->getCode() == 200, "Error code after conversion with resolution to " . $f);
            $this->assertTrue($result->getStatus() == 'completed', "Error status after conversion with resolution to " . $f);
            $this->assertTrue(file_exists($result->getFile()), "File not exists after conversion with resolution to " . $f);
        }
    }

    /**
     * Test case for conversion to PDF with a full pdfMetadata payload.
     *
     * The `pdf_metadata` option populates the PDF /Info dictionary. Test
     * verifies the server accepts the extended request and the file is
     * produced.
     */
    public function testConvertLocalToLocalHtmlWithPdfMetadataFull() {

        $src = self::$testFolder . "test1.html";
        $dst = self::$testResult . 'pdf_metadata_full.pdf';

        $options = [
            'pdf_metadata' => [
                'title'             => 'Monthly Report',
                'author'            => 'Jane Doe',
                'subject'           => 'Q3 Results',
                'keywords'          => 'report, q3, pdf',
                'creator'           => 'My Application',
                'producer'          => 'My Company',
                'creation_date'     => '2024-01-15T10:30:00Z',
                'modification_date' => '2024-06-20T18:45:00Z',
            ],
        ];

        $result = self::$api_html->convertLocalToLocal($src, $dst, $options);

        $this->assertTrue($result->getCode() == 200, "Error code after conversion to pdf with metadata");
        $this->assertTrue($result->getStatus() == 'completed', "Error status after conversion to pdf with metadata");
        $this->assertTrue(file_exists($result->getFile()), "File not exists after conversion to pdf with metadata");
    }

    /**
     * Test case for conversion to PDF with a partial pdfMetadata payload.
     *
     * Only some metadata fields are supplied; unspecified fields must be
     * omitted from the outgoing request so the engine defaults apply.
     */
    public function testConvertLocalToLocalHtmlWithPdfMetadataPartial() {

        $src = self::$testFolder . "test1.html";
        $dst = self::$testResult . 'pdf_metadata_partial.pdf';

        $options = [
            'pdf_metadata' => [
                'title'  => 'My Document',
                'author' => 'John Doe',
            ],
        ];

        $result = self::$api_html->convertLocalToLocal($src, $dst, $options);

        $this->assertTrue($result->getCode() == 200, "Error code after conversion to pdf with partial metadata");
        $this->assertTrue($result->getStatus() == 'completed', "Error status after conversion to pdf with partial metadata");
        $this->assertTrue(file_exists($result->getFile()), "File not exists after conversion to pdf with partial metadata");
    }


    public function providerConversion(): array
    {
        return [
            ["pdf"],
            ["pdf", 8.5, 11.0],                        // letter
            ["pdf", 11.0,  17.0,  0.1, 0.1, 0.1, 0.1], // tabloid
            ["pdf", 11.7,  16.5, 0.1, 0.1, 0.1, 0.1],  // A3
            ["pdf", 8.3, 11.7,  0.1, 0.1, 0.1, 0.1],   // A4
            ["pdf", 5.8, 8.3, 0.2, 0.2, 0.2, 0.2],     // A5
            ["pdf", 9.8, 13.9, 0.5, 0.5, 0.5, 0.5],    // B4

            ["xps"],
            ["xps", 8.5, 11.0],                        // letter
            ["xps", 11.0,  17.0,  0.1, 0.1, 0.1, 0.1], // tabloid
            ["xps", 11.7,  16.5, 0.1, 0.1, 0.1, 0.1],  // A3
            ["xps", 8.3, 11.7,  0.1, 0.1, 0.1, 0.1],   // A4
            ["xps", 5.8, 8.3, 0.2, 0.2, 0.2, 0.2],     // A5
            ["xps", 9.8, 13.9, 0.5, 0.5, 0.5, 0.5],    // B4

            ["docx"],
            ["docx", 8.5, 11.0],                        // letter
            ["docx", 11.0,  17.0,  0.1, 0.1, 0.1, 0.1], // tabloid
            ["docx", 11.7,  16.5, 0.1, 0.1, 0.1, 0.1],  // A3
            ["docx", 8.3, 11.7,  0.1, 0.1, 0.1, 0.1],   // A4
            ["docx", 5.8, 8.3, 0.2, 0.2, 0.2, 0.2],     // A5
            ["docx", 9.8, 13.9, 0.5, 0.5, 0.5, 0.5],    // B4

            ["md"],

            ["jpeg"],
            ["jpeg", 500, 500],
            ["jpeg", 700,  700,  50, 100, 150, 200],
            ["jpeg", 800, 1000,  50,  50,  50,  50],
            ["jpeg", 800,  800, 200, 150, 100,  50],
            ["jpeg", 800, 1200, 100, 100, 100, 100],
            ["jpeg", 800, 1400, 150, 150, 150, 150],

            ["png"],
            ["png", 500, 500],
            ["png", 700, 700,   50, 100, 150, 200],
            ["png", 800, 800,  200, 150, 100,  50],
            ["png", 800, 1000,  50,  50,  50,  50],
            ["png", 800, 1200, 100, 100, 100, 100],
            ["png", 800, 1400, 150, 150, 150, 150],

            ["bmp"],
            ["bmp", 500, 500],
            ["bmp", 700, 700,  200, 150,  10,  50],
            ["bmp", 800, 800,   50, 100, 150, 200],
            ["bmp", 800, 1000,  50,  50,  50,  50],
            ["bmp", 800, 1200, 100, 100, 100, 100],
            ["bmp", 800, 1400, 300, 200, 100,   0],

            ["tiff"],
            ["tiff", 500, 500],
            ["tiff", 700, 700,  200, 150, 100,  50],
            ["tiff", 800, 800,   50, 100, 150, 200],
            ["tiff", 800, 1000,  50,  50,  50,  50],
            ["tiff", 800, 1200, 100, 100, 100, 100],
            ["tiff", 800, 1400, 150, 150, 150, 150],

            ["gif"],
            ["gif", 500, 500],
            ["gif", 700, 700,  200, 150, 100,  50],
            ["gif", 800, 800,   50, 100, 150, 200],
            ["gif", 800, 1000,  50,  50,  50,  50],
            ["gif", 800, 1200, 100, 100, 100, 100],
            ["gif", 800, 1400, 150, 150, 150, 150]
        ];
    }

    public function providerConversionEpub(): array
    {
        return [
            ["pdf"],
            ["pdf", 8.5, 11.0],                        // letter
            ["pdf", 11.0,  17.0,  0.1, 0.1, 0.1, 0.1], // tabloid
            ["pdf", 11.7,  16.5, 0.1, 0.1, 0.1, 0.1],  // A3
            ["pdf", 8.3, 11.7,  0.1, 0.1, 0.1, 0.1],   // A4
            ["pdf", 5.8, 8.3, 0.2, 0.2, 0.2, 0.2],     // A5
            ["pdf", 9.8, 13.9, 0.5, 0.5, 0.5, 0.5],    // B4

            ["xps"],
            ["xps", 8.5, 11.0],                        // letter
            ["xps", 11.0,  17.0,  0.1, 0.1, 0.1, 0.1], // tabloid
            ["xps", 11.7,  16.5, 0.1, 0.1, 0.1, 0.1],  // A3
            ["xps", 8.3, 11.7,  0.1, 0.1, 0.1, 0.1],   // A4
            ["xps", 5.8, 8.3, 0.2, 0.2, 0.2, 0.2],     // A5
            ["xps", 9.8, 13.9, 0.5, 0.5, 0.5, 0.5],    // B4

            ["docx"],
            ["docx", 8.5, 11.0],                        // letter
            ["docx", 11.0,  17.0,  0.1, 0.1, 0.1, 0.1], // tabloid
            ["docx", 11.7,  16.5, 0.1, 0.1, 0.1, 0.1],  // A3
            ["docx", 8.3, 11.7,  0.1, 0.1, 0.1, 0.1],   // A4
            ["docx", 5.8, 8.3, 0.2, 0.2, 0.2, 0.2],     // A5
            ["docx", 9.8, 13.9, 0.5, 0.5, 0.5, 0.5],    // B4

            ["jpeg"],
            ["jpeg", 500, 500],
            ["jpeg", 700,  700,  50, 100, 150, 200],
            ["jpeg", 800, 1000,  50,  50,  50,  50],
            ["jpeg", 800,  800, 200, 150, 100,  50],
            ["jpeg", 800, 1200, 100, 100, 100, 100],
            ["jpeg", 800, 1400, 150, 150, 150, 150],

            ["png"],
            ["png", 500, 500],
            ["png", 700, 700,   50, 100, 150, 200],
            ["png", 800, 800,  200, 150, 100,  50],
            ["png", 800, 1000,  50,  50,  50,  50],
            ["png", 800, 1200, 100, 100, 100, 100],
            ["png", 800, 1400, 150, 150, 150, 150],

            ["bmp"],
            ["bmp", 500, 500],
            ["bmp", 700, 700,  200, 150,  10,  50],
            ["bmp", 800, 800,   50, 100, 150, 200],
            ["bmp", 800, 1000,  50,  50,  50,  50],
            ["bmp", 800, 1200, 100, 100, 100, 100],
            ["bmp", 800, 1400, 300, 200, 100,   0],

            ["tiff"],
            ["tiff", 500, 500],
            ["tiff", 700, 700,  200, 150, 100,  50],
            ["tiff", 800, 800,   50, 100, 150, 200],
            ["tiff", 800, 1000,  50,  50,  50,  50],
            ["tiff", 800, 1200, 100, 100, 100, 100],
            ["tiff", 800, 1400, 150, 150, 150, 150],

            ["gif"],
            ["gif", 500, 500],
            ["gif", 700, 700,  200, 150, 100,  50],
            ["gif", 800, 800,   50, 100, 150, 200],
            ["gif", 800, 1000,  50,  50,  50,  50],
            ["gif", 800, 1200, 100, 100, 100, 100],
            ["gif", 800, 1400, 150, 150, 150, 150]
        ];
    }

    public function providerConversionMarkdown(): array
    {
        return [
            ["pdf"],
            ["pdf", 8.5, 11.0],                        // letter
            ["pdf", 11.0,  17.0,  0.1, 0.1, 0.1, 0.1], // tabloid
            ["pdf", 11.7,  16.5, 0.1, 0.1, 0.1, 0.1],  // A3
            ["pdf", 8.3, 11.7,  0.1, 0.1, 0.1, 0.1],   // A4
            ["pdf", 5.8, 8.3, 0.2, 0.2, 0.2, 0.2],     // A5
            ["pdf", 9.8, 13.9, 0.5, 0.5, 0.5, 0.5],    // B4

            ["xps"],
            ["xps", 8.5, 11.0],                        // letter
            ["xps", 11.0,  17.0,  0.1, 0.1, 0.1, 0.1], // tabloid
            ["xps", 11.7,  16.5, 0.1, 0.1, 0.1, 0.1],  // A3
            ["xps", 8.3, 11.7,  0.1, 0.1, 0.1, 0.1],   // A4
            ["xps", 5.8, 8.3, 0.2, 0.2, 0.2, 0.2],     // A5
            ["xps", 9.8, 13.9, 0.5, 0.5, 0.5, 0.5],    // B4

            ["docx"],
            ["docx", 8.5, 11.0],                        // letter
            ["docx", 11.0,  17.0,  0.1, 0.1, 0.1, 0.1], // tabloid
            ["docx", 11.7,  16.5, 0.1, 0.1, 0.1, 0.1],  // A3
            ["docx", 8.3, 11.7,  0.1, 0.1, 0.1, 0.1],   // A4
            ["docx", 5.8, 8.3, 0.2, 0.2, 0.2, 0.2],     // A5
            ["docx", 9.8, 13.9, 0.5, 0.5, 0.5, 0.5],    // B4

            ["html"],
            ["mhtml"],

            ["jpeg"],
            ["jpeg", 500, 500],
            ["jpeg", 700,  700,  50, 100, 150, 200],
            ["jpeg", 800, 1000,  50,  50,  50,  50],
            ["jpeg", 800,  800, 200, 150, 100,  50],
            ["jpeg", 800, 1200, 100, 100, 100, 100],
            ["jpeg", 800, 1400, 150, 150, 150, 150],

            ["png"],
            ["png", 500, 500],
            ["png", 700, 700,   50, 100, 150, 200],
            ["png", 800, 800,  200, 150, 100,  50],
            ["png", 800, 1000,  50,  50,  50,  50],
            ["png", 800, 1200, 100, 100, 100, 100],
            ["png", 800, 1400, 150, 150, 150, 150],

            ["bmp"],
            ["bmp", 500, 500],
            ["bmp", 700, 700,  200, 150,  10,  50],
            ["bmp", 800, 800,   50, 100, 150, 200],
            ["bmp", 800, 1000,  50,  50,  50,  50],
            ["bmp", 800, 1200, 100, 100, 100, 100],
            ["bmp", 800, 1400, 300, 200, 100,   0],

            ["tiff"],
            ["tiff", 500, 500],
            ["tiff", 700, 700,  200, 150, 100,  50],
            ["tiff", 800, 800,   50, 100, 150, 200],
            ["tiff", 800, 1000,  50,  50,  50,  50],
            ["tiff", 800, 1200, 100, 100, 100, 100],
            ["tiff", 800, 1400, 150, 150, 150, 150],

            ["gif"],
            ["gif", 500, 500],
            ["gif", 700, 700,  200, 150, 100,  50],
            ["gif", 800, 800,   50, 100, 150, 200],
            ["gif", 800, 1000,  50,  50,  50,  50],
            ["gif", 800, 1200, 100, 100, 100, 100],
            ["gif", 800, 1400, 150, 150, 150, 150]
        ];
    }

    public function providerConversionMHTML(): array
    {
        return [
            ["pdf"],
            ["pdf", 8.5, 11.0],                        // letter
            ["pdf", 11.0,  17.0,  0.1, 0.1, 0.1, 0.1], // tabloid
            ["pdf", 11.7,  16.5, 0.1, 0.1, 0.1, 0.1],  // A3
            ["pdf", 8.3, 11.7,  0.1, 0.1, 0.1, 0.1],   // A4
            ["pdf", 5.8, 8.3, 0.2, 0.2, 0.2, 0.2],     // A5
            ["pdf", 9.8, 13.9, 0.5, 0.5, 0.5, 0.5],    // B4

            ["xps"],
            ["xps", 8.5, 11.0],                        // letter
            ["xps", 11.0,  17.0,  0.1, 0.1, 0.1, 0.1], // tabloid
            ["xps", 11.7,  16.5, 0.1, 0.1, 0.1, 0.1],  // A3
            ["xps", 8.3, 11.7,  0.1, 0.1, 0.1, 0.1],   // A4
            ["xps", 5.8, 8.3, 0.2, 0.2, 0.2, 0.2],     // A5
            ["xps", 9.8, 13.9, 0.5, 0.5, 0.5, 0.5],    // B4

            ["docx"],
            ["docx", 8.5, 11.0],                        // letter
            ["docx", 11.0,  17.0,  0.1, 0.1, 0.1, 0.1], // tabloid
            ["docx", 11.7,  16.5, 0.1, 0.1, 0.1, 0.1],  // A3
            ["docx", 8.3, 11.7,  0.1, 0.1, 0.1, 0.1],   // A4
            ["docx", 5.8, 8.3, 0.2, 0.2, 0.2, 0.2],     // A5
            ["docx", 9.8, 13.9, 0.5, 0.5, 0.5, 0.5],    // B4

            ["jpeg"],
            ["jpeg", 500, 500],
            ["jpeg", 700,  700,  50, 100, 150, 200],
            ["jpeg", 800, 1000,  50,  50,  50,  50],
            ["jpeg", 800,  800, 200, 150, 100,  50],
            ["jpeg", 800, 1200, 100, 100, 100, 100],
            ["jpeg", 800, 1400, 150, 150, 150, 150],

            ["png"],
            ["png", 500, 500],
            ["png", 700, 700,   50, 100, 150, 200],
            ["png", 800, 800,  200, 150, 100,  50],
            ["png", 800, 1000,  50,  50,  50,  50],
            ["png", 800, 1200, 100, 100, 100, 100],
            ["png", 800, 1400, 150, 150, 150, 150],

            ["bmp"],
            ["bmp", 500, 500],
            ["bmp", 700, 700,  200, 150,  10,  50],
            ["bmp", 800, 800,   50, 100, 150, 200],
            ["bmp", 800, 1000,  50,  50,  50,  50],
            ["bmp", 800, 1200, 100, 100, 100, 100],
            ["bmp", 800, 1400, 300, 200, 100,   0],

            ["tiff"],
            ["tiff", 500, 500],
            ["tiff", 700, 700,  200, 150, 100,  50],
            ["tiff", 800, 800,   50, 100, 150, 200],
            ["tiff", 800, 1000,  50,  50,  50,  50],
            ["tiff", 800, 1200, 100, 100, 100, 100],
            ["tiff", 800, 1400, 150, 150, 150, 150],

            ["gif"],
            ["gif", 500, 500],
            ["gif", 700, 700,  200, 150, 100,  50],
            ["gif", 800, 800,   50, 100, 150, 200],
            ["gif", 800, 1000,  50,  50,  50,  50],
            ["gif", 800, 1200, 100, 100, 100, 100],
            ["gif", 800, 1400, 150, 150, 150, 150]
        ];
    }

    public function providerConversionSVG(): array
    {
        return [
//            ["pdf"],
//            ["pdf", 8.5,  11.0],                                // letter
            ["pdf", 11.0, 17.0, 0.1, 0.1, 0.1, 0.1, '#FF0000'], // tabloid
            ["pdf", 11.7, 16.5, 0.1, 0.1, 0.1, 0.1, '#00FF00'], // A3
            ["pdf", 8.3,  11.7, 0.1, 0.1, 0.1, 0.1, '#0000FF'], // A4
            ["pdf", 5.8,  8.3,  0.2, 0.2, 0.2, 0.2, '#00FFFF'], // A5
            ["pdf", 9.8,  13.9, 0.5, 0.5, 0.5, 0.5, '#FFFF00'], // B4

            ["xps"],
            ["xps", 8.5,  11.0],                                // letter
            ["xps", 11.0, 17.0, 0.1, 0.1, 0.1, 0.1, '#FF0000'], // tabloid
            ["xps", 11.7, 16.5, 0.1, 0.1, 0.1, 0.1, '#00FF00'], // A3
            ["xps", 8.3,  11.7, 0.1, 0.1, 0.1, 0.1, '#0000FF'], // A4
            ["xps", 5.8,  8.3,  0.2, 0.2, 0.2, 0.2, '#00FFFF'], // A5
            ["xps", 9.8,  13.9, 0.5, 0.5, 0.5, 0.5, '#FFFF00'], // B4

            ["jpeg"],
            ["jpeg", 500, 500],
            ["jpeg", 700,  700,  50, 100, 150, 200, '#FF0000'],
            ["jpeg", 800, 1000,  50,  50,  50,  50, '#00FF00'],
            ["jpeg", 800,  800, 200, 150, 100,  50, '#0000FF'],
            ["jpeg", 800, 1200, 100, 100, 100, 100, '#00FFFF'],
            ["jpeg", 800, 1400, 150, 150, 150, 150, '#FFFF00'],

            ["png"],
            ["png", 500, 500],
            ["png", 700, 700,   50, 100, 150, 200, '#FF0000'],
            ["png", 800, 800,  200, 150, 100,  50, '#00FF00'],
            ["png", 800, 1000,  50,  50,  50,  50, '#0000FF'],
            ["png", 800, 1200, 100, 100, 100, 100, '#00FFFF'],
            ["png", 800, 1400, 150, 150, 150, 150, '#FFFF00'],

            ["bmp"],
            ["bmp", 500, 500],
            ["bmp", 700, 700,  200, 150,  10,  50, '#FF0000'],
            ["bmp", 800, 800,   50, 100, 150, 200, '#00FF00'],
            ["bmp", 800, 1000,  50,  50,  50,  50, '#0000FF'],
            ["bmp", 800, 1200, 100, 100, 100, 100, '#00FFFF'],
            ["bmp", 800, 1400, 300, 200, 100,   0, '#FFFF00'],

            ["tiff"],
            ["tiff", 500, 500],
            ["tiff", 700, 700,  200, 150, 100,  50, '#FF0000'],
            ["tiff", 800, 800,   50, 100, 150, 200, '#00FF00'],
            ["tiff", 800, 1000,  50,  50,  50,  50, '#0000FF'],
            ["tiff", 800, 1200, 100, 100, 100, 100, '#00FFFF'],
            ["tiff", 800, 1400, 150, 150, 150, 150, '#FFFF00'],

            ["gif"],
            ["gif", 500, 500],
            ["gif", 700, 700,  200, 150, 100,  50, '#FF0000'],
            ["gif", 800, 800,   50, 100, 150, 200, '#00FF00'],
            ["gif", 800, 1000,  50,  50,  50,  50, '#0000FF'],
            ["gif", 800, 1200, 100, 100, 100, 100, '#00FFFF'],
            ["gif", 800, 1400, 150, 150, 150, 150, '#FFFF00']
        ];
    }
}
