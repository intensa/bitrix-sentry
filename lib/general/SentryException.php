<?php

namespace Intensa\Sentry;

use Bitrix\Main\Config\Configuration;
use Bitrix\Main\Diag\ExceptionHandlerLog;
use Bitrix\Main\Loader;

use function Sentry\captureException;
use function Sentry\init;

class SentryException extends ExceptionHandlerLog
{
    public int $errorLevel = 4437;
    public array $ignoredErrors = [];

    public function write($exception, $logType)
    {
        if (in_array($logType, $this->ignoredErrors)) {
            return;
        }

        $this->sendToSentry($exception);
    }

    public function initialize(array $options)
    {
        if (!Loader::includeModule('intensa.sentry')) {
            return;
        }

        $this->errorLevel = $this->getSettingsErrorLevel();
        $this->ignoredErrors = $this->getIgnoredErrorTypes();
        $this->initSentry();
    }

    public function initSentry(): void
    {
        $environment = $this->getEnvironment() ?? 'local';
        $dsn = $this->getDsn() ?? '';

        if ($environment === 'local' || !function_exists('Sentry\init') || !$dsn) {
            return;
        }

        init([
            'dsn' => $dsn,
            'environment' => $environment,
            'error_types' => $this->errorLevel
        ]);
    }

    public function sendToSentry(\Throwable $exception): void
    {
        captureException($exception);
    }

    public function getIgnoredErrorTypes()
    {
        $errorTypes = Options::getInstance()->get('EXCLUDED_ERRORS');

        return $errorTypes ? explode(',', $errorTypes) : [];
    }

    public function getEnvironment()
    {
        return Options::getInstance()->get('ENVIRONMENT') ?? $_ENV['SENTRY_MODE'];
    }

    public function getDsn()
    {
        return Options::getInstance()->get('DSN') ?? $_ENV['SENTRY_DSN'];
    }

    public function getSettingsErrorLevel(): int
    {
        $exceptionHandling = Configuration::getValue('exception_handling');

        return $exceptionHandling['handled_errors_types'] ?? 4437;
    }
}