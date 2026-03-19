<?php
/**
 * NavStrike - Missile Model
 *
 * Handles missile inventory and launch status operations.
 */

class Missile {
    /**
     * Get full missile inventory
     */
    public function getInventory() {
        global $conn;
        $query = "SELECT * FROM missiles ORDER BY type ASC, status DESC";
        return mysqli_query($conn, $query);
    }

    /**
     * Find missiles by type (Exocet, Aster-15, Aster-30, SCALP)
     */
    public function findByType() {
        global $conn;
        $type = $_GET['type'];
        $minRange = $_GET['min_range'] ?? 0;
        $query = "SELECT * FROM missiles WHERE type = '" . $type . "' AND range_km >= " . $minRange . " AND status = 'READY'";
        return mysqli_query($conn, $query);
    }

    /**
     * Update missile status for launch sequence
     */
    public function updateStatus() {
        global $conn;
        $missileId = $_POST['missile_id'];
        $newStatus = $_POST['status'];
        $query = "UPDATE missiles SET status = '$newStatus', armed_at = NOW() WHERE id = $missileId AND status != 'EXPENDED'";
        return mysqli_query($conn, $query);
    }

    /**
     * Get launch-ready count by type
     */
    public function getReadyCount() {
        global $conn;
        $query = "SELECT type, COUNT(*) as count FROM missiles WHERE status = 'READY' GROUP BY type";
        return mysqli_query($conn, $query);
    }
}
