<?php

namespace App\Imports;

use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;

class ProductImport implements ToCollection, WithHeadingRow
{
    use Importable;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $nameProvider = trim($row['provider']);
            $nameProduct = trim($row['product']);
            $provider = Proveedor::whereRaw('LOWER(`nombre`) = ?', [strtolower($nameProvider)])->first();
            if (!$provider) {
                $provider = Proveedor::create([
                    'nombre' => $nameProvider,
                ]);
            }

            $product = Producto::whereRaw('LOWER(`nombre`) = ? and proveedor_id = ?', [strtolower($nameProduct), $provider->id])->first();
            if (!$product) {
                Producto::create([
                    'proveedor_id' => $provider->id,
                    'nombre' => $nameProduct,
                    'precio_compra' => floatval($row['purchase_price']),
                    'precio_venta' => floatval($row['price_sale']),
                ]);
            } else {
                $product->update([
                    'precio_compra' => floatval($row['purchase_price']),
                    'precio_venta' => floatval($row['price_sale']),
                    'fecha_modificacion' => now()
                ]);
            }
        }
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function headingRow(): int
    {
        return 1;
    }
}
