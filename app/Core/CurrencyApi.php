<?php
namespace App\Core;

/**
 * CurrencyApi - external API integration.
 * Calls open.er-api.com (free, no API key) to convert PHP prices to USD.
 * The result is cached in the session for 1 hour to respect rate limits.
 */
class CurrencyApi
{
    public static function usdRate(): ?float
    {
        // 1. Use cached rate if it is less than 1 hour old
        if (isset($_SESSION['usd_rate'], $_SESSION['usd_rate_time'])
            && time() - $_SESSION['usd_rate_time'] < 3600) {
            return $_SESSION['usd_rate'];
        }

        // 2. Call the API with cURL
        $ch = curl_init(App::config('api.currency_url'));
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => App::config('api.timeout', 5),
        ]);
        $body   = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // 3. Error handling: any failure returns null and the app keeps working
        if ($body === false || $status !== 200) {
            return null;
        }

        $json = json_decode($body, true);
        if (($json['result'] ?? '') !== 'success' || !isset($json['rates']['USD'])) {
            return null;
        }

        $_SESSION['usd_rate']      = (float) $json['rates']['USD'];
        $_SESSION['usd_rate_time'] = time();
        return $_SESSION['usd_rate'];
    }

    /** Format a PHP price with its USD equivalent, e.g. "₱499.00 (≈ $8.50)" */
    public static function format(float $pesos): string
    {
        $text = '₱' . number_format($pesos, 2);
        $rate = self::usdRate();
        if ($rate !== null) {
            $text .= ' <small>(≈ $' . number_format($pesos * $rate, 2) . ')</small>';
        }
        return $text;
    }
}
