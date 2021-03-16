<?php

declare(strict_types=1);

namespace Ngmy\PharExtractor\Console;

use Ngmy\Observer\Observer;
use Ngmy\Observer\Subject;
use Ngmy\PharExtractor\Phars;
use Symfony\Component\Console\Style\SymfonyStyle;

class ProgressObserver implements Observer
{
    /** @var int */
    private $state;
    /** @var Phars */
    private $subject;
    /** @var SymfonyStyle */
    private $io;

    public function __construct(Phars $subject, SymfonyStyle $io)
    {
        $this->state = $subject->count();
        $this->subject = $subject;
        $this->subject->attach($this);
        $this->io = $io;
        $this->io->progressStart($this->state);
    }

    public function update(Subject $changedSubject): void
    {
        if ($this->subject === $changedSubject) {
            $progress = $this->state - $this->subject->count();
            $this->io->progressAdvance($progress);
            $this->state = $this->subject->count();
            if ($this->state == 0) {
                $this->io->progressFinish();
            }
        }
    }

    /**
     * @var mixed
     */
    public function equals($other): bool
    {
        return $other === $this;
    }
}
