<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'CreateAttributeRelationsTable' => $baseDir . '/database/migrations/2016_08_06_224510_create_attribute_relations_table.php',
    'CreateAttributeSettingsTable' => $baseDir . '/database/migrations/2016_09_02_144952_create_attribute_settings_table.php',
    'CreateAttributesInputgroupsTable' => $baseDir . '/database/migrations/2016_08_06_203039_create_attributes_inputgroups_table.php',
    'CreateFormsTable' => $baseDir . '/database/migrations/2016_09_06_071110_create_forms_table.php',
    'CreateGroupsTable' => $baseDir . '/database/migrations/2016_08_06_191343_create_groups_table.php',
    'CreateMediaAssignTable' => $baseDir . '/database/migrations/2015_09_22_201025_create_media_assign_table.php',
    'Sanatorium\\Inputs\\Controllers\\Admin\\AttributesController' => $baseDir . '/src/Controllers/Admin/AttributesController.php',
    'Sanatorium\\Inputs\\Controllers\\Admin\\FormsController' => $baseDir . '/src/Controllers/Admin/FormsController.php',
    'Sanatorium\\Inputs\\Controllers\\Admin\\GroupsController' => $baseDir . '/src/Controllers/Admin/GroupsController.php',
    'Sanatorium\\Inputs\\Controllers\\Admin\\MediaController' => $baseDir . '/src/Controllers/Admin/MediaController.php',
    'Sanatorium\\Inputs\\Controllers\\Frontend\\DropzoneController' => $baseDir . '/src/Controllers/Frontend/DropzoneController.php',
    'Sanatorium\\Inputs\\Controllers\\Frontend\\FormsController' => $baseDir . '/src/Controllers/Frontend/FormsController.php',
    'Sanatorium\\Inputs\\Controllers\\Frontend\\GroupsController' => $baseDir . '/src/Controllers/Frontend/GroupsController.php',
    'Sanatorium\\Inputs\\Controllers\\Frontend\\LiveController' => $baseDir . '/src/Controllers/Frontend/LiveController.php',
    'Sanatorium\\Inputs\\Controllers\\Frontend\\MediaController' => $baseDir . '/src/Controllers/Frontend/MediaController.php',
    'Sanatorium\\Inputs\\Handlers\\Attributes\\AttributesDataHandler' => $baseDir . '/src/Handlers/Attributes/AttributesDataHandler.php',
    'Sanatorium\\Inputs\\Handlers\\Form\\FormDataHandler' => $baseDir . '/src/Handlers/Form/FormDataHandler.php',
    'Sanatorium\\Inputs\\Handlers\\Form\\FormDataHandlerInterface' => $baseDir . '/src/Handlers/Form/FormDataHandlerInterface.php',
    'Sanatorium\\Inputs\\Handlers\\Form\\FormEventHandler' => $baseDir . '/src/Handlers/Form/FormEventHandler.php',
    'Sanatorium\\Inputs\\Handlers\\Form\\FormEventHandlerInterface' => $baseDir . '/src/Handlers/Form/FormEventHandlerInterface.php',
    'Sanatorium\\Inputs\\Handlers\\Group\\GroupDataHandler' => $baseDir . '/src/Handlers/Group/GroupDataHandler.php',
    'Sanatorium\\Inputs\\Handlers\\Group\\GroupDataHandlerInterface' => $baseDir . '/src/Handlers/Group/GroupDataHandlerInterface.php',
    'Sanatorium\\Inputs\\Handlers\\Group\\GroupEventHandler' => $baseDir . '/src/Handlers/Group/GroupEventHandler.php',
    'Sanatorium\\Inputs\\Handlers\\Group\\GroupEventHandlerInterface' => $baseDir . '/src/Handlers/Group/GroupEventHandlerInterface.php',
    'Sanatorium\\Inputs\\Models\\AttributeSettings' => $baseDir . '/src/Models/AttributeSettings.php',
    'Sanatorium\\Inputs\\Models\\Form' => $baseDir . '/src/Models/Form.php',
    'Sanatorium\\Inputs\\Models\\Group' => $baseDir . '/src/Models/Group.php',
    'Sanatorium\\Inputs\\Models\\Media' => $baseDir . '/src/Models/Media.php',
    'Sanatorium\\Inputs\\Models\\Mediable' => $baseDir . '/src/Models/Mediable.php',
    'Sanatorium\\Inputs\\Models\\Relation' => $baseDir . '/src/Models/Relation.php',
    'Sanatorium\\Inputs\\Providers\\FormServiceProvider' => $baseDir . '/src/Providers/FormServiceProvider.php',
    'Sanatorium\\Inputs\\Providers\\GroupServiceProvider' => $baseDir . '/src/Providers/GroupServiceProvider.php',
    'Sanatorium\\Inputs\\Providers\\InputServiceProvider' => $baseDir . '/src/Providers/InputServiceProvider.php',
    'Sanatorium\\Inputs\\Repositories\\Form\\FormRepository' => $baseDir . '/src/Repositories/Form/FormRepository.php',
    'Sanatorium\\Inputs\\Repositories\\Form\\FormRepositoryInterface' => $baseDir . '/src/Repositories/Form/FormRepositoryInterface.php',
    'Sanatorium\\Inputs\\Repositories\\Group\\GroupRepository' => $baseDir . '/src/Repositories/Group/GroupRepository.php',
    'Sanatorium\\Inputs\\Repositories\\Group\\GroupRepositoryInterface' => $baseDir . '/src/Repositories/Group/GroupRepositoryInterface.php',
    'Sanatorium\\Inputs\\Repositories\\RelationsRepository' => $baseDir . '/src/Repositories/RelationsRepository.php',
    'Sanatorium\\Inputs\\Repositories\\RelationsRepositoryInterface' => $baseDir . '/src/Repositories/RelationsRepositoryInterface.php',
    'Sanatorium\\Inputs\\Traits\\MediableTrait' => $baseDir . '/src/Traits/MediableTrait.php',
    'Sanatorium\\Inputs\\Traits\\ThumbableTrait' => $baseDir . '/src/Traits/ThumbableTrait.php',
    'Sanatorium\\Inputs\\Types\\AvatarType' => $baseDir . '/src/Types/AvatarType.php',
    'Sanatorium\\Inputs\\Types\\BaseType' => $baseDir . '/src/Types/BaseType.php',
    'Sanatorium\\Inputs\\Types\\CategoryType' => $baseDir . '/src/Types/CategoryType.php',
    'Sanatorium\\Inputs\\Types\\CountryType' => $baseDir . '/src/Types/CountryType.php',
    'Sanatorium\\Inputs\\Types\\DateType' => $baseDir . '/src/Types/DateType.php',
    'Sanatorium\\Inputs\\Types\\DropzoneType' => $baseDir . '/src/Types/DropzoneType.php',
    'Sanatorium\\Inputs\\Types\\EmailType' => $baseDir . '/src/Types/EmailType.php',
    'Sanatorium\\Inputs\\Types\\FileType' => $baseDir . '/src/Types/FileType.php',
    'Sanatorium\\Inputs\\Types\\GalleryType' => $baseDir . '/src/Types/GalleryType.php',
    'Sanatorium\\Inputs\\Types\\ImageType' => $baseDir . '/src/Types/ImageType.php',
    'Sanatorium\\Inputs\\Types\\MediaType' => $baseDir . '/src/Types/MediaType.php',
    'Sanatorium\\Inputs\\Types\\PhoneType' => $baseDir . '/src/Types/PhoneType.php',
    'Sanatorium\\Inputs\\Types\\RelationType' => $baseDir . '/src/Types/RelationType.php',
    'Sanatorium\\Inputs\\Types\\RepeaterType' => $baseDir . '/src/Types/RepeaterType.php',
    'Sanatorium\\Inputs\\Types\\ScaleType' => $baseDir . '/src/Types/ScaleType.php',
    'Sanatorium\\Inputs\\Types\\SwitcheryType' => $baseDir . '/src/Types/SwitcheryType.php',
    'Sanatorium\\Inputs\\Types\\TruefalseType' => $baseDir . '/src/Types/TruefalseType.php',
    'Sanatorium\\Inputs\\Types\\UrlType' => $baseDir . '/src/Types/UrlType.php',
    'Sanatorium\\Inputs\\Types\\VideoType' => $baseDir . '/src/Types/VideoType.php',
    'Sanatorium\\Inputs\\Types\\WysiwygType' => $baseDir . '/src/Types/WysiwygType.php',
    'Sanatorium\\Inputs\\Validator\\Form\\FormValidator' => $baseDir . '/src/Validator/Form/FormValidator.php',
    'Sanatorium\\Inputs\\Validator\\Form\\FormValidatorInterface' => $baseDir . '/src/Validator/Form/FormValidatorInterface.php',
    'Sanatorium\\Inputs\\Validator\\Group\\GroupValidator' => $baseDir . '/src/Validator/Group/GroupValidator.php',
    'Sanatorium\\Inputs\\Validator\\Group\\GroupValidatorInterface' => $baseDir . '/src/Validator/Group/GroupValidatorInterface.php',
    'Sanatorium\\Inputs\\Widgets\\Display' => $baseDir . '/src/Widgets/Display.php',
    'Sanatorium\\Inputs\\Widgets\\Entity' => $baseDir . '/src/Widgets/Entity.php',
    'Sanatorium\\Inputs\\Widgets\\Form' => $baseDir . '/src/Widgets/Form.php',
    'Sanatorium\\Inputs\\Widgets\\Group' => $baseDir . '/src/Widgets/Group.php',
    'Sanatorium\\Inputs\\Widgets\\Live' => $baseDir . '/src/Widgets/Live.php',
    'Sanatorium\\Inputs\\Widgets\\Media' => $baseDir . '/src/Widgets/Media.php',
);
