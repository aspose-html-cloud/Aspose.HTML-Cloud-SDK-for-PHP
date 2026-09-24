<?php
/*
* --------------------------------------------------------------------------------------------------------------------
* <copyright company="Aspose" file="BaseTest.php">
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

abstract class BaseTest extends \PHPUnit\Framework\TestCase
{

    /**
     * Api object
     */
    protected static HtmlApi $api_html;

    /**
     * Storage Api
     */
    protected static StorageApi $api_stor;

    /**
     * Folder with test samples
     */
    protected static string $testFolder;

    /**
     * Folder for storage result
     */
    protected static string $testResult;

    /**
     * Read a credential from the environment.
     *
     * Credentials are never stored in the repository. Set ASPOSE_CLIENT_ID and
     * ASPOSE_CLIENT_SECRET (or the APP_SID / APP_KEY aliases) before running
     * the suite; the SDK test agent does this automatically.
     *
     * @param string[] $names Environment variables to try, in order.
     */
    protected static function credential(array $names) : string
    {
        foreach ($names as $name) {
            $value = getenv($name);
            if ($value !== false && $value !== "") {
                return $value;
            }
        }

        throw new \RuntimeException(
            "Missing Aspose Cloud credentials: set one of "
            . implode(" / ", $names) . " in the environment."
        );
    }

    /**
     * Setup before running any test cases
     */
    public static function setUpBeforeClass() : void
    {

 //Configuration - pass by constructor
        $configuration = array(
            "basePath" => "https://api.aspose.cloud/v4.0",
            "authPath" => "https://api.aspose.cloud/connect/token",
            "apiKey" => self::credential(["ASPOSE_CLIENT_SECRET", "APP_KEY"]),
            "appSID" => self::credential(["ASPOSE_CLIENT_ID", "APP_SID"]),
            // Local debugging against a service running on this machine:
            // "basePath" => "http://localhost:5000/v4.0",
            // "authPath" => "https://api-qa.aspose.cloud/connect/token",
            // "apiKey" => "html.cloud",
            // "appSID" => "html.cloud",

            "testResult" => "\\testresult\\",
            "testData" => "\\testdata\\",
            "remoteFolder" => "HtmlTestDocPhpSdk",
            "defaultUserAgent" => "Webkit",
            "debugFile" => "debug.txt",
            "debug" => false
        );

        self::$api_html = new HtmlApi($configuration);
        self::$api_stor = new StorageApi($configuration);
        self::$testFolder = realpath(__DIR__ . '/../..') . $configuration['testData'];
        self::$testResult = realpath(__DIR__ . '/../..') . $configuration['testResult'];

        // The result directory is not kept in the repository, so create it on
        // demand instead of letting every conversion test fail on a missing
        // path.
        if (!is_dir(self::$testResult)) {
            mkdir(self::$testResult, 0777, true);
        }
    }

    public function downloadHelper($path)
    {
        $storage_name = null;
        $version_id = null;

        $result = self::$api_stor->downloadFile($path, $storage_name, $version_id);

        $this->assertTrue($result->isFile(),"Error download file");
        $this->assertTrue($result->getSize() > 0,"Zero result");

        //Copy result to testFolder
        copy($result->getRealPath(), self::$testResult . "".basename($path));
    }

    public function uploadHelper($filename, $uploadFolder = null)
    {
        $file = new SplFileObject(self::$testFolder . $filename);
        $folder = $uploadFolder ?: self::$api_html->config['remoteFolder'];
        $storage_name = null;

        $response = self::$api_stor->uploadFile($folder, $file, $storage_name);
        $this->assertTrue(count($response->getUploaded()) == 1);
        $this->assertTrue(count($response->getErrors()) == 0);

        //Assert - file exist
        $version_id = null;

        $result = self::$api_stor->objectExists($response->setUploaded()[0], $storage_name, $version_id);
        $this->assertTrue($result->getExists());
        $this->assertFalse($result->getIsFolder());
   }
}