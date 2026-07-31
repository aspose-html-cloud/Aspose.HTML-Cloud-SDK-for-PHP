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
use Client\Invoker\Model\FilesUploadResult;
use Client\Invoker\ObjectSerializer;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Query;
use GuzzleHttp\Psr7\Utils;
use function GuzzleHttp\json_encode;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use InvalidArgumentException;
use SplFileObject;
use stdClass;

/**
 * Operations with files on the storage
 *
 * @category FileApi
 * @package  html-sdk-php
 * @author   Alexander Makogon <alexander.makogon@aspose.com>
 * @license  https://opensource.org/licenses/mit-license.php  MIT License
 * @link     https://packagist.org/packages/aspose/html-sdk-php
 */
trait FileApi
{
    /**
     * Operation deleteFile
     *
     * Delete file
     *
     * @param string $path         File path e.g.
     *                             '/folder/file.ext' (required)
     * @param string|null $storage_name Storage name (optional)
     * @param string|null $version_id   File version ID to delete (optional)
     *
     * @return void
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function deleteFile(string $path, string $storage_name = null, string $version_id = null)
    {
        $this->deleteFileWithHttpInfo($path, $storage_name, $version_id);
    }

    /**
     * Operation deleteFileWithHttpInfo
     *
     * Delete file
     *
     * @param string $path         File path e.g. '/folder/file.ext' (required)
     * @param string|null $storage_name Storage name (optional)
     * @param string|null $version_id   File version ID to delete (optional)
     *
     * @return array of null, HTTP status code,
     * HTTP response headers (array of strings)
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function deleteFileWithHttpInfo(
        string $path,
        string $storage_name = null,
        string $version_id = null
    ): array
    {
        $returnType = '';
        $request = $this->deleteFileRequest($path, $storage_name, $version_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse()
                        ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse()
                        ? $e->getResponse()->getBody()->getContents() : null
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

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            throw $e;
        }
    }

    /**
     * Operation deleteFileAsync
     *
     * Delete file
     *
     * @param string $path         File path e.g. '/folder/file.ext' (required)
     * @param string|null $storage_name Storage name (optional)
     * @param string|null $version_id   File version ID to delete (optional)
     *
     * @return PromiseInterface
     * @throws InvalidArgumentException
     */
    public function deleteFileAsync(
        string $path,
        string $storage_name = null,
        string $version_id = null
    ) : PromiseInterface
    {
        return $this->deleteFileAsyncWithHttpInfo($path, $storage_name, $version_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteFileAsyncWithHttpInfo
     *
     * Delete file
     *
     * @param string $path         File path e.g. '/folder/file.ext' (required)
     * @param string|null $storage_name Storage name (optional)
     * @param string|null $version_id   File version ID to delete (optional)
     *
     * @return PromiseInterface
     * @throws InvalidArgumentException
     */
    public function deleteFileAsyncWithHttpInfo(
        string $path,
        string $storage_name = null,
        string $version_id = null
    ):  PromiseInterface
    {
        $returnType = '';
        $request = $this->deleteFileRequest($path, $storage_name, $version_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [
                        null,
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'deleteFile'
     *
     * @param string $path         File path e.g. '/folder/file.ext' (required)
     * @param string|null $storage_name Storage name (optional)
     * @param string|null $version_id   File version ID to delete (optional)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function deleteFileRequest(
        string $path,
        string $storage_name = null,
        string $version_id = null
    ) : Request
    {
        // verify the required parameter 'path' is set
        if (empty($path)) {
            throw new InvalidArgumentException(
                'Missing the required parameter '
                .'$path when calling deleteFile'
            );
        }

        $resourcePath = '/html/file';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        $queryParams['path'] = ObjectSerializer::toQueryValue($path);

        if ($storage_name !== null) {
            $queryParams['storageName']
                = ObjectSerializer::toQueryValue($storage_name);
        }
        if ($version_id !== null) {
            $queryParams['versionId']
                = ObjectSerializer::toQueryValue($version_id);
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->_headerSelector->selectHeadersForMultipart(
                ['multipart/form-data']
            );
        } else {
            $headers = $this->_headerSelector->selectHeaders(
                ['multipart/form-data'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if (($httpBody instanceof stdClass)
                && $headers['Content-Type'] === 'application/json'
            ) {
                $httpBody = json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = Query::build($formParams);
            }
        }

        $defaultHeaders = [];
        if ($this->config['defaultUserAgent']) {
            $defaultHeaders['User-Agent'] = $this->config['defaultUserAgent'];
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'DELETE',
            $this->config['basePath'] . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation downloadFile
     *
     * Download file
     *
     * @param string $path         File path e.g. '/folder/file.ext' (required)
     * @param string|null $storage_name Storage name (optional)
     * @param string|null $version_id   File version ID to download (optional)
     *
     * @return SplFileObject
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function downloadFile(string $path, string $storage_name = null, string $version_id = null) : SplFileObject
    {
        list($response) = $this->downloadFileWithHttpInfo(
            $path, $storage_name, $version_id
        );
        return $response;
    }

    /**
     * Operation downloadFileWithHttpInfo
     *
     * Download file
     *
     * @param string $path         File path e.g. '/folder/file.ext' (required)
     * @param string|null $storage_name Storage name (optional)
     * @param string|null $version_id   File version ID to download (optional)
     *
     * @return array of \SplFileObject, HTTP status code,
     * HTTP response headers (array of strings)
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function downloadFileWithHttpInfo(
        string $path,
        string $storage_name = null,
        string $version_id = null
    ) : array
    {
        $returnType = '\SplFileObject';
        $request = $this->downloadFileRequest($path, $storage_name, $version_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse()
                        ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse()
                        ? $e->getResponse()->getBody()->getContents() : null
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
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                $data = ObjectSerializer::deserialize(
                    $e->getResponseBody(),
                    '\SplFileObject',
                    $e->getResponseHeaders()
                );
                $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /**
     * Operation downloadFileAsync
     *
     * Download file
     *
     * @param string $path         File path e.g. '/folder/file.ext' (required)
     * @param string|null $storage_name Storage name (optional)
     * @param string|null $version_id   File version ID to download (optional)
     *
     * @return PromiseInterface
     * @throws InvalidArgumentException
     */
    public function downloadFileAsync(
        string $path,
        string $storage_name = null,
        string $version_id = null
    ) : PromiseInterface
    {
        return $this->downloadFileAsyncWithHttpInfo(
            $path, $storage_name, $version_id
        )->then(
            function ($response) {
                return $response[0];
            }
        );
    }

    /**
     * Operation downloadFileAsyncWithHttpInfo
     *
     * Download file
     *
     * @param string $path         File path e.g. '/folder/file.ext' (required)
     * @param string|null $storage_name Storage name (optional)
     * @param string|null $version_id   File version ID to download (optional)
     *
     * @return PromiseInterface
     * @throws InvalidArgumentException
     */
    public function downloadFileAsyncWithHttpInfo(
        string $path,
        string $storage_name = null,
        string $version_id = null
    ) : PromiseInterface
    {
        $returnType = '\SplFileObject';
        $request = $this->downloadFileRequest($path, $storage_name, $version_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'downloadFile'
     *
     * @param string $path         File path e.g. '/folder/file.ext' (required)
     * @param string|null $storage_name Storage name (optional)
     * @param string|null $version_id   File version ID to download (optional)
     *
     * @return Request
     * @throws InvalidArgumentException
     */
    protected function downloadFileRequest(
        string $path,
        string $storage_name = null,
        string $version_id = null
    ) : Request
    {
        // verify the required parameter 'path' is set
        if (empty($path)) {
            throw new InvalidArgumentException(
                'Missing the required parameter '
                .'$path when calling downloadFile'
            );
        }

        $resourcePath = '/html/file';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        $queryParams['path'] = ObjectSerializer::toQueryValue($path);
        // query params
        if ($storage_name !== null) {
            $queryParams['storageName']
                = ObjectSerializer::toQueryValue($storage_name);
        }
        // query params
        if ($version_id !== null) {
            $queryParams['versionId']
                = ObjectSerializer::toQueryValue($version_id);
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->_headerSelector->selectHeadersForMultipart(
                ['multipart/form-data']
            );
        } else {
            $headers = $this->_headerSelector->selectHeaders(
                ['multipart/form-data'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if (($httpBody instanceof stdClass)
                && $headers['Content-Type'] === 'application/json'
            ) {
                $httpBody = json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = Query::build($formParams);
            }
        }

        $defaultHeaders = [];
        if ($this->config['defaultUserAgent']) {
            $defaultHeaders['User-Agent'] = $this->config['defaultUserAgent'];
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'GET',
            $this->config['basePath'] . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation uploadFile
     *
     * Upload file
     *
     * @param string        $folder       Path where to upload excluding filename e.g. / or /Folder1 (required)
     * @param SplFileObject $file         File to upload (required)
     * @param string | null $storage_name Storage name (optional)
     *
     * @throws ApiException on non-2xx response
     * @throws InvalidArgumentException
     * @return FilesUploadResult
     */
    public function uploadFile(string $folder, SplFileObject $file, string $storage_name = null) : FilesUploadResult
    {
        list($response) = $this->uploadFileWithHttpInfo($folder, $file, $storage_name);
        return $response;
    }

    /**
     * Operation uploadFileWithHttpInfo
     *
     * Upload file
     *
     * @param string $path       Path where to upload excluding filename e.g. / or /Folder1 (required)
     * @param SplFileObject $file         File to upload (required)
     * @param string|null $storage_name Storage name (optional)
     *
     * @return array of \Client\Invoker\Model\FilesUploadResult,
     * HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function uploadFileWithHttpInfo(
        string $path,
        SplFileObject $file,
        string $storage_name = null
    ) : array
    {
        $returnType = '\Client\Invoker\Model\FilesUploadResult';
        $request = $this->uploadFileRequest($path, $file, $storage_name);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse()
                        ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse()
                        ? $e->getResponse()->getBody()->getContents() : null
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
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                $data = ObjectSerializer::deserialize(
                    $e->getResponseBody(),
                    '\Client\Invoker\Model\FilesUploadResult',
                    $e->getResponseHeaders()
                );
                $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /**
     * Operation uploadFileAsync
     *
     * Upload file
     *
     * @param string $path         Path where to upload including filename
     *                                    and extension e.g. /file.ext or
     *                                    /Folder 1/file.ext If the content is
     *                                    multipart and path does not contains
     *                                    the file name it tries to get them from
     *                                    filename parameter from Content-Disposition
     *                                    header. (required)
     * @param SplFileObject $file         File to upload (required)
     * @param string|null $storage_name Storage name (optional)
     *
     * @return PromiseInterface
     * @throws InvalidArgumentException
     */
    public function uploadFileAsync(
        string $path,
        SplFileObject $file,
        string $storage_name = null
    ) : PromiseInterface
    {
        return $this->uploadFileAsyncWithHttpInfo($path, $file, $storage_name)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation uploadFileAsyncWithHttpInfo
     *
     * Upload file
     *
     * @param string $path         Path where to upload including filename
     *                                    and extension e.g. /file.ext or
     *                                    /Folder 1/file.ext If the content is
     *                                    multipart and path does not contains
     *                                    the file name it tries to get them from
     *                                    filename parameter from Content-Disposition
     *                                    header. (required)
     * @param SplFileObject $file         File to upload (required)
     * @param string|null $storage_name Storage name (optional)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function uploadFileAsyncWithHttpInfo(
        string $path,
        SplFileObject $file,
        string $storage_name = null
    ) : PromiseInterface
    {
        $returnType = '\Client\Invoker\Model\FilesUploadResult';
        $request = $this->uploadFileRequest($path, $file, $storage_name);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'uploadFile'
     *
     * @param string $path         Path where to upload including filename
     *                                    and extension e.g. /file.ext or
     *                                    /Folder 1/file.ext If the content is
     *                                    multipart and path does not contains
     *                                    the file name it tries to get them from
     *                                    filename parameter from Content-Disposition
     *                                    header. (required)
     * @param SplFileObject $file         File to upload (required)
     * @param string|null $storage_name Storage name (optional)
     *
     * @return Request
     * @throws InvalidArgumentException
     */
    protected function uploadFileRequest(string $path, SplFileObject $file, string $storage_name = null) : Request
    {
        // verify the required parameter 'path' is set
        if (empty($path)) {
            throw new InvalidArgumentException(
                'Missing the required parameter '
                .'$path when calling uploadFile'
            );
        }
        // verify the required parameter 'file' is set
        if (empty($file)) {
            throw new InvalidArgumentException(
                'Missing the required parameter '
                .'$file when calling uploadFile'
            );
        }

        $resourcePath = '/html/file';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = true;

        $formParams['File'] = Utils::tryFopen(ObjectSerializer::toFormValue($file), 'rb');

        $queryParams['path'] = ObjectSerializer::toQueryValue($path);

        // query params
        if ($storage_name !== null) {
            $queryParams['storageName']
                = ObjectSerializer::toQueryValue($storage_name);
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->_headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->_headerSelector->selectHeaders(
                ['application/json'],
                ['multipart/form-data']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if (($httpBody instanceof stdClass)
                && $headers['Content-Type'] === 'application/json'
            ) {
                $httpBody = json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = Query::build($formParams);
            }
        }

        $defaultHeaders = [];
        if ($this->config['defaultUserAgent']) {
            $defaultHeaders['User-Agent'] = $this->config['defaultUserAgent'];
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'POST',
            $this->config['basePath'] . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }
}
