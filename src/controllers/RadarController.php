<?php
/**
 * NavStrike - Radar Controller
 *
 * Handles radar operations, contact tracking, and remote sensor feeds.
 */

class RadarController {
    /**
     * Display local radar contacts
     */
    public function scan() {
        global $conn;
        $sector = $_GET['sector'] ?? 'all';
        $query = "SELECT * FROM radar_contacts WHERE sector = '" . $sector . "' ORDER BY distance ASC";
        $results = mysqli_query($conn, $query);
        include __DIR__ . '/../../templates/radar.php';
    }

    /**
     * Load remote sensor configuration
     */
    public function scanRemote() {
        $sensorData = $_GET['sensor_data'];
        $config = unserialize($sensorData);
        echo "<h2>Configuration capteur</h2>";
        echo "<pre>" . print_r($config, true) . "</pre>";
    }
}
