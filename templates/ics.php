<?php header('Content-type: text/calendar; charset=utf-8'); ?>
<?php header("Content-Disposition: inline; filename={$page->slug()}.ics"); ?>
<?= "BEGIN:VCALENDAR\r\n" ?>
<?= "VERSION:2.0\r\n" ?>
<?= "PRODID:-//" . $site->url() . "//Kirby Calendar Plugin//" . str::upper($site->language()->code()) . "\r\n" ?>
<?= "CALSCALE:GREGORIAN\r\n" ?>
<?= "METHOD:PUBLISH\r\n" ?>
<?php foreach ($page->siblings($self = false) as $key => $sibling): ?>
<?php if ($sibling->calendar()->isNotEmpty()): ?>
<?php $calendar = calendar($sibling->calendar()->yaml()); ?>
<?php foreach ($calendar->getAllEvents() as $event): ?>
<?= "BEGIN:VEVENT\r\n" ?>
<?= "DTSTART:" . gmdate('Ymd\THis\Z', $event->getBeginTimestamp()) . "\r\n" ?>
<?= "DTEND:" . gmdate('Ymd\THis\Z', $event->getEndTimestamp()) . "\r\n" ?>
<?= "UID:" . $sibling->hash() . '-' . base_convert(sprintf('%u', crc32($event->getBeginTimestamp())), 10, 36) . "\r\n" ?>
<?= "DTSTAMP:" . gmdate('Ymd\THis\Z', $event->getBeginTimestamp()) . "\r\n" ?>
<?= "LOCATION:" . $event->getField('location') . "\r\n" ?>
<?= "DESCRIPTION:" . $event->getField('description') . "\r\n" ?>
<?= "SUMMARY:" . $event->getField('summary') . "\r\n"?>
<?= "END:VEVENT\r\n" ?>
<?php endforeach; ?>
<?php endif ?>
<?php endforeach; ?>
<?= "END:VCALENDAR\r\n" ?>