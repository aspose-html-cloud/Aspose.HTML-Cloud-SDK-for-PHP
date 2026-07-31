<?php
/**
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
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
 * php version 7.4
 *
 * @category  Aspose_Html_Cloud_SDK
 * @package   html-sdk-php
 * @author    Alexander Makogon <alexander.makogon@aspose.com>
 * @copyright 2022 Aspose
 * @license   https://opensource.org/licenses/mit-license.php  MIT License
 * @version   GIT: @26.7.1@
 * @link      https://packagist.org/packages/aspose/html-sdk-php
 */

namespace Client\Invoker\Api;

use Client\Invoker\ApiException;
use Client\Invoker\Configuration;
use Client\Invoker\HeaderSelector;
use Client\Invoker\Model\OperationResult;
use Client\Invoker\ObjectSerializer;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use RuntimeException;
use SplFileObject;


/**
 * Collecting all HtmlApi
 *
 * @category HtmlApi
 * @package  html-sdk-php
 * @author   Alexander Makogon <alexander.makogon@aspose.com>
 * @license  https://opensource.org/licenses/mit-license.php  MIT License
 * @link     https://packagist.org/packages/aspose/html-sdk-php
 */
class HtmlApi
{
    /**
     * Http client
     *
     * @var ClientInterface
     */
    public $client;

    /**
     * Configuration endpoint and security
     *
     * @var Configuration
     */
    public $config;

    /**
     * Selector custom headers
     *
     * @var HeaderSelector
     */
    private HeaderSelector $_headerSelector;

    /**
     * For manipulation with storage
     *
     * @var StorageApi
     */
    protected static StorageApi $api_stor;

    /**
     * Create HtmlApi
     *
     * @param array $params   Configuration Api
     * @param HeaderSelector | null $selector Headers
     */
    public function __construct(array $params, HeaderSelector $selector = null)
    {
        $this->client = Configuration::getClient($params);
        $this->config = $params;
        $this->_headerSelector = $selector ?: new HeaderSelector();
        self::$api_stor = new StorageApi($params, $selector);
    }

    /**
     * Create http client option
     *
     * @throws RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption(): array
    {
        $options = [];
        if ($this->config['debug']) {
            $options[RequestOptions::DEBUG]
                = fopen($this->config['debugFile'], 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new RuntimeException(
                    'Failed to open the debug file: '
                    . $this->config['debugFile']
                );
            }
        }

        return $options;
    }

    /**
     * General function for conversion
     *
     * Convert the HTML, EPUB or website to the specified format.
     *
     * @param string    $src           Path to a source file or url. (required)
     * @param string    $dest          Path to the result. (required)
     * @param bool      $srcInLocal    Source file located on the local disk. (required)
     * @param bool      $dstInLocal    Result file located on the local disk. (required)
     * @param bool      $isUrl         Source is URL. (required)
     * @param ?array    $options       Options for conversion. (optional)
     * @param ?string   $storage_name  User's storage name. (optional)
     *
     * @return ?OperationResult
     * @throws ApiException on non-2xx response
     */
    public function convert(string $src, string $dest, bool $srcInLocal, bool $dstInLocal, bool $isUrl, ?array $options=null, ?string $storage_name=null) : OperationResult {

        if($srcInLocal){
            $file = new SplFileObject($src);
            $res = self::$api_stor->uploadFile("/", $file);
            if(count($res->getUploaded()) != 1 || count($res->getErrors()) != 0) {
                throw new ApiException("Unable to upload file");
            }
            $fileInStorage = $res->getUploaded()[0];
        } else {
            $fileInStorage = $src;
        }

        $outFile = $dstInLocal ? basename($dest) : $dest;
        $inputFormat = $isUrl ? "html" : $this->getInputFormat($src);
        $outputFormat = strtolower(pathinfo($dest)['extension']);

        if($outputFormat == "jpg") {
            $outputFormat = "jpeg";
        } else if($outputFormat == "mht") {
            $outputFormat = "mhtml";
        } else if ($outputFormat == "tif") {
            $outputFormat = "tiff";
        }

        $resourcePath = "/html/conversion/{from}-{to}";

        // path params
        $resourcePath = str_replace(
            '{from}',
            ObjectSerializer::toPathValue($inputFormat),
            $resourcePath
        );

        // path params
        $resourcePath = str_replace(
            '{to}',
            ObjectSerializer::toPathValue($outputFormat),
            $resourcePath
        );


        $defaultHeaders = [];
        if ($this->config['defaultUserAgent']) {
            $defaultHeaders['User-Agent'] = $this->config['defaultUserAgent'];
        }

        $headers = $this->_headerSelector->selectHeaders(
            ['application/json'],
            ['application/json']
        );

        $headers = array_merge(
            $defaultHeaders,
            $headers
        );

        $httpBody = ["InputPath" => $fileInStorage, "OutputFile" => $outFile];

        if($storage_name != null) $httpBody["StorageName"] = $storage_name;

        $opt = [];
        if($options) {
            // Map page size
            if (array_key_exists('width',$options) && $options['width'])
                $opt['width'] = $options['width'];
            if (array_key_exists('height',$options) && $options['height'])
                $opt['height'] = $options['height'];
            if (array_key_exists('top_margin',$options) && $options['top_margin'])
                $opt['topmargin'] = $options['top_margin'];
            if (array_key_exists('bottom_margin',$options) && $options['bottom_margin'])
                $opt['bottommargin'] = $options['bottom_margin'];
            if (array_key_exists('left_margin',$options) && $options['left_margin'])
                $opt['leftmargin'] = $options['left_margin'];
            if (array_key_exists('right_margin',$options) && $options['right_margin'])
                $opt['rightmargin'] = $options['right_margin'];
            // Map background
            if (array_key_exists('background',$options) && $options['background'])
                $opt['background'] = $options['background'];

            //Map jpeg quality for PDF format
            if (array_key_exists('jpeg_quality',$options) && $options['jpeg_quality'])
                $opt['jpegquality'] = $options['jpeg_quality'];

            //Map useGit flavor for Markdown
            if (array_key_exists('use_git',$options) && $options['use_git'])
                $opt['usegit'] = $options['use_git'];

            // Map trace parameters
            if (array_key_exists('error_threshold',$options) && $options['error_threshold'])
                $opt['error_threshold'] = $options['error_threshold'];
            if (array_key_exists('max_iterations',$options) && $options['max_iterations'])
                $opt['max_iterations'] = $options['max_iterations'];
            if (array_key_exists('colors_limit',$options) && $options['colors_limit'])
                $opt['colors_limit'] = $options['colors_limit'];
            if (array_key_exists('line_width',$options) && $options['line_width'])
                $opt['line_width'] = $options['line_width'];

            // Map resolution (DPI) for image outputs (PNG, JPEG, BMP, GIF, TIFF, WEBP).
            // Ignored by the server for non-image output formats. Default on the
            // server side is 96 when not provided.
            if (array_key_exists('resolution',$options) && $options['resolution'])
                $opt['resolution'] = $options['resolution'];
        }

        if(count($opt))
            $httpBody["Options"] = $opt;

        // Map pdfMetadata as a top-level property (sibling of Options).
        // Only meaningful when the output format is PDF; server ignores it
        // for other target formats. Any field left null / not provided is
        // omitted so the rendering engine defaults are preserved.
        if($options) {
            $pdfMetadata = $this->buildPdfMetadata($options);
            if($pdfMetadata !== null)
                $httpBody["PdfMetadata"] = $pdfMetadata;
        }

        $httpBody = json_encode($httpBody);

        $request = new Request(
            'POST',
            $this->config['basePath'] . $resourcePath,
            $headers,
            $httpBody
        );

        $result = $this->executeRequest($request);

        $id = $result->getId();


        while(true) {
            $res = $this->checkStatus($id);
            $status = $res->getStatus();
            if($status == 'faulted' || $status == 'canceled') throw new ApiException('Conversion failed');
            if($status == 'completed') break;
            sleep(3);
        }

        if($dstInLocal) {
            $result = self::$api_stor->downloadFile($res->getFile(), $storage_name);
            $resultFile = dirname($dest) . "/". basename($res->getFile());
            copy($result->getRealPath(), $resultFile);
            $res->setFile($resultFile);
        }

        return $res;
    }

    /**
     * Convert HTML or EPUB document on the local disk to the specific format and save result on the local disk.
     *
     * @param string    $src           Path to a source file or url. (required)
     * @param string    $dst           Path to the result file. (required)
     * @param ?array    $options       Options for conversion. (optional)
     *
     * @return ?OperationResult
     * @throws ApiException on non-2xx response
     */
    public function convertLocalToLocal(string $src, string $dst, array $options = null) : ?OperationResult {
        return $this->convert($src, $dst, true, true, false, $options);
    }

    /**
     * Convert HTML or EPUB document on the local disk to the specific format and save result on the storage.
     *
     * @param string    $src           Path to a source file or url. (required)
     * @param string    $dst           Path to the result file. (required)
     * @param ?string   $storage       User's storage name. (optional)
     * @param ?array    $options       Options for conversion. (optional)
     *
     * @return ?OperationResult
     * @throws ApiException on non-2xx response
     */
    public function convertLocalToStorage(string $src, string $dst, ?string $storage, ?array $options = null) : ?OperationResult {
        return $this->convert($src, $dst, true, false, false, $options, $storage);
    }

    /**
     * Convert HTML or EPUB document on the storage to the specific format and save result on the local disk.
     *
     * @param string    $src           Path to a source file or url. (required)
     * @param string    $dst           Path to the result file. (required)
     * @param ?string   $storage       User's storage name. (optional)
     * @param ?array    $options       Options for conversion. (optional)
     *
     * @return ?OperationResult
     * @throws ApiException on non-2xx response
     */
    public function convertStorageToLocal(string $src, string $dst, ?string $storage, ?array $options = null) : ?OperationResult {
        return $this->convert($src, $dst, false, true, false, $options, $storage);
    }

    /**
     * Convert HTML or EPUB document on the storage to the specific format and save result on the storage.
     *
     * @param string    $src           Path to a source file or url. (required)
     * @param string    $dst           Path to the result file. (required)
     * @param ?string   $storage       User's storage name. (optional)
     * @param ?array    $options       Options for conversion. (optional)
     *
     * @return ?OperationResult
     * @throws ApiException on non-2xx response
     */
    public function convertStorageToStorage(string $src, string $dst, ?string $storage, ?array $options = null) : ?OperationResult {
        return $this->convert($src, $dst, false, false, false, $options, $storage);
    }

    /**
     * Convert the website to the specific format and save result on the local disk.
     *
     * @param string    $src           Path to a source file or url. (required)
     * @param string    $dst           Path to the result file. (required)
     * @param ?array    $options       Options for conversion. (optional)
     *
     * @return ?OperationResult
     * @throws ApiException on non-2xx response
     */
    public function convertUrlToLocal(string $src, string $dst, ?array $options = null) : ?OperationResult {
        return $this->convert($src, $dst, false, true, true, $options);
    }

    /**
     * Convert the website to the specific format and save result on the storage.
     *
     * @param string    $src           Path to a source file or url. (required)
     * @param string    $dst           Path to the result file. (required)
     * @param ?string   $storage       User's storage name. (optional)
     * @param ?array    $options       Options for conversion. (optional)
     *
     * @return ?OperationResult
     * @throws ApiException on non-2xx response
     */
    public function convertUrlToStorage(string $src, string $dst, ?string $storage, ?array $options = null) : ?OperationResult {
        return $this->convert($src, $dst, false, false, true, $options, $storage);
    }

    /**
     * Vectorize an image on the local disk to the SVG format and save result on the local disk.
     *
     * @param string    $src           Path to a source file. (required)
     * @param string    $dst           Path to the result file. (required)
     * @param ?array    $options       Options for vectorization. (optional)
     *
     * @return ?OperationResult
     * @throws ApiException on non-2xx response
     */
    public function vectorizeLocalToLocal(string $src, string $dst, array $options = null) : ?OperationResult {
        return $this->vectorize($src, $dst, true, true, $options);
    }

    /**
     * Vectorize an image on the local disk to the SVG format and save result on the storage.
     *
     * @param string    $src           Path to a source file. (required)
     * @param string    $dst           Path to the result file. (required)
     * @param ?string   $storage       User's storage name. (optional)
     * @param ?array    $options       Options for vectorization. (optional)
     *
     * @return ?OperationResult
     * @throws ApiException on non-2xx response
     */
    public function vectorizeLocalToStorage(string $src, string $dst, ?string $storage, ?array $options = null) : ?OperationResult {
        return $this->vectorize($src, $dst, true, false, $options, $storage);
    }

    /**
     * Vectorize an image on the storage to the SVG format and save result on the local disk.
     *
     * @param string    $src           Path to a source file. (required)
     * @param string    $dst           Path to the result file. (required)
     * @param ?string   $storage       User's storage name. (optional)
     * @param ?array    $options       Options for vectorization. (optional)
     *
     * @return ?OperationResult
     * @throws ApiException on non-2xx response
     */
    public function vectorizeStorageToLocal(string $src, string $dst, ?string $storage, ?array $options = null) : ?OperationResult {
        return $this->vectorize($src, $dst, false, true, $options, $storage);
    }

    /**
     * Vectorize an image on the storage to the specific format and save result on the storage.
     *
     * @param string    $src           Path to a source file. (required)
     * @param string    $dst           Path to the result file. (required)
     * @param ?string   $storage       User's storage name. (optional)
     * @param ?array    $options       Options for vectorization. (optional)
     *
     * @return ?OperationResult
     * @throws ApiException on non-2xx response
     */
    public function vectorizeStorageToStorage(string $src, string $dst, ?string $storage, ?array $options = null) : ?OperationResult {
        return $this->vectorize($src, $dst, false, false, $options, $storage);
    }

    /**
     * General function for vectorization
     *
     * Vectorize an image to the SVG format.
     *
     * @param string    $src           Path to a source file. (required)
     * @param string    $dest          Path to the result. (required)
     * @param bool      $srcInLocal    Source file located on the local disk. (required)
     * @param bool      $dstInLocal    Result file located on the local disk. (required)
     * @param ?array    $options       Options for vectorization. (optional)
     * @param ?string   $storage_name  User's storage name. (optional)
     *
     * @return ?OperationResult
     * @throws ApiException Format is not support
     */
    public function vectorize(string $src, string $dest, bool $srcInLocal, bool $dstInLocal, ?array $options=null, ?string $storage_name=null) :?OperationResult {

        $inputFormat = $this->getInputFormat($src);
        $outputFormat = strtolower(pathinfo($dest)['extension']);

        if (!in_array($inputFormat, array("bmp", "png", "gif", "tiff", "jpeg"))) {
            throw new RuntimeException("Input format must be an image.");
        }

        if ($outputFormat != "svg") {
            throw new RuntimeException("Output format must be SVG.");
        }

        return $this->convert($src, $dest, $srcInLocal, $dstInLocal, false, $options, $storage_name);
    }


    /**
     * Build the pdfMetadata request payload from the user options array.
     *
     * Accepts either snake_case (creation_date / modification_date) or
     * camelCase (creationDate / modificationDate) keys. All fields are
     * optional; any that are null or missing are omitted from the produced
     * payload so the rendering engine defaults are preserved.
     *
     * The metadata may be provided in two ways:
     *  - $options['pdf_metadata']  (preferred, an associative array)
     *  - individual top-level keys on $options (e.g. 'title', 'author', ...)
     *
     * @param array $options User-supplied options array.
     *
     * @return array|null    The pdfMetadata payload, or null if nothing was set.
     */
    private function buildPdfMetadata(array $options) : ?array {

        // Pick a nested pdf_metadata / pdfMetadata array first, otherwise fall
        // back to top-level keys on $options for convenience.
        if (array_key_exists('pdf_metadata', $options) && is_array($options['pdf_metadata']))
            $source = $options['pdf_metadata'];
        elseif (array_key_exists('pdfMetadata', $options) && is_array($options['pdfMetadata']))
            $source = $options['pdfMetadata'];
        else
            $source = $options;

        // Map of accepted input keys -> outbound JSON key.
        $fieldMap = [
            'title'              => 'title',
            'author'             => 'author',
            'subject'            => 'subject',
            'keywords'           => 'keywords',
            'creator'            => 'creator',
            'producer'           => 'producer',
            'creation_date'      => 'creationDate',
            'creationDate'       => 'creationDate',
            'modification_date'  => 'modificationDate',
            'modificationDate'   => 'modificationDate',
        ];

        $payload = [];
        foreach ($fieldMap as $inKey => $outKey) {
            if (array_key_exists($inKey, $source) && $source[$inKey] !== null && $source[$inKey] !== '') {
                // Do not overwrite an already populated outKey via an alias.
                if (!array_key_exists($outKey, $payload)) {
                    $payload[$outKey] = $source[$inKey];
                }
            }
        }

        return count($payload) ? $payload : null;
    }

    private function getInputFormat(string $src) : string {

        $ext = strtolower(pathinfo($src)['extension']);
        switch($ext) {
            case "htm":
                return "html";
            case "mht":
                return "mhtml";
            case "xml":
                return "xhtml";
            case "jpg":
                return "jpeg";
            case "tif":
                return "tiff";
            default:
                return $ext;
        }
    }

    private function executeRequest($request) : OperationResult {

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                    );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            $content = $responseBody->getContents();
            $content = json_decode($content);
            return ObjectSerializer::deserialize($content, '\Client\Invoker\Model\OperationResult', []);

        } catch (ApiException $e) {
            if ($e->getCode() == 200) {
                $data = ObjectSerializer::deserialize(
                    $e->getResponseBody(),
                    'OperationResult',
                    $e->getResponseHeaders()
                );
                $e->setResponseObject($data);
            }
            throw $e;
        }

    }

    private function checkStatus(string $id) : OperationResult {

        $resourcePath = "/html/conversion/" . $id;

        $defaultHeaders = [];
        if ($this->config['defaultUserAgent']) {
            $defaultHeaders['User-Agent'] = $this->config['defaultUserAgent'];
        }

        $headers = $this->_headerSelector->selectHeaders(
            ['application/json'],
            ['application/json']
        );

        $headers = array_merge(
            $defaultHeaders,
            $headers
        );

        $request = new Request(
            'GET',
            $this->config['basePath'] . $resourcePath,
            $headers
        );

        return $this->executeRequest($request);
    }

}
