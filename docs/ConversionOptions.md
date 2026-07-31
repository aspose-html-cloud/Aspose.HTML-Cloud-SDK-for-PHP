## ConversionOptions

### PDFOptions
| Field             | Type  | Description                                                  | Note     |
|-------------------|-------|--------------------------------------------------------------|----------|
| **width**         | float | Width in inches                                              | Optional |
| **height**        | float | Height in inches                                             | Optional |
| **left_margin**   | float | Left margin in inches                                        | Optional |
| **right_margin**  | float | Right margin in inches                                       | Optional |
| **top_margin**    | float | Top margin in inches                                         | Optional |
| **bottom_margin** | float | Bottom margin in inches                                      | Optional |
| **jpeg_quality**  | int   | Quality in percent                                           | Optional |
| **background**    | str   | CSS background like '#FF0000'. For conversion from SVG only  | Optional |
| **pdf_metadata**  | array | PDF /Info dictionary metadata. See [PdfMetadata](#PdfMetadata) below. | Optional |

### ImageOptions

-  for JPEG, BMP, PNG, TIFF, GIF, WEBP formats

| Field             | Type | Description                                                 | Note     |
|-------------------|------|-------------------------------------------------------------|----------|
| **width**         | int  | Width in pixel                                              | Optional |
| **height**        | int  | Height in pixel                                             | Optional |
| **left_margin**   | int  | Left margin in pixel                                        | Optional |
| **right_margin**  | int  | Right margin in pixel                                       | Optional |
| **top_margin**    | int  | Top margin in pixel                                         | Optional |
| **bottom_margin** | int  | Bottom margin in pixel                                      | Optional |
| **background**    | str  | CSS background like '#FF0000'. For conversion from SVG only | Optional |
| **resolution**    | int  | Rendering DPI. Default is 96. Higher values produce larger pixel dimensions. | Optional |

### XPSOptions
| Field             | Type  | Description                                                  | Note     |
|-------------------|-------|--------------------------------------------------------------|----------|
| **width**         | float | Width in inches                                              | Optional |
| **height**        | float | Height in inches                                             | Optional |
| **left_margin**   | float | Left margin in inches                                        | Optional |
| **right_margin**  | float | Right margin in inches                                       | Optional |
| **top_margin**    | float | Top margin in inches                                         | Optional |
| **bottom_margin** | float | Bottom margin in inches                                      | Optional |
| **background**    | str   | CSS background like '#FF0000'. For conversion from SVG only  | Optional |

### DocOptions
| Field             | Type  | Description                                                  | Note     |
|-------------------|-------|--------------------------------------------------------------|----------|
| **width**         | float | Width in inches                                              | Optional |
| **height**        | float | Height in inches                                             | Optional |
| **left_margin**   | float | Left margin in inches                                        | Optional |
| **right_margin**  | float | Right margin in inches                                       | Optional |
| **top_margin**    | float | Top margin in inches                                         | Optional |
| **bottom_margin** | float | Bottom margin in inches                                      | Optional |

### SvgOptions
| Field               | Type  | Description                                                                                             | Note     |
|---------------------|-------|---------------------------------------------------------------------------------------------------------|----------|
| **error_threshold** | float | This parameter defines maximum deviation of points to fitted curve. By default it is 30.                | Optional |
| **max_iterations**  | int   | This parameter defines number of iteration for least-squares approximation method. By default it is 30. | Optional |
| **colors_limit**    | int   | The maximum number of colors used to quantize an image. Default value is 25.                            | Optional |
| **line_width**      | float | The value of this parameter is affected by the graphics scale. Default value is 1.                      | Optional |


### MarkdownOptions
| Field       | Type | Description                                   | Note     |
|-------------|------|-----------------------------------------------|----------|
| **use_git** | bool | Use git flavor. True or False. Default false. | Optional |


### PdfMetadata

Optional PDF /Info dictionary metadata. Only meaningful when the output format
is PDF; ignored for all other output formats. Any field left unset or `null`
is omitted from the request so the rendering engine default is preserved.

Provide as an associative array under the `pdf_metadata` option key:

```php
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
```

| Field                 | Type   | PDF /Info key   | Description                                        |
|-----------------------|--------|-----------------|----------------------------------------------------|
| **title**             | string | `/Title`        | Document title. Engine default: `"Aspose"`.        |
| **author**            | string | `/Author`       | Document author. Engine default: `"Aspose"`.       |
| **subject**           | string | `/Subject`      | Document subject. Engine default: `"Aspose"`.      |
| **keywords**          | string | `/Keywords`     | Document keywords. Engine default: empty string.   |
| **creator**           | string | `/Creator`      | Producing application. Engine default: `"Aspose"`. |
| **producer**          | string | `/Producer`     | Producing library. Engine default: Aspose.HTML.    |
| **creation_date**     | string | `/CreationDate` | ISO 8601 datetime. Engine default: current time.   |
| **modification_date** | string | `/ModDate`      | ISO 8601 datetime. Engine default: current time.   |
