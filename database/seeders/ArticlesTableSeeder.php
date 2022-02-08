<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;
use TCG\Voyager\Models\Permission;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Data Type
        $dataType = $this->dataType('slug', 'articles');
        if (!$dataType->exists) {
            $dataType->fill(
                [
                    'name' => 'articles',
                    'display_name_singular' => 'Article',
                    'display_name_plural' => 'Articles',
                    'icon' => 'voyager-anchor',
                    'model_name' => 'App\Models\Article',
                    'policy_name' => '',
                    'controller' => '',
                    'generate_permissions' => 1,
                    'description' => '',
                ]
            )->save();
        }

        //Data Rows
        $articleDataType = DataType::where('slug', 'articles')->firstOrFail();
        $dataRow = $this->dataRow($articleDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill(
                [
                    'type' => 'number',
                    'display_name' => __('voyager::seeders.data_rows.id'),
                    'required' => 1,
                    'browse' => 0,
                    'read' => 0,
                    'edit' => 0,
                    'add' => 0,
                    'delete' => 0,
                    'order' => 1,
                ]
            )->save();
        }

        $dataRow = $this->dataRow($articleDataType, 'title');
        if (!$dataRow->exists) {
            $dataRow->fill(
                [
                    'type' => 'text',
                    'display_name' => __('voyager::seeders.data_rows.title'),
                    'required' => 1,
                    'browse' => 1,
                    'read' => 1,
                    'edit' => 1,
                    'add' => 1,
                    'delete' => 1,
                    'order' => 2,
                ]
            )->save();
        }

        $dataRow = $this->dataRow($articleDataType, 'excerpt');
        if (!$dataRow->exists) {
            $dataRow->fill(
                [
                    'type' => 'text_area',
                    'display_name' => __('voyager::seeders.data_rows.excerpt'),
                    'required' => 1,
                    'browse' => 0,
                    'read' => 1,
                    'edit' => 1,
                    'add' => 1,
                    'delete' => 1,
                    'order' => 3,
                ]
            )->save();
        }

        $dataRow = $this->dataRow($articleDataType, 'body');
        if (!$dataRow->exists) {
            $dataRow->fill(
                [
                    'type' => 'rich_text_box',
                    'display_name' => __('voyager::seeders.data_rows.body'),
                    'required' => 1,
                    'browse' => 0,
                    'read' => 1,
                    'edit' => 1,
                    'add' => 1,
                    'delete' => 1,
                    'order' => 4,
                ]
            )->save();
        }

        $dataRow = $this->dataRow($articleDataType, 'image');
        if (!$dataRow->exists) {
            $dataRow->fill(
                [
                    'type' => 'image',
                    'display_name' => 'Image',
                    'required' => 0,
                    'browse' => 1,
                    'read' => 1,
                    'edit' => 1,
                    'add' => 1,
                    'delete' => 1,
                    'details' => [
                        'resize' => [
                            'width' => '1000',
                            'height' => 'null',
                        ],
                        'quality' => '70%',
                        'upsize' => true,
                        'thumbnails' => [
                            [
                                'name' => 'medium',
                                'scale' => '50%',
                            ],
                            [
                                'name' => 'small',
                                'scale' => '25%',
                            ],
                            [
                                'name' => 'cropped',
                                'crop' => [
                                    'width' => '300',
                                    'height' => '250',
                                ],
                            ],
                        ],
                    ],
                    'order' => 5,
                ]
            )->save();
        }

        $dataRow = $this->dataRow($articleDataType, 'slug');
        if (!$dataRow->exists) {
            $dataRow->fill(
                [
                    'type' => 'text',
                    'display_name' => __('voyager::seeders.data_rows.slug'),
                    'required' => 1,
                    'browse' => 0,
                    'read' => 1,
                    'edit' => 1,
                    'add' => 1,
                    'delete' => 1,
                    'details' => [
                        'slugify' => [
                            'origin' => 'title',
                            'forceUpdate' => true,
                        ],
                        'validation' => [
                            'rule' => 'unique:articles,slug',
                        ],
                    ],
                    'order' => 6,
                ]
            )->save();
        }

        $dataRow = $this->dataRow($articleDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill(
                [
                    'type' => 'timestamp',
                    'display_name' => __('voyager::seeders.data_rows.created_at'),
                    'required' => 0,
                    'browse' => 1,
                    'read' => 1,
                    'edit' => 0,
                    'add' => 0,
                    'delete' => 0,
                    'order' => 12,
                ]
            )->save();
        }

        $dataRow = $this->dataRow($articleDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill(
                [
                    'type' => 'timestamp',
                    'display_name' => __('voyager::seeders.data_rows.updated_at'),
                    'required' => 0,
                    'browse' => 0,
                    'read' => 0,
                    'edit' => 0,
                    'add' => 0,
                    'delete' => 0,
                    'order' => 13,
                ]
            )->save();
        }

        //Menu Item
        $menu = Menu::where('name', 'admin')->firstOrFail();
        $menuItem = MenuItem::firstOrNew(
            [
                'menu_id' => $menu->id,
                'title' => 'Articles',
                'url' => '',
                'route' => 'voyager.articles.index',
            ]
        );

        if (!$menuItem->exists) {
            $menuItem->fill(
                [
                    'target' => '_self',
                    'icon_class' => 'voyager-anchor',
                    'color' => null,
                    'parent_id' => null,
                    'order' => 17,
                ]
            )->save();
        }

        //Permissions
        Permission::generateFor('articles');
    }

    /**
     * [dataRow description].
     *
     * @param [type] $type  [description]
     * @param [type] $field [description]
     *
     * @return [type] [description]
     */
    protected function dataRow($type, $field)
    {
        return DataRow::firstOrNew(
            [
                'data_type_id' => $type->id,
                'field' => $field,
            ]
        );
    }

    /**
     * [dataType description].
     *
     * @param [type] $field [description]
     * @param [type] $for   [description]
     *
     * @return [type] [description]
     */
    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }
}
