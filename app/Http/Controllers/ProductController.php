<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stand;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function serve(){
        $stand_id = Stand::where("user_id",Auth::user()->id)->get()->toArray()[0]["id"];
        $products = Product::where("stand_id",$stand_id)->orderByDesc("created_at")->get();
        return view("pages.stand.products",["products" => $products]);
    }

    public function serveForm(){
        return view("pages.stand.new-product");
    }

    public function serveFormEdit(Request $req, string $id){
        $product = Product::whereId($id)
            ->get()
            ->toArray()[0];
        return view("pages.stand.form-edit",["product" => $product]);
    }

    public function create(Request $req){
        $rules = [
                    "name"         =>  ["required"],
                    "description"  =>  ["required"],
                    "price"        =>  ["required","numeric"],
                    "image_url"     => ["required","image","mimes:png,jpeg,jpg"],
                ];
        $validator = Validator::make($req->all(), $rules);

        if($validator->fails()){
            $errors = $validator->errors()->toArray();
            //collect permet de flatten le tableau récursivement
            $arrayErrors = collect($errors)->flatten()->all();
            $errorToSentences = implode(",",$arrayErrors);
            return redirect("/products")->with("errors",$errorToSentences);
        }

        $validated = $validator->validated();
        $validated["stand_id"] = Stand::where("user_id",Auth::user()->id)->get()->toArray()[0]["id"];;
        $imagePath = $req->file("image_url")->store("images","public");
        $validated["image_url"] = env("APP_URL")."/storage/".$imagePath;
        Product::create($validated);
        return redirect("/products")->with("success","Produit rajouté avec succès!");
    }

    public function delete( Request $req){
        if(Gate::allows("can-update-product",$req)){
            Product::whereId($req->query("product_id"))->delete();
            return redirect("/products")->with("success", "Produit supprimé avec succès");
        }
        return redirect("/products")->with("errors","Vous n avez pas les droits d édition sur ce produit");
    }

    public function update(Request $req){
    if(Gate::allows("can-update-product",$req)){
        $rules = [
                "name" => ["required"],
                "description" => ["required"],
                "price" => ["required","numeric"],
                "product_id" => ["required","exists:products,id"],
                "image_url"=>["image","mimes:png,jpeg,jpg"]
        ];

        $validator = Validator::make($req->all(),$rules);

        if($validator->fails()){
            return redirect("/products/form-edit/".$req->get("product_id"))
                ->withErrors($validator->errors());
        }

        $validated = $validator->validated();
        if($req->hasFile("image_url")){
            $imagePath = $req->file("image_url")->store("images","public");
            $validated["image_url"] = env("APP_URL")."/storage/".$imagePath;
        }
        $validated["id"] = $validated["product_id"];
        $validated["product_id"] = "";
        $product = Product::whereId($validated["id"]);
        $product->update(array_filter($validated));
        return redirect("/products")->with("success","Produit modifié  avec succès!");
    }

        return redirect("/products")->with("errors","Vous n avez pas les droits d édition sur ce produit");
    }

    public function canAdd(User $user, Request $req){
        $standOwner = Stand::whereId($req->get("stand_id"))->get()->toArray();
        return $standOwner["user_id"] === $user->id;
    }

    public function canUpdate(User $user,Request $req){
        $product = Product::whereId($req->get("product_id"))
            ->get()
            ->toArray()[0];

        $stand = Stand::where("user_id",$user->id)->get()->toArray()[0];
        return $product["stand_id"] === $stand["id"];
    }
}
