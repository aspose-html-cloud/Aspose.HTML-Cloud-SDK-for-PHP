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

namespace Client\Invoker\Model;

use ArrayAccess;
use Client\Invoker\ObjectSerializer;
use DateTime;

/**
 * Model for StorageFile response
 *
 * @category Models
 * @package  html-sdk-php
 * @author   Alexander Makogon <alexander.makogon@aspose.com>
 * @license  https://opensource.org/licenses/mit-license.php  MIT License
 * @link     https://packagist.org/packages/aspose/html-sdk-php
 */
class StorageFile implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = 'Type';

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static string $swaggerModelName = 'StorageFile';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static array $swaggerTypes = [
        'name' => 'string',
        'is_folder' => 'bool',
        'modified_date' => '\DateTime',
        'size' => 'int',
        'path' => 'string'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static array $swaggerFormats = [
        'name' => null,
        'is_folder' => null,
        'modified_date' => 'date-time',
        'size' => 'int64',
        'path' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerTypes() : array
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerFormats() : array
    {
        return self::$swaggerFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static array $attributeMap = [
        'name' => 'name',
        'is_folder' => 'isFolder',
        'modified_date' => 'modifiedDate',
        'size' => 'size',
        'path' => 'path'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static array $setters = [
        'name' => 'setName',
        'is_folder' => 'setIsFolder',
        'modified_date' => 'setModifiedDate',
        'size' => 'setSize',
        'path' => 'setPath'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static array $getters = [
        'name' => 'getName',
        'is_folder' => 'getIsFolder',
        'modified_date' => 'getModifiedDate',
        'size' => 'getSize',
        'path' => 'getPath'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap() : array
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters() : array
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters() : array
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName() : string
    {
        return self::$swaggerModelName;
    }

    /**
     * Associative array for storing property values
     *
     * @var array
     */
    protected array $container = [];

    /**
     * Constructor
     *
     * @param array | null $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['name'] = $data['name'] ?? null;
        $this->container['is_folder']
            = $data['is_folder'] ?? null;
        $this->container['modified_date']
            = $data['modified_date'] ?? null;
        $this->container['size'] = $data['size'] ?? null;
        $this->container['path'] = $data['path'] ?? null;

        // Initialize discriminator property with the model name.
        $discriminator = array_search('Type', self::$attributeMap, true);
        $this->container[$discriminator] = static::$swaggerModelName;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties() : array
    {
        $invalidProperties = [];

        if ($this->container['is_folder'] === null) {
            $invalidProperties[] = "'is_folder' can't be null";
        }
        if ($this->container['size'] === null) {
            $invalidProperties[] = "'size' can't be null";
        }
        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid() : bool
    {
        return count($this->listInvalidProperties()) === 0;
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name File or folder name.
     *
     * @return $this
     */
    public function setName(string $name): StorageFile
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets is_folder
     *
     * @return bool
     */
    public function getIsFolder(): bool
    {
        return $this->container['is_folder'];
    }

    /**
     * Sets is_folder
     *
     * @param bool $is_folder True if it is a folder.
     *
     * @return $this
     */
    public function setIsFolder(bool $is_folder): StorageFile
    {
        $this->container['is_folder'] = $is_folder;

        return $this;
    }

    /**
     * Gets modified_date
     *
     * @return DateTime
     */
    public function getModifiedDate(): DateTime
    {
        return $this->container['modified_date'];
    }

    /**
     * Sets modified_date
     *
     * @param DateTime $modified_date File or folder last modified DateTime.
     *
     * @return $this
     */
    public function setModifiedDate(DateTime $modified_date): StorageFile
    {
        $this->container['modified_date'] = $modified_date;

        return $this;
    }

    /**
     * Gets size
     *
     * @return int
     */
    public function getSize(): int
    {
        return $this->container['size'];
    }

    /**
     * Sets size
     *
     * @param int $size File or folder size.
     *
     * @return $this
     */
    public function setSize(int $size): StorageFile
    {
        $this->container['size'] = $size;

        return $this;
    }

    /**
     * Gets path
     *
     * @return string
     */
    public function getPath(): string
    {
        return $this->container['path'];
    }

    /**
     * Sets path
     *
     * @param string $path File or folder path.
     *
     * @return $this
     */
    public function setPath(string $path): StorageFile
    {
        $this->container['path'] = $path;

        return $this;
    }

    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(
                ObjectSerializer::sanitizeForSerialization($this),
                JSON_PRETTY_PRINT
            );
        }

        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}
