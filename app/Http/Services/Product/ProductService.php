<?php


namespace App\Http\Services\Product;

use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Models\Comment;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use mysql_xdevapi\Exception;
use Illuminate\Support\Facades\Session;

class ProductService
{
    //hàm lấy tất cả các danh mục con
    public function getAllMenu()
    {
        return Menu::where('parent_id', '!=', 0)->orderbyDesc('name')->get();
    }

    //Hàm lấy tất cả sản phẩm
    public function getAllProduct()
    {
        return Product::orderbyDesc('created_at')->paginate(20)->onEachSide(2);// sắp xếp giảm dần theo id và phân trang

    }

    public function getSomeProduct()
    {
        return Product::orderbyDesc('created_at')->where('active',1)->take(8)->get();
    }

    public function getRandomProduct()
    {
        return Product::inRandomOrder()->where('active',1)->take(2)->get();
    }

    public function showDetail($id)
    {
       return Product::where('id', $id)->where('active',1)->firstOrFail();
    }

    public function getComment($id)
    {
        return Comment::where('product_id',$id)->orderbyDesc('created_at')->get();
    }

    public function getAllComment()
    {
        return Comment::orderbyDesc('created_at')->paginate(10);
    }

    public function avg_Rating($id)
    {
        $comments = Comment::where('product_id',$id)->get();
        $avg = $comments->avg('rating');
        $percentage = ($avg/5)*100; //tính tỉ lệ %
        return $showStar = round($percentage/20); //mỗi sao tương ứng 20%
    }

    // hàm lấy sản phẩm liên quan
    public function relativeProduct($id)
    {
        $product = Product::find($id);
        $menu = $product->menu_id; // lấy menu_id của sản phẩm
        $products = Product::where('menu_id', $menu)
            ->where('id', '!=', $id)
            ->inRandomOrder()
            ->take(6)
            ->get();
        $chunks = $products->chunk(3);
        $collection1 = $chunks->get(0); // Bộ sưu tập thứ nhất chứa 3 sản phẩm đầu tiên
        $collection2 = $chunks->get(1); // Bộ sưu tập thứ hai chứa 3 sản phẩm còn lại
        return [
            'collection1' => $collection1,
            'collection2' => $collection2
        ];
    }

    //Hàm Insert dữ liệu
    public function create($request)
    {
        try {
            // Kiểm tra và lưu trữ tệp tải lên
            if ($request->hasFile('picture')) {
                $file = $request->file('picture');
                    // dùng hàm random tạo tên file duy nhất
                    $fileName = Str::random(5) . '_' . $file->getClientOriginalName();
                    // Lưu trữ tệp vào thư mục 'storage/app/public/productImg'
                    $file->storeAs('productImg', $fileName, 'storage');
                }
            $product = new Product;
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->content = $request->input('content');
            $product->menu_id = $request->input('menu_id');
            $product->price = $request->input('price');
            $product->price_sale = $request->input('price_sale');
            $product->picture = $fileName ? $fileName : null; // Gán tên file nếu có, nếu không thì giá trị là null
            $product->active = $request->input('active');

            $product->save();
            Session::flash('success', 'Tạo Sản Phẩm thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return redirect()->back()->withInput();
        }
        return true;
    }

    //Hàm Update dữ liệu
    public function update($id, $request)
    {
        try {
            $fileName = null;
            if ($request->hasFile('picture')) {
                $file = $request->file('picture');
                    // dùng hàm random tạo tên file duy nhất
                    $fileName = Str::random(5) . '_' . $file->getClientOriginalName();
                    // Lưu trữ tệp vào thư mục 'storage/app/public/productImg'
                    $file->storeAs('productImg', $fileName, 'storage');
                }else{
                $fileName = $id->picture; //Không có ảnh mới được tải lên, giữ nguyên tên file cũ từ cơ sở dữ liệu
            }
            $id->menu_id = (int)$request->input('menu_id');
            $id->name = (string)$request->input('name');
            $id->description = (string)$request->input('description');
            $id->content = (string)$request->input('content');
            $id->price = (string)$request->input('price');
            $id->price_sale = (string)$request->input('price_sale');
            $id->picture = $fileName; //Gán tên file mới hoặc giữ nguyên tên file cũ
            $id->active = (string)$request->input('active');
            $id->save();
            Session::flash('success', 'Cập Nhật Sản Phẩm thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }

    //hàm xoá dữ liệu
    public function destroy($request)
    {
        $id = (int)$request->input('id');
        $product = Product::where('id', $id)->first();
        if ($product) {
            Storage::disk('storage')->delete('/productImg/'.$product->picture);// xoá file ảnh trong storage
            return Product::where('id', $id)->delete();
        }
        return false;
    }

    public function destroyComment($request)
    {
        $id = (int)$request->input('id');
        $comment = Comment::where('id', $id)->first();
        if ($comment) {
            return Comment::where('id', $id)->delete();
        }
        return false;
    }
}
