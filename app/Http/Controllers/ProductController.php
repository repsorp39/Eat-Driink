<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function serve(){
        $products = Product::all()->toArray();
        return view("pages.stand.products",["products" => $products]);
    }

    public function serveForm(){
        return view("pages.stand.new");
    }

    public function get(Request $req, string $id){
        return Product::whereId($id)
            ->get()
            ->toArray();
    }

    public function create(Request $req){
        if(Gate::allows("canAdd")){
            $validated = $req->validate(
                [
                    "name" => ["required"],
                    "description" => ["required"],
                    "price" => ["required","float"],
                    "image_url" => ["required","image","mimes:png,jpeg,jpg"],
                    "stand_id"  => ["required","exists:stands,id"]
                ]
            );

                $imagePath = $req->file("image_url")->store("images","public");
                $validated["image_url"] = env("APP_URL")."/storage/".$imagePath;
                Product::create($validated);
                return redirect("/products")->with("success","Produit rajouté avec succès!");
            }

            abort(403);
    }

    public function delete(Request $req){
        if(Gate::allows("can-update")){
            Product::delete($req->query("product_id"));
            return redirect("/products")->with("success", "Produit supprimé avec succès");
        }
        abort(403);
    }

    public function update(Request $req){
    if(Gate::allows("can-update-product")){
        $validated = $req->validate(
            [
                "name" => ["required"],
                "description" => ["required"],
                "price" => ["required","float"],
                "image_url" => ["required","image","mimes:png,jpeg,jpg"],
                "stand_id"  => ["required","exists:stands,id"]
            ]
        );

            $imagePath = $req->file("image_url")->store("images","public");
            $validated["image_url"] = env("APP_URL")."/storage/".$imagePath;
            Product::update($validated);
            return redirect("/products")->with("success","Produit modifié  avec succès!");
        }

        abort(403);
    }

    public function canAdd(Request $req){
        $user = Stand::whereId($req->get("stand_id"))->get()->toArray();
        return $user["user_id"] === Auth::user()->id;
    }

    public function canUpdate(Request $req){
        $product = Product::whereId($req->get("product_id"))
            ->get()
            ->toArray();

        $stand = Stand::where("user_id",Auth::user()->id)->get()->toArray();
        return $product["stand_id"] === $stand["id"];
    }
}
