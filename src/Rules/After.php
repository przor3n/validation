<?php

namespace Rakit\Validation\Rules;

use Rakit\Validation\Rule;

class After extends Rule
{

    use DateUtils;

    /** @var string */
    protected $message = "The :attribute must be a date after :time.";

    /** @var array */
    protected $fillableParams = ['time'];

    /**
     * Check the value is valid
     *
     * @param mixed $value
     * @return mixed
     * @throws Exception
     */
    public function check($value)
    {
        $this->requireParameters($this->fillableParams);
        $time = $this->parameter('time');

        if (!$this->isValidDate($value)) {
            throw $this->throwException($value);
        }

        if (!$this->isValidDate($time)) {
            throw $this->throwException($time);
        }

        return $this->getTimeStamp($time) < $this->getTimeStamp($value);
    }
}
