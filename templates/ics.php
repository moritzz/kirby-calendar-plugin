<?php header('Content-type: text/calendar; charset=utf-8'); ?>
<?php header("Content-Disposition: inline; filename={$page->slug()}.ics"); ?>
<?= "BEGIN:VCALENDAR\n\r" ?>
<?= "VERSION:2.0\n\r" ?>
<?= "PRODID:-//" . $site->url() . "//Kirby Calendar Plugin//". str::upper($site->language()->code()); . "\n\r" ?>
<?= "CALSCALE:GREGORIAN\n\r" ?>
<?= "METHOD:PUBLISH\n\r" ?>
<?php foreach ($page->siblings($self = false) as $key => $sibling): ?>
<?php if ($sibling->calendar()->isNotEmpty()): ?>
<?php $calendar = calendar($sibling->calendar()->yaml()); ?>
<?php foreach ($calendar->getAllEvents() as $event): ?>
<?= "BEGIN:VEVENT\n\r" ?>
<?= "DTSTART:" . gmdate('Ymd\THis\Z', $event->getBeginTimestamp()) . "\n\r" ?>
<?= "DTEND:" . gmdate('Ymd\THis\Z', $event->getEndTimestamp()) . "\n\r" ?>
<?= "UID:" . $sibling->hash() . '-' . base_convert(sprintf('%u', crc32($event->getBeginTimestamp())), 10, 36) . "\n\r" ?>
<?= "DTSTAMP:" gmdate('Ymd\THis\Z', $event->getBeginTimestamp()) . "\n\r" ?>
<?= "LOCATION:" . $event->getField('location') . "\n\r" ?>
<?= "DESCRIPTION:" . $event->getField('description') . "\n\r" ?>
<?= "SUMMARY:" . $event->getField('summary') . "\n\r"?>
<?= "END:VEVENT\n\r" ?>
<?php endforeach; ?>
<?php endif ?>
<?php endforeach; ?>
<?= "END:VCALENDAR\n\r" ?>
<?php die(); ?>