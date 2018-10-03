<?php

$requestMethod = $_SERVER['REQUEST_METHOD'];

if ('POST' !== $requestMethod) {
  exit('Unsupported method!');
}

$input = fopen('php://input', 'r');

$filename = tempnam('/tmp', 'html-to-pdf.');
$temp = fopen($filename, 'w');

stream_copy_to_stream($input, $temp);

passthru(sprintf('/usr/bin/pandoc %1$s --from html --to latex --variable geometry:margin=2cm --variable papersize:A4 --output %1$s.pdf', $filename));

$pdf = fopen($filename . '.pdf', 'rb');

$output = fopen('php://output', 'wb');

stream_copy_to_stream($pdf, $output);

fclose($input);
fclose($temp);
fclose($pdf);
fclose($output);

foreach (glob("/tmp/html-to-pdf.*") as $tmp) {
    unlink($tmp);
}
