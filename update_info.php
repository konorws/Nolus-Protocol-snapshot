<?php

require_once __DIR__. '/vendor/autoload.php';

$snapshot = new \App\Snapshot();

// Parse date
$contentForParse = file_get_contents('https://services.kjnodes.com/home/testnet/nolus/snapshot');

$document = new \DiDom\Document($contentForParse);
$spanElements = $document->find("span");

$indexBlocks = null;
foreach ($spanElements as $i => $element) {
    $text = $element->text();

    if(str_starts_with($text, ": v")) {
        $snapshot->setVersion($text);
        $indexBlocks = $i + 1;
    }

    if(is_int($indexBlocks) && $i === $indexBlocks) {
        $snapshot->setBlocks((int)$text);
        break;
    }
}

$snapshotFile = __DIR__."/public/snapshot/latest.tar.lz4";
if(!file_exists($snapshotFile)) {
    die("Snapshot file dont exists, Run 'sh ./script/download.sh {folder_script}'");
}

$size = filesize($snapshotFile);
$snapshot->setSize($size);
$snapshot->setUpdateTime(new DateTime());

$snapshot->save();

echo "DONE";
