<?php
require_once __DIR__ . '/../config/db.php';

class CustomerController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // ✅ Create Customer
    public function createCustomer($name, $code, $company_name, $status) {
        $sql = "INSERT INTO customers (name, code, company_name, status) VALUES (:name, :code, :company_name, :status)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':name' => $name,
            ':code' => $code,
            ':company_name' => $company_name,
            ':status' => $status
        ]);
    }

    // ✅ Get Customer by ID
    public function getCustomer($id) {
        $stmt = $this->pdo->prepare("SELECT id, name, code, company_name, status FROM customers WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // ✅ Update Customer
    public function updateCustomer($id, $name, $code, $company_name, $status) {
        $sql = "UPDATE customers SET name = :name, code = :code, company_name = :company_name, status = :status, updated_at = NOW() WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':name' => $name,
            ':code' => $code,
            ':company_name' => $company_name,
            ':status' => $status
        ]);
    }

    // ✅ Delete Customer
    public function deleteCustomer($id) {
        $stmt = $this->pdo->prepare("DELETE FROM customers WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    // ✅ Check if Code is Unique
    public function isCodeUnique($code) {
        $stmt = $this->pdo->prepare("SELECT id FROM customers WHERE code = :code ");
        $stmt->execute([':code' => $code]);
        return $stmt->rowCount() === 0;
    }
}
?>
