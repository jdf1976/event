<?php

namespace App\EventSubscriber;

use App\Repository\BookingRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CalendarSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private BookingRepository $bookingRepository,
        private UrlGeneratorInterface $router
    )
    {}
    public function onCalendar($event): void
    {
        // ...
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'Calendar' => 'onCalendar',
        ];
    }
}
