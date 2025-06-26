<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Bouquet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;
use OpenApi\Annotations as OA;

/**
 * Classs BouquetController.
 * 
 * @author Neshia Hilton <taneshia.422024002@civitas.ukrida.ac.id>
 * 
 */

class BouquetController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/bouquet",
     * tags={"Bouquet"},
     * summary="Display a list of all bouquets",
     * operationId="index",
     * @OA\Response(
     *      response=200,
     *      description="Successful",
     *      @OA\JsonContent()
     *    )
     * )
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
     * @OA\Post(
     *      path="/api/bouquet",
     *      tags={"Bouquet"},
     *      summary="Store a new bouquet",
     *      operationId="storeBouquet",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Bouquet object that needs to be added to the store",
     *          @OA\JsonContent(ref="#/components/schemas/Bouquet")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Bouquet created successfully"
     *      ),
     *      @OA\Response(
     *          response=400,
     *      description="Invalid data provided"
     *      )
     * )
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
     * @OA\Get(
     *      path="/api/bouquet/{id}",
     *      tags={"Bouquet"},
     *      summary="Display a specific bouquet",
     *      operationId="show",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of bouquet to return",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Bouquet")
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Invalid ID supplied"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Bouquet not found"
     *      )
     * )
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
     * @OA\Put(
     *      path="/api/bouquet/{id}",
     *      tags={"Bouquet"},
     *      summary="Update an existing bouquet",
     *      operationId="updateBouquet",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of bouquet that needs to be updated",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\RequestBody(
     *              description="Bouquet object that needs to be updated",
     *              required=true,
     *              @OA\JsonContent(ref="#/components/schemas/Bouquet")
     *      ),
     *      @OA\Response(
     *              response=200,
     *              description="Successful operation",
     *              @OA\JsonContent(ref="#/components/schemas/Bouquet")
     *      ),
     *      @OA\Response(
     *              response=400,
     *              description="Invalid data supplied"
     *      ),
     *      @OA\Response(
     *              response=404,
     *              description="Bouquet not found"
     *      )
     * )
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
     * @OA\Delete(
     *      path="/api/bouquet/{id}",
     *      tags={"Bouquet"},
     *      summary="Delete a bouquet",
     *      operationId="deleteBouquet",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of bouquet to be deleted",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *      response=204,
     *      description="Successful, no content"
     *      ),
     *      @OA\Response(
     *      response=400,
     *      description="Invalid ID supplied"
     *      ),
     *      @OA\Response(
     *      response=404,
     *      description="Bouquet not found"
     *      )
     * )
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