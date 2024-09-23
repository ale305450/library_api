<?php

namespace App\Http\Services;

use App\Http\DTOs\Author\StoreAuthorDto;
use App\Http\Requests\Author\StoreAuthorRequest;
use App\Http\Requests\Author\UpdateAuthorRequest;
use App\Models\author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AuthorService
{
    public function StoreAuthorService(StoreAuthorRequest $request): author
    {
        $path = null;
        if ($request->hasFile('image')) //Check if there image uploaded
        {
            //put the uploaded image in the images folder
            $path = Storage::disk('public')->put('/images', $request->image);
        }
        $request->ToDto()->image = $path;
        return author::create([
            'name' => $request->ToDto()->name,
            'bio' => $request->ToDto()->bio,
            'email' => $request->ToDto()->email,
            'image' => $request->ToDto()->image
        ]);
    }

    public function UpdateAuthorService(UpdateAuthorRequest $request, author $author)
    {
        $path =  $author->image ?? null;
        if ($request->hasFile('image')) //Check if there image uploaded
        {
            if ($author->image) {
                Storage::disk('public')->delete($author->image); //Delete already exist image
            }
            //put the uploaded image in the images folder
            $path = Storage::disk('public')->put('/images', $request->image);
        }

        $author->update([
            'name' => $request->name,
            'bio' => $request->bio,
            'image' => $path
        ]);
    }

    public function DeleteAuthorService(author $author)
    {
        //Remove the author image
        Storage::disk('public')->delete($author->image);
        $author->delete();
    }
}
