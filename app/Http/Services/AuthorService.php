<?php

namespace App\Http\Services;

use App\Http\DTOs\Author\StoreAuthorDto;
use App\Http\Requests\Author\StoreAuthorRequest;
use App\Http\Requests\Author\UpdateAuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AuthorService
{
    public function storeAuthorService(StoreAuthorRequest $request): Author
    {
        $path = null;
        if ($request->hasFile('image')) //Check if there image uploaded
        {
            //put the uploaded image in the images folder
            $path = Storage::disk('public')->put('/images', $request->image);
        }
        $request->toDto()->image = $path;
        return Author::create([
            'name' => $request->toDto()->name,
            'bio' => $request->toDto()->bio,
            'email' => $request->toDto()->email,
            'image' => $request->toDto()->image
        ]);
    }

    public function updateAuthorService(UpdateAuthorRequest $request, Author $author)
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
        $request->toDto()->image = $path;
        $author->update([
            'name' => $request->toDto()->name,
            'bio' => $request->toDto()->bio,
            'image' => $request->toDto()->image
        ]);
    }

    public function deleteAuthorService(Author $author)
    {
        //Remove the author image
        Storage::disk('public')->delete($author->image);
        $author->delete();
    }
}
