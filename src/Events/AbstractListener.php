<?php

namespace WHMCS\Module\Framework\Events;

use ErrorException;
use WHMCS\Module\Framework\Helper;

abstract class AbstractListener
{
    protected $name;

    protected $priority = 0;

    protected $registered = false;

    public static function build()
    {
        return new static();
    }

    abstract protected function execute(array $args = null);

    abstract public function register();

    /**
     * Get event
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set event

*
*@param string $name
     * @return $this
     * @throws ErrorException
     */
    public function setName($name)
    {
        if (empty(trim((string) $name))) {
            throw new ErrorException('Hook name cannot be empty!');
        }
        $this->name = $name;

        return $this;
    }

    /**
     * Get priority
     *
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set priority
     *
     * @param int $priority
     * @return $this
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    public function callHandler(array $args)
    {
        return $this->execute($args);
    }

    // --- Shortcuts

    public function db()
    {
        return Helper::db();
    }

    public function api($method, array $data)
    {
        return Helper::api($method, $data);
    }
}