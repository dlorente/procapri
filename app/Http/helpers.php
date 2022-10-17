<?php

use Illuminate\Support\Arr;

if (! function_exists('icon_status')) {

    function icon_status(int $status)
    {
        $icon = $status == 1
            ? ['icon' => 'check', 'color' => 'text-success']
            : ['icon' => 'times', 'color' => 'text-danger'];

        echo vsprintf('<i class="fa fa-%s %s"></i>', $icon);
    }
}

if (! function_exists('uploads_path')) {

    function uploads_path(string $path = '')
    {
        return asset('storage/' . $path);
    }
}

if (! function_exists('public_storage_path')) {

    function public_storage_path(string $path = '')
    {
        return public_path('storage/' . $path);
    }
}

if (! function_exists('date_db')) {

    /**
     * @param mixed $date
     */
    function date_db($date)
    {
        return implode('-', array_reverse(explode('/', $date)));
    }
}

if (! function_exists('date_br')) {

    /**
     * @param mixed $date
     */
    function date_br($date)
    {
        return implode('/', array_reverse(explode('-', $date)));
    }
}

if (! function_exists('start_datetime_db')) {

    /**
     * @param mixed $date
     */
    function start_datetime_db($date)
    {
        return date_db($date) . ' 00:00:00';
    }
}

if (! function_exists('end_datetime_db')) {

    /**
     * @param mixed $date
     */
    function final_datetime_db($date)
    {
        return date_db($date) . ' 23:59:59';
    }
}

if (! function_exists('money_db')) {

    /**
     * @param mixed $value
     */
    function money_db($value)
    {
        return str_replace(['.', ','], ['', '.'], $value);
    }
}

if (! function_exists('money_br')) {

    /**
     * @param mixed $value
     */
    function money_br($value)
    {
        return $value ? number_format($value, 2, ',', '.') : '0,00';
    }
}

if (! function_exists('left_zero')) {

    /**
     * @param mixed $value
     * @param mixed $qty
     */
    function left_zero($value, $qty = 11)
    {
        return str_pad($value, $qty, 0, STR_PAD_LEFT);
    }
}

if (! function_exists('document_db')) {

    /**
     * @param null|mixed $value
     */
    function document_db($value = null)
    {
        $document = preg_replace("/\D/", '', $value);
        $lenght = strlen($document) <= 11 ?: 14;

        return $value ? left_zero($document, $lenght) : null;
    }
}

if (! function_exists('document_view')) {

    /**
     * @param mixed $value
     */
    function document_view($value)
    {
        $document = preg_replace("/\D/", '', $value);

        if (strlen($document) == 11) {
            return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", '$1.$2.$3-$4', $document);
        }

        return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", '$1.$2.$3/$4-$5', $document);
    }
}

if (! function_exists('set_selected')) {

    /**
     * @param mixed $field
     * @param mixed $value
     */
    function set_selected($field, $value)
    {
        return $field != $value ?: 'selected';
    }
}

if (! function_exists('set_multi_selected')) {

    /**
     * @param mixed $value
     * @param mixed $values
     */
    function set_multi_selected($value, $values)
    {
        return in_array($value, $values ?? []) ? 'selected' : '';
    }
}

if (! function_exists('set_checked')) {

    /**
     * @param mixed $value
     */
    function set_checked($value)
    {
        return $value == 1 ? 'checked' : '';
    }
}

if (! function_exists('array_wrap')) {

    /**
     * @param mixed $array
     */
    function array_wrap($array)
    {
        return Arr::wrap($array);
    }
}

if (! function_exists('array_obj')) {
    function array_obj($array)
    {
        return json_decode(json_encode($array));
    }
}

if (! function_exists('hash_id')) {

    /**
     * @param mixed $value
     */
    function hash_id($value)
    {
        return '#' . left_zero($value, 6);
    }
}

if (! function_exists('hash_db')) {

    /**
     * @param null|mixed $value
     */
    function hash_db($value = null)
    {
        return (int) str_replace('#', '', $value);
    }
}

if (! function_exists('is_super_admin')) {

    function is_super_admin()
    {
        return auth()->user()->isSuperAdmin();
    }
}

if (! function_exists('route_is')) {

    /**
     * @param mixed $routes
     */
    function route_is($routes)
    {
        return in_array(\Route::current()->getName(), $routes);
    }
}

if (! function_exists('active_tab')) {

    /**
     * @param mixed $name
     */
    function active_tab($name)
    {
        return request()->tab == $name ? 'active' : '';
    }
}

if (! function_exists('allocation_status')) {

    /**
     * @param mixed $date
     */
    function allocation_status($date)
    {
        if ($date) {
            return $date->format('d/m/Y H:i');
        }

        echo '<span class="badge badge-success p-2">Em Andamento</span>';
    }
}
