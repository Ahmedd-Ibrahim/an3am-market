<?php

namespace App\Repositories;

use App\Models\Basket;
use App\Models\Category;
use App\Models\HomePage;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Type;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

/**
 * Class HomePageRepository
 * @package App\Repositories
 * @version December 7, 2020, 3:07 pm UTC
*/

class HomePageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return HomePage::class;
    }


    public function slider($limit = 4)
    {

        return Slider::limit($limit)->get();

    }

    public function feature( $limit = 4 )
    {
        return Product::where('feature','true')->latest('created_at')->limit($limit)->get();
    }

    public function bestSeller($limit = 4)
    {
        // product id
        $products_id = $this->getMostRequired($limit);

        $products = Product::whereIn('id',$products_id)->get();

        if(count($products) >= 4)
        {
            return $products;
        }else{
            $products = Product::inRandomOrder()->limit($limit)->get();
            return $products;
        }

    } // end of best seller [most required]


    // return products from global search
    public function search($request)
    {
        if($request->search)
        {
            $key = $request->search;

            return  $result = DB::select("SELECT * FROM products WHERE name LIKE '%$key%' OR products.`desc` LIKE '%$key%'");

        }else{
            return 'not exists';
        }

    } // End of search

    // return select options
    public function CustomSearch()
    {

        $type = Type::limit(50)->get();

        $category = Category::limit(50)->get();

        $data = [
            'type'=> count($type) > 0 ? $type : 'no types',
            'category'=> count($category) > 0 ? $category : 'no category'
        ];
        return $data;
    } // end of custom search


    // return products from deep searching
    public function customSearching($request)
    {
        $typeId     = $request->type;
        $age        = $request->age;
        $categoryId = $request->category;

        return $result = $this->querySearching($categoryId,$typeId,$age);

    } // end of custom searching

    private function getMostRequired($limit)
    {
        // get products id from orders & group it by product id & get count of each product [how many ordered ]
        $productId_count = DB::select('SELECT  product_id , COUNT(*) AS counter FROM  product_order  GROUP BY product_id ORDER BY counter desc  limit ' . $limit );

        $products_id =  [];

        foreach ($productId_count as $ids)
        {
            $products_id[] = $ids->product_id;
        }
        return $products_id;
    } // End of get most required


    private function querySearching($categoryId,$typeId,$age)
    {
        if($categoryId == 0 )
        {
            return $products = DB::select("SELECT * FROM products WHERE type_id = $typeId And age = $age OR type_id = $typeId OR age = $age ");
        }

        if ($categoryId != 0)
        {
            $category = Category::find($categoryId);

            if(!$category)
            {
                return  'category not found';
            }

            if($categoryId != 0 && $typeId == 0 && $age == 0)
            {
                return $category->products;
            }

            return $category->products()->where('age',$age)->orWhere('type_id',$typeId)->get();

        }
    } // End of query searching

}
