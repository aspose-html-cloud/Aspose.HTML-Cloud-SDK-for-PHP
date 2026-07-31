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
use Client\Invoker\Model\DiscUsage;
use Client\Invoker\Model\FileVersions;
use Client\Invoker\Model\ObjectExist;
use Client\Invoker\Model\StorageExist;
use Client\Invoker\ObjectSerializer;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Query;
use function GuzzleHttp\json_encode;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use InvalidArgumentException;
use RuntimeException;
use stdClass;

require_once 'FileApi.php';
require_once 'FolderApi.php';

/**
 * Collecting all StorageApi
 *
 * @category StorageApi
 * @package  html-sdk-php
 * @author   Alexander Makogon <alexander.makogon@aspose.com>
 * @license  https://opensource.org/licenses/mit-license.php  MIT License
 * @link     https://packagist.org/packages/aspose/html-sdk-php
 */
class StorageApi
{
    use FileApi, FolderApi;

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
    }

    /**
     * Getter for Configuration
     *
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation getDiscUsage
     *
     * Get disc usage
     *
     * @param string|null $storage_name Storage name (optional)
     *
     * @return DiscUsage
     * @throws ApiException on non-2xx response
     * @throws GuzzleException
     * @throws InvalidArgumentException
     */
    public function getDiscUsage(string $storage_name = null): DiscUsage
    {
        list($response) = $this->getDiscUsageWithHttpInfo($storage_name);
        return $response;
    }

    /**
     * Operation getDiscUsageWithHttpInfo
     *
     * Get disc usage
     *
     * @param string|null $storage_name Storage name (optional)
     *
     * @return array of \Client\Invoker\Model\DiscUsage, HTTP status code,
     * HTTP response headers (array of strings)
     * @throws ApiException on non-2xx response
     * @throws GuzzleException
     * @throws InvalidArgumentException
     */
    public function getDiscUsageWithHttpInfo(string $storage_name = null): array
    {
        $returnType = '\Client\Invoker\Model\DiscUsage';
        $request = $this->getDiscUsageRequest($storage_name);

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
                    '\Client\Invoker\Model\DiscUsage',
                    $e->getResponseHeaders()
                );
                $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /**
     * Operation getDiscUsageAsync
     *
     * Get disc usage
     *
     * @param string|null $storage_name Storage name (optional)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function getDiscUsageAsync(string $storage_name = null): PromiseInterface
    {
        return $this->getDiscUsageAsyncWithHttpInfo($storage_name)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getDiscUsageAsyncWithHttpInfo
     *
     * Get disc usage
     *
     * @param string|null $storage_name Storage name (optional)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function getDiscUsageAsyncWithHttpInfo(string $storage_name = null): PromiseInterface
    {
        $returnType = '\Client\Invoker\Model\DiscUsage';
        $request = $this->getDiscUsageRequest($storage_name);

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
     * Create request for operation 'getDiscUsage'
     *
     * @param string|null $storage_name Storage name (optional)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getDiscUsageRequest(string $storage_name = null): Request
    {
        $resourcePath = '/html/storage/disc/usage';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

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
     * Operation getFileVersions
     *
     * Get file versions
     *
     * @param string $path         File path e.g. '/file.ext' (required)
     * @param string|null $storage_name Storage name (optional)
     *
     * @return FileVersions
     * @throws InvalidArgumentException
     * @throws GuzzleException
     * @throws ApiException on non-2xx response
     */
    public function getFileVersions(string $path, string $storage_name = null): FileVersions
    {
        list($response) = $this->getFileVersionsWithHttpInfo($path, $storage_name);
        return $response;
    }

    /**
     * Operation getFileVersionsWithHttpInfo
     *
     * Get file versions
     *
     * @param string $path         File path e.g. '/file.ext' (required)
     * @param string|null $storage_name Storage name (optional)
     *
     * @return array of \Client\Invoker\Model\FileVersions,
     * HTTP status code, HTTP response headers (array of strings)
     *@throws InvalidArgumentException
     * @throws GuzzleException
     * @throws ApiException on non-2xx response
     */
    public function getFileVersionsWithHttpInfo(string $path, string $storage_name = null): array
    {
        $returnType = '\Client\Invoker\Model\FileVersions';
        $request = $this->getFileVersionsRequest($path, $storage_name);

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
                    '\Client\Invoker\Model\FileVersions',
                    $e->getResponseHeaders()
                );
                $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /**
     * Operation getFileVersionsAsync
     *
     * Get file versions
     *
     * @param string $path         File path e.g. '/file.ext' (required)
     * @param string|null $storage_name Storage name (optional)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function getFileVersionsAsync(string $path, string $storage_name = null): PromiseInterface
    {
        return $this->getFileVersionsAsyncWithHttpInfo($path, $storage_name)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getFileVersionsAsyncWithHttpInfo
     *
     * Get file versions
     *
     * @param string $path         File path e.g. '/file.ext' (required)
     * @param string|null $storage_name Storage name (optional)
     *
     * @return PromiseInterface
     * @throws InvalidArgumentException
     */
    public function getFileVersionsAsyncWithHttpInfo(string $path, string $storage_name = null): PromiseInterface
    {
        $returnType = '\Client\Invoker\Model\FileVersions';
        $request = $this->getFileVersionsRequest($path, $storage_name);

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
     * Create request for operation 'getFileVersions'
     *
     * @param string $path         File path e.g. '/file.ext' (required)
     * @param string|null $storage_name Storage name (optional)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function getFileVersionsRequest(string $path, string $storage_name = null): Request
    {
        // verify the required parameter 'path' is set
        if (empty($path)) {
            throw new InvalidArgumentException(
                'Missing the required parameter '
                .'$path when calling getFileVersions'
            );
        }

        $resourcePath = '/html/storage/version';
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
                ['application/json']
            );
        } else {
            $headers = $this->_headerSelector->selectHeaders(
                ['application/json'],
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
     * Operation objectExists
     *
     * Check if file or folder exists
     *
     * @param string $path         File or folder path e.g. '/file.ext'
     *                             or '/folder' (required)
     * @param string|null $storage_name Storage name (optional)
     * @param string|null $version_id   File version ID (optional)
     *
     * @return ObjectExist
     *@throws InvalidArgumentException
     * @throws GuzzleException
     * @throws ApiException on non-2xx response
     */
    public function objectExists(string $path, string $storage_name = null, string $version_id = null): ObjectExist
    {
        list($response) = $this->objectExistsWithHttpInfo(
            $path, $storage_name, $version_id
        );
        return $response;
    }

    /**
     * Operation objectExistsWithHttpInfo
     *
     * Check if file or folder exists
     *
     * @param string $path         File or folder path e.g. '/file.ext'
     *                             or '/folder' (required)
     * @param string|null $storage_name Storage name (optional)
     * @param string|null $version_id   File version ID (optional)
     *
     * @return array of \Client\Invoker\Model\ObjectExist,
     * HTTP status code, HTTP response headers (array of strings)
     * @throws InvalidArgumentException
     * @throws GuzzleException
     * @throws ApiException on non-2xx response
     */
    public function objectExistsWithHttpInfo(
        string $path, string $storage_name = null, string $version_id = null
    ): array
    {
        $returnType = '\Client\Invoker\Model\ObjectExist';
        $request = $this->objectExistsRequest($path, $storage_name, $version_id);

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
                    '\Client\Invoker\Model\ObjectExist',
                    $e->getResponseHeaders()
                );
                $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /**
     * Operation objectExistsAsync
     *
     * Check if file or folder exists
     *
     * @param string $path         File or folder path e.g. '/file.ext'
     *                             or '/folder' (required)
     * @param string|null $storage_name Storage name (optional)
     * @param string|null $version_id   File version ID (optional)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function objectExistsAsync(
        string $path, string $storage_name = null, string $version_id = null
    ): PromiseInterface
    {
        return $this->objectExistsAsyncWithHttpInfo(
            $path, $storage_name, $version_id
        )->then(
            function ($response) {
                return $response[0];
            }
        );
    }

    /**
     * Operation objectExistsAsyncWithHttpInfo
     *
     * Check if file or folder exists
     *
     * @param string $path         File or folder path e.g. '/file.ext' or
     *                             '/folder' (required)
     * @param string|null $storage_name Storage name (optional)
     * @param string|null $version_id   File version ID (optional)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function objectExistsAsyncWithHttpInfo(
        string $path, string $storage_name = null, string $version_id = null
    ) {
        $returnType = '\Client\Invoker\Model\ObjectExist';
        $request = $this->objectExistsRequest($path, $storage_name, $version_id);

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
     * Create request for operation 'objectExists'
     *
     * @param string $path         File or folder path e.g. '/file.ext'
     *                             or '/folder' (required)
     * @param string|null $storage_name Storage name (optional)
     * @param string|null $version_id   File version ID (optional)
     *
     * @return Request
     *@throws InvalidArgumentException
     */
    protected function objectExistsRequest(
        string $path, string $storage_name = null, string $version_id = null
    ): Request
    {
        // verify the required parameter 'path' is set
        if (empty($path)) {
            throw new InvalidArgumentException(
                'Missing the required parameter '
                .'$path when calling objectExists'
            );
        }

        $resourcePath = '/html/storage/exist';
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
                ['application/json'],
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
     * Operation storageExists
     *
     * Check if storage exists
     *
     * @param string $storage_name Storage name (required)
     *
     * @return StorageExist
     * @throws InvalidArgumentException
     * @throws GuzzleException
     * @throws ApiException on non-2xx response
     */
    public function storageExists(string $storage_name): StorageExist
    {
        list($response) = $this->storageExistsWithHttpInfo($storage_name);
        return $response;
    }

    /**
     * Operation storageExistsWithHttpInfo
     *
     * Check if storage exists
     *
     * @param string $storage_name Storage name (required)
     *
     * @return array of \Client\Invoker\Model\StorageExist,
     * HTTP status code, HTTP response headers (array of strings)
     *@throws ApiException on non-2xx response
     * @throws GuzzleException
     * @throws InvalidArgumentException*@throws GuzzleException
     */
    public function storageExistsWithHttpInfo(string $storage_name): array
    {
        $returnType = '\Client\Invoker\Model\StorageExist';
        $request = $this->storageExistsRequest($storage_name);

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
                    '\Client\Invoker\Model\StorageExist',
                    $e->getResponseHeaders()
                );
                $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /**
     * Operation storageExistsAsync
     *
     * Check if storage exists
     *
     * @param string $storage_name Storage name (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function storageExistsAsync(string $storage_name): PromiseInterface
    {
        return $this->storageExistsAsyncWithHttpInfo($storage_name)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation storageExistsAsyncWithHttpInfo
     *
     * Check if storage exists
     *
     * @param string $storage_name Storage name (required)
     *
     * @return PromiseInterface
     *@throws InvalidArgumentException
     */
    public function storageExistsAsyncWithHttpInfo(string $storage_name): PromiseInterface
    {
        $returnType = '\Client\Invoker\Model\StorageExist';
        $request = $this->storageExistsRequest($storage_name);

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
     * Create request for operation 'storageExists'
     *
     * @param string $storage_name Storage name (required)
     *
     * @return Request
     * @throws InvalidArgumentException
     */
    protected function storageExistsRequest(string $storage_name): Request
    {
        // verify the required parameter 'storage_name' is set
        if (empty($storage_name)) {
            throw new InvalidArgumentException(
                'Missing the required parameter '
                .'$storage_name when calling storageExists'
            );
        }

        $resourcePath = '/html/storage/exist/storage';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $queryParams['storageName'] = ObjectSerializer::toQueryValue($storage_name);

        // body params
        $_tempBody = null;

        $headers = $this->_headerSelector->selectHeaders(
            ['application/json'],
            ['application/json']
        );

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
}
