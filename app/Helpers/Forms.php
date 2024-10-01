<?php

use Illuminate\Support\Collection;

if (!function_exists('generateSelectOptions')) {
    /**
     * Generates select options from the provided data.
     *
     * This function takes in data, which can be an instance of Model, Collection, or an array.
     * It also accepts optional parameters for value and text columns, as well as a callback function.
     * The callback function is executed on the data if it is an instance of Model.
     * The function then returns a collection of objects with 'id' and 'text' properties.
     *
     * @param mixed $data The data to generate select options from.
     * @param string|null $value_column The name of the column to use for the "value" field.
     * @param string|null $text_column The name of the column to use for the "text" field.
     * @param int|null $limit The maximum number of select options to return.
     * @param callable|null $callback A callback function to execute on the data if it is an instance of Model.
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|Object
     */
    function generateSelectOptions($data, $value_column = null, $text_column = null, $limit = 20, $callback = null,)
    {
        $value = $value_column ?? 'id';
        $text = $text_column ?? 'name';

        $isModel = $data instanceof \Illuminate\Database\Eloquent\Model;
        $isCollection = $data instanceof \Illuminate\Database\Eloquent\Collection;
        $isArray = is_array($data);

        if ($isArray) {
            $temp = [];
            foreach ($data as $item) {
                $temp[] = (object) $item;
            }
            $data = new Collection($temp);
            $isCollection = true;
            $isArray = false;
        }

        if ($isModel) {
            $d = $data->select("$value as id", "$text as text");
            if ($limit) {
                $d = $d->take($limit);
            }
            if ($callback) {
                $callback($d);
            }

            return $d->get();
        }

        if ($isCollection) {
            return $data->map(function ($item) use ($value, $text, $limit) {
                if ($limit) {
                    return (object) array_slice([
                        'id' => $item->$value,
                        'text' => $item->$text
                    ], 0, $limit);
                }

                return (object) [
                    'id' => $item->$value,
                    'text' => $item->$text
                ];
            });
        }
    }



    function getPaddingConfig()
    {
        $data = array(
            0 => (object) [
                'id' => '0',
                'name' => '1'
            ],
            1 => (object) [
                'id' => '1',
                'name' => '01'
            ],
            2 => (object) [
                'id' => '2',
                'name' => '001'
            ],
            3 => (object) [
                'id' => '3',
                'name' => '0001'
            ]
        );

        return  $data;
    }
}
