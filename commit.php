<?php
date_default_timezone_set('UTC');

// Number of commits
$commitCount = 46;
$baseFile = "autocommit.txt";

// Today's base date
$baseDate = date('Y-m-d');

// Make 43 commits
for ($i = 0; $i < $commitCount; $i++) {
    // Vary the time by adding minutes/seconds
    $time = date("H:i:s", strtotime("+$i minutes", strtotime("00:00:00")));
    $commitDate = "$baseDate $time";
    $formattedDate = date('Y-m-d\TH:i:s', strtotime($commitDate));

    // Update file content
    file_put_contents($baseFile, "Commit #$i at $commitDate\n", FILE_APPEND);

    // Stage the change
    exec("git add $baseFile");

    // Set env variables
    $env = "GIT_AUTHOR_DATE=\"$formattedDate\" GIT_COMMITTER_DATE=\"$formattedDate\"";

    // Make commit
    $message = "Auto commit #$i on $commitDate";
    exec("$env git commit -m \"$message\"");

    echo "Committed #$i at $formattedDate\n";
}

echo "✅ $commitCount commits made for today ($baseDate).\n";
