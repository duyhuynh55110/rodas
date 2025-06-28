<?php

namespace App\Libs\Loggers;

use Monolog\Formatter\LineFormatter;

/**
 * LogFormatter class
 */
class LogFormatter
{
    /**
     * Length of request ID
     *
     * @var int
     */
    const LOGGING_UID_LENGTH = 10;

    /**
     * Format of log line
     *
     * @var string
     */
    const LOG_FORMAT = "[%datetime%][%uuid%] %channel%.%level_name%: %message% %context% %extra%\n";

    /**
     * Uid
     *
     * @var string
     */
    private $uid;

    /**
     * __construct
     */
    public function __construct(\Illuminate\Http\Request $request)
    {
        $this->uid = $this->generateUid(self::LOGGING_UID_LENGTH);
    }

    /**
     * Customize the given logger instance.
     *
     * @param  \Illuminate\Log\Logger  $logger
     * @return void
     */
    public function __invoke($logger)
    {
        collect($logger->getHandlers())->each(
            function ($handler) {
                $handler->setFormatter($this->getLogFormatter());
            }
        );
    }

    /**
     * Log formatter
     *
     * @return mixed
     */
    protected function getLogFormatter()
    {
        $format = str_replace('%uuid%', $this->uid, self::LOG_FORMAT);

        return new LineFormatter($format, null, true, true);
    }

    /**
     * Get uid
     *
     * @return string
     */
    public function getUid(): string
    {
        return $this->uid;
    }

    /**
     * Reset uid
     *
     * @return void
     */
    public function reset()
    {
        $this->uid = $this->generateUid(strlen($this->uid));
    }

    /**
     * Generate uid
     *
     * @param  int  $length
     * @return string
     */
    private function generateUid(int $length): string
    {
        return substr(bin2hex(random_bytes((int) ceil($length / 2))), 0, $length);
    }
}
