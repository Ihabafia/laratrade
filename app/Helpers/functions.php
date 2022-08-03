<?php

use Diglactic\Breadcrumbs\Exceptions\InvalidBreadcrumbException;
use Diglactic\Breadcrumbs\Exceptions\UnnamedRouteException;
use Diglactic\Breadcrumbs\Exceptions\ViewNotSetException;

function inCents($inDollars = 0): int
{
    return $inDollars * 100;
}

function inDollars($inCents = 0): float
{
    return $inCents / 100;
}

function current_route() {
    return Route::currentRouteName();
}

function color($string, $color = 'success', $type = '')
{
    return "<span class='text-$color $type'>$string</span>";
}

/**
 * @param null $route
 * @return View|string
 */
function breadcrumb($route = null): View|string
{
    try {
        return Breadcrumbs::render($route ?? current_route());
    } catch (Exception $e) {
        session('info', 'Breadcrumb missing');
        return 'Breadcrumb Missing';
    }
}

function formatPhone($string): string
{
    if (10 != strlen($string)) {
        return '--';
    }

    return '('.substr($string, 0, 3).') '.substr($string, 3, 3).'-'.substr($string, 6, 4);
}

function formatInternationalPhone($string): string
{
    if (12 != strlen($string)) {
        return '--';
    }

    return '+1 ('.substr($string, 2, 3).') '.substr($string, 5, 3).'-'.substr($string, 8, 4);
}

function formatPercent($number, $space = ' ')
{
    return number_format($number, 2) .$space.'%';
}

function formatQty($number, $decimals = 2)
{
    if(! $number) {
        return null;
    }

    return number_format($number, $decimals);
}

function currency($number, $invert = false)
{
    if ($number >= 0 && !$invert) {
        return color(formatCurrency($number), 'success');
    }
    if ($number < 0 && !$invert) {
        return color(formatCurrency($number), 'danger');
    }
    if ($number >= 0 && $invert) {
        return color(formatCurrency($number), 'danger');
    }
    if ($number < 0 && $invert) {
        return color(formatCurrency($number), 'success');
    }
}

function formatCurrency($number, $currency = 'USD', $type = ''): ?string
{
    if(is_null($number)) {
        return null;
    }

    $fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
    $num = (float) $number;

    if ('sms' === $type) {
        return '¤'.$fmt->formatCurrency($num, $currency);
    }

    return $fmt->formatCurrency($num, $currency);
}

function ds($number, $currency = 'USD', $type = ''): ?string
{
    if(is_null($number)) {
        return null;
    }

    $fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
    $num = (float) $number;

    if ('sms' === $type) {
        return '¤'.$fmt->formatCurrency($num, $currency);
    }

    return $fmt->formatCurrency($num, $currency);
}

function n($number): string
{
    return number_format($number);
}

function active ($route = null): bool
{
    return current_route() === $route;
}

function activea (array $routes): bool
{
    return in_array(current_route(), $routes);
}

function pill($string, $color = 'success', $type = ''): string
{
    return match ($color.'-'.$type) {
        'primary-glow', 'secondary-glow', 'success-glow', 'danger-glow', 'warning-glow', 'info-glow', 'dark-glow'
            => "<span class='badge rounded-pill badge-glow bg-{$color}'>{$string}</span>",
        'primary-light', 'secondary-light', 'success-light', 'danger-light', 'warning-light', 'info-light', 'dark-light'
            => "<span class='badge rounded-pill badge-light-{$color}'>{$string}</span>",
        default  => "<span class='badge rounded-pill bg-{$color}'>{$string}</span>",
    };
}

function badge($string, $color = 'success', $type = ''): string
{
    return match ($color.'-'.$type) {
        'primary-glow', 'secondary-glow', 'success-glow', 'danger-glow', 'warning-glow', 'info-glow', 'dark-glow'
            => "<span class='badge rounded-pill badge-glow bg-{$color}'>{$string}</span>",
        'primary-light', 'secondary-light', 'success-light', 'danger-light', 'warning-light', 'info-light', 'dark-light'
            => "<span class='badge rounded-pill badge-light-{$color}'>{$string}</span>",
        default  => "<span class='badge pill bg-{$color}'>{$string}</span>",
    };
}

function largePill($string, $color): string
{
    return "<span class='fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-{$color}-light text-{$color}'>{$string}</span>";
}

function unslug($string, $search = '_', $replace = ''): string
{
    return str_replace($search, $replace, $string);
}



function status($model, $active="Active", $inactive="Inactive") {
    if($model->deleted_at) {
        return pill($inactive, 'danger');
    } else {
        return pill($active, 'success');
    }
}

function br2nl($message)
{
    return str_replace(['<br>', '<br />'], "\r\n", $message);
}

function auditTrail($description = '', $model = null, $causedBy = null) {
    activity(session('client_id') ?? 'default')
       ->causedBy($causedBy)
       ->performedOn($model)
       ->log($description);
}

function colored_amount($amount)
{
    if ($amount < 0) {
        $result = "<span class='text-danger bold mr-5'>-$".number_format($amount, 2).'</span>';
    } else {
        $result = "<span class='text-success bold mr-5'>$".number_format($amount, 2).'</span>';
    }

    return $result;
}

function updateSession()
{
    $id = session('portfolio')['id'];
    $portfolios = auth()->user()->portfolios;
    $portfolio = \App\Models\Portfolio::find($id);
    session()->put('portfolio', $portfolio->toArray());
    session()->put('portfolios', $portfolios->pluck('id', 'name'));
}
