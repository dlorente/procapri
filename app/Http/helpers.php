<?php

use Illuminate\Support\Arr;

if (! function_exists('is_development')) {

    /**
     * Checks is development environment
     */
    function is_development()
    {
        return app()->environment('local');
    }
}

if (! function_exists('icon_status')) {

    /**
     * Exibe ícone de ativo/inativo pelo status (0/1).
     *
     * @return void
     */
    function icon_status(int $status)
    {
        $icon = $status == 1
            ? ['icon' => 'check', 'color' => 'text-success']
            : ['icon' => 'times', 'color' => 'text-danger'];

        echo vsprintf('<i class="fa fa-%s %s"></i>', $icon);
    }
}


if (! function_exists('uploads_path')) {

    /**
     * Retorna caminho padrão da pasta de uploads.
     *
     * @return string
     */
    function uploads_path(string $path = '')
    {
        return asset('storage/' . $path);
    }
}


if (! function_exists('public_storage_path')) {

    /**
     * Retorna caminho padrão da pasta de storage.
     *
     * @return string
     */
    function public_storage_path(string $path = '')
    {
        return public_path('storage/' . $path);
    }
}

if (! function_exists('date_db')) {

    /**
     * Retorna data no formato do banco de dados (YYYY-MM-DD).
     *
     * @param mixed $date
     *
     * @return string
     */
    function date_db($date)
    {
        return implode('-', array_reverse(explode('/', $date)));
    }
}


if (! function_exists('date_br')) {

    /**
     * Retorna data no formato brasileiro (DD/MM/YYYY).
     *
     * @param mixed $date
     *
     * @return string
     */
    function date_br($date)
    {
        return implode('/', array_reverse(explode('-', $date)));
    }
}

if (! function_exists('datetime_db')) {

    /**
     * Convert date for DB format (YYYY-MM-DD H:I:S).
     *
     * @param string $datetime
     *
     * @return string
     */
    function datetime_db($datetime = null)
    {
        if (! $datetime) {
            return null;
        }

        [$date, $time] = explode(' ', $datetime);

        return date_db($date) . ' ' . $time;
    }
}

if (! function_exists('datetime_br')) {

    /**
     * Convert date for BR format (DD-MM-YYYY H:I:S).
     *
     * @param string $datetime
     *
     * @return string
     */
    function datetime_br($datetime = null)
    {
        if (! $datetime) {
            return null;
        }

        [$date, $time] = explode(' ', $datetime);

        return date_br($date) . ' ' . $time;
    }
}

if (! function_exists('start_datetime_db')) {

    /**
     * Retorna data e hora no formato do banco de dados (YYYY-MM-DD H:i:s).
     *
     * @param mixed $date
     *
     * @return string
     */
    function start_datetime_db($date)
    {
        return date_db($date) . ' 00:00:00';
    }
}


if (! function_exists('end_datetime_db')) {

    /**
     * Retorna data e hora no formato do banco de dados (YYYY-MM-DD H:i:s).
     *
     * @param mixed $date
     *
     * @return string
     */
    function final_datetime_db($date)
    {
        return date_db($date) . ' 23:59:59';
    }
}


if (! function_exists('money_db')) {

    /**
     * Retorna valor monetário no formato do banco de dados (100.00).
     *
     * @param mixed $value
     *
     * @return string
     */
    function money_db($value)
    {
        return str_replace(['.', ','], ['', '.'], $value);
    }
}


if (! function_exists('money_br')) {

    /**
     * Retorna valor monetário no formato brasileiro (100,00).
     *
     * @param mixed $value
     *
     * @return string
     */
    function money_br($value)
    {
        return $value ? number_format($value, 2, ',', '.') : '0,00';
    }
}

if (! function_exists('left_zero')) {

    /**
     * Insere zeros a esquerda do valor informado.
     *
     * @param mixed $value
     * @param mixed $qty
     *
     * @return string
     */
    function left_zero($value, $qty = 11)
    {
        return str_pad($value, $qty, 0, STR_PAD_LEFT);
    }
}


if (! function_exists('document_db')) {

    /**
     * Formata número de documento (CPF/CNPJ) para o banco de dados.
     *
     * @param null|mixed $value
     *
     * @return string
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
     * Insere máscara para número de documento (CPF/CNPJ).
     *
     * @param mixed $value
     *
     * @return string
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
     * Marca selected no componente HTML Select
     *
     * @param mixed $field
     * @param mixed $value
     *
     * @return string
     */
    function set_selected($field, $value)
    {
        return $field != $value ?: 'selected';
    }
}


if (! function_exists('set_multi_selected')) {

    /**
     * Marca selected no componente HTML Select Multiple
     *
     * @param mixed $value
     * @param mixed $values
     *
     * @return string
     */
    function set_multi_selected($value, $values)
    {
        return in_array($value, $values ?? []) ? 'selected' : '';
    }
}


if (! function_exists('set_checked')) {

    /**
     * Marca checked no componente HTML Checkbox
     *
     * @param mixed $value
     *
     * @return string
     */
    function set_checked($value)
    {
        return $value == 1 ? 'checked' : '';
    }
}

if (! function_exists('array_wrap')) {

    /**
     * Encapsula string como array.
     *
     * @param mixed $array
     *
     * @return array
     */
    function array_wrap($array)
    {
        return Arr::wrap($array);
    }
}


if (! function_exists('array_obj')) {

    /**
     * Converte array em um objeto PHP.
     *
     * @param mixed $array
     *
     * @return object
     */
    function array_obj($array)
    {
        return json_decode(json_encode($array));
    }
}


if (! function_exists('hash_id')) {

    /**
     * Retorna numero com hashtag.
     *
     * @param mixed $value
     *
     * @return string
     */
    function hash_id($value)
    {
        return '#' . left_zero($value, 6);
    }
}


if (! function_exists('hash_db')) {

    /**
     * Remove # da hashtag.
     *
     * @param null|mixed $value
     *
     * @return int
     */
    function hash_db($value = null)
    {
        return (int) str_replace('#', '', $value);
    }
}


if (! function_exists('is_super_admin')) {

    /**
     * Verifica de o usuário é Super Admin.
     *
     * @return bool
     */
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
     * Retorna aba ativa via query string da url.
     *
     * @param mixed $name
     *
     * @return string
     */
    function active_tab($name)
    {
        return request()->tab == $name ? 'active' : '';
    }
}

if (! function_exists('allocation_status')) {

    /**
     * Retorna status da locação.
     *
     * @param mixed $date
     *
     * @return string|void
     */
    function allocation_status($date)
    {
        if ($date) {
            return $date;
        }

        echo '<span class="badge badge-success p-2">Em Andamento</span>';
    }
}

if (! function_exists('phone_db')) {

    /**
     * Formata campo de telefone para salvar no banco de dados.
     *
     * @param string $value
     *
     * @return string
     */
    function phone_db($value)
    {
        return str_replace(['(', ')', '-', ' '], [''], $value);
    }
}

if (! function_exists('phone_view')) {

    /**
     * Formata campo de telefone para exibir nas views.
     *
     * @param string $value
     *
     * @return string
     */
    function phone_view($value)
    {
        if (strlen($value) == 10) {
            return preg_replace("/(\d{2})(\d{4})/", '($1) $2-$3', $value);
        }

        return preg_replace("/(\d{2})(\d{1})(\d{4})/", '($1) $2$3-$4', $value);
    }
}
