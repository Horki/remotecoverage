<?php

/**
 * Class Some
 *
 * I'm not getting any coverage
 */
class Some
{
    /**
     * @var string
     */
    private $name;

    /**
     * Some constructor.
     */
    public function __construct()
    {
        $this->name = 'This class is useless';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
