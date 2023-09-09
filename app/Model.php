<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin \Eloquent
 */
class Model extends EloquentModel
{
    public function scopeBySchool($query, int $school_id)
    {
        return $query->where('school_id', $school_id);
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeStatus($query)
    {
        return $query->where('status', 1);
    }

    public function scopeSlug($query, string $slug)
    {
        return $query->where('slug', $slug);
    }

    /**
     * Set a given attribute on the model.
     *
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    public function setAttribute($key, $value)
    {
        $array = [
            'created_at',
            'updated_at',
        ];

        if (in_array($key, $array)) {
            $timezone = (foqas_setting('timezone') ?? config('app.timezone'));

            if (!($value instanceof Carbon)) {
                $value = Carbon::parse($value);
            }

            return $this->attributes[$key] = Carbon::createFromFormat('Y-m-d H:i:s', $value, $timezone)
                ->setTimezone($timezone);
        }

        return parent::setAttribute($key, $value);
    }

    /**
     * Get an attribute from the model.
     *
     * @param string $key
     * @return mixed
     */
    public function getAttribute($key)
    {
        $array = [
            'created_at',
            'updated_at',
        ];

        if (in_array($key, $array)) {
            $timezone = (foqas_setting('timezone') ?? config('app.timezone'));
            $value = $this->getAttributeValue($key);

            if (!($value instanceof Carbon)) {
                $value = Carbon::parse($value);
            }

            return Carbon::createFromFormat('Y-m-d H:i:s', $value, $timezone)
                ->setTimezone($timezone);
        }

        return parent::getAttribute($key);
    }
}
