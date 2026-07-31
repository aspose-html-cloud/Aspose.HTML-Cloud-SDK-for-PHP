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

require __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use kamermans\OAuth2\GrantType\ClientCredentials;
use kamermans\OAuth2\OAuth2Middleware;
/**
 * Class configuration HtmlApi.
 *
 * @category Configuration
 * @package  html-sdk-php
 * @author   Alexander Makogon <alexander.makogon@aspose.com>
 * @license  https://opensource.org/licenses/mit-license.php  MIT License
 * @link     https://packagist.org/packages/aspose/html-sdk-php
 */
class Configuration
{
    private static ?Client $_client = null;

    /**
     * Singleton - return client
     *
     * @return Client
     */
    public static function getClient(): ?Client
    {
        if (null === static::$_client) {
            //For feel static fields
            if (func_num_args()) {
                $cfg = func_get_args();
                new Configuration($cfg);
            } else {
                new Configuration();
            }
        }
        return static::$_client;
    }

    /**
     * Constructor
     */
    private function __construct()
    {
        date_default_timezone_set('UTC');

        // get configuration
        $cfg = func_get_arg(0)[0];

        // Authorization client - this is used to request OAuth access tokens
        $reauth_client = new Client(
            [
            // URL for access_token request
            'base_uri' => $cfg['authPath'],
            ]
        );

        $reauth_config = [
            "client_id" => $cfg['appSID'],
            "client_secret" => $cfg['apiKey']
        ];

        $grant_type = new ClientCredentials($reauth_client, $reauth_config);
        $oauth = new OAuth2Middleware($grant_type);
        $stack = HandlerStack::create();
        $stack->push($oauth);

        // This is the normal Guzzle client that you use in your application
        static::$_client = new Client(
            [
            'handler' => $stack,
            'auth'    => 'oauth',
            ]
        );
    }
}
