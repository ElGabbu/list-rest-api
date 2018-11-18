<?php
declare(strict_types=1);

namespace ListRestAPI\Listener;


use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Process\Process;

class KernelResponseLoadFixturesListener
{
    /** @var KernelInterface */
    private $kernel;

    /**
     * @param KernelInterface $kernel
     */
    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @param FilterResponseEvent $event
     *
     * @throws \Exception
     */
    public function onKernelResponse(FilterResponseEvent $event): void
    {
        if ('dev' !== getenv('APP_ENV')) {
            return;
        }

        $process = new Process($this->kernel->getRootDir() . '/../bin/console doctrine:fixtures:load -n');
        $process->run();
    }
}
