<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceRumputLautModel extends Model
{
    protected $table            = 'invoice_rumputlaut';
    protected $primaryKey       = 'kode_invoice';
    protected $useAutoIncrement = false; // Karena kode_invoice bukan auto increment
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_invoice', 'namapemanen', 'harga', 'jumlah_upah', 'created_at', 'delete_mark','jumlah'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;


    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = null; // Tidak menggunakan soft delete

    public function generateKodeInvoice(): string
    {
        do {
            // Ambil kode_invoice terakhir
            $lastInvoice = $this->select('kode_invoice')
                                ->orderBy('kode_invoice', 'DESC')
                                ->limit(1)
                                ->get()
                                ->getRowArray();
    
            if ($lastInvoice && preg_match('/INVRMPLT(\d+)/', $lastInvoice['kode_invoice'], $matches)) {
                $nextNumber = (int)$matches[1] + 1;
            } else {
                $nextNumber = 1;
            }
    
            // Format kode_invoice baru
            $newKodeInvoice = 'INVRMPLT' . str_pad($nextNumber, 10, '0', STR_PAD_LEFT);
    
            // Periksa apakah kode sudah ada di database
            $exists = $this->where('kode_invoice', $newKodeInvoice)->countAllResults() > 0;
    
        } while ($exists); // Ulangi jika kode sudah ada
    
        return $newKodeInvoice;
    }
    
    
    

    
}
