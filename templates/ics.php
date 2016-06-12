<?php header('Content-type: text/calendar; charset=utf-8'); ?>
<?php header("Content-Disposition: inline; filename={$page->slug()}.ics"); ?>
<?= "BEGIN:VCALENDAR\n\r" ?>
<?= "VERSION:2.0\n\r" ?>
<?= "PRODID:-//" . $site->url() . "//Kirby Calendar Plugin//" . str::upper($site->language()->code()) . "\n\r" ?>
<?= "CALSCALE:GREGORIAN\n\r" ?>
<?php if ($page->calendar_color()->isNotEmpty()): ?>
<?= "X-APPLE-CALENDAR-COLOR:#{$page->calendar_color()->or('1BADF8')}\n\r" ?>
<?php endif ?>
<?php if ($page->calendar_timezone()->isNotEmpty()): ?>
<?php $timezone_offset = 3600 * (floatval($page->calendar_timezone()->value) + date("I")) ?>
<?php else: ?>
<?php $timezone_offset = 0 ?>
<?php endif; ?>
<?php foreach ($page->siblings($self = false) as $key => $sibling): ?>
<?php if ($sibling->calendar()->isNotEmpty()): ?>
<?php $calendar = calendar($sibling->calendar()->yaml()); ?>
<?php foreach ($calendar->getAllEvents() as $event): ?>
<?= "BEGIN:VEVENT\n\r" ?>
<?= "DTSTART:" . gmdate('Ymd\THis\Z', $event->getBeginTimestamp() + $timezone_offset) . "\n\r" ?>
<?= "DTEND:" . gmdate('Ymd\THis\Z', $event->getEndTimestamp() + $timezone_offset) . "\n\r" ?>
<?= "UID:" . $sibling->hash() . '-' . base_convert(sprintf('%u', crc32($event->getBeginTimestamp())), 10, 36) . "\n\r" ?>
<?= "DTSTAMP:" . gmdate('Ymd\THis\Z', $event->getBeginTimestamp() + $timezone_offset) . "\n\r" ?>
<?= "LOCATION:" . $event->getField('location') . "\n\r" ?>
<?= "DESCRIPTION:" . $event->getField('description') . "\n\r" ?>
<?= "SUMMARY:" . $event->getField('summary') . "\n\r"?>
<?= "END:VEVENT\n\r" ?>
<?php endforeach; ?>
<?php endif ?>
<?php endforeach; ?>
<?= "END:VCALENDAR\n\r" ?>