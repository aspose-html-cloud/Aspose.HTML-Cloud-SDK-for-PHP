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
use Client\Invoker\Model\FilesList;
use Client\Invoker\ObjectSerializer;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Query;
use function GuzzleHttp\json_encode;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use InvalidArgumentException;
use stdClass;

/**
 * Operations with folders on the storage
 *
 * @category FolderApi
 * @package  html-sdk-php
 * @author   Alexander Makogon <alexander.makogon@aspose.com>
 * @license  https://opensource.org/licenses/mit-license.php  MIT License
 * @link     https://packagist.org/packages/aspose/html-sdk-php
 */
trait FolderApi
{
    /**
     * Operation createFolder
     *
     * Create the folder
     *
     * @param string $path         Folder path to create e.g.
     *                             'folder_1/folder_2/' (required)
     * @param string|null $storage_name Storage name (optional)
     *
     * @return void
     * @throws InvalidArgumentException
     * @throws ApiException|GuzzleException on non-2xx response
     */
    public function createFolder(string $path, string $storage_name = null)
    {
        $this->createFolderWithHttpInfo($path, $storage_name);
    }

    /**
     * Operation createFolderWithHttpInfo
     *
     * Create the folder
     *
     * @param string $path         Folder path to create e.g.
     *                             'folder_1/folder_2/' (required)
     * @param string|null $storage_name Storage name (optional)
     *
     * @return array of null, HTTP status code,
     * HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException| GuzzleException on non-2xx response
     */
    public function createFolderWithHttpInfo(string $path, string $storage_name = null): array
    {
        $returnType = '';
        $request = $this->createFolderRequest($path, $storage_name);

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
     * Operation createFolderAsync
     *
     * Create the folder
     *
     * @param string $path         Folder path to create e.g.
     *                             'folder_1/folder_2/' (required)
     * @param string|null $storage_name Storage name (optional)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function createFolderAsync(string $path, string $storage_name = null): PromiseInterface
    {
        return $this->createFolderAsyncWithHttpInfo($path, $storage_name)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createFolderAsyncWithHttpInfo
     *
     * Create the folder
     *
     * @param string $path         Folder path to create e.g.
     *                             'folder_1/folder_2/' (required)
     * @param string|null $storage_name Storage name (optional)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function createFolderAsyncWithHttpInfo(string $path, string $storage_name = null): PromiseInterface
    {
        $returnType = '';
        $request = $this->createFolderRequest($path, $storage_name);

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
     * Create request for operation 'createFolder'
     *
     * @param string $path         Folder path to create e.g.
     *                             'folder_1/folder_2/' (required)
     * @param string|null $storage_name Storage name (optional)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function createFolderRequest(string $path, string $storage_name = null): Request
    {
        // verify the required parameter 'path' is set
        if (empty($path)) {
            throw new InvalidArgumentException(
                'Missing the required parameter '
                .'$path when calling createFolder'
            );
        }

        $resourcePath = '/html/folder';
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
            'POST',
            $this->config['basePath'] . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation deleteFolder
     *
     * Delete folder
     *
     * @param string $path         Folder path e.g. '/folder' (required)
     * @param string|null $storage_name Storage name (optional)
     * @param string $recursive    Enable to delete folders, subfolders
     *                             and files (optional, default to 'false')
     *
     * @return void
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function deleteFolder(string $path, string $storage_name = null, $recursive = false)
    {
        $this->deleteFolderWithHttpInfo($path, $storage_name, $recursive);
    }

    /**
     * Operation deleteFolderWithHttpInfo
     *
     * Delete folder
     *
     * @param string $path         Folder path e.g. '/folder' (required)
     * @param string|null $storage_name Storage name (optional)
     * @param string $recursive    Enable to delete folders, subfolders
     *                             and files (optional, default to 'false')
     *
     * @return array of null, HTTP status code,
     * HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function deleteFolderWithHttpInfo(string $path, string $storage_name = null, $recursive = false): array
    {
        $returnType = '';
        $request = $this->deleteFolderRequest($path, $storage_name, $recursive);

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
     * Operation deleteFolderAsync
     *
     * Delete folder
     *
     * @param string $path         Folder path e.g. '/folder' (required)
     * @param string|null $storage_name Storage name (optional)
     * @param string $recursive    Enable to delete folders, subfolders
     *                             and files (optional, default to 'false')
     *
     * @return PromiseInterface
     */
    public function deleteFolderAsync(string $path, string $storage_name = null, $recursive = false): PromiseInterface
    {
        return $this->deleteFolderAsyncWithHttpInfo($path, $storage_name, $recursive)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteFolderAsyncWithHttpInfo
     *
     * Delete folder
     *
     * @param string $path         Folder path e.g. '/folder' (required)
     * @param string|null $storage_name Storage name (optional)
     * @param string $recursive    Enable to delete folders, subfolders
     *                             and files (optional, default to 'false')
     *
     * @return PromiseInterface
     */
    public function deleteFolderAsyncWithHttpInfo(string $path, string $storage_name = null, $recursive = false): PromiseInterface
    {
        $returnType = '';
        $request = $this->deleteFolderRequest($path, $storage_name, $recursive);

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
     * Create request for operation 'deleteFolder'
     *
     * @param string $path         Folder path e.g. '/folder' (required)
     * @param string|null $storage_name Storage name (optional)
     * @param string $recursive    Enable to delete folders, subfolders
     *                             and files (optional, default to 'false')
     *
     * @return Request
     */
    protected function deleteFolderRequest(string $path, string $storage_name = null, $recursive = false): Request
    {
        // verify the required parameter 'path' is set
        if ($path === null || (is_array($path) && count($path) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter '
                .'$path when calling deleteFolder'
            );
        }

        $resourcePath = '/html/folder';
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
        if ($recursive) {
            $queryParams['recursive'] = 'true';
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
     * Operation getFilesList
     *
     * Get all files and folders within a folder
     *
     * @param string $path         Folder path e.g. '/folder' (required)
     * @param string|null $storage_name Storage name (optional)
     *
     * @return FilesList
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getFilesList(string $path, string $storage_name = null): FilesList
    {
        list($response) = $this->getFilesListWithHttpInfo($path, $storage_name);
        return $response;
    }

    /**
     * Operation getFilesListWithHttpInfo
     *
     * Get all files and folders within a folder
     *
     * @param string $path         Folder path e.g. '/folder' (required)
     * @param string|null $storage_name Storage name (optional)
     *
     * @return array of \Client\Invoker\Model\FilesList,
     * HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws ApiException on non-2xx response
     */
    public function getFilesListWithHttpInfo(string $path, string $storage_name = null): array
    {
        $returnType = '\Client\Invoker\Model\FilesList';
        $request = $this->getFilesListRequest($path, $storage_name);

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
                    '\Client\Invoker\Model\FilesList',
                    $e->getResponseHeaders()
                );
                $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /**
     * Operation getFilesListAsync
     *
     * Get all files and folders within a folder
     *
     * @param string $path         Folder path e.g. '/folder' (required)
     * @param string|null $storage_name Storage name (optional)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function getFilesListAsync(string $path, string $storage_name = null)
    {
        return $this->getFilesListAsyncWithHttpInfo($path, $storage_name)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getFilesListAsyncWithHttpInfo
     *
     * Get all files and folders within a folder
     *
     * @param string $path         Folder path e.g. '/folder' (required)
     * @param string|null $storage_name Storage name (optional)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function getFilesListAsyncWithHttpInfo(string $path, string $storage_name = null): PromiseInterface
    {
        $returnType = '\Client\Invoker\Model\FilesList';
        $request = $this->getFilesListRequest($path, $storage_name);

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
     * Create request for operation 'getFilesList'
     *
     * @param string $path         Folder path e.g. '/folder' (required)
     * @param string|null $storage_name Storage name (optional)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getFilesListRequest(string $path, string $storage_name = null): Request
    {
        // verify the required parameter 'path' is set
        if (empty($path)) {
            throw new InvalidArgumentException(
                'Missing the required parameter '
                .'$path when calling getFilesList'
            );
        }

        $resourcePath = '/html/folder';
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
}
