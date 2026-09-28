<?php
/*
* --------------------------------------------------------------------------------------------------------------------
* <copyright company="Aspose" file="StorageApiTest.php">
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

use Client\Invoker\ApiException;
use Client\Invoker\Model\FileVersions;
use Client\Invoker\Model\ObjectExist;
use SplFileObject;

/**
 * StorageApiTest Class Doc Comment
 *
 * @category Class
 * @package  Client\Invoker\Api
 */
class StorageApiTest extends BaseTest
{

    /**
     * Test case for objectExists
     *
     * @param  string $path File or folder path e.g. &#39;/file.ext&#39; or &#39;/folder&#39; (required)
     * @param  string $storage_name Storage name (optional)
     * @param  string $version_id File version ID (optional)
     *
     * @throws ApiException on non-2xx response
     * @throws InvalidArgumentException
     * @return ObjectExist
     */
    public function testObjectExists(): void
    {
        //Upload files to the storage
        $name = "test1.html";
        $storage_name = null;
        $version_id = null;

        $file = new SplFileObject(self::$testFolder . $name);
        $folder = self::$api_html->config['remoteFolder'];
        $response = self::$api_stor->uploadFile($folder, $file, $storage_name);
        $this->assertTrue(count($response->getUploaded()) == 1);
        $this->assertTrue(count($response->getErrors()) == 0);

        $result = self::$api_stor->objectExists($folder . "/" . $name, $storage_name, $version_id);
        $this->assertTrue($result->getExists());
        $this->assertFalse($result->getIsFolder());

        $path_not_exist_file = 'HtmlTestDoc/test_not_exist.html';

        $result = self::$api_stor->objectExists($path_not_exist_file, $storage_name, $version_id);
        $this->assertFalse($result->getExists());
        $this->assertFalse($result->getIsFolder());

        $path_exist_folder = $folder;

        $result = self::$api_stor->objectExists($path_exist_folder, $storage_name, $version_id);
        $this->assertTrue($result->getExists());
        $this->assertTrue($result->getIsFolder());

        $path_not_exist_folder = 'NotExistFolder';

        $result = self::$api_stor->objectExists($path_not_exist_folder, $storage_name, $version_id);
        $this->assertFalse($result->getExists());
        $this->assertFalse($result->getIsFolder());
    }
}
