# sanatorium/inputs

Extended input types

## Documentation

### Available input types

#### Category

Pick category from tree (to be deprecated >> see Relation).

#### Country

Pick country from list.

#### Date

Date formatted input.

#### Email

E-mail formatted input.

#### File

Pick single file from media library.
*child type to Media*

#### Gallery

Pick multiple images from media library.
*child type to Media*

#### Image

Pick single image from media library.
*child type to Media*

#### Media

Pick multiple files from media library, also a parent for File, Gallery, Image, Video.

#### Phone

Phone formatted input.

#### Relation

Relation to another entity.

To register new extension, use:

    try
    {
        // Register new relation
        $this->app['sanatorium.inputs.relations']->registerRelation(
            'qualification', 'Sleighdogs\Qualifications\Models\Qualification'
        );
        //
    } catch (\ReflectionException $e)
    {
        // sanatorium/inputs is not installed or does not support relations
    }

*Note: Code above has to be booted after sanatorium/inputs for that to work properly, therefore remember to register any extension using this code as dependent on sanatorium/inputs (see block require in extension.php of your extension)*

#### Repeater

Multiple input values

#### Scale

1-100 (to be extended) slider scale input.

#### Switchery

One or multiple (allowOptions) checkboxes with "switchery look".

#### Tags

Multiselect which allows user's with permissions to add new values.

#### Truefalse

Single true/false value.

### URL

URL link input.

#### Video

Pick single video from media library.
*child type to Media*

#### WYSIWYG

WYSIWYG editor input field.

### Create custom type

1. Create new class in Sanatorium\Inputs\Types namespace, that might look like this

        <?php

        namespace Sanatorium\Inputs\Types;

        class ScaleType extends BaseType
        {
        
            public $settings = [
        
                'min' => [
                    'name'      => 'sanatorium/inputs::types.settings.min',
                    'default'   => 0,
                    'validation'=> 'numeric|max:max',
                    'type'      => 'number'
                ],
        
                'max' => [
                    'name'      => 'sanatorium/inputs::types.settings.max',
                    'default'   => 100,
                    'validation'=> 'numeric|min:min',
                    'type'      => 'number',
                ]
        
            ];
            
            /**
             * {@inheritDoc}
             */
            protected $identifier = 'scale';

        }

2. Register that class in Sanatorium\Inputs\Providers\InputServiceProvider::registerTypes() method

        $types = [
          ...
          'date'		 	=> new Types\ScaleType,
        ];

3. Create templates to display the custom type on frontend and backend in sanatorium/inputs::types/{typeidentifider} theme path. (For example: /themes/admin/default/packages/sanatorium/input/views/types/scale.blade.php and /themes/frontend/default/packages/sanatorium/input/views/types/scale.blade.php)

### Widgets

#### @display

Widget to show media input types

    {{-- Show single image --}}
    @display($product, 'cover_image', 'single')

    {{-- Show gallery images --}}
    @display($product, 'gallery', 'multiple')

#### @displaygroup

Widget to show values of input group

    {{-- Show input group table --}}
  
    @displaygroup($product, 'Technical information')

### Functions

All functions below are not namespaced and you can find their code in [src/helpers.php](src/helpers.php)

#### Media related

    storage_url($media);        // Link to media on any storage
    
    thumbnail_url($media, $width = 300, $height = 300)  // Link to thumbnail
    
    mime2Extension($mime, $extension = '')  // Returns most common extension to mime type

#### Select, checkbox, multiselect functions

#### get_attribute_label

    get_attribute_label($key, $slug)  // Return label of single selected value
    
#### get_attribute_labels
    
    get_attribute_labels($keys = [], $slug, $return = 'string', $implode = ', ') // Return labels of selected values

Returns for example

    get_attribute_labels($product->animal, 'animal', 'array')  // => array ('cow' => 'Cow')

#### Display values related

    str_scheme($url, $scheme = 'http://'); // Add protocol if missing

    str_links($text);      // Turn URLs in content to <a href>

#### Theme related

    theme_set($theme);          // Set active theme
    
    theme_set_fallback($theme); // Set fallback theme
    
    theme_set_area($area);      // Set area of theme (admin|frontend)
    
    theme_frontend();           // Shorthand for theme_set_area('frontend');
    
    theme_admin();              // Shorthand for theme_set_area('admin');

## Changelog

- 4.3.0 - 2016-09-25 - Repeater now allows sub field definition
- 4.1.6 - 2016-09-21 - "required" settings on input groups
- 4.1.0 - 2016-09-18 - Theme related functions, added @display theme partials
- 4.0.0 - 2016-09-15 - Tags field
- 3.0.0 - 2016-08-31 - Supports Platform v5.0
- 1.2.0 - 2016-08-06 - Added relation, url, phone, email, supports grouping
- 0.1.8 - 2016-05-16 - Basic readme file

## Support

Support not available.