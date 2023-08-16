<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Categories;
use App\ProductAttribute;
use App\Gambar;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        //membawa data produk yang di join dengan table kategori
        $products = DB::table('products')
                    ->join('categories', 'categories.id', '=', 'products.categories_id')
                    ->select('products.*', 'categories.name as nama_kategori')
                    ->get();
        $data = array(
            'products' => $products
        );
        return view('admin.product.index',$data);
    }

    public function tambah()
    {
        //menampilkan form tambah kategori

        $data = array(
            'categories' => Categories::all(),
        );
        return view('admin.product.tambah',$data);
    }

    public function store(Request $request)
    {
        //menyimpan produk ke database
        if($request->file('image')){
            //simpan foto produk yang di upload ke direkteri public/storage/imageproduct
            $file = $request->file('image')->store('imageproduct','public');
            if($request->file('image1')){
                $file = $request->file('image')->store('imageproduct','public');
                $file1 = $request->file('image1')->store('imageproduct','public');
                
                if($request->file('image2')){
                    $file = $request->file('image')->store('imageproduct','public');
                    $file1 = $request->file('image1')->store('imageproduct','public');
                    $file2 = $request->file('image2')->store('imageproduct','public');
                    
                    if($request->file('image3')){
                        $file = $request->file('image')->store('imageproduct','public');
                        $file1 = $request->file('image1')->store('imageproduct','public');
                        $file2 = $request->file('image2')->store('imageproduct','public');
                        $file3 = $request->file('image3')->store('imageproduct','public');
                        Product::create([
                            'product_code' => $request->product_code,
                            'name' => $request->name,
                            'description' => $request->description,
                            'price' => $request->price,
                            'stok' => $request->stok,
                            'categories_id' => $request->categories_id,
                            'image'          => $file,
                            'image1' => $file1,
                            'image2' => $file2,
                            'image3' => $file3,
            
                        ]);
                    }
                    else{
                        Product::create([
                            'product_code' => $request->product_code,
                            'name' => $request->name,
                            'description' => $request->description,
                            'price' => $request->price,
                            'stok' => $request->stok,
                            'categories_id' => $request->categories_id,
                            'image'          => $file,
                            'image1' => $file1,
                            'image2' => $file2,
            
                        ]);

                    }
                }
                else{
                    Product::create([
                        'product_code' => $request->product_code,
                        'name' => $request->name,
                        'description' => $request->description,
                        'price' => $request->price,
                        'stok' => $request->stok,
                        'categories_id' => $request->categories_id,
                        'image'          => $file,
                        'image1' => $file1,
        
                    ]);

                }
            }
            else{
                Product::create([
                    'product_code' => $request->product_code,
                    'name' => $request->name,
                    'description' => $request->description,
                    'price' => $request->price,
                    'stok' => $request->stok,
                    'categories_id' => $request->categories_id,
                    'image'          => $file,
    
                ]);

            }

            return redirect()->route('admin.product')->with('status','Berhasil Menambah Produk Baru');
        }
    }

    public function edit($id)
    {
        //menampilkan form edit
        //dan mengambil data produk sesuai id dari parameter
        $data = array(
            'product' => Product::findOrFail($id),
            'categories' => Categories::all(),
        );
        return view('admin.product.edit',$data);
    }

    public function update($id,Request $request)
    {
        //ambil data dulu sesuai parameter $Id
        $prod = Product::findOrFail($id);

        // Lalu update data nya ke database
        if( $request->file('image') && $request->file('image1') && $request->file('image2') && $request->file('image3'))  {
            Storage::delete('public/'.$prod->image);
            Storage::delete('public/'.$prod->image1);
            Storage::delete('public/'.$prod->image2);
            Storage::delete('public/'.$prod->image3);

            $file = $request->file('image')->store('imageproduct','public');
            $file1 = $request->file('image1')->store('imageproduct','public');
            $file2 = $request->file('image2')->store('imageproduct','public');
            $file3 = $request->file('image3')->store('imageproduct','public');

            $prod->image = $file;
            $prod->image1 = $file1;
            $prod->image2 = $file2;
            $prod->image3 = $file3;
        }else if( $request->file('image1') && $request->file('image2') && $request->file('image3'))  {
            
            Storage::delete('public/'.$prod->image1);
            Storage::delete('public/'.$prod->image2);
            Storage::delete('public/'.$prod->image3);

            $file1 = $request->file('image1')->store('imageproduct','public');
            $file2 = $request->file('image2')->store('imageproduct','public');
            $file3 = $request->file('image3')->store('imageproduct','public');

            $prod->image1 = $file1;
            $prod->image2 = $file2;
            $prod->image3 = $file3;

        }else if( $request->file('image') && $request->file('image2') && $request->file('image3'))  {
            
            Storage::delete('public/'.$prod->image);
            Storage::delete('public/'.$prod->image2);
            Storage::delete('public/'.$prod->image3);

            $file = $request->file('image')->store('imageproduct','public');
            $file2 = $request->file('image2')->store('imageproduct','public');
            $file3 = $request->file('image3')->store('imageproduct','public');

            $prod->image = $file;
            $prod->image2 = $file2;
            $prod->image3 = $file3;

        }else if( $request->file('image') && $request->file('image1') && $request->file('image3'))  {
            
            Storage::delete('public/'.$prod->image);
            Storage::delete('public/'.$prod->image1);
            Storage::delete('public/'.$prod->image3);

            $file = $request->file('image')->store('imageproduct','public');
            $file1 = $request->file('image1')->store('imageproduct','public');
            $file3 = $request->file('image3')->store('imageproduct','public');

            $prod->image = $file;
            $prod->image1 = $file1;
            $prod->image3 = $file3;

        }else if( $request->file('image') && $request->file('image1') && $request->file('image2'))  {
            
            Storage::delete('public/'.$prod->image);
            Storage::delete('public/'.$prod->image1);
            Storage::delete('public/'.$prod->image2);

            $file = $request->file('image')->store('imageproduct','public');
            $file1 = $request->file('image1')->store('imageproduct','public');
            $file2 = $request->file('image2')->store('imageproduct','public');

            $prod->image = $file;
            $prod->image1 = $file1;
            $prod->image2 = $file2;

        }else if( $request->file('image2') && $request->file('image3'))  {
            
            Storage::delete('public/'.$prod->image2);
            Storage::delete('public/'.$prod->image3);

            $file2 = $request->file('image2')->store('imageproduct','public');
            $file3 = $request->file('image3')->store('imageproduct','public');

            $prod->image2 = $file2;
            $prod->image3 = $file3;

        }else if( $request->file('image1') && $request->file('image3'))  {
            
            Storage::delete('public/'.$prod->image1);
            Storage::delete('public/'.$prod->image3);

            $file1 = $request->file('image1')->store('imageproduct','public');
            $file3 = $request->file('image3')->store('imageproduct','public');

            $prod->image1 = $file1;
            $prod->image3 = $file3;

        }else if( $request->file('image1') && $request->file('image2'))  {
            
            Storage::delete('public/'.$prod->image1);
            Storage::delete('public/'.$prod->image2);

            $file1 = $request->file('image1')->store('imageproduct','public');
            $file2 = $request->file('image2')->store('imageproduct','public');

            $prod->image1 = $file1;
            $prod->image2 = $file2;

        }else if( $request->file('image') && $request->file('image3'))  {
            
            Storage::delete('public/'.$prod->image);
            Storage::delete('public/'.$prod->image3);

            $file = $request->file('image')->store('imageproduct','public');
            $file3 = $request->file('image3')->store('imageproduct','public');

            $prod->image = $file;
            $prod->image3 = $file3;

        }else if( $request->file('image') && $request->file('image2'))  {
            
            Storage::delete('public/'.$prod->image);
            Storage::delete('public/'.$prod->image2);

            $file = $request->file('image')->store('imageproduct','public');
            $file2 = $request->file('image2')->store('imageproduct','public');

            $prod->image = $file;
            $prod->image2 = $file2;

        }else if( $request->file('image') && $request->file('image1'))  {
            
            Storage::delete('public/'.$prod->image);
            Storage::delete('public/'.$prod->image1);

            $file = $request->file('image')->store('imageproduct','public');
            $file1 = $request->file('image1')->store('imageproduct','public');

            $prod->image = $file;
            $prod->image1 = $file1;

        }else if( $request->file('image')){
            
            Storage::delete('public/'.$prod->image);
            $file = $request->file('image')->store('imageproduct','public');

            $prod->image = $file;
        }else if($request->file('image1')){
            Storage::delete('public/'.$prod->image1);
            $file1 = $request->file('image1')->store('imageproduct','public');

            $prod->image1 = $file1;
        }else if($request->file('image2')){
            Storage::delete('public/'.$prod->image2);
            $file2 = $request->file('image2')->store('imageproduct','public');

            $prod->image2 = $file2;
        }else if($request->file('image3')){
            Storage::delete('public/'.$prod->image3);
            $file3 = $request->file('image3')->store('imageproduct','public');

            $prod->image3 = $file3;
        }

        $prod->product_code = $request->product_code;
        $prod->name = $request->name;
        $prod->description = $request->description;
        $prod->price = $request->price;
        $prod->categories_id = $request->categories_id;
        $prod->stok = $request->stok;
        $prod->diskon = $request->diskon;
        
        
        $prod->save();

        return redirect()->route('admin.product')->with('status','Berhasil Mengubah Produk');
    }

    public function delete($id)
    {
        //mengahapus produk
        $prod = Product::findOrFail($id);
        Product::destroy($id);
        Storage::delete('public/'.$prod->image);
        Storage::delete('public/'.$prod->image1);
        Storage::delete('public/'.$prod->image2);
        Storage::delete('public/'.$prod->image3);
        return redirect()->route('admin.product')->with('status','Berhasil Mengahapus Produk');
    }

    public function addAttributes(Request $request, $id)
    {
        $productDetails = Product::with('attributes')->where(['id'=>$id])->first();
        //$productDetails = json_decode(json_encode($productDetails));

        if($request->isMethod('post')){
            $data = $request->all();

            ProductAttribute::create([
                'product_id' => $request->product_id,
                'sku' => $request->sku,
                'size' => $request->size,
                'harga' => $request->harga,
                'stok' => $request->stok,
            ]);
        }
        $products = DB::table('product_attributes')
                    ->where('product_attributes.product_id','=',$id)
                    ->get();
        return view('admin.product.add_attributes')->with(compact('productDetails','products'));
    }

    public function deleteAttribute($id)
    {
        ProductAttribute::destroy($id);

        return redirect()->back()->with('status','Berhasil Mengahapus Attribute');
    }

    public function addgambar(Request $request ,$id)
    {
        $detail_gambar = Product::with('gambar')->where(['id'=>$id])->first();

        if($request->file('gambar')){
            //simpan foto produk yang di upload ke direkteri public/storage/imageproduct
            $file = $request->file('gambar')->store('imageproduct','public');

            Gambar::create([
                'product_id' => $request->product_id,
                'gambar' => $file,
            ]);
        }

        $gambar = DB::table('gambar')
                    ->where('gambar.product_id','=',$id)
                    ->get();
        
        return view('admin.product.add_gambar')->with(compact('detail_gambar','gambar'));
    }

    public function deleteGambar($id)
    {
        Gambar::destroy($id);

        return redirect()->back()->with('status','Berhasil Mengahapus Gambar');
    }
}