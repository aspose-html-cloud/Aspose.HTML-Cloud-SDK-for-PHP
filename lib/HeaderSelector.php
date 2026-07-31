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

namespace Client\Invoker;

/**
 * Header selector class.
 *
 * @category HeaderSelector
 * @package  html-sdk-php
 * @author   Alexander Makogon <alexander.makogon@aspose.com>
 * @license  https://opensource.org/licenses/mit-license.php  MIT License
 * @link     https://packagist.org/packages/aspose/html-sdk-php
 */
class HeaderSelector
{

    /**
     * Select headers
     *
     * @param string[] $accept       Accept header
     * @param string[] $contentTypes Content
     *
     * @return array
     */
    public function selectHeaders(array $accept, array $contentTypes): array
    {
        // Identity headers for SDK
        $headers = [];
        $headers['x-aspose-client'] = "aspose.html-cloud php sdk";
        $headers['x-aspose-client-version'] = "22.9.1";

        $accept = $this->_selectAcceptHeader($accept);
        if ($accept !== null) {
            $headers['Accept'] = $accept;
        }

        $headers['Content-Type'] = $this->_selectContentTypeHeader($contentTypes);
        return $headers;
    }

    /**
     * Header for multipart
     *
     * @param string[] $accept Accept headers
     *
     * @return array
     */
    public function selectHeadersForMultipart(array $accept): array
    {
        $headers = $this->selectHeaders($accept, []);

        unset($headers['Content-Type']);
        return $headers;
    }

    /**
     * Return the header 'Accept' based on an array of Accept provided
     *
     * @param string[] $accept Array of header
     *
     * @return string Accept (e.g. application/json)
     */
    private function _selectAcceptHeader(array $accept): ?string
    {
        if (count($accept) === 0 || (count($accept) === 1 && $accept[0] === '')) {
            return null;
        } elseif (preg_grep("/application\/json/i", $accept)) {
            return 'application/json';
        } else {
            return implode(',', $accept);
        }
    }

    /**
     * Return the content type based on an array of content-type provided
     *
     * @param string[] $contentType Array fo content-type
     *
     * @return string Content-Type (e.g. application/json)
     */
    private function _selectContentTypeHeader(array $contentType): string
    {
        if ((count($contentType) === 0)
            || (count($contentType) === 1 && $contentType[0] === '')
        ) {
            return 'application/json';
        } elseif (preg_grep("/application\/json/i", $contentType)) {
            return 'application/json';
        } else {
            return implode(',', $contentType);
        }
    }
}
