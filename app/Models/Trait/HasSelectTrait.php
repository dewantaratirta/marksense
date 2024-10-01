<?php

namespace App\Models\Trait;

use Exception;

use function PHPUnit\Framework\throwException;

trait HasSelectTrait
{
    // value_column
    // text_column

    /**
     * Generates a select data for the model using the provided callback and column names.
     *
     * @param callable|null $callback A callback function to modify the model before generating the select query.
     * @param string|null $value_column The name of the column to use for the "value" field in the select query. If not provided, the default value column from the trait will be used.
     * @param string|null $text_column The name of the column to use for the "text" field in the select query. If not provided, the default text column from the trait will be used.
     * @return \Illuminate\Database\Eloquent\Collection The result of the select query.
     */
    public function generateSelect($callback = null, $value_column = null, $text_column = null)
    {
        if ($callback) {
            $callback($this);
        }

        $value = $value_column ?? $this->value_column;
        $text = $text_column ?? $this->text_column;

        return $this->select("$value as value", "$text as text")->get();
    }
}
