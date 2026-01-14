<?php
/**
 * Classe de base pour les metaboxes générées
 * Author : GEHIN Nicolas
 */

if (!defined('ABSPATH')) {
    exit;
}

class UGM_Metabox {
    protected function apply_filter_identity($value) {
        return $value;
    }

    protected function apply_filter_number_thousands($value) {
        if ($value === '' || $value === null) return '';
        return number_format((float)$value, 0, ',', ' ');
    }

    protected function apply_filter_surface_m2($value) {
        if ($value === '' || $value === null) return '';
        if (is_numeric($value)) {
            return number_format((float)$value, 0, ',', ' ') . ' M2';
        }
        return trim((string)$value) . ' M2';
    }

    protected function apply_filter_currency_eur($value) {
        if ($value === '' || $value === null) return '';
        return number_format((float)$value, 0, ',', ' ') . ' €';
    }

    protected function apply_filter_currency_eur_2dec($value) {
        if ($value === '' || $value === null) return '';
        return number_format((float)$value, 2, ',', ' ') . ' €';
    }

    protected function apply_filter_yes_no($value) {
        return ((string)$value === '1') ? 'Oui' : 'Non';
    }

    protected function apply_filter_uppercase($value) {
        return mb_strtoupper((string)$value);
    }

    protected function apply_filter_lowercase($value) {
        return mb_strtolower((string)$value);
    }

    protected function apply_filter_date_dmy($value) {
        $ts = strtotime((string)$value);
        return $ts ? date_i18n('d/m/Y', $ts) : (string)$value;
    }

    protected function apply_filter_datetime_dmy_hi($value) {
        $ts = strtotime((string)$value);
        return $ts ? date_i18n('d/m/Y H:i', $ts) : (string)$value;
    }
}
