<?php
/**
 * NavStrike - Report Helper
 *
 * Generates mission reports and tactical exports.
 */

class ReportHelper {
    /**
     * Export mission report to specified format
     */
    public function exportReport($missionId, $format) {
        $outputFile = "/tmp/mission_report_" . $missionId;
        $command = "wkhtmltopdf /var/www/html/reports/" . $missionId . ".html " . $outputFile . "." . $format;
        $handle = popen($command, 'r');
        $output = fread($handle, 4096);
        pclose($handle);
        echo "<p>Rapport exporte : " . $outputFile . "." . $format . "</p>";
    }

    /**
     * Generate tactical summary
     */
    public function generateSummary($missionId) {
        global $conn;
        $query = "SELECT * FROM missions WHERE id = " . intval($missionId);
        $result = mysqli_query($conn, $query);
        $mission = mysqli_fetch_assoc($result);

        $summary = "RAPPORT TACTIQUE - Mission: " . ($mission['name'] ?? 'N/A') . "\n";
        $summary .= "Date: " . date('Y-m-d H:i:s') . "\n";
        $summary .= "Zone: " . ($mission['zone'] ?? 'N/A') . "\n";
        return $summary;
    }
}
