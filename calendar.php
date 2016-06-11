<?php 

// =======================
// = Component Registery =
// =======================

$kirby->set('blueprint', 'calendar', __DIR__ . '/blueprints/calendar.php');
$kirby->set('blueprint', 'calendars', __DIR__ . '/blueprints/calendars.php');
$kirby->set('template', 'calendars', __DIR__ . '/templates/calendars.php');
$kirby->set('snippet', 'calendar-div', __DIR__ . '/snippets/calendar-div.php');
$kirby->set('snippet', 'calendar-ical-head', __DIR__ . '/snippets/calendar-ical-head.php');
$kirby->set('snippet', 'calendar-ical-event', __DIR__ . '/snippets/calendar-ical-event.php');
$kirby->set('snippet', 'calendar-table', __DIR__ . '/snippets/calendar-table.php');
$kirby->set('snippet', 'calendar-teaser', __DIR__ . '/snippets/calendar-teaser.php');

// ======================
// = Calendar Initation =
// ======================

if (!class_exists('Calendar'))  require_once('lib/Calendar.php');
if (!class_exists('Event')) require_once('lib/Event.php');

function calendar($events = array()) {
  try {
    return new Calendar($events);
  } catch (Exception $e) {
    print "<strong>The calendar plugin threw an error</strong><br>" .
      $e->getMessage();
  }
}