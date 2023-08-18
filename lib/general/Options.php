<?php

namespace Intensa\Sentry;

use Bitrix\Main\Config\Option;

class Options
{
    protected array $settings = [];

    private static $instance = null;

    private array $defaultOptions = [
        'DSN' => '',
        'ENVIRONMENT' => 'local',
        'EXCLUDED_ERRORS' => '3',
    ];

    const MODULE_ID = 'intensa.sentry';

    private function __construct() {
        foreach ($this->defaultOptions as $optionName => $optionValue) {
            $curValue = Option::get(self::MODULE_ID, $optionName, $optionValue);
            $this->settings[$optionName] = $curValue;
        }
    }

    public static function getInstance(): Options
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function installOptions()
    {
        foreach ($this->defaultOptions as $optionName => $optionValue) {
            Option::set(self::MODULE_ID, $optionName, $optionValue);
        }
    }

    public function getDefaultOptionValue(string $optionCode)
    {
        return array_key_exists($optionCode, $this->defaultOptions) ? $this->defaultOptions[$optionCode] : '';
    }

    public function prepareExcludedErrorsOption(): array
    {
        return [
            0 => 'UNCAUGHT_EXCEPTION',
            1 => 'CAUGHT_EXCEPTION',
            2 => 'IGNORED_ERROR',
            3 => 'LOW_PRIORITY_ERROR',
            4 => 'ASSERTION',
            5 => 'FATAL',
        ];
    }

    public function get(string $optionCode)
    {
        return array_key_exists($optionCode, $this->settings) ? $this->settings[$optionCode] : '';
    }

    private function __clone() {}

    private function __wakeup() {}
}