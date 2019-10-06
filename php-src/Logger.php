<?php declare(strict_types=1);

namespace Eplightning\RoadRunnerLogger;

use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;
use Spiral\Goridge\RPC;
use DateTime;

class Logger extends AbstractLogger
{
    /**
     * @var RPC
     */
    protected $rpc;

    /**
     * @param RPC $rpc
     */
    public function __construct(RPC $rpc)
    {
        $this->rpc = $rpc;
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed  $level
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function log($level, $message, array $context = [])
    {
        if (!empty($context)) {
            $context = ['context' => $context];
        }

        $this->sendLog($this->convertLevel($level), $message, $context);
    }

    /**
     * Send log to RoadRunner
     * 
     * This method allows for more customization of log messages sent to RoadRunner
     * 
     * @param string $level
     * @param string $message
     * @param array $fields
     * @param string|null $timestamp
     * @throws Spiral\Goridge\Exceptions\RelayException
     * @throws Spiral\Goridge\Exceptions\ServiceException
     */
    public function sendLog(string $level, string $message, array $fields = [], $timestamp = null)
    {
        $request = [
            'level' => $level,
            'message' => $message,
            'timestamp' => $timestamp ?? $this->currentTimestamp()
        ];

        if (!empty($fields)) {
            $request['fields'] = $fields;
        }

        $this->rpc->call('logger.Line', $request);
    }

    /**
     * Convert PSR3 log level to Logrus log level
     * 
     * @param mixed $level
     * @return string
     */
    protected function convertLevel($level): string
    {
        switch ($level) {
            case LogLevel::EMERGENCY:
            case LogLevel::ALERT:
            case LogLevel::CRITICAL:
                return 'fatal';

            case LogLevel::ERROR:
                return 'error';

            case LogLevel::WARNING:
                return 'warning';

            case LogLevel::NOTICE:
            case LogLevel::INFO:
                return 'info';

            case LogLevel::DEBUG:
                return 'debug';

            default:
                return 'info';
        }
    }

    /**
     * Get current timestamp in RFC3339 format
     * 
     * @return string
     */
    protected function currentTimestamp(): string
    {
        $t = new DateTime;

        return $t->format(DateTime::RFC3339_EXTENDED);
    }
}
