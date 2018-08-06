<?php
include './src/TextMessage.php';

$signal = new \Signal\TextMessage('username', 'password', '+98simcard');

/**
 * Get credit
 */
$credit = $signal->credit();

/**
 * Send Message
 */
$signal->send("Welcome to SIGNAL", ["091...", "093...", "..."]);

/**
 * Send Multi Message
 */
$signal->sendMulti([
    "Text message 1",
    "Text message 2",
    "..."
], [
    "09 PhoneNumber for text message 1",
    "09 PhoneNumber for text message 2",
    "..."
]);

/**
 * Get message status
 */
$signal->status(["messageId1","messageId2","..."]);