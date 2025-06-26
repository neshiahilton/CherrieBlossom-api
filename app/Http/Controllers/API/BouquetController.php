<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Bouquet; // Ganti dari Book ke Bouquet
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BouquetController extends Controller
{
    /**
     * Menampilkan semua data buket.
     */
    public function index()
    {
        $bouquets = Bouquet::all();
        return response()->json([
            'message' => 'Data retrieved successfully',
            'data' => $bouquets
        ], 200);
    }

    /**
     * Menyimpan data buket baru.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|unique:bouquets|max:255', // Disesuaikan untuk buket
                'price' => 'required|numeric|min:0',             // Disesuaikan untuk buket
                'stock' => 'required|integer|min:0',             // Disesuaikan untuk buket
                'description' => 'nullable|string',              // Disesuaikan untuk buket
            ]);

            if ($validator->fails()) {
                throw new HttpException(400, $validator->messages()->first());
            }

            $bouquet = new Bouquet;
            // Menggunakan fill untuk mengisi data dari $fillable di Model
            $bouquet->fill($request->all())->save();

            return response()->json([
                'message' => 'Saved successfully',
                'data' => $bouquet
            ], 201); // 201 Created lebih cocok untuk store

        } catch (\Exception $e) {
            // Menggunakan getMessage() untuk error yang lebih spesifik
            throw new HttpException(400, "Invalid data - {$e->getMessage()}");
        }
    }

    /**
     * Menampilkan satu data buket spesifik.
     */
    public function show(string $id)
    {
        $bouquet = Bouquet::findOrFail($id);
        return response()->json([
            'message' => 'Data detail retrieved successfully',
            'data' => $bouquet
        ], 200);
    }

    /**
     * Mengubah data buket yang sudah ada.
     */
    public function update(Request $request, string $id)
    {
        $bouquet = Bouquet::findOrFail($id);

        try {
            $validator = Validator::make($request->all(), [
                // unique harus mengabaikan data saat ini
                'name' => 'required|string|unique:bouquets,name,'.$id.'|max:255',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'description' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                throw new HttpException(400, $validator->messages()->first());
            }

            $bouquet->fill($request->all())->save();

            return response()->json([
                'message' => 'Updated successfully',
                'data' => $bouquet
            ], 200);

        } catch (\Exception $e) {
            throw new HttpException(400, "Invalid data - {$e->getMessage()}");
        }
    }

    /**
     * Menghapus data buket.
     */
    public function destroy(string $id)
    {
        $bouquet = Bouquet::findOrFail($id);
        $bouquet->delete(); // Ini akan melakukan soft delete

        return response()->json([
            'message' => 'Deleted successfully'
        ], 200);
    }
}