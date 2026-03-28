<?php


declare(strict_types=1);

namespace Marktic\Embeddable\Widgets\Behaviours;

trait HasSubject
{
    protected $subject;

    public function setSubject($subject): self
    {
        $this->subject = $subject;
        return $this;
    }

    public function getSubject()
    {
        return $this->subject;
    }
}

