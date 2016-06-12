<?php header('Content-type: text/calendar; charset=utf-8'); ?>
<?php header("Content-Disposition: inline; filename={$page->slug()}.ics"); ?>
<?= "BEGIN:VCALENDAR\n\r" ?>
<?= "VERSION:2.0\n\r" ?>
<?= "PRODID:-//" . $site->url() . "//Kirby Calendar Plugin//" . str::upper($site->language()->code()) . "\n\r" ?>
<?= "CALSCALE:GREGORIAN\n\r" ?>
<?php if ($page->calendar_color()->isNotEmpty()): ?>
<?= "X-APPLE-CALENDAR-COLOR:#{$page->calendar_color->or('1BADF8')}\n\r" ?>
<?php endif ?>
<?= "X-WR-TIMEZONE:Europe/Zurich\n\r" ?>
<?= "BEGIN:VTIMEZONE\n\r" ?>
<?= "TZID:Europe/Zurich\n\r" ?>
<?= "BEGIN:DAYLIGHT\n\r" ?>
<?= "TZOFFSETFROM:+0100\n\r" ?>
<?= "RRULE:FREQ=YEARLY;BYMONTH=3;BYDAY=-1SU\n\r" ?>
<?= "DTSTART:19810329T020000\n\r" ?>
<?= "TZNAME:MESZ\n\r" ?>
<?= "TZOFFSETTO:+0200\n\r" ?>
<?= "END:DAYLIGHT\n\r" ?>
<?= "BEGIN:STANDARD\n\r" ?>
<?= "TZOFFSETFROM:+0200\n\r" ?>
<?= "RRULE:FREQ=YEARLY;BYMONTH=10;BYDAY=-1SU\n\r" ?>
<?= "DTSTART:19961027T030000\n\r" ?>
<?= "TZNAME:MEZ\n\r" ?>
<?= "TZOFFSETTO:+0100\n\r" ?>
<?= "END:STANDARD\n\r" ?>
<?= "END:VTIMEZONE\n\r" ?>
<?= "METHOD:PUBLISH\n\r" ?>
<?php foreach ($page->siblings($self = false) as $key => $sibling): ?>
<?php if ($sibling->calendar()->isNotEmpty()): ?>
<?php $calendar = calendar($sibling->calendar()->yaml()); ?>
<?php foreach ($calendar->getAllEvents() as $event): ?>
<?= "BEGIN:VEVENT\n\r" ?>
<?= "DTSTART:" . gmdate('Ymd\THis\Z', $event->getBeginTimestamp()) . "\n\r" ?>
<?= "DTEND:" . gmdate('Ymd\THis\Z', $event->getEndTimestamp()) . "\n\r" ?>
<?= "UID:" . $sibling->hash() . '-' . base_convert(sprintf('%u', crc32($event->getBeginTimestamp())), 10, 36) . "\n\r" ?>
<?= "DTSTAMP:" . gmdate('Ymd\THis\Z', $event->getBeginTimestamp()) . "\n\r" ?>
<?= "LOCATION:" . $event->getField('location') . "\n\r" ?>
<?= "DESCRIPTION:" . $event->getField('description') . "\n\r" ?>
<?= "SUMMARY:" . $event->getField('summary') . "\n\r"?>
<?= "END:VEVENT\n\r" ?>
<?php endforeach; ?>
<?php endif ?>
<?php endforeach; ?>
<?= "END:VCALENDAR\n\r" ?>