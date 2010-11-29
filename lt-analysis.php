<?php

/**
 * Build tag map:
 */
$tags = fopen("Babelglossary.csv", "r");
$tagmap = array();
while ($row = fgetcsv($tags)) {
    $tagmap[$row[0]] = $row[2];
}
fclose($tags);

/**
 * Build a table from Lithuanian cables:
 */
$lt_cables = fopen("lt-cables.csv", "r");
$table = array();
while($row = fgetcsv($lt_cables)) {
    $tags = explode(",", $row[2]);
    foreach($tags as $k => $tag) {
        $tag = trim($tag);
        $tags[$k] = @$tagmap[$tag] ? $tagmap[$tag] : $tag;
    }
    $row[2] = $tags;
    array_push($table, $row);
}
fclose($lt_cables);

/**
 * Output HTML for the table:
 */
echo '<h1>Analysis of documents related to Lithuania from WikiLeaks Cablegate</h1>';
echo '<fieldset><legend>README</legend><pre>';
readfile("README");
echo '</pre></fieldset>';
echo '<table border="1"><thead><tr><th>Time</th><th>Origin</th><th>Tags</th></tr></thead><tbody>';
echo "\n";
foreach ($table as $row) {
    echo '<tr>';
    echo '<td>' . $row[0] . '</td>';
    echo '<td>' . $row[1] . '</td>';
    echo '<td>' . implode('<br>', $row[2]) . '</td>';
    echo "</tr>\n";
}
echo '</tbody></table>';
