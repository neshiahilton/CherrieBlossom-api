<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\Bouquet;
use OpenApi\Annotations as OA;

/**
 * Class BouquetController.
 *
 * @author Neshia Hilton <taneshia.422024002@civitas.ukrida.ac.id>
 */
class BouquetController extends Controller
{
    /**
 * @OA\Get(
 *     path="/api/bouquet",
 *     tags={"bouquet"},
 *     summary="Display a listing of items",
 *     operationId="index",
 *     @OA\Response(
 *         response=200,
 *         description="successful",
 *         @OA\JsonContent()
 *     ),
 *     @OA\Parameter(
 *         name="_page",
 *         in="query",
 *         description="current page",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64",
 *             example=1
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="_limit",
 *         in="query",
 *         description="max item in a page",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64",
 *             example=10
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="_search",
 *         in="query",
 *         description="search by bouquet name or type",
 *         required=false,
 *         @OA\Schema(
 *             type="string", example="Rose")
 *     ),
 *      @OA\Parameter(
 *         name="_category",
 *         in="query",
 *         description="Search bouquets by category (e.g., Valentine, Anniversary, etc.)",
 *         required=false,
 *         @OA\Schema(
 *             type="string",
 *             example="Valentine")
 *      ),
 *      @OA\Parameter(
 *           name="_sort_by",
 *           in="query",
 *           description="Sort by field: latest_added, price_asc, name_asc, etc.",
 *           required=false,
 *           @OA\Schema(type="string", example="price_asc")
 *       )
 * )
 */
public function index(Request $request)
{
    try {
        $data['filter'] = $request->all();
        $page = (int) ($data['filter']['_page'] ?? 1);
        $limit = (int) ($data['filter']['_limit'] ?? 10); 
        $offset = ($page - 1) * $limit;

        $query = Bouquet::query();

        if ($request->get('_search')) {
                $query->where('name', 'like', '%' . $request->get('_search') . '%');
            }

        if ($request->filled('type')) {
                $query->where('type', $request->type);
            }

        if ($request->filled('color')) {
                $query->whereIn('color', $request->color);
            }

        if ($request->filled('category')) {
                $query->where('category', $request->category);
            }

        if ($request->filled('price_range')) {
            switch ($request->price_range) {
                case 'under_100':
                    $query->where('price', '<', 100000);
                    break;
                case '100_250':
                    $query->whereBetween('price', [100000, 250000]);
                    break;
                case '250_500':
                    $query->whereBetween('price', [250000, 500000]);
                    break;
                case 'above_500':
                    $query->where('price', '>', 500000);
                    break;
            }
        }

        if ($request->get('_category')) {
                $query->where('category', 'like', '%' . $request->get('_category') . '%');
            }

        if ($request->get('_sort_by')) {
            switch ($request->get('_sort_by')) {
                case 'latest_added':
                        $query->orderBy('created_at', 'DESC');
                        break;
                case 'name_asc':
                        $query->orderBy('name', 'ASC');
                        break;
                case 'name_desc':
                        $query->orderBy('name', 'DESC');
                        break;
                case 'price_asc':
                        $query->orderBy('price', 'ASC');
                        break;
                case 'price_desc':
                        $query->orderBy('price', 'DESC');
                        break;
            }
        }

        $data['products_count_total'] = $query->count();
        $data['products'] = $query->limit($limit)->offset($offset)->get();
        $data['products_count_search'] = ($data['products_count_total'] == 0 ? 0 : (($page - 1) * $limit) + 1);
        $data['products_count_end'] = ($data['products_count_total'] == 0 ? 0 : (($page - 1) * $limit) + count($data['products']));

        return response()->json($data, 200);

    } catch (\Exception $exception) {
        throw new HttpException(500, 'Invalid data : ' . $exception->getMessage());
    }
}

/**
 * @OA\Post(
 *     path="/api/bouquet",
 *     tags={"bouquet"},
 *     summary="Create a new bouquet item",
 *     operationId="store",
 *     security={{"passport": {}}},
 *     @OA\RequestBody(
 *         required=true,
 *         description="Bouquet data to store",
 *         @OA\JsonContent(
 *             required={"name", "price"},
 *             @OA\Property(property="name", type="string", example="Sweet Rose"),
 *             @OA\Property(property="category", type="string", example="Valentine"),
 *             @OA\Property(property="description", type="string", example="A lovely bouquet of pink and white roses."),
 *             @OA\Property(property="image", type="string", example="https://yourdomain.com/images/rose.jpg"),
 *             @OA\Property(property="price", type="integer", example=125000)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Bouquet created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Saved successfully"),
 *             @OA\Property(property="data", type="object")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid data",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Invalid data - The name field is required.")
 *         )
 *     )
 * )
 */

    public function store(Request $request)
{
    try {
        $data = $request->json()->all();
        $validator = Validator::make($data, [
            'name' => 'required|unique:bouquets',
            'price' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            throw new HttpException(400, $validator->messages()->first());
        }
        
        $bouquet = new Bouquet;
        $bouquet->fill($request->all());
        $bouquet->created_by = \Auth::user()->id; // Store the user ID
        $bouquet->save();

        return response()->json(array('message' => 'Saved successfully', 'data' => $bouquet), 200);
    } catch (\Exception $exception) {
        throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
    }
}


    /**
     * @OA\Get(
     *      path="/api/bouquet/{id}",
     *      tags={"bouquet"},
     *      summary="Display the specified item",
     *      operationId="show",
     *      @OA\Response(
     *          response=404,
     *          description="Item not found",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Invalid input",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of item that needs to be displayed",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      )
     * )
     */
    
    public function show($id)
    {
        $bouquet = Bouquet::findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $bouquet
        ]);
    }

public function showPage($id)
{
    $bouquet = Bouquet::findOrFail($id);

    return view('pages.pdp', compact('bouquet'));
}

    /**
     * @OA\Put(
     *      path="/api/bouquet/{id}",
     *      tags={"bouquet"},
     *      summary="Update the specified item",
     *      operationId="update",
     *      @OA\Response(
     *          response=404,
     *          description="Item not found",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Invalid input",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of item that needs to be updated",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="Request body description",
     *          @OA\JsonContent(
     *              ref="#/components/schemas/Bouquet",
     *              example={"title": "Eating Clean", "author": "Inge Tumiwa-Bachrens", "publisher": "Kawan Pustaka", "publication_year": "2016", "cover": "https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/bouquets/1482170055/33511107.jpg", "description": "Menjadi sehat adalah impian semua orang. Makanan yang selama ini kita pikir sehat ternyata belum tentu 'sehat' bagi tubuh kita.", "price": 85000}
     *          )
     *      )
     * )
     */
    public function update(Request $request, $id)
    {
        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }

        $bouquet = Bouquet::find($id);
        if (!$bouquet) {
            throw new HttpException(404, "Item not found");
        }

        try {
            $bouquet->fill($request->all());
            $bouquet->update_by = \Auth::user()->id;
            $bouquet->save();
            return response()->json(array('message' => 'Updated successfully', 'data' => $bouquet), 200);
        } catch (\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
        }
    }

    /**
     * @OA\Delete(
     *      path="/api/bouquet/{id}",
     *      tags={"bouquet"},
     *      summary="Remove the specified item",
     *      operationId="destroy",
     *      @OA\Response(
     *          response=404,
     *          description="Item not found",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Invalid input",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of item that needs to be removed",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        $bouquet = Bouquet::findOrFail($id);
        $bouquet-> delete_by = \Auth::user()->id;
        $bouquet->delete();

        return response()->json(array('message' => 'Deleted successfully', 'data' => $bouquet), 204);
    }
}