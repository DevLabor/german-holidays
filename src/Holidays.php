<?php

namespace DevLabor\GermanHolidays;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Holidays
{
    const STATE_BADEN_WUERTTEMBERG = 'BW';
    const STATE_BAVARIA = 'BY';
    const STATE_BERLIN = 'BE';
    const STATE_BRANDENBURG = 'BB';
    const STATE_BREMEN = 'HB';
    const STATE_HAMBURG = 'HH';
    const STATE_HESSE = 'HE';
    const STATE_LOWER_SAXONY = 'NI';
    const STATE_MECKLENBURG_WEST_POMERANIA = 'MW';
    const STATE_NORTH_RHINE_WESTPHALIA = 'NW';
    const STATE_RHINELAND_PALATINATE = 'RP';
    const STATE_SAARLAND = 'SL';
    const STATE_SAXONY = 'SN';
    const STATE_SAXONY_ANHALT = 'ST';
    const STATE_SCHLESWIG_HOLSTEIN = 'SH';
    const STATE_THURINGIA = 'TH';

    /**
     * Getting data from feiertage-api.de.
     *
     * @param null $year
     * @param string $federalState
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function get($year = null, $federalState = ''): array
    {
        if (! $year) {
            $year = date('y');
        }

        $client = new Client([
            'base_uri' => 'https://feiertage-api.de/api/',
            'timeout' => 2.0,
        ]);

        $parameters = [
            'jahr' => $year,
        ];

        if ($federalState) {
            $parameters['nur_land'] = $federalState;
        }

        try {
            $response = $client->request('GET', '', [
                'query' => $parameters,
            ]);
        } catch (RequestException $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }

        return json_decode($response->getBody()->getContents(), true) ?? [];
    }

    /**
     * Resolves federal state name to const.
     * Returns empty string if couldn't resolve the state name.
     *
     * @param $federalState
     *
     * @return string
     */
    public static function resolveFederalStateName($federalState): string
    {
        switch (strtolower($federalState)) {
            case 'baden-württemberg':
                return static::STATE_BADEN_WUERTTEMBERG;
            case 'bayern':
                return static::STATE_BAVARIA;
            case 'berlin':
                return static::STATE_BERLIN;
            case 'brandenburg':
                return static::STATE_BRANDENBURG;
            case 'bremen':
                return static::STATE_BREMEN;
            case 'hamburg':
                return static::STATE_HAMBURG;
            case 'hessen':
                return static::STATE_HESSE;
            case 'mecklenburg-vorpommern':
                return static::STATE_MECKLENBURG_WEST_POMERANIA;
            case 'niedersachsen':
                return static::STATE_LOWER_SAXONY;
            case 'nordrhein-westfalen':
                return static::STATE_NORTH_RHINE_WESTPHALIA;
            case 'rheinland pfalz':
                return static::STATE_RHINELAND_PALATINATE;
            case 'sachsen':
                return static::STATE_SAXONY;
            case 'sachsen-anhalt':
                return static::STATE_SAXONY_ANHALT;
            case 'saarland':
                return static::STATE_SAARLAND;
            case 'schleswig holstein':
                return static::STATE_SCHLESWIG_HOLSTEIN;
            case 'thüringen':
                return static::STATE_THURINGIA;
        }

        return '';
    }
}
